<?php

require 'config.php';

//ambil data di url
$id = $_GET["id"];

//query data mhs berdasarkan ID
$krywn = query("SELECT * FROM users WHERE id = $id")[0];


//cek apakah tombol submit sudah ditekan / belum
if (isset($_POST["submit"])) {


    //cek apakah data berhasil di tambahkan atau tidak
    if (ubah($_POST) > 0) {
        echo "
            <script>
                    alert('data berhasil diubah!');
                    document.location.href = 'daftar_karyawan.php';
            </script>
        ";
    } else {
        echo "
            <script>
                    alert('data tidak berhasil diubah!');
                    document.location.href = 'daftar_karyawan.php';
            </script>
        ";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" type="text/css" href="./style/login.css">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah data karyawa</title>
    <style>
        label {
            display: block;
        }
    </style>
</head>

<body>

    <form action="" method="post">
        <h1>Ubah data karyawan</h1>
        <input type="hidden" name="id" value="<?= $krywn["id"]; ?>">
        <ul>
            <li>
                <label for="full_name">Nama lengkap : </label>
                <input type="text" name="full_name" id="full_name" value="<?= $krywn["full_name"]; ?>">
            </li>
            <li>
                <label for="nik">nik : </label>
                <input type="text" name="nik" id="nik" value="<?= $krywn["nik"]; ?>">
            </li>
            <li>
                <label for="jabatan">jabatan : </label>
                <input type="text" name="jabatan" id="jabatan" value="<?= $krywn["jabatan"]; ?>">
            </li>

            <input type="hidden" name="user_role" value="user"><br>
            <button type="submit" name="submit">ubah data!</button>
            <h3><a href="daftar_karyawan.php">Back to daftar karyawan</a></h3>
        </ul>



    </form>
</body>

</html>