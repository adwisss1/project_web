<?php
// filepath: d:\dari c\2Xampp\instal\htdocs\SI-BIRAMA\app\views\evaluasi_anggota.php
session_start();
require_once __DIR__ . '/../config/config.php';

// Cek login pengurus
if (!isset($_SESSION["user"]) || $_SESSION["role"] !== "pengurus") {
    header("Location: ../login.php");
    exit();
}

$mode = $_GET['mode'] ?? 'add';
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$feedback = '';
$success = '';
$error = '';

// Ambil data anggota
$stmt = $mysqli->prepare("SELECT nama FROM anggota WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($nama_anggota);
$stmt->fetch();
$stmt->close();

if (!$nama_anggota) {
    echo "Anggota tidak ditemukan.";
    exit();
}

// Ambil evaluasi jika mode edit
$evaluasi_text = '';
if ($mode === 'edit') {
    $stmt = $mysqli->prepare("SELECT umpan_balik FROM evaluasi WHERE user_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($evaluasi_text);
    $stmt->fetch();
    $stmt->close();
}

// Proses tambah/edit evaluasi
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $umpan_balik = trim($_POST['umpan_balik'] ?? '');

    if ($mode === 'add') {
        // Cek jika sudah ada evaluasi
        $cek = $mysqli->prepare("SELECT COUNT(*) FROM evaluasi WHERE user_id = ?");
        $cek->bind_param("i", $id);
        $cek->execute();
        $cek->bind_result($sudah_ada);
        $cek->fetch();
        $cek->close();

        if ($sudah_ada > 0) {
            $error = "Evaluasi sudah ada, gunakan edit.";
        } else {
            $stmt = $mysqli->prepare("INSERT INTO evaluasi (user_id, umpan_balik) VALUES (?, ?)");
            $stmt->bind_param("is", $id, $umpan_balik);
            if ($stmt->execute()) {
                $success = "Evaluasi berhasil ditambahkan.";
            } else {
                $error = "Gagal menambah evaluasi.";
            }
            $stmt->close();
        }
    } elseif ($mode === 'edit') {
        $stmt = $mysqli->prepare("UPDATE evaluasi SET umpan_balik = ?, updated_at = NOW() WHERE user_id = ?");
        $stmt->bind_param("si", $umpan_balik, $id);
        if ($stmt->execute()) {
            $success = "Evaluasi berhasil diubah.";
        } else {
            $error = "Gagal mengubah evaluasi.";
        }
        $stmt->close();
    }
    // Refresh data evaluasi
    $evaluasi_text = $umpan_balik;

    // Setelah tambah/edit/hapus evaluasi berhasil:
    $minat_evaluasi = isset($_GET['minat_evaluasi']) ? $_GET['minat_evaluasi'] : '';
    header("Location: manajemen_anggota_kinerja.php?minat_evaluasi=" . urlencode($minat_evaluasi) . "#tabel-evaluasi");
    exit();
}

// Proses hapus evaluasi
if ($mode === 'delete') {
    $stmt = $mysqli->prepare("DELETE FROM evaluasi WHERE user_id = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        header("Location: manajemen_anggota_kinerja.php?msg=hapus_sukses");
        exit();
    } else {
        $error = "Gagal menghapus evaluasi.";
    }
    $stmt->close();
    // Setelah tambah/edit/hapus evaluasi berhasil:
    $minat_evaluasi = isset($_GET['minat_evaluasi']) ? $_GET['minat_evaluasi'] : '';
    header("Location: manajemen_anggota_kinerja.php?minat_evaluasi=" . urlencode($minat_evaluasi) . "#tabel-evaluasi");
    exit();
}
?>

<?php include __DIR__ . '/header.php'; ?>

<a href="manajemen_anggota_kinerja.php">Kembali ke Manajemen Anggota</a>
<h2><?= ucfirst($mode) ?> Evaluasi Anggota</h2>
<p><strong>Nama Anggota:</strong> <?= htmlspecialchars($nama_anggota) ?></p>

<?php if ($error): ?>
    <div style="color:red"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>
<?php if ($success): ?>
    <div style="color:green"><?= htmlspecialchars($success) ?></div>
    <a href="manajemen_anggota_kinerja.php">Kembali ke Manajemen Anggota</a>
<?php elseif ($mode === 'add' || $mode === 'edit'): ?>
    <form method="post">
        <label>Evaluasi / Umpan Balik:<br>
            <textarea name="umpan_balik" rows="5" cols="50"><?= htmlspecialchars($evaluasi_text) ?></textarea>
        </label><br>
        <button type="submit"><?= $mode === 'add' ? 'Tambah' : 'Simpan' ?> Evaluasi</button>
    </form>
<?php elseif ($mode === 'delete'): ?>
    <p>Gagal menghapus evaluasi.</p>
<?php endif; ?>

<?php include __DIR__ . '/footer.php'; ?>