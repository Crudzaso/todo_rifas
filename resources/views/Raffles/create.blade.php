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

    <div class="container mx-auto px-4 py-6">
        <div class="max-w-3xl mx-auto">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold">Crear Nueva Rifa</h1>
                <a href="{{ route('raffles.index') }}"
                   class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Volver
                </a>
            </div>

            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">¡Error!</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            <form action="{{ route('raffles.store') }}" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                @csrf

                {{-- Nombre de la Rifa --}}
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                        Nombre de la Rifa *
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('name') border-red-500 @enderror"
                           id="name"
                           type="text"
                           name="name"
                           value="{{ old('name') }}"
                           required>
                </div>

                {{-- Descripción --}}
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                        Descripción *
                    </label>
                    <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('description') border-red-500 @enderror"
                              id="description"
                              name="description"
                              rows="3"
                              required>{{ old('description') }}</textarea>
                </div>

                {{-- Selección de Lotería --}}
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="lottery">
                        Selecciona una Lotería *
                    </label>
                    <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('lottery') border-red-500 @enderror"
                            id="lottery"
                            name="lottery"
                            required>
                        <option value="">Seleccione una lotería</option>
                        @foreach($availableLotteries as $lottery)
                            <option value="{{ $lottery }}" {{ old('lottery') == $lottery ? 'selected' : '' }}>
                                {{ $lottery }}
                            </option>
                        @endforeach
                    </select>
                </div>


                {{-- Tipo de Rifa --}}
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">
                        Tipo de Rifa *
                    </label>
                    <div class="mt-2">
                        <label class="inline-flex items-center mr-6">
                            <input type="radio"
                                   class="form-radio"
                                   name="type"
                                   value="ticket"
                                   {{ old('type') == 'ticket' ? 'checked' : '' }}
                                   onclick="toggleTicketPrice(true)">
                            <span class="ml-2">Ticket</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="radio"
                                   class="form-radio"
                                   name="type"
                                   value="bet"
                                   {{ old('type') == 'bet' ? 'checked' : '' }}
                                   onclick="toggleTicketPrice(false)">
                            <span class="ml-2">Apuesta</span>
                        </label>
                    </div>
                </div>

                {{-- Fecha de la Rifa --}}
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="raffle_date">
                        Fecha de la Rifa *
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('raffle_date') border-red-500 @enderror"
                           id="raffle_date"
                           type="datetime-local"
                           name="raffle_date"
                           value="{{ old('raffle_date') }}"
                           required>
                </div>

                {{-- Número de Participantes --}}
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="tickets_count">
                        Número de Participantes *
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('tickets_count') border-red-500 @enderror"
                           id="tickets_count"
                           type="number"
                           name="tickets_count"
                           min="1"
                           max="100"
                           value="{{ old('tickets_count') }}"
                           required>
                    <p class="text-gray-600 text-xs italic">Máximo 100 participantes</p>
                </div>

                {{-- Precio del Ticket --}}
                <div id="ticketPriceSection" class="mb-4" style="{{ old('type') == 'bet' ? 'display: none;' : '' }}">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="ticket_price">
                        Precio del Ticket *
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('ticket_price') border-red-500 @enderror"
                           id="ticket_price"
                           type="number"
                           step="0.01"
                           name="ticket_price"
                           value="{{ old('ticket_price') }}"
                        {{ old('type') == 'ticket' ? 'required' : '' }}>
                </div>

                {{-- Estado Activo --}}
                <div class="mb-6">
                    <label class="inline-flex items-center">
                        <input type="checkbox"
                               class="form-checkbox"
                               name="active"
                               value="1"
                            {{ old('active', true) ? 'checked' : '' }}>
                        <span class="ml-2">Rifa activa</span>
                    </label>
                </div>

                <div class="flex items-center justify-between">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                            type="submit">
                        Crear Rifa
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            function toggleTicketPrice(show) {
                const ticketPriceSection = document.getElementById('ticketPriceSection');
                const ticketPriceInput = document.getElementById('ticket_price');

                if (show) {
                    ticketPriceSection.style.display = 'block';
                    ticketPriceInput.required = true;
                } else {
                    ticketPriceSection.style.display = 'none';
                    ticketPriceInput.required = false;
                    ticketPriceInput.value = '';
                }
            }

            // Inicializar el estado del precio del ticket basado en el tipo seleccionado
            document.addEventListener('DOMContentLoaded', function() {
                const selectedType = document.querySelector('input[name="type"]:checked')?.value;
                if (selectedType) {
                    toggleTicketPrice(selectedType === 'ticket');
                }
            });
        </script>
    @endpush
@endsection
