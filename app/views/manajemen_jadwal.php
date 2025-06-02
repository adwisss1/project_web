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
$stmt = $mysqli->prepare("SELECT id, bidang_minat, tanggal, jam FROM jadwal_latihan");
$stmt->execute();
$jadwal_kondisional_result = $stmt->get_result();

// Persiapkan data untuk kalender
$events = [];
while ($row = $jadwal_kondisional_result->fetch_assoc()) {
    $events[] = [
        "title" => $row["bidang_minat"],
        "start" => $row["tanggal"] . "T" . $row["jam"]
    ];
}
?>

<?php include __DIR__ . '/header.php'; ?>
<a href="beranda_pengurus.php">Kembali ke Beranda Pengurus</a>

<div class="content">
    <h2>Manajemen Jadwal Latihan</h2>

    <!-- Bagian 1: Tabel Jadwal Rutin -->
    <h3>Jadwal Latihan Rutin</h3>
    <a href="edit_jadwal_rutin.php">Edit Jadwal Rutin</a>
    <table border="1">
        <tr><th>Minat Bakat</th><th>Durasi Latihan</th><th>Mentor</th></tr>
        <?php while ($jadwal = $jadwal_rutin_result->fetch_assoc()) { ?>
            <tr>
                <td><?= htmlspecialchars($jadwal["nama_minat_bakat"]); ?></td>
                <td><?= htmlspecialchars($jadwal["durasi_latihan"]); ?> Jam</td>
                <td><?= htmlspecialchars($jadwal["mentor"]); ?></td>
            </tr>
        <?php } ?>
    </table>

    <!-- Bagian 2: Form Tambah Jadwal Kondisional -->
    <h3>Tambah Jadwal Kondisional</h3>
        <form method="POST" action="controllers/tambah_jadwal.php">

        <label for="bidang_minat">Bidang Minat:</label>
        <input type="text" name="bidang_minat" required><br>

        <label for="tanggal">Tanggal Latihan:</label>
        <input type="date" name="tanggal" required><br>

        <label for="jam">Jam Latihan:</label>
        <input type="time" name="jam" required><br>

        <button type="submit">Simpan Jadwal</button>
    </form>
    <!-- Tabel Jadwal Kondisional -->
    <!-- Tabel Jadwal Kondisional -->
    <h3>Daftar Jadwal Kondisional</h3>
    <table border="1">
        <tr>
            <th>Bidang Minat</th>
            <th>Tanggal</th>
            <th>Jam</th>
            <th>Aksi</th>
        </tr>
        <?php
        // Ambil ulang data jadwal kondisional (karena $jadwal_kondisional_result sudah habis dipakai untuk kalender)
        $stmt = $mysqli->prepare("SELECT id, bidang_minat, tanggal, jam FROM jadwal_latihan ORDER BY tanggal DESC, jam DESC");
        $stmt->execute();
        $jadwal_kondisional_table = $stmt->get_result();
        while ($jadwal = $jadwal_kondisional_table->fetch_assoc()) { ?>
            <tr>
                <td><?= htmlspecialchars($jadwal["bidang_minat"]); ?></td>
                <td><?= htmlspecialchars($jadwal["tanggal"]); ?></td>
                <td><?= htmlspecialchars($jadwal["jam"]); ?></td>
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
