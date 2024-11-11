<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'boletos') }}</title>

    <!-- Aquí tus estilos globales -->
    @yield('styles')
</head>
<body>
@yield('content')

<!-- Aquí tus scripts globales -->
@yield('scripts')
</body>
</html>
