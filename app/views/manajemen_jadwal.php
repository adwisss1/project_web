<?php


session_start();
require_once __DIR__ . '/../config/config.php';

// Pastikan user adalah pengurus
if (!isset($_SESSION["user"]) || $_SESSION["user"]["role"] !== "pengurus") {
    header("Location: ../login.php");
    exit();
}

// Ambil daftar jadwal rutin berdasarkan minat bakat
$stmt = $mysqli->prepare("
    SELECT jr.id, mb.nama_minat_bakat, jr.hari, jr.jam, jr.durasi_latihan, jr.mentor 
    FROM jadwal_rutin jr
    INNER JOIN minat_bakat mb ON jr.id_minat_bakat = mb.id_minat_bakat
");
$stmt->execute();
$jadwal_rutin_result = $stmt->get_result();

// Ambil jadwal kondisional (event, job, latihan tambahan)
$stmt = $mysqli->prepare("
    SELECT jk.id, mb.nama_minat_bakat, jk.tanggal, jk.jam, jk.keterangan
    FROM jadwal_kondisional jk
    INNER JOIN minat_bakat mb ON jk.id_minat_bakat = mb.id_minat_bakat
");
$stmt->execute();
$jadwal_kondisional_result = $stmt->get_result();

// Persiapkan data untuk kalender
$events = [];
$jadwal_kondisional_result->data_seek(0);
while ($row = $jadwal_kondisional_result->fetch_assoc()) {
    $events[] = [
        "title" => $row["nama_minat_bakat"] . (empty($row["keterangan"]) ? "" : " - " . $row["keterangan"]),
        "start" => $row["tanggal"] . "T" . $row["jam"]
    ];
}
?>

<?php include __DIR__ . '/header.php'; ?>
<a href="beranda_pengurus.php">Kembali ke Beranda Pengurus</a>

<div class="content">
    <h3>Daftar Jadwal Rutin</h3>
    <table border="1" style="width:100%;table-layout:fixed;">
        <tr>
            <th style="width:40px;">No</th>
            <th>Minat Bakat</th>
            <th>Hari</th>
            <th>Jam</th>
            <th>Durasi Latihan</th>
            <th>Mentor</th>
            <th style="width:180px;">Aksi</th>
        </tr>
        <?php
        $no = 1;
        $jadwal_rutin_result->data_seek(0);
        while ($jadwal_rutin = $jadwal_rutin_result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$no}</td>";
            echo "<td>" . htmlspecialchars($jadwal_rutin["nama_minat_bakat"]) . "</td>";
            echo "<td>" . (isset($jadwal_rutin["hari"]) ? htmlspecialchars($jadwal_rutin["hari"]) : '-') . "</td>";
            echo "<td>" . (isset($jadwal_rutin["jam"]) ? htmlspecialchars($jadwal_rutin["jam"]) : '-') . "</td>";
            echo "<td>" . htmlspecialchars($jadwal_rutin["durasi_latihan"]) . "</td>";
            echo "<td>" . htmlspecialchars($jadwal_rutin["mentor"]) . "</td>";
            echo "<td>
                <a href='edit_jadwal_rutin.php?id=" . urlencode($jadwal_rutin["id"]) . "' style='display:inline-block;margin-right:8px;padding:5px 12px;background:#007bff;color:#fff;border-radius:4px;text-decoration:none;'>Edit</a>
                <a href='buka_sesi_absensi.php?id_jadwal={$jadwal_rutin["id"]}&tipe=rutin' style='display:inline-block;padding:5px 12px;background:#28a745;color:#fff;border-radius:4px;text-decoration:none;'>Absensi</a>
            </td>";
            echo "</tr>";
            $no++;
        }
        ?>
    </table>

    <!-- Bagian 2: Form Tambah Jadwal Kondisional -->
    <h3>Tambah Jadwal Kondisional</h3>
    <form method="POST" action="/SI-BIRAMA/app/controllers/tambah_jadwal.php">
        <label for="id_minat_bakat">Minat Bakat:</label>
        <select name="id_minat_bakat" required>
            <?php
            $minat_result = $mysqli->query("SELECT id_minat_bakat, nama_minat_bakat FROM minat_bakat");
            while ($mb = $minat_result->fetch_assoc()) {
                echo '<option value="'.$mb['id_minat_bakat'].'">'.htmlspecialchars($mb['nama_minat_bakat']).'</option>';
            }
            ?>
        </select><br>

        <label for="tanggal">Tanggal Latihan:</label>
        <input type="date" name="tanggal" required><br>

        <label for="jam">Jam Latihan:</label>
        <input type="time" name="jam" required><br>

        <label for="keterangan">Keterangan:</label>
        <input type="text" name="keterangan"><br>

        <button type="submit">Simpan Jadwal</button>
    </form>

    <!-- Tabel Jadwal Kondisional -->
    <h3>Daftar Jadwal Kondisional</h3>
    <table border="1" style="width:100%;table-layout:fixed;">
        <tr>
            <th>Minat Bakat</th>
            <th>Tanggal</th>
            <th>Jam</th>
            <th>Keterangan</th>
            <th style="width:180px;">Aksi</th>
        </tr>
        <?php
        // Ambil ulang data jadwal kondisional untuk tabel
        $stmt = $mysqli->prepare("
            SELECT jk.id, mb.nama_minat_bakat, jk.tanggal, jk.jam, jk.keterangan
            FROM jadwal_kondisional jk
            INNER JOIN minat_bakat mb ON jk.id_minat_bakat = mb.id_minat_bakat
            ORDER BY jk.tanggal DESC, jk.jam DESC
        ");
        $stmt->execute();
        $jadwal_kondisional_table = $stmt->get_result();
        while ($jadwal_kondisional = $jadwal_kondisional_table->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($jadwal_kondisional["nama_minat_bakat"]) . "</td>";
            echo "<td>" . htmlspecialchars($jadwal_kondisional["tanggal"]) . "</td>";
            echo "<td>" . htmlspecialchars($jadwal_kondisional["jam"]) . "</td>";
            echo "<td>" . htmlspecialchars($jadwal_kondisional["keterangan"]) . "</td>";
            echo "<td style='white-space:nowrap;'>
                <form method='POST' action='/SI-BIRAMA/app/controllers/hapus_jadwal.php' onsubmit=\"return confirm('Yakin ingin menghapus jadwal ini?');\" style='display:inline;'>
                    <input type='hidden' name='id' value='".htmlspecialchars($jadwal_kondisional["id"])."'>
                    
                <button type='submit' style='color:#fff;background:#dc3545;padding:4px 10px;font-size:14px;border:none;border-radius:4px;margin-right:6px;'>Hapus</button>
                </form>
                <a href='buka_sesi_absensi.php?id_jadwal={$jadwal_kondisional["id"]}&tipe=kondisional' style='display:inline-block;padding:4px 10px;font-size:14px;background:#28a745;color:#fff;border-radius:4px;text-decoration:none;margin-right:6px;'>Absensi</a>
            </td>";
            echo "</tr>";
        }
        ?>
    </table>
</div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            events: <?= json_encode($events) ?>
        });
        calendar.render();
    });
    </script>
</div>

<?php include __DIR__ . '/footer.php'; ?>