<?php
session_start();
require_once __DIR__ . '/../../config/config.php';

if (!isset($_SESSION["user"]) || $_SESSION["user"]["role"] !== "anggota") {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION["user"]["id"];

// Ambil informasi minat bakat anggota
$minat_query = $mysqli->query("
    SELECT mb.id_minat_bakat, mb.nama_minat_bakat 
    FROM anggota_minat_bakat amb
    JOIN anggota a ON amb.id_anggota = a.id
    JOIN minat_bakat mb ON amb.id_minat_bakat = mb.id_minat_bakat
    WHERE a.user_id = $user_id
");

// Tahun kepengurusan
$tahun_kepengurusan = "2025";

// Ambil sesi absensi aktif per minat bakat
$sesi_aktif = [];
$q = $mysqli->query("SELECT sa.id, sa.id_jadwal, jr.id_minat_bakat 
    FROM sesi_absensi sa
    JOIN jadwal_rutin jr ON sa.id_jadwal = jr.id
    WHERE sa.status = 'dibuka'
    UNION
    SELECT sa.id, sa.id_jadwal, jk.id_minat_bakat 
    FROM sesi_absensi sa
    JOIN jadwal_kondisional jk ON sa.id_jadwal = jk.id
    WHERE sa.status = 'dibuka'
");
while ($row = $q->fetch_assoc()) {
    $sesi_aktif[$row['id_minat_bakat']] = $row['id'];
}

// Kirim ke view
include __DIR__ . '/../../views/anggota/absensi.php';