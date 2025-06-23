<?php
// filepath: d:\dari c\2Xampp\instal\htdocs\SI-BIRAMA\app\controllers\pengurus\tambah_progress.php
require_once __DIR__ . '/../../config/config.php';

if (!isset($_GET['id_program'])) {
    header("Location: kontrol_program.php");
    exit();
}
$id_program = intval($_GET['id_program']);

// Ambil nama program kerja
$stmt_prog = $mysqli->prepare("SELECT nama_program FROM program_kerja WHERE id=?");
$stmt_prog->bind_param('i', $id_program);
$stmt_prog->execute();
$stmt_prog->bind_result($nama_program);
$stmt_prog->fetch();
$stmt_prog->close();

$laporan = '';
$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $laporan_baru = trim($_POST["laporan"]);
    if ($laporan_baru === '') {
        $error = "Laporan progress tidak boleh kosong.";
    } else {
        $stmt = $mysqli->prepare("INSERT INTO progress_proker (id_program, laporan, tanggal_update) VALUES (?, ?, NOW())");
        $stmt->bind_param('is', $id_program, $laporan_baru);
        if ($stmt->execute()) {
            header("Location: kontrol_program.php?filter_program=$id_program#progress-proker");
            exit();
        } else {
            $error = "Gagal menambah progress.";
        }
        $stmt->close();
    }
}

// Kirim data ke view
include __DIR__ . '/../../views/pengurus/tambah_progress.php';