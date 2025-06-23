<?php
require_once __DIR__ . '/../config/config.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nama_client = $_POST['nama_client'];
    $email = $_POST['email'];
    $nama_kegiatan = $_POST['nama_kegiatan'];
    $jenis_talent = $_POST['jenis_talent'];
    $jumlah_talent = $_POST['jumlah_talent'];
    $tanggal_acara = $_POST['tanggal_acara'];
    $lokasi = $_POST['lokasi'];
    $durasi = $_POST['durasi'];

    $stmt = $mysqli->prepare("INSERT INTO book_talent (nama_client, email, nama_kegiatan, jenis_talent, jumlah_talent, tanggal_acara, lokasi, durasi) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssissi", $nama_client, $email, $nama_kegiatan, $jenis_talent, $jumlah_talent, $tanggal_acara, $lokasi, $durasi);
    $stmt->execute();
    $stmt->close();

    echo "<script>alert('Request talent berhasil dikirim!');window.location='beranda.php';</script>";
    exit;
}

// Kirim ke view
include __DIR__ . '/../views/bookTalent.php';