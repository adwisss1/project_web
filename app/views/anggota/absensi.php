<?php include __DIR__ . '/../header.php'; ?>

<div class="layout-wrapper">
    <?php include 'sidebar_anggota.html'; ?>
    <div class="main-content">
        <div class="content">
            <h2>Absensi Latihan</h2>
            <h3>Tahun Kepengurusan: <?= $tahun_kepengurusan; ?></h3>
            <h3>Bidang Minat Bakat yang Diikuti</h3>
            <table class="custom-table">
                <tr>
                    <th>Bidang Minat Bakat</th>
                    <th>Presensi</th>
                </tr>
                <?php while ($minat = $minat_query->fetch_assoc()) { 
                    $id_minat = $minat["id_minat_bakat"];
                ?>
                    <tr>
                        <td><?= htmlspecialchars($minat["nama_minat_bakat"]); ?></td>
                        <td>
                            <a href="presensi_minat.php?id_minat_bakat=<?= $id_minat ?><?= isset($sesi_aktif[$id_minat]) ? "&id_sesi_absensi=" . $sesi_aktif[$id_minat] : "" ?>" 
                                style="padding:6px 16px; background:#800; color:#fff; border-radius:4px; text-decoration:none;<?= isset($sesi_aktif[$id_minat]) ? '' : 'opacity:0.6;pointer-events:auto;' ?>">
                                Presensi
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </table>

            <br>
            <form action="beranda_anggota.php" method="get" style="display:inline;">
                <button type="submit" class="button">Kembali ke Dashboard</button>
            </form>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../footer.php'; ?>