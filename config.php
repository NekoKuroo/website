<?php


$conn = mysqli_connect("localhost", "root", "", "multiuser");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

function query($query)
{
    global $conn;
    $hasil = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($hasil)) {
        $rows[] = $row;
    }
    return $rows;
}

// registrasi
function registrasi($tersimpan)
{
    global $conn;

    $full_name = strtolower(stripslashes($tersimpan["full_name"]));
    $nik = strtolower(stripslashes($tersimpan["nik"]));
    $password = mysqli_real_escape_string($conn, $tersimpan["password"]);
    $password2 = mysqli_real_escape_string($conn, $tersimpan["password2"]);
    $jabatan = strtolower(stripslashes($tersimpan["jabatan"]));
    $user_role = strtolower(stripslashes($tersimpan["user_role"]));


    $hasil = mysqli_query($conn, "SELECT full_name FROM users WHERE 
                            full_name = '$full_name'");


    //cek username & nik
    if (mysqli_fetch_assoc($hasil)) {
        echo "<script>
            alert('username atau nik sudah terdaftar');
            </script>";
        return false;
    }

    //cek konfirmasi password
    if ($password !== $password2) {
        echo "<script>
            alert('konfirmasi password tidak sesuai');
          </script>";
        return false;
    }
    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    //tambahkan userbaru ke database
    mysqli_query($conn, "INSERT INTO users VALUES
                    ('','$full_name','$nik','$jabatan','$password','$user_role')");

    return mysqli_affected_rows($conn);
}

function hapus($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM users WHERE id = $id");

    return mysqli_affected_rows($conn);
}

function ubah($ubah)
{
    global $conn;

    $id = $ubah["id"];
    $full_name = htmlspecialchars($ubah["full_name"]);
    $nik = htmlspecialchars($ubah["nik"]);
    $jabatan = htmlspecialchars($ubah["jabatan"]);
    $user_role = htmlspecialchars($ubah["user_role"]);

    //query ubah data
    $hasil = "UPDATE users SET 
                full_name = '$full_name',
                nik = '$nik',
                jabatan = '$jabatan',
                user_role = '$user_role'
                WHERE id = '$id'";

    mysqli_query($conn, $hasil);

    return mysqli_affected_rows($conn);
}

function tambah($ditambah)
{
    global $conn;

    $full_name = strtolower(stripslashes($ditambah["full_name"]));
    $nik = strtolower(stripslashes($ditambah["nik"]));
    $password = mysqli_real_escape_string($conn, $ditambah["password"]);
    $password2 = mysqli_real_escape_string($conn, $ditambah["password2"]);
    $jabatan = strtolower(stripslashes($ditambah["jabatan"]));
    $user_role = strtolower(stripslashes($ditambah["user_role"]));


    $hasil = mysqli_query($conn, "SELECT full_name FROM users WHERE 
                            full_name = '$full_name'");


    //cek username & nik
    if (mysqli_fetch_assoc($hasil)) {
        echo "<script>
            alert('username atau nik sudah terdaftar');
            </script>";
        return false;
    }

    //cek konfirmasi password
    if ($password !== $password2) {
        echo "<script>
            alert('konfirmasi password tidak sesuai');
          </script>";
        return false;
    }
    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    //tambahkan userbaru ke database
    mysqli_query($conn, "INSERT INTO users VALUES
                    ('','$full_name','$nik','$jabatan','$password','$user_role')");

    return mysqli_affected_rows($conn);
}

function cari($keyword)
{
    $query = "SELECT * FROM absen_masuk WHERE 
                full_name LIKE '%$keyword%' OR  
                nik LIKE '%$keyword%'  
                ";
    return query($query);
}

function cari2($keyword)
{
    $query = "SELECT * FROM users WHERE 
                full_name LIKE '%$keyword%' OR  
                nik LIKE '%$keyword%'  
                ";
    return query($query);
}
