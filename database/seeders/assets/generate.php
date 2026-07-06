<?php
$assetDir = __DIR__ . '/images';
$mobilDir = $assetDir . '/mobil';
$ktpDir = $assetDir . '/ktp';

if (!is_dir($mobilDir)) mkdir($mobilDir, 0755, true);
if (!is_dir($ktpDir)) mkdir($ktpDir, 0755, true);

function createPlaceholder($path, $w, $h, $bg, $text, $textColor = [255,255,255]) {
    $img = imagecreatetruecolor($w, $h);
    $bgColor = imagecolorallocate($img, $bg[0], $bg[1], $bg[2]);
    imagefill($img, 0, 0, $bgColor);
    $tc = imagecolorallocate($img, $textColor[0], $textColor[1], $textColor[2]);
    $fontSize = 5;
    $x = ($w - imagefontwidth($fontSize) * strlen($text)) / 2;
    $y = ($h - imagefontheight($fontSize)) / 2;
    imagestring($img, $fontSize, (int)$x, (int)$y, $text, $tc);
    imagejpeg($img, $path, 85);
    imagedestroy($img);
}

// Mobil placeholders
$cars = [
    ['mobil_merah.jpg',   [800,500], [180,20,30],   'Toyota Avanza - Matic'],
    ['mobil_biru.jpg',    [800,500], [20,80,180],    'Honda Brio - Matic'],
    ['mobil_hitam.jpg',   [800,500], [40,40,50],     'Toyota Fortuner - Matic'],
];
foreach ($cars as $c) {
    createPlaceholder($mobilDir . '/' . $c[0], $c[1][0], $c[1][1], $c[2], $c[3]);
}

// KTP placeholder
createPlaceholder($ktpDir . '/ktp_sample.jpg', 600, 400, [200,210,220], 'KTP SAMPLE', [80,80,80]);

echo "OK: " . count($cars) . " mobil + 1 ktp generated\n";
