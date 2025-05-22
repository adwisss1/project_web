<?php
session_start();
require_once __DIR__ . '/../config/config.php';

// Pastikan user adalah pengurus
if (!isset($_SESSION["user"]) || $_SESSION["role"] !== "pengurus") {
    header("Location: ../login.php");
    exit();
}

// Ambil data program kerja
$stmt = $mysqli->prepare("SELECT id, nama_program, tanggal_mulai, tanggal_selesai, deskripsi FROM program_kerja");
$stmt->execute();
$program_result = $stmt->get_result();
?>

<?php include __DIR__ . '/header.php'; ?>

<h2>Kontrol Program Kerja</h2>

<a href="tambah_program.php">Tambah Program Kerja Baru</a>

<table border="1">
    <tr><th>Nama Program</th><th>Tanggal Mulai</th><th>Tanggal Selesai</th><th>Deskripsi</th><th>Aksi</th></tr>
    <?php while ($program = $program_result->fetch_assoc()) { ?>
        <tr>
            <td><?= htmlspecialchars($program["nama_program"]); ?></td>
            <td><?= htmlspecialchars($program["tanggal_mulai"]); ?></td>
            <td><?= htmlspecialchars($program["tanggal_selesai"]); ?></td>
            <td><?= htmlspecialchars($program["deskripsi"]); ?></td>
            <td>
                <a href="edit_program.php?id=<?= $program["id"]; ?>">Edit</a> | 
                <a href="hapus_program.php?id=<?= $program["id"]; ?>">Hapus</a>
            </td>
        </tr>
    <?php } ?>
</table>

<?php include __DIR__ . '/footer.php'; ?>

