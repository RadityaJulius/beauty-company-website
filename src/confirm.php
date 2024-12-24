<?php
include '../db_connection.php';

$id = $_GET['id'];

$result = $conn->query("SELECT * FROM costumer WHERE id=$id");

$resultData = $result->fetch_assoc();

date_default_timezone_set('Asia/Jakarta');

$name = $resultData['nama'];
$amount = $resultData['harga'];
$treatment = $resultData['nama_treatment'];
$treatmentDate = $resultData['tanggal_treatment'];
$paymentDate = date('Y-m-d H:i:s');

$insert_query = "INSERT INTO revenue (payment_date, amount, name, treatment, treatment_date)
                 VALUES ('$paymentDate', '$amount', '$name', '$treatment', '$treatmentDate')";

$delete_query = "DELETE FROM costumer WHERE id=$id";

try {
    $conn->query($insert_query);
    $conn->query($delete_query);
    echo "<script>alert('Confirmed!'); window.location.href = '../public/admin.php';</script>";
}

//catch exception
catch (Exception $e) {
    echo 'Message: ' . $e->getMessage();
}



?>