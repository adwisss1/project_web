<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Program Kerja</title>
    <link rel="stylesheet" href="/SI-BIRAMA/public/css/style.css">
</head>
<body>
<div class="layout-wrapper">
    <?php include 'sidebar_pengurus.html'; ?>
    <div class="main-content">
        <div class="content">
            <h2>Edit Program Kerja</h2>
            <?php if ($error): ?>
                <div style="color:red;"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>
            <?php if ($success): ?>
                <div style="color:green;"><?= htmlspecialchars($success) ?></div>
            <?php endif; ?>
            <?php if ($id_program && !$error): ?>
            <form method="post" class="form-warna">
                <label>Nama Program:
                    <input type="text" name="nama_program" value="<?= htmlspecialchars($nama_program) ?>" required>
                </label><br>
                <label>Deskripsi:
                    <textarea name="deskripsi" required><?= htmlspecialchars($deskripsi) ?></textarea>
                </label><br>
                <button type="submit" class="button">Simpan Perubahan</button>
                <button type="button" class="button" onclick="window.location.href='kontrol_program.php'">Kembali</button>
            </form>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php include __DIR__ . '/../footer.php'; ?>
</body>
</html>