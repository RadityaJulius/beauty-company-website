<?php
include '../db_connection.php';

if (isset($_GET['kode'])) {
    $kode = $_GET['kode'];

    $sql = "DELETE FROM treatment WHERE kode=$kode";
    $conn->query($sql);

    header("location: ../public/treatment.php");
    exit;
}

?>