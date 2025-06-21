<?php

session_start();
require_once __DIR__ . '/../config/config.php';

// Hanya pengurus yang boleh akses
if (!isset($_SESSION["user"]["role"]) || $_SESSION["user"]["role"] !== "pengurus") {
    header("Location: beranda.php");
    exit();
}

$error = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $jenis_talent = trim($_POST["jenis_talent"]);
    $keterangan = trim($_POST["keterangan"]);
    if ($jenis_talent === "") {
        $error = "Jenis talent tidak boleh kosong.";
    } else {
        $stmt = $mysqli->prepare("INSERT INTO talent (jenis_talent, keterangan) VALUES (?, ?)");
        $stmt->bind_param("ss", $jenis_talent, $keterangan);
        if ($stmt->execute()) {
            header("Location: manajemen_talent&inventaris.php");
            exit();
        } else {
            $error = "Gagal menambah talent.";
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Talent</title>
    <link rel="stylesheet" href="/SI-BIRAMA/public/css/style.css">
</head>
<body>
<div class="layout-wrapper">
    <?php include 'sidebar_pengurus.html'; ?>
    <div class="main-content">
        <div class="content">
            <h2>Tambah Talent</h2>
            <?php if ($error): ?>
                <div style="color:red;"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>
            <form method="post" class="form-warna">
                <div class="form-row">
                    <label for="jenis_talent">Jenis Talent:</label>
                    <input type="text" name="jenis_talent" id="jenis_talent" required>
                </div>
                <div class="form-row">
                    <label for="keterangan">Keterangan:</label>
                    <textarea name="keterangan" id="keterangan" rows="3"></textarea>
                </div>
                <div class="button-group">
                    <button type="submit" class="button">Simpan</button>
                    <button type="button" class="button" onclick="window.location.href='manajemen_talent&inventaris.php'">Batal/kembali</button>
                </div>
            </form>
            <!-- <button type="button" class="button" onclick="window.location.href='manajemen_talent&inventaris.php'">Kembali ke Manajemen Talent</button> -->
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>
</body>
</html>