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

    // Tutup sesi absensi lain yang masih aktif untuk jadwal ini
    $mysqli->query("UPDATE sesi_absensi SET status='ditutup' WHERE id_jadwal=$id_jadwal AND status='dibuka'");

    $stmt = $mysqli->prepare("INSERT INTO sesi_absensi (id_jadwal, nama_sesi, tanggal, status) VALUES (?, ?, ?, 'dibuka')");
    $stmt->bind_param("iss", $id_jadwal, $nama_sesi, $tanggal);
    if ($stmt->execute()) {
        $sesi_id = $stmt->insert_id;
        $tanggal_sesi = $tanggal;
        $stmt->close();
        // Redirect agar tidak double submit saat refresh
        header("Location: buka_sesi_absensi.php?id_jadwal=$id_jadwal&tipe=$tipe");
        exit();
    } else {
        $error = "Gagal membuka sesi absensi.";
        $stmt->close();
    }
} else {
    // Cari sesi absensi aktif untuk jadwal ini
    $stmt = $mysqli->prepare("SELECT id, tanggal FROM sesi_absensi WHERE id_jadwal=? AND status='dibuka' ORDER BY id DESC LIMIT 1");
    $stmt->bind_param("i", $id_jadwal);
    $stmt->execute();
    $stmt->bind_result($sesi_id, $tanggal_sesi);
    $stmt->fetch();
    $stmt->close();
}

include 'header.php'; ?>
<div class="content">
    <h2>Buka Sesi Absensi</h2>
    <?php if ($error): ?><div style="color:red"><?= htmlspecialchars($error) ?></div><?php endif; ?>
    <form method="post" style="margin-bottom:20px; background: #fff; padding: 18px 20px; border-radius: 8px; box-shadow: 0 2px 8px #0001; max-width: 400px;">
        <div style="margin-bottom:12px;">
            <label for="tanggal" style="font-weight:bold;">Tanggal Latihan:</label><br>
            <input type="date" id="tanggal" name="tanggal" required value="<?= htmlspecialchars($tanggal_sesi ?? '') ?>" style="width: 100%; max-width: 250px; padding: 6px;">
        </div>
        <div style="margin-bottom:10px;">
            <button type="submit" style="padding:7px 18px; border-radius:4px; background:#800; color:#fff; border:none;">Buka Sesi</button>
            <?php if ($sesi_id): ?>
                <a href="tutup_sesi_absensi.php?id_sesi=<?= $sesi_id ?>&tipe=<?= $tipe ?>"
                   onclick="return confirm('Tutup sesi absensi tanggal <?= htmlspecialchars($tanggal_sesi) ?>?')"
                   style="margin-left:10px;color:#fff;background:#c00;padding:7px 18px;border-radius:4px;text-decoration:none;display:inline-block;">Tutup Sesi Absensi</a>
            <?php endif; ?>
        </div>
    </form>
    <a href="manajemen_jadwal.php" style="display:inline-block;margin-bottom:20px;padding:10px 0;width:100%;background:#800;color:#fff;text-align:center;border-radius:6px;text-decoration:none;font-weight:bold;">Kembali</a>

<?php
// ========== REKAP ABSENSI ANGGOTA DENGAN FILTER BULAN ==========
    // Filter bulan & tahun
    $bulan = isset($_GET['bulan']) ? intval($_GET['bulan']) : date('n');
    $tahun = isset($_GET['tahun']) ? intval($_GET['tahun']) : date('Y');

    // Ambil SEMUA sesi absensi pada bulan & tahun yang dipilih (bukan LIMIT 1)
    $tanggal_sesi = [];
    $result = $mysqli->query("SELECT id, tanggal FROM sesi_absensi 
        WHERE id_jadwal = $id_jadwal 
        AND MONTH(tanggal) = $bulan AND YEAR(tanggal) = $tahun
        ORDER BY tanggal ASC");
    while ($row = $result->fetch_assoc()) {
        $tanggal_sesi[$row['id']] = $row['tanggal'];
    }

    // Ambil semua anggota yang ikut minat bakat ini
    $anggota = [];
    $result = $mysqli->query("SELECT a.id, a.nama FROM anggota a
        INNER JOIN anggota_minat_bakat amb ON a.id = amb.id_anggota
        WHERE amb.id_minat_bakat = $id_minat_bakat");
    while ($row = $result->fetch_assoc()) {
        $anggota[$row['id']] = $row['nama'];
    }

    // Ambil absensi anggota untuk semua sesi di bulan & tahun tsb
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
    <h3>Rekap Absensi Anggota</h3>
    <form method="get" style="margin-bottom:15px;">
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
        <button type="submit">Filter</button>
    </form>
    <div style="margin-bottom:10px;">
        <strong>Total anggota:</strong> <?= count($anggota) ?>
    </div>
    <table border="1" style="border-collapse:collapse;width:100%;max-width:100%;">
        <tr style="background:#eee;">
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
                <td style='text-align:center;'>$no</td>
                <td>" . htmlspecialchars($nama) . "</td>";
            foreach ($tanggal_sesi as $id_sesi => $tgl) {
                $status = isset($absensi[$id_anggota][$id_sesi]) ? $absensi[$id_anggota][$id_sesi] : '<span style=\"color:red\">Alfa</span>';
                echo "<td style='text-align:center;'>$status</td>";
            }
            echo "</tr>";
            $no++;
        }
        ?>
    </table>
</div>
<?php include 'footer.php'; ?>