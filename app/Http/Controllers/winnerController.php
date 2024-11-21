<?php

namespace App\Http\Controllers;

use App\Models\RaffleEntries;
use App\Models\Winner;
use Illuminate\Support\Facades\Http;

class winnerController extends Controller
{

    public function showWinner()
    {
        // Definir $winners y $pastWinners al inicio del método
        $winners = [];
        $pastWinners = Winner::orderBy('lottery_date', 'desc')->get();

        // 1. Consumir la API de loterías
        $apiUrl = "https://api-resultadosloterias.com/api/results";
        $response = Http::get($apiUrl);

        if ($response->failed()) {
            return view('lottery.winner', [
                'error' => 'No se pudieron obtener los resultados de la lotería.',
                'pastWinners' => $pastWinners // Incluir pastWinners incluso en caso de error
            ]);
        }

        // Decodificar la respuesta JSON
        $lotteryResults = $response->json()['data'];

        // 2. Obtener números de los participantes registrados
        $entries = RaffleEntries::select('id', 'number')->get();

        // 3. Comparar las últimas tres cifras del resultado con los números registrados
        foreach ($lotteryResults as $lottery) {
            $lastThreeDigits = substr($lottery['result'], -3);

            foreach ($entries as $entry) {
                if ($entry->number === $lastThreeDigits) {
                    $winnerName = $entry->user->name;
                    Winner::create([
                        'participant_name' => $winnerName,
                        'lottery' => $lottery['lottery'],
                        'winning_number' => $lastThreeDigits,
                        'lottery_date' => $lottery['date'],
                    ]);

                    $winners[] = [
                        'participant_name' => $winnerName,
                        'lottery' => $lottery['lottery'],
                        'winning_number' => $lastThreeDigits,
                    ];
                }
            }
        }

        // Retornar la vista con ambas variables
        return view('lottery.winner', [
            'winner' => $winners,
            'pastWinners' => $pastWinners
        ]);
    }
}
