@extends('layouts.appTodoRifas')

@section('styles')
<link href="{{ asset('assets/css/raffle.index.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')


    <div class="roles-container">
        @if(session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif

        <a class="btn-new-role" href="{{ route('admin.roles.create') }}">
            Nuevo Role
        </a>

        <h1 class="roles-header">Roles</h1>

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
                @foreach($role as $role)
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
