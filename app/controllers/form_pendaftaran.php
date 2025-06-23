<?php

session_start();
require_once __DIR__ . '/../config/config.php';

$error = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nama = trim($_POST["nama"]);
    $no_hp = trim($_POST["no_hp"]);
    $jurusan = trim($_POST["jurusan"]);
    $nim = trim($_POST["nim"]);
    $minat_bakat = trim($_POST["minat_bakat"]);

    if ($nama === "" || $no_hp === "" || $jurusan === "" || $nim === "" || $minat_bakat === "") {
        $error = "Semua field wajib diisi.";
    } else {
        $stmt = $mysqli->prepare("INSERT INTO pendaftaran (nama, no_hp, jurusan, nim, minat_bakat) VALUES (?, ?, ?, ?, ?)");
        if (!$stmt) {
            $error = "Prepare failed: " . $mysqli->error;
        } else {
            $stmt->bind_param("sssss", $nama, $no_hp, $jurusan, $nim, $minat_bakat);
            if ($stmt->execute()) {
                echo "<script>alert('Formulir pendaftaran anda sudah terkirim, informasi selanjutnya akan ditampilkan di pengumuman dan/atau melalui pesan WA anda');window.location='beranda.php';</script>";
                exit;
            } else {
                $error = "Gagal menyimpan data: " . $stmt->error;
            }
            $stmt->close();
        }
    }
}

include __DIR__ . '/../views/form_pendaftaran.php';