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
    <!-- Navbar fija al scroll -->
    <nav class="navbar navbar-expand-lg fixed-top transition-all" id="mainNav" style="background: transparent;">
    </nav>

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif


    <div class="container py-5 contenido ">
        <!-- Header Section con más espaciado -->
        <div class="text-center mb-5 mt-5 pt-4">
            <h1 class="display-4  texto fw-bold text-primary mb-3">Juegos Disponibles</h1>
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
                        <div class="col-md-6 mb-4">
                            <div class="card h-100 shadow-sm hover-shadow transition-all position-relative">
                                <!-- Banner superior con el título -->
                                <div class="card-banner">
                                    <h5 class="fw-bold text-white mb-0">{{ $raffle->name }}</h5>
                                </div>

                                <div class="card-body d-flex">
                                    <!-- Columna izquierda con la información principal -->
                                    <div class="raffle-info flex-grow-1">
                                        <div class="info-item">
                                            <span class="info-label"><i class="fas fa-gift me-2"></i>Premio:</span>
                                            <span class="info-value">{{ $raffle->description }}</span>
                                        </div>

                                        <div class="info-item">
                                            <span class="info-label"><i class="fas fa-ticket-alt me-2"></i>Lotería:</span>
                                            <span class="info-value">{{ $raffle->lottery }}</span>
                                        </div>

                                        <div class="info-item">
                                            <span class="info-label"><i class="far fa-calendar-alt me-2"></i>Fecha:</span>
                                            <span class="info-value">{{ \Carbon\Carbon::parse($raffle->raffle_date)->format('d M Y') }}</span>
                                        </div>
                                    </div>

                                    <!-- Columna derecha con los botones -->
                                    <div class="raffle-actions d-flex flex-column justify-content-between ms-3">
                                        <a href="{{ route('raffles.show', $raffle->id) }}"
                                           class="btn btn-play mb-2">
                                            <i class="fas fa-play-circle me-1"></i>
                                            <span>Jugar</span>
                                        </a>

                                        <div class="admin-buttons d-flex gap-2">
                                            <button onclick="openEditModal({{ $raffle->id }}, '{{ $raffle->name }}', '{{ $raffle->description }}')"
                                                    class="btn btn-edit">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <form action="{{ route('raffles.destroy', $raffle->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-delete">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </div>
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
                        <div class="col-md-6 mb-4">
                            <div class="card h-100 shadow-sm hover-shadow transition-all position-relative">
                                <!-- Banner superior con el título -->
                                <div class="card-banner">
                                    <h5 class="fw-bold text-white mb-0">{{ $raffle->name }}</h5>
                                </div>

                                <div class="card-body d-flex">
                                    <!-- Columna izquierda con la información principal -->
                                    <div class="raffle-info flex-grow-1">
                                        <div class="info-item">
                                            <span class="info-label"><i class="fas fa-gift me-2"></i>Premio:</span>
                                            <span class="info-value">{{ $raffle->description }}</span>
                                        </div>

                                        <div class="info-item">
                                            <span class="info-label"><i class="fas fa-ticket-alt me-2"></i>Lotería:</span>
                                            <span class="info-value">{{ $raffle->lottery }}</span>
                                        </div>

                                        <div class="info-item">
                                            <span class="info-label"><i class="far fa-calendar-alt me-2"></i>Fecha:</span>
                                            <span class="info-value">{{ \Carbon\Carbon::parse($raffle->raffle_date)->format('d M Y') }}</span>
                                        </div>
                                    </div>


                                    <!-- Columna derecha con los botones -->
                                    <div class="raffle-actions d-flex flex-column justify-content-between ms-3">
                                        <a href="{{ route('raffles.show', $raffle->id) }}"
                                           class="btn btn-play mb-2">
                                            <i class="fas fa-play-circle me-1"></i>
                                            <span>Jugar</span>
                                        </a>

                                        <div class="admin-buttons d-flex gap-2">
                                            <button onclick="openEditModal({{ $raffle->id }}, '{{ $raffle->name }}', '{{ $raffle->description }}')"
                                                    class="btn btn-edit">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <form action="{{ route('raffles.destroy', $raffle->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-delete">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </div>
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

    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Editar Rifa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Formulario para editar la rifa -->
                    <form id="editForm" method="POST">
                        @csrf
                        @method('PUT') <!-- Usamos PUT porque es una actualización -->

                        <!-- Nombre de la rifa -->
                        <div class="mb-3">
                            <label for="editName" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="editName" name="name" required>
                        </div>

                        <!-- Descripción de la rifa -->
                        <div class="mb-3">
                            <label for="editDescription">Descripción</label>
                            <textarea class="form-control" id="editDescription" name="description" rows="3" required></textarea>
                        </div>

                        <!-- No hay campo de fecha aquí -->

                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                    </form>
                </div>
            </div>
        </div>
    </div>




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

@section('scripts')
    <script src="{{ asset('assets/js/raffleModal.js') }}"></script>
@endsection
