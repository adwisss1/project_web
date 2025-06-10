<?php
// filepath: d:\dari c\2Xampp\instal\htdocs\SI-BIRAMA\app\controllers\update_pengurus.php
require_once __DIR__ . '/../config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_pengurus = intval($_POST['id_pengurus']);
    $nama_pengurus = trim($_POST['nama_pengurus']);
    $nim = trim($_POST['nim']);
    $angkatan = intval($_POST['angkatan']);
    $jabatan = trim($_POST['jabatan']);
    $kontak = trim($_POST['kontak']);

    $stmt = $mysqli->prepare("UPDATE pengurus SET nama_pengurus=?, nim=?, angkatan=?, jabatan=?, kontak=? WHERE id_pengurus=?");
    $stmt->bind_param("ssissi", $nama_pengurus, $nim, $angkatan, $jabatan, $kontak, $id_pengurus);

    if ($stmt->execute()) {
        $stmt->close();
        header("Location: ../views/beranda_pengurus.php?success=1");
        exit();
    } else {
        $stmt->close();
        header("Location: ../views/edit_pengurus.php?id_pengurus=$id_pengurus&error=1");
        exit();
    }
} else {
    header("Location: ../views/manajemen_pengurus.php");
    exit();
}