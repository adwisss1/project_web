<?php
// filepath: d:\dari c\2Xampp\instal\htdocs\SI-BIRAMA\app\views\edit_inventaris.php
session_start();
require_once __DIR__ . '/../config/config.php';

if (!isset($_SESSION["user"]["role"]) || $_SESSION["user"]["role"] !== "pengurus") {
    header("Location: beranda.php");
    exit();
}

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$error = "";

$stmt = $mysqli->prepare("SELECT nama_item, harga_sewa FROM inventaris WHERE id_inventaris=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($nama_item, $harga_sewa);
if (!$stmt->fetch()) {
    $stmt->close();
    header("Location: manajemen_talent&inventaris.php");
    exit();
}
$stmt->close();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nama_item = trim($_POST["nama_item"]);
    $harga_sewa = trim($_POST["harga_sewa"]);
    if ($nama_item === "" || $harga_sewa === "") {
        $error = "Nama item dan harga sewa tidak boleh kosong.";
    } else {
        $stmt = $mysqli->prepare("UPDATE inventaris SET nama_item=?, harga_sewa=? WHERE id_inventaris=?");
        $stmt->bind_param("sdi", $nama_item, $harga_sewa, $id);
        if ($stmt->execute()) {
            header("Location: manajemen_talent&inventaris.php");
            exit();
        } else {
            $error = "Gagal mengedit inventaris.";
        }
        $stmt->close();
    }
}
?>

<?php include 'header.php'; ?>
<div class="content">
    <h2>Edit Inventaris</h2>
    <?php if ($error): ?>
        <div style="color:red;"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <form method="post">
        <div class="form-row">
            <label for="nama_item">Nama Item:</label>
            <input type="text" name="nama_item" id="nama_item" value="<?= htmlspecialchars($nama_item) ?>" required>
        </div>
        <div class="form-row">
            <label for="harga_sewa">Harga Sewa (per hari):</label>
            <input type="number" name="harga_sewa" id="harga_sewa" value="<?= htmlspecialchars($harga_sewa) ?>" required>
        </div>
        <div class="button-group">
            <input type="submit" value="Simpan">
            <a href="manajemen_talent&inventaris.php" class="button">Batal</a>
        </div>
    </form>
</div>
<?php include 'footer.php'; ?>