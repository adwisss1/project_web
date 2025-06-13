<?php
session_start();
require_once __DIR__ . '/../config/config.php';

// Hanya pengurus yang boleh akses
if (!isset($_SESSION["user"]) || $_SESSION["user"]["role"] !== "pengurus") {
    header("Location: login.php");
    exit();
}

// Ambil data pendaftar
$result = $mysqli->query("SELECT * FROM pendaftaran ORDER BY waktu_daftar DESC");
?>

<?php include __DIR__ . '/header.php'; ?>

<a href="manajemen_anggota_kinerja.php" class="button" style="margin-bottom:16px;display:inline-block;">&larr; Kembali ke Manajemen Anggota</a>
<h2>Rekap Pendaftar Anggota</h2>

<table border="1" cellpadding="6" cellspacing="0">
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Nomor HP</th>
        <th>Jurusan/Prodi</th>
        <th>NIM</th>
        <th>Rencana Minat Bakat</th>
        <th>Waktu Daftar</th>
    </tr>
    <?php
    $no = 1;
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>{$no}</td>";
        echo "<td>" . htmlspecialchars($row['nama']) . "</td>";
        echo "<td>" . htmlspecialchars($row['no_hp']) . "</td>";
        echo "<td>" . htmlspecialchars($row['jurusan']) . "</td>";
        echo "<td>" . htmlspecialchars($row['nim']) . "</td>";
        echo "<td>" . htmlspecialchars($row['minat_bakat']) . "</td>";
        echo "<td>" . htmlspecialchars($row['waktu_daftar']) . "</td>";
        echo "</tr>";
        $no++;
    }
    ?>
</table>

<?php include __DIR__ . '/footer.php'; ?>