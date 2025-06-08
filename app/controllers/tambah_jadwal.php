<?php

session_start();
require_once __DIR__ . '/../config/config.php';

if (!isset($_SESSION["user"]) || $_SESSION["role"] !== "pengurus") {
    header("Location: ../views/manajemen_jadwal.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_minat_bakat = isset($_POST['id_minat_bakat']) ? intval($_POST['id_minat_bakat']) : 0;
    $tanggal = isset($_POST['tanggal']) ? $_POST['tanggal'] : '';
    $jam = isset($_POST['jam']) ? $_POST['jam'] : '';
    $keterangan = isset($_POST['keterangan']) ? trim($_POST['keterangan']) : '';

    if ($id_minat_bakat && $tanggal && $jam) {
        $stmt = $mysqli->prepare("INSERT INTO jadwal_kondisional (id_minat_bakat, tanggal, jam, keterangan) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isss", $id_minat_bakat, $tanggal, $jam, $keterangan);
        $stmt->execute();
    }
}

header("Location: ../views/manajemen_jadwal.php");
exit();