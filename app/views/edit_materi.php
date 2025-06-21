<?php
session_start();
require_once __DIR__ . '/../config/config.php';

if (!isset($_SESSION["user"]) || $_SESSION["user"]["role"] !== "pengurus") {
    header("Location: login.php");
    exit();
}

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$id_minat_bakat = isset($_GET['id_minat_bakat']) ? $_GET['id_minat_bakat'] : '';
if ($id <= 0) die("ID tidak valid.");

$error = '';
$stmt = $mysqli->prepare("SELECT bidang_minat, minggu, deskripsi, materi, link_materi FROM materi_latihan WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($bidang_minat, $minggu, $deskripsi, $materi, $link_materi);
$stmt->fetch();
$stmt->close();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $minggu = $_POST["minggu"];
    $deskripsi = $_POST["deskripsi"];
    $materi = $_POST["materi"];
    $link_materi = $_POST["link_materi"];
    $id_minat_bakat = $_POST["id_minat_bakat"];

    $stmt = $mysqli->prepare("UPDATE materi_latihan SET minggu=?, deskripsi=?, materi=?, link_materi=? WHERE id=?");
    $stmt->bind_param("isssi", $minggu, $deskripsi, $materi, $link_materi, $id);
    if ($stmt->execute()) {
        header("Location: manajemen_materi.php?id_minat_bakat=" . urlencode($id_minat_bakat) . "&bidang_minat=" . urlencode($bidang_minat));
        exit();
    } else {
        $error = "Gagal mengubah materi.";
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Materi Latihan</title>
    <link rel="stylesheet" href="/SI-BIRAMA/public/css/style.css">
</head>
<body>
<div class="layout-wrapper">
    <?php include 'sidebar_pengurus.html'; ?>
    <div class="main-content">
        <div class="content">
            <h2>Edit Materi Latihan</h2>
            <?php if ($error): ?><div style="color:red"><?= htmlspecialchars($error) ?></div><?php endif; ?>
            <form method="post" class="form-warna">
                <input type="hidden" name="id_minat_bakat" value="<?= htmlspecialchars($id_minat_bakat) ?>">
                <input type="hidden" name="bidang_minat" value="<?= htmlspecialchars($bidang_minat) ?>">
                Bidang Minat: <input type="text" name="bidang_minat_display" value="<?= htmlspecialchars($bidang_minat) ?>" readonly><br>
                Minggu: <input type="number" name="minggu" value="<?= htmlspecialchars($minggu) ?>" required><br>
                Deskripsi: <input type="text" name="deskripsi" value="<?= htmlspecialchars($deskripsi) ?>"><br>
                Materi: <input type="text" name="materi" value="<?= htmlspecialchars($materi) ?>" required><br>
                Link Materi: <input type="text" name="link_materi" value="<?= htmlspecialchars($link_materi) ?>"><br>
                <button type="submit" class="button">Simpan</button>
                <button type="button" class="button" onclick="window.location.href='manajemen_materi.php?id_minat_bakat=<?= urlencode($id_minat_bakat) ?>&bidang_minat=<?= urlencode($bidang_minat) ?>'">Kembali</button>
            </form>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>
</body>
</html>