<?php
session_start();
include 'db_connection.php';

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $role = 'user'; // Default role untuk user baru

    $query = "INSERT INTO users (username, password, role) VALUES ('$username', '$password', '$role')";

    if (mysqli_query($conn, $query)) {
        $_SESSION['success'] = "Pendaftaran berhasil! Silakan login.";
        header("Location: login.php");
        exit;
    } else {
        $error = "Pendaftaran gagal. Username mungkin sudah digunakan.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center">Register</h2>
    <?php if (isset($error)) {
        echo "<p class='text-danger text-center'>$error</p>";
    } ?>
    <form method="post" class="mt-4">
        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" class="form-control" placeholder="Enter username" required>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control" placeholder="Enter password" required>
        </div>
        <button type="submit" name="register" class="btn btn-success btn-block">Register</button>
    </form>
    <p class="text-center mt-3">Sudah punya akun? <a href="login.php">Login di sini</a></p>
</div>
</body>
</html>
