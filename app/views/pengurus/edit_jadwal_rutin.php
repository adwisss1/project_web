<?php
session_start();
require_once __DIR__ . '/../../config/config.php';

// Pastikan user adalah pengurus
if (!isset($_SESSION["user"]) || $_SESSION["user"]["role"] !== "pengurus") {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['id'])) {
    echo "ID jadwal tidak ditemukan.";
    exit();
}

$id = intval($_GET['id']);

// Ambil data jadwal_rutin berdasarkan id
$stmt = $mysqli->prepare("SELECT * FROM jadwal_rutin WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$jadwal = $result->fetch_assoc();

if (!$jadwal) {
    echo "Data jadwal tidak ditemukan.";
    exit();
}

// Ambil nama minat bakat
$nama_minat_bakat = '';
$stmt = $mysqli->prepare("SELECT nama_minat_bakat FROM minat_bakat WHERE id_minat_bakat = ?");
$stmt->bind_param("i", $jadwal['id_minat_bakat']);
$stmt->execute();
$stmt->bind_result($nama_minat_bakat);
$stmt->fetch();
$stmt->close();

// Proses update jika form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $hari = $_POST["hari"];
    $jam = $_POST["jam"];
    $durasi_latihan = $_POST["durasi_latihan"];
    $mentor = $_POST["mentor"];

    $stmt = $mysqli->prepare("UPDATE jadwal_rutin SET hari=?, jam=?, durasi_latihan=?, mentor=? WHERE id=?");
    $stmt->bind_param("ssdsi", $hari, $jam, $durasi_latihan, $mentor, $id);
    if ($stmt->execute()) {
        header("Location: manajemen_jadwal.php?success=update");
        exit();
    } else {
        echo "Gagal update data!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Jadwal Rutin</title>
  <link rel="stylesheet" href="/SI-BIRAMA/public/css/style.css">
</head>
<body>
  <div class="layout-wrapper">
    <?php include 'sidebar_pengurus.html'; ?>
    <div class="main-content">
      <div class="content">
        <h3>Edit Jadwal Rutin</h3>
        <p><strong>Minat Bakat:</strong> <?= htmlspecialchars($nama_minat_bakat) ?></p>
        <form method="POST" class="form-warna">>
          <label for="hari">Hari:</label>
          <select name="hari" id="hari" required>
            <?php
            $hari_list = ['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu'];
            foreach ($hari_list as $h) {
                $selected = ($jadwal['hari'] == $h) ? 'selected' : '';
                echo "<option value=\"$h\" $selected>$h</option>";
            }
            ?>
          </select><br>

          <label for="jam">Jam:</label>
          <input type="time" name="jam" id="jam" value="<?= htmlspecialchars($jadwal['jam']) ?>" min="16:00" max="22:00" required><br>

          <label for="durasi_latihan">Durasi Latihan (jam):</label>
          <input type="number" step="0.1" name="durasi_latihan" id="durasi_latihan" value="<?= htmlspecialchars($jadwal['durasi_latihan']) ?>" min="0.5" required><br>

          <label for="mentor">Mentor:</label>
          <input type="text" name="mentor" id="mentor" value="<?= htmlspecialchars($jadwal['mentor']) ?>" required><br>

        <div>
            <button type="submit" class="button">Simpan Perubahan</button>
            <button type="button" class="button" onclick="window.location.href='manajemen_jadwal.php'">Batal</button>
        </div>
        </form>
      </div>
    </div>
  </div>
  <?php include __DIR__ . '/../footer.php'; ?>
</body>
</html>
