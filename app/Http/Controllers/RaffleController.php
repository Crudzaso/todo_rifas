<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestRaffle;
use App\Models\Raffle;

use App\Models\RaffleEntries;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class RaffleController extends Controller
{
    private function getAvailableLotteries()
    {
        $response = Http::get('https://api-resultadosloterias.com/api/lotteries');

        if ($response->successful() && isset($response['data'])) {
            return collect($response['data'])->pluck('name');
        }

        return [];
    }

    public function index()
    {
        $raffles = Raffle::with(['entries'])->get();
        return view('Raffles.index', compact('raffles'));
    }

    public function create()
    {
        $availableLotteries = $this->getAvailableLotteries();
        return view('Raffles.create', compact('availableLotteries'));
    }

    public function store(RequestRaffle $request)
    {
        try {
            $validatedData = $request->validated();

            if (Raffle::where('user_id', Auth::id())->count() >= 50) {
                return redirect()
                    ->back()
                    ->with('error', 'Has alcanzado el límite máximo de 50 rifas.')
                    ->withInput();
            }

            if ($validatedData['tickets_count'] > 100) {
                return redirect()
                    ->back()
                    ->withErrors(['tickets_count' => 'El número máximo de participantes es 100.'])
                    ->withInput();
            }

            if ($validatedData['type'] === 'ticket' && !isset($validatedData['ticket_price'])) {
                return redirect()
                    ->back()
                    ->withErrors(['ticket_price' => 'El precio del boleto es requerido para rifas tipo ticket'])
                    ->withInput();
            }

            $raffleData = [
                'name' => $validatedData['name'],
                'description' => $validatedData['description'],
                'lottery' => $validatedData['lottery'],
                'active' => $validatedData['active'] ?? true,
                'type' => $validatedData['type'],
                'raffle_date' => $validatedData['raffle_date'],
                'tickets_count' => $validatedData['tickets_count'],
                'available_count' => $validatedData['tickets_count'],
                'user_id' => Auth::id(),
                'ticket_price' => $validatedData['type'] === 'ticket' ? $validatedData['ticket_price'] : null
            ];



            DB::transaction(function() use ($raffleData) {
                Raffle::create($raffleData);
            });

            return redirect()
                ->route('raffles.index')
                ->with('success', 'Rifa creada exitosamente');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Error al crear la rifa: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function show(Raffle $raffle)
    {
        $totalBetPool = 0;
        if ($raffle->type == 'bet') {
            // Sumar todas las apuestas realizadas
            $totalBetPool = RaffleEntries::where('raffle_id', $raffle->id)
                ->sum('bet_amount');
        }
        return view('raffleEntries.show', compact('raffle', 'totalBetPool'));
    }

    public function edit(Raffle $raffle)
    {
        $availableLotteries = $this->getAvailableLotteries();
        return view('Raffles.edit', compact('raffle', 'availableLotteries'));
    }

    public function update(RequestRaffle $request, Raffle $raffle)
    {
        // Implementar lógica de actualización
    }

    public function destroy(Raffle $raffle)
    {
        // Implementar lógica de eliminación
    }
}
