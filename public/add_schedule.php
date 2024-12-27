<?php session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location:
    login.php");
    exit;
} ?>

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
                        <a href="add_schedule.php" class="block px-4 py-2 text-white hover:bg-gray-600 rounded">
                            + Add jadwal
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
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                </button>
                <h1 class="text-lg font-bold">KlinikAnvy</h1>
            </header>

            <main class="bg-gray-100 font-sans">
                <div class="container mx-auto p-4">
                    <div class="flex items-center mb-4">
                        <i class="fas fa-hammer text-gray-600 mr-2"></i>
                        <h1 class="text-2xl font-bold text-gray-700">Jadwal Dokter</h1>
                    </div>
                    <div class="bg-white p-4 rounded shadow">
                        <div class="flex justify-between items-center mb-4">
                            <?php
                            include '../db_connection.php';
                            if (empty($_GET['id'])) {
                                // Redirect to schedule_alt.php if 'id' is not present
                                header("Location: schedule_alt.php");
                                exit(); // Make sure to exit after the redirect
                            }
                            $id = $_GET['id'];
                            $result = $conn->query("SELECT * FROM staff WHERE id = $id");
                            $resultData = $result->fetch_assoc();
                            echo "
                                <h2 class='text-lg font-semibold text-gray-700'>Jadwal Dokter | <span   
                                        class='text-blue-500'>Dokter {$resultData['name']} :</span></h2>
                            ";
                            ?>

                            <button class="bg-red-500 text-white px-4 py-2 rounded">Hapus Jadwal</button>
                        </div>
                        <form action="../src/create_schedule.php" method="POST">
                            <div class="overflow-x-auto">
                                <table class="min-w-full bg-white">
                                    <thead>
                                        <tr>
                                            <th class="py-2 px-4 border-b">Hari</th>
                                            <th class="py-2 px-4 border-b">Jadwal Pagi</th>
                                            <th class="py-2 px-4 border-b">Jadwal Siang / Sore</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="border-b py-2 px-4">
                                                <input type="hidden" name="id" value="<?php echo $id; ?>" />
                                                <input id="senin" type="checkbox" class="mr-2" name="days[]" value="Senin"
                                                    onclick="toggleTimeInput(this)">
                                                <label for="senin">Senin</label>
                                            </td>
                                            <td class="py-2 px-4 border-b">
                                                <div class="flex items-center">
                                                    <input type="text"
                                                        class="border rounded px-2 py-1 w-16 text-center time-input"
                                                        placeholder="--:--" name="pagi_start[]" disabled>
                                                    <span class="mx-2">-</span>
                                                    <input type="text"
                                                        class="border rounded px-2 py-1 w-16 text-center time-input"
                                                        placeholder="--:--" name="pagi_end[]" disabled>
                                                    <i class="fas fa-clock ml-2"></i>
                                                </div>
                                            </td>
                                            <td class="py-2 px-4 border-b">
                                                <div class="flex items-center">
                                                    <input type="text"
                                                        class="border rounded px-2 py-1 w-16 text-center time-input"
                                                        placeholder="--:--" name="sore_start[]" disabled>
                                                    <span class="mx-2">-</span>
                                                    <input type="text"
                                                        class="border rounded px-2 py-1 w-16 text-center time-input"
                                                        placeholder="--:--" name="sore_end[]" disabled>
                                                    <i class="fas fa-clock ml-2"></i>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2 px-4">
                                                <input id="selasa" type="checkbox" class="mr-2" name="days[]" value="Selasa"
                                                    onclick="toggleTimeInput(this)">
                                                    <label for="selasa">Selasa</label>
                                            </td>
                                            <td class="py-2 px-4 border-b">
                                                <div class="flex items-center">
                                                    <input type="text"
                                                        class="border rounded px-2 py-1 w-16 text-center time-input"
                                                        placeholder="--:--" name="pagi_start[]" disabled>
                                                    <span class="mx-2">-</span>
                                                    <input type="text"
                                                        class="border rounded px-2 py-1 w-16 text-center time-input"
                                                        placeholder="--:--" name="pagi_end[]" disabled>
                                                    <i class="fas fa-clock ml-2"></i>
                                                </div>
                                            </td>
                                            <td class="py-2 px-4 border-b">
                                                <div class="flex items-center">
                                                    <input type="text"
                                                        class="border rounded px-2 py-1 w-16 text-center time-input"
                                                        placeholder="--:--" name="sore_start[]" disabled>
                                                    <span class="mx-2">-</span>
                                                    <input type="text"
                                                        class="border rounded px-2 py-1 w-16 text-center time-input"
                                                        placeholder="--:--" name="sore_end[]" disabled>
                                                    <i class="fas fa-clock ml-2"></i>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2 px-4">
                                                <input id="rabu" type="checkbox" class="mr-2" name="days[]" value="Rabu" onclick="toggleTimeInput(this)">
                                                <label for="rabu">Rabu</label>
                                            </td>
                                            <td class="py-2 px-4 border-b">
                                                <div class="flex items-center">
                                                    <input type="text"
                                                        class="border rounded px-2 py-1 w-16 text-center time-input"
                                                        placeholder="--:--" name="pagi_start[]" disabled>
                                                    <span class="mx-2">-</span>
                                                    <input type="text"
                                                        class="border rounded px-2 py-1 w-16 text-center time-input"
                                                        placeholder="--:--" name="pagi_end[]" disabled>
                                                    <i class="fas fa-clock ml-2"></i>
                                                </div>
                                            </td>
                                            <td class="py-2 px-4 border-b">
                                                <div class="flex items-center">
                                                    <input type="text"
                                                        class="border rounded px-2 py-1 w-16 text-center time-input"
                                                        placeholder="--:--" name="sore_start[]" disabled>
                                                    <span class="mx-2">-</span>
                                                    <input type="text"
                                                        class="border rounded px-2 py-1 w-16 text-center time-input"
                                                        placeholder="--:--" name="sore_end[]" disabled>
                                                    <i class="fas fa-clock ml-2"></i>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2 px-4">
                                                <input id="kamis" type="checkbox" class="mr-2" name="days[]" value="Kamis" onclick="toggleTimeInput(this)">
                                                <label for="kamis">Kamis</label>
                                            </td>
                                            <td class="py-2 px-4 border-b">
                                                <div class="flex items-center">
                                                    <input type="text"
                                                        class="border rounded px-2 py-1 w-16 text-center time-input"
                                                        placeholder="--:--" name="pagi_start[]" disabled>
                                                    <span class="mx-2">-</span>
                                                    <input type="text"
                                                        class="border rounded px-2 py-1 w-16 text-center time-input"
                                                        placeholder="--:--" name="pagi_end[]" disabled>
                                                    <i class="fas fa-clock ml-2"></i>
                                                </div>
                                            </td>
                                            <td class="py-2 px-4 border-b">
                                                <div class="flex items-center">
                                                    <input type="text"
                                                        class="border rounded px-2 py-1 w-16 text-center time-input"
                                                        placeholder="--:--" name="sore_start[]" disabled>
                                                    <span class="mx-2">-</span>
                                                    <input type="text"
                                                        class="border rounded px-2 py-1 w-16 text-center time-input"
                                                        placeholder="--:--" name="sore_end[]" disabled>
                                                    <i class="fas fa-clock ml-2"></i>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2 px-4">
                                                <input id="jumat" type="checkbox" class="mr-2" name="days[]" value="Jumat" onclick="toggleTimeInput(this)">
                                                <label for="jumat">Jum'at</label>
                                            </td>
                                            <td class="py-2 px-4 border-b">
                                                <div class="flex items-center">
                                                    <input type="text"
                                                        class="border rounded px-2 py-1 w-16 text-center time-input"
                                                        placeholder="--:--" name="pagi_start[]" disabled>
                                                    <span class="mx-2">-</span>
                                                    <input type="text"
                                                        class="border rounded px-2 py-1 w-16 text-center time-input"
                                                        placeholder="--:--" name="pagi_end[]" disabled>
                                                    <i class="fas fa-clock ml-2"></i>
                                                </div>
                                            </td>
                                            <td class="py-2 px-4 border-b">
                                                <div class="flex items-center">
                                                    <input type="text"
                                                        class="border rounded px-2 py-1 w-16 text-center time-input"
                                                        placeholder="--:--" name="sore_start[]" disabled>
                                                    <span class="mx-2">-</span>
                                                    <input type="text"
                                                        class="border rounded px-2 py-1 w-16 text-center time-input"
                                                        placeholder="--:--" name="sore_end[]" disabled>
                                                    <i class="fas fa-clock ml-2"></i>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2 px-4">
                                                <input id="sabtu" type="checkbox" class="mr-2" name="days[]" value="Sabtu" onclick="toggleTimeInput(this)">
                                                <label for="sabtu">Sabtu</label>
                                            </td>
                                            <td class="py-2 px-4 border-b">
                                                <div class="flex items-center">
                                                    <input type="text"
                                                        class="border rounded px-2 py-1 w-16 text-center time-input"
                                                        placeholder="--:--" name="pagi_start[]" disabled>
                                                    <span class="mx-2">-</span>
                                                    <input type="text"
                                                        class="border rounded px-2 py-1 w-16 text-center time-input"
                                                        placeholder="--:--" name="pagi_end[]" disabled>
                                                    <i class="fas fa-clock ml-2"></i>
                                                </div>
                                            </td>
                                            <td class="py-2 px-4 border-b">
                                                <div class="flex items-center">
                                                    <input type="text"
                                                        class="border rounded px-2 py-1 w-16 text-center time-input"
                                                        placeholder="--:--" name="sore_start[]" disabled>
                                                    <span class="mx-2">-</span>
                                                    <input type="text"
                                                        class="border rounded px-2 py-1 w-16 text-center time-input"
                                                        placeholder="--:--" name="sore_end[]" disabled>
                                                    <i class="fas fa-clock ml-2"></i>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2 px-4">
                                                <input id="minggu" type="checkbox" class="mr-2" onclick="toggleTimeInput(this)">
                                                <label for="minggu">Minggu</label>
                                            </td>
                                            <td class="py-2 px-4 border-b">
                                                <div class="flex items-center">
                                                    <input type="text"
                                                        class="border rounded px-2 py-1 w-16 text-center time-input"
                                                        placeholder="--:--" name="pagi_start[]" disabled>
                                                    <span class="mx-2">-</span>
                                                    <input type="text"
                                                        class="border rounded px-2 py-1 w-16 text-center time-input"
                                                        placeholder="--:--" name="pagi_end[]" disabled>
                                                    <i class="fas fa-clock ml-2"></i>
                                                </div>
                                            </td>
                                            <td class="py-2 px-4 border-b">
                                                <div class="flex items-center">
                                                    <input type="text"
                                                        class="border rounded px-2 py-1 w-16 text-center time-input"
                                                        placeholder="--:--" name="sore_start[]" disabled>
                                                    <span class="mx-2">-</span>
                                                    <input type="text"
                                                        class="border rounded px-2 py-1 w-16 text-center time-input"
                                                        placeholder="--:--" name="sore_end[]" disabled>
                                                    <i class="fas fa-clock ml-2"></i>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="mt-4 flex justify-end">
                                <?php
                                $id = $_GET['id'];
                                echo "
                                    <button class='bg-green-500 text-white px-6 py-2 rounded' type='submit'>Proses Simpan</button>
                                ";
                                ?>
                            </div>
                        </form>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script>
        const timeInputs = row.querySelectorAll('.time-input');
        function toggleTimeInput(checkbox) {
            // Get the parent row of the checkbox
            const row = checkbox.closest('tr');

            // Get all time input fields in the same row
            const timeInputs = row.querySelectorAll('.time-input');

            // Enable or disable the time inputs based on the checkbox state
            timeInputs.forEach(input => {
                input.disabled = !checkbox.checked;
            });
        }
    </script>
</body>

</html>