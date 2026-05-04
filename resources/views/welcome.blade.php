<!DOCTYPE html>
<html>
<head>
    <title>Tebak Karakter Anime - Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #121212; color: white; display: flex; align-items: center; justify-content: center; height: 100vh; }
        .menu-card { text-align: center; padding: 50px; background: #1f1f1f; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.5); }
        .btn-diff { width: 250px; margin: 10px; font-weight: bold; padding: 15px; }
    </style>
</head>
<body>
    <div class="menu-card">
    <h1 class="mb-4">TEBAK KARAKTER ANIME</h1>
    <p class="text-secondary">Pilih Tingkat Kesulitan:</p>
    
    <!-- Container untuk tombol -->
    <div class="d-flex flex-column align-items-center gap-3 mt-4">
        <a href="/play/1" class="btn btn-success btn-diff">EASY</a>
        <a href="/play/2" class="btn btn-warning btn-diff">MEDIUM</a>
        <a href="/play/3" class="btn btn-danger btn-diff">HARD</a>
        <a href="/play/4" class="btn btn-dark btn-diff border border-light">IMPOSSIBLE</a>
    </div>

    <!-- Tombol Reset -->
    <div class="mt-4">
        <a href="/reset" class="btn btn-sm btn-outline-danger">Reset Session</a>
    </div>
</div>
</body>
</html>