<?php

session_start();
require_once __DIR__ . '/../../config/config.php';

// Pastikan pengguna sudah login dan memiliki role anggota
if (!isset($_SESSION["user"]) || !is_array($_SESSION["user"]) || $_SESSION["user"]["role"] !== "anggota") {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION["user"]["id"];
$username = $_SESSION["user"]["username"];

// Ambil evaluasi anggota berdasarkan user_id
$stmt = $mysqli->prepare("SELECT * FROM evaluasi WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$evaluasi_result = $stmt->get_result();
$evaluasi = $evaluasi_result->fetch_assoc();

// Ambil semua id_minat_bakat yang diikuti anggota
$stmt = $mysqli->prepare("
    SELECT mb.id_minat_bakat, mb.nama_minat_bakat 
    FROM anggota_minat_bakat amb
    JOIN anggota a ON amb.id_anggota = a.id
    JOIN minat_bakat mb ON amb.id_minat_bakat = mb.id_minat_bakat
    WHERE a.user_id = ?
");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$minat_result = $stmt->get_result();
$minat_bakat_list = [];
while ($row = $minat_result->fetch_assoc()) {
    $minat_bakat_list[] = $row;
}

// Kirim ke view
include __DIR__ . '/../../views/anggota/beranda_anggota.php';