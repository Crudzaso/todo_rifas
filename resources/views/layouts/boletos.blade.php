<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('assets/css/style.tickets.css') }}" rel="stylesheet" type="text/css" />

    <title>{{ config('app.name', 'boletos') }}</title>


</head>
<body>
@yield('content')

<!-- Aquí tus scripts globales -->
@yield('scripts')
</body>
</html>
