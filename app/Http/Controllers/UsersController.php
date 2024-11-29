<?php

namespace App\Http\Controllers;

use App\Http\Requests\validateDataUpdate;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{

    /**
     * recuperar todos los usuarios y sus roles
    */
    public function index()
    {
        $users = User::all();
        return view('User.all-users',compact('users'));
    }

    /**
     * editar un usuario
     * se puede editar nombre, email, fecha de nacimiento
     * muestra la vista de los datos que se pueden editar
    */


    public function edit($userId)
    {

        $users = User::findOrFail($userId);
        return view('User.edit', compact('users'));
    }

    /**
     * Maneja la logica de guardar el nuevo valor asignado al usiario
     *
    */

    public function update(validateDataUpdate $validateDataUpdate, $id)
    {

        /**
         * buscar al usuario en la base de datos
        */
        $user = User::findOrFail($id);

        /**
         * actualizar los datos del usuario usando el request
         *
        */

        $user->update(
            ['name' =>$validateDataUpdate-> $name,
            'email' =>$validateDataUpdate-> $email,
            'password' => $validateDataUpdate->password ? bcrypt($validateDataUpdate->password) : $user->password,
            ]);
/**
 * devolver la vista con mensaje de exito
*/
        return redirect()->route('User.all-users')->with('edit.blade.php', 'usuario actualizado correctamente');

    }


    /**
     * Metodo para archivar un usuario
    */

    public function destroy(User $user)
    {

        $user->delete();

        return redirect()->route('User.all-users')->with('users.blade.php', 'usuario eliminado correctamente');
    }
}
