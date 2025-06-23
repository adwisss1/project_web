<?php
// filepath: d:\dari c\2Xampp\instal\htdocs\SI-BIRAMA\app\controllers\pengurus\evaluasi_anggota.php
session_start();
require_once __DIR__ . '/../../config/config.php';

if (!isset($_SESSION["user"]) || $_SESSION["user"]["role"] !== "pengurus") {
    header("Location: ../login.php");
    exit();
}

function getEvaluasi($mysqli, $anggota_id) {
    $stmt = $mysqli->prepare("SELECT umpan_balik FROM evaluasi WHERE user_id = ?");
    $stmt->bind_param("i", $anggota_id);
    $stmt->execute();
    $stmt->bind_result($eval);
    $stmt->fetch();
    $stmt->close();
    return $eval;
}

$minat_result = $mysqli->query("SELECT id_minat_bakat, nama_minat_bakat FROM minat_bakat");
$minat_evaluasi = isset($_GET['minat_evaluasi']) ? intval($_GET['minat_evaluasi']) : 0;

$anggota = [];
if ($minat_evaluasi) {
    $stmt = $mysqli->prepare("
        SELECT a.id, a.nama, a.nra, a.angkatan
        FROM anggota a
        JOIN anggota_minat_bakat amb ON amb.id_anggota = a.id
        WHERE amb.id_minat_bakat = ?
    ");
    $stmt->bind_param("i", $minat_evaluasi);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $anggota[] = $row;
    }
    $stmt->close();
}

$mode = $_GET['mode'] ?? '';
$anggota_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Untuk mode view, ambil data anggota dan evaluasi
if ($mode === 'view' && $anggota_id > 0) {
    $stmt = $mysqli->prepare("SELECT nama, nra, angkatan FROM anggota WHERE id = ?");
    $stmt->bind_param("i", $anggota_id);
    $stmt->execute();
    $stmt->bind_result($nama, $nra, $angkatan);
    $stmt->fetch();
    $stmt->close();

    $stmt = $mysqli->prepare("SELECT umpan_balik FROM evaluasi WHERE user_id = ?");
    $stmt->bind_param("i", $anggota_id);
    $stmt->execute();
    $stmt->bind_result($umpan_balik);
    $stmt->fetch();
    $stmt->close();
}

// Untuk mode add/edit, ambil data anggota dan proses POST
if (($mode === 'add' || $mode === 'edit') && $anggota_id > 0) {
    $stmt = $mysqli->prepare("SELECT nama FROM anggota WHERE id = ?");
    $stmt->bind_param("i", $anggota_id);
    $stmt->execute();
    $stmt->bind_result($nama_anggota);
    $stmt->fetch();
    $stmt->close();

    $error = '';
    $umpan_balik = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $umpan_balik = trim($_POST['umpan_balik']);

        $stmt = $mysqli->prepare("SELECT COUNT(*) FROM evaluasi WHERE user_id = ?");
        $stmt->bind_param("i", $anggota_id);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();

        if ($count > 0) {
            $stmt = $mysqli->prepare("UPDATE evaluasi SET umpan_balik=? WHERE user_id=?");
            $stmt->bind_param("si", $umpan_balik, $anggota_id);
            if ($stmt->execute()) {
                header("Location: evaluasi_anggota.php?minat_evaluasi=$minat_evaluasi");
                exit();
            } else {
                $error = "Gagal mengupdate evaluasi.";
            }
        } else {
            $stmt = $mysqli->prepare("INSERT INTO evaluasi (user_id, umpan_balik) VALUES (?, ?)");
            $stmt->bind_param("is", $anggota_id, $umpan_balik);
            if ($stmt->execute()) {
                header("Location: evaluasi_anggota.php?minat_evaluasi=$minat_evaluasi");
                exit();
            } else {
                $error = "Gagal menambah evaluasi.";
            }
        }
    }

    if ($mode === 'edit' && !$umpan_balik) {
        $stmt = $mysqli->prepare("SELECT umpan_balik FROM evaluasi WHERE user_id = ?");
        $stmt->bind_param("i", $anggota_id);
        $stmt->execute();
        $stmt->bind_result($umpan_balik);
        $stmt->fetch();
        $stmt->close();
    }
}

// Kirim semua variabel ke view
include __DIR__ . '/../../views/pengurus/evaluasi_anggota.php';