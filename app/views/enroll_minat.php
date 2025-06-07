<?php

session_start();
require_once __DIR__ . '/../config/config.php';

if (!isset($_SESSION["user"]) || $_SESSION["user"]["role"] !== "anggota") {
    header("Location: login.php");
    exit();
}

// Ambil semua minat bakat dari database
$minat_query = $mysqli->query("SELECT * FROM minat_bakat");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION["user"]["id"];
    $id_minat_bakat = $_POST["bidang_minat"];
    $enrollment_key = $_POST["enrollment_key"];

    // Validasi enrollment key
    $validasi_query = $mysqli->prepare("SELECT * FROM minat_bakat WHERE id_minat_bakat = ? AND enrollment_key = ?");
    $validasi_query->bind_param("is", $id_minat_bakat, $enrollment_key);
    $validasi_query->execute();
    $result = $validasi_query->get_result();

    if ($result->num_rows > 0) {
        // Cek apakah user sudah pernah enroll minat bakat ini
        $cek = $mysqli->prepare("SELECT * FROM anggota WHERE user_id = ? AND id_minat_bakat = ?");
        $cek->bind_param("ii", $user_id, $id_minat_bakat);
        $cek->execute();
        $cek_result = $cek->get_result();
        if ($cek_result->num_rows > 0) {
            $error_message = "Anda sudah terdaftar pada minat bakat ini.";
        } else {
            // Insert ke tabel anggota (hanya user_id dan id_minat_bakat, kolom lain bisa NULL/default)
            $stmt = $mysqli->prepare("INSERT INTO anggota (user_id, id_minat_bakat, nama, nra, angkatan) VALUES (?, ?, '', '', 0)");
            $stmt->bind_param("ii", $user_id, $id_minat_bakat);
            $stmt->execute();
            header("Location: beranda_anggota.php?success=enrolled");
            exit();
        }
    } else {
        $error_message = "Enrollment key tidak valid!";
    }
}
?>

<?php include 'header.php'; ?>

<div class="content">
    <h2>Enroll Minat Bakat Baru</h2>

    <form method="POST">
        <label for="bidang_minat">Pilih Minat Bakat:</label>
        <select name="bidang_minat" id="bidang_minat" required>
            <?php while ($minat = $minat_query->fetch_assoc()) { ?>
                <option value="<?= $minat["id_minat_bakat"]; ?>"><?= htmlspecialchars($minat["nama_minat_bakat"]); ?></option>
            <?php } ?>
        </select>

        <label for="enrollment_key">Masukkan Enrollment Key:</label>
        <input type="text" name="enrollment_key" required>

        <button type="submit">Enroll</button>
    </form>

    <?php if (isset($error_message)) { echo "<p style='color:red;'>$error_message</p>"; } ?>

    <a href="beranda_anggota.php">Kembali ke Dashboard</a>
</div>

<?php include 'footer.php'; ?>

<script>
function filterMinat() {
    var input, filter, select, options, i;
    input = document.getElementById("search");
    filter = input.value.toUpperCase();
    select = document.getElementById("bidang_minat");
    options = select.getElementsByTagName("option");

    for (i = 0; i < options.length; i++) {
        if (options[i].text.toUpperCase().indexOf(filter) > -1) {
            options[i].style.display = "";
        } else {
            options[i].style.display = "none";
        }
    }
}
</script>