<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Manajemen Jadwal</title>
  <link rel="stylesheet" href="/SI-BIRAMA/public/css/style.css">
</head>
<body>
  <div class="layout-wrapper">
    <?php include 'sidebar_pengurus.html'; ?>
    <div class="main-content">
      <div class="content">
        <h2>Manajemen Jadwal Latihan</h2>

        <h3>Daftar Jadwal Rutin</h3>
        <table class="custom-table-jadwal">
          <tr>
            <th>No</th>
            <th>Minat Bakat</th>
            <th>Hari</th>
            <th>Jam</th>
            <th>Durasi</th>
            <th>Mentor</th>
            <th>Aksi</th>
          </tr>
          <?php $no = 1;
          $jadwal_rutin_result->data_seek(0);
          while ($rutin = $jadwal_rutin_result->fetch_assoc()): ?>
            <tr>
              <td><?= $no++ ?></td>
              <td><?= htmlspecialchars($rutin["nama_minat_bakat"]) ?></td>
              <td><?= htmlspecialchars($rutin["hari"] ?? '-') ?></td>
              <td><?= htmlspecialchars($rutin["jam"] ?? '-') ?></td>
              <td><?= htmlspecialchars($rutin["durasi_latihan"]) ?></td>
              <td><?= htmlspecialchars($rutin["mentor"]) ?></td>
              <td>
                <form action="edit_jadwal_rutin.php" method="get" style="display:inline;">
                  <input type="hidden" name="id" value="<?= urlencode($rutin["id"]) ?>">
                  <button type="submit" class="button" style="background:#007bff;">Edit</button>
                </form>
                <form action="buka_sesi_absensi.php" method="get" style="display:inline;">
                  <input type="hidden" name="id_jadwal" value="<?= $rutin["id"] ?>">
                  <input type="hidden" name="tipe" value="rutin">
                  <button type="submit" class="button" style="background:#28a745;">Absensi</button>
                </form>
              </td>
            </tr>
          <?php endwhile; ?>
          <tr>
            <td colspan="7" style="text-align:right;">
              <form action="tambah_jadwal_rutin.php" method="get" style="display:inline;">
                <button type="submit" class="button" style="background:#007bff;">Tambah Jadwal Rutin</button>
              </form>
            </td>
          </tr>
        </table>

        <h3>Daftar Jadwal Kondisional</h3>
        <table class="custom-table">
          <tr>
            <th>Minat Bakat</th>
            <th>Tanggal</th>
            <th>Jam</th>
            <th>Keterangan</th>
            <th>Aksi</th>
          </tr>
          <?php
          $jadwal_kondisional_result->data_seek(0);
          while ($kondisional = $jadwal_kondisional_result->fetch_assoc()): ?>
            <tr>
              <td><?= htmlspecialchars($kondisional["nama_minat_bakat"]) ?></td>
              <td><?= htmlspecialchars($kondisional["tanggal"]) ?></td>
              <td><?= htmlspecialchars($kondisional["jam"]) ?></td>
              <td><?= htmlspecialchars($kondisional["keterangan"]) ?></td>
              <td>
                <form method="POST" action="hapus_jadwal_kondisional.php" onsubmit="return confirm('Yakin ingin menghapus jadwal ini?');" style="display:inline;">
                    <input type="hidden" name="id" value="<?= htmlspecialchars($kondisional["id"]) ?>">
                    <button type="submit" class="button button-danger">Hapus</button>
                </form>
                <a href="buka_sesi_absensi.php?id_jadwal=<?= $kondisional["id"] ?>&tipe=kondisional" class="button" style="background:#28a745;">Absensi</a>
              </td>
            </tr>
          <?php endwhile; ?>
          <tr>
            <td colspan="5" style="text-align:right;">
              <a href="tambah_jadwal_kondisional.php" class="button" style="background:#007bff;">Tambah Jadwal Kondisional</a>
            </td>
          </tr>
        </table>
      </div>
    </div>
  </div>
  <?php include __DIR__ . '/../footer.php'; ?>
</body>
</html>