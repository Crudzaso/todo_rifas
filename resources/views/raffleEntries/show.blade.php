@extends('layouts.boletos')

@section('content')
    <div class="raffle-page">
        <div class="raffle-container">
            <div class="raffle-card">
                <div class="raffle-header">
                    <div class="trophy-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M6 9H4.5a2.5 2.5 0 0 1 0-5H6"></path>
                            <path d="M18 9h1.5a2.5 2.5 0 0 0 0-5H18"></path>
                            <path d="M4 22h16"></path>
                            <path d="M10 14.66V17c0 .55-.47.98-.97 1.21C7.85 18.75 7 20.24 7 22"></path>
                            <path d="M14 14.66V17c0 .55.47.98.97 1.21C16.15 18.75 17 20.24 17 22"></path>
                            <path d="M18 2H6v7a6 6 0 0 0 12 0V2Z"></path>
                        </svg>
                    </div>
                    <h1 class="raffle-title">{{ $raffle->name }}</h1>
                    <p class="raffle-description">{{ $raffle->description }}</p>
                </div>

                <form action="{{ route('raffleEntries.store') }}" method="POST" class="raffle-form">
                    @csrf
                    <input type="hidden" name="raffle_id" value="{{ $raffle->id }}">

                    <div class="form-group ticket-number-group">
                        <label for="id">Número de la Suerte (3 dígitos)</label>
                        <div class="ticket-input-container">
                            <input
                                type="number"
                                id="id"
                                name="id"
                                min="100"
                                max="999"
                                placeholder="Ingrese un número de ticket"
                                value="{{ old('id') }}"
                                required
                                class="ticket-input"
                            >
                            <button type="button" id="generateRandomNumberBtn" class="random-button">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M19 2H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2Z"></path>
                                    <path d="M7 12h.01"></path>
                                    <path d="M12 12h.01"></path>
                                    <path d="M17 12h.01"></path>
                                </svg>
                                Aleatorio
                            </button>
                        </div>
                        @error('id')
                        <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    @if($raffle->type === 'ticket')
                        <div class="form-group ticket-price-group">
                            <div class="price-container">
                                <div class="price-label">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M20 12v8H4v-8"></path>
                                        <path d="M2 4v8h20V4"></path>
                                        <path d="M12 4v8"></path>
                                        <path d="M12 16v3"></path>
                                    </svg>
                                    <label for="ticket_price">Precio del Ticket:</label>
                                </div>
                                <input
                                    type="number"
                                    id="ticket_price"
                                    name="ticket_price"
                                    value="{{ $raffle->ticket_price }}"
                                    readonly
                                    required
                                    class="price-input"
                                >
                            </div>
                        </div>
                    @endif

                    @if($raffle->type === 'bet')
                        <div class="form-group bet-group">
                            <div class="prize-pool">
                                <div class="prize-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="8" r="6"></circle>
                                        <path d="M15.477 12.89 17 22l-5-3-5 3 1.523-9.11"></path>
                                    </svg>
                                </div>
                                <div class="prize-info">
                                    <span class="prize-label">PREMIO ACUMULADO</span>
                                    <span class="prize-amount">{{ $raffle->total_bet_pool }}</span>
                                </div>
                            </div>

                            <label class="bet-amount-label">Seleccione el monto de su apuesta:</label>
                            <div class="bet-buttons">
                                <button type="button" class="bet-amount-btn" data-value="1000">$1,000</button>
                                <button type="button" class="bet-amount-btn" data-value="5000">$5,000</button>
                                <button type="button" class="bet-amount-btn" data-value="10000">$10,000</button>
                            </div>
                            <input type="hidden" name="bet_amount" id="bet_amount" required>
                            @error('bet_amount')
                            <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    @endif

                    <div class="button-group">
                        <button type="submit" class="submit-button">
                            <span>Confirmar Compra</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 12h14"></path>
                                <path d="m12 5 7 7-7 7"></path>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
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

        function generateRandomNumber() {
            const min = 100;
            const max = 999;
            const randomNum = Math.floor(Math.random() * (max - min + 1)) + min;
            document.getElementById('id').value = randomNum;
        }

        document.getElementById('generateRandomNumberBtn').addEventListener('click', generateRandomNumber);
    </script>
@endsection
