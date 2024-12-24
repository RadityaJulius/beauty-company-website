<html>

<head>
    <title>Add Data</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body>
<?php
include '../db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $duration = mysqli_real_escape_string($conn, $_POST['duration']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);

    
        // Check for empty fields
        if (empty($name) || empty($description) || empty($price) || empty($duration) || empty($category)) {
            if (empty($name)) {
                echo "<font color='red'>Name field is empty.</font><br/>";
            }

            if (empty($description)) {
                echo "<font color='red'>Phone field is empty.</font><br/>";
            }

            if (empty($price)) {
                echo "<font color='red'>Shift field is empty.</font><br/>";
            }

            if (empty($duration)) {
                echo "<font color='red'>Role field is empty.</font><br/>";
            }

            if (empty($category)) {
                echo "<font color='red'>Role field is empty.</font><br/>";
            }

            // Show link to the previous page
            echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
        } else {
            // Insert data into database
            $query = "INSERT INTO treatment (nama_treatment, harga, deskripsi, durasi, category) VALUES ('$name', '$price', '$description', '$duration', '$category')";
            $result = $conn->query($query);

            echo "
                <div class='flex justify-center m-4'>
                    <div class='bg-green-50 border border-green-200 rounded-lg p-4 flex items-center justify-between w-full max-w-4xl'>
                        <div class='flex items-center'>
                            <div class='bg-green-500 text-white rounded-full p-2'>
                                <i class='fas fa-check'></i>
                            </div>
                            <span class='ml-3 text-green-800'>Successfully uploaded</span>
                        </div>
                        <a class='text-green-800 p-4' href='../public/admin.php'>
                            <i class='fas fa-chevron-right'></i>
                        </a>
                    </div>
                </div>
            ";
        }

    
}
?>
</body>
</html>