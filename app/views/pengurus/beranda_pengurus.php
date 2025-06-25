<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Website Sanggar Birama - Pengurus</title>
  <link rel="stylesheet" href="/SI-BIRAMA/public/css/style.css">
</head>
<body>
  <div class="layout-wrapper">
    <?php include 'sidebar_pengurus.html'; ?>
    <div class="main-content">
      <div class="content">
        <header>
          <h1>Selamat Datang Pengurus Sanggar Birama</h1>
        </header>

        <h2>Selamat datang, <?= htmlspecialchars($_SESSION["user"]["username"]); ?>!</h2>
        <a href="/SI-BIRAMA/app/controllers/beranda.php" class="button" style="margin-bottom:18px; display:inline-block;">&larr; Kembali ke Halaman Beranda</a>

        <h3>Daftar Pengurus</h3>
        <table class="custom-table">
          <tr>
            <th>No</th>
            <th>Nama Pengurus</th>
            <th>NIM</th>
            <th>Angkatan</th>
            <th>Jabatan</th>
            <th>Kontak</th>
            <th>Aksi</th>
          </tr>
          <?php $no = 1;
          while ($pengurus = $pengurus_result->fetch_assoc()): ?>
            <tr>
              <td><?= $no++ ?></td>
              <td><?= htmlspecialchars($pengurus["nama_pengurus"]) ?></td>
              <td><?= htmlspecialchars($pengurus["nim"]) ?></td>
              <td><?= htmlspecialchars($pengurus["angkatan"]) ?></td>
              <td><?= htmlspecialchars($pengurus["jabatan"]) ?></td>
              <td><?= htmlspecialchars($pengurus["kontak"]) ?></td>
              <td><a href="edit_pengurus.php?id_pengurus=<?= urlencode($pengurus["id_pengurus"]) ?>">Edit</a></td>
            </tr>
          <?php endwhile; ?>
        </table>

        <h3>Daftar Minat Bakat</h3>
        <table class="custom-table">
          <tr>
            <th>No</th>
            <th>Nama Minat Bakat</th>
            <th>Enrollment Key</th>
            <th>Bidang</th>
          </tr>
          <?php $no = 1;
          while ($minat = $minat_result->fetch_assoc()):
            $nama_bidang = "-";
            if (!empty($minat['id_bidang'])) {
              $stmt_bidang = $mysqli->prepare("SELECT nama_bidang FROM bidang WHERE id_bidang = ?");
              $stmt_bidang->bind_param("i", $minat['id_bidang']);
              $stmt_bidang->execute();
              $stmt_bidang->bind_result($nama_bidang_db);
              if ($stmt_bidang->fetch()) $nama_bidang = $nama_bidang_db;
              $stmt_bidang->close();
            } ?>
            <tr>
              <td><?= $no++ ?></td>
              <td><?= htmlspecialchars($minat["nama_minat_bakat"]) ?></td>
              <td><?= htmlspecialchars($minat["enrollment_key"]) ?></td>
              <td><?= htmlspecialchars($nama_bidang) ?></td>
            </tr>
          <?php endwhile; ?>
        </table>

        <h3>Daftar Request Penyewaan Inventaris</h3>
        <table class="custom-table">
          <tr>
            <th>No</th>
            <th>Nama Penyewa</th>
            <th>Email</th>
            <th>Nama Kegiatan</th>
            <th>Telepon</th>
            <th>Item</th>
            <th>Tanggal</th>
            <th>Durasi (hari)</th>
            <th>Waktu Submit</th>
          </tr>
          <?php $no = 1;
          while ($row = $penyewaan_result->fetch_assoc()): ?>
            <tr>
              <td><?= $no++ ?></td>
              <td><?= htmlspecialchars($row["nama"]) ?></td>
              <td><?= htmlspecialchars($row["email"]) ?></td>
              <td><?= htmlspecialchars($row["nama_kegiatan"]) ?></td>
              <td><?= htmlspecialchars($row["telepon"]) ?></td>
              <td><?= htmlspecialchars($row["item"]) ?></td>
              <td><?= htmlspecialchars($row["tanggal"]) ?></td>
              <td><?= htmlspecialchars($row["durasi"]) ?></td>
              <td><?= htmlspecialchars($row["waktu_submit"]) ?></td>
            </tr>
          <?php endwhile; ?>
        </table>

        <h3>Daftar Request Book Talent</h3>
        <table class="custom-table">
          <tr>
            <th>No</th>
            <th>Nama Client</th>
            <th>Email</th>
            <th>Nama Kegiatan</th>
            <th>Jenis Talent</th>
            <th>Jumlah Talent</th>
            <th>Tanggal Acara</th>
            <th>Lokasi</th>
            <th>Durasi (jam)</th>
            <th>Waktu Submit</th>
          </tr>
          <?php $no = 1;
          while ($row = $book_talent_result->fetch_assoc()): ?>
            <tr>
              <td><?= $no++ ?></td>
              <td><?= htmlspecialchars($row["nama_client"]) ?></td>
              <td><?= htmlspecialchars($row["email"]) ?></td>
              <td><?= htmlspecialchars($row["nama_kegiatan"]) ?></td>
              <td><?= htmlspecialchars($row["jenis_talent"]) ?></td>
              <td><?= htmlspecialchars($row["jumlah_talent"]) ?></td>
              <td><?= htmlspecialchars($row["tanggal_acara"]) ?></td>
              <td><?= htmlspecialchars($row["lokasi"]) ?></td>
              <td><?= htmlspecialchars($row["durasi"]) ?></td>
              <td><?= htmlspecialchars($row["waktu_submit"]) ?></td>
            </tr>
          <?php endwhile; ?>
        </table>
      </div>
    </div>
  </div>
  <?php include __DIR__ . '/../footer.php'; ?>
</body>
</html>