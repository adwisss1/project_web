<?php
// filepath: d:\dari c\2Xampp\instal\htdocs\SI-BIRAMA\app\views\tambah_inventaris.php
session_start();
require_once __DIR__ . '/../config/config.php';

if (!isset($_SESSION["user"]["role"]) || $_SESSION["user"]["role"] !== "pengurus") {
    header("Location: beranda.php");
    exit();
}

$error = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nama_item = trim($_POST["nama_item"]);
    $harga_sewa = trim($_POST["harga_sewa"]);
    if ($nama_item === "" || $harga_sewa === "") {
        $error = "Nama item dan harga sewa tidak boleh kosong.";
    } else {
        $stmt = $mysqli->prepare("INSERT INTO inventaris (nama_item, harga_sewa) VALUES (?, ?)");
        $stmt->bind_param("sd", $nama_item, $harga_sewa);
        if ($stmt->execute()) {
            header("Location: manajemen_talent&inventaris.php");
            exit();
        } else {
            $error = "Gagal menambah inventaris.";
        }
        $stmt->close();
    }
}
?>

<?php include 'header.php'; ?>
<div class="content">
    <h2>Tambah Inventaris</h2>
    <?php if ($error): ?>
        <div style="color:red;"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <form method="post">
        <div class="form-row">
            <label for="nama_item">Nama Item:</label>
            <input type="text" name="nama_item" id="nama_item" required>
        </div>
        <div class="form-row">
            <label for="harga_sewa">Harga Sewa (per hari):</label>
            <input type="number" name="harga_sewa" id="harga_sewa" required>
        </div>
        <div class="button-group">
            <input type="submit" value="Simpan">
            <a href="manajemen_talent&inventaris.php" class="button">Batal</a>
        </div>
    </form>
</div>
<?php include 'footer.php'; ?>