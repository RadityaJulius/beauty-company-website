<?php
include 'db_connection.php';
// Query to fetch data from 'costumer' table
$sql = "SELECT id, nama, nomor_hp, alamat, email, treatment_id, harga, tanggal_treatment, nama_treatment FROM costumer";
$result = $conn->query($sql);

$data = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

// Output data as JSON
header('Content-Type: application/json');
echo json_encode($data);
?>