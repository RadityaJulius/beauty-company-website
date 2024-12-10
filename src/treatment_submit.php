<?php
include '../db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $nama = mysqli_real_escape_string($conn, $_POST['name']);
    $harga = mysqli_real_escape_string($conn, $_POST['price']);
    $durasi = mysqli_real_escape_string($conn, $_POST['durasi']);
    $description = mysqli_real_escape_string($conn, $_POST['deskripsi']);

    // Query untuk memasukkan data booking ke dalam tabel costumer
    $insert_query = "INSERT INTO treatment (nama_treatment, harga, deskripsi, durasi) 
                     VALUES ('$nama', '$harga', '$description', '$durasi')";

    // Eksekusi query
    if ($conn->query($insert_query) === TRUE) {
        // Jika berhasil, alihkan ke halaman konfirmasi atau halaman lainnya
        echo "<script>alert('Berhasil ditambahkan!'); window.location.href = '../public/admin.php';</script>";
    } else {
        // Jika terjadi error
        echo "Error: " . $insert_query . "<br>" . $conn->error;
    }
}
?>