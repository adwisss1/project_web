<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Talent</title>
    <link rel="stylesheet" href="/SI-BIRAMA/public/css/style.css">
</head>
<body>
<div class="layout-wrapper">
    <?php include 'sidebar_pengurus.html'; ?>
    <div class="main-content">
        <div class="content">
            <h2>Edit Talent</h2>
            <?php if ($error): ?>
                <div style="color:red;"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>
            <form method="post">
                <div class="form-row">
                    <label for="jenis_talent">Jenis Talent:</label>
                    <input type="text" name="jenis_talent" id="jenis_talent" value="<?= htmlspecialchars($jenis_talent) ?>" required>
                </div>
                <div class="form-row">
                    <label for="keterangan">Keterangan:</label>
                    <textarea name="keterangan" id="keterangan" rows="3"><?= htmlspecialchars($keterangan) ?></textarea>
                </div>
                <div class="button-group">
                    <button type="submit" class="button">Simpan</button>
                    <button type="button" class="button" onclick="window.location.href='manajemen_talent&inventaris.php'">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php include __DIR__ . '/../footer.php'; ?>
</body>
</html>