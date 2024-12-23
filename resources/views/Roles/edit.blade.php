@extends('layouts.appTodoRifas')

@section('styles')
    <link href="{{ asset('assets/css/raffle.index.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/styles.admin.css') }}" rel="stylesheet" type="text/css" />

@endsection

@section('content')
    <div class="container">
        <h1 class="roles-header">Editar Permisos del Rol: <span class="text-success">{{ $role->name }}</span></h1>

        <div class="roles-card mb-4">
            <h5 class="mb-3">Quitar Permisos</h5>
            <form action="{{ route('admin.roles.removePermissions', $role->id) }}" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <label for="permissions" class="form-label">Selecciona los permisos a quitar:</label>
                    <select name="permissions[]" id="permissions" class="form-control" multiple>
                        @foreach($permissions as $permission)
                            <option value="{{ $permission->id }}" selected>{{ $permission->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn-delete">Quitar Permisos</button>
            </form>
        </div>

        <div class="roles-card mb-4">
            <h5 class="mb-3">Agregar Permisos</h5>
            <form action="{{ route('admin.roles.addPermissions', $role->id) }}" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <label for="add-permissions" class="form-label">Selecciona los permisos a agregar:</label>
                    <select name="add_permissions[]" id="add-permissions" class="form-control" multiple>
                        @foreach($allPermissions as $permission)
                            @if(!$permissions->contains($permission))
                                <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn-new-role">Agregar Permisos</button>
            </form>
        </div>

        <div class="roles-card">
            <h5 class="mb-3">Todos los Permisos Disponibles</h5>
            <ul class="list-unstyled">
                @foreach($allPermissions as $permission)
                    <li>{{ $permission->name }}</li>
                @endforeach
            </ul>
        </div>

        <a href="{{ route('admin.roles.index') }}" class="btn-new-role mt-3">Regresar</a>
    </div>
@endsection
