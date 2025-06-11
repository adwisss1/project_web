<?php
// filepath: d:\dari c\2Xampp\instal\htdocs\SI-BIRAMA\app\views\hapus_materi.php
session_start();
require_once __DIR__ . '/../config/config.php';

if (!isset($_SESSION["user"]) || $_SESSION["user"]["role"] !== "pengurus") {
    header("Location: login.php");
    exit();
}

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id <= 0) die("ID tidak valid.");

// Ambil bidang_minat sebelum hapus untuk redirect
$stmt = $mysqli->prepare("SELECT bidang_minat FROM materi_latihan WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($bidang_minat);
$stmt->fetch();
$stmt->close();

$stmt = $mysqli->prepare("DELETE FROM materi_latihan WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->close();

header("Location: manajemen_materi.php?id_minat_bakat=&bidang_minat=" . urlencode($bidang_minat));
exit();