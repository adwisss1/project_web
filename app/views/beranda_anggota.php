<?php

session_start();
require_once __DIR__ . '/../config/config.php';

// Pastikan pengguna sudah login dan memiliki role anggota
if (!isset($_SESSION["user"]) || !is_array($_SESSION["user"]) || $_SESSION["user"]["role"] !== "anggota") {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION["user"]["id"];

// Ambil evaluasi anggota berdasarkan user_id
$stmt = $mysqli->prepare("SELECT * FROM evaluasi WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$evaluasi_result = $stmt->get_result();
$evaluasi = $evaluasi_result->fetch_assoc();

// Ambil semua id_minat_bakat yang diikuti anggota
// Asumsi: ada tabel relasi anggota_minat_bakat (id_anggota, id_minat_bakat)
// dan tabel anggota memiliki kolom id dan user_id
$stmt = $mysqli->prepare("
    SELECT mb.id_minat_bakat, mb.nama_minat_bakat 
    FROM anggota_minat_bakat amb
    JOIN anggota a ON amb.id_anggota = a.id
    JOIN minat_bakat mb ON amb.id_minat_bakat = mb.id_minat_bakat
    WHERE a.user_id = ?
");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$minat_result = $stmt->get_result();
$minat_bakat_list = [];
while ($row = $minat_result->fetch_assoc()) {
    $minat_bakat_list[] = $row;
}
?>

<?php include 'header.php'; ?>

<div class="content">
    <h2>Selamat datang, <?= htmlspecialchars($_SESSION["user"]["username"]); ?>!</h2>

    <h3>Jadwal Latihan Minat Bakat yang Diikuti</h3>
    <?php if (empty($minat_bakat_list)): ?>
        <p>Anda belum mengikuti minat bakat apapun.</p>
    <?php else: ?>
        <table border="1">
            <tr>
                <th>Minat Bakat</th>
                <th>Jenis Jadwal</th>
                <th>Hari/Tanggal</th>
                <th>Jam</th>
                <th>Durasi</th>
                <th>Mentor/Keterangan</th>
            </tr>
            <?php foreach ($minat_bakat_list as $minat): ?>
                <?php
                // Jadwal Rutin
                $stmt = $mysqli->prepare("SELECT hari, jam, durasi_latihan, mentor FROM jadwal_rutin WHERE id_minat_bakat = ?");
                $stmt->bind_param("i", $minat['id_minat_bakat']);
                $stmt->execute();
                $jadwal_rutin = $stmt->get_result();
                while ($jadwal = $jadwal_rutin->fetch_assoc()) {
                    echo "<tr>
                        <td>" . htmlspecialchars($minat['nama_minat_bakat']) . "</td>
                        <td>Rutin</td>
                        <td>" . htmlspecialchars($jadwal['hari']) . "</td>
                        <td>" . htmlspecialchars($jadwal['jam']) . "</td>
                        <td>" . htmlspecialchars($jadwal['durasi_latihan']) . " menit</td>
                        <td>" . htmlspecialchars($jadwal['mentor']) . "</td>
                    </tr>";
                }
                // Jadwal Kondisional
                $stmt = $mysqli->prepare("SELECT tanggal, jam, keterangan FROM jadwal_kondisional WHERE id_minat_bakat = ?");
                $stmt->bind_param("i", $minat['id_minat_bakat']);
                $stmt->execute();
                $jadwal_kondisional = $stmt->get_result();
                while ($jadwal = $jadwal_kondisional->fetch_assoc()) {
                    echo "<tr>
                        <td>" . htmlspecialchars($minat['nama_minat_bakat']) . "</td>
                        <td>Kondisional</td>
                        <td>" . htmlspecialchars($jadwal['tanggal']) . "</td>
                        <td>" . htmlspecialchars($jadwal['jam']) . "</td>
                        <td>-</td>
                        <td>" . htmlspecialchars($jadwal['keterangan']) . "</td>
                    </tr>";
                }
                ?>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>

    <h3>Materi Latihan</h3>
    <?php if (empty($minat_bakat_list)): ?>
        <p>Tidak ada materi karena Anda belum mengikuti minat bakat apapun.</p>
    <?php else: ?>
        <table border="1">
            <tr>
                <th>Minat Bakat</th>
                <th>Materi</th>
                <th>Link</th>
            </tr>
            <?php foreach ($minat_bakat_list as $minat): ?>
                <?php
                $stmt = $mysqli->prepare("SELECT materi, link_materi FROM materi_latihan WHERE bidang_minat = ?");
                $stmt->bind_param("s", $minat['nama_minat_bakat']);
                $stmt->execute();
                $materi_result = $stmt->get_result();
                $ada_materi = false;
                while ($materi = $materi_result->fetch_assoc()) {
                    $ada_materi = true;
                    echo "<tr>
                        <td>" . htmlspecialchars($minat['nama_minat_bakat']) . "</td>
                        <td>" . htmlspecialchars($materi["materi"]) . "</td>
                        <td>" . (!empty($materi["link_materi"]) ? '<a href="'.htmlspecialchars($materi["link_materi"]).'" target=\"_blank\">Akses Materi</a>' : "<span style='color: red;'>Tidak ada link</span>") . "</td>
                    </tr>";
                }
                if (!$ada_materi) {
                    echo "<tr>
                        <td>" . htmlspecialchars($minat['nama_minat_bakat']) . "</td>
                        <td colspan='2'>Belum ada materi untuk minat bakat ini.</td>
                    </tr>";
                }
                ?>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>

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