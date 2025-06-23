<?php
if (session_status() === PHP_SESSION_NONE) session_start();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Sanggar Birama</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://localhost/SI-BIRAMA/public/css/style.css">
</head>
<body style="background-image: url('/SI-BIRAMA/public/images/background2.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat; background-attachment: fixed; min-height: 100vh;">
    <!-- Navbar dengan container dan background sendiri -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="/SI-BIRAMA/public/images/logo_noback.jpg" alt="Logo Sanggar Birama" style="height:38px; margin-right:10px; vertical-align:middle;">
            Sanggar Birama
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/SI-BIRAMA/app/controllers/beranda.php">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/SI-BIRAMA/app/controllers/portofolio.php">Portofolio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/SI-BIRAMA/app/controllers/formSewa.php">Penyewaan Alat & Kostum</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/SI-BIRAMA/app/controllers/bookTalent.php">Penyewaan Talent</a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <?php if (isset($_SESSION["user"])): ?>
                            <a class="btn btn-outline-danger" href="/SI-BIRAMA/app/controllers/authController.php?logout=true">Logout</a>
                        <?php else: ?>
                            <a class="btn btn-outline-primary" href="/SI-BIRAMA/app/views/login.php">Login</a>
                        <?php endif; ?>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Header Selamat Datang -->
    <div class="header-welcome" style="padding-top:70px; text-align:center; color:#fff; text-shadow:0 2px 8px #000;">
        <h1>Selamat Datang di Website Sanggar Birama</h1>
    </div>
</body>
</html>