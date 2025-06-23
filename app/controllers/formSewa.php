<?php
session_start();
require_once __DIR__ . '/../config/config.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $nama_kegiatan = $_POST['nama_kegiatan'];
    $telepon = $_POST['telepon'];
    $item = $_POST['item'];
    $tanggal = $_POST['tanggal'];
    $durasi = $_POST['durasi'];

    $stmt = $mysqli->prepare("INSERT INTO penyewaan (nama, email, nama_kegiatan, telepon, item, tanggal, durasi) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssi", $nama, $email, $nama_kegiatan, $telepon, $item, $tanggal, $durasi);
    $stmt->execute();
    $stmt->close();

    echo "<script>alert('Request penyewaan berhasil dikirim!');window.location='beranda.php';</script>";
    exit;
}

// Kirim ke view
include __DIR__ . '/../views/formSewa.php';