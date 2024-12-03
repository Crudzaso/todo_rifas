@extends('layouts.appTodoRifas')
@section('styles')
    <link href="{{ asset('assets/css/raffle.index.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

<div class="container py-5 contenido">
    <div class="text-center mb-5 mt-5 pt-4">
        <h1 class="display-4 texto fw-bold text-primary mb-3">Solicitudes para ser organizador</h1>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>Usuario</th>
                <th>Razón</th>
                <th>Documento</th>
                <th>Contrato</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($requests as $request)
                <tr>
                    <td>{{ $request->user->name }}</td>
                    <td>{{ $request->reason }}</td>
                    <td><a href="{{ $request->document_photo }}" target="_blank">Ver Foto</a></td>
                    <td><a href="{{ $request->contract }}" target="_blank">Ver Contrato</a></td>
                    <td>{{ $request->status }}</td>
                    <td>
                        @if($request->status == 'pending')
                        <form action="{{ route('admin.organizer.requests.approve', $request->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-success">Aprobar</button>
                        </form>


                        <form action="{{ route('admin.organizer.requests.reject', $request->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-danger">Rechazar</button>
                        </form>

                        @else
                            <span class="text-muted">No disponible</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
