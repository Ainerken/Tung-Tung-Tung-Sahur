<?php

namespace App\Http\Controllers;

use App\Models\Karakter;
use App\Models\PlayerScore; // Pastikan ini ada
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function play($difficulty)
    {
        // Memastikan 5 karakter yang diambil adalah unik
        $karakters = Karakter::where('difficulty', $difficulty)
                            ->inRandomOrder()
                            ->limit(5)
                            ->get();

        return view('game', compact('karakters'));
    }

    public function finish(Request $request)
    {
        $pointsGameIni = (int)$request->query('score');
        
        // Tambahkan ke session total akumulasi player saat ini
        $currentTotal = session('total_player_score', 0);
        session(['total_player_score' => $currentTotal + $pointsGameIni]);
        session(['last_game_score' => $pointsGameIni]);
        
        return redirect('/result');
    }
} // <-- JANGAN LUPA INI (Penutup Class GameController)