@extends('layouts.appTodoRifas')

@section('content')
<div class="container" style="margin-top: 10rem;">
    <h1>Solicitud para organizar una rifa</h1>
    <p>
    <strong>Requisitos:</strong> Completa el formulario, envía una foto de tu documento de identidad válido en Colombia y descarga, firma y envía el contrato.
    Después de recibir estos documentos, los revisaremos y te responderemos lo más pronto posible.
    </p>


    <h3 class="mb-4">Formulario de solicitud</h3>
    
    <!-- Botón para descargar contrato -->
    <div class="mb-4">
        <a href="{{ route('download-contrato') }}" class="btn btn-primary">
            Descargar Contrato
        </a>
    </div>

    <!-- Formulario -->
    <form method="POST" action="{{ route('organizer.request.store') }}" enctype="multipart/form-data" class="p-4 border rounded">
        @csrf
        <!-- Razón -->
        <div class="mb-3">
            <label for="reason" class="form-label">Razón de la solicitud:</label>
            <textarea id="reason" name="reason" class="form-control" rows="4" placeholder="Describe la razón de tu solicitud" required></textarea>
        </div>

        <!-- Número de documento -->
        <div class="mb-3">
            <label for="document_number" class="form-label">Número de documento:</label>
            <input id="document_number" type="text" name="document_number" class="form-control" placeholder="Ingresa tu número de documento" required>
        </div>

        <!-- Foto del documento -->
        <div class="mb-3">
            <label for="document_photo" class="form-label">Foto del documento:</label>
            <input id="document_photo" type="file" name="document_photo" class="form-control" accept="image/png, image/jpeg" required>
            <small class="form-text text-muted">Aceptamos formatos JPG y PNG.</small>
        </div>

        <!-- Contrato -->
        <div class="mb-3">
            <label for="contract" class="form-label">Contrato firmado:</label>
            <input id="contract" type="file" name="contract" class="form-control" accept="application/pdf" required>
            <small class="form-text text-muted">Sube el contrato que descargaste y firmaste en formato PDF.</small>
        </div>

        <!-- Botón de envío -->
        <button type="submit" class="btn btn-success">Enviar Solicitud</button>
    </form>
</div>
@endsection
