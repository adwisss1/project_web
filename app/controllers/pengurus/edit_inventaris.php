<?php
// filepath: d:\dari c\2Xampp\instal\htdocs\SI-BIRAMA\app\controllers\pengurus\edit_inventaris.php
session_start();
require_once __DIR__ . '/../../config/config.php';

if (!isset($_SESSION["user"]["role"]) || $_SESSION["user"]["role"] !== "pengurus") {
    header("Location: beranda.php");
    exit();
}

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$error = "";

// Perbaikan: gunakan id_item sesuai struktur tabel
$stmt = $mysqli->prepare("SELECT nama_item, harga_sewa FROM inventaris WHERE id_item=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($nama_item, $harga_sewa);
if (!$stmt->fetch()) {
    $stmt->close();
    header("Location: manajemen_talent&inventaris.php");
    exit();
}
$stmt->close();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nama_item = trim($_POST["nama_item"]);
    $harga_sewa = trim($_POST["harga_sewa"]);
    if ($nama_item === "" || $harga_sewa === "") {
        $error = "Nama item dan harga sewa tidak boleh kosong.";
    } else {
        $stmt = $mysqli->prepare("UPDATE inventaris SET nama_item=?, harga_sewa=? WHERE id_item=?");
        $stmt->bind_param("sdi", $nama_item, $harga_sewa, $id);
        if ($stmt->execute()) {
            header("Location: manajemen_talent&inventaris.php");
            exit();
        } else {
            $error = "Gagal mengedit inventaris.";
        }
        $stmt->close();
    }
}

// Kirim data ke view
include __DIR__ . '/../../views/pengurus/edit_inventaris.php';