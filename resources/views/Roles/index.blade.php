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
        @php
            dd(session('success.blade.php'));
        @endphp
    @endif

    <div class="container py-5 contenido">
        <div class="text-center mb-5 mt-5 pt-4">
            <h1 class="display-4 texto fw-bold text-primary mb-3">Roles</h1>
            <p class="lead text-muted">Información de Roles</p>
        </div>

        <a class="btn-new-role" href="{{ route('admin.roles.create') }}">
            Nuevo Role
        </a>

        <div class="roles-card">
            <table class="roles-table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>ROLE</th>
                    <th colspan="3"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($roles as $role)
                    <tr>
                        <td>{{ $role->id }}</td>
                        <td>{{ $role->name }}</td>
                        <td width="10px">
                            <a class="btn-view-permissions" href="{{ route('admin.roles.edit', $role->id) }}">
                                Ver Permisos
                            </a>
                        </td>
                        <td width="10px">
                            <form action="{{ route('admin.roles.destroy', $role) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn-delete">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
