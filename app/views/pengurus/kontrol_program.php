<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Kontrol Program Kerja</title>
  <link rel="stylesheet" href="/SI-BIRAMA/public/css/style.css">
</head>
<body>
  <div class="layout-wrapper">
    <?php include 'sidebar_pengurus.html'; ?>
    <div class="main-content">
      <div class="content">
        <h2>Kontrol Program Kerja</h2>
        <a href="tambah_program.php" class="button">+ Tambah Program</a>

        <h3 style="margin-top: 25px;">Daftar Program Kerja</h3>
        <table class="custom-table-program">
          <tr>
            <th>Nama Program</th>
            <th>Tanggal Mulai</th>
            <th>Tanggal Selesai</th>
            <th>Tanggal Selesai Agenda</th>
            <th>Deskripsi</th>
            <th>PJ Pengurus</th>
            <th>Ketua Panitia</th>
            <th>Status</th>
            <th>Aksi</th>
          </tr>
          <?php while ($program = $program_result->fetch_assoc()): ?>
            <tr>
              <td><?= htmlspecialchars($program["nama_program"]); ?></td>
              <td><?= htmlspecialchars($program["tanggal_mulai"]); ?></td>
              <td><?= htmlspecialchars($program["tanggal_selesai"]); ?></td>
              <td><?= htmlspecialchars($program["tanggal_selesai_agenda"]); ?></td>
              <td><?= htmlspecialchars($program["deskripsi"]); ?></td>
              <td><?= htmlspecialchars($program["nama_pengurus"] ?? '-'); ?></td>
              <td><?= htmlspecialchars($program["nama_ketua"] ?? '-'); ?></td>
              <td>
                <?php if (strtolower($program["status"]) == "on progress"): ?>
                  <a href="#progress-proker" style="color:green;">On Progress</a>
                <?php else: ?>
                  <?= htmlspecialchars($program["status"]); ?>
                <?php endif; ?>
              </td>
              <td>
                <a href="edit_program.php?id=<?= $program["id"]; ?>" class="button">Edit</a>
                <a href="hapus_program.php?id=<?= $program["id"]; ?>" class="button" onclick="return confirm('Yakin ingin menghapus program ini?');">Hapus</a>
              </td>
            </tr>
          <?php endwhile; ?>
        </table>

        <form method="GET" action="#progress-proker" style="margin-top: 30px;">
          <label for="filter_program"><b>Lihat Progress Program:</b></label>
          <select name="filter_program" id="filter_program" required>
            <option value="">-- Pilih Program Kerja --</option>
            <?php
            mysqli_data_seek($program_list, 0);
            while ($row = $program_list->fetch_assoc()):
              $selected = ($filter_program == $row['id']) ? 'selected' : '';
              echo "<option value='{$row['id']}' $selected>".htmlspecialchars($row['nama_program'])."</option>";
            endwhile;
            ?>
          </select>
          <button type="submit" class="button">Lihat Progress</button>
        </form>

        <?php if ($filter_program): ?>
         <button type="button" class="button" onclick="window.location.href='tambah_progress.php?id_program=<?= $filter_program; ?>'">+ Tambah Progress</button>
        <?php endif; ?>

        <h3 id="progress-proker" style="margin-top:30px;">Progress Program Kerja</h3>
        <table class="custom-table">
          <tr>
            <th>Nama Program</th>
            <th>PJ Pengurus</th>
            <th>Laporan</th>
            <th>Tanggal Update</th>
            <th>Aksi</th>
          </tr>
          <?php if ($filter_program): ?>
            <?php if ($progress_result && $progress_result->num_rows > 0): ?>
              <?php while ($progress = $progress_result->fetch_assoc()): ?>
                <tr>
                  <td><?= htmlspecialchars($progress["nama_program"]); ?></td>
                  <td><?= htmlspecialchars($progress["nama_pengurus"] ?? '-'); ?></td>
                  <td><?= nl2br(htmlspecialchars($progress["laporan"])); ?></td>
                  <td><?= htmlspecialchars($progress["tanggal_update"]); ?></td>
                  <td>
                    <a href="edit_progress.php?id=<?= $progress["id"]; ?>" class="link-button">Edit</a>
                  </td>
                </tr>
              <?php endwhile; ?>
            <?php else: ?>
              <?php
              $stmt_prog = $mysqli->prepare("
                SELECT pk.nama_program, pengurus.nama_pengurus 
                FROM program_kerja pk
                LEFT JOIN pengurus ON pk.pj_pengurus = pengurus.id_pengurus
                WHERE pk.id=?
              ");
              $stmt_prog->bind_param('i', $filter_program);
              $stmt_prog->execute();
              $stmt_prog->bind_result($nama_program, $nama_pengurus);
              if ($stmt_prog->fetch()): ?>
                <tr>
                  <td><?= htmlspecialchars($nama_program); ?></td>
                  <td><?= htmlspecialchars($nama_pengurus ?? '-'); ?></td>
                  <td colspan="2" style="text-align:center;">
                    Belum ada progress. Silakan <a href="edit_progress.php?id_program=<?= $filter_program; ?>">isi progress</a>.
                  </td>
                  <td>
                    <a href="edit_progress.php?id_program=<?= $filter_program; ?>" class="button">Tambah</a>
                  </td>
                </tr>
              <?php endif;
              $stmt_prog->close(); ?>
            <?php endif; ?>
          <?php else: ?>
            <tr>
              <td colspan="5" style="text-align:center;">Silakan pilih program kerja untuk melihat/mengisi progress.</td>
            </tr>
          <?php endif; ?>
        </table>
      </div>
    </div>
  </div>
  <?php include __DIR__ . '/../footer.php'; ?>
</body>
</html>