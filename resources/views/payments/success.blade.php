<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pago Exitoso | Sistema de Rifas</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <style>
        /* Estilos personalizados */
        .success-gradient {
            background: linear-gradient(135deg, #34a85a 0%, #2afb5a 100%);
        }

        .card-shadow {
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .hover-scale {
            transition: transform 0.3s ease;
        }

        .hover-scale:hover {
            transform: scale(1.02);
        }

        .success-icon {
            animation: successPulse 2s infinite;
        }

        @keyframes successPulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        .bg-pattern {
            background-color: #1a1d23;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23093e5e' fill-opacity='0.1'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }

        .custom-border {
            border: 2px solid rgba(52, 168, 90, 0.1);
        }

        .shine-effect {
            position: relative;
            overflow: hidden;
        }

        .shine-effect::after {
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
            animation: shine 3s infinite;
        }

        @keyframes shine {
            0% { transform: translateX(-100%) rotate(45deg); }
            100% { transform: translateX(100%) rotate(45deg); }
        }

        .floating {
            animation: floating 3s ease-in-out infinite;
        }

        @keyframes floating {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
    </style>
</head>
<body class="bg-pattern min-h-screen">
<div class="container mx-auto px-4 py-12">
    <div class="max-w-2xl mx-auto">
        <!-- Tarjeta Principal -->
        <div class="bg-white rounded-3xl card-shadow hover-scale">
            <!-- Banner de Éxito -->
            <div class="success-gradient p-8 rounded-t-3xl relative overflow-hidden">
                <div class="text-center">
                    <div class="w-24 h-24 bg-white rounded-full mx-auto mb-6 flex items-center justify-center success-icon">
                        <i class="fas fa-check-circle text-[#34a85a] text-5xl"></i>
                    </div>
                    <h1 class="text-white text-4xl font-bold mb-3">¡Pago Exitoso!</h1>
                    <p class="text-white/90 text-lg">Tu transacción se ha completado correctamente</p>
                </div>
            </div>

            <!-- Detalles de la Transacción -->
            <div class="p-8">
                <div class="mb-8">
                    <div class="flex justify-between items-center bg-gray-50 p-4 rounded-xl custom-border">
                        <span class="text-[#093e5e] font-medium">ID Transacción:</span>
                        <span class="bg-[#1a1d23] text-white py-2 px-4 rounded-lg font-mono text-sm">
                                {{ Str::random(16) }}
                            </span>
                    </div>
                </div>

                <!-- Detalles de la Rifa -->
                <div class="mb-8">
                    <h3 class="text-xl font-bold text-[#1a1d23] mb-4 flex items-center">
                        <i class="fas fa-ticket-alt mr-3 text-[#34a85a]"></i>
                        Detalles de la Rifa
                    </h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="p-4 bg-gray-50 rounded-xl custom-border">
                            <p class="text-sm text-[#2f4f4f] mb-1">Número de Rifa</p>
                            <p class="text-xl font-bold text-[#1a1d23]">#{{ $raffleEntry->raffle->id }}</p>
                        </div>
                        <div class="p-4 bg-gray-50 rounded-xl custom-border">
                            <p class="text-sm text-[#2f4f4f] mb-1">Número Seleccionado</p>
                            <p class="text-xl font-bold text-[#1a1d23]">{{ $raffleEntry->number }}</p>
                        </div>
                        <div class="p-4 bg-gray-50 rounded-xl custom-border">
                            <p class="text-sm text-[#2f4f4f] mb-1">Tipo</p>
                            <p class="text-xl font-bold text-[#1a1d23]">{{ ucfirst($raffleEntry->type) }}</p>
                        </div>
                        <div class="p-4 bg-gray-50 rounded-xl custom-border">
                            <p class="text-sm text-[#2f4f4f] mb-1">Monto Pagado</p>
                            <p class="text-xl font-bold text-[#34a85a]">
                                ${{ number_format($raffleEntry->type === 'ticket' ? $raffleEntry->price : $raffleEntry->bet_amount, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Información del Comprador -->
                <div class="mb-8">
                    <h3 class="text-xl font-bold text-[#1a1d23] mb-4 flex items-center">
                        <i class="fas fa-user mr-3 text-[#34a85a]"></i>
                        Información del Comprador
                    </h3>
                    <div class="p-6 bg-gray-50 rounded-xl custom-border">
                        <div class="grid grid-cols-2 gap-6">
                            <div>
                                <p class="text-sm text-[#2f4f4f] mb-1">Nombre</p>
                                <p class="text-lg font-semibold text-[#1a1d23]">{{ Auth::user()->name }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-[#2f4f4f] mb-1">Email</p>
                                <p class="text-lg font-semibold text-[#1a1d23]">{{ Auth::user()->email }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Botones de Acción -->
                <div class="space-y-4">
                    <button class="w-full bg-[#34a85a] hover:bg-[#2d9550] text-success font-bold py-4 px-6 rounded-xl transition-all duration-300 shine-effect">
                        <i class="fas fa-download mr-2"></i>
                        Descargar Comprobante
                    </button>
                    <button class="w-full bg-[#1a1d23] hover:bg-[#093e5e] text-success font-bold py-4 px-6 rounded-xl transition-all duration-300">

                        <a href="{{ route('raffles.index') }}" class="w-full bg-[#1a1d23] hover:bg-[#093e5e] text-success font-bold py-4 px-6 rounded-xl transition-all duration-300 text-center block">
                            Volver al Inicio
                        </a>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mensaje Flotante -->
        <div class="mt-8 text-center">
            <div class="inline-block bg-white/10 backdrop-blur-md rounded-xl p-6 floating">
                <p class="text-white flex items-center justify-center">
                    <i class="fas fa-envelope mr-2 text-[#34a85a]"></i>
                    Se ha enviado un comprobante a tu correo electrónico
                </p>
            </div>
        </div>
    </div>
</div>

<script>
    // Efectos adicionales
    document.addEventListener('DOMContentLoaded', function() {
        // Añadir efecto de hover a las tarjetas
        const cards = document.querySelectorAll('.custom-border');
        cards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.borderColor = '#34a85a';
                this.style.transform = 'translateY(-2px)';
                this.style.transition = 'all 0.3s ease';
            });
            card.addEventListener('mouseleave', function() {
                this.style.borderColor = 'rgba(52, 168, 90, 0.1)';
                this.style.transform = 'translateY(0)';
            });
        });
    });
</script>
</body>
</html>
