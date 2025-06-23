<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Manajemen Talent & Inventaris</title>
  <link rel="stylesheet" href="/SI-BIRAMA/public/css/style.css">
</head>
<body>
  <div class="layout-wrapper">
    <?php include 'sidebar_pengurus.html'; ?>
    <div class="main-content">
      <div class="content">
        <h2>Manajemen Talent</h2>
        <table class="custom-table">
          <tr>
            <th>No</th>
            <th>Jenis Talent</th>
            <th>Keterangan</th>
            <th>Aksi</th>
          </tr>
          <?php $no=1; while($row = $talent->fetch_assoc()): ?>
          <tr>
            <td><?= $no++ ?></td>
            <td><?= htmlspecialchars($row['jenis_talent']) ?></td>
            <td><?= htmlspecialchars($row['keterangan']) ?></td>
            <td>
              <a href="edit_talent.php?id=<?= $row['id_talent'] ?>" class="link-button">Edit</a>
              <a href="hapus_talent.php?id=<?= $row['id_talent'] ?>" class="link-button text-danger" onclick="return confirm('Hapus talent ini?')">Hapus</a>
            </td>
          </tr>
          <?php endwhile; ?>
          <tr>
            <td colspan="4" style="text-align:center;">
              <a href="tambah_talent.php" class="button" style="background:#007bff;">+ Tambah Talent</a>
            </td>
          </tr>
        </table>

        <h2 style="margin-top:40px;">Manajemen Inventaris</h2>
        <table class="custom-table">
          <tr>
            <th>No</th>
            <th>Nama Item</th>
            <th>Harga Sewa</th>
            <th>Aksi</th>
          </tr>
          <?php $no=1; while($row = $inventaris->fetch_assoc()): ?>
          <tr>
            <td><?= $no++ ?></td>
            <td><?= htmlspecialchars($row['nama_item']) ?></td>
            <td>Rp <?= number_format($row['harga_sewa'],0,',','.') ?>/hari</td>
            <td>
              <a href="edit_inventaris.php?id=<?= $row['id_item'] ?>" class="link-button">Edit</a>
              <a href="hapus_inventaris.php?id=<?= $row['id_item'] ?>" class="link-button text-danger" onclick="return confirm('Hapus inventaris ini?')">Hapus</a>
            </td>
          </tr>
          <?php endwhile; ?>
          <tr>
            <td colspan="4" style="text-align:center;">
              <a href="tambah_inventaris.php" class="button" style="background:#007bff;">+ Tambah Inventaris</a>
            </td>
          </tr>
        </table>
      </div>
    </div>
  </div>
  <?php include __DIR__ . '/../footer.php'; ?>
</body>
</html>