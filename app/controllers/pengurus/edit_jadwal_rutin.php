<?php
// filepath: d:\dari c\2Xampp\instal\htdocs\SI-BIRAMA\app\controllers\pengurus\edit_jadwal_rutin.php
session_start();
require_once __DIR__ . '/../../config/config.php';

// Pastikan user adalah pengurus
if (!isset($_SESSION["user"]) || $_SESSION["user"]["role"] !== "pengurus") {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['id'])) {
    echo "ID jadwal tidak ditemukan.";
    exit();
}

$id = intval($_GET['id']);

// Ambil data jadwal_rutin berdasarkan id
$stmt = $mysqli->prepare("SELECT * FROM jadwal_rutin WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$jadwal = $result->fetch_assoc();

if (!$jadwal) {
    echo "Data jadwal tidak ditemukan.";
    exit();
}

// Ambil nama minat bakat
$nama_minat_bakat = '';
$stmt = $mysqli->prepare("SELECT nama_minat_bakat FROM minat_bakat WHERE id_minat_bakat = ?");
$stmt->bind_param("i", $jadwal['id_minat_bakat']);
$stmt->execute();
$stmt->bind_result($nama_minat_bakat);
$stmt->fetch();
$stmt->close();

$error = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $hari = $_POST["hari"];
    $jam = $_POST["jam"];
    $durasi_latihan = $_POST["durasi_latihan"];
    $mentor = $_POST["mentor"];

    $stmt = $mysqli->prepare("UPDATE jadwal_rutin SET hari=?, jam=?, durasi_latihan=?, mentor=? WHERE id=?");
    $stmt->bind_param("ssdsi", $hari, $jam, $durasi_latihan, $mentor, $id);
    if ($stmt->execute()) {
        header("Location: manajemen_jadwal.php?success=update");
        exit();
    } else {
        $error = "Gagal update data!";
    }
}

// Kirim data ke view
include __DIR__ . '/../../views/pengurus/edit_jadwal_rutin.php';