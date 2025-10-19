import sys
import subprocess
import requests
from bs4 import BeautifulSoup
import os

def get_playlist_name(url):
    try:
        response = requests.get(url, timeout=10)
        soup = BeautifulSoup(response.text, 'html.parser')
        title = soup.title.string
        if 'youtube.com' in url or 'youtu.be' in url:
            title = title.replace(' - YouTube', '')
        elif 'spotify.com' in url:
            title = title.replace(' | Spotify', '')
        # Clean title for folder name (remove invalid chars)
        title = "".join(c for c in title if c.isalnum() or c in (' ', '-', '_')).rstrip()
        return title if title else "Unknown_Playlist"
    except:
        return "Unknown_Playlist"

def download_playlist(url):
    folder = get_playlist_name(url)
    os.makedirs(folder, exist_ok=True)

    if 'youtube.com' in url or 'youtu.be' in url:
        # Download YouTube playlist using yt-dlp
        try:
            result = subprocess.run([
                sys.executable, '-m', 'yt_dlp',
                '-o', f'{folder}/%(title)s.%(ext)s',
                '--format', 'bestaudio/best',
                '--extract-audio',
                '--audio-format', 'mp3',
                '--audio-quality', '320K',
                url
            ], capture_output=True, text=True, timeout=300)

            if result.returncode != 0:
                print(f"Erreur yt-dlp: {result.stderr}")
                return False
            return True

        except subprocess.TimeoutExpired:
            print("Timeout lors du téléchargement YouTube")
            return False
        except Exception as e:
            print(f"Erreur YouTube: {e}")
            return False

    elif 'spotify.com' in url:
        # Download Spotify playlist using spotdl
        try:
            result = subprocess.run([
                sys.executable, '-m', 'spotdl', 'download', url,
                '--output', folder,
                '--threads', '1',  # Réduit à 1 thread pour éviter le rate limiting
                '--max-retries', '5',  # Augmenté à 5 retries
                '--format', 'mp3',  # Changé à MP3 pour plus de compatibilité
                '--audio', 'youtube-music',  # Source YouTube Music pour stabilité
                '--overwrite', 'force'  # Force la réécriture pour retenter les échecs
            ], capture_output=True, text=True, timeout=1200)

            if result.returncode != 0:
                print(f"Erreur spotdl: {result.stderr}")
                # Essai avec moins de sources si ça échoue
                print("Tentative avec une seule source audio...")
                result_backup = subprocess.run([
                    sys.executable, '-m', 'spotdl', 'download', url,
                    '--output', folder,
                    '--format', 'mp3',  # Format plus simple
                    '--audio', 'youtube'  # Une seule source
                ], capture_output=True, text=True, timeout=600)

                if result_backup.returncode != 0:
                    print(f"Erreur backup spotdl: {result_backup.stderr}")
                    return False
                return True
            return True

        except subprocess.TimeoutExpired:
            print("Timeout lors du téléchargement Spotify")
            return False
        except Exception as e:
            print(f"Erreur Spotify: {e}")
            return False

    else:
        print("URL non supportée. Seules les playlists YouTube et Spotify sont prises en charge.")
        return False

if __name__ == "__main__":
    if len(sys.argv) != 2:
        print("Utilisation: python download_playlist.py <url>")
        sys.exit(1)
    url = sys.argv[1]
    success = download_playlist(url)
    if success:
        print("Téléchargement terminé avec succès !")
        sys.exit(0)
    else:
        print("Échec du téléchargement.")
        sys.exit(1)