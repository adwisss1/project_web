<?php
session_start();
require_once __DIR__ . '/../config/config.php';

$is_pengurus = isset($_SESSION["user"]["role"]) && $_SESSION["user"]["role"] === "pengurus";
$portofolio = $mysqli->query("SELECT * FROM portofolio ORDER BY id_portofolio DESC");

// Kirim ke view
include __DIR__ . '/../views/portofolio.php';