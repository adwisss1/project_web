<?php
// filepath: d:\dari c\2Xampp\instal\htdocs\SI-BIRAMA\app\controllers\pengurus\tambah_materi.php
session_start();
require_once __DIR__ . '/../../config/config.php';

if (!isset($_SESSION["user"]) || $_SESSION["user"]["role"] !== "pengurus") {
    header("Location: login.php");
    exit();
}

$bidang_minat = isset($_GET['bidang_minat']) ? $_GET['bidang_minat'] : '';
$id_minat_bakat = isset($_GET['id_minat_bakat']) ? $_GET['id_minat_bakat'] : '';
$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bidang_minat = $_POST["bidang_minat"];
    $minggu = $_POST["minggu"];
    $deskripsi = $_POST["deskripsi"];
    $materi = $_POST["materi"];
    $link_materi = $_POST["link_materi"];
    $id_minat_bakat = $_POST["id_minat_bakat"];

    $stmt = $mysqli->prepare("INSERT INTO materi_latihan (bidang_minat, minggu, deskripsi, materi, link_materi) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sisss", $bidang_minat, $minggu, $deskripsi, $materi, $link_materi);
    if ($stmt->execute()) {
        header("Location: manajemen_materi.php?id_minat_bakat=" . urlencode($id_minat_bakat) . "&bidang_minat=" . urlencode($bidang_minat));
        exit();
    } else {
        $error = "Gagal menambah materi.";
    }
    $stmt->close();
}

// Kirim data ke view
include __DIR__ . '/../../views/pengurus/tambah_materi.php';