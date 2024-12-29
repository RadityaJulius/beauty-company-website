<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
  header("Location: login.php");
  exit;
}

// Menghubungkan ke database
include '../db_connection.php';

// Mengecek apakah ID staff tersedia di URL
if (isset($_GET['id'])) {
  $staffId = $_GET['id'];

  // Mengambil data staff berdasarkan ID dari database
  $query = "SELECT * FROM staff WHERE id = ?";
  $stmt = $conn->prepare($query);
  $stmt->bind_param("i", $staffId);
  $stmt->execute();
  $result = $stmt->get_result();

  // Mengecek apakah data staff ditemukan
  if ($result->num_rows > 0) {
    $staff = $result->fetch_assoc();
  } else {
    echo "Staff tidak ditemukan!";
    exit();
  }
} else {
  echo "No ID specified!";
  exit();
}

// Menangani pengeditan data staff
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Mengambil data yang baru dari form
  $name = $_POST['name'];
  $phone = $_POST['phone'];
  $shift = $_POST['shift'];
  $role = $_POST['role'];
  // Cek apakah ada file gambar yang diupload
  if (isset($_FILES['picture'])) {
    // Mengambil konten gambar
    $picture = file_get_contents($_FILES['picture']['tmp_name']);

    // Update data staff di database termasuk gambar
    $updateQuery = "UPDATE staff SET name = ?, phone = ?, shift = ?, role = ?, profile_picture = ? WHERE id = ?";
    $updateStmt = $conn->prepare($updateQuery);
    $updateStmt->bind_param("sssssi", $name, $phone, $shift, $role, $picture, $staffId);

    if ($updateStmt->execute()) {
      echo "Staff updated successfully!";
      header("Location: staff.php"); // Redirect ke daftar staff setelah sukses
      exit();
    } else {
      echo "Error updating staff: " . $updateStmt->error;
    }
  } else {

    $updateQuery = "UPDATE staff SET name = ?, phone = ?, shift = ?, role = ? WHERE id = ?";
    $updateStmt = $conn->prepare($updateQuery);
    $updateStmt->bind_param("ssssi", $name, $phone, $shift, $role, $staffId);

    if ($updateStmt->execute()) {
      echo "Staff updated successfully!";
      header("Location: staff.php"); // Redirect ke daftar staff setelah sukses
      exit();
    } else {
      echo "Error updating staff: " . $updateStmt->error;
    }
  }

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Staff</title>
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
            <a href="staff.php" class="block px-4 py-2 text-white hover:bg-gray-600 rounded">
              Data Staff
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
        <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-2xl">
          <h2 class="text-xl font-bold mb-6">Edit Staff</h2>
          <form method="POST" action="edit_staff.php?id=<?php echo $staff['id']; ?>">
            <div class="mb-4">
              <label class="block text-gray-700 mb-2" for="name">Name</label>
              <input class="w-full px-3 py-2 border rounded-lg" type="text" id="name" name="name"
                value="<?php echo $staff['name']; ?>" required>
            </div>
            <div class="mb-4">
              <label class="block text-gray-700 mb-2" for="phone">Phone Number</label>
              <input class="w-full px-3 py-2 border rounded-lg" type="text" id="phone" name="phone"
                value="<?php echo $staff['phone']; ?>" required>
            </div>
            <div class="mb-4 flex space-x-4">
              <div class="w-1/2">
                <label class="block text-gray-700 mb-2" for="shift">Working Hours</label>
                <select class="w-full px-3 py-2 border rounded-lg bg-gray-100" id="shift" name="shift" required>
                  <option value="Shift 1" <?php echo ($staff['shift'] == 'Shift 1') ? 'selected' : ''; ?>>Shift 1</option>
                  <option value="Shift 2" <?php echo ($staff['shift'] == 'Shift 2') ? 'selected' : ''; ?>>Shift 2</option>
                  <option value="Shift 3" <?php echo ($staff['shift'] == 'Shift 3') ? 'selected' : ''; ?>>Shift 3</option>
                  <option value="Shift 4" <?php echo ($staff['shift'] == 'Shift 4') ? 'selected' : ''; ?>>Shift 4</option>
                  <option value="Shift 5" <?php echo ($staff['shift'] == 'Shift 5') ? 'selected' : ''; ?>>Shift 5</option>
                  <option value="Shift 6" <?php echo ($staff['shift'] == 'Shift 6') ? 'selected' : ''; ?>>Shift 6</option>
                </select>
              </div>

              <div class="w-1/2">
                <label class="block text-gray-700 mb-2" for="role">Role</label>
                <select class="w-full px-3 py-2 border rounded-lg bg-gray-100" id="role" name="role" required>
                  <option value="Admin" <?php echo ($staff['role'] == 'Admin') ? 'selected' : ''; ?>>Admin</option>
                  <option value="Doctor" <?php echo ($staff['role'] == 'Doctor') ? 'selected' : ''; ?>>Doctor</option>
                  <option value="Receptionist" <?php echo ($staff['role'] == 'Receptionist') ? 'selected' : ''; ?>>
                    Receptionist</option>
                </select>
              </div>
            </div>
            <div class="mb-6">
              <label class="block text-gray-700 mb-2" for="picture">Profile Picture</label>
              <input
                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"
                type="file" id="picture" name="picture">
            </div>
            <button class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700" type="submit">Update
              Staff</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>

</html>