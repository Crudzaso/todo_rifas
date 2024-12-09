<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Simulación de Pago | Sistema de Rifas</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <style>
        .bg-pattern {
            background-color: #1a1d23;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23093e5e' fill-opacity='0.1'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }

        .card-shadow {
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .custom-border {
            border: 2px solid rgba(52, 168, 90, 0.1);
        }

        .hover-scale {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .hover-scale:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
        }

        .shine-button {
            position: relative;
            overflow: hidden;
        }

        .shine-button::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(
                to right,
                rgba(255, 255, 255, 0) 0%,
                rgba(255, 255, 255, 0.3) 50%,
                rgba(255, 255, 255, 0) 100%
            );
            transform: rotate(45deg);
            transition: 0.5s;
        }

        .shine-button:hover::after {
            animation: shine 1.5s ease;
        }

        @keyframes shine {
            0% { transform: translateX(-100%) rotate(45deg); }
            100% { transform: translateX(100%) rotate(45deg); }
        }

        /* Nuevos estilos para los valores */
        .value-tag {
            background-color: #f8f9fa;
            border: 1px solid #e9ecef;
            color: #1a1d23;
            font-weight: 500;
        }

        /* Estilo para el precio */
        .price-tag {
            background-color: #edf7f0;
            border: 1px solid #34a85a;
            color: #34a85a;
            font-weight: 600;
        }
    </style>
</head>
<body class="bg-pattern min-h-screen py-12">
<div class="container mx-auto px-4">
    <div class="max-w-xl mx-auto">

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <div class="bg-white rounded-2xl card-shadow hover-scale">
            <div class="bg-gradient-to-r from-[#093e5e] to-[#1a1d23] p-6 rounded-t-2xl">
                <h2 class="text-2xl font-bold text-center text-white flex items-center justify-center">
                    <i class="fas fa-credit-card mr-3"></i>
                    Simulación de Pago
                </h2>
            </div>

            <div class="p-8">
                <div class="mb-8">
                    <h3 class="text-[#1a1d23] text-xl font-semibold mb-4 flex items-center">
                        <i class="fas fa-ticket-alt text-[#34a85a] mr-2"></i>
                        Detalles de la Rifa
                    </h3>
                    <div class="bg-gray-50 rounded-xl p-6 custom-border">
                        <div class="space-y-4">
                            <div class="flex justify-between items-center">
                                <span class="text-[#2f4f4f]">Rifa:</span>
                                <span class="value-tag px-4 py-2 rounded-lg">
                                {{ $raffleEntry->raffle->name }}

                                </span>
                                <span class="text-[#2f4f4f]">N:</span>
                                <span class="value-tag px-4 py-2 rounded-lg">
                                 {{ $raffleEntry->raffle->id }}

                                </span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-[#2f4f4f]">Número de la suerte:</span>
                                <span class="value-tag px-4 py-2 rounded-lg">
                                    {{ $raffleEntry->number }}
                                </span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-[#2f4f4f]">Tipo:</span>
                                <span class="value-tag px-4 py-2 rounded-lg">
                                    {{ ucfirst($raffleEntry->type) }}
                                </span>
                                <span class="text-[#2f4f4f]">N:</span>
                                <span class="value-tag px-4 py-2 rounded-lg">
                                    {{ ucfirst($raffleEntry->id) }}
                                </span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-[#2f4f4f]">Precio:</span>
                                <span class="price-tag px-4 py-2 rounded-lg">
                                    ${{ number_format($raffleEntry->type === 'ticket' ? $raffleEntry->price : $raffleEntry->bet_amount, 0, ',', '.') }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-8">
                    <h3 class="text-[#1a1d23] text-xl font-semibold mb-4 flex items-center">
                        <i class="fas fa-user text-[#34a85a] mr-2"></i>
                        Datos del Comprador
                    </h3>
                    <div class="bg-gray-50 rounded-xl p-6 custom-border">
                        <div class="space-y-4">
                            <div class="flex justify-between items-center">
                                <span class="text-[#2f4f4f]">Nombre:</span>
                                <span class="value-tag px-4 py-2 rounded-lg">
                                    {{ $user->name }}
                                </span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-[#2f4f4f]">Email:</span>
                                <span class="value-tag px-4 py-2 rounded-lg">
                                    {{ $user->email }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <form action="{{ route('mercadopago.pay', $raffleEntry) }}" method="POST">
                    @csrf
                    <input type="hidden" name="amount" value="{{ $raffleEntry->type === 'ticket' ? $raffleEntry->price : $raffleEntry->bet_amount }}">
                    <input type="hidden" name="name" value="{{ $user->name }}">
                    <input type="hidden" name="email" value="{{ $user->email }}">


                    <button type="submit" class="w-full bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-4 rounded-lg">
                        Procesar Pago
                    </button>
                </form>

                <div class="mt-4 text-center text-sm text-gray-500">
                    <p>Aplican terminos y condiciones</p>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
