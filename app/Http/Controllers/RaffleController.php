<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestRaffle;
use App\Models\Raffle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class RaffleController extends Controller
{


    private function getAvailableLotteries()
    {
        try {
            // Realiza la solicitud con un tiempo de espera de 10 segundos y 3 reintentos
            $response = Http::retry(3, 100) // Reintenta 3 veces con 100ms de retraso
            ->timeout(10)   // Tiempo de espera de 10 segundos
            ->get('https://api-resultadosloterias.com/api/lotteries');

            // Verifica si la respuesta fue exitosa y contiene datos
            if ($response->successful() && isset($response['data'])) {
                return collect($response['data'])->pluck('name');
            }

            // Registra un error si la respuesta no es exitosa
            \Log::warning('API response was not successful: ' . $response->body());
            return [];
        } catch (\Exception $e) {
            // Captura cualquier error relacionado con la conexión o la solicitud
            \Log::error('Error connecting to API: ' . $e->getMessage());
            return [];
        }
    }
    public function index()
    {
        $raffles = Raffle::with(['entries'])->get();
        return view('Raffles.index', compact('raffles'));
    }

    public function create()
    {
        $availableLotteries = collect($this->getAvailableLotteries()); // Convertir a colección
        $noLotteriesMessage = $availableLotteries->isEmpty()
            ? 'No hay loterías disponibles en este momento.'
            : null;
        return view('Raffles.create', compact('availableLotteries','noLotteriesMessage'));
    }

    public function store(RequestRaffle $request)


    {
        $userId = Auth::id();
        if (!$userId) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión.');
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
                ->with('success.blade.php', 'Rifa creada exitosamente');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Error al crear la rifa: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function show(Raffle $raffle)
    {


        return view('raffleEntries.index', compact('raffle'));
    }


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
        return redirect()->route('raffles.index')->with('success.blade.php', 'Rifa actualizada con éxito');
    }

    public function destroy(Raffle $raffle)
    {
        if ($raffle->raffle_date > now()) {
            return redirect()->route('raffles.index')->with('error', 'No se puede eliminar la rifa porque aún no ha ocurrido.');
        }

        if ($raffle->entries()->exists()) {
            return redirect()->route('raffles.index')->with('error', 'No se puede eliminar la rifa porque ya tiene boletos comprados.');
        }

        $raffle->delete();

        return redirect()->route('raffles.index')->with('success.blade.php', 'Rifa eliminada correctamente');
    }
}
