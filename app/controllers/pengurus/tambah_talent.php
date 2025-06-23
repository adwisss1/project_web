<?php
// filepath: d:\dari c\2Xampp\instal\htdocs\SI-BIRAMA\app\controllers\pengurus\tambah_talent.php
session_start();
require_once __DIR__ . '/../../config/config.php';

// Hanya pengurus yang boleh akses
if (!isset($_SESSION["user"]["role"]) || $_SESSION["user"]["role"] !== "pengurus") {
    header("Location: beranda.php");
    exit();
}

$error = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $jenis_talent = trim($_POST["jenis_talent"]);
    $keterangan = trim($_POST["keterangan"]);
    if ($jenis_talent === "") {
        $error = "Jenis talent tidak boleh kosong.";
    } else {
        $stmt = $mysqli->prepare("INSERT INTO talent (jenis_talent, keterangan) VALUES (?, ?)");
        $stmt->bind_param("ss", $jenis_talent, $keterangan);
        if ($stmt->execute()) {
            header("Location: manajemen_talent&inventaris.php");
            exit();
        } else {
            $error = "Gagal menambah talent.";
        }
        $stmt->close();
    }
}

// Kirim data ke view
include __DIR__ . '/../../views/pengurus/tambah_talent.php';