<?php

namespace App\Http\Controllers;

use App\Models\Karakter;
use App\Models\PlayerScore; // Pastikan ini ada
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function play($difficulty)
    {
        $karakters = Karakter::where('difficulty', $difficulty)
                            ->inRandomOrder()
                            ->limit(5)
                            ->get();

        return view('game', compact('karakters'));
    } // <-- JANGAN LUPA INI (Penutup fungsi play)

    public function finish(Request $request)
    {
        // $finalScore sudah mencakup total kumulatif + poin sesi ini
        $finalScore = (int)$request->query('score');
        
        // 1. Simpan total akhir ke database (sebagai catatan akhir sesi)
        PlayerScore::create(['score' => $finalScore]);
        
        // 2. Update session agar saat main lagi nilainya sudah kumulatif
        session(['total_score' => $finalScore]);
        
        return redirect('/result');
    }
} // <-- JANGAN LUPA INI (Penutup Class GameController)