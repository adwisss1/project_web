<?php
// filepath: d:\dari c\2Xampp\instal\htdocs\SI-BIRAMA\app\controllers\pengurus\edit_talent.php
session_start();
require_once __DIR__ . '/../../config/config.php';

if (!isset($_SESSION["user"]["role"]) || $_SESSION["user"]["role"] !== "pengurus") {
    header("Location: beranda.php");
    exit();
}

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$error = "";

$stmt = $mysqli->prepare("SELECT jenis_talent, keterangan FROM talent WHERE id_talent=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($jenis_talent, $keterangan);
if (!$stmt->fetch()) {
    $stmt->close();
    header("Location: manajemen_talent&inventaris.php");
    exit();
}
$stmt->close();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $jenis_talent = trim($_POST["jenis_talent"]);
    $keterangan = trim($_POST["keterangan"]);
    if ($jenis_talent === "") {
        $error = "Jenis talent tidak boleh kosong.";
    } else {
        $stmt = $mysqli->prepare("UPDATE talent SET jenis_talent=?, keterangan=? WHERE id_talent=?");
        $stmt->bind_param("ssi", $jenis_talent, $keterangan, $id);
        if ($stmt->execute()) {
            header("Location: manajemen_talent&inventaris.php");
            exit();
        } else {
            $error = "Gagal mengedit talent.";
        }
        $stmt->close();
    }
}

// Kirim data ke view
include __DIR__ . '/../../views/pengurus/edit_talent.php';