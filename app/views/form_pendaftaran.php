<?php
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
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Formulir Pendaftaran - Sanggar Birama</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/SI-BIRAMA/public/css/style.css">
</head>
<body style="background-image: url('/SI-BIRAMA/public/images/background2.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat; background-attachment: fixed; min-height: 100vh;">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="#">Sanggar Birama</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item"><a class="nav-link" href="/SI-BIRAMA/app/views/beranda.php">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="/SI-BIRAMA/app/views/portofolio.php">Portofolio</a></li>
                    <li class="nav-item"><a class="nav-link" href="/SI-BIRAMA/app/views/formSewa.php">Penyewaan Alat & Kostum</a></li>
                    <li class="nav-item"><a class="nav-link" href="/SI-BIRAMA/app/views/bookTalent.php">Penyewaan Talent</a></li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <?php if (isset($_SESSION["user"])): ?>
                            <a class="btn btn-outline-danger" href="/SI-BIRAMA/app/controllers/authController.php?logout=true">Logout</a>
                        <?php else: ?>
                            <a class="btn btn-outline-primary" href="/SI-BIRAMA/app/views/login.php">Login</a>
                        <?php endif; ?>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Header -->
    <div class="header-welcome" style="padding-top:100px; text-align:center; color:#fff; text-shadow:0 2px 8px #000;">
        <h1>Formulir Pendaftaran Anggota</h1>
    </div>

    <div class="container" style="margin-top: 20px; max-width: 650px; background: rgba(255,255,255,0.9); padding: 30px; border-radius: 10px;">
        <?php if ($error): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <form method="post">
            <div class="form-group">
                <label for="nama">Nama Lengkap:</label>
                <input type="text" class="form-control" name="nama" id="nama" required>
            </div>
            <div class="form-group">
                <label for="no_hp">Nomor HP:</label>
                <input type="text" class="form-control" name="no_hp" id="no_hp" required>
            </div>
            <div class="form-group">
                <label for="jurusan">Jurusan/Prodi:</label>
                <input type="text" class="form-control" name="jurusan" id="jurusan" required>
            </div>
            <div class="form-group">
                <label for="nim">NIM:</label>
                <input type="text" class="form-control" name="nim" id="nim" required>
            </div>
            <div class="form-group">
                <label for="minat_bakat">Rencana Minat Bakat:</label>
                <select class="form-control" name="minat_bakat" id="minat_bakat" required>
                    <option value="">-- Pilih Minat Bakat --</option>
                    <option value="Tari Tradisional">Tari Tradisional</option>
                    <option value="Modern Dance">Modern Dance</option>
                    <option value="Musik">Musik</option>
                    <option value="Teater">Teater</option>
                    <option value="Lainnya">Lainnya</option>
                </select>
            </div>
            <div class="text-center mt-4">
                <button type="submit" class="button">Daftar</button>
                <form method="get" action="beranda.php" style="display:inline;">
                    <button type="button" class="button" onclick="window.location.href='beranda.php'">Batal</button>
                </form>
            </div>
        </form>
    </div>

    <?php include 'footer.php'; ?>
</body>
</html>
