<?php
session_start();
require_once __DIR__ . '/../../config/config.php';

if (!isset($_SESSION["user"]) || $_SESSION["user"]["role"] !== "pengurus") {
    header("Location: ../login.php");
    exit();
}

$id_sesi = isset($_GET['id_sesi']) ? intval($_GET['id_sesi']) : 0;
$tipe = $_GET['tipe'] ?? 'rutin';

// Ambil id_jadwal dari sesi_absensi
$stmt = $mysqli->prepare("SELECT id_jadwal FROM sesi_absensi WHERE id=?");
$stmt->bind_param("i", $id_sesi);
$stmt->execute();
$stmt->bind_result($id_jadwal);
$stmt->fetch();
$stmt->close();

// Tutup sesi absensi
$stmt = $mysqli->prepare("UPDATE sesi_absensi SET status='ditutup' WHERE id=?");
$stmt->bind_param("i", $id_sesi);
$stmt->execute();
$stmt->close();

// Redirect kembali ke halaman buka_sesi_absensi.php, bukan ke manajemen_jadwal.php
header("Location: buka_sesi_absensi.php?id_jadwal=$id_jadwal&tipe=$tipe");
exit();
?>