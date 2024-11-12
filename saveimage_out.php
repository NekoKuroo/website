<?php
require_once('config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nik = $_POST['nik'];
    $full_name = $_POST['full_name'];
    $jabatan = $_POST['jabatan'];


    // Set random name for the image, used time() for uniqueness
    $filename = time() . '.jpg';
    $filepath = 'absen-keluar-lokal/'; //file tersimpan di direktori lokal

    if (!is_dir($filepath)) {
        mkdir($filepath, 0777, true);
    }

    // Mengambil data gambar dari input hidden
    $img = $_POST['image_data'];
    $img = str_replace('data:image/jpeg;base64,', '', $img);
    $img = str_replace(' ', '+', $img);
    $data = base64_decode($img);

    // Simpan gambar ke direktori
    file_put_contents($filepath . $filename, $data);

    // Simpan data ke database menggunakan ON DUPLICATE KEY UPDATE
    $sql = "INSERT INTO absen_keluar (nik, full_name, jabatan, gambar) 
            VALUES ('$nik', '$full_name', '$jabatan', '$filename')
            ON DUPLICATE KEY UPDATE 
                full_name = '$full_name', 
                jabatan = '$jabatan', 
                gambar = '$filename'";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "
            <script>
                alert('Data berhasil disimpan atau diperbarui!');
                document.location.href = 'user_dashboard.php';
            </script>
        ";
    } else {
        echo "Gagal menyimpan atau memperbarui data.";
    }
}
