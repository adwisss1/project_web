<!-- filepath: d:\dari c\2Xampp\instal\htdocs\SI-BIRAMA\app\views\pengurus\anggota_crud.php -->
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title><?= $mode === 'add' ? 'Tambah' : ($mode === 'edit' ? 'Edit' : 'Hapus') ?> Anggota</title>
  <link rel="stylesheet" href="/SI-BIRAMA/public/css/style.css">
</head>
<body>
  <div class="layout-wrapper">
    <?php include 'sidebar_pengurus.html'; ?>
    <div class="main-content">
      <div class="content">
        <a href="manajemen_anggota_kinerja.php" class="button" style="margin-bottom:15px;">← Kembali ke Manajemen Anggota</a>
        <h2><?= $mode === 'add' ? 'Tambah Anggota' : ($mode === 'edit' ? 'Edit Anggota' : 'Hapus Anggota') ?></h2>

        <?php if ($error): ?>
          <div style="color:red"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <?php if ($mode === 'add' || $mode === 'edit'): ?>
        <form method="post">
          <?php if ($mode === 'add'): ?>
            <label>Username:
              <input type="text" name="username" required>
            </label><br>
            <label>Password:
              <input type="password" name="password" required>
            </label><br>
          <?php endif; ?>

          <label>Nama:
            <input type="text" name="nama" value="<?= htmlspecialchars($nama) ?>" required>
          </label><br>
          <label>NRA:
            <input type="text" name="nra" value="<?= htmlspecialchars($nra) ?>" required>
          </label><br>
          <label>Angkatan:
            <input type="text" name="angkatan" value="<?= htmlspecialchars($angkatan) ?>" required>
          </label><br>
          <label>Minat Bakat:
            <select name="id_minat_bakat" required>
              <option value="">-- Pilih --</option>
              <?php
              $minat_result->data_seek(0);
              while ($minat = $minat_result->fetch_assoc()): ?>
                <option value="<?= $minat['id_minat_bakat'] ?>" <?= $id_minat_bakat == $minat['id_minat_bakat'] ? 'selected' : '' ?>>
                  <?= htmlspecialchars($minat['nama_minat_bakat']) ?>
                </option>
              <?php endwhile; ?>
            </select>
          </label><br>

          <button type="submit" class="button"><?= $mode === 'add' ? 'Tambah' : 'Simpan' ?></button>
          <button type="reset" class="button">Reset</button>
        </form>
        <?php endif; ?>
      </div>
    </div>
  </div>
  <?php include __DIR__ . '/../footer.php'; ?>
</body>
</html>