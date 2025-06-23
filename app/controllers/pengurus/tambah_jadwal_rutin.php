<?php
// filepath: d:\dari c\2Xampp\instal\htdocs\SI-BIRAMA\app\controllers\pengurus\tambah_jadwal_rutin.php
session_start();
require_once __DIR__ . '/../../config/config.php';

// Pastikan hanya pengurus yang bisa akses
if (!isset($_SESSION["user"]) || $_SESSION["user"]["role"] !== "pengurus") {
    header("Location: ../login.php");
    exit();
}

$error = '';
$success = '';

// Ambil data minat bakat untuk dropdown
$minat_result = $mysqli->query("SELECT id_minat_bakat, nama_minat_bakat FROM minat_bakat");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_minat_bakat = isset($_POST['id_minat_bakat']) ? intval($_POST['id_minat_bakat']) : 0;
    $hari = trim($_POST['hari'] ?? '');
    $jam = trim($_POST['jam'] ?? '');
    $durasi = floatval($_POST['durasi'] ?? 0);
    $mentor = trim($_POST['mentor'] ?? '');

    if ($id_minat_bakat === 0 || $hari === '' || $jam === '' || $durasi <= 0 || $mentor === '') {
        $error = "Semua field wajib diisi.";
    } else {
        $stmt = $mysqli->prepare("INSERT INTO jadwal_rutin (id_minat_bakat, hari, jam, durasi_latihan, mentor) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("issds", $id_minat_bakat, $hari, $jam, $durasi, $mentor);
        if ($stmt->execute()) {
            $stmt->close();
            header("Location: manajemen_jadwal.php?success=add");
            exit();
        } else {
            $error = "Gagal menambah jadwal rutin.";
            $stmt->close();
        }
    }
}

// Kirim data ke view
include __DIR__ . '/../../views/pengurus/tambah_jadwal_rutin.php';