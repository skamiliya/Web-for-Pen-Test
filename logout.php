<?php
    // Memulai sesi
    session_start();

    // Menghapus cookie 'login' dengan mengatur ulang kedaluwarsa menjadi waktu yang sudah lewat
    if (isset($_COOKIE['login'])) {
        unset($_COOKIE['login']);
        setcookie('login', '', time() - 3600, '/'); // set kedaluwarsa di masa lalu, untuk menghapus cookie
    }

    // Menghancurkan semua data sesi
    session_destroy();

    // Redirect ke halaman login atau home setelah logout
    header('Location: index.php');
    exit();
?>
