<?php
// filepath: d:\dari c\2Xampp\instal\htdocs\SI-BIRAMA\app\views\hapus_portofolio.php
session_start();
require_once __DIR__ . '/../config/config.php';

if (!isset($_SESSION["user"]["role"]) || $_SESSION["user"]["role"] !== "pengurus") {
    header("Location: beranda.php");
    exit();
}

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id > 0) {
    $stmt = $mysqli->prepare("DELETE FROM portofolio WHERE id_portofolio=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}
header("Location: portofolio.php");
exit();