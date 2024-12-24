<html>

<head>
    <title>Add Data</title>
</head>

<body>
    <?php
    include '../db_connection.php';

    if (isset($_POST['submit'])) {
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $phone = mysqli_real_escape_string($conn, $_POST['phone']);
        $shift = mysqli_real_escape_string($conn, $_POST['shift']);
        $role = mysqli_real_escape_string($conn, $_POST['role']);
        $picture = mysqli_real_escape_string($conn, $_POST['picture']);

        // Check for empty fields
        if (empty($name) || empty($phone) || empty($shift) || empty($role)) {
            if (empty($name)) {
                echo "<font color='red'>Name field is empty.</font><br/>";
            }

            if (empty($phone)) {
                echo "<font color='red'>Phone field is empty.</font><br/>";
            }

            if (empty($shift)) {
                echo "<font color='red'>Shift field is empty.</font><br/>";
            }

            if (empty($role)) {
                echo "<font color='red'>Role field is empty.</font><br/>";
            }

            // Show link to the previous page
            echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
        } else {
            // Insert data into database
            $query = "INSERT INTO staff (name, phone, shift, role, profile_picture) VALUES ('$name', '$phone', '$shift', '$role', '$picture')";
            $result = $conn->query( $query );

            header("location: ../public/admin.php");
        }
    }
    ?>
</body>

</html>