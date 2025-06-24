<?php

session_start();

// Proses Logout (letakkan di paling atas agar tidak terhalang logic lain)
if (isset($_GET["logout"])) {
    session_unset();
    session_destroy();
    header("Location: ../controllers/beranda.php");
    exit();
}

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
        // Simpan session sebagai array (konsisten dengan login.php)
        $_SESSION["user"] = [
            "id" => $user["id"],
            "username" => $user["username"],
            "role" => $user["role"]
        ];
        $_SESSION["role"] = $user["role"];

        // Redirect sesuai role
        if ($user["role"] === "anggota") {
            header("Location: ../views/beranda_anggota.php");
        } elseif ($user["role"] === "pengurus") {
            header("Location: ../views/beranda_pengurus.php");
        } else {
            header("Location: ../views/beranda.php");
        }
        exit();
    } else {
        echo "<p style='color: red;'>Username atau password salah!</p>";
    }
}

// Jika ingin membatasi akses ke halaman khusus pengurus, tambahkan cek role di file view-nya, bukan di controller ini.
?>