<?php
// filepath: d:\dari c\2Xampp\instal\htdocs\SI-BIRAMA\app\views\tambah_portofolio.php
session_start();
require_once __DIR__ . '/../config/config.php';

if (!isset($_SESSION["user"]["role"]) || $_SESSION["user"]["role"] !== "pengurus") {
    header("Location: beranda.php");
    exit();
}

$error = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $judul = trim($_POST["judul"]);
    $deskripsi = trim($_POST["deskripsi"]);
    $link = trim($_POST["link"]);
    if ($judul === "" || $link === "") {
        $error = "Judul dan link tidak boleh kosong.";
    } else {
        $stmt = $mysqli->prepare("INSERT INTO portofolio (judul, deskripsi, link) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $judul, $deskripsi, $link);
        if ($stmt->execute()) {
            header("Location: portofolio.php");
            exit();
        } else {
            $error = "Gagal menambah portofolio.";
        }
        $stmt->close();
    }
}
?>

<?php include 'header.php'; ?>
<div class="content">
    <h2>Tambah Portofolio</h2>
    <?php if ($error): ?>
        <div style="color:red;"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <form method="post">
        <div class="form-row">
            <label for="judul">Judul:</label>
            <input type="text" name="judul" id="judul" required>
        </div>
        <div class="form-row">
            <label for="deskripsi">Deskripsi:</label>
            <textarea name="deskripsi" id="deskripsi" rows="3"></textarea>
        </div>
        <div class="form-row">
            <label for="link">Link Video (embed):</label>
            <input type="text" name="link" id="link" required>
        </div>
        <div class="button-group">
            <input type="submit" value="Simpan">
            <a href="portofolio.php" class="button">Batal</a>
        </div>
    </form>
</div>
<?php include 'footer.php'; ?>