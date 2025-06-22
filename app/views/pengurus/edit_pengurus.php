<?php
require_once __DIR__ . '/../../config/config.php';
session_start();

$id_pengurus = isset($_GET['id_pengurus']) ? intval($_GET['id_pengurus']) : 0;
if ($id_pengurus <= 0) {
    die("ID pengurus tidak valid.");
}

// Ambil data pengurus
$stmt = $mysqli->prepare("SELECT nama_pengurus, nim, angkatan, jabatan, kontak FROM pengurus WHERE id_pengurus = ?");
$stmt->bind_param("i", $id_pengurus);
$stmt->execute();
$stmt->bind_result($nama_pengurus, $nim, $angkatan, $jabatan, $kontak);
$stmt->fetch();
$stmt->close();

if (!$nama_pengurus) {
    echo "Data pengurus tidak ditemukan.";
    exit();
}
?>
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
        <form method="POST" action="/SI-BIRAMA/app/controllers/update_pengurus.php" class="form-container">
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

          <div 
            <form method="post">
                <button type="submit" class="button">Simpan Perubahan</button>
            </form>
            <button type="button" class="button" onclick="window.location.href='manajemen_pengurus.php'">Batal</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <?php include __DIR__ . '/../footer.php'; ?>
</body>
</html>
