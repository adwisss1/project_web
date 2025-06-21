<?php

session_start();
require_once __DIR__ . '/../config/config.php';

if (!isset($_SESSION["user"]["role"]) || $_SESSION["user"]["role"] !== "pengurus") {
    header("Location: beranda.php");
    exit();
}

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$error = "";

$stmt = $mysqli->prepare("SELECT jenis_talent, keterangan FROM talent WHERE id_talent=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($jenis_talent, $keterangan);
if (!$stmt->fetch()) {
    $stmt->close();
    header("Location: manajemen_talent&inventaris.php");
    exit();
}
$stmt->close();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $jenis_talent = trim($_POST["jenis_talent"]);
    $keterangan = trim($_POST["keterangan"]);
    if ($jenis_talent === "") {
        $error = "Jenis talent tidak boleh kosong.";
    } else {
        $stmt = $mysqli->prepare("UPDATE talent SET jenis_talent=?, keterangan=? WHERE id_talent=?");
        $stmt->bind_param("ssi", $jenis_talent, $keterangan, $id);
        if ($stmt->execute()) {
            header("Location: manajemen_talent&inventaris.php");
            exit();
        } else {
            $error = "Gagal mengedit talent.";
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Talent</title>
    <link rel="stylesheet" href="/SI-BIRAMA/public/css/style.css">
</head>
<body>
<div class="layout-wrapper">
    <?php include 'sidebar_pengurus.html'; ?>
    <div class="main-content">
        <div class="content">
            <h2>Edit Talent</h2>
            <?php if ($error): ?>
                <div style="color:red;"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>
            <form method="post">
                <div class="form-row">
                    <label for="jenis_talent">Jenis Talent:</label>
                    <input type="text" name="jenis_talent" id="jenis_talent" value="<?= htmlspecialchars($jenis_talent) ?>" required>
                </div>
                <div class="form-row">
                    <label for="keterangan">Keterangan:</label>
                    <textarea name="keterangan" id="keterangan" rows="3"><?= htmlspecialchars($keterangan) ?></textarea>
                </div>
                <div class="button-group">
                    <button type="submit" class="button">Simpan</button>
                    <button type="button" class="button" onclick="window.location.href='manajemen_talent&inventaris.php'">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>