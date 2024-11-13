<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="canonical" href="http://preview.keenthemes.comlanding.html" />
    <link rel="shortcut icon" href="{{asset('assets/media/images/todo_rifas v2.png')}}" />
    <!--begin::Fonts(mandatory for all pages)-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <link href="{{asset('assets/css/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{asset('assets/css/style.auth.css')}}">
</head>
<body>
    <div class="container">
        <div class="wrapper">
            <div class="card-switch">
                <label class="switch">
                <input type="checkbox" class="toggle">
                <span class="slider"></span>
                <span class="card-side"></span>
                <div class="flip-card__inner">
                    <div class="flip-card__front">
                        <div class="title">Ingresar</div>
                        <a href="{{ url('login-google') }}" class="btn btn-google btn-sm">
                        <img src="{{ asset('assets/media/images/icono-google.png') }}" alt="Google Logo" class="h-4 mr-2">
                        Entrar con Google
                        </a>
                        <form class="flip-card__form" method="POST" action="{{route('login')}}">
                            @csrf
                            <input class="flip-card__input" name="email" placeholder="Email" type="email" :value="old('email')" required autofocus autocomplete="username">
                            <input class="flip-card__input" name="password" placeholder="Contraseña" type="password" required autocomplete="current-password">
                            <button class="flip-card__btn">Ingresar</button>
                        </form>
                    </div>
                    <div class="flip-card__back">
                        <div class="title">Registrarse</div>
                        <a href="{{ url('login-google') }}" class="btn btn-google btn-sm">
                        <img src="{{ asset('assets/media/images/icono-google.png') }}" alt="Google Logo" class="h-4 mr-2">
                        Entrar con Google
                        </a>
                        <form class="flip-card__form" method="POST" action="{{ route('register') }}">
                            @csrf
                            <input class="flip-card__input" id="name" placeholder="Nombre" type="text" name="name" :value="old('name')" required autofocus autocomplete="name">
                            <input class="flip-card__input" id="email" name="email" placeholder="Email" type="email" :value="old('email')" required autocomplete="username">
                            <input class="flip-card__input" id="date_of_birth" type="date" name="date_of_birth" :value="old('date_of_birth')"  placeholder="AAAA-MM-DD" required autocomplete="dateofbirth">
                            <select class="flip-card__input" id="role" name="role"  class="block mt-1 w-full">
                                <option value="">Selecciona el tipo de usuario</option>
                                <option value="client">Cliente</option>
                                <option value="organizer">Organizador</option>
                            </select>
                            <input class="flip-card__input" id="password" name="password" placeholder="Contraseña" type="password" required autocomplete="new-password">
                            <input class="flip-card__input" id="password_confirmation" name="password_confirmation" placeholder="Confirmar contraseña" type="password" required autocomplete="new-password">
                            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                            <div class="mt-4">
                                <x-label for="terms">
                                    <div class="flex items-center">
                                        <x-checkbox name="terms" id="terms" required />
            
                                        <div class="ms-2">
                                            {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                                    'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Terms of Service').'</a>',
                                                    'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Privacy Policy').'</a>',
                                            ]) !!}
                                        </div>
                                    </div>
                                </x-label>
                            </div>
                            @endif
                            <button class="flip-card__btn">Registrarme</button>
                        </form>
                    </div>
                </div>
                </label>
            </div>
        </div>
    </div>
</body>
</html>