@extends('layouts.appTodoRifas')

@section('title', 'Admin')

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
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a class="btn btn-success btn-sm float-right" href="{{ route('admin.roles.create') }}">Nuevo Role</a>
    <h1>Roles</h1>

    <div class="card">
        <div class="card-body">
            <table class="table table-striped">
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
                            <a class="btn btn-sm btn-warning" href="{{ route('admin.roles.edit', $role->id) }}">
                                Ver Permisos
                            </a>
                        </td>
                        <td width="10px">
                            <form action="{{ route('admin.roles.destroy', $role) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection

