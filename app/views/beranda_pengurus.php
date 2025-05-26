<?php
session_start();
require_once __DIR__ . '/../config/config.php';

// Pastikan pengguna sudah login dan memiliki role pengurus
if (!isset($_SESSION["user"]) || $_SESSION["role"] !== "pengurus") {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION["id"]; // Menggunakan ID dari session

// Ambil daftar anggota dengan informasi minat bakat
$stmt = $mysqli->prepare("
    SELECT anggota.id, anggota.nama, anggota.nra, anggota.user_id, anggota.id_minat_bakat, 
           minat_bakat.nama_minat_bakat 
    FROM anggota 
    LEFT JOIN minat_bakat ON anggota.id_minat_bakat = minat_bakat.id_minat_bakat");
$stmt->execute();
$anggota_result = $stmt->get_result();

// Ambil daftar minat bakat
$stmt = $mysqli->prepare("SELECT id_minat_bakat, nama_minat_bakat, enrollment_key FROM minat_bakat");
$stmt->execute();
$minat_result = $stmt->get_result();

// Ambil evaluasi keaktifan anggota
$stmt = $mysqli->prepare("SELECT user_id, kehadiran, performa, umpan_balik FROM evaluasi WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$evaluasi_result = $stmt->get_result();

// Ambil materi latihan
$stmt = $mysqli->prepare("SELECT id, bidang_minat, minggu, deskripsi, materi, link_materi FROM materi_latihan");
$stmt->execute();
$materi_result = $stmt->get_result();
?>

<?php include 'header.php'; ?> <!-- Tambahkan Header -->

<div class="content">
    <h2>Selamat datang, <?= htmlspecialchars($_SESSION["user"]); ?>!</h2>

    <h3>Menu Pengurus</h3>
    <ul>
        <li><a href="manajemen_anggota_kinerja.php">Manajemen & Evaluasi Anggota</a></li>
        <li><a href="manajemen_jadwal.php">Manajemen Jadwal</a></li>
        <li><a href="kontrol_program.php">Kontrol Program Kerja</a></li>
    </ul>

    <br><br>
    <a href="../controllers/authController.php?logout=true">Logout</a>
</div>

<?php include 'footer.php'; ?>