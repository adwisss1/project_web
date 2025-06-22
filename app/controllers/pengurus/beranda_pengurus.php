<?php
// filepath: app/controllers/pengurus/beranda_pengurus.php
session_start();
require_once __DIR__ . '/../../config/config.php';

if (!isset($_SESSION["user"]) || !is_array($_SESSION["user"]) || $_SESSION["user"]["role"] !== "pengurus") {
    header("Location: ../../views/login.php");
    exit();
}

$user_id = $_SESSION["user"]["id"];

// Data pengurus
$stmt = $mysqli->prepare("SELECT id_pengurus, nama_pengurus, nim, angkatan, jabatan, kontak FROM pengurus");
$stmt->execute();
$pengurus_result = $stmt->get_result();

// Data anggota
$stmt = $mysqli->prepare("SELECT id, nama, nra, user_id, angkatan FROM anggota");
$stmt->execute();
$anggota_result = $stmt->get_result();

// Data minat bakat
$stmt = $mysqli->prepare("SELECT id_minat_bakat, nama_minat_bakat, enrollment_key, id_bidang FROM minat_bakat");
$stmt->execute();
$minat_result = $stmt->get_result();

// Data evaluasi
$stmt = $mysqli->prepare("SELECT user_id, umpan_balik FROM evaluasi WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$evaluasi_result = $stmt->get_result();

// Data materi latihan
$stmt = $mysqli->prepare("SELECT id, bidang_minat, minggu, deskripsi, materi, link_materi FROM materi_latihan");
$stmt->execute();
$materi_result = $stmt->get_result();

// Data penyewaan
$penyewaan_result = $mysqli->query("SELECT * FROM penyewaan ORDER BY waktu_submit DESC");

// Data book talent
$book_talent_result = $mysqli->query("SELECT * FROM book_talent ORDER BY waktu_submit DESC");

// Kirim semua variabel ke view
include __DIR__ . '/../../views/pengurus/beranda_pengurus.php';