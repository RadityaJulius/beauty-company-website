<?php
include '../db_connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM costumer WHERE id=$id";
    $conn->query($sql);
}

header("location: admin.php");
exit;

?>