<?php
// filepath: app/controllers/pengurus/edit_pengurus.php
session_start();
require_once __DIR__ . '/../../config/config.php';

$id_pengurus = isset($_GET['id_pengurus']) ? intval($_GET['id_pengurus']) : 0;
if ($id_pengurus <= 0) {
    die("ID pengurus tidak valid.");
}

// Ambil data pengurus
$stmt = $mysqli->prepare("SELECT nama_pengurus, nim, angkatan, jabatan, kontak FROM pengurus WHERE id_pengurus = ?");
$stmt->bind_param("i", $id_pengurus);
$stmt->execute();
$stmt->bind_result($nama_pengurus, $nim, $angkatan, $jabatan, $kontak);
$stmt->fetch();
$stmt->close();

if (!$nama_pengurus) {
    echo "Data pengurus tidak ditemukan.";
    exit();
}

// Kirim variabel ke view
include __DIR__ . '/../../views/pengurus/edit_pengurus.php';