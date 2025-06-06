<?php
session_start();
require_once __DIR__ . '/../config/config.php';

// Pastikan user adalah pengurus
if (!isset($_SESSION["user"]) || $_SESSION["role"] !== "pengurus") {
    header("Location: ../login.php");
    exit();
}

// Ambil daftar jadwal rutin berdasarkan minat bakat
$stmt = $mysqli->prepare("
    SELECT jr.id, mb.nama_minat_bakat, jr.durasi_latihan, jr.mentor 
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
    <table border="1">
        <tr>
            <th>No</th>
            <th>Hari</th>
            <th>Jam</th>
            <th>Durasi Latihan</th>
            <th>Mentor</th>
            <th>Aksi</th>
        </tr>
        <?php
        $jadwal_query = $mysqli->query("SELECT * FROM jadwal_rutin");
        $no = 1;
        while ($jadwal = $jadwal_query->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$no}</td>";
            echo "<td>" . (isset($jadwal["hari"]) ? htmlspecialchars($jadwal["hari"]) : '-') . "</td>";
            echo "<td>" . (isset($jadwal["jam"]) ? htmlspecialchars($jadwal["jam"]) : '-') . "</td>";
            echo "<td>" . htmlspecialchars($jadwal["durasi_latihan"]) . "</td>";
            echo "<td>" . htmlspecialchars($jadwal["mentor"]) . "</td>";
            echo "<td><a href='edit_jadwal_rutin.php?id=" . urlencode($jadwal["id"]) . "'>Edit</a></td>";
            echo "</tr>";
            $no++;
        }
        ?>
    </table>

    <!-- Bagian 2: Form Tambah Jadwal Kondisional -->
    <h3>Tambah Jadwal Kondisional</h3>
    <form method="POST" action="controllers/tambah_jadwal.php">
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
    <table border="1">
        <tr>
            <th>Minat Bakat</th>
            <th>Tanggal</th>
            <th>Jam</th>
            <th>Keterangan</th>
            <th>Aksi</th>
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
        while ($jadwal = $jadwal_kondisional_table->fetch_assoc()) { ?>
            <tr>
                <td><?= htmlspecialchars($jadwal["nama_minat_bakat"]); ?></td>
                <td><?= htmlspecialchars($jadwal["tanggal"]); ?></td>
                <td><?= htmlspecialchars($jadwal["jam"]); ?></td>
                <td><?= htmlspecialchars($jadwal["keterangan"]); ?></td>
                <td>
                    <form method="POST" action="controllers/hapus_jadwal.php" onsubmit="return confirm('Yakin ingin menghapus jadwal ini?');" style="display:inline;">
                        <input type="hidden" name="id" value="<?= $jadwal["id"]; ?>">
                        <button type="submit" style="color:red;">Hapus</button>
                    </form>
                </td>
            </tr>
        <?php } ?>
    </table>

    <!-- Bagian 3: Kalender Jadwal -->
    <h3>Kalender Jadwal Latihan</h3>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/6.1.5/main.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/6.1.5/main.min.js"></script>

    <div id="calendar"></div>

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