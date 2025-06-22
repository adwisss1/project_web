<?php
session_start();
require_once __DIR__ . '/../../config/config.php';
include __DIR__ . '/header.php';

// Ambil data pengurus untuk dropdown PJ Pengurus
$pengurus_result = $mysqli->query("SELECT id_pengurus, nama_pengurus FROM pengurus");

// Ambil data anggota untuk cari ketua panitia
$anggota_result = $mysqli->query("SELECT id, nama FROM anggota");

$error = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_program = trim($_POST["nama_program"]);
    $tanggal_mulai = $_POST["tanggal_mulai"];
    $tanggal_selesai = $_POST["tanggal_selesai"];
    $tanggal_selesai_agenda = $_POST["tanggal_selesai_agenda"];
    $deskripsi = trim($_POST["deskripsi"]);
    $pj_pengurus = intval($_POST["pj_pengurus"]);
    $ketua_panitia = intval($_POST["ketua_panitia"]);
    $status = trim($_POST["status"]);

    if ($nama_program && $tanggal_mulai && $tanggal_selesai && $pj_pengurus && $ketua_panitia) {
        $stmt = $mysqli->prepare("INSERT INTO program_kerja (nama_program, tanggal_mulai, tanggal_selesai, tanggal_selesai_agenda, deskripsi, pj_pengurus, ketua_panitia, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssiis", $nama_program, $tanggal_mulai, $tanggal_selesai, $tanggal_selesai_agenda, $deskripsi, $pj_pengurus, $ketua_panitia, $status);
        if ($stmt->execute()) {
            header("Location: kontrol_program.php");
            exit();
        } else {
            $error = "Gagal menambah program kerja.";
        }
        $stmt->close();
    } else {
        $error = "Semua field wajib diisi.";
    }
}
?>

<h2>Tambah Program Kerja Baru</h2>
<?php if ($error): ?><div style="color:red"><?= htmlspecialchars($error) ?></div><?php endif; ?>
<form method="POST">
    Nama Program: <input type="text" name="nama_program" required><br>
    Tanggal Mulai: <input type="date" name="tanggal_mulai" required><br>
    Tanggal Selesai: <input type="date" name="tanggal_selesai" required><br>
    Tanggal Selesai Agenda: <input type="date" name="tanggal_selesai_agenda"><br>
    Deskripsi: <textarea name="deskripsi"></textarea><br>
    PJ Pengurus:
    <select name="pj_pengurus" required>
        <option value="">-- Pilih Pengurus --</option>
        <?php
        $pengurus_result->data_seek(0);
        while ($pengurus = $pengurus_result->fetch_assoc()) {
            echo '<option value="'.$pengurus['id_pengurus'].'">'.htmlspecialchars($pengurus['nama_pengurus']).'</option>';
        }
        ?>
    </select><br>
    Ketua Panitia:
    <input type="hidden" name="ketua_panitia" id="ketua_panitia">
    <input type="text" id="nama_ketua_panitia" readonly>
    <button type="button" onclick="openCariKetua()">Cari</button><br>
    Status: <input type="text" name="status" value="Perencanaan"><br>
    <button type="submit">Tambah Program</button>
</form>
<a href="kontrol_program.php">Kembali</a>

<!-- Modal cari anggota -->
<div id="modalCariKetua" style="display:none; position:fixed; left:0; top:0; width:100vw; height:100vh; background:rgba(0,0,0,0.3); z-index:1000;">
    <div style="background:#fff; margin:50px auto; padding:20px; width:400px; max-height:80vh; overflow:auto; border-radius:8px; position:relative;">
        <h3>Pilih Ketua Panitia</h3>
        <input type="text" id="searchAnggota" placeholder="Cari nama anggota..." onkeyup="filterAnggota()">
        <ul id="listAnggota" style="list-style:none; padding:0; max-height:300px; overflow:auto;">
            <?php
            $anggota_result->data_seek(0);
            while ($anggota = $anggota_result->fetch_assoc()) {
                echo '<li><a href="#" onclick="pilihKetua('.$anggota['id'].', \''.htmlspecialchars($anggota['nama'], ENT_QUOTES).'\');return false;">'.htmlspecialchars($anggota['nama']).'</a></li>';
            }
            ?>
        </ul>
        <button onclick="closeCariKetua()">Tutup</button>
    </div>
</div>

<script>
function openCariKetua() {
    document.getElementById('modalCariKetua').style.display = 'block';
}
function closeCariKetua() {
    document.getElementById('modalCariKetua').style.display = 'none';
}
function pilihKetua(id, nama) {
    document.getElementById('ketua_panitia').value = id;
    document.getElementById('nama_ketua_panitia').value = nama;
    closeCariKetua();
}
function filterAnggota() {
    var input = document.getElementById('searchAnggota').value.toLowerCase();
    var ul = document.getElementById('listAnggota');
    var lis = ul.getElementsByTagName('li');
    for (var i = 0; i < lis.length; i++) {
        var a = lis[i].getElementsByTagName('a')[0];
        if (a.innerHTML.toLowerCase().indexOf(input) > -1) {
            lis[i].style.display = "";
        } else {
            lis[i].style.display = "none";
        }
    }
}
</script>

<?php include __DIR__ . '/../footer.php'; ?>