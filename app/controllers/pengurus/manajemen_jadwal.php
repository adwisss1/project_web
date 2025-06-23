<?php
// filepath: d:\dari c\2Xampp\instal\htdocs\SI-BIRAMA\app\controllers\pengurus\manajemen_jadwal.php
session_start();
require_once __DIR__ . '/../../config/config.php';

if (!isset($_SESSION["user"]) || $_SESSION["user"]["role"] !== "pengurus") {
    header("Location: ../login.php");
    exit();
}

// Ambil jadwal rutin
$stmt = $mysqli->prepare("
    SELECT jr.id, mb.nama_minat_bakat, jr.hari, jr.jam, jr.durasi_latihan, jr.mentor 
    FROM jadwal_rutin jr
    INNER JOIN minat_bakat mb ON jr.id_minat_bakat = mb.id_minat_bakat
");
$stmt->execute();
$jadwal_rutin_result = $stmt->get_result();

// Ambil jadwal kondisional
$stmt = $mysqli->prepare("
    SELECT jk.id, mb.nama_minat_bakat, jk.tanggal, jk.jam, jk.keterangan
    FROM jadwal_kondisional jk
    INNER JOIN minat_bakat mb ON jk.id_minat_bakat = mb.id_minat_bakat
    ORDER BY jk.tanggal DESC, jk.jam DESC
");
$stmt->execute();
$jadwal_kondisional_result = $stmt->get_result();

include __DIR__ . '/../../views/pengurus/manajemen_jadwal.php';