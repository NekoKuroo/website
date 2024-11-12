<?php
session_start();
require 'config.php';
if (isset($_POST["login"])) {
    $full_name = $_POST["full_name"];
    $password = $_POST["password"];

    $hasil = mysqli_query($conn, "SELECT * FROM users WHERE 
        full_name = '$full_name'");

    //cek username
    if (mysqli_num_rows($hasil) === 1) {
        $row = mysqli_fetch_assoc($hasil);

        //cek password
        if (password_verify($password, $row["password"])) {
            $_SESSION['full_name'] = $row['full_name'];
            $_SESSION['nik'] = $row['nik'];
            $_SESSION['jabatan'] = $row['jabatan'];
            $_SESSION['user_role'] = $row['user_role'];

            // Tandai bahwa pengguna sudah login
            $_SESSION["login"] = true;

            // Redirect sesuai role user
            if ($row['user_role'] == 'admin') {
                header("Location: admin_dashboard.php");
            } else {
                header("Location: user_dashboard.php");
            }
            exit;
        } else {
            $error = true; // Jika password salah
        }
    } else {
        $error = true; // Jika username tidak ditemukan
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" type="text/css" href="./style/login.css">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>

<body>
    <?php if (isset($error)) : ?>
        <p style="color: red; font-style: italic;">username / password salah</p>
    <?php endif; ?>


    <form action="" method="post">
        <h2>Login</h2>
        <ul>
            <li>
                <label for="full_name">Nama lengkap : </label>
                <input type="text" name="full_name" id="full_name" required>
            </li>
            <li>
                <label for="password">password : </label>
                <input type="password" name="password" id="password" required>
            </li>
            <li>
                <button type="submit" name="login">Login</button>
            </li>
        </ul>

    </form>
</body>

</html>