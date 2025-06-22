<?php

require_once __DIR__ . '/../../config/config.php';

// Jika edit progress (dengan id progress)
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $stmt = $mysqli->prepare("SELECT id_program, laporan FROM progress_proker WHERE id=?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->bind_result($id_program, $laporan);
    $stmt->fetch();
    $stmt->close();

    // Ambil nama program kerja
    $stmt_prog = $mysqli->prepare("SELECT nama_program FROM program_kerja WHERE id=?");
    $stmt_prog->bind_param('i', $id_program);
    $stmt_prog->execute();
    $stmt_prog->bind_result($nama_program);
    $stmt_prog->fetch();
    $stmt_prog->close();

    // Proses submit form: UPDATE
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $laporan_baru = $_POST["laporan"];
        $stmt = $mysqli->prepare("UPDATE progress_proker SET laporan=?, tanggal_update=NOW() WHERE id=?");
        $stmt->bind_param('si', $laporan_baru, $id);
        $stmt->execute();
        header("Location: kontrol_program.php?filter_program=$id_program#progress-proker");
        exit();
    }
} else {
    // Jika tidak ada id, redirect
    header("Location: kontrol_program.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Progress Program</title>
    <link rel="stylesheet" href="/SI-BIRAMA/public/css/style.css">
</head>
<body>
<div class="layout-wrapper">
    <?php include 'sidebar_pengurus.html'; ?>
    <div class="main-content">
        <div class="content">
            
            <h2>Edit Progress: <?= htmlspecialchars($nama_program); ?></h2>
            <form method="POST" class="form-warna">
                <label for="laporan">Laporan Progress:</label><br>
                <textarea name="laporan" id="laporan" rows="6" cols="60" required><?= htmlspecialchars($laporan); ?></textarea><br><br>
                <button type="submit" class="button">Update</button>
            </form>
            <button type="button" class="button" onclick="window.location.href='kontrol_program.php?filter_program=<?= $id_program; ?>#progress-proker'">&larr; Kembali ke Progress</button>
        </div>
    </div>
</div>
<?php include __DIR__ . '/../footer.php'; ?>
</body>
</html>