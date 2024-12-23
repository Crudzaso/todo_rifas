@extends('layouts.appTodoRifas')

@section('styles')
    <link href="{{ asset('assets/css/raffle.index.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/styles.admin.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

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
    <div class="container">
        <h1 class="roles-header">Crear un nuevo Rol</h1>


        <form action="{{ route('admin.roles.store') }}" method="POST" class="roles-card">
            @csrf

            <div class="form-group mb-3">
                <label for="name" class="form-label">Nombre del Rol</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
            </div>

            <div class="form-group mb-3">
                <label for="permissions" class="form-label">Permisos</label>
                <select name="permissions[]" id="permissions" class="form-control" multiple>
                    @foreach($permissions as $permission)
                        <option value="{{ $permission->id }}"
                            {{ in_array($permission->id, old('permissions', [])) ? 'selected' : '' }}>
                            {{ $permission->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn-new-role">Crear Rol</button>
        </form>
    </div>
@endsection
