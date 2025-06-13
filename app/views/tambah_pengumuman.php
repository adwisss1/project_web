<?php
// filepath: d:\dari c\2Xampp\instal\htdocs\SI-BIRAMA\app\views\tambah_pengumuman.php
session_start();
require_once __DIR__ . '/../config/config.php';

// Hanya pengurus yang boleh akses
if (!isset($_SESSION["user"]["role"]) || $_SESSION["user"]["role"] !== "pengurus") {
    header("Location: beranda.php");
    exit();
}

$error = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $isi = trim($_POST["isi"]);
    if ($isi === "") {
        $error = "Isi pengumuman tidak boleh kosong.";
    } else {
        $stmt = $mysqli->prepare("INSERT INTO pengumuman (isi) VALUES (?)");
        $stmt->bind_param("s", $isi);
        if ($stmt->execute()) {
            header("Location: beranda.php");
            exit();
        } else {
            $error = "Gagal menambah pengumuman.";
        }
        $stmt->close();
    }
}
?>

<?php include 'header.php'; ?>

<div class="content">
    <h2>Tambah Pengumuman</h2>
    <?php if ($error): ?>
        <div style="color:red;"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <form method="post">
        <div class="form-row">
            <label for="isi">Isi Pengumuman:</label>
            <textarea name="isi" id="isi" rows="4" required></textarea>
        </div>
        <div class="button-group">
            <input type="submit" value="Simpan">
            <a href="beranda.php" class="button">Batal</a>
        </div>
    </form>
</div>

<?php include 'footer.php'; ?>