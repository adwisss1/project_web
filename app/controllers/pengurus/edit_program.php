<?php
// filepath: d:\dari c\2Xampp\instal\htdocs\SI-BIRAMA\app\controllers\pengurus\edit_program.php
session_start();
require_once __DIR__ . '/../../config/config.php';
if (!isset($_SESSION["user"]) || $_SESSION["user"]["role"] !== "pengurus") {
    header("Location: ../login.php");
    exit();
}

$id_program = isset($_GET['id']) ? intval($_GET['id']) : 0;
$error = '';
$success = '';
$nama_program = '';
$deskripsi = '';

if ($id_program) {
    $stmt = $mysqli->prepare("SELECT nama_program, deskripsi FROM program_kerja WHERE id=?");
    $stmt->bind_param("i", $id_program);
    $stmt->execute();
    $stmt->bind_result($nama_program, $deskripsi);
    $stmt->fetch();
    $stmt->close();
    if (!$nama_program) {
        $error = "Program tidak ditemukan.";
    }
} else {
    $error = "ID program tidak ditemukan.";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $id_program) {
    $nama_program = trim($_POST['nama_program']);
    $deskripsi = trim($_POST['deskripsi']);
    if ($nama_program === '' || $deskripsi === '') {
        $error = "Semua field wajib diisi.";
    } else {
        $stmt = $mysqli->prepare("UPDATE program_kerja SET nama_program=?, deskripsi=? WHERE id=?");
        $stmt->bind_param("ssi", $nama_program, $deskripsi, $id_program);
        if ($stmt->execute()) {
            header("Location: kontrol_program.php");
            exit();
        } else {
            $error = "Gagal mengupdate program.";
        }
        $stmt->close();
    }
}

// Kirim data ke view
include __DIR__ . '/../../views/pengurus/edit_program.php';