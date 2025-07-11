<?php include 'header_beranda.php'; ?>
<div class="content">
    <?php if ($is_pengurus): ?>
        <div style="text-align:center; margin-bottom:24px;">
            <a href="/SI-BIRAMA/app/controllers/pengurus/beranda_pengurus.php" class="button">&larr; Kembali ke Halaman Pengurus</a>
        </div>
    <?php endif; ?>

    <!-- Row 2 kolom: Tentang UKMU Seni dan Budaya -->
    <div class="beranda-row2">
        <div class="beranda-col">
            <h2>Tentang UKMU Seni dan Budaya</h2>
            <p>Sanggar Birama adalah sebutan untuk divisi gerak dalam Unit Kegiatan Mahasiswa (UKMU) Seni dan Budaya Universitas Mataram, yang memiliki dua fokus yaitu gerak Tradisional dan gerak Modern. Dengan tujuan melestarikan dan mengembangkan seni tari tradisional maupun modern di Indonesia.</p>
            <p>Birama menyediakan berbagai talent di bidang gerak tari dan dance, serta menyewakan alat dan kostum untuk berbagai kebutuhan pertunjukan dan event.</p>
        </div>
    </div>

    <!-- Pengumuman di bawah tentang UKMU -->
    <div class="beranda-section">
        <h2>Pengumuman</h2>
        <?php if ($is_pengurus): ?>
            <table style="width:100%; border-collapse:collapse;">
                <tr>
                    <th>Isi Pengumuman</th>
                    <th style="width:140px;">Aksi</th>
                </tr>
                <?php while($row = $pengumuman->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['isi']) ?></td>
                    <td>
                        <a href="/SI-BIRAMA/app/controllers/pengumuman.php?aksi=edit&id=<?= $row['id'] ?>" class="button">Edit</a>
                        <a href="/SI-BIRAMA/app/controllers/pengumuman.php?aksi=hapus&id=<?= $row['id'] ?>" class="button" onclick="return confirm('Hapus pengumuman ini?')">Hapus</a>
                    </td>
                </tr>
                <?php endwhile; ?>
                <tr>
                    <td colspan="2" style="text-align:center;">
                        <a href="/SI-BIRAMA/app/controllers/pengumuman.php?aksi=tambah" class="button">Tambah Pengumuman</a>
                    </td>
                </tr>
            </table>
        <?php else: ?>
            <ul>
                <?php $pengumuman->data_seek(0); while($row = $pengumuman->fetch_assoc()): ?>
                    <li><?= htmlspecialchars($row['isi']) ?></li>
                <?php endwhile; ?>
            </ul>
        <?php endif; ?>
    </div>

    <!-- Terkait Jadi Anggota -->
    <div class="beranda-row1">
        <div class="beranda-col" style="max-width:400px;margin:auto;">
            <h2>Terkait Jadi Anggota?</h2>
            <p>Berminat menjadi anggota UKMU Seni dan Budaya?</p>
            <a href="/SI-BIRAMA/app/controllers/form_pendaftaran.php" class="btn btn-primary">Formulir Pendaftaran</a>
        </div>
    </div>

    <!-- Talent -->
    <div class="beranda-section">
        <h2>Talent yang Tersedia</h2>
        <table>
            <tr>
                <th>No</th>
                <th>Jenis Talent</th>
                <th>Keterangan</th>
            </tr>
            <?php $no=1; $talent->data_seek(0); while($row = $talent->fetch_assoc()): ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= htmlspecialchars($row['jenis_talent']) ?></td>
                <td><?= htmlspecialchars($row['keterangan']) ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>

    <!-- Alat dan Kostum -->
    <div class="beranda-section">
        <h2>Alat dan Kostum yang Disewakan</h2>
        <table>
            <tr>
                <th>No</th>
                <th>Nama Item</th>
                <th>Harga Sewa</th>
            </tr>
            <?php $no=1; $inventaris->data_seek(0); while($row = $inventaris->fetch_assoc()): ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= htmlspecialchars($row['nama_item']) ?></td>
                <td>Rp <?= number_format($row['harga_sewa'],0,',','.') ?>/hari</td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
</div>

<?php include 'footer.php'; ?>