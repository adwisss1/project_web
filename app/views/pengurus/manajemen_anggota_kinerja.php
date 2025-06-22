<?php
session_start();
require_once __DIR__ . '/../../config/config.php';

// Autentikasi
if (!isset($_SESSION["user"]) || $_SESSION["user"]["role"] !== "pengurus") {
    header("Location: ../login.php");
    exit();
}

// Ambil data angkatan dan minat bakat
$angkatan_result = $mysqli->query("SELECT DISTINCT angkatan FROM anggota ORDER BY angkatan DESC");
$minat_result = $mysqli->query("SELECT id_minat_bakat, nama_minat_bakat FROM minat_bakat");

// Filter
$filter_angkatan = $_GET['angkatan'] ?? '';
$filter_minat = $_GET['minat'] ?? '';
$search = $_GET['search'] ?? '';

// Pagination
$per_page = 25;
$page = max(1, intval($_GET['page'] ?? 1));
$offset = ($page - 1) * $per_page;

// Hitung total rows
$count_query = "SELECT COUNT(DISTINCT anggota.id) FROM anggota WHERE 1";
$count_params = []; $count_types = '';
if ($filter_angkatan !== '') {
    $count_query .= " AND anggota.angkatan = ? ";
    $count_params[] = $filter_angkatan;
    $count_types .= 'i';
}
if ($filter_minat !== '') {
    $count_query .= " AND EXISTS (SELECT 1 FROM anggota_minat_bakat amb WHERE amb.id_anggota = anggota.id AND amb.id_minat_bakat = ?) ";
    $count_params[] = $filter_minat;
    $count_types .= 'i';
}
if ($search !== '') {
    $count_query .= " AND (anggota.nama LIKE ? OR anggota.nra LIKE ?) ";
    $count_params[] = "%$search%"; $count_params[] = "%$search%";
    $count_types .= 'ss';
}
$count_stmt = $mysqli->prepare($count_query);
if (!empty($count_params)) $count_stmt->bind_param($count_types, ...$count_params);
$count_stmt->execute(); $count_stmt->bind_result($total_rows); $count_stmt->fetch(); $count_stmt->close();
$total_pages = max(1, ceil($total_rows / $per_page));

// Query data anggota
$query = "SELECT DISTINCT anggota.id, anggota.nama, anggota.nra, anggota.user_id, anggota.angkatan FROM anggota WHERE 1";
$params = []; $types = '';
if ($filter_angkatan !== '') {
    $query .= " AND anggota.angkatan = ? ";
    $params[] = $filter_angkatan; $types .= 'i';
}
if ($filter_minat !== '') {
    $query .= " AND EXISTS (SELECT 1 FROM anggota_minat_bakat amb WHERE amb.id_anggota = anggota.id AND amb.id_minat_bakat = ?) ";
    $params[] = $filter_minat; $types .= 'i';
}
if ($search !== '') {
    $query .= " AND (anggota.nama LIKE ? OR anggota.nra LIKE ?) ";
    $params[] = "%$search%"; $params[] = "%$search%"; $types .= 'ss';
}
$query .= " ORDER BY anggota.angkatan DESC, anggota.nama ASC LIMIT ? OFFSET ?";
$params[] = $per_page; $params[] = $offset; $types .= 'ii';
$stmt = $mysqli->prepare($query);
if (!empty($params)) $stmt->bind_param($types, ...$params);
$stmt->execute();
$anggota_result = $stmt->get_result();

// Ambil relasi minat bakat
$anggota_minat = [];
$minat_sql = "SELECT amb.id_anggota, mb.nama_minat_bakat FROM anggota_minat_bakat amb JOIN minat_bakat mb ON amb.id_minat_bakat = mb.id_minat_bakat";
$minat_res = $mysqli->query($minat_sql);
while ($row = $minat_res->fetch_assoc()) {
    $anggota_minat[$row['id_anggota']][] = $row['nama_minat_bakat'];
}
?>
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

        <a href="anggota_crud.php?mode=add" class="button">+ Tambah Anggota Baru</a>

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
