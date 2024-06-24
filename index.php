<?php

function renderPage($route)
{
    switch ($route) {
        case '/menuforuser.php':
            include 'menu/menuforuser.php';
            break;
        case '/konsultasi.php':
            include 'menu/konsultasi.php';
            break;
        case '/pemasok.php':
            include 'menu/pemasok.php';
            break;
        case '/beliobat.php':
            include 'menu/beliobat.php';
            break;
        case '/konsApoteker1.php':
            include 'menu/konsApoteker1.php';
            break;
        case '/konsApoteker2.php':
            include 'menu/konsApoteker2.php';
            break;
        default:
            include 'pages/error404.php';
            break;
    }
}

// Mendapatkan URL yang diminta
$request_uri = $_SERVER['REQUEST_URI'];

// Mencari rute yang diminta
$path = parse_url($request_uri, PHP_URL_PATH);

// Simulasikan peran pengguna (gantilah ini dengan cara yang sesuai untuk mendapatkan peran pengguna)
$user_roles = ['apoteker', 'pasien', 'pemasok']; // Gantilah dengan peran-peran pengguna yang sesuai

$found = false;

foreach ($user_roles as $role) {
    if (!$found) {
        switch ($role) {
            case 'pasien':
                renderPage($path);
                $found = true;
                break;
            case 'pemasok':
                if ($path === '/pemasok.php') {
                    renderPage($path);
                    $found = true;
                } else {
                    header("Location: ../menu/pemasok.php");
                    exit();
                }
                break;
        }
    }
}

// Jika tidak ada peran yang sesuai, tampilkan halaman error 404
if (!$found) {
    include 'pages/error404.php';
}
?>
