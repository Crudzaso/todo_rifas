<!-- resources/views/raffles/index.blade.php -->
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
    <div class="container">
        <br>
        <h1 class="text-center">Rifas Creadas</h1>

        <!-- Sección Apuesta y Gana -->
        <div class="mb-4">
            <h2 class="text-center">Apuesta y Gana</h2>
            @if ($raffles->where('type', 'bet')->isEmpty())
                <p>No hay rifas de tipo "Apuesta y Gana".</p>
            @else
                <div class="row text-center">
                    @foreach ($raffles->where('type', 'bet') as $raffle)
                        <div class="col-md-4 mb-4">
                            <div class="card text-center" style=" background-color: #2ca454;">
                                <!-- Asegurarse de que el card-header tenga un ancho completo -->
                                <div class="card-header ">
                                    <h5 class="card-title mb-0">{{ $raffle->name }}</h5>
                                </div>
                                <div class="card-body text-center text-capitalize">
                                    <p><strong>Que ganarás?:</strong></p>
                                    <p><strong></strong> {{ $raffle->description }}</p>
                                    <p><strong>Lotería:</strong></p>
                                    <p><strong></strong> {{ $raffle->lottery }}</p>
                                    <p><strong>¿Cuando juega?:</strong> {{ \Carbon\Carbon::parse($raffle->raffle_date)->format('d M Y') }}</p>
                                </div>

                                <!-- Botón "Jugar" centrado -->
                                <div class="d-flex justify-content-center">
                                    <a href="{{ route('raffles.show', $raffle->id) }}" class="btn btn-lg mt-2" style="background-color: #113891; color: white;">Jugar</a>

                                </div>

                                <!-- Botones editar y eliminar -->
                                <div class="card-footer text-center">
                                    <a href="{{ route('raffles.edit', $raffle->id) }}" class="btn btn-primary btn-sm mr-2">Editar</a>
                                    <form action="{{ route('raffles.destroy', $raffle->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>


        <!-- Sección Boleto de la Suerte -->
        <div class="mb-4">
            <h2 class="text-center"> Boleto de la Suerte</h2>
            @if ($raffles->where('type', 'ticket')->isEmpty())
                <p>No hay rifas de tipo "Boleto de la Suerte".</p>
            @else
                <div class="row">
                    @foreach ($raffles->where('type', 'ticket') as $raffle)
                        <div class="col-md-4 mb-4">
                            <div class="card" style="background-color: #2ca454;">
                                <div class="card-header text-center">
                                    <h5 class="card-title text-center">{{ $raffle->name }}</h5>
                                </div>
                                <div class="card-body text-center text-capitalize">
                                    <p><strong>Que ganarás?:</strong></p>
                                    <p><strong></strong> {{ $raffle->description }}</p>
                                    <p><strong>Lotería:</strong></p>
                                    <p><strong></strong> {{ $raffle->lottery }}</p>
                                    <p><strong>¿Cuando juega?:</strong> {{ \Carbon\Carbon::parse($raffle->raffle_date)->format('d M Y') }}</p>
                                </div>

                                <div class="d-flex justify-content-center">
                                    <a href="{{ route('raffles.show', $raffle->id) }}" class="btn btn-warning btn-lg mt-2">Jugar</a>

                                </div>

                                <div class="card-footer text-center">
                                    <a href="{{ route('raffles.edit', $raffle->id) }}" class="btn btn-primary btn-sm mr-2">Editar</a>
                                    <form action="{{ route('raffles.destroy', $raffle->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Botón para crear una nueva rifa -->
        <a href="{{ route('raffles.create') }}" class="btn btn-success mt-3">Crear Nueva Rifa</a>
    </div>
@endsection
