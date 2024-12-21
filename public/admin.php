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
        <ul class="space-y-2 font-medium ">
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

    <!-- Main Content -->
    <main class="m-8 rounded-lg w-full">
      <header class="mb-6">
        <h2 class="text-xl font-bold">Selamat Datang, admin</h2>
      </header>

      <!-- Dashboard Content -->
      <div class="grid grid-cols-3 gap-6">
        <!-- Data Pasien -->
        <div class="bg-white shadow rounded-lg col-span-2">
          <header class="text-white py-3 px-4 rounded-t-lg bg-orange-900">
            <h3 class="font-bold text-lg">Data Pasien</h3>
          </header>
          <div class="overflow-y-auto h-96 ">
            <table class="w-full text-left border-collapse">
              <thead>
                <tr>
                  <th class="py-2 px-4 border-b">No</th>
                  <th class="py-2 px-4 border-b">Nama</th>
                  <th class="py-2 px-4 border-b">Nama Treatment</th>
                  <th class="py-2 px-4 border-b">No. Telp</th>
                  <th class="py-2 px-4 border-b">Detail</th>
                </tr>
              </thead>
              <tbody>
                <?php
                include '../db_connection.php';

                $sql = "SELECT * FROM costumer";
                $result = $conn->query($sql);
                if (!$result) {
                    die("Invalid query: ". $conn->error);
                };

                while ($row = $result->fetch_assoc()) {
                    echo "
                        <tr>
                            <td class='py-2 px-4 border-b'>$row[id]</td>
                            <td class='py-2 px-4 border-b'>$row[nama]</td>
                            <td class='py-2 px-4 border-b'>$row[nama_treatment]</td>
                            <td class='py-2 px-4 border-b'>$row[nomor_hp]</td>
                            <td class='py-2 px-4 border-b'>
                              <a href='../src/delete_customer.php?id=$row[id]'>
                                <button class='bg-red-600 p-2 text-white rounded-lg  hover:bg-red-300'>Delete</button>
                              </a>
                              <a href='customer_detail.php?id=$row[id]'>
                                <button class='bg-blue-600 p-2 text-white rounded-lg  hover:bg-blue-300'>Detail</button>
                              </a>
                            </td>
                        </tr>
                    ";
                }
                ?>                
              </tbody>
            </table>
          </div>

        </div>

        <!-- Riwayat Pasien -->
        <div class="bg-white shadow rounded-lg">
          <header class=" text-white py-3 px-4 rounded-t-lg bg-orange-900">
            <h3 class="font-bold text-lg">Riwayat Pasien</h3>
          </header>
          <div class="p-4">
            <h4 class="text-center text-gray-600">Comparison</h4>
            <h5 class="text-center text-sm text-gray-400">2023</h5>
            <div class="h-32 flex justify-center items-center text-gray-400">
              [Graph Placeholder]
            </div>
          </div>
        </div>
      </div>
    </main>
</div>
<script>

</script>
</body>

</html>