<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nama_client = $_POST['nama_client'];
    $email = $_POST['email'];
    $nama_kegiatan = $_POST['nama_kegiatan'];
    $jenis_talent = $_POST['jenis_talent'];
    $jumlah_talent = $_POST['jumlah_talent'];
    $tanggal_acara = $_POST['tanggal_acara'];
    $lokasi = $_POST['lokasi'];
    $durasi = $_POST['durasi'];

    $stmt = $mysqli->prepare("INSERT INTO book_talent (nama_client, email, nama_kegiatan, jenis_talent, jumlah_talent, tanggal_acara, lokasi, durasi) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssissi", $nama_client, $email, $nama_kegiatan, $jenis_talent, $jumlah_talent, $tanggal_acara, $lokasi, $durasi);
    $stmt->execute();
    $stmt->close();

    echo "<script>alert('Request talent berhasil dikirim!');window.location='beranda.php';</script>";
    exit;
}
?>

<?php include 'header_beranda.php'; ?>

<div class="form-container">
    <form name="form_talent" action="#" method="post" onsubmit="return validasiFormTalent();">
        <h3>Form Penggunaan Talent</h3>
        
        <div class="form-row">
            <label for="nama_client">Nama Client:</label>
            <input type="text" name="nama_client" id="nama_client" placeholder="Masukkan nama Anda" required>
        </div>
        
        <div class="form-row">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email_talent" placeholder="Masukkan email Anda" required>
        </div>
        
        <div class="form-row">
            <label for="nama_kegiatan">Nama Kegiatan:</label>
            <input type="text" name="nama_kegiatan" id="nama_kegiatan" placeholder="Masukkan nama kegiatan" required>
        </div>
        
        <div class="form-row">
            <label for="jenis_talent">Jenis Talent:</label>
            <select name="jenis_talent" id="jenis_talent" required>
                <option value="" disabled selected>-- Pilih jenis talent --</option>
                <option value="penari_tradisional">Penari Tradisional</option>
                <option value="penari_modern">Penari Modern/Kontemporer</option>
                <option value="penari_kreasi">Penari Kreasi Baru</option>
                <option value="koreografer">Koreografer</option>
                <option value="pelatih_tari">Pelatih Tari</option>
                <option value="mc">Master of Ceremony (MC)</option>
                <option value="penyanyi">Penyanyi</option>
                <option value="model">Model</option>
                <option value="tim_produksi">Tim Produksi Acara</option>
                <option value="makeup_artist">Makeup Artist</option>
            </select>        
        </div>
        
        <div class="form-row">
            <label for="jumlah_talent">Jumlah Talent:</label>
            <input type="number" name="jumlah_talent" id="jumlah_talent" placeholder="Masukkan jumlah talent (dengan angka)" min="1" required>
        </div>
        
        <div class="form-row">
            <label for="tanggal_acara">Tanggal Acara:</label>
            <input type="date" name="tanggal_acara" id="tanggal_acara" required>
        </div>
        
        <div class="form-row">
            <label for="lokasi">Lokasi Acara:</label>
            <input type="text" name="lokasi" id="lokasi" placeholder="Masukkan lokasi acara (nama vanue)" required>
        </div>
        
        <div class="form-row">
            <label for="durasi">Durasi (jam):</label>
            <input type="number" name="durasi" id="durasi" placeholder="Masukkan durasi acara (jam)" min="1" required>
        </div>
        
        <div class="button-group">
            <input type="submit" value="Kirim">
            <input type="reset" value="Reset">
        </div>
        
        <a href="beranda.php">Kembali ke Halaman Utama</a>
        <br>
    </form>
</div>

<script src="/public/js/validasi.js"></script>

<?php include 'footer.php'; ?>
