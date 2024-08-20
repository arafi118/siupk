<?php

// Inisialisasi aplikasi Laravel
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';

// Boot aplikasi
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

// Dapatkan instance session
$sessionData = session()->all();

// Tampilkan semua data session
echo "<h1>Semua Data Session</h1>";
echo "<pre>";

// Periksa apakah ada data session
if (!empty($sessionData)) {
    foreach ($sessionData as $key => $value) {
        echo "<strong>" . htmlspecialchars($key) . ":</strong> ";
        if (is_array($value) || is_object($value)) {
            print_r($value);
        } else {
            echo htmlspecialchars($value);
        }
        echo "<br>";
    }
} else {
    echo "Tidak ada data session.";
}
