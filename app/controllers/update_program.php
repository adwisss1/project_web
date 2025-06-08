<?php
session_start();
require_once __DIR__ . '/../config/config.php';

if (!isset($_SESSION["user"]) || $_SESSION["role"] !== "pengurus") {
    header("Location: ../views/kontrol_program.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $nama_program = $_POST['nama_program'];
    $tanggal_mulai = $_POST['tanggal_mulai'];
    $tanggal_selesai = $_POST['tanggal_selesai'];
    $tanggal_selesai_agenda = $_POST['tanggal_selesai_agenda'];
    $deskripsi = $_POST['deskripsi'];
    $pj_pengurus = $_POST['pj_pengurus'];
    $ketua_panitia = $_POST['ketua_panitia'];
    $status = $_POST['status'];

    $stmt = $mysqli->prepare("UPDATE program_kerja SET nama_program=?, tanggal_mulai=?, tanggal_selesai=?, tanggal_selesai_agenda=?, deskripsi=?, pj_pengurus=?, ketua_panitia=?, status=? WHERE id=?");
    $stmt->bind_param("ssssssssi", $nama_program, $tanggal_mulai, $tanggal_selesai, $tanggal_selesai_agenda, $deskripsi, $pj_pengurus, $ketua_panitia, $status, $id);
    $stmt->execute();
}

header("Location: ../views/kontrol_program.php");
exit();