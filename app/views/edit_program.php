<?php
session_start();
require_once __DIR__ . '/../config/config.php';
if (!isset($_SESSION["user"]) || $_SESSION["user"]["role"] !== "pengurus") {
    header("Location: ../login.php");
    exit();
}

// Contoh pengambilan data program kerja
$id_program = isset($_GET['id']) ? intval($_GET['id']) : 0;
$error = '';
$success = '';
$nama_program = '';
$deskripsi = '';

if ($id_program) {
    $stmt = $mysqli->prepare("SELECT nama_program, deskripsi FROM program_kerja WHERE id=?");
    $stmt->bind_param("i", $id_program);
    $stmt->execute();
    $stmt->bind_result($nama_program, $deskripsi);
    $stmt->fetch();
    $stmt->close();
    if (!$nama_program) {
        $error = "Program tidak ditemukan.";
    }
} else {
    $error = "ID program tidak ditemukan.";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $id_program) {
    $nama_program = trim($_POST['nama_program']);
    $deskripsi = trim($_POST['deskripsi']);
    if ($nama_program === '' || $deskripsi === '') {
        $error = "Semua field wajib diisi.";
    } else {
        $stmt = $mysqli->prepare("UPDATE program_kerja SET nama_program=?, deskripsi=? WHERE id=?");
        $stmt->bind_param("ssi", $nama_program, $deskripsi, $id_program);
        if ($stmt->execute()) {
            $success = "Program berhasil diupdate.";
            header("Location: kontrol_program.php");
            exit();
        } else {
            $error = "Gagal mengupdate program.";
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Program Kerja</title>
    <link rel="stylesheet" href="/SI-BIRAMA/public/css/style.css">
</head>
<body>
<div class="layout-wrapper">
    <!-- Sidebar -->
    <nav class="sidebar-custom">
        <div class="sidebar-header">
            <img src="/SI-BIRAMA/public/images/logo_noback.jpg" alt="Logo" class="logo-sidebar" width="100">
        </div>
        <ul>
            <li><a href="beranda_pengurus.php">Dashboard</a></li>
            <li><a href="manajemen_anggota_kinerja.php">Manajemen Anggota</a></li>
            <li><a href="evaluasi_anggota.php">Evaluasi Anggota</a></li>
            <li><a href="manajemen_jadwal.php">Manajemen Jadwal</a></li>
            <li><a href="kontrol_program.php">Kontrol Program Kerja</a></li>
            <li><a href="manajemen_materi.php">Materi Latihan</a></li>
            <li><a href="manajemen_talent&inventaris.php">Talent & Inventaris</a></li>
            <li><a href="/SI-BIRAMA/app/controllers/authController.php?logout=true" class="text-danger">Logout</a></li>
        </ul>
    </nav>
    <!-- Main Content -->
    <div class="main-content">
        <div class="content">
            <h2>Edit Program Kerja</h2>
            <?php if ($error): ?>
                <div style="color:red;"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>
            <?php if ($success): ?>
                <div style="color:green;"><?= htmlspecialchars($success) ?></div>
            <?php endif; ?>
            <?php if ($id_program && !$error): ?>
            <form method="post" class="form-warna"  >
                <label>Nama Program:
                    <input type="text" name="nama_program" value="<?= htmlspecialchars($nama_program) ?>" required>
                </label><br>
                <label>Deskripsi:
                    <textarea name="deskripsi" required><?= htmlspecialchars($deskripsi) ?></textarea>
                </label><br>
                <button type="submit" class="button">Simpan Perubahan</button>
                <button type="button" class="button" onclick="window.location.href='kontrol_program.php'">Kembali</button>
            </form>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>
</body>
</html>