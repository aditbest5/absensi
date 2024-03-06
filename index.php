<?php

// Ambil nilai dari URL
$url = isset($_GET['url']) ? $_GET['url'] : '/';

// Pisahkan nilai URL menjadi array
$params = explode('/', $url);

// Ambil halaman pertama dari URL (misalnya: /halaman)
$page = array_shift($params);

// Sekarang Anda bisa menentukan aksi berdasarkan halaman yang diminta
switch ($page) {
    case 'login':
        // Logika untuk halaman tertentu
        require __DIR__ . "/views/login.php";
        break;

    case 'dashboard':
        // Logika untuk halaman lainnya
        require __DIR__ . "/views/dashboard.php";
        break;
    case 'absensi':
        require __DIR__ . "/views/absensi.php";
        break;
    default:
        // Jika tidak ada halaman yang cocok, Anda bisa menampilkan halaman 404
        http_response_code(404);
        echo "Halaman tidak ditemukan";
        break;
}
