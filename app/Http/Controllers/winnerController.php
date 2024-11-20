<?php

namespace App\Http\Controllers;

use App\Models\RaffleEntries;
use Illuminate\Support\Facades\Http;

class winnerController extends Controller
{

    public function showWinner()
    {
        // 1. Consumir la API de loterías
        $apiUrl = "https://api-resultadosloterias.com/api/results";
        $response = Http::get($apiUrl);

        if ($response->failed()) {
            return view('lottery.winner', ['error' => 'No se pudieron obtener los resultados de la lotería.']);
        }

        // Decodificar la respuesta JSON
        $lotteryResults = $response->json()['data'];

        // 2. Obtener números de los participantes registrados
        $entries = RaffleEntries::select('id', 'number')->get();

        $winners = [];

        // 3. Comparar las últimas tres cifras del resultado con los números registrados
        foreach ($lotteryResults as $lottery) {
            $lastThreeDigits = substr($lottery['result'], -3);

            foreach ($entries as $entry) {
                if ($entry->number === $lastThreeDigits) {
                    $winners[] = [
                        'lottery' => $lottery['lottery'],
                        'winning_number' => $lastThreeDigits
                    ];
                }
            }
        }

        // 4. Retornar los datos a la vista
        return view('lottery.winner', ['winners' => $winners]);
    }
}
