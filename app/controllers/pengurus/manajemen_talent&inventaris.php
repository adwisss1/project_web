<?php
// filepath: d:\dari c\2Xampp\instal\htdocs\SI-BIRAMA\app\controllers\pengurus\manajemen_talent&inventaris.php
session_start();
require_once __DIR__ . '/../../config/config.php';

// Hanya pengurus yang boleh akses
if (!isset($_SESSION["user"]["role"]) || $_SESSION["user"]["role"] !== "pengurus") {
    header("Location: beranda.php");
    exit();
}

// Ambil data talent dan inventaris
$talent = $mysqli->query("SELECT * FROM talent");
$inventaris = $mysqli->query("SELECT * FROM inventaris");

// Kirim ke view
include __DIR__ . '/../../views/pengurus/manajemen_talent&inventaris.php';