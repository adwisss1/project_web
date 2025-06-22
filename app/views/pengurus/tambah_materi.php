<?php
session_start();
require_once __DIR__ . '/../../config/config.php';

if (!isset($_SESSION["user"]) || $_SESSION["user"]["role"] !== "pengurus") {
    header("Location: login.php");
    exit();
}

$bidang_minat = isset($_GET['bidang_minat']) ? $_GET['bidang_minat'] : '';
$id_minat_bakat = isset($_GET['id_minat_bakat']) ? $_GET['id_minat_bakat'] : '';
$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bidang_minat = $_POST["bidang_minat"];
    $minggu = $_POST["minggu"];
    $deskripsi = $_POST["deskripsi"];
    $materi = $_POST["materi"];
    $link_materi = $_POST["link_materi"];
    $id_minat_bakat = $_POST["id_minat_bakat"];

    $stmt = $mysqli->prepare("INSERT INTO materi_latihan (bidang_minat, minggu, deskripsi, materi, link_materi) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sisss", $bidang_minat, $minggu, $deskripsi, $materi, $link_materi);
    if ($stmt->execute()) {
        // Redirect setelah berhasil tambah, filter tetap aktif
        header("Location: manajemen_materi.php?id_minat_bakat=" . urlencode($id_minat_bakat) . "&bidang_minat=" . urlencode($bidang_minat));
        exit();
    } else {
        $error = "Gagal menambah materi.";
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Materi Latihan</title>
    <link rel="stylesheet" href="/SI-BIRAMA/public/css/style.css">
</head>
<body>
<div class="layout-wrapper">
    <?php include 'sidebar_pengurus.html'; ?>
    <div class="main-content">
        <div class="content">
            <h2>Tambah Materi Latihan</h2>
            <?php if ($error): ?><div style="color:red"><?= htmlspecialchars($error) ?></div><?php endif; ?>
            <form method="post" class="form-warna">
                <input type="hidden" name="id_minat_bakat" value="<?= htmlspecialchars($id_minat_bakat) ?>">
                <input type="hidden" name="bidang_minat" value="<?= htmlspecialchars($bidang_minat) ?>">
                Bidang Minat: <input type="text" name="bidang_minat_display" value="<?= htmlspecialchars($bidang_minat) ?>" readonly><br>
                Minggu: <input type="number" name="minggu" required><br>
                Deskripsi: <input type="text" name="deskripsi"><br>
                Materi: <input type="text" name="materi" required><br>
                Link Materi: <input type="text" name="link_materi"><br>
                <button type="submit" class="button">Tambah</button>
                <button type="button" class="button" onclick="window.location.href='manajemen_materi.php?id_minat_bakat=<?= urlencode($id_minat_bakat) ?>&bidang_minat=<?= urlencode($bidang_minat) ?>'">Kembali</button>
            </form>
        </div>
    </div>
</div>
<?php include __DIR__ . '/../footer.php'; ?>
</body>
</html>