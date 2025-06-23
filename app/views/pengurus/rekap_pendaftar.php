<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Rekap Pendaftar Anggota</title>
  <link rel="stylesheet" href="/SI-BIRAMA/public/css/style.css">
</head>
<body>
  <div class="layout-wrapper">
    <?php include 'sidebar_pengurus.html'; ?>
    <div class="main-content">
      <div class="content">
        <button class="button" onclick="window.location.href='manajemen_anggota_kinerja.php'">&larr; Kembali ke Manajemen Anggota</button>
        <h2>Rekap Pendaftar Anggota</h2>

        <?php if (isset($error) && $error): ?>
          <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <div class="table-wrapper">
          <table class="custom-table">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Nomor HP</th>
                <th>Jurusan/Prodi</th>
                <th>NIM</th>
                <th>Rencana Minat Bakat</th>
                <th>Waktu Daftar</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              if (isset($result) && $result && $result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                      echo "<tr>";
                      echo "<td>{$no}</td>";
                      echo "<td>" . htmlspecialchars($row['nama']) . "</td>";
                      echo "<td>" . htmlspecialchars($row['no_hp']) . "</td>";
                      echo "<td>" . htmlspecialchars($row['jurusan']) . "</td>";
                      echo "<td>" . htmlspecialchars($row['nim']) . "</td>";
                      echo "<td>" . htmlspecialchars($row['minat_bakat']) . "</td>";
                      echo "<td>" . htmlspecialchars($row['waktu_daftar']) . "</td>";
                      echo "</tr>";
                      $no++;
                  }
              } else {
                  echo '<tr><td colspan="7" style="text-align:center;">Belum ada data pendaftar.</td></tr>';
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <?php include __DIR__ . '/../footer.php'; ?>
</body>
</html>