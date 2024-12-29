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
    if (empty($name) || empty($price) || empty($description) || empty($duration)) {
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
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Admin</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.10.5/cdn.min.js" defer></script>
</head>

<body class="font-sans antialiased bg-gray-100">

  <div x-data="{ open: false }" class="flex h-screen">
    <!-- Sidebar -->
    <div x-show="open" class="fixed inset-0 z-30 bg-gray-800 bg-opacity-75 lg:hidden" @click="open = false" x-cloak>
    </div>
    <aside x-bind:class="open ? 'translate-x-0' : '-translate-x-full'"
      class="fixed text-white inset-y-0 left-0 z-40 flex flex-col w-64 bg-slate-900 border-r shadow-md lg:translate-x-0 lg:static lg:inset-0 transition-transform duration-300 ease-in-out">
      <!-- Logo -->
      <div class="flex items-center h-16 px-4 py-6">
        <h1 class="text-3xl font-bold px-4 py-2 font-mono">AnvyKlinik</h1>
      </div>

      <!-- Navigation -->
      <nav class="flex-1 px-4 py-6 overflow-y-auto">
        <ul>
          <li>
            <a href="admin.php" class="block px-4 py-2 text-white hover:bg-gray-600 rounded">
              Dashboard
            </a>
          </li>
          <li>
            <a href="add_staff.php" class="block px-4 py-2 text-white hover:bg-gray-600 rounded">
              + Add staff
            </a>
          </li>
          <li>
            <a href="add_treatment.php" class="block px-4 py-2 text-white hover:bg-gray-600 rounded">
              + Add treatment
            </a>
          </li>
          
          <li>
            <a href="schedule.php" class="block px-4 py-2 text-white hover:bg-gray-600 rounded">
              Jadwal dokter
            </a>
          </li>
          <li>
            <a href="staff.php" class="block px-4 py-2 text-white hover:bg-gray-600 rounded">
              Data staff
            </a>
          </li>
        </ul>
      </nav>
    </aside>

    <!-- Main Content -->
    <div class="flex-1">
      <!-- Topbar -->
      <header class="flex items-center justify-between px-4 py-4 bg-white border-b lg:hidden">
        <button @click="open = !open" class="text-gray-500 focus:outline-none">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
          </svg>
        </button>
        <h1 class="text-lg font-bold">KlinikAnvy</h1>
      </header>

      <div class="bg-gray-100 flex items-center justify-center min-h-screen">
        <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-lg">
          <h1 class="text-2xl font-bold mb-6">Add New Treatment</h1>
          <form method="POST" action="../src/create_treatment.php">
            <div class="mb-4">
              <label class="block text-gray-700 mb-2" for="name">Name</label>
              <input class="w-full p-3 border rounded-lg bg-white" type="text" id="name" name="name" required>
            </div>
            <div class="mb-4">
              <label class="block text-gray-700 mb-2" for="description">Description</label>
              <textarea class="w-full p-3 border rounded-lg bg-white" id="description" name="description" required></textarea>
            </div>
            <div class="flex mb-4">
              <div class="w-1/2 pr-2">
                <label class="block text-gray-700 mb-2" for="price">Price</label>
                <input class="w-full p-3 border rounded-lg bg-white" type="number" id="price" name="price" required>
              </div>
              <div class="w-1/2 pl-2">
                <label class="block text-gray-700 mb-2" for="duration">Duration</label>
                <input class="w-full p-3 border rounded-lg bg-white" type="text" id="duration" name="duration" required>
              </div>
            </div>
            <div class="mb-6">
              <label class="block text-gray-700 mb-2" for="category">Treatment Category</label>
              <select class="w-full p-3 border rounded-lg bg-white" id="category" name="category" required>
                <option selected disabled>Select category</option>
                <option>Face</option>
                <option>Body</option>
                <option>Hair</option>
                <option>Nail</option>
              </select>
            </div>
            <button class="w-full bg-blue-600 text-white p-3 rounded-lg font-bold hover:bg-blue-700" type="submit">Add
              Treatment</button>
          </form>
        </div>
      </div>

    </div>
  </div>

</body>

</html>