<?php
require 'config.php';
$karyawan = query("SELECT * FROM absen_keluar");
session_start();

// Cek apakah user yang login adalah admin
if ($_SESSION['user_role'] === 'user') {
    // Jika admin mencoba mengakses halaman absensi, redirect ke halaman admin
    header("Location: user_dashboard.php");
    exit;
}
if (isset($_POST["cari"])) {
    $karyawan = cari($_POST["keyword"]);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Absensi keluar</title>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Sembunyikan elemen-elemen selain tabel saat print */
        @media print {
            body * {
                visibility: hidden;
            }

            table,
            table * {
                visibility: visible;
            }

            table {
                position: absolute;
                left: 0;
                top: 0;
            }
        }
    </style>
</head>

<body>
    <header>
        <div class="app-bar">
            <div class="app-bar-logo">
                <img src="path-to-logo.png" alt="Dashboard-Logo">
                <span>Daftar Absensi keluar</span>
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
                        <li><a href="admin_dashboard.php"><i class="fas fa-home"></i> Home</a></li>
                        <li><a href="daftar_karyawan.php"><i class="fas fa-list"></i> Daftar karyawan</a></li>
                        <li><a href="daftar_absen_masuk.php"><i class="fas fa-list"></i> Daftar Absensi masuk </a></li>
                        <li><a href="daftar_absen_keluar.php"><i class="fas fa-list"></i> Daftar Absensi Keluar </a></li>
                        <li><a href="logout.php"><i class="fas fa-sign-out"></i> Logout </a></li>
                    </ul>
                </nav>
            </aside>
            <main id="main-content">
                <center>
                    <h2>Daftar Absensi keluar</h2>
                </center><br />
                <form action="" method="post">
                    <!-- autofocus berfungsi sbg memberikan fokus otomatis 
      pada elemen tersebut saat halaman web dimuat -->
                    <!-- hal baru: "autofocus, autocomplete, placeholder" -->
                    <input type="text" name="keyword" size="40" autofocus
                        placeholder="keluarkan keyword pencarian.." autocomplete="off">
                    <button type="submit" name="cari">Cari!</button>
                </form><br>
                <button class="print-button" onclick="printPage()">Print untuk laporan</button>

                <table border="1" cellpadding="10" cellspacing="0">
                    <tr>
                        <th>No.</th>
                        <th>Nama</th>
                        <th>NIK</th>
                        <th>Jabatan</th>
                        <th>Gambar</th>
                        <th>Jam keluar</th>
                    </tr>

                    <?php $i = 1; ?>
                    <?php foreach ($karyawan as $row) : ?>
                        <tr>
                            <td><?= $i; ?> </td>
                            <td><?= htmlspecialchars($row["full_name"]); ?></td>
                            <td><?= htmlspecialchars($row["nik"]); ?></td>
                            <td><?= htmlspecialchars($row["jabatan"]); ?></td>
                            <td><img src="<?= 'absen-keluar-lokal/' . htmlspecialchars($row["gambar"]); ?>" alt="Absensi Image" width="100"></td>
                            <td><?= htmlspecialchars($row["jam_keluar"]); ?></td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>

                </table>


            </main>
        </div>
    </main>
    <script>
        function printPage() {
            window.print();
        }
    </script>

    <script src="js/index.js"></script>
</body>

</html>