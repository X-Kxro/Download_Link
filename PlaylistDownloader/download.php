<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['url'])) {
    $url = escapeshellarg($_POST['url']);
    $command = "python download_playlist.py $url 2>&1";
    $output = shell_exec($command);
    if ($output === null) {
        echo "Erreur lors de l'exécution du script.";
    } else {
        echo nl2br($output);
    }
} else {
    echo "Requête invalide.";
}
?>