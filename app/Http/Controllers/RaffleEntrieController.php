<?php

namespace App\Http\Controllers;

use App\Models\Raffle;
use App\Models\RaffleEntries;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RaffleEntrieController extends Controller
{



    public function create()
    {
        //
    }

    /**


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    private function generateRandomNumber()
    {
        do {
            $randomNumber = random_int(100, 999);
        } while (RaffleEntries::where('number', $randomNumber)->exists());

        return $randomNumber;
    }

    public function store(Request $request, Raffle $raffle)
    {
        try {
            // Validar la solicitud, sin requerir 'id' inmediatamente
            $validated = $request->validate([
                'id' => 'nullable|integer|min:100|max:999', // Hacer 'id' opcional y entre 100 y 999
                'bet_amount' => $raffle->type === 'bet' ? 'required|numeric|min:' . $raffle->minimum_bet : 'nullable',
            ]);

            // Verificar si se proporcionó 'id', si no, generar un número aleatorio de 3 cifras
            $ticketNumber = $validated['number'] ?? $this->generateUniqueTicketNumber($raffle);

            // Verificar si el número de ticket ya está reservado o pagado
            $existingTicket = RaffleEntries::where('raffle_id', $raffle->id)
                ->where('number', $ticketNumber)
                ->whereIn('status', ['reserved', 'paid'])
                ->first();

            if ($existingTicket) {
                return response()->json([
                    'success' => false,
                    'message' => 'Este número de ticket ya está reservado'
                ], 422);
            }

            // Iniciar la transacción en la base de datos
            DB::beginTransaction();

            try {
                // Crear una reserva temporal de ticket
                $entry = RaffleEntries::create([
                    'raffle_id' => $raffle->id,
                    'user_id' => auth()->id(),
                    'number' => $ticketNumber,
                    'bet_amount' => $raffle->type === 'bet' ? $validated['bet_amount'] : $raffle->ticket_price,
                    'status' => 'reserved',
                    'reservation_expires_at' => now()->addMinutes(15), // Dar 15 minutos para completar el pago
                ]);

                // Actualizar el total de la bolsa de apuestas si es una rifa de tipo apuesta
                if ($raffle->type === 'bet') {
                    $raffle->increment('total_bet_pool', $validated['bet_amount']);
                }

                DB::commit();

                // Redirigir al portal de pago
                return $this->redirectToPaymentGateway($entry);

            } catch (Exception $e) {
                DB::rollBack();
                throw $e;
            }
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al procesar la solicitud: ' . $e->getMessage()
            ], 500);
        }
    }

    private function processBetEntry(Raffle $raffle, Request $request, $ticketNumber)
    {
        $betAmount = $request->input('bet_amount');

        if (!$betAmount || $betAmount < $raffle->minimum_bet) {
            return redirect()->back()
                ->with('error', "La apuesta mínima es de $" . number_format($raffle->minimum_bet, 2));
        }

        $entry = RaffleEntries::create([
            'raffle_id' => $raffle->id,
            'user_id' => auth()->id(),
            'ticket_number' => $ticketNumber,
            'type' => 'bet',
            'price' => $betAmount,
            'status' => 'pending',
            'payment_method' => null,
            'payment_status' => 'pending',
        ]);

        $raffle->increment('total_bet_pool', $betAmount);

        return $this->redirectToPayment($entry);
    }

    private function processTicketEntry(Raffle $raffle, $ticketNumber)
    {
        $entry = RaffleEntries::create([
            'raffle_id' => $raffle->id,
            'user_id' => auth()->id(),
            'ticket_number' => $ticketNumber,
            'type' => 'ticket',
            'price' => $raffle->ticket_price,
            'status' => 'pending',
            'payment_method' => null,
            'payment_status' => 'pending',
        ]);

        $raffle->increment('total_tickets_sold');

        return $this->redirectToPayment($entry);
    }

    private function redirectToPayment($entry)
    {
        return redirect()->route('payments.process', [
            'entry' => $entry->id,
            'amount' => $entry->price,
            'type' => $entry->type,
        ])->with('success', 'Por favor complete el pago para confirmar su ' .
            ($entry->type === 'bet' ? 'apuesta' : 'boleto'));
    }

    public function index(Raffle $raffle)
    {
        $entries = RaffleEntries::where('raffle_id', $raffle->id)
            ->with(['user'])
            ->paginate(20);

        return view('raffles.entries.index', compact('raffle', 'entries'));
    }

//    public function show(RaffleEntries $entry)
//    {
//        return view('raffle.entries.show', compact('entry'));
//    }

    public function show(Raffle $raffle)
    {
        return view('raffleEntries.show', compact('raffle'));
    }
}
