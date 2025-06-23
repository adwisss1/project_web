<?php
// filepath: d:\dari c\2Xampp\instal\htdocs\SI-BIRAMA\app\controllers\pengurus\rekap_pendaftar.php
session_start();
require_once __DIR__ . '/../../config/config.php';

// Hanya pengurus yang boleh akses
if (!isset($_SESSION["user"]) || $_SESSION["user"]["role"] !== "pengurus") {
    header("Location: login.php");
    exit();
}

// Ambil data pendaftar
$result = $mysqli->query("SELECT * FROM pendaftaran ORDER BY waktu_daftar DESC");

// Kirim ke view
include __DIR__ . '/../../views/pengurus/rekap_pendaftar.php';