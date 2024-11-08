<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;
use MongoDB\Driver\Exception\Exception;

class SocialAuthController extends Controller
{
/*Este metodo redirige al login de google*/
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();

       /**
        * verificacion para saber si el usuario ya existe en la base de datos
        * a través del id_provider
       */
            $userExist = User::where('provider_id', $user->id)
                ->where('external_auth', 'google')
                ->first();

            if ($userExist) {
                // Iniciar sesión si el usuario ya existe
                Auth::login($userExist);
            } else {
               /**
                * Crea un nuevo usuario sino existe
                * con estos datos
                *
               */
                $userNew = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'avatar' => $user->avatar,
                    'provider_id' => $user->id,
                    'external_auth' => 'google',
                ]);

              /**
               * Se asigna un rol de cliente al usuario
              */
                $userNew->assignRole('client');
                Auth::login($userNew);
            }

            return redirect('/dashboard');
        }catch (Exception $e){
            Log::error('Error en la autenticación: ' . $e->getMessage());

            return redirect('/')->with('error', 'Error al iniciar sesión con Google.');
        }
    }
}
