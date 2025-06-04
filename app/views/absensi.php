<?php
session_start();
require_once __DIR__ . '/../config/config.php';

if (!isset($_SESSION["user"]) || $_SESSION["role"] !== "anggota") {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION["user"]["id"];

// Ambil informasi minat bakat anggota
$minat_query = $mysqli->query("SELECT * FROM anggota WHERE user_id = $user_id");

// Ambil informasi tahun kepengurusan aktif (contoh statis, bisa diambil dari database nanti)
$tahun_kepengurusan = "2025";

// Cek apakah pengurus telah membuka sesi absensi
$sesi_absensi_query = $mysqli->query("SELECT * FROM sesi_absensi WHERE status = 'dibuka'");
$sesi_absensi_aktif = $sesi_absensi_query->num_rows > 0;

// Ambil jadwal latihan berdasarkan bidang minat anggota
// $jadwal_query = $mysqli->query("SELECT * FROM jadwal_ruitn WHERE bidang_minat IN (SELECT bidang_minat FROM anggota WHERE user_id = $user_id)");

?>

<?php include 'header.php'; ?>

<div class="content">
    <h2>Absensi Latihan</h2>
    
    <h3>Tahun Kepengurusan: <?= $tahun_kepengurusan; ?></h3>

    <h3>Bidang Minat Bakat yang Diikuti</h3>
    <table border="1">
        <tr>
            <th>Bidang Minat Bakat</th>
            <th>Presensi</th>
        </tr>
        <?php while ($minat = $minat_query->fetch_assoc()) { ?>
            <tr>
                <td><?= $minat["bidang_minat"]; ?></td>
                <td>
                    <?php if ($sesi_absensi_aktif) { ?>
                        <form method="POST">
                            <input type="hidden" name="bidang_minat" value="<?= $minat["bidang_minat"]; ?>">
                            <input type="date" name="tanggal" required>
                            <button type="submit">Absen Hadir</button>
                        </form>
                    <?php } else { ?>
                        <span style="color: red;">Sesi absensi belum dibuka</span>
                    <?php } ?>
                </td>
            </tr>
        <?php } ?>
    </table>

    <br>
    <a href="beranda_anggota.php">Kembali ke Dashboard</a>
</div>

<?php include 'footer.php'; ?>

<?php
// Proses Absensi
if ($_SERVER["REQUEST_METHOD"] == "POST" && $sesi_absensi_aktif) {
    $bidang_minat = $_POST["bidang_minat"];
    $tanggal = $_POST["tanggal"];

    $stmt = $mysqli->prepare("INSERT INTO absensi (user_id, tanggal, status, bidang_minat) VALUES (?, ?, 'Hadir', ?)");
    $stmt->bind_param("iss", $user_id, $tanggal, $bidang_minat);
    $stmt->execute();

    header("Location: absensi.php?success=absen");
    exit();
}
?>
