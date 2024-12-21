<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<div class="flex min-h-screen bg-orange-100 font-sans">
    <!-- Sidebar -->
    <div class="basis-56 bg-slate-900 h-screen px-3 py-4">
        <a href="https://flowbite.com/" class="flex items-center justify-center border-b border-b-indigo-900 mb-3 pb-2">
            <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">KlinikAnvy</span>
        </a>
        <ul class="space-y-2 font-medium">
            <li>
                <a id="open-modal" class="flex cursor-pointer items-center p-2 text-white rounded-lg bg-gray-700 group">
                    <span class="flex-1 ms-3 whitespace-nowrap">Dashboard</span>
                </a>
            </li>
            <li>
                <a id="open-modal" href="treatment.php" class="flex cursor-pointer items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <span class="flex-1 ms-3 whitespace-nowrap">Treatment</span>
                </a>
            </li>
        </ul>
    </div>

    <div class="m-8 rounded-lg w-full">
        <header class="text-white text-3xl py-3 px-4 rounded-t-lg bg-orange-900">
            <h1>Customer Details</h1>
        </header>
        <div class="bg-white shadow-md rounded-lg p-6 max-w-full">

            <?php
            if ( isset($_GET["id"])) {
                $id = $_GET["id"];
                
                include '../db_connection.php';

                $sql = "SELECT * FROM costumer WHERE id=$id";
                $result = $conn->query($sql);
                
                while ($row = $result->fetch_assoc()) {
                    echo "
                        <div class='mb-4'>
                            <h2 class='text-lg font-semibold text-gray-700'>Name</h2>
                            <p class='text-gray-600'>$row[nama]</p>
                        </div>
                        <div class='mb-4'>
                            <h2 class='text-lg font-semibold text-gray-700'>Phone Number</h2>
                            <p class='text-gray-600'>$row[nomor_hp]</p>
                        </div>
                        <div class='mb-4'>
                            <h2 class='text-lg font-semibold text-gray-700'>Address</h2>
                            <p class='text-gray-600'>$row[alamat]</p>
                        </div>
                        <div class='mb-4'>
                            <h2 class='text-lg font-semibold text-gray-700'>Email</h2>
                            <p class='text-gray-600'>$row[email]</p>
                        </div>
                        <div class='mb-4'>
                            <h2 class='text-lg font-semibold text-gray-700'>Price</h2>
                            <p class='text-gray-600'>$row[harga]</p>
                        </div>
                        <div class='mb-4'>
                            <h2 class='text-lg font-semibold text-gray-700'>Treatment Date</h2>
                            <p class='text-gray-600'>$row[tanggal_treatment]</p>
                        </div>
                        <div class='mb-4'>
                            <h2 class='text-lg font-semibold text-gray-700'>Treatment Name</h2>
                            <p class='text-gray-600'>$row[nama_treatment]</p>
                        </div>
                    ";
                }
            }
            ?>
            <div class="text-center mt-6">
                <a href="admin.php">
                    <button class="bg-orange-900 text-white px-6 py-2 rounded-md shadow hover:bg-orange-400">
                        Back to Customers List
                    </button>
                </a>
            </div>
        </div>
    </div>
<script>

</script>
</body>

</html>