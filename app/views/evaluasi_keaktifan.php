<?php
// filepath: d:\dari c\2Xampp\instal\htdocs\SI-BIRAMA\app\views\evaluasi_keaktifan.php
session_start();
require_once __DIR__ . '/../config/config.php';

if (!isset($_SESSION["user"]) || $_SESSION["role"] !== "pengurus") {
    header("Location: ../login.php");
    exit();
}

$minat_result_eval = $mysqli->query("SELECT id_minat_bakat, nama_minat_bakat FROM minat_bakat");
$filter_minat_evaluasi = isset($_GET['minat_evaluasi']) ? $_GET['minat_evaluasi'] : '';

$anggota_evaluasi_result = null;
if ($filter_minat_evaluasi !== '') {
    $stmt_eval = $mysqli->prepare("
        SELECT a.id, a.nama, a.nra, a.angkatan, mb.nama_minat_bakat,
            (SELECT COUNT(*) FROM absensi WHERE absensi.user_id = a.user_id) AS jumlah_absen
        FROM anggota a
        LEFT JOIN minat_bakat mb ON a.id_minat_bakat = mb.id_minat_bakat
        WHERE a.id_minat_bakat = ?
        ORDER BY jumlah_absen ASC, a.nama ASC
    ");
    $stmt_eval->bind_param("i", $filter_minat_evaluasi);
    $stmt_eval->execute();
    $anggota_evaluasi_result = $stmt_eval->get_result();
}
?>

<?php include __DIR__ . '/header.php'; ?>

<a href="manajemen_anggota_kinerja.php">Kembali ke Manajemen Anggota</a>
<h2>Evaluasi Keaktifan Anggota per Minat Bakat</h2>
<form method="get" style="margin-bottom:16px;">
    <label>Pilih Minat Bakat:
        <select name="minat_evaluasi" required>
            <option value="">-- Pilih Minat Bakat --</option>
            <?php
            $minat_result_eval->data_seek(0);
            while ($minat = $minat_result_eval->fetch_assoc()) { ?>
                <option value="<?= $minat['id_minat_bakat'] ?>" <?= $filter_minat_evaluasi == $minat['id_minat_bakat'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($minat['nama_minat_bakat']) ?>
                </option>
            <?php } ?>
        </select>
    </label>
    <button type="submit">Tampilkan</button>
</form>
<table border="1">
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Angkatan</th>
        <th>Jumlah Absensi</th>
        <th>Evaluasi</th>
        <th>Aksi</th>
    </tr>
    <?php
    if ($filter_minat_evaluasi !== '' && $anggota_evaluasi_result && $anggota_evaluasi_result->num_rows > 0) {
        $no = 1;
        while ($anggota = $anggota_evaluasi_result->fetch_assoc()) {
            $evaluasi_text = '';
            $stmt_eval_detail = $mysqli->prepare("SELECT umpan_balik FROM evaluasi WHERE user_id = ?");
            $stmt_eval_detail->bind_param("i", $anggota["id"]);
            $stmt_eval_detail->execute();
            $stmt_eval_detail->bind_result($evaluasi_text);
            $stmt_eval_detail->fetch();
            $stmt_eval_detail->close();

            echo "<tr>";
            echo "<td>{$no}</td>";
            echo "<td>" . htmlspecialchars($anggota["nama"]) . "</td>";
            echo "<td>" . htmlspecialchars($anggota["angkatan"]) . "</td>";
            echo "<td>" . htmlspecialchars($anggota["jumlah_absen"]) . "</td>";
            echo "<td>" . htmlspecialchars($evaluasi_text ?? '') . "</td>";
            echo "<td>";
            if (empty($evaluasi_text)) {
                echo "<a href='evaluasi_anggota.php?mode=add&id=" . $anggota["id"] . "&minat_evaluasi=" . urlencode($filter_minat_evaluasi) . "'>Tambah Evaluasi</a>";
            } else {
                echo "<a href='evaluasi_anggota.php?mode=edit&id=" . $anggota["id"] . "&minat_evaluasi=" . urlencode($filter_minat_evaluasi) . "'>Edit</a> | ";
                echo "<a href='evaluasi_anggota.php?mode=delete&id=" . $anggota["id"] . "&minat_evaluasi=" . urlencode($filter_minat_evaluasi) . "' onclick=\"return confirm('Hapus evaluasi ini?')\">Hapus</a>";
            }
            echo "</td>";
            echo "</tr>";
            $no++;
        }
    } elseif ($filter_minat_evaluasi !== '') {
        echo "<tr><td colspan='6'>Tidak ada anggota pada minat bakat ini.</td></tr>";
    } else {
        echo "<tr><td colspan='6'>Silakan pilih minat bakat untuk evaluasi.</td></tr>";
    }
    ?>
</table>

<?php include __DIR__ . '/footer.php'; ?>