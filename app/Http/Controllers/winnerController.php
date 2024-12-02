<?php

namespace App\Http\Controllers;

use App\Models\RaffleEntries;
use App\Models\Winner;
use Illuminate\Support\Facades\Http;

class winnerController extends Controller
{

    public function showWinner()
    {
        $winners = [];
        $pastWinners = Winner::orderBy('lottery_date', 'desc')->get();
        $apiUrl = "https://api-resultadosloterias.com/api/results";

        try {
            // Consumir la API
            $response = Http::get($apiUrl);

            if ($response->failed() || !isset($response->json()['data'])) {
                return view('lottery.winner', [
                    'error' => 'No se pudieron obtener los resultados de la lotería.',
                    'pastWinners' => $pastWinners
                ]);
            }

            $lotteryResults = $response->json()['data'];
        } catch (\Exception $e) {
            return view('lottery.winner', [
                'error' => 'Hubo un problema al obtener la información. Por favor, intenta más tarde.',
                'pastWinners' => $pastWinners
            ]);
        }

        // Obtener entradas con relación de usuario
        $entries = RaffleEntries::with('user')->select('id', 'number')->get();

        foreach ($lotteryResults as $lottery) {
            $lastThreeDigits = substr($lottery['result'], -3);

            foreach ($entries as $entry) {
                if ($entry->number === $lastThreeDigits) {
                    $winnerName = $entry->user->name;

                    // Evitar duplicados
                    $existingWinner = Winner::where('winning_number', $lastThreeDigits)
                        ->where('lottery_date', $lottery['date'])
                        ->first();

                    if (!$existingWinner) {
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
        }

        return view('lottery.winner', [
            'winner' => $winners,
            'pastWinners' => $pastWinners,
            'message' => empty($winners) ? 'No hubo ganadores en esta ocasión.' : null
        ]);
    }
}
