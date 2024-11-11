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
    <!-- Navbar fija al scroll -->
    <nav class="navbar navbar-expand-lg fixed-top transition-all" id="mainNav" style="background: transparent;">
    </nav>

    <div class="container py-5 contenido ">
        <!-- Header Section con más espaciado -->
        <div class="text-center mb-5 mt-5 pt-4">
            <h1 class="display-4  texto fw-bold text-primary mb-3">Nuestras Rifas</h1>
            <p class="lead text-muted">Explora nuestras emocionantes oportunidades de ganar</p>
        </div>

        <!-- Sección Apuesta y Gana -->
        <div class="mb-5">
            <div class="d-flex align-items-center justify-content-center mb-4">
                <div class="border-bottom flex-grow-1"></div>
                <h2 class="text-center px-3 mb-0" style="color: #1a5d1a;">
                    <i class="fas fa-dice me-2"></i>Apuesta y Gana
                </h2>
                <div class="border-bottom flex-grow-1"></div>
            </div>

            @if ($raffles->where('type', 'bet')->isEmpty())
                <div class="alert alert-info text-center">
                    <i class="fas fa-info-circle me-2"></i>No hay rifas de tipo "Apuesta y Gana" disponibles en este momento.
                </div>
            @else
                <div class="row g-4">
                    @foreach ($raffles->where('type', 'bet') as $raffle)
                        <div class="col-md-4">
                            <div class="card h-100 shadow-sm hover-shadow transition-all position-relative">
                                <!-- Título flotante -->
                                <div class="card-title-floating">
                                    <h5 class="fw-bold text-white mb-0">{{ $raffle->name }}</h5>
                                </div>

                                <div class="card-body text-white mt-4">
                                    <div class="mb-4">
                                        <h6 class="fw-bold mb-2"><i class="fas fa-gift me-2"></i>Premio:</h6>
                                        <p class="text-capitalize mb-3">{{ $raffle->description }}</p>

                                        <h6 class="fw-bold mb-2"><i class="fas fa-ticket-alt me-2"></i>Lotería:</h6>
                                        <p class="text-capitalize mb-3">{{ $raffle->lottery }}</p>

                                        <h6 class="fw-bold mb-2"><i class="far fa-calendar-alt me-2"></i>Fecha del Sorteo:</h6>
                                        <p class="mb-0">{{ \Carbon\Carbon::parse($raffle->raffle_date)->format('d M Y') }}</p>
                                    </div>

                                    <div class="text-center mt-4">
                                        <a href="{{ route('raffles.show', $raffle->id) }}"
                                           class="btn btn-light btn-lg w-75 fw-bold shadow-sm hover-scale">
                                            <i class="fas fa-play-circle me-2"></i>Jugar Ahora
                                        </a>
                                    </div>
                                </div>

                                <div class="card-footer bg-transparent border-0 pb-3">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('raffles.edit', $raffle->id) }}"
                                           class="btn btn-sm btn-light">
                                            <i class="fas fa-edit me-1"></i>Editar
                                        </a>
                                        <form action="{{ route('raffles.destroy', $raffle->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash-alt me-1"></i>Eliminar
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Sección Boleto de la Suerte -->
        <div class="mb-5">
            <div class="d-flex align-items-center justify-content-center mb-4">
                <div class="border-bottom flex-grow-1"></div>
                <h2 class="text-center px-3 mb-0" style="color: #1a5d1a;">
                    <i class="fas fa-ticket-alt me-2"></i>Boleto de la Suerte
                </h2>
                <div class="border-bottom flex-grow-1"></div>
            </div>

            @if ($raffles->where('type', 'ticket')->isEmpty())
                <div class="alert alert-info text-center">
                    <i class="fas fa-info-circle me-2"></i>No hay rifas de tipo "Boleto de la Suerte" disponibles en este momento.
                </div>
            @else
                <div class="row g-4">
                    @foreach ($raffles->where('type', 'ticket') as $raffle)
                        <div class="col-md-4">
                            <div class="card h-100 shadow-sm hover-shadow transition-all position-relative">
                                <!-- Título flotante -->
                                <div class="card-title-floating">
                                    <h5 class="fw-bold text-white mb-0">{{ $raffle->name }}</h5>
                                </div>

                                <div class="card-body text-white mt-4">
                                    <div class="mb-4">
                                        <h6 class="fw-bold mb-2"><i class="fas fa-gift me-2"></i>Premio:</h6>
                                        <p class="text-capitalize mb-3">{{ $raffle->description }}</p>

                                        <h6 class="fw-bold mb-2"><i class="fas fa-ticket-alt me-2"></i>Lotería:</h6>
                                        <p class="text-capitalize mb-3">{{ $raffle->lottery }}</p>

                                        <h6 class="fw-bold mb-2"><i class="far fa-calendar-alt me-2"></i>Fecha del Sorteo:</h6>
                                        <p class="mb-0">{{ \Carbon\Carbon::parse($raffle->raffle_date)->format('d M Y') }}</p>
                                    </div>

                                    <div class="text-center mt-4">
                                        <a href="{{ route('raffles.show', $raffle->id) }}"
                                           class="btn btn-light btn-lg w-75 fw-bold shadow-sm hover-scale">
                                            <i class="fas fa-play-circle me-2"></i>Jugar Ahora
                                        </a>
                                    </div>
                                </div>

                                <div class="card-footer bg-transparent border-0 pb-3">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('raffles.edit', $raffle->id) }}"
                                           class="btn btn-sm btn-light">
                                            <i class="fas fa-edit me-1"></i>Editar
                                        </a>
                                        <form action="{{ route('raffles.destroy', $raffle->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash-alt me-1"></i>Eliminar
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Botón para crear nueva rifa -->
        <div class="text-center mt-5">
            <a href="{{ route('raffles.create') }}" class="btn btn-success btn-lg shadow-lg hover-scale">
                <i class="fas fa-plus-circle me-2"></i>Crear Nueva Rifa
            </a>
        </div>
    </div>


    <style>
        /* Variables de color */
        :root {
            --primary-green: #005792;
            --hover-green: #246b24;
            --hover-blue: #007bff;
            --text-color: #FFFFFF;
        }

        /* Navbar styles */
        #mainNav {
            transition: background-color 0.3s ease-in-out, padding 0.3s ease-in-out;
            padding: 1rem 0;
        }

        #mainNav.scrolled {
            background-color: var(--primary-green) !important;
            padding: 0.5rem 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        /* Card styles */
        .card {
            background-color: var(--primary-green);
            border: none;
            border-radius: 15px;
            overflow: visible; /* Permite que los elementos dentro de la tarjeta sobresalgan si es necesario */
            padding-top: 20px;
            color: var(--tag-text-color);

        }

        .card-title-floating {
            background-color: var(--hover-blue); /* Cambia a azul */
            padding: 10px 25px;
            border-radius: 25px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            z-index: 2;
            min-width: 80%;
            text-align: center;
        }


        .hover-shadow:hover {
            transform: translateY(-5px);
            box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.15)!important;
        }

        .hover-scale:hover {
            transform: scale(1.05);
            transition: transform 0.3s ease;
        }

        .transition-all {
            transition: all 0.3s ease;
        }

        .btn {
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .btn-light {
            color: var(--primary-green);
            font-weight: bold;
        }

        .btn-light:hover {
            background-color: var(--hover-green);
            color: white;
        }

        /* Centrado del contenido */
        .contenido {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        /* Estilo para el título */
        .texto {
            font-size: 4rem;  /* Título más grande */
            color: #005792;   /* Color azul */
        }

    </style>

    <!-- Script para la navbar -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var navbar = document.getElementById('mainNav');

            window.addEventListener('scroll', function() {
                if (window.scrollY > 50) {
                    navbar.classList.add('scrolled');
                } else {
                    navbar.classList.remove('scrolled');
                }
            });
        });
    </script>
@endsection
