@extends('layouts.appTodoRifas')

@section('title', 'Crear Rol')

@section('sidebar')
    @include('layouts.partials.sidebar')
@endsection

@section('headerMobile')
    @include('layouts.partials.header_mobile')
@endsection

@section('header')
    @include('layouts.partials.header')
@stop

@section('content')
    <h1>Crear un nuevo Rol</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.roles.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">Nombre del Rol</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" >
        </div>


        <!-- Selección de Permisos -->
        <div class="form-group">
            <label for="permissions">Permisos</label>
            <select name="permissions[]" id="permissions" class="form-control" multiple>
                @foreach($permissions as $permission)
                    <option value="{{ $permission->id }}"
                        {{ in_array($permission->id, old('permissions', [])) ? 'selected' : '' }}>
                        {{ $permission->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Crear Rol</button>
    </form>
@endsection
