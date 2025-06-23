<?php

session_start();
require_once __DIR__ . '/../../config/config.php';

if (!isset($_SESSION["user"]) || $_SESSION["user"]["role"] !== "anggota") {
    header("Location: login.php");
    exit();
}

// Ambil semua minat bakat dari database
$minat_query = $mysqli->query("SELECT * FROM minat_bakat");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION["user"]["id"];
    $id_minat_bakat = $_POST["bidang_minat"];
    $enrollment_key = $_POST["enrollment_key"];

    // Validasi enrollment key
    $validasi_query = $mysqli->prepare("SELECT * FROM minat_bakat WHERE id_minat_bakat = ? AND enrollment_key = ?");
    $validasi_query->bind_param("is", $id_minat_bakat, $enrollment_key);
    $validasi_query->execute();
    $result = $validasi_query->get_result();

    if ($result->num_rows > 0) {
        // Ambil id_anggota dari user_id
        $stmt = $mysqli->prepare("SELECT id FROM anggota WHERE user_id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $stmt->bind_result($id_anggota);
        $stmt->fetch();
        $stmt->close();

        if (!$id_anggota) {
            $error_message = "Data anggota tidak ditemukan.";
        } else {
            // Cek apakah user sudah pernah enroll minat bakat ini
            $cek = $mysqli->prepare("SELECT * FROM anggota_minat_bakat WHERE id_anggota = ? AND id_minat_bakat = ?");
            $cek->bind_param("ii", $id_anggota, $id_minat_bakat);
            $cek->execute();
            $cek_result = $cek->get_result();
            if ($cek_result->num_rows > 0) {
                $error_message = "Anda sudah terdaftar pada minat bakat ini.";
            } else {
                // Insert ke tabel anggota_minat_bakat
                $stmt = $mysqli->prepare("INSERT INTO anggota_minat_bakat (id_anggota, id_minat_bakat) VALUES (?, ?)");
                $stmt->bind_param("ii", $id_anggota, $id_minat_bakat);
                $stmt->execute();
                header("Location: beranda_anggota.php?success=enrolled");
                exit();
            }
        }
    } else {
        $error_message = "Enrollment key tidak valid!";
    }
}

// Kirim ke view
include __DIR__ . '/../../views/anggota/enroll_minat.php';