<?php
require 'config.php';
session_start();

// Pastikan pengguna sudah login
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

// Cek apakah user yang login adalah 'admin'
if ($_SESSION['user_role'] !== 'admin') {
    // Jika bukan admin, redirect ke dashboard user
    header("Location: user_dashboard.php");
    exit;
}

$full_name = $_SESSION['full_name'];
$user_role = $_SESSION['user_role'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage admin</title>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>

<body>
    <header>
        <div class="app-bar">
            <div class="app-bar-logo">
                <img src="path-to-logo.png" alt="Dashboard-Logo">
                <span>Dashboard Admin</span>
            </div>
        </div>
    </header>
    <main>
        <div class="container">
            <aside class="sidebar" id="sidebar">
                <nav>
                    <div id="clock">
                        <h1 id="date-time"></h1>
                    </div>
                    <h3>Menu</h3>
                    <hr class="sidebar-divider">
                    <ul>
                        <li><a href="#home"><i class="fas fa-home"></i> Home</a></li>
                        <li><a href="daftar_karyawan.php"><i class="fas fa-list"></i> Daftar karyawan</a></li>
                        <li><a href="daftar_absen_masuk.php"><i class="fas fa-list"></i> Daftar Absensi Masuk </a></li>
                        <li><a href="daftar_absen_keluar.php"><i class="fas fa-list"></i> Daftar Absensi Keluar </a></li>
                        <li><a href="logout.php"><i class="fas fa-sign-out"></i> Logout </a></li>
                    </ul>
                </nav>
            </aside>
            <main id="main-content">
                <center>
                    <h2>Welcome to the Halaman Admin
                        <h4>Halo <?= $_SESSION['full_name']; ?></h4>
                </center>

                <section id="employee">
                    <button onclick="window.location.href = 'daftar_karyawan.php';">
                        <h1><i class="fas fa-list"></i> Daftar karyawan</h1>
                    </button>
                    <p>Here you can check employee.</p>
                </section>
                <section id="attandance">
                    <button onclick="window.location.href = 'daftar_absen_masuk.php';">
                        <h1><i class="fas fa-list"></i>Daftar absen masuk</h1>
                    </button>
                    <p>absen masuk disini.</p>
                    <button onclick="window.location.href = 'daftar_absen_keluar.php';">
                        <h1><i class="fas fa-list"></i>Daftar absen keluar</h1>
                    </button>
                    <p>absen keluar disini.</p>
                </section>
                <section id="logout">
                    <button>
                        <h1><a href='logout.php'>Logout</a></h1>
                    </button>
                    <p>Here you can check employee.</p>
                </section>
            </main>
        </div>
    </main>
    <script src="js/index.js"></script>
</body>

</html>