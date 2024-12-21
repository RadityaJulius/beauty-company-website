<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit;
}

include '../db_connection.php';

$name = "";
$price = "";
$description = "";
$duration = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $duration = $_POST['duration'];

    do {
        if ( empty($name) || empty($price) || empty($description) || empty($duration) ) {
            $errorMessage = "All the fields are required";
            break;
        }

        $sql = "INSERT INTO treatment (nama_treatment, harga, deskripsi, durasi)" .
               "VALUES ('$name', '$price', '$description', '$duration')";

        $result = $conn->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query: " . $conn->error;
        }

        $name = "";
        $price = "";
        $description = "";
        $duration = "";

        $successMessage = "Client added correctly";

        header("location: treatment.php");
        exit;

    } while (false);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex min-h-screen bg-orange-100 font-sans">
    <!-- Sidebar -->
    <div class="basis-56 bg-slate-900 h-screen px-3 py-4">
        <a href="https://flowbite.com/" class="flex items-center justify-center border-b border-b-indigo-900 mb-3 pb-2">

            <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">KlinikAnvy</span>
        </a>
        <ul class="space-y-2 font-medium">
            <li>
                <a id="open-modal" href="admin.php" class="flex cursor-pointer items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <span class="flex-1 ms-3 whitespace-nowrap">Dashboard</span>
                </a>
            </li>
            <li>
                <a id="open-modal" class="flex cursor-pointer items-center p-2 text-white rounded-lg bg-gray-700 group">
                    <span class="flex-1 ms-3 whitespace-nowrap">Treatment</span>
                </a>
            </li>
        </ul>
    </div>
    <div class="m-8 w-full bg-white rounded-lg shadow-lg flex">
        <div class="bg-white p-8 rounded-lg shadow-lg w-1/3">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Treatment Form</h2>
            <?php
            if (!empty($errorMessage)) {
                echo "
                    <div class='p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400' role='alert'>
                        <span class='font-medium'>Danger alert!</span> Change a few things up and try submitting again.
                    </div>
                ";
            }
            
            if (!empty($successMessage)) {
                echo "
                    <div class='p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400' role='alert'>
                        <span class='font-medium'>Success alert!</span> Change a few things up and try submitting again.
                    </div>
                ";
            }

            ?>
            <form method="POST" class="space-y-4">
            <!-- Name of Treatment -->
            <div>
                <label for="treatment-name" class="block text-sm font-medium text-gray-700">Treatment name</label>
                <input
                type="text"
                id="name"
                name="name"
                class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                placeholder="Enter treatment name"
                value="<?php echo $name; ?>"
                required 
                >
            </div>
    
            <!-- Price -->
            <div>
                <label for="price" class="block text-sm font-medium text-gray-700">Harga</label>
                <input
                type="number"
                id="price"
                name="price"
                class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                placeholder="Rp.100.000"
                value="<?php echo $price; ?>"
                required
                >
            </div>
    
            <!-- Description -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                <textarea
                id="description"
                name="description"
                rows="3"
                class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                placeholder="Enter description"
                value="<?php echo $description; ?>"
                required
                ></textarea>
            </div>
    
            <!-- Duration -->
            <div>
                <label for="duration" class="block text-sm font-medium text-gray-700">Durasi</label>
                <input
                type="text"
                id="duration"
                name="duration"
                class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                placeholder="30 Menit"
                value="<?php echo $duration; ?>"
                required
                >
            </div>
    
            <!-- Submit Button -->
            <div>
                <button
                type="submit"
                class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                >
                Submit
                </button>
            </div>
            </form>
        </div>

        <div>
            <div class="container mx-auto p-8">
                <h1 class="text-2xl font-semibold text-gray-800 mb-4">Treatment List</h1>
                <div class="overflow-x-auto overflow-y-auto h-96">
                    <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-md">
                        <thead class="bg-gray-200 text-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-medium uppercase">Name</th>
                            <th class="px-6 py-3 text-left text-sm font-medium uppercase">Price</th>
                            <th class="px-6 py-3 text-left text-sm font-medium uppercase">Description</th>
                            <th class="px-6 py-3 text-left text-sm font-medium uppercase">Duration</th>
                            <th class="px-6 py-3 text-left text-sm font-medium uppercase">Option</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        include '../db_connection.php';

                        $sql = "SELECT * FROM treatment";
                        $result = $conn->query($sql);
                        while ($row = $result->fetch_assoc()) {
                            echo "
                                <!-- Row 1 -->
                                <tr class='border-b'>
                                    <td class='px-6 py-4 text-gray-800'>$row[nama_treatment]</td>
                                    <td class='px-6 py-4 text-gray-800'>$row[harga]</td>
                                    <td class='px-6 py-4 text-gray-600'>$row[deskripsi]</td>
                                    <td class='px-6 py-4 text-gray-800'>$row[durasi]</td>
                                    <td class='px-6 py-4 text-gray-800'>
                                        <a class='bg-red-600 p-2 text-white rounded-lg  hover:bg-red-300' href='../src/treatment_create.php?kode=$row[kode]'>
                                            <button>Delete</button>
                                        </a>
                                    </td>
                                </tr>
                            ";
                        };
                        ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

<script>

</script>
</body>

</html>