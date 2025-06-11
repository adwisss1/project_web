<?php
session_start();
require_once __DIR__ . '/../config/config.php';

if (!isset($_SESSION["user"]) || $_SESSION["user"]["role"] !== "pengurus") {
    header("Location: ../views/login.php");
    exit();
}

$action = $_GET['action'] ?? 'list';
$minat_result = $mysqli->query("SELECT id_minat_bakat, nama_minat_bakat FROM minat_bakat");

if ($action === 'add' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $bidang_minat = $_POST["bidang_minat"];
    $minggu = $_POST["minggu"];
    $deskripsi = $_POST["deskripsi"];
    $materi = $_POST["materi"];
    $link_materi = $_POST["link_materi"];
    $stmt = $mysqli->prepare("INSERT INTO materi_latihan (bidang_minat, minggu, deskripsi, materi, link_materi) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sisss", $bidang_minat, $minggu, $deskripsi, $materi, $link_materi);
    $stmt->execute();
    header("Location: materiController.php?id_minat_bakat=" . urlencode($_GET['id_minat_bakat']));
    exit();
}
if ($action === 'edit') {
    $id = intval($_GET['id']);
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $minggu = $_POST["minggu"];
        $deskripsi = $_POST["deskripsi"];
        $materi = $_POST["materi"];
        $link_materi = $_POST["link_materi"];
        $stmt = $mysqli->prepare("UPDATE materi_latihan SET minggu=?, deskripsi=?, materi=?, link_materi=? WHERE id=?");
        $stmt->bind_param("isssi", $minggu, $deskripsi, $materi, $link_materi, $id);
        $stmt->execute();
        header("Location: materiController.php?id_minat_bakat=" . urlencode($_GET['id_minat_bakat']));
        exit();
    }
    $stmt = $mysqli->prepare("SELECT id, bidang_minat, minggu, deskripsi, materi, link_materi FROM materi_latihan WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $materi = $result->fetch_assoc();
    include __DIR__ . '/../views/edit_materi.php';
    exit();
}
if ($action === 'delete') {
    $id = intval($_GET['id']);
    $stmt = $mysqli->prepare("DELETE FROM materi_latihan WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    header("Location: materiController.php?id_minat_bakat=" . urlencode($_GET['id_minat_bakat']));
    exit();
}

// Default: tampilkan daftar materi
$id_minat_bakat = isset($_GET['id_minat_bakat']) ? intval($_GET['id_minat_bakat']) : 0;
$nama_minat_bakat = '';
$materi_result = null;
if ($id_minat_bakat) {
    $stmt = $mysqli->prepare("SELECT nama_minat_bakat FROM minat_bakat WHERE id_minat_bakat=?");
    $stmt->bind_param("i", $id_minat_bakat);
    $stmt->execute();
    $stmt->bind_result($nama_minat_bakat);
    $stmt->fetch();
    $stmt->close();

    $stmt = $mysqli->prepare("SELECT id, bidang_minat, minggu, deskripsi, materi, link_materi FROM materi_latihan WHERE bidang_minat=?");
    $stmt->bind_param("s", $nama_minat_bakat);
    $stmt->execute();
    $materi_result = $stmt->get_result();
}
include __DIR__ . '/../views/manajemen_materi.php';