<?php
session_start();
require_once __DIR__ . '/../config/config.php';

// Cek role login untuk mode CRUD pengumuman/informasi
$is_pengurus = isset($_SESSION["user"]) && is_array($_SESSION["user"]) && isset($_SESSION["user"]["role"]) && $_SESSION["user"]["role"] === "pengurus";

// Ambil data dari database
$talent = $mysqli->query("SELECT * FROM talent");
$inventaris = $mysqli->query("SELECT * FROM inventaris");
$pengumuman = $mysqli->query("SELECT * FROM pengumuman ORDER BY id DESC");

// Kirim ke view
include __DIR__ . '/../views/beranda.php';