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

        // Verificar si el usuario ya existe
        $userExist = User::where('provider_id', $user->id)
            ->where('external_auth', 'google')
            ->first(); // Cambia 'exist' por 'first' para obtener el usuario

        if ($userExist) {
            // Si el usuario ya existe, inicie sesión
            Auth::login($userExist);
        } else {
            // Si no existe, crear uno nuevo
            $userNew = User::create([
                'name' => $user->name,
                'email' => $user->email,
                'avatar' => $user->avatar,
                'provider_id' => $user->id,
                'external_auth' => 'google',
            ]);
            Auth::login($userNew);
        }

        // Redirigir a la página de dashboard
        return redirect('/dashboard');
    } catch (Exception $e) {
        // Manejar el error
        // Puedes registrar el error o mostrar un mensaje al usuario
        \Log::error('Error en la autenticación: ' . $e->getMessage());

        return redirect('/')->with('error', 'Error al iniciar sesión con Google.');
    }
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
