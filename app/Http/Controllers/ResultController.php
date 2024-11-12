<?php

// app/Http/Controllers/ResultController.php
namespace App\Http\Controllers;

use App\Models\Raffle;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    public function index()
    {
        $results = Raffle::with('winner')->where('status', 'completed')->get();
        return view('results.index', compact('results'));
    }
}
