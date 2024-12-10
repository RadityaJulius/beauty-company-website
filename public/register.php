<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center">Register</h2>
    <?php 
    if (isset($_SESSION['success'])) {
        echo "<p class='text-success text-center'>" . $_SESSION['success'] . "</p>";
        unset($_SESSION['success']);
    }
    if (isset($error)) { echo "<p class='text-danger text-center'>$error</p>"; }
    ?>
    <form action="register_submit.php" method="post" class="mt-4">
        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" class="form-control" placeholder="Enter username" required>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control" placeholder="Enter password" required>
        </div>
        <label for="role">Role:</label><br>
        <select id="role" name="role" required>
            <option value="admin">Admin</option>
            <option value="user">User</option>
        </select><br><br>
        <button type="submit" name="register" class="btn btn-primary btn-block">Register</button>
    </form>
</div>
<script>

</script>
</body>
</html>
