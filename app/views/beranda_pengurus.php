<?php

session_start();
require_once __DIR__ . '/../config/config.php';

// Pastikan pengguna sudah login dan memiliki role pengurus
if (!isset($_SESSION["user"]) || !is_array($_SESSION["user"]) || $_SESSION["user"]["role"] !== "pengurus") {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION["user"]["id"]; // Ambil ID dari session array

// Ambil daftar pengurus dari tabel pengurus
$stmt = $mysqli->prepare("SELECT id_pengurus, nama_pengurus, nim, angkatan, jabatan, kontak FROM pengurus");
$stmt->execute();
$pengurus_result = $stmt->get_result();

// Ambil daftar anggota (tanpa join ke minat bakat, karena sudah pakai relasi many-to-many)
$stmt = $mysqli->prepare("SELECT id, nama, nra, user_id, angkatan FROM anggota");
$stmt->execute();
$anggota_result = $stmt->get_result();

// Ambil daftar minat bakat
$stmt = $mysqli->prepare("SELECT id_minat_bakat, nama_minat_bakat, enrollment_key, id_bidang FROM minat_bakat");
$stmt->execute();
$minat_result = $stmt->get_result();

// Ambil evaluasi keaktifan anggota
$stmt = $mysqli->prepare("SELECT user_id, umpan_balik FROM evaluasi WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$evaluasi_result = $stmt->get_result();

// Ambil materi latihan
$stmt = $mysqli->prepare("SELECT id, bidang_minat, minggu, deskripsi, materi, link_materi FROM materi_latihan");
$stmt->execute();
$materi_result = $stmt->get_result();
?>

<?php include 'header.php'; ?>

<div class="content">
    <h2>Selamat datang, <?= htmlspecialchars($_SESSION["user"]["username"]); ?>!</h2>
    <!-- Tombol kembali ke halaman beranda -->
    <a href="beranda.php" class="button" style="margin-bottom:18px;display:inline-block;">&larr; Kembali ke Halaman Beranda</a>
    <h3>Daftar Pengurus</h3>
    <table border="1">
        <tr>
            <th>No</th>
            <th>Nama Pengurus</th>
            <th>NIM</th>
            <th>Angkatan</th>
            <th>Jabatan</th>
            <th>Kontak</th>
            <th>Aksi</th>
        </tr>
        <?php
        $no = 1;
        while ($pengurus = $pengurus_result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$no}</td>";
            echo "<td>" . htmlspecialchars($pengurus["nama_pengurus"]) . "</td>";
            echo "<td>" . htmlspecialchars($pengurus["nim"]) . "</td>";
            echo "<td>" . htmlspecialchars($pengurus["angkatan"]) . "</td>";
            echo "<td>" . htmlspecialchars($pengurus["jabatan"]) . "</td>";
            echo "<td>" . htmlspecialchars($pengurus["kontak"]) . "</td>";
            echo "<td><a href='edit_pengurus.php?id_pengurus=" . urlencode($pengurus["id_pengurus"]) . "'>Edit</a></td>";
            echo "</tr>";
            $no++;
        }
        ?>
    </table>

    <h3>Daftar Minat Bakat</h3>
    <table border="1">
        <tr>
            <th>No</th>
            <th>Nama Minat Bakat</th>
            <th>Enrollment Key</th>
            <th>Bidang</th>
        </tr>
        <?php
        $no = 1;
        // Ambil nama bidang dari tabel bidang jika ada relasi
        while ($minat = $minat_result->fetch_assoc()) {
            $nama_bidang = "-";
            if (isset($minat['id_bidang']) && $minat['id_bidang']) {
                $stmt_bidang = $mysqli->prepare("SELECT nama_bidang FROM bidang WHERE id_bidang = ?");
                $stmt_bidang->bind_param("i", $minat['id_bidang']);
                $stmt_bidang->execute();
                $stmt_bidang->bind_result($nama_bidang_db);
                if ($stmt_bidang->fetch()) {
                    $nama_bidang = $nama_bidang_db;
                }
                $stmt_bidang->close();
            }
            echo "<tr>";
            echo "<td>{$no}</td>";
            echo "<td>" . htmlspecialchars($minat["nama_minat_bakat"]) . "</td>";
            echo "<td>" . htmlspecialchars($minat["enrollment_key"]) . "</td>";
            echo "<td>" . htmlspecialchars($nama_bidang) . "</td>";
            echo "</tr>";
            $no++;
        }
        ?>
    </table>

    <!-- Tabel Request Penyewaan Inventaris -->
    <h3>Daftar Request Penyewaan Inventaris</h3>
    <table border="1">
        <tr>
            <th>No</th>
            <th>Nama Penyewa</th>
            <th>Email</th>
            <th>Nama Kegiatan</th>
            <th>Telepon</th>
            <th>Item</th>
            <th>Tanggal</th>
            <th>Durasi (hari)</th>
            <th>Waktu Submit</th>
        </tr>
        <?php
        $no = 1;
        $result = $mysqli->query("SELECT * FROM penyewaan ORDER BY waktu_submit DESC");
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$no}</td>";
            echo "<td>" . htmlspecialchars($row["nama"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["email"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["nama_kegiatan"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["telepon"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["item"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["tanggal"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["durasi"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["waktu_submit"]) . "</td>";
            echo "</tr>";
            $no++;
        }
        ?>
    </table>

    <!-- Tabel Request Book Talent -->
    <h3>Daftar Request Book Talent</h3>
    <table border="1">
        <tr>
            <th>No</th>
            <th>Nama Client</th>
            <th>Email</th>
            <th>Nama Kegiatan</th>
            <th>Jenis Talent</th>
            <th>Jumlah Talent</th>
            <th>Tanggal Acara</th>
            <th>Lokasi</th>
            <th>Durasi (jam)</th>
            <th>Waktu Submit</th>
        </tr>
        <?php
        $no = 1;
        $result = $mysqli->query("SELECT * FROM book_talent ORDER BY waktu_submit DESC");
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$no}</td>";
            echo "<td>" . htmlspecialchars($row["nama_client"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["email"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["nama_kegiatan"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["jenis_talent"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["jumlah_talent"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["tanggal_acara"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["lokasi"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["durasi"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["waktu_submit"]) . "</td>";
            echo "</tr>";
            $no++;
        }
        
        ?>
        
    </table>
    <h3>Menu Pengurus</h3>
    <ul>
        <li><a href="manajemen_anggota_kinerja.php">Manajemen Anggota</a></li>
        <li><a href="evaluasi_anggota.php">Evaluasi Anggota</a></li>
        <li><a href="manajemen_jadwal.php">Manajemen Jadwal</a></li>
        <li><a href="kontrol_program.php">Kontrol Program Kerja</a></li>
        <li><a href="manajemen_materi.php">Manajemen Materi Latihan</a></li>
        <li><a href="manajemen_talent&inventaris.php">Manajemen Talent dan Inventaris</a></li>  
    </ul>

    <br><br>
    <a href="/SI-BIRAMA/app/controllers/authController.php?logout=true">Logout</a>
</div>

<?php include 'footer.php'; ?>