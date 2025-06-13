<?php
// filepath: d:\dari c\2Xampp\instal\htdocs\SI-BIRAMA\app\views\form_pendaftaran.php
session_start();
require_once __DIR__ . '/../config/config.php';

$error = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nama = trim($_POST["nama"]);
    $no_hp = trim($_POST["no_hp"]);
    $jurusan = trim($_POST["jurusan"]);
    $nim = trim($_POST["nim"]);
    $minat_bakat = trim($_POST["minat_bakat"]);

    if ($nama === "" || $no_hp === "" || $jurusan === "" || $nim === "" || $minat_bakat === "") {
        $error = "Semua field wajib diisi.";
    } else {
        $stmt = $mysqli->prepare("INSERT INTO pendaftaran (nama, no_hp, jurusan, nim, minat_bakat) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $nama, $no_hp, $jurusan, $nim, $minat_bakat);
        if ($stmt->execute()) {
            echo "<script>alert('Pendaftaran berhasil!');window.location='beranda.php';</script>";
            exit;
        } else {
            $error = "Gagal menyimpan data.";
        }
        $stmt->close();
    }
}
?>

<?php include 'header.php'; ?>
<div class="content">
    <h2>Formulir Pendaftaran Anggota</h2>
    <?php if ($error): ?>
        <div style="color:red;"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <form method="post">
        <div class="form-row">
            <label for="nama">Nama Lengkap:</label>
            <input type="text" name="nama" id="nama" required>
        </div>
        <div class="form-row">
            <label for="no_hp">Nomor HP:</label>
            <input type="text" name="no_hp" id="no_hp" required>
        </div>
        <div class="form-row">
            <label for="jurusan">Jurusan/Prodi:</label>
            <input type="text" name="jurusan" id="jurusan" required>
        </div>
        <div class="form-row">
            <label for="nim">NIM:</label>
            <input type="text" name="nim" id="nim" required>
        </div>
        <div class="form-row">
            <label for="minat_bakat">Rencana Minat Bakat:</label>
                    <div class="form-row">
            <select name="minat_bakat" id="minat_bakat" required>
                <option value="">-- Pilih Minat Bakat --</option>
                <option value="Tari Tradisional">Tari Tradisional</option>
                <option value="Modern Dance">Modern Dance</option>
                <option value="Musik">Musik</option>
                <option value="Teater">Teater</option>
                <option value="Lainnya">Lainnya</option>
            </select>
        </div>
        </div>
        <div class="button-group">
            <input type="submit" value="Daftar">
            <a href="beranda.php" class="button">Batal</a>
        </div>
    </form>
</div>
<?php include 'footer.php'; ?>