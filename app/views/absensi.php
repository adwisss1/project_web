<?php
session_start();
require_once __DIR__ . '/../config/config.php';

if (!isset($_SESSION["user"]) || $_SESSION["user"]["role"] !== "anggota") {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION["user"]["id"];

// Ambil informasi minat bakat anggota (JOIN ke tabel minat_bakat) -- PERBAIKAN QUERY
$minat_query = $mysqli->query("
    SELECT mb.id_minat_bakat, mb.nama_minat_bakat 
    FROM anggota_minat_bakat amb
    JOIN anggota a ON amb.id_anggota = a.id
    JOIN minat_bakat mb ON amb.id_minat_bakat = mb.id_minat_bakat
    WHERE a.user_id = $user_id
");

// Ambil informasi tahun kepengurusan aktif (contoh statis, bisa diambil dari database nanti)
$tahun_kepengurusan = "2025";

// Cek apakah pengurus telah membuka sesi absensi
$sesi_absensi_query = $mysqli->query("SELECT * FROM sesi_absensi WHERE status = 'dibuka'");
$sesi_absensi_aktif = $sesi_absensi_query->num_rows > 0;
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
                <td><?= htmlspecialchars($minat["nama_minat_bakat"]); ?></td>
                <td>
                    <?php if ($sesi_absensi_aktif) { ?>
                        <form method="POST">
                            <input type="hidden" name="id_minat_bakat" value="<?= $minat["id_minat_bakat"]; ?>">
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
    $id_minat_bakat = $_POST["id_minat_bakat"];
    $tanggal = $_POST["tanggal"];

    $stmt = $mysqli->prepare("INSERT INTO absensi (user_id, tanggal, status, id_minat_bakat) VALUES (?, ?, 'Hadir', ?)");
    $stmt->bind_param("isi", $user_id, $tanggal, $id_minat_bakat);
    $stmt->execute();

    header("Location: absensi.php?success=absen");
    exit();
}
?>