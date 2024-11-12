<?php
require 'config.php';
$karyawan = query("SELECT * FROM users");
session_start();

// Cek apakah user yang login adalah admin
if ($_SESSION['user_role'] === 'user') {
    // Jika admin mencoba mengakses halaman absensi, redirect ke halaman admin
    header("Location: user_dashboard.php");
    exit;
}

if (isset($_POST["cari"])) {
    $karyawan = cari2($_POST["keyword"]);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>list karyawan</title>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>

<body>
    <header>

        <div class="app-bar">
            <div class="app-bar-logo">
                <img src="path-to-logo.png" alt="Dashboard-Logo">
                <span>Daftar Karyawan</span>
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
                        <li><a href="daftar_karyawan.php"><i class="fas fa-list"></i> Daftar Karyawan</a></li>
                        <li><a href="daftar_absen_masuk.php"><i class="fas fa-list"></i> Daftar Absensi Masuk </a></li>
                        <li><a href="daftar_absen_keluar.php"><i class="fas fa-list"></i> Daftar Absensi Keluar </a></li>
                        <li><a href="logout.php"><i class="fas fa-sign-out"></i> Logout </a></li>
                    </ul>
                </nav>
            </aside>

            <main id="main-content">

                <center>
                    <h2>Daftar Karyawan</h2>
                </center>
                <br />
                <form action="" method="post">
                    <!-- autofocus berfungsi sbg memberikan fokus otomatis 
      pada elemen tersebut saat halaman web dimuat -->
                    <!-- hal baru: "autofocus, autocomplete, placeholder" -->
                    <input type="text" name="keyword" size="40" autofocus
                        placeholder="Masukkan keyword pencarian.." autocomplete="off">
                    <button type="submit" name="cari">Cari!</button><br><br>
                </form>
                <a href="tambah.php">Tambah karyawan baru</a><br>

                <table border="1" cellpadding="10" cellspacing="0">
                    <tr>
                        <th>No.</th>
                        <th>Name</th>
                        <th>nik</th>
                        <th>Jabatan</th>
                        <th>Aksi</th>
                    </tr>

                    <?php $i = 1; ?>
                    <?php foreach ($karyawan as $row) : ?>
                        <tr>
                            <td><?= $i; ?> </td>
                            <td><?= $row["full_name"]; ?></td>
                            <td><?= $row["nik"]; ?></td>
                            <td><?= $row["jabatan"]; ?></td>
                            <td>
                                <a href="ubah.php?id=<?= $row["id"]; ?>">ubah data</a> |
                                <a href="hapus.php?id=<?= $row["id"]; ?>" onclick="return confirm('yakin?')">hapus data</a>
                            </td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>

                </table>
            </main>
        </div>
    </main>


    <script src="js/index.js"></script>


</body>

</html>