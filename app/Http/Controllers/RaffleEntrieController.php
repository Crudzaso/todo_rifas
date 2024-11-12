<?php

namespace App\Http\Controllers;

use App\Models\Raffle;
use App\Models\RaffleEntries;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RaffleEntrieController extends Controller
{



    public function create()
    {
        //
    }



    public function store(Request $request)
    {
        $raffle = Raffle::findOrFail($request->input('raffle_id'));


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
            ];



            if ($raffle->type === 'bet') {
                // Para rifas de tipo 'bet'
                $entryData['bet_amount'] = $validated['bet_amount'];
            }
            if ($raffle->tickets_count > 0) {
                $raffle->decrement('tickets_count', 1);
            }


            else {
                // Para rifas de tipo 'ticket'
                $entryData['price'] = $raffle->ticket_price;
            }

            $entry = RaffleEntries::create($entryData);


            DB::commit();

            return $this->redirectToPaymentGateway($entry);

        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error al procesar la solicitud: ' . $e->getMessage()
            ], 500);
        }
    }


    public function index(Raffle $raffle)
    {
        $entries = RaffleEntries::where('raffle_id', $raffle->id)
            ->with(['user'])
            ->paginate(20);

        return view('raffles.entries.index', compact('raffle', 'entries'));
    }


    public function show(Raffle $raffle){


        return view('raffleEntries.show', compact('raffle',));
    }
}
