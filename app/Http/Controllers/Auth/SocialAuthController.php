<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;

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


            $userNew = User::create([
                'name' => $user->name,
                'email' => $user->email,
                'avatar' => $user->avatar,
                'provider_id' => $user->id,
                'external_auth' => 'google',
            ]);


            $userNew->assignRole('client');
            Auth::login($userNew);

            return redirect('/dashboard');
        } catch (QueryException $e) {
            if ($e->getCode() == '23000') {

                $existingUser = User::where('email', $user->email)->first();
                Auth::login($existingUser);

                return redirect('/dashboard');
            }


            Log::error('Error en la autenticación: ' . $e->getMessage());
            return redirect('/')->with('error', 'Error al iniciar sesión con Google.');
        }
    }
}
