<?php
// filepath: d:\dari c\2Xampp\instal\htdocs\SI-BIRAMA\app\controllers\pengurus\manajemen_materi.php
session_start();
require_once __DIR__ . '/../../config/config.php';

if (!isset($_SESSION["user"]) || $_SESSION["user"]["role"] !== "pengurus") {
    header("Location: login.php");
    exit();
}

$minat_result = $mysqli->query("SELECT id_minat_bakat, nama_minat_bakat FROM minat_bakat");

$id_minat_bakat = isset($_GET['id_minat_bakat']) ? intval($_GET['id_minat_bakat']) : 0;
$bidang_minat = isset($_GET['bidang_minat']) ? $_GET['bidang_minat'] : '';
$nama_minat_bakat = '';
if ($id_minat_bakat) {
    $stmt = $mysqli->prepare("SELECT nama_minat_bakat FROM minat_bakat WHERE id_minat_bakat=?");
    $stmt->bind_param("i", $id_minat_bakat);
    $stmt->execute();
    $stmt->bind_result($nama_minat_bakat);
    $stmt->fetch();
    $stmt->close();
    if (!$bidang_minat) $bidang_minat = $nama_minat_bakat;
}

$materi_result = null;
if ($id_minat_bakat && $bidang_minat) {
    $stmt = $mysqli->prepare("SELECT id, bidang_minat, minggu, deskripsi, materi, link_materi FROM materi_latihan WHERE bidang_minat=?");
    $stmt->bind_param("s", $bidang_minat);
    $stmt->execute();
    $materi_result = $stmt->get_result();
}

// Kirim data ke view
include __DIR__ . '/../../views/pengurus/manajemen_materi.php';