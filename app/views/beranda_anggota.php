<?php
session_start();
require_once __DIR__ . '/../config/config.php';

// Pastikan pengguna sudah login dan memiliki role anggota
if (!isset($_SESSION["user"]) || !is_array($_SESSION["user"]) || $_SESSION["user"]["role"] !== "anggota") {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION["user"]["id"]; // Ambil ID dari session array

// Ambil evaluasi anggota berdasarkan user_id
$stmt = $mysqli->prepare("SELECT * FROM evaluasi WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$evaluasi_result = $stmt->get_result();
$evaluasi = $evaluasi_result->fetch_assoc();

// Ambil semua id_minat_bakat yang diikuti anggota
$stmt = $mysqli->prepare("SELECT mb.id_minat_bakat, mb.nama_minat_bakat 
    FROM anggota a
    JOIN minat_bakat mb ON a.id_minat_bakat = mb.id_minat_bakat 
    WHERE a.user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$minat_result = $stmt->get_result();
$minat_bakat_list = [];
while ($row = $minat_result->fetch_assoc()) {
    $minat_bakat_list[] = $row;
}

// Ambil daftar partisipasi kegiatan berdasarkan user_id
$stmt = $mysqli->prepare("SELECT * FROM partisipasi WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$kegiatan_result = $stmt->get_result();
// Ambil jadwal latihan berdasarkan bidang minat anggota
// $jadwal_query = $mysqli->query("SELECT * FROM jadwal_latihan WHERE bidang_minat IN (SELECT bidang_minat FROM anggota WHERE user_id = $user_id)");

foreach ($minat_bakat_list as $minat) {
    echo "<h3>Jadwal Rutin untuk " . htmlspecialchars($minat['nama_minat_bakat']) . "</h3>";
    $stmt = $mysqli->prepare("SELECT * FROM jadwal_rutin WHERE id_minat_bakat = ?");
    $stmt->bind_param("i", $minat['id_minat_bakat']);
    $stmt->execute();
    $jadwal_rutin = $stmt->get_result();
    echo "<table border='1'><tr><th>Durasi</th><th>Mentor</th></tr>";
    while ($jadwal = $jadwal_rutin->fetch_assoc()) {
        echo "<tr><td>{$jadwal['durasi_latihan']} menit</td><td>{$jadwal['mentor']}</td></tr>";
    }
    echo "</table>";

    echo "<h4>Jadwal Kondisional untuk " . htmlspecialchars($minat['nama_minat_bakat']) . "</h4>";
    $stmt = $mysqli->prepare("SELECT * FROM jadwal_kondisional WHERE id_minat_bakat = ?");
    $stmt->bind_param("i", $minat['id_minat_bakat']);
    $stmt->execute();
    $jadwal_kondisional = $stmt->get_result();
    echo "<table border='1'><tr><th>Tanggal</th><th>Jam</th><th>Keterangan</th></tr>";
    while ($jadwal = $jadwal_kondisional->fetch_assoc()) {
        echo "<tr><td>{$jadwal['tanggal']}</td><td>{$jadwal['jam']}</td><td>{$jadwal['keterangan']}</td></tr>";
    }
    echo "</table>";
}

foreach ($minat_bakat_list as $minat) {
    echo "<h3>Materi Latihan untuk " . htmlspecialchars($minat['nama_minat_bakat']) . "</h3>";
    $stmt = $mysqli->prepare("SELECT * FROM materi_latihan WHERE id_minat_bakat = ?");
    $stmt->bind_param("i", $minat['id_minat_bakat']);
    $stmt->execute();
    $materi_result = $stmt->get_result();
    echo "<table border='1'><tr><th>Minggu</th><th>Materi</th><th>Link</th></tr>";
    while ($materi = $materi_result->fetch_assoc()) {
        echo "<tr>
            <td>Minggu " . htmlspecialchars($materi["minggu"]) . "</td>
            <td>" . htmlspecialchars($materi["materi"]) . "</td>
            <td>" . (!empty($materi["link_materi"]) ? '<a href="'.htmlspecialchars($materi["link_materi"]).'" target="_blank">Akses Materi</a>' : "<span style='color: red;'>Tidak ada link</span>") . "</td>
        </tr>";
    }
    echo "</table>";
}
?>

<?php include 'header.php'; ?>

<div class="content">
    <h2>Selamat datang, <?= htmlspecialchars($_SESSION["user"]["username"]); ?>!</h2>

    <?php foreach ($minat_bakat_list as $minat): ?>
        <h3>Jadwal Rutin untuk <?= htmlspecialchars($minat['nama_minat_bakat']) ?></h3>
        <table border="1">
            <tr><th>Durasi</th><th>Mentor</th></tr>
            <?php
            $stmt = $mysqli->prepare("SELECT durasi_latihan, mentor FROM jadwal_rutin WHERE id_minat_bakat = ?");
            $stmt->bind_param("i", $minat['id_minat_bakat']);
            $stmt->execute();
            $jadwal_rutin = $stmt->get_result();
            while ($jadwal = $jadwal_rutin->fetch_assoc()) {
                echo "<tr><td>{$jadwal['durasi_latihan']} menit</td><td>{$jadwal['mentor']}</td></tr>";
            }
            ?>
        </table>

        <h4>Jadwal Kondisional untuk <?= htmlspecialchars($minat['nama_minat_bakat']) ?></h4>
        <table border="1">
            <tr><th>Tanggal</th><th>Jam</th><th>Keterangan</th></tr>
            <?php
            $stmt = $mysqli->prepare("SELECT tanggal, jam, keterangan FROM jadwal_kondisional WHERE id_minat_bakat = ?");
            $stmt->bind_param("i", $minat['id_minat_bakat']);
            $stmt->execute();
            $jadwal_kondisional = $stmt->get_result();
            while ($jadwal = $jadwal_kondisional->fetch_assoc()) {
                echo "<tr><td>{$jadwal['tanggal']}</td><td>{$jadwal['jam']}</td><td>{$jadwal['keterangan']}</td></tr>";
            }
            ?>
        </table>

        <h3>Materi Latihan untuk <?= htmlspecialchars($minat['nama_minat_bakat']) ?></h3>
        <table border="1">
            <tr><th>Minggu</th><th>Materi</th><th>Link</th></tr>
            <?php
            $stmt = $mysqli->prepare("SELECT minggu, materi, link_materi FROM materi_latihan WHERE id_minat_bakat = ?");
            $stmt->bind_param("i", $minat['id_minat_bakat']);
            $stmt->execute();
            $materi_result = $stmt->get_result();
            while ($materi = $materi_result->fetch_assoc()) {
                echo "<tr>
                    <td>Minggu " . htmlspecialchars($materi["minggu"]) . "</td>
                    <td>" . htmlspecialchars($materi["materi"]) . "</td>
                    <td>" . (!empty($materi["link_materi"]) ? '<a href="'.htmlspecialchars($materi["link_materi"]).'" target=\"_blank\">Akses Materi</a>' : "<span style='color: red;'>Tidak ada link</span>") . "</td>
                </tr>";
            }
            ?>
        </table>
    <?php endforeach; ?>

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

    <h3>Sub-menu</h3>
    <a href="enroll_minat.php">Enroll Minat Bakat Baru</a> | <a href="absensi.php">Absensi Latihan</a>

    <br><br>
    <a href="../controllers/authController.php?logout=1">Logout</a>
</div>

<?php include 'footer.php'; ?>