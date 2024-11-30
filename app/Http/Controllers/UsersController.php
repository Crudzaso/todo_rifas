<?php

namespace App\Http\Controllers;

use App\Http\Requests\validateDataUpdate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{

    /**
     * recuperar todos los usuarios y sus roles
    */
    public function index()
    {
        $users = User::with('roles')->paginate(8);
        $roles = Role::all();

        return view('User.all-users',compact('users','roles'));
    }

    /**
     * editar un usuario
     * se puede editar nombre, email, fecha de nacimiento
     * muestra la vista de los datos que se pueden editar
    */



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

    $user->name = $validateDataUpdate->name;
    $user->email = $validateDataUpdate->email;
    $user->date_of_birth = $validateDataUpdate->date_of_birth;

    if ($validateDataUpdate->filled('password')) {
        $user->password = Hash::make($validateDataUpdate->password);
    }
    $user->save();
//        $user->syncRoles([$validateDataUpdate->role]);

        /**
 * devolver la vista con mensaje de exito
*/
        return redirect()->route('users.list')->with('success', 'usuario actualizado correctamente');

    }


    /**
     * Metodo para archivar un usuario
    */

    public function destroy($id)
    {

        $user = User::find($id);
        if (!$user) {
            return redirect()->route('users.list')->with('error', 'Usuario no encontrado.');
        }

        /**
         * Verificar si el usuario tiene rifas asociadas
         */
        if ($user->raffles()->exists()) {
            return redirect()->route('users.list')->with('error', 'Este usuario tiene rifas asociadas y no puede ser eliminado.');
        }

        try {
            $user->delete();
            return redirect()->route('users.list')->with('success', 'Usuario eliminado correctamente');
        } catch (\Exception $e) {
            \Log::error('Error al eliminar el usuario: ' . $e->getMessage());
            return redirect()->route('users.list')->with('error', 'No se pudo eliminar el usuario. Por favor, revisa los registros.');
        }
    }


}
