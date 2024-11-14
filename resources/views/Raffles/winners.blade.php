
@extends('layouts.appTodoRifas')

@section('title', 'Rifas')

@section('sidebar')
    @include('components.sidebar')
@endsection

@section('headerMobile')
    @include('components.header_mobile')
@endsection

@section('header')
    @include('components.dashboard_header')
@endsection

@section('content')
<h1>Resultado de la Lotería</h1>

@if(count($winners) > 0)
    <h3>Ganadores</h3>
    <table>
        <thead>
        <tr>
            <th>Lotería</th>
            <th>Número Ganador</th>
            <th>Número del Usuario</th>
            <th>ID del Usuario</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($winners as $winner)
            <h3>Lotería: {{ $winner['raffle_name'] }}</h3>
            <p>Numero Ganador: {{ $winner['winning_number'] }}</p>
            <p> Tu numero de la suerte: {{ $winner['user_number'] }}</p>
            <p>ID del usuario: {{ $winner['user_id'] }}</p>
            <p>NOmbre del ganador: {{ $winner['user_name'] }}</p>
            <p>Tu premio es de: {{ $winner['prize'] }}</p>

        @endforeach


        </tbody>
    </table>
@else
    <p>No hay ganadores en este momento.</p>
@endif

@endsection
