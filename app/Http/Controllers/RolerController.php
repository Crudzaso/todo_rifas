<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAnRole;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $role = Role::all();
        $permissions = Permission::all();
        return view('Roles.index',compact('role','permissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::all();
        return view('Roles.create',compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateAnRole $request)
    {
        $role = Role::create([

            'name' => $request->name,
        ]);

       /**
        * asignamos permisos  a traves de sync
       */
        if ($request->has('permissions')) {
            $role->permissions()->sync($request->permissions);
        }


        return redirect()->route('admin.roles.index')
            ->with('success', 'Rol creado y permisos asignados correctamente.');

    }


    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        return view('Roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     */



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {// Validar la entrada del formulario
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $role->id,
        ]);

        // Actualizar el rol
        $role->update([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.roles.index')->with('success', 'Rol actualizado correctamente');
    }

    public function edit($roleId)
    {

        $role = Role::findOrFail($roleId);
        $permissions = $role->permissions;
        $allPermissions = Permission::all();

        return view('Roles.edit', compact('role', 'permissions', 'allPermissions'));
    }

    public function removePermissions(Request $request, $roleId)
    {
        $role = Role::findById($roleId);

        if (!$role) {
            return redirect()->route('admin.roles.index')->with('error', 'Rol no encontrado');
        }

        // Verifica si el array de permisos está presente
        $permissionIds = $request->input('permissions', []);

        // Si hay permisos seleccionados, quitar esos permisos del rol
        if (!empty($permissionIds)) {
            $permissions = Permission::whereIn('id', $permissionIds)->get();
            $role->revokePermissionTo($permissions);
        }

        return redirect()->route('admin.roles.index')->with('success', 'Permisos quitados correctamente');
    }

    public function addPermissions(Request $request, $roleId)
    {
        $role = Role::findById($roleId);

        $validated = $request->validate([
            'add_permissions' => 'required|array',
            'add_permissions.*' => 'exists:permissions,id',
        ]);

        $permissions = Permission::whereIn('id', $validated['add_permissions'])->get();
        $role->givePermissionTo($permissions);

        return redirect()->back()->with('success', 'Permisos agregados correctamente al rol.');
    }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();

        return redirect()->route('admin.roles.index')->with('success', 'Rol eliminado correctamente');
    }

}
