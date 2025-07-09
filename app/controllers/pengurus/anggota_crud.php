<?php
ob_start();
session_start();
require_once __DIR__ . '/../../config/config.php';

if (!isset($_SESSION["user"]) || $_SESSION["role"] !== "pengurus") {
    header("Location: ../login.php");
    exit();
}

$mode = $_GET['mode'] ?? 'add';
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$error = '';
$success = '';

$minat_result = $mysqli->query("SELECT id_minat_bakat, nama_minat_bakat FROM minat_bakat");

$nama = $nra = $angkatan = $id_minat_bakat = '';
if ($mode === 'edit' && $id) {
    $stmt = $mysqli->prepare("SELECT nama, nra, angkatan FROM anggota WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($nama, $nra, $angkatan);
    $stmt->fetch();
    $stmt->close();

    if (!$nama) {
        die("Anggota tidak ditemukan.");
    }

    $stmt = $mysqli->prepare("SELECT id_minat_bakat FROM anggota_minat_bakat WHERE id_anggota = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($id_minat_bakat);
    $stmt->fetch();
    $stmt->close();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($mode === 'add' || $mode === 'edit')) {
    $nama = trim($_POST['nama'] ?? '');
    $nra = trim($_POST['nra'] ?? '');
    $angkatan = trim($_POST['angkatan'] ?? '');
    $id_minat_bakat = intval($_POST['id_minat_bakat'] ?? 0);

    if ($nama === '' || $nra === '' || $angkatan === '' || $id_minat_bakat === 0) {
        $error = "Semua field wajib diisi!";
    }

    if ($mode === 'add' && !$error) {
        $username = trim($_POST['username'] ?? '');
        $password = trim($_POST['password'] ?? '');

        if ($username === '' || $password === '') {
            $error = "Username dan password harus diisi.";
        } else {
            $cek = $mysqli->prepare("SELECT COUNT(*) FROM users WHERE username=?");
            $cek->bind_param("s", $username);
            $cek->execute();
            $cek->bind_result($sudah_ada);
            $cek->fetch();
            $cek->close();

            if ($sudah_ada > 0) {
                $error = "Username sudah digunakan.";
            }
        }

        if (!$error) {
            $cek_nra = $mysqli->prepare("SELECT COUNT(*) FROM anggota WHERE nra = ?");
            $cek_nra->bind_param("s", $nra);
            $cek_nra->execute();
            $cek_nra->bind_result($nra_ada);
            $cek_nra->fetch();
            $cek_nra->close();

            if ($nra_ada > 0) {
                $error = "NRA sudah digunakan. Gunakan NRA yang unik.";
            }
        }

        if (!$error) {
            try {
                $stmt = $mysqli->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, 'anggota')");
                $stmt->bind_param("ss", $username, $password);
                $stmt->execute();
                $user_id = $stmt->insert_id;
                $stmt->close();

                $stmt = $mysqli->prepare("INSERT INTO anggota (user_id, nama, nra, angkatan) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("issi", $user_id, $nama, $nra, $angkatan);
                $stmt->execute();
                $id_anggota = $stmt->insert_id;
                $stmt->close();

                $stmt = $mysqli->prepare("INSERT INTO anggota_minat_bakat (id_anggota, id_minat_bakat) VALUES (?, ?)");
                $stmt->bind_param("ii", $id_anggota, $id_minat_bakat);
                $stmt->execute();
                $stmt->close();

                header("Location: manajemen_anggota_kinerja.php");
                exit();
            } catch (mysqli_sql_exception $e) {
                $error = "Gagal menambah anggota. Pastikan semua data valid dan NRA belum digunakan.";
            }
        }
    } elseif ($mode === 'edit' && !$error) {
        try {
            $stmt = $mysqli->prepare("UPDATE anggota SET nama=?, nra=?, angkatan=? WHERE id=?");
            $stmt->bind_param("sssi", $nama, $nra, $angkatan, $id);
            $stmt->execute();
            $stmt->close();

            $stmt = $mysqli->prepare("UPDATE anggota_minat_bakat SET id_minat_bakat=? WHERE id_anggota=?");
            $stmt->bind_param("ii", $id_minat_bakat, $id);
            $stmt->execute();
            $stmt->close();

            header("Location: manajemen_anggota_kinerja.php");
            exit();
        } catch (mysqli_sql_exception $e) {
            $error = "Gagal mengubah data anggota.";
        }
    }
}

include __DIR__ . '/../../views/pengurus/anggota_crud.php';
