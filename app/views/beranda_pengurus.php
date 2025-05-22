<?php
session_start();
require_once __DIR__ . '/../config/config.php';

// Pastikan pengguna sudah login dan memiliki role pengurus
if (!isset($_SESSION["user"]) || $_SESSION["role"] !== "pengurus") {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION["id"]; // Menggunakan ID dari session

// Ambil daftar anggota dengan informasi minat bakat
$stmt = $mysqli->prepare("
    SELECT anggota.id, anggota.nama, anggota.nra, anggota.user_id, anggota.id_minat_bakat, 
           minat_bakat.nama_minat_bakat 
    FROM anggota 
    LEFT JOIN minat_bakat ON anggota.id_minat_bakat = minat_bakat.id_minat_bakat");
$stmt->execute();
$anggota_result = $stmt->get_result();

// Ambil daftar minat bakat
$stmt = $mysqli->prepare("SELECT id_minat_bakat, nama_minat_bakat, enrollment_key FROM minat_bakat");
$stmt->execute();
$minat_result = $stmt->get_result();

// Ambil evaluasi keaktifan anggota
$stmt = $mysqli->prepare("SELECT user_id, kehadiran, performa, umpan_balik FROM evaluasi WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$evaluasi_result = $stmt->get_result();

// Ambil materi latihan
$stmt = $mysqli->prepare("SELECT id, bidang_minat, minggu, deskripsi, materi, link_materi FROM materi_latihan");
$stmt->execute();
$materi_result = $stmt->get_result();
?>

<?php include 'header.php'; ?> <!-- Tambahkan Header -->

<div class="content">
    <h2>Selamat datang, <?= htmlspecialchars($_SESSION["user"]); ?>!</h2>

    <h3>Manajemen Anggota</h3>
    <table border="1">
        <tr><th>ID</th><th>Nama</th><th>NRA</th><th>Minat Bakat</th><th>Aksi</th></tr>
        <?php while ($anggota = $anggota_result->fetch_assoc()) { ?>
            <tr>
                <td><?= $anggota["id"]; ?></td>
                <td><?= htmlspecialchars($anggota["nama"]); ?></td>
                <td><?= htmlspecialchars($anggota["nra"]); ?></td>
                <td><?= htmlspecialchars($anggota["nama_minat_bakat"] ?? "Belum Terdaftar"); ?></td>
                <td>
                    <a href="edit_anggota.php?id=<?= $anggota["id"]; ?>">Edit</a> |
                    <a href="hapus_anggota.php?id=<?= $anggota["id"]; ?>">Hapus</a>
                </td>
            </tr>
        <?php } ?>
    </table>

    <h3>Pengelompokan Minat Bakat</h3>
    <table border="1">
        <tr><th>Minat Bakat</th><th>Enrollment Key</th><th>Aksi</th></tr>
        <?php while ($minat = $minat_result->fetch_assoc()) { ?>
            <tr>
                <td><?= htmlspecialchars($minat["nama_minat_bakat"]); ?></td>
                <td><?= htmlspecialchars($minat["enrollment_key"]); ?></td>
                <td><a href="edit_enrollment.php?id=<?= $minat["id_minat_bakat"]; ?>">Edit Key</a></td>
            </tr>
        <?php } ?>
    </table>

    <h3>Evaluasi Keaktifan</h3>
    <table border="1">
        <tr><th>Kehadiran</th><th>Performa</th><th>Umpan Balik</th></tr>
        <?php while ($evaluasi = $evaluasi_result->fetch_assoc()) { ?>
            <tr>
                <td><?= htmlspecialchars($evaluasi["kehadiran"]); ?></td>
                <td><?= htmlspecialchars($evaluasi["performa"]); ?></td>
                <td><?= htmlspecialchars($evaluasi["umpan_balik"]); ?></td>
            </tr>
        <?php } ?>
    </table>

    <h3>Materi Latihan Minggu Sebelumnya</h3>
    <table border="1">
        <tr><th>Bidang Minat</th><th>Minggu</th><th>Deskripsi</th><th>Materi</th><th>Link</th><th>Aksi</th></tr>
        <?php while ($materi = $materi_result->fetch_assoc()) { ?>
            <tr>
                <td><?= htmlspecialchars($materi["bidang_minat"]); ?></td>
                <td>Minggu <?= htmlspecialchars($materi["minggu"]); ?></td>
                <td><?= htmlspecialchars($materi["deskripsi"]); ?></td>
                <td><?= htmlspecialchars($materi["materi"]); ?></td>
                <td>
                    <?= !empty($materi["link_materi"]) ? '<a href="'.htmlspecialchars($materi["link_materi"]).'" target="_blank">Akses Materi</a>' : "<span style='color: red;'>Tidak ada link</span>"; ?>
                </td>
                <td><a href="edit_materi.php?id=<?= $materi["id"]; ?>">Edit</a></td>
            </tr>
        <?php } ?>
    </table>

    <br><br>

    <a href="../controllers/authController.php?logout=true">Logout</a>
</div>

<?php include 'footer.php'; ?> <!-- Tambahkan Footer -->
