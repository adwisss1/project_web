<?php
session_start(); // Pastikan hanya dipanggil sekali di awal
?>

<?php include 'header.php'; ?>

<style>
body {
    background-image: url("../public/images/background.png");
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
}
</style>

<div class="content">
    <div class="intro">
        <h2>Tentang Sanggar Birama</h2>
        <p>Sanggar Birama adalah sebutan untuk divisi gerak dalam Unit Kegiatan Mahasiswa (UKMU) Seni dan Budaya Universitas Mataram, yang memiliki dua fokus yaitu gerak Tradisional dan gerak Modern. Dengan tujuan melestarikan dan mengembangkan seni tari tradisional maupun modern di Indonesia.</p>
        <p>Birama menyediakan berbagai talent di bidang gerak tari dan dance, serta menyewakan alat dan kostum untuk berbagai kebutuhan pertunjukan dan event.</p>
    </div>

    <?php
    // Menampilkan tombol Login jika user belum login
    if (!isset($_SESSION["user"])) {
        echo '<a href="/SI-BIRAMA/app/views/login.php">Login</a>';

    } else {
        // Menampilkan ucapan selamat datang dan tombol Logout jika user sudah login
        echo "<p>Selamat datang, " . $_SESSION["user"]["username"] . "!</p>";
       echo '<a href="../controllers/authController.php?logout=true">Logout</a>';
    }
    ?>

    <h2>Talent yang Tersedia</h2>
    <table>
        <tr>
            <th>No</th>
            <th>Jenis Talent</th>
            <th>Keterangan</th>
        </tr>
        <tr>
            <td>1</td>
            <td>Tari Tradisional</td>
            <td>Pertunjukan tari khas daerah</td>
        </tr>
        <tr>
            <td>2</td>
            <td>Modern Dance</td>
            <td>Koreografi untuk event</td>
        </tr>
        <tr>
            <td>3</td>
            <td>Kontemporer</td>
            <td>Penampilan Kontemporer & kreasi</td>
        </tr>
        <tr>
            <td>4</td>
            <td>Requested</td>
            <td>Penampilan sesuai request dari client</td>
        </tr>
    </table>
    
    <h2>Alat dan Kostum yang Disewakan</h2>
    <table>
        <tr>
            <th>No</th>
            <th>Nama Item</th>
            <th>Harga Sewa</th>
        </tr>
        <tr>
            <td>1</td>
            <td>Kostum Tari Tradisional</td>
            <td>Rp 300.000/hari</td>
        </tr>
        <tr>
            <td>2</td>
            <td>Kostum Modern Dance</td>
            <td>Rp 250.000/hari</td>
        </tr>
        <tr>
            <td>3</td>
            <td>Properti Tari</td>
            <td>Rp 50.000/hari</td>
        </tr>
    </table>

    <h2>Portofolio dan Layanan</h2>
    <p>Lihat karya dan penampilan terbaik dari Sanggar Birama:</p>
    <a href="/SI-BIRAMA/app/views/portofolio.php">Lihat Portofolio</a>

    <p>Ingin menyewa alat atau kostum? Isi formulir di bawah ini:</p>
    <a href="/SI-BIRAMA/app/views/formSewa.php">Formulir Penyewaan Alat & Kostum</a>

    <p>Berminat menggunakan talent kami untuk acara Anda?</p>
    <a href="/SI-BIRAMA/app/views/bookTalent.php">Formulir Penyewaan Talent</a>
</div>

<?php include 'footer.php'; ?>
