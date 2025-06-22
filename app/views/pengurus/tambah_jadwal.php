<?php
session_start();
require_once __DIR__ . '/../../config/config.php';

// Pastikan user adalah pengurus
if (!isset($_SESSION["user"]) || $_SESSION["role"] !== "pengurus") {
    header("Location: ../login.php");
    exit();
}

// Cek apakah form telah dikirim
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id_minat_bakat = $_POST["id_minat_bakat"];
    $tanggal = $_POST["tanggal"];
    $jam = $_POST["jam"];
    $keterangan = $_POST["keterangan"];

    // Validasi input agar tidak kosong
    if (empty($id_minat_bakat) || empty($tanggal) || empty($jam)) {
        $_SESSION["error"] = "Semua kolom wajib diisi!";
        header("Location: manajemen_jadwal.php");
        exit();
    }

    // Insert data ke dalam tabel `jadwal_kondisional`
    $stmt = $mysqli->prepare("INSERT INTO jadwal_kondisional (id_minat_bakat, tanggal, jam, keterangan) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $id_minat_bakat, $tanggal, $jam, $keterangan);
    
    if ($stmt->execute()) {
        $_SESSION["success"] = "Jadwal berhasil ditambahkan!";
    } else {
        $_SESSION["error"] = "Terjadi kesalahan saat menyimpan jadwal.";
    }

    header("Location: manajemen_jadwal.php");
    exit();
}

header("Location: manajemen_jadwal.php");
exit();
?>
