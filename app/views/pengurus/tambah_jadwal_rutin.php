<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Jadwal Rutin</title>
    <link rel="stylesheet" href="/SI-BIRAMA/public/css/style.css">
</head>
<body>
<div class="layout-wrapper">
    <?php include 'sidebar_pengurus.html'; ?>
    <div class="main-content">
        <div class="content">
            <h2>Tambah Jadwal Rutin</h2>
            <?php if ($error): ?>
                <div style="color:red"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>
            <form method="post" class="form-warna">
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
                </label><br>
                <label>Hari:
                    <select name="hari" required>
                        <option value="">-- Pilih Hari --</option>
                        <?php
                        $hari_list = ['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu'];
                        foreach ($hari_list as $h):
                        ?>
                            <option value="<?= $h ?>" <?= (isset($_POST['hari']) && $_POST['hari'] == $h) ? 'selected' : '' ?>><?= $h ?></option>
                        <?php endforeach; ?>
                    </select>
                </label><br>
                <label>Jam:
                    <input type="time" name="jam" value="<?= htmlspecialchars($_POST['jam'] ?? '') ?>" required>
                </label><br>
                <label>Durasi (jam):
                    <input type="number" step="0.1" name="durasi" min="0.5" value="<?= htmlspecialchars($_POST['durasi'] ?? '') ?>" required>
                </label><br>
                <label>Mentor:
                    <input type="text" name="mentor" value="<?= htmlspecialchars($_POST['mentor'] ?? '') ?>" required>
                </label><br>
                <div style="display:inline-flex; gap:10px;">
                    <button type="submit" class="button">Simpan</button>
                    <button type="button" class="button" onclick="window.location.href='manajemen_jadwal.php'">Kembali</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php include __DIR__ . '/../footer.php'; ?>
</body>
</html>