<?php

session_start();
require_once __DIR__ . '/../config/config.php';

// Pastikan user adalah pengurus
if (!isset($_SESSION["user"]) || $_SESSION["role"] !== "pengurus") {
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
    SELECT DISTINCT anggota.id, anggota.nama, anggota.nra, anggota.user_id, anggota.id_minat_bakat, anggota.angkatan,
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

// Ambil evaluasi keaktifan anggota (tabel lama, jika masih ingin ditampilkan)
$stmt2 = $mysqli->prepare("SELECT user_id, umpan_balik FROM evaluasi");
$stmt2->execute();
$evaluasi_result = $stmt2->get_result();

// --- Tambahan: Filter & Tabel Evaluasi Keaktifan per Minat Bakat ---
$minat_result_eval = $mysqli->query("SELECT id_minat_bakat, nama_minat_bakat FROM minat_bakat");
$filter_minat_evaluasi = isset($_GET['minat_evaluasi']) ? $_GET['minat_evaluasi'] : '';

$anggota_evaluasi_result = null;
if ($filter_minat_evaluasi !== '') {
    $stmt_eval = $mysqli->prepare("
        SELECT a.id, a.nama, a.nra, a.angkatan, mb.nama_minat_bakat,
            (SELECT COUNT(*) FROM absensi WHERE absensi.user_id = a.user_id) AS jumlah_absen
        FROM anggota a
        LEFT JOIN minat_bakat mb ON a.id_minat_bakat = mb.id_minat_bakat
        WHERE a.id_minat_bakat = ?
        ORDER BY jumlah_absen ASC, a.nama ASC
    ");
    $stmt_eval->bind_param("i", $filter_minat_evaluasi);
    $stmt_eval->execute();
    $anggota_evaluasi_result = $stmt_eval->get_result();
}
?>

<?php include __DIR__ . '/header.php'; ?>

<a href="beranda_pengurus.php">Kembali ke Beranda Pengurus</a>
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

<a href="anggota_crud.php?mode=add">Tambah Anggota Baru</a>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>NRA</th>
        <th>Angkatan</th>
        <th>Minat Bakat</th>
        <th>Aksi</th>
    </tr>
    <?php while ($anggota = $anggota_result->fetch_assoc()) { ?>
        <tr>
            <td><?= $anggota["id"]; ?></td>
            <td><?= htmlspecialchars($anggota["nama"]); ?></td>
            <td><?= htmlspecialchars($anggota["nra"]); ?></td>
            <td><?= htmlspecialchars($anggota["angkatan"]); ?></td>
            <td><?= htmlspecialchars($anggota["nama_minat_bakat"] ?? "Belum Terdaftar"); ?></td>
            <td>
            <a href="anggota_crud.php?mode=edit&id=<?= $anggota["id"]; ?>">Edit</a> |
            <a href="anggota_crud.php?mode=delete&id=<?= $anggota["id"]; ?>" onclick="return confirm('Yakin ingin menghapus anggota ini?')">Hapus</a>
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

<!-- Tambahan: Evaluasi Keaktifan Anggota per Minat Bakat -->
<h2>Evaluasi Keaktifan Anggota per Minat Bakat</h2>
<form method="get" style="margin-bottom:16px;">
    <label>Pilih Minat Bakat:
        <select name="minat_evaluasi" required>
            <option value="">-- Pilih Minat Bakat --</option>
            <?php
            $minat_result_eval->data_seek(0);
            while ($minat = $minat_result_eval->fetch_assoc()) { ?>
                <option value="<?= $minat['id_minat_bakat'] ?>" <?= $filter_minat_evaluasi == $minat['id_minat_bakat'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($minat['nama_minat_bakat']) ?>
                </option>
            <?php } ?>
        </select>
    </label>
    <button type="submit">Tampilkan</button>
</form>
<table border="1">
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Angkatan</th>
        <th>Jumlah Absensi</th>
        <th>Evaluasi</th>
        <th>Aksi</th>
    </tr>
    <?php
    if ($filter_minat_evaluasi !== '' && $anggota_evaluasi_result && $anggota_evaluasi_result->num_rows > 0) {
        $no = 1;
        while ($anggota = $anggota_evaluasi_result->fetch_assoc()) {
            // Ambil evaluasi untuk anggota ini
            $evaluasi_text = '';
            $stmt_eval_detail = $mysqli->prepare("SELECT umpan_balik FROM evaluasi WHERE user_id = ?");
            $stmt_eval_detail->bind_param("i", $anggota["id"]);
            $stmt_eval_detail->execute();
            $stmt_eval_detail->bind_result($evaluasi_text);
            $stmt_eval_detail->fetch();
            $stmt_eval_detail->close();

            echo "<tr>";
            echo "<td>{$no}</td>";
            echo "<td>" . htmlspecialchars($anggota["nama"]) . "</td>";
            echo "<td>" . htmlspecialchars($anggota["angkatan"]) . "</td>";
            echo "<td>" . htmlspecialchars($anggota["jumlah_absen"]) . "</td>";
            echo "<td>" . htmlspecialchars($evaluasi_text ?? '') . "</td>";
            echo "<td>";
            if (empty($evaluasi_text)) {
                // Belum ada evaluasi
                echo "<a href='evaluasi_anggota.php?mode=add&id=" . $anggota["id"] . "&minat_evaluasi=" . urlencode($filter_minat_evaluasi) . "'>Tambah Evaluasi</a>";
                // echo "<a href='evaluasi_anggota.php?mode=add&id=" . $anggota["id"] . "'>Tambah Evaluasi</a>";
            } else {
                            // Sudah ada evaluasi
            echo "<a href='evaluasi_anggota.php?mode=edit&id=" . $anggota["id"] . "&minat_evaluasi=" . urlencode($filter_minat_evaluasi) . "'>Edit</a> | ";
            echo "<a href='evaluasi_anggota.php?mode=delete&id=" . $anggota["id"] . "&minat_evaluasi=" . urlencode($filter_minat_evaluasi) . "' onclick=\"return confirm('Hapus evaluasi ini?')\">Hapus</a>";
            }
            echo "</td>";
            echo "</tr>";
            $no++;
        }
    } elseif ($filter_minat_evaluasi !== '') {
        echo "<tr><td colspan='6'>Tidak ada anggota pada minat bakat ini.</td></tr>";
    } else {
        echo "<tr><td colspan='6'>Silakan pilih minat bakat untuk evaluasi.</td></tr>";
    }
    ?>
</table>

<?php include __DIR__ . '/footer.php'; ?>