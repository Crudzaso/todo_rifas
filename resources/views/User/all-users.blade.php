@extends('layouts.appTodoRifas')
@section('title')
    USUARIOS
@endsection

@section('subtitle')
    Panel de usuarios
@endsection

@section('styles')
    <link href="{{ asset('assets/css/raffle.index.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/styles.users.css') }}" rel="stylesheet" type="text/css" />

@endsection

@section('content')
    <!-- Navbar fija al scroll -->
    <nav class="navbar navbar-expand-lg fixed-top transition-all" id="mainNav" style="background: transparent;">
        <!-- Optional: Add navbar content -->
    </nav>

    <div class="container py-5 contenido">
        <div class="text-center mb-5 mt-5 pt-4">
            <h1 class="display-4 texto fw-bold text-primary mb-3">Usuarios</h1>
            <p class="lead text-muted">Información de Usuarios</p>
        </div>

        <div class="table-responsive">
            <table class="users-table">
                <thead>
                <tr>
                    <th>Nombres</th>
                    <th>Correo</th>
                    <th>Fecha de nacimiento</th>
                    <th>Rol</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td data-label="Nombres">{{$user->name}}</td>
                        <td data-label="Correo">{{$user->email}}</td>
                        <td data-label="Fecha de Nacimiento">{{$user->date_of_birth}}</td>
                        <td data-label="Rol">{{ $user->getRoleNames()->implode(', ') }}</td>
                        <td class="action-buttons">
                            <a href="" class="btn btn-action btn-edit">
                                <i class="fas fa-edit"></i> Editar
                            </a>
                            <button class="btn btn-action btn-delete" data-bs-toggle="modal" data-bs-target="#deleteModal{{$user->id}}">
                                <i class="fas fa-trash"></i> Eliminar
                            </button>
                        </td>
                    </tr>
                    <div class="modal fade" id="deleteModal{{$user->id}}" tabindex="-1" aria-labelledby="deleteModalLabel{{$user->id}}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalLabel{{$user->id}}">Confirmar Eliminación</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    ¿Estás seguro que deseas eliminar al usuario "{{$user->name}}"?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    <form action="" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Eliminar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                @endforeach
                </tbody>

            </table>

        </div>

        <!-- Optional: Pagination -->
        @if(method_exists($users, 'links'))
            <div class="d-flex justify-content-center mt-4">
                {{ $users->links('pagination::bootstrap-4') }}
            </div>
        @endif
    </div>
@endsection

@section('scripts')
    <script>
        // Optional: Add any custom JavaScript here
        document.addEventListener('DOMContentLoaded', function() {
            // Example: Add some interactivity
            const rows = document.querySelectorAll('.users-table tbody tr');
            rows.forEach(row => {
                row.addEventListener('click', function() {
                    this.classList.toggle('selected');
                });
            });
        });
    </script>
@endsection
