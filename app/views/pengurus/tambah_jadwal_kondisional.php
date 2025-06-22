<?php
session_start();
require_once __DIR__ . '/../../config/config.php';

if (!isset($_SESSION["user"]) || $_SESSION["user"]["role"] !== "pengurus") {
    header("Location: ../login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Jadwal Kondisional</title>
    <link rel="stylesheet" href="/SI-BIRAMA/public/css/style.css">
</head>
<body>
    <div class="layout-wrapper">
        <?php include 'sidebar_pengurus.html'; ?>
        <div class="main-content">
            <div class="content">
<button type="button" class="button" onclick="window.location.href='manajemen_jadwal.php'"> <----Kembali</button>
                <h3 style="margin-top: 40px;">Tambah Jadwal Kondisional</h3>
                <form method="POST" action="/SI-BIRAMA/app/controllers/tambah_jadwal.php" class="form-warna">
                    <label>Minat Bakat:
                        <select name="id_minat_bakat" required>
                            <?php
                            $minat_result = $mysqli->query("SELECT id_minat_bakat, nama_minat_bakat FROM minat_bakat");
                            while ($mb = $minat_result->fetch_assoc()):
                                echo '<option value="'.$mb['id_minat_bakat'].'">'.htmlspecialchars($mb['nama_minat_bakat']).'</option>';
                            endwhile;
                            ?>
                        </select>
                    </label>
                    <label>Tanggal:
                        <input type="date" name="tanggal" required>
                    </label>
                    <label>Jam:
                        <input type="time" name="jam" required>
                    </label>
                    <label>Keterangan:
                        <input type="text" name="keterangan">
                    </label>
                    <input type="submit" value="Simpan Jadwal" class="button">
                </form>
            </div>
        </div>
    </div>
    <?php include __DIR__ . '/../footer.php'; ?>
</body>
</html>