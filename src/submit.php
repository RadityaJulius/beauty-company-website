<?php
// Include file untuk koneksi ke database
include '../db_connection.php';

// Cek apakah form sudah disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $nomor_hp = mysqli_real_escape_string($conn, $_POST['nomor_hp']);
    $alamat = mysqli_real_escape_string($conn, $_POST['alamat']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $treatment_id = mysqli_real_escape_string($conn, $_POST['treatment_id']);
    $tanggal_treatment = mysqli_real_escape_string($conn, $_POST['tanggal_treatment']);

    // Query untuk mendapatkan harga treatment
    $query = "SELECT harga, nama_treatment FROM treatment WHERE kode = '$treatment_id'";
    $result = $conn->query($query);
    $row = $result->fetch_assoc();
    $harga = $row['harga'];
    $nama_treatment = $row['nama_treatment'];

    // Query untuk memasukkan data booking ke dalam tabel costumer
    $insert_query = "INSERT INTO costumer (nama, nomor_hp, alamat, email, treatment_id, harga, tanggal_treatment, nama_treatment) 
                     VALUES ('$nama', '$nomor_hp', '$alamat', '$email', '$treatment_id', '$harga', '$tanggal_treatment', '$nama_treatment')";

    // Eksekusi query
    if ($conn->query($insert_query) === TRUE) {
        // Jika berhasil, alihkan ke halaman konfirmasi atau halaman lainnya
        echo "<script>alert('Booking berhasil!'); window.location.href = '../public/dashboard.php';</script>";
    } else {
        // Jika terjadi error
        echo "Error: " . $insert_query . "<br>" . $conn->error;
    }
}
?>