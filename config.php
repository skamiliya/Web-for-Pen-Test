<?php
// Konfigurasi database
$host = "localhost"; // atau alamat IP server MySQL
$dbUsername = "root"; // username untuk akses database
$dbPassword = ""; // password untuk akses database (default XAMPP adalah kosong)
$dbName = "pentest"; // nama database yang ingin Anda gunakan

// Membuat koneksi ke database
$conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
