<?php
// filepath: d:\dari c\2Xampp\instal\htdocs\SI-BIRAMA\app\controllers\pengurus\manajemen_anggota_kinerja.php
session_start();
require_once __DIR__ . '/../../config/config.php';

// Autentikasi
if (!isset($_SESSION["user"]) || $_SESSION["user"]["role"] !== "pengurus") {
    header("Location: ../login.php");
    exit();
}

// Ambil data angkatan dan minat bakat
$angkatan_result = $mysqli->query("SELECT DISTINCT angkatan FROM anggota ORDER BY angkatan DESC");
$minat_result = $mysqli->query("SELECT id_minat_bakat, nama_minat_bakat FROM minat_bakat");

// Filter
$filter_angkatan = $_GET['angkatan'] ?? '';
$filter_minat = $_GET['minat'] ?? '';
$search = $_GET['search'] ?? '';

// Pagination
$per_page = 25;
$page = max(1, intval($_GET['page'] ?? 1));
$offset = ($page - 1) * $per_page;

// Hitung total rows
$count_query = "SELECT COUNT(DISTINCT anggota.id) FROM anggota WHERE 1";
$count_params = []; $count_types = '';
if ($filter_angkatan !== '') {
    $count_query .= " AND anggota.angkatan = ? ";
    $count_params[] = $filter_angkatan;
    $count_types .= 'i';
}
if ($filter_minat !== '') {
    $count_query .= " AND EXISTS (SELECT 1 FROM anggota_minat_bakat amb WHERE amb.id_anggota = anggota.id AND amb.id_minat_bakat = ?) ";
    $count_params[] = $filter_minat;
    $count_types .= 'i';
}
if ($search !== '') {
    $count_query .= " AND (anggota.nama LIKE ? OR anggota.nra LIKE ?) ";
    $count_params[] = "%$search%"; $count_params[] = "%$search%";
    $count_types .= 'ss';
}
$count_stmt = $mysqli->prepare($count_query);
if (!empty($count_params)) $count_stmt->bind_param($count_types, ...$count_params);
$count_stmt->execute(); $count_stmt->bind_result($total_rows); $count_stmt->fetch(); $count_stmt->close();
$total_pages = max(1, ceil($total_rows / $per_page));

// Query data anggota
$query = "SELECT DISTINCT anggota.id, anggota.nama, anggota.nra, anggota.user_id, anggota.angkatan FROM anggota WHERE 1";
$params = []; $types = '';
if ($filter_angkatan !== '') {
    $query .= " AND anggota.angkatan = ? ";
    $params[] = $filter_angkatan; $types .= 'i';
}
if ($filter_minat !== '') {
    $query .= " AND EXISTS (SELECT 1 FROM anggota_minat_bakat amb WHERE amb.id_anggota = anggota.id AND amb.id_minat_bakat = ?) ";
    $params[] = $filter_minat; $types .= 'i';
}
if ($search !== '') {
    $query .= " AND (anggota.nama LIKE ? OR anggota.nra LIKE ?) ";
    $params[] = "%$search%"; $params[] = "%$search%"; $types .= 'ss';
}
$query .= " ORDER BY anggota.angkatan DESC, anggota.nama ASC LIMIT ? OFFSET ?";
$params[] = $per_page; $params[] = $offset; $types .= 'ii';
$stmt = $mysqli->prepare($query);
if (!empty($params)) $stmt->bind_param($types, ...$params);
$stmt->execute();
$anggota_result = $stmt->get_result();

// Ambil relasi minat bakat
$anggota_minat = [];
$minat_sql = "SELECT amb.id_anggota, mb.nama_minat_bakat FROM anggota_minat_bakat amb JOIN minat_bakat mb ON amb.id_minat_bakat = mb.id_minat_bakat";
$minat_res = $mysqli->query($minat_sql);
while ($row = $minat_res->fetch_assoc()) {
    $anggota_minat[$row['id_anggota']][] = $row['nama_minat_bakat'];
}

// Kirim data ke view
include __DIR__ . '/../../views/pengurus/manajemen_anggota_kinerja.php';