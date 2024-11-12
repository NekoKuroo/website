<?php
require 'config.php';

session_start();

// Pastikan pengguna sudah login
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

// Cek apakah user yang login adalah 'user' (karyawan)
if ($_SESSION['user_role'] !== 'user') {
    // Jika bukan karyawan, redirect ke dashboard admin
    header("Location: admin_dashboard.php");
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
    <title>HomePage user</title>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>

<body>
    <header>
        <div class="app-bar">
            <div class="app-bar-logo">
                <img src="path-to-logo.png" alt="Dashboard-Logo">
                <span>Dashboard user</span>
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
                        <li><a href="absensi.php"><i class="fas fa-list"></i> absensi</a></li>
                        <li><a href="logout.php"><i class="fas fa-sign-out"></i> Logout </a></li>
                    </ul>
                </nav>
            </aside>

            <main id="main-content">
                <center>
                    <h2>Welcome to the Halaman, <?= $full_name ?></h2>

                </center>
                <section id="absensi">
                    <button onclick="window.location.href = 'absensi.php';">
                        <h1><i class="fas fa-list"></i> Absensi</h1>
                    </button>
                    <p>Here you can check the attandance.</p>
                </section>
                <section id="logout">
                    <button>
                        <h1><a href='logout.php'>Logout</a></h1>
                    </button>
                    <p>Here are for logout.</p>
                </section>
            </main>

        </div>
    </main>




    <script src="js/index.js"></script>
</body>

</html>