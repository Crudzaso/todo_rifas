@extends('layouts.appTodoRifas')

@section('title', 'Admin')

@section('sidebar')
    @include('components.sidebar')
@endsection

@section('headerMobile')
    @include('components.header_mobile')
@endsection

@section('header')
    @include('components.dashboard_header')
@stop


@section('content')
    <h1>Editar Permisos del Rol: {{ $role->name }}</h1>

    <div class="card">
        <div class="card-body">
            <!-- Formulario para quitar permisos -->
            <form action="{{ route('admin.roles.removePermissions', $role->id) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="permissions">Selecciona los permisos a quitar:</label>
                    <select name="permissions[]" id="permissions" class="form-control" multiple>
                        @foreach($permissions as $permission)
                            <option value="{{ $permission->id }}" selected>{{ $permission->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-danger mt-2">Quitar Permisos</button>
            </form>

            <hr>

            <!-- Formulario para agregar permisos -->
            <form action="{{ route('admin.roles.addPermissions', $role->id) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="add-permissions">Selecciona los permisos a agregar:</label>
                    <select name="add_permissions[]" id="add-permissions" class="form-control" multiple>
                        @foreach($allPermissions as $permission)
                            @if(!$permissions->contains($permission))
                                <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-success mt-2">Agregar Permisos</button>
            </form>

            <hr>

            <h4>Todos los permisos disponibles:</h4>
            <ul>
                @foreach($allPermissions as $permission)
                    <li>{{ $permission->name }}</li>
                @endforeach
            </ul>
        </div>

        <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary mt-2">Regresar</a>
    </div>
@stop
