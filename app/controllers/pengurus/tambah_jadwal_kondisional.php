<?php
// filepath: d:\dari c\2Xampp\instal\htdocs\SI-BIRAMA\app\controllers\pengurus\tambah_jadwal_kondisional.php
session_start();
require_once __DIR__ . '/../../config/config.php';

if (!isset($_SESSION["user"]) || $_SESSION["user"]["role"] !== "pengurus") {
    header("Location: ../login.php");
    exit();
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_minat_bakat = isset($_POST['id_minat_bakat']) ? intval($_POST['id_minat_bakat']) : 0;
    $tanggal = $_POST['tanggal'] ?? '';
    $jam = $_POST['jam'] ?? '';
    $keterangan = trim($_POST['keterangan'] ?? '');

    if ($id_minat_bakat && $tanggal && $jam) {
        $stmt = $mysqli->prepare("INSERT INTO jadwal_kondisional (id_minat_bakat, tanggal, jam, keterangan) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isss", $id_minat_bakat, $tanggal, $jam, $keterangan);
        if ($stmt->execute()) {
            header("Location: manajemen_jadwal.php?success=add");
            exit();
        } else {
            $error = "Gagal menambah jadwal kondisional.";
        }
    } else {
        $error = "Semua field (kecuali keterangan) wajib diisi.";
    }
}

// Ambil data minat bakat untuk dropdown
$minat_result = $mysqli->query("SELECT id_minat_bakat, nama_minat_bakat FROM minat_bakat");

// Kirim ke view
include __DIR__ . '/../../views/pengurus/tambah_jadwal_kondisional.php';