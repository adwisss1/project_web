<?php include __DIR__ . '/../header.php'; ?>
<div class="layout-wrapper">
    <?php include __DIR__ . '/sidebar_anggota.html'; ?>
    <div class="main-content">
        <div class="content">
            <h2>Presensi Minat Bakat</h2>
            <div><strong>Minat Bakat:</strong> <?= htmlspecialchars($nama_minat_bakat) ?></div>
            <div><strong>Tanggal Sesi:</strong> <?= $tanggal_sesi ? htmlspecialchars($tanggal_sesi) : '<span style="color:gray;">Belum ada sesi dibuka</span>' ?></div>
            <br>
            <a href="absensi.php" style="display:inline-block;padding:5px 15px;color:#fff;border-radius:4px;">&larr; Kembali ke Halaman Absensi</a>
            <?php if (isset($_GET['success'])): ?>
                <div style="color:green;">Presensi berhasil disimpan!</div>
            <?php endif; ?>

            <form method="post" class="form-warna" style="margin-bottom:20px;">
                <label for="status_kehadiran"><strong>Pilih Kehadiran:</strong></label><br>
                <select name="status_kehadiran" id="status_kehadiran" required style="padding:6px 12px;" 
                    <?= (!$id_sesi_absensi || !$tanggal_sesi || $status_sesi === 'ditutup') ? 'disabled' : '' ?>>
                    <option value="Tidak Hadir" <?= ($status_kehadiran == 'Tidak Hadir') ? 'selected' : '' ?>>Alfa</option>
                    <option value="Hadir" <?= ($status_kehadiran == 'Hadir') ? 'selected' : '' ?>>Hadir</option>
                    <option value="Izin" <?= ($status_kehadiran == 'Izin') ? 'selected' : '' ?>>Izin</option>
                </select>
                <button type="submit" class="button"
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
                <?php foreach ($histori as $row): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['tanggal']) ?></td>
                        <td><?= htmlspecialchars($row['status_kehadiran']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>
<?php include __DIR__ . '/../footer.php'; ?>