<!DOCTYPE html>
<html>
<head>
    <title>Result</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>body { background: #121212; color: white; display: flex; align-items: center; justify-content: center; height: 100vh; }</style>
</head>
<body>
    <div class="text-center">
        <h1>Game Selesai!</h1>
        <h2 class="my-4">Skor Game Terakhir: {{ session('last_game_score', 0) }}</h2>
        <h3 class="text-warning">Total Skor Anda: {{ session('total_player_score', 0) }}</h3>
        
        <div class="mt-4">
        <!-- Arahkan ke Home agar player bisa pilih difficulty baru -->
        <a href="/" class="btn btn-success btn-lg">Main Game Lagi (Pilih Difficulty)</a>
        
        <!-- Tombol simpan tetap ada -->
        <a href="/save-player" class="btn btn-danger btn-lg">Selesai & Simpan Skor</a>
    </div>
    </div>
</body>
</html>