<?php
session_start();
require_once __DIR__ . '/../config/config.php';

// Cek login pengurus
if (!isset($_SESSION["user"]) || $_SESSION["user"]["role"] !== "pengurus") {
    header("Location: ../login.php");
    exit();
}

// Ambil daftar minat bakat
$minat_result = $mysqli->query("SELECT id_minat_bakat, nama_minat_bakat FROM minat_bakat");
$minat_evaluasi = isset($_GET['minat_evaluasi']) ? intval($_GET['minat_evaluasi']) : 0;

// Ambil anggota sesuai filter minat bakat
$anggota = [];
if ($minat_evaluasi) {
    $stmt = $mysqli->prepare("SELECT id, nama, nra, angkatan FROM anggota WHERE id_minat_bakat = ?");
    $stmt->bind_param("i", $minat_evaluasi);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $anggota[] = $row;
    }
    $stmt->close();
}

// Fungsi untuk mengambil evaluasi
function getEvaluasi($mysqli, $anggota_id) {
    $stmt = $mysqli->prepare("SELECT umpan_balik FROM evaluasi WHERE user_id = ?");
    $stmt->bind_param("i", $anggota_id);
    $stmt->execute();
    $stmt->bind_result($eval);
    $stmt->fetch();
    $stmt->close();
    return $eval;
}

// Mode add/edit evaluasi
$mode = isset($_GET['mode']) ? $_GET['mode'] : '';
$anggota_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$success = '';
$error = '';

if (($mode === 'add' || $mode === 'edit') && $anggota_id > 0) {
    // Pastikan anggota ID valid
    $stmt = $mysqli->prepare("SELECT COUNT(*) FROM anggota WHERE id = ?");
    $stmt->bind_param("i", $anggota_id);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();

    if ($count == 0) {
        die("Error: Anggota dengan ID $anggota_id tidak ditemukan.");
    }

    // Ambil nama anggota
    $stmt = $mysqli->prepare("SELECT nama FROM anggota WHERE id = ?");
    $stmt->bind_param("i", $anggota_id);
    $stmt->execute();
    $stmt->bind_result($nama_anggota);
    $stmt->fetch();
    $stmt->close();

    // Jika form disubmit
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $umpan_balik = trim($_POST['umpan_balik']);
        if ($mode === 'add') {
            // Insert evaluasi dengan validasi anggota
            $stmt = $mysqli->prepare("INSERT INTO evaluasi (user_id, umpan_balik) SELECT ?, ? FROM anggota WHERE id = ?");
            $stmt->bind_param("isi", $anggota_id, $umpan_balik, $anggota_id);
            if ($stmt->execute()) {
                $success = "Evaluasi berhasil ditambahkan.";
                header("Location: evaluasi_anggota.php?minat_evaluasi=$minat_evaluasi");
                exit();
            } else {
                $error = "Gagal menambah evaluasi. Pastikan anggota belum pernah dievaluasi atau data anggota valid.";
            }
        } elseif ($mode === 'edit') {
            // Update evaluasi
            $stmt = $mysqli->prepare("UPDATE evaluasi SET umpan_balik=? WHERE user_id=?");
            $stmt->bind_param("si", $umpan_balik, $anggota_id);
            if ($stmt->execute()) {
                $success = "Evaluasi berhasil diupdate.";
                header("Location: evaluasi_anggota.php?minat_evaluasi=$minat_evaluasi");
                exit();
            } else {
                $error = "Gagal mengupdate evaluasi.";
            }
        }
    }

    // Untuk edit, ambil data evaluasi lama
    $umpan_balik = '';
    if ($mode === 'edit') {
        $stmt = $mysqli->prepare("SELECT umpan_balik FROM evaluasi WHERE user_id = ?");
        $stmt->bind_param("i", $anggota_id);
        $stmt->execute();
        $stmt->bind_result($umpan_balik);
        $stmt->fetch();
        $stmt->close();
    }
    ?>

    <?php include __DIR__ . '/header.php'; ?>
    <h2><?= $mode === 'add' ? 'Tambah' : 'Edit' ?> Evaluasi Anggota</h2>
    <p><strong>Nama Anggota:</strong> <?= htmlspecialchars($nama_anggota) ?></p>
    <?php if ($error): ?><div style="color:red"><?= $error ?></div><?php endif; ?>
    <form method="post">
        <label for="umpan_balik">Evaluasi / Umpan Balik:</label><br>
        <textarea name="umpan_balik" id="umpan_balik" rows="4" cols="50" required><?= htmlspecialchars($umpan_balik) ?></textarea><br><br>
        <button type="submit"><?= $mode === 'add' ? 'Tambah' : 'Update' ?></button>
        <a href="evaluasi_anggota.php?minat_evaluasi=<?= $minat_evaluasi ?>">Batal</a>
    </form>
    <?php include __DIR__ . '/footer.php'; ?>
    <?php
    exit();
}
?>

<?php include __DIR__ . '/header.php'; ?>

<h2>Evaluasi Keaktifan Anggota</h2>

<!-- Filter Minat Bakat -->
<form method="get" style="margin-bottom:20px;">
    <label for="minat_evaluasi">Filter Minat Bakat:</label>
    <select name="minat_evaluasi" id="minat_evaluasi" onchange="this.form.submit()">
        <option value="">-- Pilih Minat Bakat --</option>
        <?php
        $minat_result->data_seek(0);
        while ($minat = $minat_result->fetch_assoc()): ?>
            <option value="<?= $minat['id_minat_bakat'] ?>" <?= $minat_evaluasi == $minat['id_minat_bakat'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($minat['nama_minat_bakat']) ?>
            </option>
        <?php endwhile; ?>
    </select>
</form>

<?php if ($minat_evaluasi && count($anggota) > 0): ?>
    <table border="1">
        <tr>
            <th>Nama</th>
            <th>NRA</th>
            <th>Angkatan</th>
            <th>Evaluasi</th>
            <th>Aksi</th>
        </tr>
        <?php foreach ($anggota as $a): ?>
            <tr>
                <td><?= htmlspecialchars($a['nama']) ?></td>
                <td><?= htmlspecialchars($a['nra']) ?></td>
                <td><?= htmlspecialchars($a['angkatan']) ?></td>
                <td><?= htmlspecialchars(getEvaluasi($mysqli, $a['id'])) ?></td>
                <td>
                    <a href="evaluasi_anggota.php?mode=<?= getEvaluasi($mysqli, $a['id']) ? 'edit' : 'add' ?>&id=<?= $a['id'] ?>&minat_evaluasi=<?= $minat_evaluasi ?>">
                        <?= getEvaluasi($mysqli, $a['id']) ? 'Edit' : 'Tambah' ?>
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>

<?php include __DIR__ . '/footer.php'; ?>
