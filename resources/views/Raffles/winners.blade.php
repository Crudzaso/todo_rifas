
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
        @foreach($winners as $winner)
            <div>
                <h3>Lotería: {{ $winner['lottery_name'] }}</h3>
                <p>Resultado: {{ $winner['winning_number'] }}</p>
                <p>Tu número: {{ $winner['user_number'] }}</p>
                <p>ID del usuario: {{ $winner['user_id'] }}</p>
            </div>
        @endforeach

        </tbody>
    </table>
@else
    <p>No hay ganadores en este momento.</p>
@endif

@endsection
