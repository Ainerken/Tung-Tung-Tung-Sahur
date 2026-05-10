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
                /* Tambahkan ini ke CSS jika ingin skor melayang di pojok */
        .score-fixed {
            position: fixed;
            top: 20px;
            right: 20px;
            background: #000;
            padding: 25px 40px; /* Padding lebih besar */
            border: 3px solid #ffc107; /* Border lebih tebal */
            border-radius: 20px;
            z-index: 1000;
            text-align: center;
            box-shadow: 0 0 15px rgba(255, 193, 7, 0.3); /* Efek cahaya di sekitar kotak */
        }

        .score-text {
            font-size: 3.5rem; /* Ukuran angka diperbesar drastis */
            font-weight: 800;
            color: #ffc107;
            display: block; /* Agar angka berada di bawah tulisan "Skor:" */
        }

        .score-label {
            font-size: 1.2rem;
            color: #ffffff;
            text-transform: uppercase;
            letter-spacing: 2px;
        }
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
        
        <div class="score-fixed">
            <span class="text-white">Skor: </span>
            <span id="score" class="score-text">0</span>
        </div>
    </div>

    <script>
        const characters = @json($karakters);
        let currentIndex = 0;
        
        // Skor sesi ini dimulai dari 0
        let score = 0; 
        let usedIds = new Set();
        
        // Tampilkan total kumulatif (tapi jangan jadikan ini variabel perhitungan sesi)
        let totalKumulatif = {{ session('total_score', 0) }};
        document.getElementById('score').innerText = totalKumulatif + score;

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
            let char = characters[currentIndex];
            usedIds.add(char.id);
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
                let diff = characters[currentIndex].difficulty;
                let points = 0;
                if (diff == 1) points = 1;
                else if (diff == 2) points = 2;
                else if (diff == 3) points = 3;
                else if (diff == 4) points = 5;

                score += points; 
            }
            document.getElementById('score').innerText = totalKumulatif + score;

            document.getElementById('btn-benar').style.display = 'none';
            document.getElementById('btn-salah').style.display = 'none';
            document.getElementById('btn-next').style.display = 'inline-block';
        }

        function next() {
            currentIndex++;
            if (currentIndex < characters.length) {
                loadChar();
            } else {
                window.location.href = "/finish?score=" + score;
            }
        }

        loadChar();
    </script>
</body>
</html>