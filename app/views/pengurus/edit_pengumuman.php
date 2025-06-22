<?php
session_start();
require_once __DIR__ . '/../../config/config.php';

if (!isset($_SESSION["user"]["role"]) || $_SESSION["user"]["role"] !== "pengurus") {
    header("Location: beranda.php");
    exit();
}

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$error = "";

if ($id <= 0) {
    header("Location: beranda.php");
    exit();
}

// Ambil data pengumuman
$stmt = $mysqli->prepare("SELECT isi FROM pengumuman WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($isi_pengumuman);
if (!$stmt->fetch()) {
    $stmt->close();
    header("Location: beranda.php");
    exit();
}
$stmt->close();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $isi = trim($_POST["isi"]);
    if ($isi === "") {
        $error = "Isi pengumuman tidak boleh kosong.";
    } else {
        $stmt = $mysqli->prepare("UPDATE pengumuman SET isi=? WHERE id=?");
        $stmt->bind_param("si", $isi, $id);
        if ($stmt->execute()) {
            header("Location: beranda.php");
            exit();
        } else {
            $error = "Gagal mengedit pengumuman.";
        }
        $stmt->close();
    }
}
?>

<?php include 'header.php'; ?>
<div class="content">
    <h2>Edit Pengumuman</h2>
    <?php if ($error): ?>
        <div style="color:red;"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <form method="post">
        <div class="form-row">
            <label for="isi">Isi Pengumuman:</label>
            <textarea name="isi" id="isi" rows="4" required><?= htmlspecialchars(isset($_POST["isi"]) ? $_POST["isi"] : $isi_pengumuman) ?></textarea>
        </div>
        <div class="button-group">
            <input type="submit" value="Simpan">
            <a href="beranda.php" class="button">Batal</a>
        </div>
    </form>
</div>
<?php include __DIR__ . '/../footer.php'; ?>