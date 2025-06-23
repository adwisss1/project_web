<?php include __DIR__ . '/../header.php'; ?>

<div class="layout-wrapper">
    <?php include 'sidebar_anggota.html'; ?>
    <div class="main-content">
        <div class="content">
            <h2>Enroll Minat Bakat Baru</h2>

            <form method="POST" class="form-warna" >
                <label for="bidang_minat">Pilih Minat Bakat:</label>
                <select name="bidang_minat" id="bidang_minat" required>
                    <?php while ($minat = $minat_query->fetch_assoc()) { ?>
                        <option value="<?= $minat["id_minat_bakat"]; ?>"><?= htmlspecialchars($minat["nama_minat_bakat"]); ?></option>
                    <?php } ?>
                </select>

                <label for="enrollment_key">Masukkan Enrollment Key:</label>
                <input type="text" name="enrollment_key" required>

                <button type="submit" class="button">Enroll</button>
            </form>

            <?php if (isset($error_message)) { echo "<p style='color:red;'>$error_message</p>"; } ?>
            <form action="beranda_anggota.php" method="get" style="display:inline;">
                <button type="submit" class="button">Kembali ke Dashboard</button>
            </form>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../footer.php'; ?>

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