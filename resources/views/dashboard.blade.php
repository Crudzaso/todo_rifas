@extends('layouts.appTodoRifas')
@section('title')
    Bienvenido a TodoRifas
@endsection
@section('subtitle')
    ¡La suerte está en tus manos!
@endsection
@section('content')
    <!--Start Dashboard content-->
    <div class="container py-5">
        <div class="text-center">
            <h1 class="display-4 text-primary mb-4">Explora el mundo de las rifas con Todo Rifas</h1>
            <p class="lead text-muted mb-5">Tu lugar de confianza para organizar y participar en las mejores rifas.</p>

            <!-- Botones de acciones principales -->
            <div class="d-grid gap-3 d-sm-flex justify-content-sm-center">
                <a href="{{route('raffles.index')}}" class="btn btn-primary btn-lg px-4">
                    Ver rifas disponibles
                </a>
                <a href="{{route('lottery.winner')}}" class="btn btn-secondary btn-lg px-4">
                    Ver resultados
                </a>
            </div>
        </div>

        <!-- Mensajes adicionales -->
        <div class="mt-5 text-center">
            <h2 class="fw-bold text-success">¡Participa y gana increíbles premios!</h2>
            <p class="text-muted">Con Todo Rifas, la suerte siempre está de tu lado. Encuentra rifas para todos los gustos.</p>
        </div>
    </div>
    <!--End Dashboard content-->
@endsection

@section('scripts')
    <!--start::custom scripts-->
    <!--end::custom scripts-->
@endsection
