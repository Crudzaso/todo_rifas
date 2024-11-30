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
                            <button class="btn btn-action btn-edit"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editUserModal"
                                    data-user-id="{{ $user->id }}"
                                    data-user-name="{{ $user->name }}"
                                    data-user-email="{{ $user->email }}"
                                    data-user-birth="{{ $user->date_of_birth }}"
                                    data-user-role="{{ $user->getRoleNames()->first() }}">
                                <i class="fas fa-edit"></i> Editar
                            </button>
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
                                    <form action="{{route('users.destroy', $user->id)}}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Eliminar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                @endforeach
                    </div>
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
    <!-- Edit User Modal -->
    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">Editar Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editUserForm" method="POST" action="">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="editName" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="editName" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="editEmail" class="form-label">Correo Electrónico</label>
                            <input type="email" class="form-control" id="editEmail" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="editBirthDate" class="form-label">Fecha de Nacimiento</label>
                            <input type="date" class="form-control" id="editBirthDate" name="date_of_birth" required>
                        </div>
{{--                        <div class="mb-3">--}}
{{--                            <label for="editRole" class="form-label">Rol</label>--}}
{{--                            <select class="form-select" id="editRole" name="role" required>--}}
{{--                                @foreach($roles as $role)--}}
{{--                                    <option value="{{ $role->name }}">{{ $role->name }}</option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}
{{--                        </div>--}}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Example: Add some interactivity
            const rows = document.querySelectorAll('.users-table tbody tr');
            rows.forEach(row => {
                row.addEventListener('click', function() {
                    this.classList.toggle('selected');
                });
            });
        });


            const editModal = document.getElementById('editUserModal');
            const editForm = document.getElementById('editUserForm');

            editModal.addEventListener('show.bs.modal', function (event) {
                // Button that triggered the modal
                const button = event.relatedTarget;

                // Extract info from data-* attributes
                const userId = button.getAttribute('data-user-id');
                const userName = button.getAttribute('data-user-name');
                const userEmail = button.getAttribute('data-user-email');
                const userBirthDate = button.getAttribute('data-user-birth');
                const userRole = button.getAttribute('data-user-role');

                // Update the form action dynamically
                editForm.action = `/users/${userId}`;

                // Populate form fields
                document.getElementById('editName').value = userName;
                document.getElementById('editEmail').value = userEmail;
                document.getElementById('editBirthDate').value = userBirthDate;
                document.getElementById('editRole').value = userRole;
            });
    </script>
@endsection
