<?php
session_start();
require_once __DIR__ . '/../config/config.php';

// Pastikan pengguna sudah login dan memiliki role anggota
if (!isset($_SESSION["user"]) || $_SESSION["role"] !== "anggota") {
    header("Location: login.php");
    exit();
}

// Pastikan session ID tersedia sebelum digunakan
if (!isset($_SESSION["id"])) {
    echo "Session ID tidak ditemukan!";
    exit();
}

$user_id = $_SESSION["id"]; // Menggunakan ID dari session

// Ambil evaluasi anggota berdasarkan user_id
$stmt = $mysqli->prepare("SELECT * FROM evaluasi WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$evaluasi_result = $stmt->get_result();
$evaluasi = $evaluasi_result->fetch_assoc();

// Ambil daftar partisipasi kegiatan berdasarkan user_id
$stmt = $mysqli->prepare("SELECT * FROM partisipasi WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$kegiatan_result = $stmt->get_result();
?>

<?php include 'header.php'; ?>

<div class="content">
    <h2>Selamat datang, <?= htmlspecialchars($_SESSION["user"]); ?>!</h2>

    <h3>Evaluasi Keaktifan</h3>
    <table border="1">
        <tr>
            <th>Total Kehadiran</th>
            <th>Performa</th>
            <th>Umpan Balik</th>
        </tr>
        <tr>
            <td><?= $evaluasi["kehadiran"] ?? "Belum Ada Evaluasi"; ?></td>
            <td><?= $evaluasi["performa"] ?? "Belum Ada Evaluasi"; ?></td>
            <td><?= $evaluasi["umpan_balik"] ?? "Belum Ada Evaluasi"; ?></td>
        </tr>
    </table>
    
    <h3>Partisipasi Kegiatan</h3>
    <table border="1">
        <tr><th>Kegiatan</th><th>Status</th></tr>
        <?php while ($kegiatan = $kegiatan_result->fetch_assoc()) { ?>
            <tr>
                <td><?= htmlspecialchars($kegiatan["kegiatan"]); ?></td>
                <td><?= htmlspecialchars($kegiatan["status"]); ?></td>
            </tr>
        <?php } ?>
    </table>

    <h3>Materi Latihan Minggu Sebelumnya</h3>
    <table border="1">
        <tr><th>Bidang Minat</th><th>Minggu</th><th>Materi</th><th>Link</th></tr>
        <?php
        $stmt = $mysqli->prepare("SELECT * FROM materi_latihan WHERE bidang_minat IN (SELECT bidang_minat FROM anggota WHERE user_id = ?)");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $materi_result = $stmt->get_result();
        while ($materi = $materi_result->fetch_assoc()) { ?>
            <tr>
                <td><?= htmlspecialchars($materi["bidang_minat"]); ?></td>
                <td>Minggu <?= htmlspecialchars($materi["minggu"]); ?></td>
                <td><?= htmlspecialchars($materi["materi"]); ?></td>
                <td>
                    <?= !empty($materi["link_materi"]) ? '<a href="'.htmlspecialchars($materi["link_materi"]).'" target="_blank">Akses Materi</a>' : "<span style='color: red;'>Tidak ada link</span>"; ?>
                </td>
            </tr>
        <?php } ?>
    </table>

    <h3>Sub-menu</h3>
    <a href="enroll_minat.php">Enroll Minat Bakat Baru</a> | <a href="absensi.php">Absensi Latihan</a>

    <br><br>
    <a href="../controllers/authController.php?logout=true">Logout</a>
</div>

<?php include 'footer.php'; ?>
