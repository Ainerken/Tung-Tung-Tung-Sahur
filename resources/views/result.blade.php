<!DOCTYPE html>
<html>
<head>
    <title>Result</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>body { background: #121212; color: white; display: flex; align-items: center; justify-content: center; height: 100vh; }</style>
</head>
<body>
    <div class="text-center">
        <h1>GAME SELESAI!</h1>
        <!-- Gunakan variabel $currentScore yang dikirim dari route -->
        <h2 class="my-4">Skor Kumulatif: <span class="text-warning">{{ $currentScore }}</span></h2>
        <a href="/" class="btn btn-primary btn-lg">KEMBALI KE MENU</a>
    </div>
</body>
</html>