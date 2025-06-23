<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Jadwal Kondisional</title>
    <link rel="stylesheet" href="/SI-BIRAMA/public/css/style.css">
</head>
<body>
    <div class="layout-wrapper">
        <?php include 'sidebar_pengurus.html'; ?>
        <div class="main-content">
            <div class="content">
                <button type="button" class="button" onclick="window.location.href='manajemen_jadwal.php'">&larr; Kembali</button>
                <h3 style="margin-top: 40px;">Tambah Jadwal Kondisional</h3>
                <?php if (!empty($error)): ?>
                    <div style="color:red"><?= htmlspecialchars($error) ?></div>
                <?php endif; ?>
                <form method="POST" class="form-warna">
                    <label>Minat Bakat:
                        <select name="id_minat_bakat" required>
                            <option value="">-- Pilih Minat Bakat --</option>
                            <?php
                            $minat_result->data_seek(0);
                            while ($mb = $minat_result->fetch_assoc()):
                            ?>
                                <option value="<?= $mb['id_minat_bakat'] ?>" <?= (isset($_POST['id_minat_bakat']) && $_POST['id_minat_bakat'] == $mb['id_minat_bakat']) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($mb['nama_minat_bakat']) ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </label>
                    <label>Tanggal:
                        <input type="date" name="tanggal" value="<?= htmlspecialchars($_POST['tanggal'] ?? '') ?>" required>
                    </label>
                    <label>Jam:
                        <input type="time" name="jam" value="<?= htmlspecialchars($_POST['jam'] ?? '') ?>" required>
                    </label>
                    <label>Keterangan:
                        <input type="text" name="keterangan" value="<?= htmlspecialchars($_POST['keterangan'] ?? '') ?>">
                    </label>
                    <button type="submit" class="button">Simpan Jadwal</button>
                </form>
            </div>
        </div>
    </div>
    <?php include __DIR__ . '/../footer.php'; ?>
</body>
</html>