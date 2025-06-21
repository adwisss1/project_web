<?php
session_start();
require_once __DIR__ . '/../config/config.php';

$is_pengurus = isset($_SESSION["user"]["role"]) && $_SESSION["user"]["role"] === "pengurus";
$portofolio = $mysqli->query("SELECT * FROM portofolio ORDER BY id_portofolio DESC");
?>

<?php include 'header_beranda.php'; ?>

<div class="content">
    <h1>Portofolio Sanggar Birama</h1>
    <p>Berikut adalah beberapa penampilan dan karya terbaik dari Sanggar Birama.</p>

    <?php if ($is_pengurus): ?>
        <table style="width:100%; border-collapse:collapse;">
            <tr>
                <th>Portofolio</th>
                <th style="width:180px;">Aksi</th>
            </tr>
            <?php while($row = $portofolio->fetch_assoc()): ?>
            <tr>
                <td>
                    <b><?= htmlspecialchars($row['judul']) ?></b><br>
                    <?= nl2br(htmlspecialchars($row['deskripsi'])) ?><br>
                    <iframe src="<?= htmlspecialchars($row['link']) ?>" width="320" height="180" allowfullscreen></iframe>
                </td>
                <td>
                    <a href="edit_portofolio.php?id=<?= $row['id_portofolio'] ?>" class="button">Edit</a>
                    <a href="hapus_portofolio.php?id=<?= $row['id_portofolio'] ?>" class="button" onclick="return confirm('Hapus portofolio ini?')">Hapus</a>
                </td>
            </tr>
            <?php endwhile; ?>
            <tr>
                <td colspan="2" style="text-align:center;">
                    <a href="tambah_portofolio.php" class="button">Tambah Portofolio</a>
                </td>
            </tr>
        </table>
    <?php else: ?>
        <?php $portofolio->data_seek(0); while($row = $portofolio->fetch_assoc()): ?>
            <div class="video-container">
                <h3><?= htmlspecialchars($row['judul']) ?></h3>
                <p><?= nl2br(htmlspecialchars($row['deskripsi'])) ?></p>
                <iframe src="<?= htmlspecialchars($row['link']) ?>" width="320" height="180" allowfullscreen></iframe>
            </div>
        <?php endwhile; ?>
    <?php endif; ?>

    <a href="beranda.php">Kembali ke Halaman Utama</a>
</div>

<?php include 'footer.php'; ?>