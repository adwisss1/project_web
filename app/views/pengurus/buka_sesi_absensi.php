<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Buka Sesi Absensi</title>
    <link rel="stylesheet" href="/SI-BIRAMA/public/css/style.css">
</head>
<body>
<div class="layout-wrapper">
    <?php include 'sidebar_pengurus.html'; ?>
    <div class="main-content">
        <div class="content">
            <h2 style="color:#8B0000; margin-bottom:18px;">Buka Sesi Absensi</h2>
            <?php if ($error): ?>
                <div style="color:red; margin-bottom:10px;"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <div style="margin-bottom:10px; display: flex; gap: 10px; align-items: center;">
                <!-- Form Buka Sesi -->
                <form method="post" class="form-warna" style="margin:0;">
                    <label for="tanggal" style="font-weight:bold;">Tanggal Latihan:</label><br>
                    <input type="date" id="tanggal" name="tanggal" required value="<?= htmlspecialchars($tanggal_sesi ?? '') ?>" style="width: 100%; max-width: 250px; padding: 6px; margin-bottom:6px;">
                    <button type="submit" class="button">Buka Sesi</button>
                </form>
                <!-- Form Tutup Sesi -->
                <?php if ($sesi_id && !empty($tanggal_sesi)): ?>
                    <form action="tutup_sesi_absensi.php" method="get" style="margin:0;">
                        <input type="hidden" name="id_sesi" value="<?= $sesi_id ?>">
                        <input type="hidden" name="tipe" value="<?= $tipe ?>">
                        <form action="tutup_sesi_absensi.php" method="get">
                            <input type="hidden" name="id_sesi" value="<?= $sesi_id ?>">
                            <input type="hidden" name="tipe" value="<?= $tipe ?>">
                            <button type="submit" class="button">Tutup Sesi Absensi</button>
                        </form>
                    </form>
                <?php endif; ?>
            </div>

            <button type="button" class="button" onclick="window.location.href='manajemen_jadwal.php'">Kembali</button>

            <hr>
            <h3 style="color:#8B0000;">Rekap Absensi Anggota</h3>
            <form method="get" class="form-warna">
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
                <button type="submit" class="button">Filter</button>
            </form>

            <div style="margin-bottom:10px;">
                <strong>Total anggota:</strong> <?= count($anggota) ?>
            </div>

            <div class="table-responsive-absensi">
                <table class="rekap-absensi-table">
                    <tr>
                        <th>No</th>
                        <th>Nama Anggota</th>
                        <?php foreach ($tanggal_sesi_arr as $tgl): ?>
                            <th><?= date('d/m/Y', strtotime($tgl)) ?></th>
                        <?php endforeach; ?>
                    </tr>
                    <?php
                    $no = 1;
                    foreach ($anggota as $id_anggota => $nama) {
                        echo "<tr>
                            <td>$no</td>
                            <td>" . htmlspecialchars($nama) . "</td>";
                        foreach ($tanggal_sesi_arr as $id_sesi => $tgl) {
                            $status = isset($absensi[$id_anggota][$id_sesi]) ? $absensi[$id_anggota][$id_sesi] : "<span style='color:red'>Alfa</span>";
                            echo "<td>$status</td>";
                        }
                        echo "</tr>";
                        $no++;
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
</div>
<?php include __DIR__ . '/../footer.php'; ?>
</body>
</html>