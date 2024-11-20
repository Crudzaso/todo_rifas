@extends('layouts.appTodoRifas')
@section('title')
    Rifas
@endsection

@section('subtitle')
    Acá podrás ver y participar de rifas y apuestas
@endsection
@section('styles')
    <link href="{{ asset('assets/css/raffle.index.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')


    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if(session('success.blade.php'))
        <div class="alert alert-success">
            {{ session('success.blade.php') }}
        </div>
    @endif

    <div class="container py-5 contenido ">
        <!-- Header Section con más espaciado -->
        <div class="text-center mb-5 mt-5 pt-4">
            <h1 class="display-4  texto fw-bold text-primary mb-3">Resultados Disponibles</h1>
            @if (isset($error))
                <p style="color: red;">{{ $error }}</p>
            @elseif (empty($winners))
                <p class="lead text-muted">Aun no hay ganadores.</p>
            @else
        </div>



    <table border="1">
        <thead>
        <tr>
            <th>Nombre del Participante</th>
            <th>Lotería</th>
            <th>Número Ganador</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($winners as $winner)
            <tr>
                <td>{{ $winner['participant_name'] }}</td>
                <td>{{ $winner['lottery'] }}</td>
                <td>{{ $winner['winning_number'] }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endif
@endsection
