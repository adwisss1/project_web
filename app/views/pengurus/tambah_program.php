<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Program Kerja</title>
    <link rel="stylesheet" href="/SI-BIRAMA/public/css/style.css">
</head>
<body>
<div class="layout-wrapper">
    <?php include 'sidebar_pengurus.html'; ?>
    <div class="main-content">
        <div class="content">
            <h2>Tambah Program Kerja Baru</h2>
            <?php if ($error): ?><div style="color:red"><?= htmlspecialchars($error) ?></div><?php endif; ?>
            <form method="POST" class="form-warna" >
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
                <button class="button"  type="submit">Tambah Program</button>
            </form>
            <a href="kontrol_program.php" class="button" >Kembali</a>

            <!-- Modal cari anggota -->
            <div id="modalCariKetua" style="display:none; position:fixed; left:0; top:0; width:100vw; height:100vh; background:rgba(0,0,0,0.3); z-index:1000;">
            <div style="background:#fff; margin:50px auto; padding:20px; width:400px; max-height:80vh; overflow:auto; border-radius:8px; position:relative;">
                <h3>Pilih Ketua Panitia</h3>
                <input type="text" id="searchAnggota" placeholder="Cari nama anggota..." onkeyup="filterAnggota()">
                <ul id="listAnggota" style="list-style:none; padding:0; max-height:300px; overflow:auto;">
                    <?php
                    $anggota_result->data_seek(0);
                    while ($anggota = $anggota_result->fetch_assoc()) {
                        // Ubah dari button ke link/list biasa
                        echo '<li style="margin-bottom:8px;"><p style="margin:0;cursor:pointer;" onclick="pilihKetua('.$anggota['id'].', \''.htmlspecialchars($anggota['nama'], ENT_QUOTES).'\')">'.htmlspecialchars($anggota['nama']).'</p></li>';
                    }
                    ?>
                </ul>
                <button class="button" onclick="closeCariKetua()">Tutup</button>
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
        </div>
    </div>
</div>
<?php include __DIR__ . '/../footer.php'; ?>
</body>
</html>