<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameController;

Route::middleware(['web'])->group(function () {
    Route::get('/', function () { return view('welcome'); });
    Route::get('/play/{difficulty}', [GameController::class, 'play']);
    Route::get('/finish', [GameController::class, 'finish']); // Route baru
    Route::get('/result', function () {
        // Kita panggil 'total_score' agar sinkron dengan yang di Controller
        $currentScore = session('total_score', 0); 
        return view('result', compact('currentScore'));
    });
    Route::get('/reset', function () {
        session()->forget('total_score'); // Menghapus total skor
        return redirect('/');
    });
    Route::get('/admin/scores', function () {
        $history = \App\Models\PlayerScore::latest()->get();
        return view('admin', compact('history'));
    });
});