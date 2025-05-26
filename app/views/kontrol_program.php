<?php
session_start();
require_once __DIR__ . '/../config/config.php';

// Pastikan user adalah pengurus
if (!isset($_SESSION["user"]) || $_SESSION["role"] !== "pengurus") {
    header("Location: ../login.php");
    exit();
}

// Ambil data program kerja beserta nama pengurus dan ketua panitia
$stmt = $mysqli->prepare("
    SELECT pk.id, pk.nama_program, pk.tanggal_mulai, pk.tanggal_selesai, pk.deskripsi, 
           pk.status, pk.tanggal_selesai_agenda,
           p.nama_pengurus, a.nama AS nama_ketua_panitia
    FROM program_kerja pk
    LEFT JOIN pengurus p ON pk.pj_pengurus = p.id_pengurus
    LEFT JOIN anggota a ON pk.ketua_panitia = a.id
");
$stmt->execute();
$program_result = $stmt->get_result();
?>

<?php include __DIR__ . '/header.php'; ?>

<h2>Kontrol Program Kerja</h2>

<a href="beranda_pengurus.php" >Kembali ke Beranda Pengurus</a>

<a href="tambah_program.php">Tambah Program Kerja Baru</a>

<table border="1">
    <tr>
        <th>Nama Program</th>
        <th>PJ Pengurus</th>
        <th>Ketua Panitia</th>
        <th>Tanggal Mulai</th>
        <th>Tanggal Selesai</th>
        <th>Status</th>
        <th>Tanggal Selesai Agenda</th>
        <th>Deskripsi</th>
        <th>Aksi</th>
    </tr>
    <?php while ($program = $program_result->fetch_assoc()) { ?>
        <tr>
            <td><?= htmlspecialchars($program["nama_program"]); ?></td>
            <td><?= htmlspecialchars($program["nama_pengurus"]); ?></td>
            <td><?= htmlspecialchars($program["nama_ketua_panitia"]); ?></td>
            <td><?= htmlspecialchars($program["tanggal_mulai"]); ?></td>
            <td><?= htmlspecialchars($program["tanggal_selesai"]); ?></td>
            <td><?= htmlspecialchars($program["status"]); ?></td>
            <td>
                <?php
                if ($program["status"] === "selesai") {
                    echo htmlspecialchars($program["tanggal_selesai_agenda"]);
                } else {
                    echo "on progress";
                }
                ?>
            </td>
            <td><?= htmlspecialchars($program["deskripsi"]); ?></td>
            <td>
                <a href="edit_program.php?id=<?= $program["id"]; ?>">Edit</a> | 
                <a href="hapus_program.php?id=<?= $program["id"]; ?>">Hapus</a>
            </td>
        </tr>
    <?php } ?>
</table>

<?php include __DIR__ . '/footer.php'; ?>