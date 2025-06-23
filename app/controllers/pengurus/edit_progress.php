<?php
// filepath: d:\dari c\2Xampp\instal\htdocs\SI-BIRAMA\app\controllers\pengurus\edit_progress.php
require_once __DIR__ . '/../../config/config.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$error = '';
$nama_program = '';
$laporan = '';
$id_program = 0;

if ($id) {
    // Ambil data progress
    $stmt = $mysqli->prepare("SELECT id_program, laporan FROM progress_proker WHERE id=?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->bind_result($id_program, $laporan);
    $stmt->fetch();
    $stmt->close();

    // Ambil nama program kerja
    $stmt_prog = $mysqli->prepare("SELECT nama_program FROM program_kerja WHERE id=?");
    $stmt_prog->bind_param('i', $id_program);
    $stmt_prog->execute();
    $stmt_prog->bind_result($nama_program);
    $stmt_prog->fetch();
    $stmt_prog->close();

    // Proses submit form: UPDATE
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $laporan_baru = $_POST["laporan"];
        $stmt = $mysqli->prepare("UPDATE progress_proker SET laporan=?, tanggal_update=NOW() WHERE id=?");
        $stmt->bind_param('si', $laporan_baru, $id);
        if ($stmt->execute()) {
            header("Location: kontrol_program.php?filter_program=$id_program#progress-proker");
            exit();
        } else {
            $error = "Gagal mengupdate progress.";
        }
        $stmt->close();
    }
} else {
    header("Location: kontrol_program.php");
    exit();
}

// Kirim data ke view
include __DIR__ . '/../../views/pengurus/edit_progress.php';