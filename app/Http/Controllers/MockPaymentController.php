<?php

namespace App\Http\Controllers;

use App\Models\RaffleEntries;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MockPaymentController extends Controller
{

    public function processSimulatedPayment(Request $request, RaffleEntries $raffleEntry)
    {
        try {
            DB::beginTransaction();

            if ($raffleEntry->status !== 'reserved' || $raffleEntry->user_id !== Auth::id()) {
                throw new \Exception('Entrada no válida para pago.');
            }

            // Obtener la rifa asociada
            $raffle = $raffleEntry->raffle;

            if ($raffle->type === 'bet') {
                $raffle->increment('total_bet_pool', $raffleEntry->bet_amount);
            }

            // Si la rifa es de tipo 'ticket', decrementar los boletos disponibles
            if ($raffle->tickets_count > 0) {
                $raffle->decrement('tickets_count', 1);
            }

            $raffleEntry->update([
                'status' => 'paid',
            ]);


            DB::commit();

            return redirect()->route('payment.simulation.success', $raffleEntry)
                ->with('payments.success', '¡Pago simulado exitoso!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error al procesar el pago simulado: ' . $e->getMessage());
        }
    }


    public function simulationSuccess(RaffleEntries $raffleEntry)
    {
        if ($raffleEntry->status !== 'paid') {
            return redirect()->route('auth.login')->with('error', 'Transacción no encontrada.');
        }

        return view('payments.success', [
            'raffleEntry' => $raffleEntry
        ]);
    }
}
