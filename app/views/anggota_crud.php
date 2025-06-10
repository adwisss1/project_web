<?php
// filepath: d:\dari c\2Xampp\instal\htdocs\SI-BIRAMA\app\views\anggota_crud.php
session_start();
require_once __DIR__ . '/../config/config.php';

if (!isset($_SESSION["user"]) || $_SESSION["role"] !== "pengurus") {
    header("Location: ../login.php");
    exit();
}

$mode = $_GET['mode'] ?? 'add';
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$error = '';
$success = '';

// Ambil data minat bakat untuk dropdown
$minat_result = $mysqli->query("SELECT id_minat_bakat, nama_minat_bakat FROM minat_bakat");

// Untuk edit, ambil data anggota
$nama = $nra = $angkatan = $id_minat_bakat = '';
if ($mode === 'edit' && $id) {
    $stmt = $mysqli->prepare("SELECT nama, nra, angkatan FROM anggota WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($nama, $nra, $angkatan);
    $stmt->fetch();
    $stmt->close();
    if (!$nama) {
        echo "Anggota tidak ditemukan.";
        exit();
    }
    // Ambil minat bakat dari tabel relasi
    $id_minat_bakat = '';
    $stmt = $mysqli->prepare("SELECT id_minat_bakat FROM anggota_minat_bakat WHERE id_anggota = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($id_minat_bakat);
    $stmt->fetch();
    $stmt->close();
}

// Proses tambah/edit
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($mode === 'add' || $mode === 'edit')) {
    $nama = trim($_POST['nama']);
    $nra = trim($_POST['nra']);
    $angkatan = intval($_POST['angkatan']);
    $id_minat_bakat = intval($_POST['id_minat_bakat']);

    if ($mode === 'add') {
        // --- PERUBAHAN: Buat user baru sekalian tambah anggota ---
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        // Validasi username dan password
        if ($username === '' || $password === '') {
            $error = "Username dan password harus diisi.";
        } else {
            // Cek username unik
            $cek = $mysqli->prepare("SELECT COUNT(*) FROM users WHERE username=?");
            $cek->bind_param("s", $username);
            $cek->execute();
            $cek->bind_result($sudah_ada);
            $cek->fetch();
            $cek->close();
            if ($sudah_ada > 0) {
                $error = "Username sudah digunakan.";
            } else {
                // Insert user baru
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $mysqli->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, 'anggota')");
                $stmt->bind_param("ss", $username, $hash);
                if ($stmt->execute()) {
                    $user_id = $stmt->insert_id;
                    $stmt->close();
                    // Insert anggota
                    $stmt = $mysqli->prepare("INSERT INTO anggota (user_id, nama, nra, angkatan) VALUES (?, ?, ?, ?)");
                    $stmt->bind_param("issi", $user_id, $nama, $nra, $angkatan);
                    if ($stmt->execute()) {
                        $id_anggota = $stmt->insert_id;
                        $stmt->close();
                        // Insert ke tabel relasi anggota_minat_bakat
                        $stmt = $mysqli->prepare("INSERT INTO anggota_minat_bakat (id_anggota, id_minat_bakat) VALUES (?, ?)");
                        $stmt->bind_param("ii", $id_anggota, $id_minat_bakat);
                        $stmt->execute();
                        $stmt->close();
                        header("Location: manajemen_anggota_kinerja.php");
                        exit();
                    } else {
                        $error = "Gagal menambah anggota.";
                        $stmt->close();
                    }
                } else {
                    $error = "Gagal membuat user baru.";
                }
            }
        }
    } elseif ($mode === 'edit') {
        $stmt = $mysqli->prepare("UPDATE anggota SET nama=?, nra=?, angkatan=? WHERE id=?");
        $stmt->bind_param("ssii", $nama, $nra, $angkatan, $id);
        if ($stmt->execute()) {
            $stmt->close();
            // Update minat bakat di tabel relasi
            $stmt = $mysqli->prepare("UPDATE anggota_minat_bakat SET id_minat_bakat=? WHERE id_anggota=?");
            $stmt->bind_param("ii", $id_minat_bakat, $id);
            $stmt->execute();
            $stmt->close();
            header("Location: manajemen_anggota_kinerja.php");
            exit();
        } else {
            $error = "Gagal mengubah data anggota.";
            $stmt->close();
        }
    }
}

// Proses hapus
if ($mode === 'delete' && $id) {
    // Hapus relasi minat bakat dulu
    $stmt = $mysqli->prepare("DELETE FROM anggota_minat_bakat WHERE id_anggota = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    // Hapus anggota
    $stmt = $mysqli->prepare("DELETE FROM anggota WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    header("Location: manajemen_anggota_kinerja.php");
    exit();
}
?>

<?php include __DIR__ . '/header.php'; ?>

<a href="manajemen_anggota_kinerja.php">Kembali ke Manajemen Anggota</a>
<h2>
    <?php
    if ($mode === 'add') echo "Tambah Anggota";
    elseif ($mode === 'edit') echo "Edit Anggota";
    elseif ($mode === 'delete') echo "Hapus Anggota";
    ?>
</h2>
<?php if ($error): ?><div style="color:red"><?= htmlspecialchars($error) ?></div><?php endif; ?>

<?php if ($mode === 'add' || $mode === 'edit'): ?>
<form method="post">
    <?php if ($mode === 'add'): ?>
        Username: <input type="text" name="username" required><br>
        Password: <input type="password" name="password" required><br>
    <?php endif; ?>
    Nama: <input type="text" name="nama" value="<?= htmlspecialchars($nama) ?>" required><br>
    NRA: <input type="text" name="nra" value="<?= htmlspecialchars($nra) ?>" required><br>
    Angkatan: <input type="number" name="angkatan" value="<?= htmlspecialchars($angkatan) ?>" required><br>
    Minat Bakat:
    <select name="id_minat_bakat" required>
        <option value="">-- Pilih --</option>
        <?php
        $minat_result->data_seek(0);
        while ($minat = $minat_result->fetch_assoc()) { ?>
            <option value="<?= $minat['id_minat_bakat'] ?>" <?= $id_minat_bakat == $minat['id_minat_bakat'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($minat['nama_minat_bakat']) ?>
            </option>
        <?php } ?>
    </select><br>
    <button type="submit"><?= $mode === 'add' ? 'Tambah' : 'Simpan' ?></button>
</form>
<?php endif; ?>

<?php include __DIR__ . '/footer.php'; ?>