<?php

require_once __DIR__ . '/../config/config.php';
include __DIR__ . '/header.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id <= 0) {
    die("ID program tidak valid.");
}

$stmt = $mysqli->prepare("SELECT nama_program, tanggal_mulai, tanggal_selesai, deskripsi, pj_pengurus, ketua_panitia, status, tanggal_selesai_agenda FROM program_kerja WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($nama, $mulai, $selesai, $deskripsi, $pj, $ketua, $status, $selesai_agenda);
$stmt->fetch();
$stmt->close();
?>

<h2>Edit Program Kerja</h2>
<form method="POST" action="/SI-BIRAMA/app/controllers/update_program.php">
    <input type="hidden" name="id" value="<?= $id ?>">
    Nama Program: <input type="text" name="nama_program" value="<?= htmlspecialchars($nama) ?>" required><br>
    Tanggal Mulai: <input type="date" name="tanggal_mulai" value="<?= htmlspecialchars($mulai) ?>" required><br>
    Tanggal Selesai: <input type="date" name="tanggal_selesai" value="<?= htmlspecialchars($selesai) ?>" required><br>
    Tanggal Selesai Agenda: <input type="date" name="tanggal_selesai_agenda" value="<?= htmlspecialchars($selesai_agenda) ?>"><br>
    Deskripsi: <textarea name="deskripsi"><?= htmlspecialchars($deskripsi) ?></textarea><br>
    PJ Pengurus: 
    <select name="pj_pengurus" required>
        <option value="">-- Pilih Pengurus --</option>
        <?php
        $pengurus_result = $mysqli->query("SELECT id_pengurus, nama_pengurus FROM pengurus");
        while ($pengurus = $pengurus_result->fetch_assoc()) {
            $selected = ($pengurus['id_pengurus'] == $pj) ? 'selected' : '';
            echo '<option value="'.$pengurus['id_pengurus'].'" '.$selected.'>'.htmlspecialchars($pengurus['nama_pengurus']).'</option>';
        }
        ?>
    </select><br>
    Ketua Panitia: 
    <input type="hidden" name="ketua_panitia" id="ketua_panitia" value="<?= htmlspecialchars($ketua) ?>">
    <input type="text" id="nama_ketua_panitia" value="<?php
        // Ambil nama anggota jika ada id
        $nama_ketua = '';
        if ($ketua) {
            $anggota = $mysqli->query("SELECT nama FROM anggota WHERE id = ".intval($ketua));
            if ($anggota && $row = $anggota->fetch_assoc()) {
                $nama_ketua = $row['nama'];
            }
        }
        echo htmlspecialchars($nama_ketua);
    ?>" readonly>
    <button type="button" onclick="openCariKetua()">Cari</button><br>
    Status: <input type="text" name="status" value="<?= htmlspecialchars($status) ?>"><br>
    <button type="submit">Simpan</button>
</form>
<a href="kontrol_program.php">Kembali</a>

<!-- Modal cari anggota -->
<div id="modalCariKetua" style="display:none; position:fixed; left:0; top:0; width:100vw; height:100vh; background:rgba(0,0,0,0.3); z-index:1000;">
    <div style="background:#fff; margin:50px auto; padding:20px; width:400px; max-height:80vh; overflow:auto; border-radius:8px; position:relative;">
        <h3>Pilih Ketua Panitia</h3>
        <input type="text" id="searchAnggota" placeholder="Cari nama anggota..." onkeyup="filterAnggota()">
        <ul id="listAnggota" style="list-style:none; padding:0; max-height:300px; overflow:auto;">
            <?php
            $anggota_result = $mysqli->query("SELECT id, nama FROM anggota");
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

<?php include __DIR__ . '/footer.php'; ?>