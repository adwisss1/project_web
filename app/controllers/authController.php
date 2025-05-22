<?php
session_start();
require_once __DIR__ . '/../config/config.php';

// Proses Login
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Cek database dengan mengambil id, username, dan role
    $stmt = $mysqli->prepare("SELECT id, username, role FROM users WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        // Simpan session dengan ID
        $_SESSION["id"] = $user["id"]; // ID user
        $_SESSION["user"] = $user["username"]; // Username
        $_SESSION["role"] = $user["role"]; // Role pengguna

        // Redirect sesuai role
        if ($_SESSION["role"] === "anggota") {
            header("Location: ../views/beranda_anggota.php");
        } elseif ($_SESSION["role"] === "pengurus") {
            header("Location: ../views/dashboard_pengurus.php");
        } else {
            header("Location: ../views/beranda.php");
        }
        exit();
    } else {
        echo "<p style='color: red;'>Username atau password salah!</p>";
    }
}

// Proses Logout
if (isset($_GET["logout"])) {
    session_unset();
    session_destroy();
    header("Location: ../views/beranda.php");
    exit();
}
?>
