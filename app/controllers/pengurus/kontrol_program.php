<?php
// filepath: d:\dari c\2Xampp\instal\htdocs\SI-BIRAMA\app\controllers\pengurus\kontrol_program.php
session_start();
require_once __DIR__ . '/../../config/config.php';

// Ambil data program kerja lengkap
$stmt = $mysqli->prepare("
    SELECT pk.id, pk.nama_program, pk.tanggal_mulai, pk.tanggal_selesai, pk.deskripsi, 
           pk.pj_pengurus, pengurus.nama_pengurus, 
           pk.ketua_panitia, anggota.nama AS nama_ketua, 
           pk.status, pk.tanggal_selesai_agenda
    FROM program_kerja pk
    LEFT JOIN pengurus ON pk.pj_pengurus = pengurus.id_pengurus
    LEFT JOIN anggota ON pk.ketua_panitia = anggota.id
");
$stmt->execute();
$program_result = $stmt->get_result();

// Dropdown filter progress
$program_list = $mysqli->query("SELECT id, nama_program FROM program_kerja");

// Ambil filter
$filter_program = isset($_GET['filter_program']) ? intval($_GET['filter_program']) : 0;

// Ambil progress
$progress_sql = "
    SELECT p.id, p.id_program, pk.nama_program, p.laporan, p.tanggal_update, pengurus.nama_pengurus
    FROM progress_proker p
    JOIN program_kerja pk ON p.id_program = pk.id
    LEFT JOIN pengurus ON pk.pj_pengurus = pengurus.id_pengurus
";
if ($filter_program) {
    $progress_sql .= " WHERE p.id_program = $filter_program ";
}
$progress_sql .= " ORDER BY p.tanggal_update DESC";
$progress_result = $mysqli->query($progress_sql);

// Kirim ke view
include __DIR__ . '/../../views/pengurus/kontrol_program.php';