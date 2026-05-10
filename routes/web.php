<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameController;

Route::middleware(['web'])->group(function () {
    Route::get('/play/{difficulty}', [GameController::class, 'play']);
    Route::get('/finish', [GameController::class, 'finish']); // Route baru
    Route::get('/result', function () {
        // 1. Ambil skor sesi barusan
        $lastSessionScore = session('last_session_score', 0);
        
        // 2. Hitung total kumulatif dari database untuk "Player Saat Ini"
        // Logikanya: Kita ambil semua history sampai tombol Reset ditekan
        $totalKumulatif = \App\Models\PlayerScore::sum('score'); 
        
        return view('result', compact('lastSessionScore', 'totalKumulatif'));
    });

    Route::get('/', function () {
        $totalKumulatif = \App\Models\PlayerScore::sum('score');
        return view('welcome', compact('totalKumulatif'));
    });
    Route::get('/reset', function () {
        session()->forget('total_player_score');
        session()->forget('last_game_score');
        return redirect('/');
    });
    Route::get('/admin/scores', function () {
        $history = \App\Models\PlayerScore::latest()->get();
        return view('admin', compact('history'));
    });
    Route::get('/sync-images', function () {
        // 1. Hapus hanya data karakter, JANGAN hapus data skor
        \App\Models\Karakter::truncate();
        
        // 2. Jalankan ulang seeder karakter
        \Artisan::call('db:seed --class=KarakterSeeder');
        
        return "Data karakter berhasil diperbarui tanpa menghapus history skor!";
    });
    Route::get('/save-player', function () {
        $total = session('total_player_score', 0);
        
        // Simpan total kumulatif ini ke database sebagai 1 record player
        \App\Models\PlayerScore::create(['score' => $total]);
        
        // Setelah disimpan, reset session untuk player berikutnya
        session()->forget('total_player_score');
        session()->forget('last_game_score');
        
        return redirect('/');
    });
});