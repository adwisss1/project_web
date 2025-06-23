<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Materi Latihan</title>
    <link rel="stylesheet" href="/SI-BIRAMA/public/css/style.css">
</head>
<body>
<div class="layout-wrapper">
    <?php include 'sidebar_pengurus.html'; ?>
    <div class="main-content">
        <div class="content">
            <h2>Tambah Materi Latihan</h2>
            <?php if ($error): ?><div style="color:red"><?= htmlspecialchars($error) ?></div><?php endif; ?>
            <form method="post" class="form-warna">
                <input type="hidden" name="id_minat_bakat" value="<?= htmlspecialchars($id_minat_bakat) ?>">
                <input type="hidden" name="bidang_minat" value="<?= htmlspecialchars($bidang_minat) ?>">
                Bidang Minat: <input type="text" name="bidang_minat_display" value="<?= htmlspecialchars($bidang_minat) ?>" readonly><br>
                Minggu: <input type="number" name="minggu" required><br>
                Deskripsi: <input type="text" name="deskripsi"><br>
                Materi: <input type="text" name="materi" required><br>
                Link Materi: <input type="text" name="link_materi"><br>
                <button type="submit" class="button">Tambah</button>
                <button type="button" class="button" onclick="window.location.href='manajemen_materi.php?id_minat_bakat=<?= urlencode($id_minat_bakat) ?>&bidang_minat=<?= urlencode($bidang_minat) ?>'">Kembali</button>
            </form>
        </div>
    </div>
</div>
<?php include __DIR__ . '/../footer.php'; ?>
</body>
</html>