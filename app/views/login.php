<?php
include 'header_beranda.php';
if (session_status() === PHP_SESSION_NONE) session_start();
require_once __DIR__ . '/../config/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Ambil data dari database dengan ID
    $stmt = $mysqli->prepare("SELECT id, username, role FROM users WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        $_SESSION["user"] = [
            "id" => $user["id"],
            "username" => $user["username"],
            "role" => $user["role"]
        ];
        $_SESSION["role"] = $user["role"]; // Simpan role pengguna

        // Redirect sesuai role
            if ($_SESSION["role"] === "anggota") {
                header("Location: /SI-BIRAMA/app/views/anggota/beranda_anggota.php");
                exit();
            } elseif ($_SESSION["role"] === "pengurus") {
                header("Location: /SI-BIRAMA/app/controllers/pengurus/beranda_pengurus.php");
                exit();
            } else {
                header("Location: /SI-BIRAMA/app/views/tamu/beranda.php");
                exit();
            }
    } else {
        echo "<p style='color: red;'>Username atau password salah!</p>";
    }
}
?>

<body>
    <div class="main-content">
        <div class="container" style="max-width:600px; margin-top:100px;">
            <div class="alert alert-info text-justify mb-4" role="alert">
                Username dan password ada di informasi pasca penerimaan yang diberikan oleh pengurus UKM Seni dan Budaya. Jika belum mendaftar silahkan lakukan pendaftaran dan ikuti skema penerimaan sesuai dengan jadwal dan ketentuan.
            </div>
        <form method="POST" style="margin-bottom: 100px;">
            <h2>Login</h2>
            <label for="username">Username:</label>
            <input type="text" name="username" required>
            
            <label for="password">Password:</label>
            <input type="password" name="password" required>
            
            <button type="submit">Login</button>
        </form>

        </div>
    </div>
    <?php include 'footer.php'; ?>
</body>