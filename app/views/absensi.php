<?php
session_start();
require_once __DIR__ . '/../config/config.php';

if (!isset($_SESSION["user"]) || $_SESSION["user"]["role"] !== "anggota") {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION["user"]["id"];

// Ambil informasi minat bakat anggota
$minat_query = $mysqli->query("
    SELECT mb.id_minat_bakat, mb.nama_minat_bakat 
    FROM anggota_minat_bakat amb
    JOIN anggota a ON amb.id_anggota = a.id
    JOIN minat_bakat mb ON amb.id_minat_bakat = mb.id_minat_bakat
    WHERE a.user_id = $user_id
");

// Tahun kepengurusan
$tahun_kepengurusan = "2025";

// Ambil sesi absensi aktif per minat bakat
$sesi_aktif = [];
$q = $mysqli->query("SELECT sa.id, sa.id_jadwal, jr.id_minat_bakat 
    FROM sesi_absensi sa
    JOIN jadwal_rutin jr ON sa.id_jadwal = jr.id
    WHERE sa.status = 'dibuka'
    UNION
    SELECT sa.id, sa.id_jadwal, jk.id_minat_bakat 
    FROM sesi_absensi sa
    JOIN jadwal_kondisional jk ON sa.id_jadwal = jk.id
    WHERE sa.status = 'dibuka'
");
while ($row = $q->fetch_assoc()) {
    $sesi_aktif[$row['id_minat_bakat']] = $row['id'];
}
?>

<?php include 'header.php'; ?>

<div class="layout-wrapper">
    <?php include 'sidebar_anggota.html'; ?>
    <div class="main-content">
        <div class="content">
            <h2>Absensi Latihan</h2>
            <h3>Tahun Kepengurusan: <?= $tahun_kepengurusan; ?></h3>
            <h3>Bidang Minat Bakat yang Diikuti</h3>
            <table class="custom-table">
                <tr>
                    <th>Bidang Minat Bakat</th>
                    <th>Presensi</th>
                </tr>
                <?php while ($minat = $minat_query->fetch_assoc()) { 
                    $id_minat = $minat["id_minat_bakat"];
                ?>
                    <tr>
                        <td><?= htmlspecialchars($minat["nama_minat_bakat"]); ?></td>
                        <td>
                            <a href="presensi_minat.php?id_minat_bakat=<?= $id_minat ?><?= isset($sesi_aktif[$id_minat]) ? "&id_sesi_absensi=" . $sesi_aktif[$id_minat] : "" ?>" 
                                style="padding:6px 16px; background:#800; color:#fff; border-radius:4px; text-decoration:none;<?= isset($sesi_aktif[$id_minat]) ? '' : 'opacity:0.6;pointer-events:auto;' ?>">
                                Presensi
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </table>

            <br>
            <form action="beranda_anggota.php" method="get" style="display:inline;">
                <button type="submit" class="button">Kembali ke Dashboard</button>
            </form>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>