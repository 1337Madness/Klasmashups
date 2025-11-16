<?php
// stream.php
$m3uUrl = 'https://github.com/1337Madness/Klasmashups/raw/refs/heads/main/%D0%BF%D0%BB%D0%B5%D0%B9%D0%BB%D0%B8%D1%81%D1%82.m3u';
$tracks = file($m3uUrl, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$tracks = array_filter($tracks, function($line) {
    return !str_starts_with(trim($line), '#');
});

$randomTrack = $tracks[array_rand($tracks)];
header('Content-Type: audio/mpeg');
header('Location: ' . $randomTrack);
exit;