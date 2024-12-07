<?php
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $custName = mysqli_real_escape_string($conn, $_POST['custName']);

    $insert_query = "DELETE FROM costumer WHERE nama = '$custName'";
    if ($conn->query($insert_query) === TRUE) {
        echo "<script>alert('Delete berhasil!'); window.location.href = 'admin.php';</script>";
    } else {
        echo "Error: " . $insert_query . "<br>" . $conn->error;
    }

}
?>