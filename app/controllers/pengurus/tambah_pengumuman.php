<?php
include __DIR__ . '/../header_beranda.php'; ?>
<div class="content" style="max-width:600px;margin:40px auto 0;background:rgba(255,255,255,0.97);padding:32px 28px;border-radius:10px;">
    <h2>Tambah Pengumuman</h2>
    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <form method="post">
        <div class="form-group">
            <label for="isi">Isi Pengumuman:</label>
            <textarea name="isi" id="isi" class="form-control" rows="4" required><?= htmlspecialchars(isset($_POST["isi"]) ? $_POST["isi"] : '') ?></textarea>
        </div>
        <div class="button-group mt-3">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="/SI-BIRAMA/app/controllers/beranda.php" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
<?php include __DIR__ . '/../footer.php'; ?>