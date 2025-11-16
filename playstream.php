<?php
$m3uUrl = 'https://github.com/1337Madness/Klasmashups/raw/refs/heads/main/playlist.m3u';
if(!file_exists($m3uUrl)) {
    header("HTTP/1.0 404 Not Found");
    die("Playlist not found");
}

$lines = file($m3uUrl, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$tracks = array();

foreach($lines as $line) {
    $line = trim($line);
    if($line && !str_starts_with($line, '#')) {
        $tracks[] = $line;
    }
}

if(empty($tracks)) {
    header("HTTP/1.0 404 Not Found");
    die("No tracks in playlist");
}

$randomTrack = $tracks[array_rand($tracks)];

// Отдаем как MP3 поток
header('Content-Type: audio/mpeg');
header('Content-Length: ' . filesize($randomTrack));
readfile($randomTrack);
exit;
?>