<?php
// filepath: d:\dari c\2Xampp\instal\htdocs\SI-BIRAMA\app\views\hapus_pengumuman.php
session_start();
require_once __DIR__ . '/../config/config.php';

if (!isset($_SESSION["user"]["role"]) || $_SESSION["user"]["role"] !== "pengurus") {
    header("Location: beranda.php");
    exit();
}

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id > 0) {
    $stmt = $mysqli->prepare("DELETE FROM pengumuman WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}
header("Location: beranda.php");
exit();