<?php
// filepath: d:\dari c\2Xampp\instal\htdocs\SI-BIRAMA\app\controllers\pengurus\edit_materi.php
session_start();
require_once __DIR__ . '/../../config/config.php';

if (!isset($_SESSION["user"]) || $_SESSION["user"]["role"] !== "pengurus") {
    header("Location: login.php");
    exit();
}

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$id_minat_bakat = isset($_GET['id_minat_bakat']) ? $_GET['id_minat_bakat'] : '';
if ($id <= 0) die("ID tidak valid.");

$error = '';
$stmt = $mysqli->prepare("SELECT bidang_minat, minggu, deskripsi, materi, link_materi FROM materi_latihan WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($bidang_minat, $minggu, $deskripsi, $materi, $link_materi);
$stmt->fetch();
$stmt->close();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $minggu = $_POST["minggu"];
    $deskripsi = $_POST["deskripsi"];
    $materi = $_POST["materi"];
    $link_materi = $_POST["link_materi"];
    $id_minat_bakat = $_POST["id_minat_bakat"];

    $stmt = $mysqli->prepare("UPDATE materi_latihan SET minggu=?, deskripsi=?, materi=?, link_materi=? WHERE id=?");
    $stmt->bind_param("isssi", $minggu, $deskripsi, $materi, $link_materi, $id);
    if ($stmt->execute()) {
        header("Location: manajemen_materi.php?id_minat_bakat=" . urlencode($id_minat_bakat) . "&bidang_minat=" . urlencode($bidang_minat));
        exit();
    } else {
        $error = "Gagal mengubah materi.";
    }
    $stmt->close();
}

// Kirim data ke view
include __DIR__ . '/../../views/pengurus/edit_materi.php';