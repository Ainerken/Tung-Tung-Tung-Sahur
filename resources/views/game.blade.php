<!DOCTYPE html>
<html>
<head>
    <title>Anime Guessing Game</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #121212; color: white; display: flex; flex-direction: column; align-items: center; justify-content: center; height: 100vh; font-family: sans-serif; }
        .game-card { width: 800px; text-align: center; }
        .img-container { height: 550px; background: #000; border: 3px solid #333; display: flex; align-items: center; justify-content: center; margin-bottom: 20px; }
        .img-container img { max-height: 100%; max-width: 100%; object-fit: contain; }
        #reveal-area { margin-bottom: 20px; }
        .btn-lg { width: 200px; font-weight: bold; }
    </style>
</head>
<body>

    <div class="game-card">
        <div class="mb-3">
            <h2 class="text-danger">Waktu: <span id="timer">15</span></h2>
        </div>
        <div class="img-container">
            <img id="char-img" src="" alt="Karakter">
        </div>
        
        <div id="reveal-area" style="opacity: 0;">
            <h1 id="char-name" class="display-4 text-warning"></h1>
            <h3 id="anime-name" class="text-light"></h3>
        </div>

        <div id="control-area" class="mt-4">
            <!-- Tombol untuk proses penilian -->
            <button id="btn-benar" onclick="processAnswer(true)" class="btn btn-success btn-lg">BENAR</button>
            <button id="btn-salah" onclick="processAnswer(false)" class="btn btn-danger btn-lg">SALAH</button>
            
            <!-- Tombol untuk lanjut (tersembunyi sampai sudah reveal) -->
            <button id="btn-next" onclick="next()" class="btn btn-primary btn-lg" style="display:none">NEXT</button>
            <!-- Tambahkan di bawah div control-area -->
            <div class="mt-4">
                <a href="/" class="btn btn-outline-secondary btn-sm">Kembali ke Menu</a>
            </div>
        </div>
        
        <p class="mt-3 text-muted">Skor: <span id="score">0</span></p>
    </div>

    <script>
        const characters = @json($karakters);
        let currentIndex = 0;
        
        // AMBIL SKOR DARI SESSION LARAVEL SEBAGAI NILAI AWAL
        let score = {{ session('total_score', 0) }}; 
        
        // Tampilkan skor awal di UI
        document.getElementById('score').innerText = score;

        let timeLeft = 15;
        let timerInterval;

        function startTimer() {
            timeLeft = 15;
            document.getElementById('timer').innerText = timeLeft;
            
            timerInterval = setInterval(() => {
                timeLeft--;
                document.getElementById('timer').innerText = timeLeft;
                if (timeLeft <= 0) {
                    clearInterval(timerInterval);
                    processAnswer(false);
                }
            }, 1000);
        }

        function loadChar() {
            document.getElementById('char-img').src = '/' + characters[currentIndex].file_path;
            document.getElementById('char-name').innerText = characters[currentIndex].nama_karakter;
            document.getElementById('anime-name').innerText = characters[currentIndex].nama_anime;
            
            document.getElementById('reveal-area').style.opacity = '0';
            document.getElementById('btn-benar').style.display = 'inline-block';
            document.getElementById('btn-salah').style.display = 'inline-block';
            document.getElementById('btn-next').style.display = 'none';
            
            startTimer();
        }

        function processAnswer(isCorrect) {
            clearInterval(timerInterval);
            document.getElementById('reveal-area').style.opacity = '1';
            
            if(isCorrect) {
                score += 10; // Menambah nilai variabel score yang sudah berisi total kumulatif
            }
            
            // Tampilkan score yang sudah bertambah
            document.getElementById('score').innerText = score;

            document.getElementById('btn-benar').style.display = 'none';
            document.getElementById('btn-salah').style.display = 'none';
            document.getElementById('btn-next').style.display = 'inline-block';
        }

        function next() {
            currentIndex++;
            if (currentIndex < characters.length) {
                loadChar();
            } else {
                // KIRIM TOTAL SKOR TERAKHIR KE CONTROLLER
                window.location.href = "/finish?score=" + score;
            }
        }

        loadChar();
    </script>
</body>
</html>