<?php

namespace App\Http\Controllers;

use App\Models\Raffle;
use App\Models\RaffleEntries;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RaffleEntrieController extends Controller
{






    public function store(Request $request)

    {

        if (!auth()->check()) {
            return redirect()->route('auth')->withErrors('Por favor, inicie sesión para continuar.');
        }
        /**
         * capturar el id de la rifa a través del request
        */
        $raffle = Raffle::findOrFail($request->input('raffle_id'));

        /**
         * a través del metodo valited, se verifica las siguientes condiciones
         * en los
        */

        try {
            $validated = $request->validate([
                'id' => 'required|integer|min:100|max:9999',
                'bet_amount' => $raffle->type === 'bet' ? 'required|numeric' : 'nullable',
            ]);

            $existingTicket = RaffleEntries::where('raffle_id', $raffle->id)
                ->where('number', (int) $validated['id'])
                ->whereIn('status', ['reserved', 'paid'])
                ->first();

            if ($existingTicket) {
                return redirect()
                    ->back()
                    ->withErrors('Este número de ticket ya está reservado')
                    ->withInput();
            }

            DB::beginTransaction();

            $entryData = [
                'raffle_id' => $raffle->id,
                'number' => $validated['id'],
                'status' => 'reserved',
                'type' => $raffle->type,
                'user_id' => Auth::id(),
            ];



            if ($raffle->type === 'bet') {
                // Para rifas de tipo 'bet'
                $entryData['bet_amount'] = $validated['bet_amount'];


            } else {
                // Para rifas de tipo 'ticket'
                $entryData['price'] = $raffle->ticket_price;
            }


            $entry = RaffleEntries::create($entryData);


            DB::commit();

            return $this->show($entry);

        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error al procesar la solicitud: ' . $e->getMessage()
            ], 500);
        }

    }


    public function show(RaffleEntries $raffleEntry)
    {
        // Verificar que la entrada esté pendiente de pago
        if ($raffleEntry->status !== 'reserved') {
            return redirect()->back()->with('error', 'Esta entrada no está disponible para pago.');
        }

        // Obtener el precio basado en el tipo de entrada
        $price = $raffleEntry->type === 'ticket' ? $raffleEntry->price : $raffleEntry->bet_amount;

        return view('raffleEntries.show', [
            'raffleEntry' => $raffleEntry,
            'price' => $price,
            'user' => Auth::user()
        ]);
    }




    public function index(Raffle $raffle){


        return view('raffleEntries.index', compact('raffle',));
    }
}
