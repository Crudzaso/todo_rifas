@extends('layouts.appTodoRifas')

@section('title', 'EditarRoles')

@section('sidebar')
    @include('components.sidebar')
@endsection

@section('headerMobile')
    @include('components.header_mobile')
@endsection

@section('header')
    @include('components.dashboard_header')
@stop

@section('styles')
    <link href="{{ asset('css/permissions.css') }}" rel="stylesheet">
@stop

@section('content')
    <div class="permissions-container">
        <h1 class="permissions-header">Editar Permisos del Rol: <span class="text-success">{{ $role->name }}</span></h1>

        <div class="permissions-section">
            <h5 class="mb-3">Quitar Permisos</h5>
            <form action="{{ route('admin.roles.removePermissions', $role->id) }}" method="POST" class="permissions-form">
                @csrf
                <div class="form-group">
                    <label for="permissions">Selecciona los permisos a quitar:</label>
                    <select name="permissions[]" id="permissions" class="form-control" multiple>
                        @foreach($permissions as $permission)
                            <option value="{{ $permission->id }}" selected>{{ $permission->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-danger">Quitar Permisos</button>
            </form>
        </div>

        <div class="permissions-section">
            <h5 class="mb-3">Agregar Permisos</h5>
            <form action="{{ route('admin.roles.addPermissions', $role->id) }}" method="POST" class="permissions-form">
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
                <button type="submit" class="btn btn-success">Agregar Permisos</button>
            </form>
        </div>

        <div class="permissions-section">
            <h5 class="mb-3">Todos los Permisos Disponibles</h5>
            <ul>
                @foreach($allPermissions as $permission)
                    <li>{{ $permission->name }}</li>
                @endforeach
            </ul>
        </div>

        <a href="{{ route('admin.roles.index') }}" class="btn-back">Regresar</a>
    </div>
@stop
