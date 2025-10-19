# 🎵 MusicDown - Téléchargeur de Musique

Un téléchargeur simple et efficace pour vos playlists Spotify et YouTube avec qualité maximale.

## ✨ Fonctionnalités

- **🎵 Qualité maximale** - FLAC pour Spotify, meilleure qualité pour YouTube
- **⚡ Ultra rapide** - Téléchargements parallèles optimisés
- **📁 Auto-organisé** - Dossiers nommés automatiquement

## 🚀 Installation

### Prérequis

- Python 3.11+
- FFmpeg
- XAMPP (Apache + PHP) ou serveur web PHP
- yt-dlp
- spotdl

### Installation des dépendances Python

```bash
pip install yt-dlp spotdl requests beautifulsoup4
```

### Installation FFmpeg

```bash
# Pour spotdl
spotdl --download-ffmpeg
```

## 📖 Utilisation

1. **Via l'interface web :**
   - Lancez votre serveur XAMPP
   - Accédez à `http://localhost/projects/PlaylistDownloader/`
   - Collez l'URL de votre playlist Spotify ou YouTube
   - Cliquez sur "Télécharger"

2. **Via ligne de commande :**
   ```bash
   python download_playlist.py "https://open.spotify.com/album/..."
   ```

## 🛠️ Technologies utilisées

- **Backend :** Python 3.11, yt-dlp, spotdl
- **Frontend :** HTML5, CSS3, JavaScript
- **Serveur :** PHP 8.x, Apache

## 📁 Structure du projet

```
PlaylistDownloader/
├── download_playlist.py    # Script principal Python
├── download.php           # Backend PHP
├── index.php             # Interface web
└── README.md             # Documentation
```

## 🔧 Configuration

Le script utilise les paramètres suivants :
- **Spotify :** Format FLAC, 4 threads parallèles, retry automatique
- **YouTube :** Meilleure qualité audio disponible
- **Organisation :** Dossiers nommés d'après le titre de la playlist

## ⚠️ Note importante

Ce projet est destiné à un usage personnel uniquement. Respectez les droits d'auteur et les conditions d'utilisation des plateformes de streaming.

## 📄 Licence

Ce projet est fourni tel quel, sans garantie.

---

**Créé avec ❤️ pour les amateurs de musique**