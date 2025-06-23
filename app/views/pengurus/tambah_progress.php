<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Progress Program</title>
    <link rel="stylesheet" href="/SI-BIRAMA/public/css/style.css">
</head>
<body>
<div class="layout-wrapper">
    <?php include 'sidebar_pengurus.html'; ?>
    <div class="main-content">
        <div class="content">
            <h2>Tambah Progress: <?= htmlspecialchars($nama_program); ?></h2>
            <?php if (!empty($error)): ?>
                <div style="color:red;"><?= htmlspecialchars($error); ?></div>
            <?php endif; ?>
            <form method="POST" class="form-warna">
                <label for="laporan">Laporan Progress:</label><br>
                <textarea name="laporan" id="laporan" rows="6" cols="60" required><?= htmlspecialchars($laporan); ?></textarea><br><br>
                <button type="submit" class="button">Tambah</button>
            </form>
            <button type="button" class="button" onclick="window.location.href='kontrol_program.php?filter_program=<?= $id_program; ?>#progress-proker'">&larr; Kembali ke Progress</button>
        </div>
    </div>
</div>
<?php include __DIR__ . '/../footer.php'; ?>
</body>
</html>