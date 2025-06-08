<?php

session_start();
require_once __DIR__ . '/../config/config.php';

// Pastikan user adalah pengurus
if (!isset($_SESSION["user"]) || $_SESSION["user"]["role"] !== "pengurus") {
    header("Location: ../login.php");
    exit();
}

// Ambil daftar angkatan unik
$angkatan_result = $mysqli->query("SELECT DISTINCT angkatan FROM anggota ORDER BY angkatan DESC");

// Ambil daftar minat bakat
$minat_result = $mysqli->query("SELECT id_minat_bakat, nama_minat_bakat FROM minat_bakat");

// Ambil filter dari form
$filter_angkatan = isset($_GET['angkatan']) ? $_GET['angkatan'] : '';
$filter_minat = isset($_GET['minat']) ? $_GET['minat'] : '';
$search = isset($_GET['search']) ? $_GET['search'] : '';

// PAGINATION SETUP
$per_page = 25;
$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$offset = ($page - 1) * $per_page;

// Query anggota dengan filter (untuk count)
$count_query = "
    SELECT COUNT(DISTINCT anggota.id) 
    FROM anggota 
    WHERE 1
";
$count_params = [];
$count_types = '';

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
    $count_params[] = "%$search%";
    $count_params[] = "%$search%";
    $count_types .= 'ss';
}

$count_stmt = $mysqli->prepare($count_query);
if (!empty($count_params)) {
    $count_stmt->bind_param($count_types, ...$count_params);
}
$count_stmt->execute();
$count_stmt->bind_result($total_rows);
$count_stmt->fetch();
$count_stmt->close();

$total_pages = max(1, ceil($total_rows / $per_page));

// Query anggota dengan filter dan LIMIT
$query = "
    SELECT DISTINCT anggota.id, anggota.nama, anggota.nra, anggota.user_id, anggota.angkatan
    FROM anggota 
    WHERE 1
";
$params = [];
$types = '';

if ($filter_angkatan !== '') {
    $query .= " AND anggota.angkatan = ? ";
    $params[] = $filter_angkatan;
    $types .= 'i';
}
if ($filter_minat !== '') {
    $query .= " AND EXISTS (SELECT 1 FROM anggota_minat_bakat amb WHERE amb.id_anggota = anggota.id AND amb.id_minat_bakat = ?) ";
    $params[] = $filter_minat;
    $types .= 'i';
}
if ($search !== '') {
    $query .= " AND (anggota.nama LIKE ? OR anggota.nra LIKE ?) ";
    $params[] = "%$search%";
    $params[] = "%$search%";
    $types .= 'ss';
}

$query .= " ORDER BY anggota.angkatan DESC, anggota.nama ASC LIMIT ? OFFSET ?";
$params[] = $per_page;
$params[] = $offset;
$types .= 'ii';

$stmt = $mysqli->prepare($query);
if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$anggota_result = $stmt->get_result();

// Ambil semua minat bakat anggota (relasi many-to-many)
$anggota_minat = [];
$minat_sql = "SELECT amb.id_anggota, mb.nama_minat_bakat 
              FROM anggota_minat_bakat amb 
              JOIN minat_bakat mb ON amb.id_minat_bakat = mb.id_minat_bakat";
$minat_res = $mysqli->query($minat_sql);
while ($row = $minat_res->fetch_assoc()) {
    $anggota_minat[$row['id_anggota']][] = $row['nama_minat_bakat'];
}

// Fungsi untuk ambil evaluasi anggota
function getEvaluasiAnggota($mysqli, $anggota_id) {
    $stmt = $mysqli->prepare("SELECT umpan_balik FROM evaluasi WHERE user_id = ?");
    $stmt->bind_param("i", $anggota_id);
    $stmt->execute();
    $stmt->bind_result($eval);
    $stmt->fetch();
    $stmt->close();
    return $eval;
}

?>

<?php include __DIR__ . '/header.php'; ?>

<a href="beranda_pengurus.php">Kembali ke Beranda Pengurus</a>
<h2>Manajemen Anggota</h2>

<!-- Form Filter -->
<form method="get" style="margin-bottom:16px;">
    <label>Angkatan:
        <select name="angkatan">
            <option value="">Semua</option>
            <?php
            $angkatan_result->data_seek(0);
            while ($angkatan = $angkatan_result->fetch_assoc()) { ?>
                <option value="<?= $angkatan['angkatan'] ?>" <?= $filter_angkatan == $angkatan['angkatan'] ? 'selected' : '' ?>>
                    <?= $angkatan['angkatan'] ?>
                </option>
            <?php } ?>
        </select>
    </label>
    <label>Minat Bakat:
        <select name="minat">
            <option value="">Semua</option>
            <?php
            $minat_result->data_seek(0);
            while ($minat = $minat_result->fetch_assoc()) { ?>
                <option value="<?= $minat['id_minat_bakat'] ?>" <?= $filter_minat == $minat['id_minat_bakat'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($minat['nama_minat_bakat']) ?>
                </option>
            <?php } ?>
        </select>
    </label>
    <label>Cari:
        <input type="text" name="search" value="<?= htmlspecialchars($search) ?>" placeholder="Nama atau NRA">
    </label>
    <button type="submit">Tampilkan</button>
    <a href="manajemen_anggota_kinerja.php">Reset</a>
</form>

<a href="anggota_crud.php?mode=add">Tambah Anggota Baru</a>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>NRA</th>
        <th>Angkatan</th>
        <th>Minat Bakat</th>
        <th>Aksi</th>
        <th>View Evaluasi</th>
    </tr>
    <?php while ($anggota = $anggota_result->fetch_assoc()) { ?>
        <tr>
            <td><?= $anggota["id"]; ?></td>
            <td><?= htmlspecialchars($anggota["nama"]); ?></td>
            <td><?= htmlspecialchars($anggota["nra"]); ?></td>
            <td><?= htmlspecialchars($anggota["angkatan"]); ?></td>
            <td>
                <?php
                if (!empty($anggota_minat[$anggota["id"]])) {
                    echo htmlspecialchars(implode(', ', $anggota_minat[$anggota["id"]]));
                } else {
                    echo "<i>Belum Terdaftar</i>";
                }
                ?>
            </td>
            <td>
                <a href="anggota_crud.php?mode=edit&id=<?= $anggota["id"]; ?>">Edit</a> |
                <a href="anggota_crud.php?mode=delete&id=<?= $anggota["id"]; ?>" onclick="return confirm('Yakin ingin menghapus anggota ini?')">Hapus</a>
            </td>
            <td>
                <a href="evaluasi_anggota.php?id=<?= $anggota["id"]; ?>&mode=view" target="_blank">View Evaluasi</a>
            </td>
        </tr>
    <?php } ?>
</table>

<!-- PAGINATION NAVIGATION -->
<div style="margin:10px 0;">
    <?php if ($page > 1): ?>
        <a href="?<?= http_build_query(array_merge($_GET, ['page' => $page - 1])) ?>">Sebelumnya</a>
    <?php endif; ?>
    Halaman <?= $page ?> dari <?= $total_pages ?>
    <?php if ($page < $total_pages): ?>
        <a href="?<?= http_build_query(array_merge($_GET, ['page' => $page + 1])) ?>">Selanjutnya</a>
    <?php endif; ?>
</div>

<?php include __DIR__ . '/footer.php'; ?>