<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestRaffle;
use App\Models\Raffle;
use App\Models\RaffleEntries;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class RaffleController extends Controller
{


    private function getAvailableLotteries()
    {
        $response = Http::get('https://api-resultadosloterias.com/api/lotteries');

        if ($response->successful() && isset($response['data'])) {
            return collect($response['data'])
                ->filter(function ($lottery) {
                    return stripos($lottery['name'], 'ANTIOQUEÑITA') !== false ||
                        stripos($lottery['name'], 'PAISITA') !== false ||
                        stripos($lottery['name'], 'MEDELLIN') !== false;
                })
                ->pluck('name');
        }

        return collect();
    }

    /**
     * se muestran todas las rifas creadas
    */
    public function index()
    {
        $raffles = Raffle::with(['entries'])->get();
        return view('Raffles.index', compact('raffles'));
    }

    /**
     * se muestra un panel para crear una rifa
    */
    public function create()
    {
        $availableLotteries = $this->getAvailableLotteries();
        return view('Raffles.create', compact('availableLotteries'));
    }


    /**
     * metodo para crear una rifa
    */
    public function store(RequestRaffle $request)


    {
        $userId = Auth::id();
        if (!$userId) {
            return redirect()->route('auth')->with('error', 'Debes iniciar sesión.');
        }


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
                'ticket_price' => $validatedData['type'] === 'ticket' ? ($validatedData['ticket_price'] ?? 0.00) : 0.00
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

    /**
     * este metodo lleva al panel de boletos para comprar
     * o reservar un boleto
    */
    public function show(Raffle $raffle)

    {
        return view('raffleEntries.show', compact('raffle'));
    }

    /**
     * Metodo para actualizar una rifa
     * se puede actualizar el nombre y la descripcion de una rifa
     * no redirige a la vida de edit
     * porque se abre un modal
    */

    public function update(Request $request, $id)
    {
        /**
         * Este fragmento de codigo se encarda de validar los datos
         * que entraran inicialmente a través del request
        */
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000', // Solo texto
        ]);

        /**
         * buscar la rifa y actualizar los datos
        */
        $raffle = Raffle::findOrFail($id);
        $raffle->update([
            'name' => $request->name,
            'description' => $request->description, // Solo se actualiza la descripción
        ]);

        /**
         * redirigir a la vista de apuestas
        */
        return redirect()->route('raffles.index')->with('success', 'Rifa actualizada con éxito');
    }

    /**
     * este metodo borra una rifa siempre y cuando la rifa haya jugado
     * No tenga boletos comprados
     * a menos que el atributo active sea igual a false
    */

    public function destroy(Raffle $raffle)
    {
        if ($raffle->raffle_date > now()) {
            return redirect()->route('raffles.index')->with('error', 'No se puede eliminar la rifa porque aún no ha ocurrido.');
        }

        if ($raffle->entries()->exists()&& $raffle->active) {
            return redirect()->route('raffles.index')->with('error', 'No se puede eliminar la rifa porque ya tiene boletos comprados.');
        }

        $raffle->delete();

        return redirect()->route('raffles.index')->with('success', 'Rifa eliminada correctamente');
    }

    /**
     * Este metodo obtiene el resultado de los ganadores de rifa
     * Basandose en lerias de antioquia
     * filtra las loteria de antioquia por fecha
     * obtenemos las que juegan hoy
     * obtenemos el resultalto de la loteria a través de la api
     * si se obtiene un resultado extraemos los 3 ultimos digiros
     * lo comparamos con el number de l boleto del usuario
     * cambia el atributo active a false
    */

    public function getWinner()
    {
        $today = Carbon::today();

        $rafflesToday = Raffle::whereDate('raffle_date', $today)->get();

        $winners = [];

        foreach ($rafflesToday as $raffle) {

            $lotteryResult = $this->getLotteryResult($raffle->lottery);

            if ($lotteryResult) {
                $lotteryResultLast3Digits = substr($lotteryResult, -3);

                $entries = RaffleEntries::where('raffle_id', $raffle->id)
//                    ->where('status', 'paid')
                    ->get();

                foreach ($entries as $entry) {
                    $userNumberLast3Digits = $entry->number;



                    if ($userNumberLast3Digits == $lotteryResultLast3Digits) {

                        $user = $entry->user;


                        $prize = null;
                        if ($raffle->type === 'bet') {
                            $prize = $raffle->total_bet_pool;
                        } else if ($raffle->type === 'ticket') {
                            $prize = $raffle->description;
                        }
                        $winners[] = [
                            'raffle_name' => $raffle->lottery,
                            'raffle_date' => $raffle->raffle_date,
                            'winning_number' => $lotteryResult,
                            'user_number' => $entry->number,
                            'user_id' => $entry->user_id,
                            'user_name'=> $user->name,
                            'prize'=> $prize,
                        ];

                        $raffle->update(['active' => false]);

                    }
                }
            }
        }

        return $winners;
    }

/**
 * Este metodo sirve para filtrar los resultados de la loteria
 * haciendo una consula a la api
 * directamente al enpoint que devuelve los resultados
 * filtramos por rifas de antioquia
 * que inicien por esos nombres
 * el metodo recibe un nombre para comparar
*/

    public function getLotteryResult($lotteryName)
    {
        $lotteriesOfInterest = ['ANTIOQUEÑITA', 'PAISITA', 'MEDELLIN'];

        $response = Http::get('https://api-resultadosloterias.com/api/results');

        if ($response->successful() && isset($response['data'])) {
            $lotteryData = collect($response['data'])->firstWhere(function ($item) use ($lotteriesOfInterest) {
                return collect($lotteriesOfInterest)->contains(fn($lottery) => strpos($item['lottery'], $lottery) === 0);
            });

            if ($lotteryData) {
                return $lotteryData['result'];
            }
        }

        return null;
    }

/**
 * Este metodo sirve para pasar los resultados
 * a la vista de resultados
*/

    public function showWinners()
    {
        $winners = $this->getWinner();

        // Pasar los datos de los ganadores a la vista 'winners'
        return view('Raffles.winners', ['winners' => $winners]);
    }


    public function showOrganizersRaffles(User $user)
    {
        $raffles = Raffle::where('user_id', $user->id)->with('entries')->get();

        $rafflesWithStats = $raffles->map(function ($raffle) {
            $raffle->potential_gain = $raffle->getPotentialGain();
            $raffle->actual_gain = $raffle->getActualGain();
            return $raffle;
        });

        return view('organizer.raffles', compact('rafflesWithStats'));
    }

    public function showLandingPage()
    {
        $winners = $this->getWinner();
        return view('welcome', ['winners' => $winners]);
    }



}
