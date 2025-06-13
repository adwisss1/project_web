<?php
// filepath: d:\dari c\2Xampp\instal\htdocs\SI-BIRAMA\app\views\manajemen_Talent&inventaris.php
session_start();
require_once __DIR__ . '/../config/config.php';

// Hanya pengurus yang boleh akses
if (!isset($_SESSION["user"]["role"]) || $_SESSION["user"]["role"] !== "pengurus") {
    header("Location: beranda.php");
    exit();
}

// Ambil data talent dan inventaris
$talent = $mysqli->query("SELECT * FROM talent");
$inventaris = $mysqli->query("SELECT * FROM inventaris");
?>
<?php include 'header.php'; ?>

<div class="content">
    <a href="beranda_pengurus.php" class="button" style="margin-bottom:18px;display:inline-block;">&larr; Kembali ke Halaman Pengurus</a>
    <h2>Manajemen Talent</h2>
    <table border="1" style="width:100%; border-collapse:collapse;">
        <tr>
            <th>No</th>
            <th>Jenis Talent</th>
            <th>Keterangan</th>
            <th style="width:160px;">Aksi</th>
        </tr>
        <?php $no=1; while($row = $talent->fetch_assoc()): ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= htmlspecialchars($row['jenis_talent']) ?></td>
            <td><?= htmlspecialchars($row['keterangan']) ?></td>
            <td>
                <a href="edit_talent.php?id=<?= $row['id_talent'] ?>" class="button">Edit</a>
                <a href="hapus_talent.php?id=<?= $row['id_talent'] ?>" class="button" onclick="return confirm('Hapus talent ini?')">Hapus</a>
            </td>
        </tr>
        <?php endwhile; ?>
        <tr>
            <td colspan="4" style="text-align:center;">
                <a href="tambah_talent.php" class="button">Tambah Talent</a>
            </td>
        </tr>
    </table>

    <h2 style="margin-top:40px;">Manajemen Inventaris</h2>
    <table border="1" style="width:100%; border-collapse:collapse;">
        <tr>
            <th>No</th>
            <th>Nama Item</th>
            <th>Harga Sewa</th>
            <th style="width:160px;">Aksi</th>
        </tr>
        <?php $no=1; while($row = $inventaris->fetch_assoc()): ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= htmlspecialchars($row['nama_item']) ?></td>
            <td>Rp <?= number_format($row['harga_sewa'],0,',','.') ?>/hari</td>
            <td>
                <a href="edit_inventaris.php?id=<?= $row['id_item'] ?>" class="button">Edit</a>
                <a href="hapus_inventaris.php?id=<?= $row['id_item'] ?>" class="button" onclick="return confirm('Hapus inventaris ini?')">Hapus</a>
            </td>
        </tr>
        <?php endwhile; ?>
        <tr>
            <td colspan="4" style="text-align:center;">
                <a href="tambah_inventaris.php" class="button">Tambah Inventaris</a>
            </td>
        </tr>
    </table>
</div>

<?php include 'footer.php'; ?>