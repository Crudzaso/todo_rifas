@extends('layouts.appTodoRifas')
@section('title')
    Crear Rifa
@endsection

@section('subtitle')
    Acá podrás Crear una Rifa Nueva
@endsection

@section('content')

    <div class="card-body pt-9 pb-0">
        <div class="max-w-3xl mx-auto">
            <div class="flex justify-between items-center mb-6">
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

            <div class="card-body pt-9 pb-0">
                <form action="{{ route('raffles.store') }}" method="POST">
                    @csrf

                    {{-- Nombre de la Rifa --}}
                    <div class="row mb-7">
                        <label class="col-lg-4 col-form-label required fw-semibold fs-6" for="name">
                            Nombre de la Rifa
                        </label>
                        <div class="col-lg-8">
                            <div class="row">
                                <input class="form-control form-control-lg form-control-solid mb-3 mb-lg-0 focus:outline-none @error('name') border-red-500 @enderror"
                                       id="name"
                                       type="text"
                                       name="name"
                                       value="{{ old('name') }}"
                                       required>
                            </div>
                        </div>
                    </div>

                    {{-- Descripción --}}
                    <div class="row mb-7">
                        <label class="col-lg-4 col-form-label required fw-semibold fs-6" for="description">
                            Descripción
                        </label>
                        <textarea class="form-control form-control-lg form-control-solid mb-3 mb-lg-0 @error('description') border-red-500 @enderror"
                                  id="description"
                                  name="description"
                                  rows="3"
                                  required>{{ old('description') }}</textarea>
                    </div>

                    {{-- Selección de Lotería --}}
                    <div class="row mb-7">
                        <label class="col-lg-4 col-form-label required fw-semibold fs-6" for="lottery">
                            Selecciona una Lotería
                        </label>
                        <div class="col-lg-8">
                            <div class="row">
                                @if ($availableLotteries->isEmpty())
                                    <div class="alert alert-warning">
                                        No hay loterías disponibles en este momento.
                                    </div>
                                    <select class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" disabled>
                                        <option>No disponible</option>
                                    </select>
                                @else
                                    <select class="form-control form-control-lg form-control-solid mb-3 mb-lg-0 @error('lottery') border-red-500 @enderror"
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
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- Tipo de Rifa --}}
                    <div class="row mb-7">
                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">
                            Tipo de Rifa
                        </label>
                        <div class="col-lg-8">
                            <label class="form-check-label">
                                <input type="radio"
                                       class="form-check-input"
                                       name="type"
                                       value="ticket"
                                       {{ old('type') == 'ticket' ? 'checked' : '' }}
                                       onchange="toggleTicketPrice()">
                                <span class="ml-2">Ticket</span>
                            </label>
                            <label class="form-check-label">
                                <input type="radio"
                                       class="form-check-input"
                                       name="type"
                                       value="bet"
                                       {{ old('type') == 'bet' ? 'checked' : '' }}
                                       onchange="toggleTicketPrice()">
                                <span class="ml-2">Apuesta</span>
                            </label>
                        </div>
                    </div>

                    {{-- Fecha de la Rifa --}}
                    <div class="row mb-7">
                        <label class="col-lg-4 col-form-label required fw-semibold fs-6" for="raffle_date">
                            Fecha de la Rifa
                        </label>
                        <div class="col-lg-8">
                            <div class="row">
                                <input class="form-control form-control-lg form-control-solid mb-3 mb-lg-0 @error('raffle_date') border-red-500 @enderror"
                                       id="raffle_date"
                                       type="datetime-local"
                                       name="raffle_date"
                                       value="{{ old('raffle_date') }}"
                                       required>
                            </div>
                        </div>
                    </div>

                    {{-- Número de Participantes --}}
                    <div class="row mb-7">
                        <label class="col-lg-4 col-form-label required fw-semibold fs-6" for="tickets_count">
                            Número de Participantes
                        </label>
                        <div class="col-lg-8">
                            <div class="row">
                                <div class="col-lg-6 fv-row fv-plugins-icon-container">
                                    <input class="form-control form-control-lg form-control-solid mb-3 mb-lg-0 @error('tickets_count') border-red-500 @enderror"
                                           id="tickets_count"
                                           type="number"
                                           name="tickets_count"
                                           min="1"
                                           max="100"
                                           value="{{ old('tickets_count') }}"
                                           required>
                                </div>
                                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                    <p class="text-600">Máximo 100 participantes</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Precio del Ticket --}}
                    <div class="row mb-7" id="ticket_price_section" style="{{ request()->input('type') == 'bet' ? 'display: none;' : '' }}">
                        <label class="col-lg-4 col-form-label required fw-semibold fs-6" for="ticket_price">
                            Precio del Ticket
                        </label>
                        <div class="col-lg-8">
                            <div class="row">
                                <input class="form-control form-control-lg form-control-solid mb-3 mb-lg-0 @error('ticket_price') border-red-500 @enderror"
                                       id="ticket_price"
                                       type="number"
                                       step="0.01"
                                       name="ticket_price"
                                       value="{{ old('ticket_price') }}"
                                    {{ request()->input('type') == 'ticket' }}>
                            </div>
                        </div>
                    </div>

                    {{-- Estado Activo --}}
                    <div class="mb-6">
                        <label class="form-check form-check-custom form-check-solid me-10">
                            <input type="checkbox"
                                   class="form-check-input h-30px w-30px"
                                   name="active"
                                   value="1"
                                {{ old('active', true) ? 'checked' : '' }}>
                            <label class="form-check-label" for="flexCheckbox40">Rifa activa</label>
                        </label>
                    </div>

                    <div class="flex items-center justify-between">
                        <button class="btn btn-primary"
                                type="submit">
                            Crear Rifa
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
