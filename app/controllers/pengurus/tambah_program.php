<?php
// filepath: d:\dari c\2Xampp\instal\htdocs\SI-BIRAMA\app\controllers\pengurus\tambah_program.php
session_start();
require_once __DIR__ . '/../../config/config.php';

// Ambil data pengurus untuk dropdown PJ Pengurus
$pengurus_result = $mysqli->query("SELECT id_pengurus, nama_pengurus FROM pengurus");

// Ambil data anggota untuk cari ketua panitia
$anggota_result = $mysqli->query("SELECT id, nama FROM anggota");

$error = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_program = trim($_POST["nama_program"]);
    $tanggal_mulai = $_POST["tanggal_mulai"];
    $tanggal_selesai = $_POST["tanggal_selesai"];
    $tanggal_selesai_agenda = $_POST["tanggal_selesai_agenda"];
    $deskripsi = trim($_POST["deskripsi"]);
    $pj_pengurus = intval($_POST["pj_pengurus"]);
    $ketua_panitia = intval($_POST["ketua_panitia"]);
    $status = trim($_POST["status"]);

    if ($nama_program && $tanggal_mulai && $tanggal_selesai && $pj_pengurus && $ketua_panitia) {
        $stmt = $mysqli->prepare("INSERT INTO program_kerja (nama_program, tanggal_mulai, tanggal_selesai, tanggal_selesai_agenda, deskripsi, pj_pengurus, ketua_panitia, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssiis", $nama_program, $tanggal_mulai, $tanggal_selesai, $tanggal_selesai_agenda, $deskripsi, $pj_pengurus, $ketua_panitia, $status);
        if ($stmt->execute()) {
            header("Location: kontrol_program.php");
            exit();
        } else {
            $error = "Gagal menambah program kerja.";
        }
        $stmt->close();
    } else {
        $error = "Semua field wajib diisi.";
    }
}

// Kirim data ke view
include __DIR__ . '/../../views/pengurus/tambah_program.php';