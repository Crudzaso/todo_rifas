<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/login-google', function () {
    return Socialite::driver('google')->redirect();
});

Route::get('/google-callback', function () {
    try {
        $user = Socialite::driver('google')->user();

        /*verificar si el usuario existe usando
        el id del proveedor de google y el external auth
        */

        $userExist = User::where('provider_id', $user->id)
            ->where('external_auth', 'google')
            ->first();

        if ($userExist) {

            Auth::login($userExist);
        } else {
       /* Si no existe
        * se crea un nuevo
        *  usuario en la base de datos
        *
        *  */
            $userNew = User::create([
                'name' => $user->name,
                'email' => $user->email,
                'avatar' => $user->avatar,
                'provider_id' => $user->id,
                'external_auth' => 'google',
            ]);

            /* Se le Asigna un rol
            * de cliente por defecto
            */
            $userNew->assignRole('client');
            Auth::login($userNew);
        }

       /*  Redirigir a la página de dashboard*/
        return redirect('/dashboard');
    } catch (Exception $e) {
        /*Se maneja el error de autenticación con google */
        \Log::error('Error en la autenticación: ' . $e->getMessage());

        return redirect('/')->with('error', 'Error al iniciar sesión con Google.');
    }
});

Route::get('/profile/overview', function () {
    return view('profile.overview');
})->name('profile.overview');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
