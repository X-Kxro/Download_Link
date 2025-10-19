<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MusicDown - Téléchargeur de Musique</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #121212;
            color: #ffffff;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .header {
            background: #1a1a1a;
            padding: 20px 0;
            border-bottom: 1px solid #333;
        }

        .header-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .logo {
            font-size: 24px;
            font-weight: 600;
            color: #1db954;
        }

        .logo span {
            color: #ff0000;
        }

        .main {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
        }

        .download-card {
            background: #1a1a1a;
            border-radius: 12px;
            padding: 40px;
            max-width: 500px;
            width: 100%;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            border: 1px solid #333;
        }

        .card-title {
            font-size: 28px;
            font-weight: 600;
            text-align: center;
            margin-bottom: 8px;
            color: #ffffff;
        }

        .card-subtitle {
            text-align: center;
            color: #b3b3b3;
            margin-bottom: 32px;
            font-size: 16px;
        }

        .form-group {
            margin-bottom: 24px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #ffffff;
        }

        .form-input {
            width: 100%;
            padding: 12px 16px;
            background: #2a2a2a;
            border: 2px solid #333;
            border-radius: 8px;
            color: #ffffff;
            font-size: 16px;
            transition: border-color 0.2s;
        }

        .form-input:focus {
            outline: none;
            border-color: #1db954;
        }

        .form-input::placeholder {
            color: #888;
        }

        .download-btn {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #1db954, #1ed760);
            border: none;
            border-radius: 8px;
            color: #ffffff;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .download-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 16px rgba(29, 185, 84, 0.3);
        }

        .download-btn:active {
            transform: translateY(0);
        }

        .progress-container {
            margin-top: 24px;
            display: none;
        }

        .progress-bar {
            width: 100%;
            height: 4px;
            background: #333;
            border-radius: 2px;
            overflow: hidden;
            margin-bottom: 12px;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #1db954, #1ed760);
            width: 0%;
            transition: width 0.3s ease;
        }

        .status-text {
            text-align: center;
            font-size: 14px;
            color: #b3b3b3;
        }

        .status-text.success {
            color: #1db954;
        }

        .status-text.error {
            color: #ff6b6b;
        }

        .features {
            display: flex;
            justify-content: space-around;
            align-items: center;
            margin-top: 32px;
            padding-top: 32px;
            border-top: 1px solid #333;
        }

        .feature {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            flex: 1;
        }

        .feature-icon {
            font-size: 24px;
            margin-bottom: 8px;
        }

        .feature-title {
            font-size: 14px;
            font-weight: 600;
            color: #ffffff;
        }

        .feature-desc {
            display: none;
        }

        @media (max-width: 768px) {
            .download-card {
                padding: 24px;
                margin: 20px;
            }

            .card-title {
                font-size: 24px;
            }

            .features {
                grid-template-columns: 1fr;
                gap: 16px;
            }
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="header-content">
            <div class="logo">
                Music<span>Down</span>
            </div>
            <div style="color: #b3b3b3; font-size: 14px;">
                Téléchargeur de musique
            </div>
        </div>
    </header>

    <main class="main">
        <div class="download-card">
            <h1 class="card-title">Télécharger une playlist</h1>
            <p class="card-subtitle">Collez l'URL Spotify ou YouTube pour commencer</p>

            <form id="download-form">
                <div class="form-group">
                    <label class="form-label" for="url">URL de la playlist</label>
                    <input
                        type="url"
                        id="url"
                        class="form-input"
                        placeholder="https://open.spotify.com/playlist/... ou https://youtube.com/playlist/..."
                        required
                    >
                </div>
                <button type="submit" class="download-btn">Télécharger</button>
            </form>

            <div class="progress-container" id="progress-container">
                <div class="progress-bar">
                    <div class="progress-fill" id="progress-fill"></div>
                </div>
                <div class="status-text" id="status">Préparation du téléchargement...</div>
            </div>

            <div class="features">
                <div class="feature">
                    <div class="feature-icon">🎵</div>
                    <div class="feature-title">Qualité maximale</div>
                    <div class="feature-desc">FLAC pour Spotify, meilleure qualité pour YouTube</div>
                </div>
                <div class="feature">
                    <div class="feature-icon">⚡</div>
                    <div class="feature-title">Ultra rapide</div>
                    <div class="feature-desc">Téléchargements parallèles optimisés</div>
                </div>
                <div class="feature">
                    <div class="feature-icon">📁</div>
                    <div class="feature-title">Auto-organisé</div>
                    <div class="feature-desc">Dossiers nommés automatiquement</div>
                </div>
            </div>
        </div>
    </main>

    <script>
        document.getElementById('download-form').addEventListener('submit', function(e) {
            e.preventDefault();

            const url = document.getElementById('url').value;
            const progressContainer = document.getElementById('progress-container');
            const progressFill = document.getElementById('progress-fill');
            const status = document.getElementById('status');

            progressContainer.style.display = 'block';
            progressFill.style.width = '10%';
            status.textContent = 'Connexion en cours...';
            status.className = 'status-text';

            // Simulate progress
            setTimeout(() => progressFill.style.width = '30%', 500);
            setTimeout(() => {
                progressFill.style.width = '60%';
                status.textContent = 'Téléchargement en cours...';
            }, 1000);

            fetch('download.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: 'url=' + encodeURIComponent(url)
            })
            .then(response => response.text())
            .then(data => {
                progressFill.style.width = '100%';
                status.textContent = '✓ Téléchargement terminé !';
                status.className = 'status-text success';
            })
            .catch(error => {
                progressFill.style.width = '0%';
                status.textContent = '✗ Erreur: ' + error.message;
                status.className = 'status-text error';
            });
        });
    </script>
</body>
</html>