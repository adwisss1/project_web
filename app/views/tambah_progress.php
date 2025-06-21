<?php

require_once __DIR__ . '/../config/config.php';

if (!isset($_GET['id_program'])) {
    header("Location: kontrol_program.php");
    exit();
}
$id_program = intval($_GET['id_program']);

// Ambil nama program kerja
$stmt_prog = $mysqli->prepare("SELECT nama_program FROM program_kerja WHERE id=?");
$stmt_prog->bind_param('i', $id_program);
$stmt_prog->execute();
$stmt_prog->bind_result($nama_program);
$stmt_prog->fetch();
$stmt_prog->close();

$laporan = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $laporan_baru = $_POST["laporan"];
    $stmt = $mysqli->prepare("INSERT INTO progress_proker (id_program, laporan, tanggal_update) VALUES (?, ?, NOW())");
    $stmt->bind_param('is', $id_program, $laporan_baru);
    $stmt->execute();
    header("Location: kontrol_program.php?filter_program=$id_program#progress-proker");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Progress Program</title>
    <link rel="stylesheet" href="/SI-BIRAMA/public/css/style.css">
</head>
<body>
<div class="layout-wrapper">
    <?php include 'sidebar_pengurus.html'; ?>
    <div class="main-content">
        <div class="content">
            
            <h2>Tambah Progress: <?= htmlspecialchars($nama_program); ?></h2>
            <form method="POST" class="form-warna">
                <label for="laporan">Laporan Progress:</label><br>
                <textarea name="laporan" id="laporan" rows="6" cols="60" required></textarea><br><br>
                <button type="submit" class="button">Tambah</button>
            </form>
            <button type="button" class="button" onclick="window.location.href='kontrol_program.php?filter_program=<?= $id_program; ?>#progress-proker'">&larr; Kembali ke Progress</button>
        </div>
    </div>
</div>
<?php include __DIR__ . '/footer.php'; ?>
</body>
</html>