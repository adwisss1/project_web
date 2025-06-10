<?php
// filepath: d:\dari c\2Xampp\instal\htdocs\SI-BIRAMA\app\views\edit_pengurus.php
require_once __DIR__ . '/../config/config.php';
include __DIR__ . '/header.php';

$id_pengurus = isset($_GET['id_pengurus']) ? intval($_GET['id_pengurus']) : 0;
if ($id_pengurus <= 0) {
    die("ID pengurus tidak valid.");
}

// Ambil data pengurus
$stmt = $mysqli->prepare("SELECT nama_pengurus, nim, angkatan, jabatan, kontak FROM pengurus WHERE id_pengurus = ?");
$stmt->bind_param("i", $id_pengurus);
$stmt->execute();
$stmt->bind_result($nama_pengurus, $nim, $angkatan, $jabatan, $kontak);
$stmt->fetch();
$stmt->close();

if (!$nama_pengurus) {
    echo "Data pengurus tidak ditemukan.";
    include __DIR__ . '/footer.php';
    exit();
}
?>

<h2>Edit Data Pengurus</h2>
<form method="POST" action="/SI-BIRAMA/app/controllers/update_pengurus.php">
    <input type="hidden" name="id_pengurus" value="<?= $id_pengurus ?>">
    Nama Pengurus: <input type="text" name="nama_pengurus" value="<?= htmlspecialchars($nama_pengurus) ?>" required><br>
    NIM: <input type="text" name="nim" value="<?= htmlspecialchars($nim) ?>" required><br>
    Angkatan: <input type="number" name="angkatan" value="<?= htmlspecialchars($angkatan) ?>" required><br>
    Jabatan: <input type="text" name="jabatan" value="<?= htmlspecialchars($jabatan) ?>" required><br>
    Kontak: <input type="text" name="kontak" value="<?= htmlspecialchars($kontak) ?>" required><br>
    <button type="submit">Simpan Perubahan</button>
</form>
<a href="manajemen_pengurus.php">Kembali</a>

<?php include __DIR__ . '/footer.php'; ?>