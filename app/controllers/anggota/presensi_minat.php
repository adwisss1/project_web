<?php

session_start();
require_once __DIR__ . '/../../config/config.php';

if (!isset($_SESSION["user"]) || $_SESSION["user"]["role"] !== "anggota") {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION["user"]["id"];
$id_minat_bakat = isset($_GET['id_minat_bakat']) ? intval($_GET['id_minat_bakat']) : 0;
$id_sesi_absensi = isset($_GET['id_sesi_absensi']) ? intval($_GET['id_sesi_absensi']) : 0;

// Ambil nama minat bakat
$stmt = $mysqli->prepare("SELECT nama_minat_bakat FROM minat_bakat WHERE id_minat_bakat=?");
$stmt->bind_param("i", $id_minat_bakat);
$stmt->execute();
$stmt->bind_result($nama_minat_bakat);
$stmt->fetch();
$stmt->close();

// Cek status sesi absensi dan tanggal sesi
$tanggal_sesi = null;
$status_sesi = null;
if ($id_sesi_absensi) {
    $stmt = $mysqli->prepare("SELECT tanggal, status FROM sesi_absensi WHERE id=?");
    $stmt->bind_param("i", $id_sesi_absensi);
    $stmt->execute();
    $stmt->bind_result($tanggal_sesi, $status_sesi);
    $stmt->fetch();
    $stmt->close();
}

// Cek apakah sudah absen
$already_absen = false;
$status_kehadiran = '';
if ($id_sesi_absensi) {
    $stmt = $mysqli->prepare("SELECT status_kehadiran FROM absensi WHERE user_id=? AND id_sesi_absensi=?");
    $stmt->bind_param("ii", $user_id, $id_sesi_absensi);
    $stmt->execute();
    $stmt->bind_result($status_kehadiran);
    if ($stmt->fetch()) {
        $already_absen = true;
    }
    $stmt->close();
}

// Proses submit presensi
if (
    $_SERVER["REQUEST_METHOD"] == "POST"
    && $id_sesi_absensi
    && $tanggal_sesi
    && $status_sesi === 'dibuka'
    && !$already_absen
) {
    $status_kehadiran = $_POST["status_kehadiran"];
    $stmt = $mysqli->prepare("INSERT INTO absensi (user_id, tanggal, status_kehadiran, id_sesi_absensi) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("issi", $user_id, $tanggal_sesi, $status_kehadiran, $id_sesi_absensi);
    $stmt->execute();
    $stmt->close();
    header("Location: presensi_minat.php?id_minat_bakat=$id_minat_bakat&id_sesi_absensi=$id_sesi_absensi&success=1");
    exit();
}

// Ambil histori absensi user untuk minat bakat ini
$histori = [];
$result = $mysqli->query("SELECT ab.tanggal, ab.status_kehadiran 
    FROM absensi ab
    JOIN sesi_absensi sa ON ab.id_sesi_absensi = sa.id
    WHERE ab.user_id = $user_id AND sa.id_jadwal IN (
        SELECT id FROM jadwal_rutin WHERE id_minat_bakat = $id_minat_bakat
        UNION
        SELECT id FROM jadwal_kondisional WHERE id_minat_bakat = $id_minat_bakat
    )
    ORDER BY ab.tanggal DESC");
while ($row = $result->fetch_assoc()) {
    $histori[] = $row;
}

// Kirim ke view
include __DIR__ . '/../../views/anggota/presensi_minat.php';