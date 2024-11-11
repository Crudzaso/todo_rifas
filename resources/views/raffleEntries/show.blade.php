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


    @extends('layouts.boletos')

    @section('styles')
        <style>
            .bet-amount-btn {
                padding: 10px;
                margin: 5px;
                border: 1px solid #ccc;
                cursor: pointer;
            }

            .bet-amount-btn.selected {
                background-color: #4CAF50;
                color: white;
            }
        </style>
    @endsection

    @section('content')
        <div class="main-container">
            <div class="raffle-container">
                <h1 class="raffle-title">{{ $raffle->name }}</h1> <!-- Nombre de la rifa -->
                <p class="lottery-details">{{ $raffle->description }}</p> <!-- Descripción de la rifa -->

                <form action="{{ route('raffleEntries.store') }}" method="POST">
                    @csrf

                    <input type="hidden" name="raffle_id" value="{{ $raffle->id }}">

                    <div class="form-group">
                        <label for="id">Número del Ticket (3-4 dígitos):</label>
                        <input
                            type="number"
                            id="id"
                            name="id"
                            min="100"
                            max="9999"
                            placeholder="Ingrese un número de ticket"
                            value="{{ old('id') }}"
                            required
                        >
                        @error('id')
                        <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>

                    @if($raffle->type === 'ticket')
                        <div class="form-group">
                            <label for="ticket_price">Precio del Ticket:</label>
                            <input
                                type="number"
                                id="ticket_price"
                                name="ticket_price"
                                value="{{ $raffle->ticket_price }}"
                                readonly
                                required
                            >
                        </div>
                    @endif

                    @if($raffle->type === 'bet')
                        <div class="form-group">
                            <label>Seleccione el monto de su apuesta:</label>
                            <div class="bet-buttons">
                                <button type="button" class="bet-amount-btn" data-value="1000">1000</button>
                                <button type="button" class="bet-amount-btn" data-value="5000">5000</button>
                                <button type="button" class="bet-amount-btn" data-value="10000">10000</button>
                            </div>
                            <input type="hidden" name="bet_amount" id="bet_amount" required>
                            @error('bet_amount')
                            <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                    @endif

                    <div class="button-group">
                        <button type="submit" class="btn-primary">
                            Confirmar Compra
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <script>
            document.querySelectorAll('.bet-amount-btn').forEach(function(button) {
                button.addEventListener('click', function() {
                    document.querySelectorAll('.bet-amount-btn').forEach(function(btn) {
                        btn.classList.remove('selected');
                    });
                    const betAmount = this.getAttribute('data-value');
                    document.getElementById('bet_amount').value = betAmount;
                    this.classList.add('selected');
                });
            });
        </script>
    @endsection
