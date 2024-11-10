<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestRaffle;
use App\Models\Raffle;
use App\Models\RaffleEntries;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

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
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $raffles = Raffle::all();
        return view('Raffles.index', compact('raffles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $availableLotteries = $this->getAvailableLotteries();
        return view('Raffles.create', compact('availableLotteries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RequestRaffle $request)
    {
//        $validatedData = $request->validated();
//        dd($validatedData);
//        dd($request->all());
        $validatedData = $request->validated();

        $raffle = Raffle::create($request->only([
            'name',
            'description',
            'lottery',
            'active',
            'type',
            'raffle_date',
            'tickets_count',
            'ticket_price',
            'amount' => $validatedData['amount']
        ]));

        // Si la rifa es de tipo 'ticket', guarda el total de boletos disponibles
        if ($raffle->type === 'ticket') {
            $raffle->total_tickets_available = $validatedData['tickets_count'];
            $raffle->save();
        }

        // Si la rifa es de tipo 'bet', guarda los límites de apuesta, pero no crea una entrada en 'raffle_entries'
        elseif ($raffle->type === 'bet') {
            $raffle->min_bet = $validatedData['min_bet'];
            $raffle->max_bet = $validatedData['max_bet'];
            $raffle->save();

        }

        return redirect()->route('raffles.index')->with('success', 'Rifa creada exitosamente');
    }

    private function generateRandomNumber()
    {
        do {
            // Genera un número aleatorio entre 100 y 9999 (3 o 4 cifras)
            $randomNumber = random_int(100, 9999);
        } while (RaffleEntries::where('number', $randomNumber)->exists());

        return $randomNumber;
    }

    public function sellTicket(Raffle $raffle)
    {
        // Verificamos si la rifa está activa y si hay boletos disponibles
        if (!$raffle->active) {
            return redirect()->back()->with('error', 'Esta rifa no está activa.');
        }

        if ($raffle->total_tickets_sold >= $raffle->total_tickets_available) {
            return redirect()->back()->with('error', 'Ya se han vendido todos los boletos.');
        }

        // Generar un número de boleto único
        $ticketNumber = $this->generateRandomNumber($raffle);

        // Crear la entrada de boleto en la base de datos
        RaffleEntries::create([
            'raffle_id' => $raffle->id,
            'ticket_number' => $ticketNumber,
            'type' => 'ticket',
            'price' => $raffle->ticket_price,
        ]);

        // Incrementar el contador de boletos vendidos
        $raffle->total_tickets_sold++;
        $raffle->save();

        return redirect()->route('raffles.show', $raffle)->with('success', '¡Boleto vendido exitosamente!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Raffle $raffle)
    {
        $randomNumber = null;
        $totalBets = 0;

        if (request()->has('generate_random_number')) {
            $randomNumber = $this->generateRandomNumber();
        }

        if ($raffle->type === 'bet') {
            // Sumar todas las apuestas de tipo 'bet' asociadas a la rifa
            $totalBets = $raffle->entries->sum('bet_amount'); // Asumiendo que 'bet_amount' es el campo que guarda el valor de cada apuesta
        }

        // Pasar la rifa, el número aleatorio y la suma de apuestas a la vista
        return view('Raffles.show', compact('raffle', 'randomNumber', 'totalBets'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Raffle $raffle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Raffle $raffle)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Raffle $raffle)
    {
        //
    }
}
