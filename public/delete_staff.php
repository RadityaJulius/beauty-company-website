<?php
include '../db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil ID staff dari form
    $staffId = $_POST['id'];

    // Query untuk menghapus staff
    $sql = "DELETE FROM staff WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $staffId);

    if ($stmt->execute()) {
        echo "Staff deleted successfully.";
        header("Location: staff.php"); // Redirect ke halaman daftar staff setelah penghapusan
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>