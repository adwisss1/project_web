<?php
session_start();
require_once __DIR__ . '/../../config/config.php';

// Hanya pengurus yang boleh akses
if (!isset($_SESSION["user"]) || $_SESSION["user"]["role"] !== "pengurus") {
    header("Location: login.php");
    exit();
}

// Ambil data pendaftar
$result = $mysqli->query("SELECT * FROM pendaftaran ORDER BY waktu_daftar DESC");
$error = "";
if (!$result) {
    $error = "Gagal mengambil data pendaftar: " . $mysqli->error;
}

// Kirim ke view
include __DIR__ . '/../../views/pengurus/rekap_pendaftar.php';