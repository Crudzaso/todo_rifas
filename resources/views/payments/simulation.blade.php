<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
</head>
<body>

<div class="container mx-auto px-4 py-8">
    <div class="max-w-md mx-auto bg-white rounded-lg shadow-md p-6">
        <h2 class="text-2xl font-bold mb-6 text-center">Simulación de Pago</h2>

        <div class="mb-6">
            <h3 class="text-lg font-semibold mb-2">Detalles de la Rifa</h3>
            <div class="border-t border-gray-200 py-4">
                <div class="flex justify-between mb-2">
                    <span>Rifa:</span>
                    <span class="font-medium">#{{ $raffleEntry->raffle->id }}</span>
                </div>
                <div class="flex justify-between mb-2">
                    <span>Número:</span>
                    <span class="font-medium">{{ $raffleEntry->number }}</span>
                </div>
                <div class="flex justify-between mb-2">
                    <span>Tipo:</span>
                    <span class="font-medium">{{ ucfirst($raffleEntry->type) }}</span>
                </div>
                <div class="flex justify-between mb-2">
                    <span>Precio:</span>
                    <span class="font-medium">
                        ${{ number_format($raffleEntry->type === 'ticket' ? $raffleEntry->price : $raffleEntry->bet_amount, 0, ',', '.') }}
                    </span>
                </div>
            </div>
        </div>

        <div class="mb-6">
            <h3 class="text-lg font-semibold mb-2">Datos del Comprador</h3>
            <div class="border-t border-gray-200 py-4">
                <div class="flex justify-between mb-2">
                    <span>Nombre:</span>
                    <span class="font-medium">{{ $user->name }}</span>
                </div>
                <div class="flex justify-between mb-2">
                    <span>Email:</span>
                    <span class="font-medium">{{ $user->email }}</span>
                </div>
            </div>
        </div>

        <form action="{{ route('payment.simulation.process', $raffleEntry) }}" method="POST">
            @csrf
            <button type="submit"
                    class="w-full bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-4 rounded-lg">
                Simular Pago
            </button>
        </form>

        <div class="mt-4 text-center text-sm text-gray-500">
            <p>Esta es una simulación de pago para propósitos de prueba</p>
        </div>
    </div>
</div>
</body>
</html>
