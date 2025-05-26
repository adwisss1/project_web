<?php
include 'header.php';
session_start();
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
        // Simpan data ke session
        $_SESSION["id"] = $user["id"]; // Tambahkan ID pengguna
        $_SESSION["user"] = $user["username"]; // Hanya username
        $_SESSION["role"] = $user["role"]; // Simpan role pengguna

        // Redirect sesuai role
       if ($_SESSION["role"] === "anggota") {
    header("Location: ../views/beranda_anggota.php");
    exit();
} elseif ($_SESSION["role"] === "pengurus") {
    header("Location: ../views/beranda_pengurus.php"); // Pastikan halaman ini benar
    exit();
} else {
    header("Location: ../views/beranda.php");
    exit();
}
    } else {
        echo "<p style='color: red;'>Username atau password salah!</p>";
    }
}
?>

<form method="POST">
    <h2>Login</h2>
    <label for="username">Username:</label>
    <input type="text" name="username" required>
    
    <label for="password">Password:</label>
    <input type="password" name="password" required>
    
    <button type="submit">Login</button>
</form>
<?php include 'footer.php'; ?>
