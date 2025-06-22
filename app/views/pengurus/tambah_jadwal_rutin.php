<?php
session_start();
require_once __DIR__ . '/../../config/config.php';

// Pastikan hanya pengurus yang bisa akses
if (!isset($_SESSION["user"]) || $_SESSION["user"]["role"] !== "pengurus") {
    header("Location: ../login.php");
    exit();
}

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $minat_bakat = trim($_POST['minat_bakat']);
    $hari = trim($_POST['hari']);
    $jam = trim($_POST['jam']);
    $durasi = intval($_POST['durasi']);
    $mentor = trim($_POST['mentor']);

    if ($minat_bakat === '' || $hari === '' || $jam === '' || $durasi <= 0 || $mentor === '') {
        $error = "Semua field wajib diisi.";
    } else {
        $stmt = $mysqli->prepare("INSERT INTO jadwal_rutin (minat_bakat, hari, jam, durasi, mentor) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssds", $minat_bakat, $hari, $jam, $durasi, $mentor);
        if ($stmt->execute()) {
            $success = "Jadwal rutin berhasil ditambahkan.";
            $stmt->close();
            header("Location: manajemen_jadwal.php");
            exit();
        } else {
            $error = "Gagal menambah jadwal rutin.";
            $stmt->close();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Jadwal Rutin</title>
    <link rel="stylesheet" href="/SI-BIRAMA/public/css/style.css">
</head>
<body>
<div class="layout-wrapper">
    <?php include 'sidebar_pengurus.html'; ?>
    <div class="main-content">
        <div class="content">
            <h2>Tambah Jadwal Rutin</h2>
            <?php if ($error): ?>
                <div style="color:red"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>
            <form method="post" class="form-warna">
                <label>Minat Bakat:
                    <input type="text" name="minat_bakat" required>
                </label><br>
                <label>Hari:
                    <input type="text" name="hari" required>
                </label><br>
                <label>Jam:
                    <input type="time" name="jam" required>
                </label><br>
                <label>Durasi (jam):
                    <input type="number" name="durasi" min="1" required>
                </label><br>
                <label>Mentor:
                    <input type="text" name="mentor" required>
                </label><br>
                <button type="submit" class="button">Simpan</button>
                <button type="button" class="button" onclick="window.location.href='manajemen_jadwal.php'">Kembali</button>
            </form>
        </div>
    </div>
</div>
<?php include __DIR__ . '/../footer.php'; ?>
</body>
</html>