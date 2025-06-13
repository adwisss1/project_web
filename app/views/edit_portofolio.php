<?php
// filepath: d:\dari c\2Xampp\instal\htdocs\SI-BIRAMA\app\views\edit_portofolio.php
session_start();
require_once __DIR__ . '/../config/config.php';

if (!isset($_SESSION["user"]["role"]) || $_SESSION["user"]["role"] !== "pengurus") {
    header("Location: beranda.php");
    exit();
}

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$error = "";

$stmt = $mysqli->prepare("SELECT judul, deskripsi, link FROM portofolio WHERE id_portofolio=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($judul, $deskripsi, $link);
if (!$stmt->fetch()) {
    $stmt->close();
    header("Location: portofolio.php");
    exit();
}
$stmt->close();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $judul = trim($_POST["judul"]);
    $deskripsi = trim($_POST["deskripsi"]);
    $link = trim($_POST["link"]);
    if ($judul === "" || $link === "") {
        $error = "Judul dan link tidak boleh kosong.";
    } else {
        $stmt = $mysqli->prepare("UPDATE portofolio SET judul=?, deskripsi=?, link=? WHERE id_portofolio=?");
        $stmt->bind_param("sssi", $judul, $deskripsi, $link, $id);
        if ($stmt->execute()) {
            header("Location: portofolio.php");
            exit();
        } else {
            $error = "Gagal mengedit portofolio.";
        }
        $stmt->close();
    }
}
?>

<?php include 'header.php'; ?>
<div class="content">
    <h2>Edit Portofolio</h2>
    <?php if ($error): ?>
        <div style="color:red;"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <form method="post">
        <div class="form-row">
            <label for="judul">Judul:</label>
            <input type="text" name="judul" id="judul" value="<?= htmlspecialchars($judul) ?>" required>
        </div>
        <div class="form-row">
            <label for="deskripsi">Deskripsi:</label>
            <textarea name="deskripsi" id="deskripsi" rows="3"><?= htmlspecialchars($deskripsi) ?></textarea>
        </div>
        <div class="form-row">
            <label for="link">Link Video (embed):</label>
            <input type="text" name="link" id="link" value="<?= htmlspecialchars($link) ?>" required>
        </div>
        <div class="button-group">
            <input type="submit" value="Simpan">
            <a href="portofolio.php" class="button">Batal</a>
        </div>
    </form>
</div>
<?php include 'footer.php'; ?>