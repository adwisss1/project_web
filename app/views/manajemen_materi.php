<?php
// filepath: d:\dari c\2Xampp\instal\htdocs\SI-BIRAMA\app\views\manajemen_materi.php
session_start();
require_once __DIR__ . '/../config/config.php';

// Pastikan hanya pengurus yang bisa akses
if (!isset($_SESSION["user"]) || $_SESSION["user"]["role"] !== "pengurus") {
    header("Location: login.php");
    exit();
}

// Ambil daftar minat bakat untuk filter
$minat_result = $mysqli->query("SELECT id_minat_bakat, nama_minat_bakat FROM minat_bakat");

// Ambil filter minat bakat jika ada
$id_minat_bakat = isset($_GET['id_minat_bakat']) ? intval($_GET['id_minat_bakat']) : 0;
$nama_minat_bakat = '';
if ($id_minat_bakat) {
    $stmt = $mysqli->prepare("SELECT nama_minat_bakat FROM minat_bakat WHERE id_minat_bakat=?");
    $stmt->bind_param("i", $id_minat_bakat);
    $stmt->execute();
    $stmt->bind_result($nama_minat_bakat);
    $stmt->fetch();
    $stmt->close();
}

// Ambil data materi latihan sesuai filter
$materi_result = null;
if ($id_minat_bakat) {
    $stmt = $mysqli->prepare("SELECT id, bidang_minat, minggu, deskripsi, materi, link_materi FROM materi_latihan WHERE bidang_minat=?");
    $stmt->bind_param("s", $nama_minat_bakat);
    $stmt->execute();
    $materi_result = $stmt->get_result();
}
?>

<?php include 'header.php'; ?>

<div class="content">
    <h2>Manajemen Materi Latihan</h2>
    <form method="get" style="margin-bottom:20px;">
        <label for="id_minat_bakat"><b>Pilih Minat Bakat:</b></label>
        <select name="id_minat_bakat" id="id_minat_bakat" required>
            <option value="">-- Pilih Minat Bakat --</option>
            <?php
            $minat_result->data_seek(0);
            while ($minat = $minat_result->fetch_assoc()) {
                $selected = ($id_minat_bakat == $minat['id_minat_bakat']) ? 'selected' : '';
                echo '<option value="'.$minat['id_minat_bakat'].'" '.$selected.'>'.htmlspecialchars($minat['nama_minat_bakat']).'</option>';
            }
            ?>
        </select>
        <button type="submit">Tampilkan</button>
    </form>

    <?php if ($id_minat_bakat && $materi_result): ?>
        <h3>Materi Latihan untuk: <?= htmlspecialchars($nama_minat_bakat) ?></h3>
        <a href="tambah_materi.php?bidang_minat=<?= urlencode($nama_minat_bakat) ?>">Tambah Materi Baru</a>
        <table border="1" cellpadding="5" cellspacing="0">
            <tr>
                <th>No</th>
                <th>Minggu</th>
                <th>Deskripsi</th>
                <th>Materi</th>
                <th>Link</th>
                <th>Aksi</th>
            </tr>
            <?php
            $no = 1;
            while ($materi = $materi_result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>{$no}</td>";
                echo "<td>" . htmlspecialchars($materi["minggu"]) . "</td>";
                echo "<td>" . htmlspecialchars($materi["deskripsi"]) . "</td>";
                echo "<td>" . htmlspecialchars($materi["materi"]) . "</td>";
                echo "<td>";
                if (!empty($materi["link_materi"])) {
                    echo '<a href="' . htmlspecialchars($materi["link_materi"]) . '" target="_blank">Akses</a>';
                } else {
                    echo "<span style='color:red'>Tidak ada link</span>";
                }
                echo "</td>";
                echo "<td>
                    <a href='edit_materi.php?id=" . $materi["id"] . "'>Edit</a> | 
                    <a href='hapus_materi.php?id=" . $materi["id"] . "' onclick=\"return confirm('Yakin hapus materi ini?')\">Hapus</a>
                </td>";
                echo "</tr>";
                $no++;
            }
            ?>
        </table>
    <?php elseif ($id_minat_bakat): ?>
        <p>Belum ada materi untuk minat bakat ini. <a href="tambah_materi.php?bidang_minat=<?= urlencode($nama_minat_bakat) ?>">Tambah Materi Baru</a></p>
    <?php endif; ?>

    <br>
    <a href="beranda_pengurus.php">Kembali ke Beranda Pengurus</a>
</div>

<?php include 'footer.php'; ?>