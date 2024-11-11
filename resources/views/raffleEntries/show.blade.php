@extends('layouts.boletos')

@section('styles')
    <style>
        :root {
            --primary-blue: #0066ff;
            --secondary-blue: #003d99;
            --primary-green: #00cc66;
            --secondary-green: #009933;
            --light-gray: #f8f9fa;
        }

        .main-container {
            min-height: 100vh;
            padding: 2rem;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .raffle-container {
            background: white;
            width: 100%;
            max-width: 800px;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }

        .raffle-title {
            text-align: center;
            font-size: 2.5rem;
            color: var(--primary-blue);
            text-transform: uppercase;
            margin-bottom: 2rem;
            padding: 1rem;
            border-bottom: 4px solid var(--primary-green);
        }

        .lottery-details {
            background: var(--light-gray);
            padding: 1.5rem;
            border-radius: 10px;
            margin: 1.5rem 0;
            border-left: 6px solid var(--primary-green);
        }

        .lottery-details p {
            margin: 0.8rem 0;
            font-size: 1.1rem;
        }

        .prize-info {
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%);
            color: white;
            padding: 1.5rem;
            border-radius: 10px;
            margin: 1.5rem 0;
        }

        .bet-buttons {
            display: flex;
            gap: 1rem;
            margin: 1rem 0;
        }

        .bet-amount-btn {
            flex: 1;
            padding: 1rem;
            border: 2px solid var(--primary-blue);
            border-radius: 8px;
            background: white;
            color: var(--primary-blue);
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .bet-amount-btn:hover {
            background: var(--primary-blue);
            color: white;
        }

        .bet-amount-btn.selected {
            background: var(--primary-blue);
            color: white;
            transform: scale(1.05);
        }

        .form-group {
            margin: 1.5rem 0;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.8rem;
            font-size: 1.1rem;
            color: var(--secondary-blue);
            font-weight: bold;
        }

        .form-group input {
            width: 100%;
            padding: 1rem;
            border: 2px solid var(--primary-blue);
            border-radius: 8px;
            font-size: 1.1rem;
            transition: all 0.3s ease;
        }

        .total-pool {
            background: var(--primary-green);
            color: white;
            padding: 1.5rem;
            border-radius: 10px;
            margin: 1.5rem 0;
            text-align: center;
            font-size: 1.5rem;
            font-weight: bold;
        }

        .potential-earnings {
            background: linear-gradient(135deg, var(--primary-green) 0%, var(--secondary-green) 100%);
            color: white;
            padding: 1.5rem;
            border-radius: 10px;
            margin: 1.5rem 0;
            text-align: center;
        }

        .button-group {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
        }

        .btn-primary {
            background: var(--primary-green);
            color: white;
            flex: 2;
            padding: 1rem 2rem;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1.1rem;
            font-weight: bold;
        }

        .btn-secondary {
            background: var(--primary-blue);
            color: white;
            flex: 1;
            padding: 1rem 2rem;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1.1rem;
            font-weight: bold;
        }
    </style>
@endsection

@section('content')
    <div class="main-container">
        <div class="raffle-container">
            <form action="{{ route('raffleEntries.store', $raffle->id) }}" method="POST">
                @csrf

                <h1 class="raffle-title">{{ $raffle->name }}</h1>

                <div class="lottery-details">
                    <p><strong>Tipo de Rifa:</strong> {{ $raffle->type == 'bet' ? 'Apuesta' : 'Ticket' }}</p>
                    <p><strong>Lotería:</strong> {{ $raffle->lottery }}</p>
                    <p><strong>Fecha del Sorteo:</strong> {{ $raffle->raffle_date }}</p>
                </div>

                @if($raffle->type == 'bet')
                    <div class="total-pool">
                        <p>Premio Acumulado</p>
                        <h2>${{ number_format($totalBetPool, 2) }}</h2>
                        <small>*El premio final será la suma total de todas las apuestas</small>
                    </div>

                    <div class="potential-earnings">
                        <h3>Ganancia Potencial</h3>
                        <div class="amount" id="potentialEarnings">$0.00</div>
                        <small>*Basado en el premio acumulado actual</small>
                    </div>
                @else
                    <div class="prize-info">
                        <h3>Información del Premio</h3>
                        <p><strong>Premio:</strong> {{ $raffle->description }}</p>
                        <p><strong>Valor del Premio:</strong> ${{ number_format($raffle->ticket_price, 2) }}</p>
                    </div>
                @endif

                <div class="form-group">
                    <label for="id">Número del Ticket (3-4 dígitos):</label>
                    <input
                        type="number"
                        id="id"
                        name="id"
                        min="100"
                        max="9999"
                        placeholder="Ingrese un número de ticket"
                        required
                    >
                    <small>* Para jugar, elija un número entre 100 y 999</small>
                </div>

                @if($raffle->type == 'bet')
                    <div class="form-group">
                        <label>Seleccione el monto de su apuesta:</label>
                        <div class="bet-buttons">
                            <button type="button" class="bet-amount-btn" data-amount="1000">$1,000</button>
                            <button type="button" class="bet-amount-btn" data-amount="5000">$5,000</button>
                            <button type="button" class="bet-amount-btn" data-amount="10000">$10,000</button>
                        </div>
                        <input type="hidden" name="bet_amount" id="bet_amount" required>
                    </div>
                @endif

                <div class="button-group">
                    <button type="button" class="btn-secondary" onclick="generateRandomTicket()">
                        Generar Número
                    </button>
                    <button type="submit" class="btn-primary">
                        Confirmar Compra
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function generateRandomTicket() {
            const min = 100;
            const max = 9999;
            const randomTicket = Math.floor(Math.random() * (max - min + 1)) + min;
            document.getElementById('id').value = randomTicket;
        }

        // Código para manejar los botones de apuesta
        const betButtons = document.querySelectorAll('.bet-amount-btn');
        const betAmountInput = document.getElementById('bet_amount');
        const totalPool = {{ $totalBetPool ?? 0 }};



        betButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Remover la clase selected de todos los botones
                betButtons.forEach(btn => btn.classList.remove('selected'));
                // Añadir la clase selected al botón clickeado
                this.classList.add('selected');

                // Establecer el valor en el input
                const amount = this.dataset.amount;
                betAmountInput.value = amount;

                // Calcular y mostrar la ganancia potencial
                updatePotentialEarnings(amount);
            });
        });

        function updatePotentialEarnings(betAmount) {
            const potentialEarningsElement = document.getElementById('potentialEarnings');
            if (potentialEarningsElement && betAmount > 0) {
                // Calcula la ganancia potencial (premio total actual + apuesta actual)
                const potentialWinnings = totalPool + parseInt(betAmount);
                potentialEarningsElement.textContent = '$' + numberFormat(potentialWinnings);
            }
        }

        function numberFormat(number) {
            return new Intl.NumberFormat('es-MX', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            }).format(number);
        }

        document.querySelector('form').addEventListener('submit', function(e) {
            const ticketNumber = document.getElementById('id').value;

            if (ticketNumber < 100 || ticketNumber > 9999) {
                e.preventDefault();
                alert('Por favor ingrese un número válido entre 100 y 9999');
                return;
            }

            @if($raffle->type == 'bet')
            const betAmount = document.getElementById('bet_amount').value;
            if (betAmount < {{ $raffle->minimum_bet }}) {
                e.preventDefault();
                alert('La apuesta mínima es de ${{ number_format($raffle->minimum_bet, 2) }}');
                return;
            }

            if (!confirm(`¿Está seguro de apostar $${numberFormat(betAmount)} al número ${ticketNumber}?`)) {
                e.preventDefault();
            }
            @else
            if (!confirm('¿Está seguro de comprar el ticket con el número ' + ticketNumber + '?')) {
                e.preventDefault();
            }
            @endif
        });
    </script>
@endsection
