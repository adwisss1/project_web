<?php

session_start();
require_once __DIR__ . '/../../config/config.php';

if (!isset($_SESSION["user"]) || $_SESSION["user"]["role"] !== "pengurus") {
    header("Location: login.php");
    exit();
}

$minat_result = $mysqli->query("SELECT id_minat_bakat, nama_minat_bakat FROM minat_bakat");

$id_minat_bakat = isset($_GET['id_minat_bakat']) ? intval($_GET['id_minat_bakat']) : 0;
$bidang_minat = isset($_GET['bidang_minat']) ? $_GET['bidang_minat'] : '';
$nama_minat_bakat = '';
if ($id_minat_bakat) {
    $stmt = $mysqli->prepare("SELECT nama_minat_bakat FROM minat_bakat WHERE id_minat_bakat=?");
    $stmt->bind_param("i", $id_minat_bakat);
    $stmt->execute();
    $stmt->bind_result($nama_minat_bakat);
    $stmt->fetch();
    $stmt->close();
    // Jika bidang_minat kosong, isi otomatis dari nama_minat_bakat
    if (!$bidang_minat) $bidang_minat = $nama_minat_bakat;
}

$materi_result = null;
if ($id_minat_bakat && $bidang_minat) {
    $stmt = $mysqli->prepare("SELECT id, bidang_minat, minggu, deskripsi, materi, link_materi FROM materi_latihan WHERE bidang_minat=?");
    $stmt->bind_param("s", $bidang_minat);
    $stmt->execute();
    $materi_result = $stmt->get_result();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Manajemen Materi Latihan</title>
  <link rel="stylesheet" href="/SI-BIRAMA/public/css/style.css">
</head>
<body>
  <div class="layout-wrapper">
    <?php include 'sidebar_pengurus.html'; ?>
    <div class="main-content">
      <div class="content">
        <h2>Manajemen Materi Latihan</h2>
        <form method="get" class="form-warna">
          <label for="id_minat_bakat"><b>Pilih Minat Bakat:</b></label>
          <select name="id_minat_bakat" id="id_minat_bakat" required>
            <option value="">-- Pilih Minat Bakat --</option>
            <?php
            $minat_result->data_seek(0);
            while ($minat = $minat_result->fetch_assoc()) {
              $selected = ($id_minat_bakat == $minat['id_minat_bakat']) ? 'selected' : '';
              echo '<option value="'.$minat['id_minat_bakat'].'" '.$selected.'>'.htmlspecialchars($minat['nama_minat_bakat']).'</option>';
            }
            ?>
          </select>
          <button type="submit" class="button">Tampilkan</button>
        </form>

        <?php if ($id_minat_bakat && $materi_result): ?>
          <h3>Materi Latihan untuk: <?= htmlspecialchars($nama_minat_bakat) ?></h3>
          <a href="tambah_materi.php?id_minat_bakat=<?= urlencode($id_minat_bakat) ?>&bidang_minat=<?= urlencode($bidang_minat) ?>" class="button">+ Tambah Materi Baru</a>
          <table class="custom-table" style="margin-top:10px;">
            <tr>
              <th>No</th>
              <th>Minggu</th>
              <th>Deskripsi</th>
              <th>Materi</th>
              <th>Link</th>
              <th>Aksi</th>
            </tr>
            <?php $no = 1;
            while ($materi = $materi_result->fetch_assoc()): ?>
              <tr>
                <td><?= $no++ ?></td>
                <td><?= htmlspecialchars($materi["minggu"]) ?></td>
                <td><?= htmlspecialchars($materi["deskripsi"]) ?></td>
                <td><?= htmlspecialchars($materi["materi"]) ?></td>
                <td>
                  <?php if (!empty($materi["link_materi"])): ?>
                    <a href="<?= htmlspecialchars($materi["link_materi"]) ?>" target="_blank">Akses</a>
                  <?php else: ?>
                    <span style="color:red;">Tidak ada link</span>
                  <?php endif; ?>
                </td>
                <td>
                  <a href="edit_materi.php?id=<?= $materi["id"] ?>&id_minat_bakat=<?= urlencode($id_minat_bakat) ?>&bidang_minat=<?= urlencode($bidang_minat) ?>" class="link-button">Edit</a>
                  <a href="hapus_materi.php?id=<?= $materi["id"] ?>&id_minat_bakat=<?= urlencode($id_minat_bakat) ?>&bidang_minat=<?= urlencode($bidang_minat) ?>" class="link-button text-danger" onclick="return confirm('Yakin hapus materi ini?')">Hapus</a>
                </td>
              </tr>
            <?php endwhile; ?>
          </table>
        <?php elseif ($id_minat_bakat): ?>
          <p>Belum ada materi untuk minat bakat ini. 
              <button type="button" class="button" onclick="window.location.href='tambah_materi.php?id_minat_bakat=<?= urlencode($id_minat_bakat) ?>&bidang_minat=<?= urlencode($bidang_minat) ?>'">Tambah Materi Baru</button>
          </p>
        <?php endif; ?>

        <br>
        <button type="button" onclick="window.location.href='beranda_pengurus.php'" class="button">← Kembali</button>
      </div>
    </div>
  </div>
  <?php include __DIR__ . '/../footer.php'; ?>
</body>
</html>