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

    @if(session('success.blade.php'))
        <div class="alert alert-success">
            {{ session('success.blade.php') }}
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
                        <i class="ki-duotone ki-dollar fs-1 text-warning">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                        </i>
                    Apuesta y Gana
                </h2>
                <div class="border-bottom flex-grow-1"></div>
            </div>

            @if ($raffles->where('type', 'bet')->isEmpty())
                <div class="alert alert-info text-center">
                    <i class="ki-duotone ki-disconnect fs-1 text-warning">
                        <span class="path1"></span>
                        <span class="path2"></span>
                        <span class="path3"></span>
                        <span class="path4"></span>
                        <span class="path5"></span>
                    </i>No hay rifas de tipo "Apuesta y Gana" disponibles en este momento.
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
                                            <span class="info-label">
                                                <i class="ki-duotone ki-star text-warning">
                                                </i>Premio:
                                            </span>
                                            <span class="info-value">{{ $raffle->description }}</span>
                                        </div>

                                        <div class="info-item">
                                            <span class="info-label">
                                                <i class="ki-duotone ki-ocean text-danger">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                                <span class="path4"></span>
                                                <span class="path5"></span>
                                                <span class="path6"></span>
                                                <span class="path7"></span>
                                                <span class="path8"></span>
                                                <span class="path9"></span>
                                                <span class="path10"></span>
                                                <span class="path11"></span>
                                                <span class="path12"></span>
                                                <span class="path13"></span>
                                                <span class="path14"></span>
                                                <span class="path15"></span>
                                                <span class="path16"></span>
                                                <span class="path17"></span>
                                                <span class="path18"></span>
                                                <span class="path19"></span>
                                                </i>Lotería:
                                            </span>
                                            <span class="info-value">{{ $raffle->lottery }}</span>
                                        </div>

                                        <div class="info-item">
                                            <span class="info-label">
                                                <i class="ki-duotone ki-calendar-2 text-primary">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                                <span class="path4"></span>
                                                <span class="path5"></span>
                                                </i>Fecha:
                                            </span>
                                            <span class="info-value">{{ \Carbon\Carbon::parse($raffle->raffle_date)->format('d M Y') }}</span>
                                        </div>
                                    </div>

                                    <!-- Columna derecha con los botones -->
                                    <div class="raffle-actions d-flex flex-column justify-content-between ms-3">
                                        <a href="{{route('raffles.show', $raffle->id) }}"
                                           class="btn btn-play mb-2">
                                            <i class="ki-duotone ki-bill fs-1 text-gray-900">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                                <span class="path4"></span>
                                                <span class="path5"></span>
                                                <span class="path6"></span>
                                                <span class="path7"></span>
                                            </i>
                                            <span>Jugar</span>
                                        </a>

                                        <div class="admin-buttons d-flex gap-2">
                                            @auth()
                                            @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('organizer'))
                                            <button onclick="openEditModal({{ $raffle->id }}, '{{ $raffle->name }}', '{{ $raffle->description }}')"
                                                    class="btn btn-edit">
                                                    <i class="ki-duotone ki-pencil fs-1 text-gray-900">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                    </i>
                                            </button>
                                            @endif
                                            @endauth
                                            <form action="{{ route('raffles.destroy', $raffle->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                @auth()
                                                @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('organizer'))
                                                <button type="submit" class="btn btn-delete">
                                                    <i class="ki-duotone ki-trash fs-1 text-gray-900">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                        <span class="path3"></span>
                                                        <span class="path4"></span>
                                                        <span class="path5"></span>
                                                        </i>
                                                </button>
                                                @endif
                                                @endauth
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
                    <i class="ki-duotone ki-abstract-22 fs-1 text-warning">
                        <span class="path1"></span>
                        <span class="path2"></span>
                        <span class="path3"></span>
                    </i>
                    Boleto de la Suerte
                </h2>
                <div class="border-bottom flex-grow-1"></div>
            </div>

            @if ($raffles->where('type', 'ticket')->isEmpty())
                <div class="alert alert-info text-center">
                    <i class="ki-duotone ki-disconnect fs-1 text-warning">
                        <span class="path1"></span>
                        <span class="path2"></span>
                        <span class="path3"></span>
                        <span class="path4"></span>
                        <span class="path5"></span>
                    </i>No hay rifas de tipo "Boleto de la Suerte" disponibles en este momento.
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
                                            <span class="info-label"><i class="ki-duotone ki-star text-warning">
                                            </i>Premio:</span>
                                            <span class="info-value">{{ $raffle->description }}</span>
                                        </div>

                                        <div class="info-item">
                                            <span class="info-label"><i class="ki-duotone ki-ocean text-danger">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                                <span class="path4"></span>
                                                <span class="path5"></span>
                                                <span class="path6"></span>
                                                <span class="path7"></span>
                                                <span class="path8"></span>
                                                <span class="path9"></span>
                                                <span class="path10"></span>
                                                <span class="path11"></span>
                                                <span class="path12"></span>
                                                <span class="path13"></span>
                                                <span class="path14"></span>
                                                <span class="path15"></span>
                                                <span class="path16"></span>
                                                <span class="path17"></span>
                                                <span class="path18"></span>
                                                <span class="path19"></span>
                                                </i>Lotería:</span>
                                            <span class="info-value">{{ $raffle->lottery }}</span>
                                        </div>

                                        <div class="info-item">
                                            <span class="info-label"><i class="ki-duotone ki-calendar-2 text-primary">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                                <span class="path4"></span>
                                                <span class="path5"></span>
                                                </i>Fecha:</span>
                                            <span class="info-value">{{ \Carbon\Carbon::parse($raffle->raffle_date)->format('d M Y') }}</span>
                                        </div>
                                    </div>


                                    <!-- Columna derecha con los botones -->
                                    <div class="raffle-actions d-flex flex-column justify-content-between ms-3">
                                        <a href="{{ route('raffles.show', $raffle->id) }}"
                                           class="btn btn-play mb-2">
                                           <i class="ki-duotone ki-bill fs-1 text-gray-900">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                            <span class="path4"></span>
                                            <span class="path5"></span>
                                            <span class="path6"></span>
                                            <span class="path7"></span>
                                            </i>
                                            <span>Jugar</span>
                                        </a>

                                        <div class="admin-buttons d-flex gap-2">
                                            @auth()
                                            @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('organizer'))
                                            <button onclick="openEditModal({{ $raffle->id }}, '{{ $raffle->name }}', '{{ $raffle->description }}')"
                                                    class="btn btn-edit">
                                                    <i class="ki-duotone ki-pencil fs-1 text-gray-900">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                        </i>
                                            </button>
                                            @endif
                                            @endauth
                                            <form action="{{ route('raffles.destroy', $raffle->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                @auth()
                                                @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('organizer'))
                                                <button type="submit" class="btn btn-delete">
                                                    <i class="ki-duotone ki-trash fs-1 text-gray-900">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                        <span class="path3"></span>
                                                        <span class="path4"></span>
                                                        <span class="path5"></span>
                                                        </i>
                                                </button>
                                                @endif
                                                @endauth
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
            @auth()
            @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('organizer'))
            <a href="{{ route('raffles.create') }}" class="btn btn-success btn-lg shadow-lg hover-scale">
                <i class="ki-duotone ki-plus fs-1 text-warning">
                    <span class="path1"></span>
                    <span class="path2"></span>
                    <span class="path3"></span>
                </i>Crear Nueva Rifa
            </a>
            @endif
            @endauth
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
                        @method('PUT')

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
