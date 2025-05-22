<?php
session_start();
require_once __DIR__ . '/../config/config.php';

// Pastikan user adalah pengurus
if (!isset($_SESSION["user"]) || $_SESSION["role"] !== "pengurus") {
    header("Location: ../login.php");
    exit();
}

// Ambil daftar anggota
$stmt = $mysqli->prepare("
    SELECT anggota.id, anggota.nama, anggota.nra, anggota.user_id, anggota.id_minat_bakat, 
           minat_bakat.nama_minat_bakat 
    FROM anggota 
    LEFT JOIN minat_bakat ON anggota.id_minat_bakat = minat_bakat.id_minat_bakat");
$stmt->execute();
$anggota_result = $stmt->get_result();

// Ambil daftar minat bakat
$stmt = $mysqli->prepare("SELECT id_minat_bakat, nama_minat_bakat FROM minat_bakat");
$stmt->execute();
$minat_result = $stmt->get_result();

// Ambil evaluasi keaktifan anggota
$stmt = $mysqli->prepare("SELECT user_id, kehadiran, performa, umpan_balik FROM evaluasi");
$stmt->execute();
$evaluasi_result = $stmt->get_result();
?>

<?php include __DIR__ . '/header.php'; ?>
<h2>Manajemen & Evaluasi Anggota</h2>

<a href="tambah_anggota.php">Tambah Anggota Baru</a>
<table border="1">
    <tr><th>ID</th><th>Nama</th><th>NRA</th><th>Minat Bakat</th><th>Aksi</th></tr>
    <?php while ($anggota = $anggota_result->fetch_assoc()) { ?>
        <tr>
            <td><?= $anggota["id"]; ?></td>
            <td><?= htmlspecialchars($anggota["nama"]); ?></td>
            <td><?= htmlspecialchars($anggota["nra"]); ?></td>
            <td><?= htmlspecialchars($anggota["nama_minat_bakat"] ?? "Belum Terdaftar"); ?></td>
            <td>
                <a href="edit_anggota.php?id=<?= $anggota["id"]; ?>">Edit</a> |
                <a href="hapus_anggota.php?id=<?= $anggota["id"]; ?>">Hapus</a>
            </td>
        </tr>
    <?php } ?>
</table>

<h2>Evaluasi Keaktifan Anggota</h2>
<table border="1">
    <tr><th>User ID</th><th>Kehadiran</th><th>Performa</th><th>Umpan Balik</th></tr>
    <?php while ($evaluasi = $evaluasi_result->fetch_assoc()) { ?>
        <tr>
            <td><?= $evaluasi["user_id"]; ?></td>
            <td><?= htmlspecialchars($evaluasi["kehadiran"]); ?></td>
            <td><?= htmlspecialchars($evaluasi["performa"]); ?></td>
            <td><?= htmlspecialchars($evaluasi["umpan_balik"]); ?></td>
        </tr>
    <?php } ?>
</table>

<?php include __DIR__ . '/footer.php'; ?>

