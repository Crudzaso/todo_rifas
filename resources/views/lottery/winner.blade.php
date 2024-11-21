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
    <div class="container py-5 contenido">
        <!-- Alertas de sesión -->
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Header Section -->
        <div class="text-center mb-5 mt-5 pt-4">
            <h1 class="display-4 texto fw-bold text-primary mb-3">Resultados Disponibles</h1>
        </div>

        <!-- Ganadores Actuales -->
        <div class="card mb-5">
            <div class="card-body">
                @if (isset($error))
                    <div class="alert alert-danger text-center">
                        {{ $error }}
                    </div>
                @elseif (empty($winners))
                    <div class="alert alert-info text-center">
                        <p class="lead mb-0">Aún no hay ganadores registrados para el sorteo actual.</p>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered table-striped text-center">
                            <thead class="table-dark">
                            <tr>
                                <th scope="col">Nombre del Participante</th>
                                <th scope="col">Lotería</th>
                                <th scope="col">Número Ganador</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($winners as $winner)
                                <tr>
                                    <td>{{ $winner['participant_name'] ?? 'N/A' }}</td>
                                    <td>{{ $winner['lottery'] ?? 'N/A' }}</td>
                                    <td>{{ $winner['winning_number'] ?? 'N/A' }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>

        <!-- Ganadores Pasados -->
        <div class="card mt-5">
            <div class="card-header bg-primary text-white">
                <h2 class="h4 mb-0 text-center">Ganadores Pasados</h2>
            </div>
            <div class="card-body">
                @if (!isset($pastWinners) || $pastWinners->isEmpty())
                    <div class="alert alert-info text-center">
                        <p class="lead mb-0">No hay ganadores registrados de fechas pasadas.</p>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered table-striped text-center">
                            <thead class="table-dark">
                            <tr>
                                <th scope="col">Fecha</th>
                                <th scope="col">Nombre del Participante</th>
                                <th scope="col">Lotería</th>
                                <th scope="col">Número Ganador</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($pastWinners as $pastWinner)
                                <tr>
                                    <td>{{ $pastWinner->lottery_date ? \Carbon\Carbon::parse($pastWinner->lottery_date)->format('d/m/Y') : 'N/A' }}</td>
                                    <td>{{ $pastWinner->participant_name ?? 'N/A' }}</td>
                                    <td>{{ $pastWinner->lottery ?? 'N/A' }}</td>
                                    <td>{{ $pastWinner->winning_number ?? 'N/A' }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
