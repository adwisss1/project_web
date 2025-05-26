<?php
// Konfigurasi koneksi database
define('DB_HOST', 'localhost'); // Ganti dengan host database kamu
define('DB_USER', 'root'); // Ganti dengan username database kamu
define('DB_PASS', ''); // Ganti dengan password database kamu
define('DB_NAME', 'crud_006'); // Nama database yang digunakan

// Membuat koneksi ke database
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Cek koneksi
if ($mysqli->connect_error) {
    die("Koneksi database gagal: " . $mysqli->connect_error);
}
?>
