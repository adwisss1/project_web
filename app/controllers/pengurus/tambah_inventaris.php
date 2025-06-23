<?php
// filepath: d:\dari c\2Xampp\instal\htdocs\SI-BIRAMA\app\controllers\pengurus\tambah_inventaris.php
session_start();
require_once __DIR__ . '/../../config/config.php';

if (!isset($_SESSION["user"]["role"]) || $_SESSION["user"]["role"] !== "pengurus") {
    header("Location: beranda.php");
    exit();
}

$error = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nama_item = trim($_POST["nama_item"]);
    $harga_sewa = trim($_POST["harga_sewa"]);
    if ($nama_item === "" || $harga_sewa === "") {
        $error = "Nama item dan harga sewa tidak boleh kosong.";
    } else {
        $stmt = $mysqli->prepare("INSERT INTO inventaris (nama_item, harga_sewa) VALUES (?, ?)");
        $stmt->bind_param("sd", $nama_item, $harga_sewa);
        if ($stmt->execute()) {
            header("Location: manajemen_talent&inventaris.php");
            exit();
        } else {
            $error = "Gagal menambah inventaris.";
        }
        $stmt->close();
    }
}

// Kirim data ke view
include __DIR__ . '/../../views/pengurus/tambah_inventaris.php';