<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Manajemen Anggota</title>
  <link rel="stylesheet" href="/SI-BIRAMA/public/css/style.css">
</head>
<body>
  <div class="layout-wrapper">
    <?php include 'sidebar_pengurus.html'; ?>
    <div class="main-content">
      <div class="content">
        <h2>Manajemen Anggota</h2>

        <!-- Filter Form -->
        <form method="get" class="filter-form">
          <label>Angkatan:
            <select name="angkatan">
              <option value="">Semua</option>
              <?php while ($angkatan = $angkatan_result->fetch_assoc()): ?>
                <option value="<?= $angkatan['angkatan'] ?>" <?= $filter_angkatan == $angkatan['angkatan'] ? 'selected' : '' ?>>
                  <?= $angkatan['angkatan'] ?>
                </option>
              <?php endwhile; ?>
            </select>
          </label>
          <label>Minat:
            <select name="minat">
              <option value="">Semua</option>
              <?php while ($minat = $minat_result->fetch_assoc()): ?>
                <option value="<?= $minat['id_minat_bakat'] ?>" <?= $filter_minat == $minat['id_minat_bakat'] ? 'selected' : '' ?>>
                  <?= htmlspecialchars($minat['nama_minat_bakat']) ?>
                </option>
              <?php endwhile; ?>
            </select>
          </label>
          <input type="text" name="search" placeholder="Cari nama/NRA" value="<?= htmlspecialchars($search) ?>">
          <button type="submit" class="button">Tampilkan</button>
          <button type="button" class="button" onclick="window.location.href='manajemen_anggota_kinerja.php'">Reset</button>
        </form>

        <div style="margin-bottom:18px;">
          <a href="anggota_crud.php?mode=add" class="button">+ Tambah Anggota Baru</a>
          <a href="rekap_pendaftar.php" class="button" >Lihat Rekap Pendaftar</a>
        </div>

        <div class="table-wrapper">
          <table class="custom-table">
            <thead>
              <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>NRA</th>
                <th>Angkatan</th>
                <th>Minat Bakat</th>
                <th>Aksi</th>
                <th>Evaluasi</th>
              </tr>
            </thead>
            <tbody>
              <?php while ($anggota = $anggota_result->fetch_assoc()): ?>
                <tr>
                  <td><?= $anggota['id'] ?></td>
                  <td><?= htmlspecialchars($anggota['nama']) ?></td>
                  <td><?= htmlspecialchars($anggota['nra']) ?></td>
                  <td><?= htmlspecialchars($anggota['angkatan']) ?></td>
                  <td><?= !empty($anggota_minat[$anggota["id"]]) ? htmlspecialchars(implode(', ', $anggota_minat[$anggota["id"]])) : '<i>Belum Terdaftar</i>' ?></td>
                  <td>
                    <a href="anggota_crud.php?mode=edit&id=<?= $anggota['id'] ?>">Edit</a> |
                    <a href="anggota_crud.php?mode=delete&id=<?= $anggota['id'] ?>" onclick="return confirm('Yakin ingin menghapus anggota ini?')">Hapus</a>
                  </td>
                  <td>
                    <a href="evaluasi_anggota.php?id=<?= $anggota['id'] ?>&mode=view" target="_blank">Lihat</a>
                  </td>
                </tr>
              <?php endwhile; ?>
            </tbody>
          </table>
        </div>

        <!-- Pagination -->
        <div class="pagination">
          <?php if ($page > 1): ?>
            <a href="?<?= http_build_query(array_merge($_GET, ['page' => $page - 1])) ?>" class="button">Sebelumnya</a>
          <?php endif; ?>
          <span>Halaman <?= $page ?> dari <?= $total_pages ?></span>
          <?php if ($page < $total_pages): ?>
            <a href="?<?= http_build_query(array_merge($_GET, ['page' => $page + 1])) ?>" class="button">Selanjutnya</a>
          <?php endif; ?>
        </div>

      </div>
    </div>
  </div>
  <?php include __DIR__ . '/../footer.php'; ?>
</body>
</html>