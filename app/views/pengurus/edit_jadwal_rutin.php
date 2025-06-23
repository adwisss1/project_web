<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Jadwal Rutin</title>
  <link rel="stylesheet" href="/SI-BIRAMA/public/css/style.css">
</head>
<body>
  <div class="layout-wrapper">
    <?php include 'sidebar_pengurus.html'; ?>
    <div class="main-content">
      <div class="content">
        <h3>Edit Jadwal Rutin</h3>
        <p><strong>Minat Bakat:</strong> <?= htmlspecialchars($nama_minat_bakat) ?></p>
        <?php if (!empty($error)): ?>
          <div style="color:red"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <form method="POST" class="form-warna">
          <label for="hari">Hari:</label>
          <select name="hari" id="hari" required>
            <?php
            $hari_list = ['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu'];
            foreach ($hari_list as $h) {
                $selected = ($jadwal['hari'] == $h) ? 'selected' : '';
                echo "<option value=\"$h\" $selected>$h</option>";
            }
            ?>
          </select><br>

          <label for="jam">Jam:</label>
          <input type="time" name="jam" id="jam" value="<?= htmlspecialchars($jadwal['jam']) ?>" min="16:00" max="22:00" required><br>

          <label for="durasi_latihan">Durasi Latihan (jam):</label>
          <input type="number" step="0.1" name="durasi_latihan" id="durasi_latihan" value="<?= htmlspecialchars($jadwal['durasi_latihan']) ?>" min="0.5" required><br>

          <label for="mentor">Mentor:</label>
          <input type="text" name="mentor" id="mentor" value="<?= htmlspecialchars($jadwal['mentor']) ?>" required><br>

          <div style="display:inline-flex; gap:10px;">
            <button type="submit" class="button">Simpan Perubahan</button>
            <button type="button" class="button" onclick="window.location.href='manajemen_jadwal.php'">Batal</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <?php include __DIR__ . '/../footer.php'; ?>
</body>
</html>