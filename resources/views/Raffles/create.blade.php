@extends('layouts.appTodoRifas')

@section('title', 'Rifas')

@section('sidebar')
    @include('components.sidebar')
@endsection

@section('headerMobile')
    @include('components.header_mobile')
@endsection

@section('header')
    @include('components.dashboard_header')
@stop


@section('content')

        <h2>Crear una nueva rifa</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <form method="POST" action="{{ route('raffles.store') }}">
            @csrf

            <!-- Campo de nombre -->
            <div class="form-group">
                <label for="name">Nombre de la rifa:</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" >
            </div>

            <!-- Campo de descripción -->
            <div class="form-group">
                <label for="description">Descripción:</label>
                <textarea name="description" id="description" class="form-control" required></textarea>
            </div>

            <!-- Selección del tipo de rifa -->
            <div class="form-group">
                <label>Tipo de rifa:</label><br>
                <div class="form-check">
                    <input type="radio" name="type" id="type_ticket" value="ticket" class="form-check-input" required>
                    <label class="form-check-label" for="type_ticket">Ticket</label>
                </div>
                <div class="form-check">
                    <input type="radio" name="type" id="type_bet" value="bet" class="form-check-input">
                    <label class="form-check-label" for="type_bet">Apuesta</label>
                </div>
            </div>

            <!-- Opciones específicas para 'ticket' -->
            <div id="ticket-fields" class="d-none">
                <div class="form-group">
                    <label for="tickets_count">Cantidad de boletos:</label>
                    <input type="number" name="tickets_count" id="tickets_count" class="form-control" disabled>
                </div>
                <div class="form-group">
                    <label for="ticket_price">Precio del boleto:</label>
                    <input type="number" name="ticket_price" id="ticket_price" class="form-control" disabled>
                </div>
            </div>

            <!-- Opciones específicas para 'bet' -->
            <div id="bet-fields" class="d-none">
                <div class="form-group">
                    <label for="min_bet">Apuesta mínima:</label>
                    <input type="number" name="min_bet" id="min_bet" class="form-control" disabled>
                </div>
                <div class="form-group">
                    <label for="max_bet">Apuesta máxima:</label>
                    <input type="number" name="max_bet" id="max_bet" class="form-control" disabled>
                </div>
            </div>


            <!-- Resto de campos -->
            <div class="form-group">
                <label for="lottery">Lotería:</label>
                <select name="lottery" id="lottery" class="form-control">
                    @foreach ($availableLotteries as $lottery)
                        <option value="{{ $lottery }}">{{ $lottery }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="raffle_date">Fecha de la rifa:</label>
                <input type="date" name="raffle_date" id="raffle_date" class="form-control">
            </div>

            <div class="form-group">
                <label for="active">¿Está activa?</label><br>
                <input type="checkbox" name="active" id="a
ctive" value="1"> Activa
            </div>

            <button type="submit" class="btn btn-primary">Crear rifa</button>
        </form>


        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const typeTicket = document.getElementById('type_ticket');
                const typeBet = document.getElementById('type_bet');
                const ticketFields = document.getElementById('ticket-fields');
                const betFields = document.getElementById('bet-fields');
                const ticketsCount = document.getElementById('tickets_count');
                const ticketPrice = document.getElementById('ticket_price');
                const minBet = document.getElementById('min_bet');
                const maxBet = document.getElementById('max_bet');
                const form = document.querySelector('form');

                // Función para mostrar/ocultar los campos y habilitarlos
                function toggleFields() {
                    if (typeTicket.checked) {
                        ticketFields.classList.remove('d-none');
                        betFields.classList.add('d-none');
                        ticketsCount.removeAttribute('disabled');  // Habilitar
                        ticketPrice.removeAttribute('disabled');  // Habilitar
                        minBet.setAttribute('disabled', 'true');    // Deshabilitar
                        maxBet.setAttribute('disabled', 'true');    // Deshabilitar
                    } else if (typeBet.checked) {
                        ticketFields.classList.add('d-none');
                        betFields.classList.remove('d-none');
                        ticketsCount.setAttribute('disabled', 'true');  // Deshabilitar
                        ticketPrice.setAttribute('disabled', 'true');   // Deshabilitar
                        minBet.removeAttribute('disabled');  // Habilitar
                        maxBet.removeAttribute('disabled');  // Habilitar
                    }
                }

                // Validación al enviar el formulario
                form.addEventListener('submit', function(e) {
                    // Validar que la apuesta máxima sea mayor que la mínima
                    const minBetValue = parseFloat(minBet.value);
                    const maxBetValue = parseFloat(maxBet.value);

                    if (typeBet.checked && maxBetValue <= minBetValue) {
                        e.preventDefault();  // Evitar el envío del formulario
                        alert("La apuesta máxima debe ser mayor que la apuesta mínima.");
                    } else {
                        // Limpiar todos los campos del formulario después de la validación exitosa
                        form.reset();
                        // Si el formulario tiene radios, puedes asegurarte de que uno de los radios esté seleccionado
                        // Si no se seleccionó un radio, se puede seleccionar el primero por defecto:
                        typeTicket.checked = true;
                        toggleFields();
                    }
                });

                // Event listeners para los radios
                typeTicket.addEventListener('change', toggleFields);
                typeBet.addEventListener('change', toggleFields);

                // Ejecutar toggleFields para asegurarse de que se muestren los campos adecuados al cargar
                toggleFields();
            });


        </script>
@endsection
