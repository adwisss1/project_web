<?php
session_start();
require_once __DIR__ . '/../config/config.php';

if (!isset($_SESSION["user"]["role"]) || $_SESSION["user"]["role"] !== "pengurus") {
    header("Location: /SI-BIRAMA/app/controllers/beranda.php");
    exit();
}

$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : '';
$id   = isset($_GET['id']) ? intval($_GET['id']) : 0;
$error = "";

if ($aksi === 'tambah') {
    // Tambah pengumuman
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $isi = trim($_POST["isi"]);
        if ($isi === "") {
            $error = "Isi pengumuman tidak boleh kosong.";
        } else {
            $stmt = $mysqli->prepare("INSERT INTO pengumuman (isi) VALUES (?)");
            $stmt->bind_param("s", $isi);
            if ($stmt->execute()) {
                header("Location: /SI-BIRAMA/app/controllers/beranda.php");
                exit();
            } else {
                $error = "Gagal menambah pengumuman.";
            }
            $stmt->close();
        }
    }
    include __DIR__ . '/../../views/pengurus/tambah_pengumuman.php';

} elseif ($aksi === 'edit' && $id > 0) {
    // Edit pengumuman
    $stmt = $mysqli->prepare("SELECT isi FROM pengumuman WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($isi_pengumuman);
    if (!$stmt->fetch()) {
        $stmt->close();
        header("Location: /SI-BIRAMA/app/controllers/beranda.php");
        exit();
    }
    $stmt->close();

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $isi = trim($_POST["isi"]);
        if ($isi === "") {
            $error = "Isi pengumuman tidak boleh kosong.";
        } else {
            $stmt = $mysqli->prepare("UPDATE pengumuman SET isi=? WHERE id=?");
            $stmt->bind_param("si", $isi, $id);
            if ($stmt->execute()) {
                header("Location: /SI-BIRAMA/app/controllers/beranda.php");
                exit();
            } else {
                $error = "Gagal mengedit pengumuman.";
            }
            $stmt->close();
        }
    }
    include __DIR__ . '/../../views/pengurus/edit_pengumuman.php';

} elseif ($aksi === 'hapus' && $id > 0) {
    // Hapus pengumuman
    $stmt = $mysqli->prepare("DELETE FROM pengumuman WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    header("Location: /SI-BIRAMA/app/controllers/beranda.php");
    exit();

} else {
    header("Location: /SI-BIRAMA/app/controllers/beranda.php");
    exit();
}