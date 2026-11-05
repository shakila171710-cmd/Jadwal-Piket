<?php

// Buat folder penyimpanan sementara di server Vercel (/tmp)
$storagePath = '/tmp/storage';
if (!is_dir($storagePath)) {
    mkdir($storagePath . '/framework/views', 0755, true);
    mkdir($storagePath . '/framework/cache/data', 0755, true);
    mkdir($storagePath . '/framework/sessions', 0755, true);
    mkdir($storagePath . '/logs', 0755, true);
}

// Salin database SQLite ke /tmp agar bisa dibaca & ditulis oleh Laravel
$dbSource = __DIR__ . '/../database/database.sqlite';
$dbDest = '/tmp/database.sqlite';
if (file_exists($dbSource) && !file_exists($dbDest)) {
    copy($dbSource, $dbDest);
}

require __DIR__ . '/../public/index.php';