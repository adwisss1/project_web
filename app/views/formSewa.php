<?php include 'header_beranda.php'; ?>

<div class="form-container">
    <form name="form_penyewaan" action="" method="post" onsubmit="return validasiFormSewa();">
        <h3>Form Penyewaan</h3>
        
        <label for="nama">Nama Penyewa:</label>
        <input type="text" name="nama" id="nama" placeholder="Masukkan nama Anda" required>
        <br>
        
        <label for="email">Email:</label>
        <input type="email" name="email" id="email_sewa" placeholder="Masukkan email Anda" required>
        <br>
        
        <label for="nama_kegiatan">Nama Kegiatan:</label>
        <input type="text" name="nama_kegiatan" id="nama_kegiatan" placeholder="Masukkan nama kegiatan" required>
        <br>
        
        <label for="telepon">Nomor Telepon:</label>
        <input type="tel" name="telepon" id="telepon" placeholder="Masukkan nomor telepon Anda, pastikan dapat dihubungi" required>
        <br>
        
        <label for="item">Pilih Item:</label>
        <select name="item" id="item" required>
            <option value="" disabled selected>-- Pilih item yang ingin disewa --</option>
            <option value="kostum_tradisional">Kostum Tari Tradisional</option>
            <option value="kostum_modern">Kostum Modern Dance</option>
            <option value="properti_tari">Properti Tari (Payung, Selendang, dll)</option>
            <option value="kostum_gandrung">Sewa Kostum Tari Gandrung</option>
            <option value="kipas_bajidor">Sewa Kipas Bajidor</option>
            <option value="kain">Sewa Kain</option>
            <option value="kipas_janger">Sewa Kipas Janger</option>
            <option value="kostum_dance">Sewa Kostum Dance</option>
            <option value="kostum_lorang">Sewa Kostum Lorang Modern Dance</option>
            <option value="selendang_bali">Sewa Selendang Bali</option>
        </select>        
        <br>
        
        <label for="tanggal">Tanggal Penyewaan:</label>
        <input type="date" name="tanggal" id="tanggal" required>
        <br>
        
        <label for="durasi">Durasi Penyewaan (hari):</label>
        <input type="number" name="durasi" id="durasi" placeholder="Masukkan durasi penyewaan (hari)" min="1" required>
        <br>
        
        <input type="submit" value="Kirim">
        <input type="reset" value="Reset">
        <br>
        
        <a href="beranda.php">Kembali ke Halaman Utama</a>
        <br>
    </form>
</div>

<script src="/public/js/validasi.js"></script>

<?php include 'footer.php'; ?>