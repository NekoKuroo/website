<?php
require 'config.php';

session_start();
if (!isset($_SESSION['full_name'])) {
    header("Location: login.php");
    exit;
}

// SOLUSI AGAR ROLE ADMIN TIDAK BISA KE HALAMAN USER_DASHBOARD.PHP & ABSENSI.PHP SUDAH CLEAR (BERHASIL), TINGGAL BEBERAPA LAGI YG BUTUH

// Cek apakah user yang login adalah admin
if ($_SESSION['user_role'] === 'admin') {
    // Jika admin mencoba mengakses halaman absensi, redirect ke halaman admin
    header("Location: admin_dashboard.php");
    exit;
}

$nik = $_SESSION['nik'];
$full_name = $_SESSION['full_name'];
$jabatan = $_SESSION['jabatan'];

?>
<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="style/style.css">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absensi</title>

</head>

<body>
    <header>
        <div class="app-bar">
            <div class="app-bar-logo">
                <img src="path-to-logo.png" alt="Dashboard Logo">
                <span>Halaman Absensi</span>
            </div>
        </div>
    </header>

    <main class="content-main">
        <div class="container">
            <aside class="sidebar" id="sidebar">
                <nav>
                    <div id="clock">
                        <h1 id="date-time"></h1>
                    </div>
                    <h3>Menu</h3>
                    <ul>
                        <li><a href="user_dashboard.php">Home</a></li>
                        <li><a href="#"><i class="fas fa-calendar-alt"></i> Absensi</a></li>
                        <li><a href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a></li>
                    </ul>
                </nav>
            </aside>

            <div id="my_camera"></div>
            <form method="POST" enctype="multipart/form-data">
                <label for="nik">NIK:</label><br>
                <input type="text" id="nik" name="nik" value="<?= $nik ?>" readonly><br>

                <label for="full_name">Fullname:</label><br>
                <input type="text" id="full_name" name="full_name" value="<?= $full_name ?>" readonly><br>

                <label for="jabatan">Jabatan:</label><br>
                <input type="text" id="jabatan" name="jabatan" value="<?= $jabatan ?>" readonly><br>

                <input type="hidden" id="image_data" name="image_data">



                <button type="submit" formaction="saveimage_in.php" onclick="take_snapshot()">
                    <h1><i class="fas fa-sign-out"></i> Absen Masuk</h1>
                </button>
                <button type="submit" formaction="saveimage_out.php" onclick="take_snapshot()">
                    <h1><i class="fas fa-sign-out"></i> Absen keluar</h1>
                </button>
            </form>
        </div>
    </main>
    <script type="text/javascript" src="./js/webcam.min.js"></script>
    <script src="./js/index.js"></script>
</body>

</html>