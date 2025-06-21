<?php
session_start();
require_once __DIR__ . '/../config/config.php';
if (!isset($_SESSION["user"]) || $_SESSION["user"]["role"] !== "pengurus") {
    header("Location: ../login.php");
    exit();
}

$id_jadwal = isset($_GET['id_jadwal']) ? intval($_GET['id_jadwal']) : 0;
$tipe = $_GET['tipe'] ?? 'rutin';
$error = '';
$sesi_id = null;
$tanggal_sesi = null;

// Ambil id_minat_bakat dari jadwal
if ($tipe === 'rutin') {
    $stmt = $mysqli->prepare("SELECT id_minat_bakat FROM jadwal_rutin WHERE id=?");
} else {
    $stmt = $mysqli->prepare("SELECT id_minat_bakat FROM jadwal_kondisional WHERE id=?");
}
$stmt->bind_param("i", $id_jadwal);
$stmt->execute();
$stmt->bind_result($id_minat_bakat);
$stmt->fetch();
$stmt->close();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tanggal = $_POST["tanggal"];
    $nama_sesi = "Absensi " . ucfirst($tipe);

    $mysqli->query("UPDATE sesi_absensi SET status='ditutup' WHERE id_jadwal=$id_jadwal AND status='dibuka'");

    $stmt = $mysqli->prepare("INSERT INTO sesi_absensi (id_jadwal, nama_sesi, tanggal, status) VALUES (?, ?, ?, 'dibuka')");
    $stmt->bind_param("iss", $id_jadwal, $nama_sesi, $tanggal);
    if ($stmt->execute()) {
        $sesi_id = $stmt->insert_id;
        $tanggal_sesi = $tanggal;
        $stmt->close();
        header("Location: buka_sesi_absensi.php?id_jadwal=$id_jadwal&tipe=$tipe");
        exit();
    } else {
        $error = "Gagal membuka sesi absensi.";
        $stmt->close();
    }
} else {
    $stmt = $mysqli->prepare("SELECT id, tanggal FROM sesi_absensi WHERE id_jadwal=? AND status='dibuka' ORDER BY id DESC LIMIT 1");
    $stmt->bind_param("i", $id_jadwal);
    $stmt->execute();
    $stmt->bind_result($sesi_id, $tanggal_sesi);
    $stmt->fetch();
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Buka Sesi Absensi</title>
    <link rel="stylesheet" href="/SI-BIRAMA/public/css/style.css">
</head>
<body>
<div class="layout-wrapper">
    <?php include 'sidebar_pengurus.html'; ?>
    <div class="main-content">
        <div class="content">
            <h2 style="color:#8B0000; margin-bottom:18px;">Buka Sesi Absensi</h2>
            <?php if ($error): ?>
                <div style="color:red; margin-bottom:10px;"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>
            <form method="post" class="form-warna">
                <div style="margin-bottom:12px;">
                    <label for="tanggal" style="font-weight:bold;">Tanggal Latihan:</label><br>
                    <input type="date" id="tanggal" name="tanggal" required value="<?= htmlspecialchars($tanggal_sesi ?? '') ?>" style="width: 100%; max-width: 250px; padding: 6px;">
                </div>
                <div style="margin-bottom:10px;">
                    <button type="submit" class="button">Buka Sesi</button>
                    <?php if ($sesi_id): ?>
                        <a href="tutup_sesi_absensi.php?id_sesi=<?= $sesi_id ?>&tipe=<?= $tipe ?>"
                           onclick="return confirm('Tutup sesi absensi tanggal <?= htmlspecialchars($tanggal_sesi) ?>?')"
                           class="button" style="background:#c00; margin-left:10px;">Tutup Sesi Absensi</a>
                    <?php endif; ?>
                </div>
            </form>
            <button type="button" class="button" onclick="window.location.href='manajemen_jadwal.php'">Kembali</button>

            <?php
            $bulan = isset($_GET['bulan']) ? intval($_GET['bulan']) : date('n');
            $tahun = isset($_GET['tahun']) ? intval($_GET['tahun']) : date('Y');

            $tanggal_sesi = [];
            $result = $mysqli->query("SELECT id, tanggal FROM sesi_absensi 
                WHERE id_jadwal = $id_jadwal 
                AND MONTH(tanggal) = $bulan AND YEAR(tanggal) = $tahun
                ORDER BY tanggal ASC");
            while ($row = $result->fetch_assoc()) {
                $tanggal_sesi[$row['id']] = $row['tanggal'];
            }

            $anggota = [];
            $result = $mysqli->query("SELECT a.id, a.nama FROM anggota a
                INNER JOIN anggota_minat_bakat amb ON a.id = amb.id_anggota
                WHERE amb.id_minat_bakat = $id_minat_bakat");
            while ($row = $result->fetch_assoc()) {
                $anggota[$row['id']] = $row['nama'];
            }

            $absensi = [];
            if (!empty($tanggal_sesi)) {
                $sesi_ids = implode(',', array_keys($tanggal_sesi));
                $result = $mysqli->query("SELECT ab.user_id, ab.id_sesi_absensi, ab.status_kehadiran, a.id as id_anggota
                    FROM absensi ab
                    JOIN anggota a ON ab.user_id = a.user_id
                    WHERE ab.id_sesi_absensi IN ($sesi_ids)");
                while ($row = $result->fetch_assoc()) {
                    $absensi[$row['id_anggota']][$row['id_sesi_absensi']] = $row['status_kehadiran'];
                }
            }
            ?>

            <hr>
            <h3 style="color:#8B0000;">Rekap Absensi Anggota</h3>
            <form method="get" class="form-warna">
                <input type="hidden" name="id_jadwal" value="<?= htmlspecialchars($id_jadwal) ?>">
                <input type="hidden" name="tipe" value="<?= htmlspecialchars($tipe) ?>">
                <label for="bulan">Bulan:</label>
                <select name="bulan" id="bulan">
                    <?php for ($b = 1; $b <= 12; $b++): ?>
                        <option value="<?= $b ?>" <?= $b == $bulan ? 'selected' : '' ?>><?= date('F', mktime(0,0,0,$b,1)) ?></option>
                    <?php endfor; ?>
                </select>
                <label for="tahun">Tahun:</label>
                <select name="tahun" id="tahun">
                    <?php for ($t = date('Y')-2; $t <= date('Y')+1; $t++): ?>
                        <option value="<?= $t ?>" <?= $t == $tahun ? 'selected' : '' ?>><?= $t ?></option>
                    <?php endfor; ?>
                </select>
                <button type="submit" class="button">Filter</button>
            </form>

            <div style="margin-bottom:10px;">
                <strong>Total anggota:</strong> <?= count($anggota) ?>
            </div>

            <div class="table-responsive-absensi">
                <table class="rekap-absensi-table">
                    <tr>
                        <th>No</th>
                        <th>Nama Anggota</th>
                        <?php foreach ($tanggal_sesi as $tgl): ?>
                            <th><?= date('d/m/Y', strtotime($tgl)) ?></th>
                        <?php endforeach; ?>
                    </tr>
                    <?php
                    $no = 1;
                    foreach ($anggota as $id_anggota => $nama) {
                        echo "<tr>
                            <td>$no</td>
                            <td>" . htmlspecialchars($nama) . "</td>";
                        foreach ($tanggal_sesi as $id_sesi => $tgl) {
                            $status = isset($absensi[$id_anggota][$id_sesi]) ? $absensi[$id_anggota][$id_sesi] : "<span style='color:red'>Alfa</span>";
                            echo "<td>$status</td>";
                        }
                        echo "</tr>";
                        $no++;
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>
</body>
</html>