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

<?php include __DIR__ . '/header.php'; ?>
<a href="kontrol_program.php?filter_program=<?= $id_program; ?>#progress-proker">Kembali ke Progress</a>
<h2>Tambah Progress: <?= htmlspecialchars($nama_program); ?></h2>

<form method="POST">
    <label for="laporan">Laporan Progress:</label><br>
    <textarea name="laporan" id="laporan" rows="6" cols="60" required></textarea><br><br>
    <button type="submit">Tambah</button>
</form>

<?php include __DIR__ . '/footer.php'; ?>