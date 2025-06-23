<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Pengurus</title>
  <link rel="stylesheet" href="/SI-BIRAMA/public/css/style.css">
</head>
<body>
  <div class="layout-wrapper">
    <?php include 'sidebar_pengurus.html'; ?>
    <div class="main-content">
      <div class="content">
        <h2>Edit Data Pengurus</h2>
        <form method="POST" action="/SI-BIRAMA/app/controllers/pengurus/update_pengurus.php" class="form-container form-warna">
          <input type="hidden" name="id_pengurus" value="<?= $id_pengurus ?>">

          <label for="nama_pengurus">Nama Pengurus:</label>
          <input type="text" name="nama_pengurus" id="nama_pengurus" value="<?= htmlspecialchars($nama_pengurus) ?>" required>

          <label for="nim">NIM:</label>
          <input type="text" name="nim" id="nim" value="<?= htmlspecialchars($nim) ?>" required>

          <label for="angkatan">Angkatan:</label>
          <input type="number" name="angkatan" id="angkatan" value="<?= htmlspecialchars($angkatan) ?>" required>

          <label for="jabatan">Jabatan:</label>
          <input type="text" name="jabatan" id="jabatan" value="<?= htmlspecialchars($jabatan) ?>" required>

          <label for="kontak">Kontak:</label>
          <input type="text" name="kontak" id="kontak" value="<?= htmlspecialchars($kontak) ?>" required>

          <div>
            <button type="submit" class="button">Simpan Perubahan</button>
            <button type="button" class="button" onclick="window.location.href='/SI-BIRAMA/app/controllers/pengurus/beranda_pengurus.php'">Batal</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <?php include __DIR__ . '/../footer.php'; ?>
</body>
</html>