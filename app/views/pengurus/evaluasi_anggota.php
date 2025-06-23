<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Evaluasi Keaktifan Anggota</title>
    <link rel="stylesheet" href="/SI-BIRAMA/public/css/style.css">
</head>
<body>
    <div class="layout-wrapper">
        <?php include 'sidebar_pengurus.html'; ?>
        <div class="main-content">
            <div class="content">
                <?php if ($mode === 'view' && isset($nama)): ?>
                    <h2>Evaluasi Anggota</h2>
                    <table class="custom-table">
                        <tr><th>Nama</th><td><?= htmlspecialchars($nama ?? '-') ?></td></tr>
                        <tr><th>NRA</th><td><?= htmlspecialchars($nra ?? '-') ?></td></tr>
                        <tr><th>Angkatan</th><td><?= htmlspecialchars($angkatan ?? '-') ?></td></tr>
                        <tr><th>Umpan Balik</th><td><?= nl2br(htmlspecialchars($umpan_balik ?? 'Belum ada evaluasi')) ?></td></tr>
                    </table>
                    <br>
                    <a href="javascript:window.close();" class="button">Tutup</a>
                <?php elseif (($mode === 'add' || $mode === 'edit') && isset($nama_anggota)): ?>
                    <h2><?= $mode === 'add' ? 'Tambah' : 'Edit' ?> Evaluasi</h2>
                    <p><strong>Nama Anggota:</strong> <?= htmlspecialchars($nama_anggota) ?></p>
                    <?php if (!empty($error)): ?>
                        <div style="color:red"><?= $error ?></div>
                    <?php endif; ?>
                    <form method="post" style="display:inline;">
                        <label for="umpan_balik">Evaluasi / Umpan Balik:</label><br>
                        <textarea name="umpan_balik" id="umpan_balik" rows="4" cols="60" required><?= htmlspecialchars($umpan_balik) ?></textarea><br><br>
                        <div style="display:inline-flex; gap:10px;">
                            <button type="submit" class="button">Simpan</button>
                            <button type="button" class="button" onclick="window.location.href='evaluasi_anggota.php?minat_evaluasi=<?= $minat_evaluasi ?>'">Batal</button>
                        </div>
                    </form>
                <?php else: ?>
                    <h2>Evaluasi Keaktifan Anggota</h2>
                    <form method="get" style="margin-bottom:20px;">
                        <label for="minat_evaluasi">Filter Minat Bakat:</label>
                        <select name="minat_evaluasi" id="minat_evaluasi" onchange="this.form.submit()">
                            <option value="">-- Pilih Minat Bakat --</option>
                            <?php
                            $minat_result->data_seek(0);
                            while ($minat = $minat_result->fetch_assoc()):
                                $selected = ($minat_evaluasi == $minat['id_minat_bakat']) ? 'selected' : '';
                                echo "<option value='{$minat['id_minat_bakat']}' $selected>".htmlspecialchars($minat['nama_minat_bakat'])."</option>";
                            endwhile;
                            ?>
                        </select>
                    </form>
                    <?php if ($minat_evaluasi && count($anggota) > 0): ?>
                        <table class="custom-table-eval">
                            <tr>
                                <th>Nama</th>
                                <th>NRA</th>
                                <th>Angkatan</th>
                                <th>Evaluasi</th>
                                <th>Aksi</th>
                                <th>Lihat</th>
                            </tr>
                            <?php foreach ($anggota as $a): ?>
                                <tr>
                                    <td><?= htmlspecialchars($a['nama']) ?></td>
                                    <td><?= htmlspecialchars($a['nra']) ?></td>
                                    <td><?= htmlspecialchars($a['angkatan']) ?></td>
                                    <td><?= htmlspecialchars(getEvaluasi($mysqli, $a['id']) ?: '-') ?></td>
                                    <td>
                                        <form method="get" action="evaluasi_anggota.php" style="display:inline;">
                                            <input type="hidden" name="mode" value="<?= getEvaluasi($mysqli, $a['id']) ? 'edit' : 'add' ?>">
                                            <input type="hidden" name="id" value="<?= $a['id'] ?>">
                                            <input type="hidden" name="minat_evaluasi" value="<?= $minat_evaluasi ?>">
                                            <button type="submit" class="button-merah">
                                                <?= getEvaluasi($mysqli, $a['id']) ? 'Edit' : 'Tambah' ?>
                                            </button>
                                        </form>
                                    </td>
                                    <td>
                                        <form method="get" action="evaluasi_anggota.php" target="_blank" style="display:inline;">
                                            <input type="hidden" name="id" value="<?= $a['id'] ?>">
                                            <input type="hidden" name="mode" value="view">
                                            <button type="submit" class="button-merah">Lihat</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    <?php elseif ($minat_evaluasi): ?>
                        <p>Belum ada anggota dalam minat bakat ini atau data belum tersedia.</p>
                    <?php else: ?>
                        <p>Silakan pilih minat bakat terlebih dahulu untuk melihat daftar anggota dan evaluasinya.</p>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php include __DIR__ . '/../footer.php'; ?>
</body>
</html>