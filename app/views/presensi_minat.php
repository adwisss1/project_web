<?php

session_start();
require_once __DIR__ . '/../config/config.php';

if (!isset($_SESSION["user"]) || $_SESSION["user"]["role"] !== "anggota") {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION["user"]["id"];
$id_minat_bakat = isset($_GET['id_minat_bakat']) ? intval($_GET['id_minat_bakat']) : 0;
$id_sesi_absensi = isset($_GET['id_sesi_absensi']) ? intval($_GET['id_sesi_absensi']) : 0;

// Ambil nama minat bakat
$stmt = $mysqli->prepare("SELECT nama_minat_bakat FROM minat_bakat WHERE id_minat_bakat=?");
$stmt->bind_param("i", $id_minat_bakat);
$stmt->execute();
$stmt->bind_result($nama_minat_bakat);
$stmt->fetch();
$stmt->close();

// Cek status sesi absensi dan tanggal sesi
$tanggal_sesi = null;
$status_sesi = null;
if ($id_sesi_absensi) {
    $stmt = $mysqli->prepare("SELECT tanggal, status FROM sesi_absensi WHERE id=?");
    $stmt->bind_param("i", $id_sesi_absensi);
    $stmt->execute();
    $stmt->bind_result($tanggal_sesi, $status_sesi);
    $stmt->fetch();
    $stmt->close();
}

// Cek apakah sudah absen
$already_absen = false;
$status_kehadiran = '';
if ($id_sesi_absensi) {
    $stmt = $mysqli->prepare("SELECT status_kehadiran FROM absensi WHERE user_id=? AND id_sesi_absensi=?");
    $stmt->bind_param("ii", $user_id, $id_sesi_absensi);
    $stmt->execute();
    $stmt->bind_result($status_kehadiran);
    if ($stmt->fetch()) {
        $already_absen = true;
    }
    $stmt->close();
}

// Proses submit presensi
if (
    $_SERVER["REQUEST_METHOD"] == "POST"
    && $id_sesi_absensi
    && $tanggal_sesi
    && $status_sesi === 'dibuka'
    && !$already_absen
) {
    $status_kehadiran = $_POST["status_kehadiran"];
    $stmt = $mysqli->prepare("INSERT INTO absensi (user_id, tanggal, status_kehadiran, id_sesi_absensi) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("issi", $user_id, $tanggal_sesi, $status_kehadiran, $id_sesi_absensi);
    $stmt->execute();
    $stmt->close();
    header("Location: presensi_minat.php?id_minat_bakat=$id_minat_bakat&id_sesi_absensi=$id_sesi_absensi&success=1");
    exit();
}
?>

<?php include 'header.php'; ?>
<div class="content">
    <h2>Presensi Minat Bakat</h2>
    <div><strong>Minat Bakat:</strong> <?= htmlspecialchars($nama_minat_bakat) ?></div>
    <div><strong>Tanggal Sesi:</strong> <?= $tanggal_sesi ? htmlspecialchars($tanggal_sesi) : '<span style="color:gray;">Belum ada sesi dibuka</span>' ?></div>
    <br>
    <a href="absensi.php" style="display:inline-block;margin-bottom:18px;padding:7px 18px;background:#888;color:#fff;border-radius:4px;text-decoration:none;">&larr; Kembali ke Halaman Absensi</a>
    <?php if (isset($_GET['success'])): ?>
        <div style="color:green;">Presensi berhasil disimpan!</div>
    <?php endif; ?>

    <form method="post" style="margin-bottom:20px;">
        <label for="status_kehadiran"><strong>Pilih Kehadiran:</strong></label><br>
        <select name="status_kehadiran" id="status_kehadiran" required style="padding:6px 12px;" 
            <?= (!$id_sesi_absensi || !$tanggal_sesi || $status_sesi === 'ditutup') ? 'disabled' : '' ?>>
            <option value="Tidak Hadir" <?= ($status_kehadiran == 'Tidak Hadir') ? 'selected' : '' ?>>Alfa</option>
            <option value="Hadir" <?= ($status_kehadiran == 'Hadir') ? 'selected' : '' ?>>Hadir</option>
            <option value="Izin" <?= ($status_kehadiran == 'Izin') ? 'selected' : '' ?>>Izin</option>
        </select>
        <button type="submit" style="margin-left:10px;padding:6px 16px;"
            <?= (!$id_sesi_absensi || !$tanggal_sesi || $status_sesi === 'ditutup') ? 'disabled' : '' ?>>
            Simpan Presensi
        </button>
    </form>

    <?php if (!$id_sesi_absensi || !$tanggal_sesi): ?>
        <div style="color:red;">Sesi absensi belum dibuka oleh pengurus. Silakan tunggu.</div>
    <?php elseif ($status_sesi === 'ditutup'): ?>
        <div style="color:red;">Sesi absensi sudah ditutup oleh pengurus.</div>
    <?php elseif ($already_absen): ?>
        <div style="color:blue;">Anda sudah melakukan presensi untuk sesi ini (<?= htmlspecialchars($status_kehadiran) ?>). Anda masih dapat mengubah presensi selama sesi belum ditutup.</div>
    <?php endif; ?>

    <hr>
    <h3>Histori Absensi Anda di Minat Bakat Ini</h3>
    <table border="1" style="border-collapse:collapse;max-width:400px;">
        <tr>
            <th>Tanggal</th>
            <th>Status</th>
        </tr>
        <?php
        $result = $mysqli->query("SELECT ab.tanggal, ab.status_kehadiran 
            FROM absensi ab
            JOIN sesi_absensi sa ON ab.id_sesi_absensi = sa.id
            WHERE ab.user_id = $user_id AND sa.id_jadwal IN (
                SELECT id FROM jadwal_rutin WHERE id_minat_bakat = $id_minat_bakat
                UNION
                SELECT id FROM jadwal_kondisional WHERE id_minat_bakat = $id_minat_bakat
            )
            ORDER BY ab.tanggal DESC");
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                <td>" . htmlspecialchars($row['tanggal']) . "</td>
                <td>" . htmlspecialchars($row['status_kehadiran']) . "</td>
            </tr>";
        }
        ?>
    </table>
</div>
<?php include 'footer.php'; ?>