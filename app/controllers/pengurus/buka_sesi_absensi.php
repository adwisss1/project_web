<?php
// filepath: d:\dari c\2Xampp\instal\htdocs\SI-BIRAMA\app\controllers\pengurus\buka_sesi_absensi.php
session_start();
require_once __DIR__ . '/../../config/config.php';
if (!isset($_SESSION["user"]) || $_SESSION["user"]["role"] !== "pengurus") {
    header("Location: ../login.php");
    exit();
}

$id_jadwal = isset($_GET['id_jadwal']) ? intval($_GET['id_jadwal']) : 0;
$tipe = $_GET['tipe'] ?? 'rutin';
$error = '';
$sesi_id = null;
$tanggal_sesi = null;

// Ambil id_minat_bakat dari jadwal
if ($tipe === 'rutin') {
    $stmt = $mysqli->prepare("SELECT id_minat_bakat FROM jadwal_rutin WHERE id=?");
} else {
    $stmt = $mysqli->prepare("SELECT id_minat_bakat FROM jadwal_kondisional WHERE id=?");
}
$stmt->bind_param("i", $id_jadwal);
$stmt->execute();
$stmt->bind_result($id_minat_bakat);
$stmt->fetch();
$stmt->close();

// Cek sesi absensi yang sedang dibuka
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tanggal = $_POST["tanggal"];
    $nama_sesi = "Absensi " . ucfirst($tipe);

    // Tutup sesi sebelumnya jika ada
    $mysqli->query("UPDATE sesi_absensi SET status='ditutup' WHERE id_jadwal=$id_jadwal AND status='dibuka'");

    // Buka sesi baru
    $stmt = $mysqli->prepare("INSERT INTO sesi_absensi (id_jadwal, nama_sesi, tanggal, status) VALUES (?, ?, ?, 'dibuka')");
    $stmt->bind_param("iss", $id_jadwal, $nama_sesi, $tanggal);
    if ($stmt->execute()) {
        $sesi_id = $stmt->insert_id;
        $tanggal_sesi = $tanggal;
        $stmt->close();
        header("Location: buka_sesi_absensi.php?id_jadwal=$id_jadwal&tipe=$tipe");
        exit();
    } else {
        $error = "Gagal membuka sesi absensi.";
        $stmt->close();
    }
} else {
    // Cek sesi yang sedang dibuka
    $stmt = $mysqli->prepare("SELECT id, tanggal FROM sesi_absensi WHERE id_jadwal=? AND status='dibuka' ORDER BY id DESC LIMIT 1");
    $stmt->bind_param("i", $id_jadwal);
    $stmt->execute();
    $stmt->bind_result($sesi_id, $tanggal_sesi);
    $stmt->fetch();
    $stmt->close();
}

// Data untuk rekap absensi
$bulan = isset($_GET['bulan']) ? intval($_GET['bulan']) : date('n');
$tahun = isset($_GET['tahun']) ? intval($_GET['tahun']) : date('Y');

$tanggal_sesi_arr = [];
$result = $mysqli->query("SELECT id, tanggal FROM sesi_absensi 
    WHERE id_jadwal = $id_jadwal 
    AND MONTH(tanggal) = $bulan AND YEAR(tanggal) = $tahun
    ORDER BY tanggal ASC");
while ($row = $result->fetch_assoc()) {
    $tanggal_sesi_arr[$row['id']] = $row['tanggal'];
}

$anggota = [];
$result = $mysqli->query("SELECT a.id, a.nama FROM anggota a
    INNER JOIN anggota_minat_bakat amb ON a.id = amb.id_anggota
    WHERE amb.id_minat_bakat = $id_minat_bakat");
while ($row = $result->fetch_assoc()) {
    $anggota[$row['id']] = $row['nama'];
}

$absensi = [];
if (!empty($tanggal_sesi_arr)) {
    $sesi_ids = implode(',', array_keys($tanggal_sesi_arr));
    $result = $mysqli->query("SELECT ab.user_id, ab.id_sesi_absensi, ab.status_kehadiran, a.id as id_anggota
        FROM absensi ab
        JOIN anggota a ON ab.user_id = a.user_id
        WHERE ab.id_sesi_absensi IN ($sesi_ids)");
    while ($row = $result->fetch_assoc()) {
        $absensi[$row['id_anggota']][$row['id_sesi_absensi']] = $row['status_kehadiran'];
    }
}

// Kirim ke view
include __DIR__ . '/../../views/pengurus/buka_sesi_absensi.php';