<?php
<<<<<<< HEAD

=======
>>>>>>> f64731c8172ae9102b8959bef25d5cc14f919973
session_start();
require_once __DIR__ . '/../config/config.php';

// Pastikan user adalah pengurus
if (!isset($_SESSION["user"]) || $_SESSION["role"] !== "pengurus") {
    header("Location: ../login.php");
    exit();
}

<<<<<<< HEAD
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
    SELECT COUNT(*) 
    FROM anggota 
    LEFT JOIN minat_bakat ON anggota.id_minat_bakat = minat_bakat.id_minat_bakat
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
    $count_query .= " AND anggota.id_minat_bakat = ? ";
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
    SELECT anggota.id, anggota.nama, anggota.nra, anggota.user_id, anggota.id_minat_bakat, anggota.angkatan,
           minat_bakat.nama_minat_bakat 
    FROM anggota 
    LEFT JOIN minat_bakat ON anggota.id_minat_bakat = minat_bakat.id_minat_bakat
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
    $query .= " AND anggota.id_minat_bakat = ? ";
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

// Ambil evaluasi keaktifan anggota
$stmt2 = $mysqli->prepare("SELECT user_id, kehadiran, performa, umpan_balik FROM evaluasi");
$stmt2->execute();
$evaluasi_result = $stmt2->get_result();
?>

<?php include __DIR__ . '/header.php'; ?>

<a href="beranda_pengurus.php" >Kembali ke Beranda Pengurus</a>
<h2>Manajemen & Evaluasi Anggota</h2>

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

<a href="tambah_anggota.php">Tambah Anggota Baru</a>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>NRA</th>
        <th>Angkatan</th>
        <th>Minat Bakat</th>
        <th>Aksi</th>
    </tr>
=======
// Ambil daftar anggota
$stmt = $mysqli->prepare("
    SELECT anggota.id, anggota.nama, anggota.nra, anggota.user_id, anggota.id_minat_bakat, 
           minat_bakat.nama_minat_bakat 
    FROM anggota 
    LEFT JOIN minat_bakat ON anggota.id_minat_bakat = minat_bakat.id_minat_bakat");
$stmt->execute();
$anggota_result = $stmt->get_result();

// Ambil daftar minat bakat
$stmt = $mysqli->prepare("SELECT id_minat_bakat, nama_minat_bakat FROM minat_bakat");
$stmt->execute();
$minat_result = $stmt->get_result();

// Ambil evaluasi keaktifan anggota
$stmt = $mysqli->prepare("SELECT user_id, kehadiran, performa, umpan_balik FROM evaluasi");
$stmt->execute();
$evaluasi_result = $stmt->get_result();
?>

<?php include __DIR__ . '/header.php'; ?>
<h2>Manajemen & Evaluasi Anggota</h2>

<a href="tambah_anggota.php">Tambah Anggota Baru</a>
<table border="1">
    <tr><th>ID</th><th>Nama</th><th>NRA</th><th>Minat Bakat</th><th>Aksi</th></tr>
>>>>>>> f64731c8172ae9102b8959bef25d5cc14f919973
    <?php while ($anggota = $anggota_result->fetch_assoc()) { ?>
        <tr>
            <td><?= $anggota["id"]; ?></td>
            <td><?= htmlspecialchars($anggota["nama"]); ?></td>
            <td><?= htmlspecialchars($anggota["nra"]); ?></td>
<<<<<<< HEAD
            <td><?= htmlspecialchars($anggota["angkatan"]); ?></td>
=======
>>>>>>> f64731c8172ae9102b8959bef25d5cc14f919973
            <td><?= htmlspecialchars($anggota["nama_minat_bakat"] ?? "Belum Terdaftar"); ?></td>
            <td>
                <a href="edit_anggota.php?id=<?= $anggota["id"]; ?>">Edit</a> |
                <a href="hapus_anggota.php?id=<?= $anggota["id"]; ?>">Hapus</a>
            </td>
        </tr>
    <?php } ?>
</table>

<<<<<<< HEAD
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

=======
>>>>>>> f64731c8172ae9102b8959bef25d5cc14f919973
<h2>Evaluasi Keaktifan Anggota</h2>
<table border="1">
    <tr><th>User ID</th><th>Kehadiran</th><th>Performa</th><th>Umpan Balik</th></tr>
    <?php while ($evaluasi = $evaluasi_result->fetch_assoc()) { ?>
        <tr>
            <td><?= $evaluasi["user_id"]; ?></td>
            <td><?= htmlspecialchars($evaluasi["kehadiran"]); ?></td>
            <td><?= htmlspecialchars($evaluasi["performa"]); ?></td>
            <td><?= htmlspecialchars($evaluasi["umpan_balik"]); ?></td>
        </tr>
    <?php } ?>
</table>

<<<<<<< HEAD
<?php include __DIR__ . '/footer.php'; ?>
=======
<?php include __DIR__ . '/footer.php'; ?>

>>>>>>> f64731c8172ae9102b8959bef25d5cc14f919973
