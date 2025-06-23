<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Inventaris</title>
    <link rel="stylesheet" href="/SI-BIRAMA/public/css/style.css">
</head>
<body>
<div class="layout-wrapper">
    <?php include 'sidebar_pengurus.html'; ?>
    <div class="main-content">
        <div class="content">
            <h2>Edit Inventaris</h2>
            <?php if ($error): ?>
                <div style="color:red;"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>
            <form method="post">
                <div class="form-row">
                    <label for="nama_item">Nama Item:</label>
                    <input type="text" name="nama_item" id="nama_item" value="<?= htmlspecialchars($nama_item) ?>" required>
                </div>
                <div class="form-row">
                    <label for="harga_sewa">Harga Sewa (per hari):</label>
                    <input type="number" name="harga_sewa" id="harga_sewa" value="<?= htmlspecialchars($harga_sewa) ?>" required>
                </div>
                <div class="button-group">
                    <button type="submit" class="button">Simpan</button>
                    <button type="button" class="button" onclick="window.location.href='manajemen_talent&inventaris.php'">Batal/Kembali</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php include __DIR__ . '/../footer.php'; ?>
</body>
</html>