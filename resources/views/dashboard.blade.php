@extends('layouts.appTodoRifas')
@section('title')
    Bienvenido a TodoRifas, {{ auth()->user()->name ?? 'Invitado' }}
@endsection

@section('subtitle')
    ¡La suerte está en tus manos!
@endsection
@section('content')
    <!--Start Dashboard content-->
    <div class="container-fluid d-flex align-items-center justify-content-center vh-100 bg-light" style="padding: 20px;">
        <div class="row w-100">
            <!-- Logo a la izquierda -->
            <div class="col-lg-6 d-flex align-items-center justify-content-center p-5">
    <img 
        alt="Logo TodoRifas" 
        src="{{asset('assets/media/images/todo_rifas_pet.png')}}" 
        class="img-fluid rounded" 
        style="max-height: 450px; filter: drop-shadow(0px 4px 6px rgba(0, 0, 0, 0.5));" 
    />
</div>

            <!-- Contenido a la derecha -->
            <div class="col-lg-6 d-flex flex-column justify-content-center align-items-start p-5">
                <h1 class="display-3 text-primary fw-bold mb-3">
                    ¡Explora el mundo de las rifas con Todo Rifas!
                </h1>
                <p class="lead text-muted mb-4">
                    Tu lugar de confianza para organizar y participar en las mejores rifas. 
                    ¡La suerte está en tus manos!
                </p>

                    <!-- Mensajes adicionales -->
                    <div class="mt-5">
                    <h2 class="fw-bold text-success">
                        ¡Participa y gana increíbles premios!
                    </h2>
                    <p class="text-muted">
                        Con Todo Rifas, la suerte siempre está de tu lado. Encuentra rifas para todos los gustos.
                    </p>
                </div>

                <!-- Botones de acción estilizados -->
                <div class="d-flex flex-wrap gap-3 w-100 mt-4">
                    <a href="{{route('raffles.index')}}" 
                       class="btn btn-lg btn-primary px-5 py-3 fw-bold shadow-sm flex-grow-1 text-uppercase">
                        Ver Rifas Disponibles
                    </a>
                    <a href="{{route('lottery.winner')}}" 
                       class="btn btn-lg btn-primary px-5 py-3 fw-bold shadow-sm flex-grow-1 text-uppercase">
                        Ver Resultados
                    </a>
                </div>

            
                <br>
                <br>
                <br>

                    <!-- Call to Action Section -->
    <div class="mt-5">
        <h2 class="fw-bold text-primary">¿Quieres organizar tu propia rifa?</h2>
        <p class="text-muted">Envía tu solicitud ahora, revisaremos tu solicitud y nos pondremos en contacto contigo lo más pronto posible. forma parte de nuestra comunidad.</p>
        <a href="{{route('organizer.request.create')}}" class="btn btn-success btn-lg px-2 justify-content-center align-items-center">Envía tu solicitud</a>
    </div>
            </div>
        </div>
    </div>
    <!--End Dashboard content-->
@endsection
