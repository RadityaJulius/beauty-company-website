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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.8/dist/cdn.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.30.1/locale/id.min.js"
        integrity="sha512-he8U4ic6kf3kustvJfiERUpojM8barHoz0WYpAUDWQVn61efpm3aVAD8RWL8OloaDDzMZ1gZiubF9OSdYBqHfQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    </link>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

</head>

<body class="font-sans antialiased bg-gray-100">

    <div x-data="{ open: false }" class="flex 2xl:h-screen h-full">
        <!-- Sidebar -->
        <div x-show="open" class="fixed inset-0 z-30 bg-gray-800 bg-opacity-75 lg:hidden" @click="open = false" x-cloak>
        </div>
        <aside x-bind:class="open ? 'translate-x-0' : '-translate-x-full'"
            class="fixed text-white inset-y-0 left-0 z-40 flex flex-col w-64 bg-slate-900 border-r border-gray-700 shadow-md lg:translate-x-0 lg:static lg:inset-0 transition-transform duration-300 ease-in-out">
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

            <nav class="bg-slate-900 hidden lg:block">
                <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
                    <div class="relative flex h-16 items-center justify-between">
                        <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                            <!-- Mobile menu button-->
                            <button type="button"
                                class="relative inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
                                aria-controls="mobile-menu" aria-expanded="false">
                                <span class="absolute -inset-0.5"></span>
                                <span class="sr-only">Open main menu</span>
                                <!--
            Icon when menu is closed.

            Menu open: "hidden", Menu closed: "block"
          -->
                                <svg class="block size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" aria-hidden="true" data-slot="icon">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                                </svg>
                                <!--
            Icon when menu is open.

            Menu open: "block", Menu closed: "hidden"
          -->
                                <svg class="hidden size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" aria-hidden="true" data-slot="icon">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                        <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
                        </div>
                        <div class="text-xl text-gray-200 data-time"></div>
                        <div
                            class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0 border-l border-gray-700 py-2 pl-10">
                            <button type="button"
                                class="relative rounded-full bg-gray-800 p-1 text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800">
                                <span class="absolute -inset-1.5"></span>
                                <span class="sr-only">View notifications</span>
                                <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" aria-hidden="true" data-slot="icon">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
                                </svg>
                            </button>

                            <!-- Profile dropdown -->
                            <div class="relative ml-3" x-data="{ isOpen: false }">
                                <div>
                                    <button type="button" @click="isOpen = !isOpen"
                                        class="relative flex rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800"
                                        id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                        <span class="absolute -inset-1.5"></span>
                                        <span class="sr-only">Open user menu</span>
                                        <img class="size-8 rounded-full"
                                            src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                            alt="">
                                    </button>
                                </div>

                                <!--
            Dropdown menu, show/hide based on menu state.

            Entering: "transition ease-out duration-100"
              From: "transform opacity-0 scale-95"
              To: "transform opacity-100 scale-100"
            Leaving: "transition ease-in duration-75"
              From: "transform opacity-100 scale-100"
              To: "transform opacity-0 scale-95"
          -->
                                <div x-show="isOpen" x-transition:enter="transition ease-out duration-100 transform"
                                    x-transition:enter-start="opacity-0 scale-95"
                                    x-transition:enter-end="opacity-100 scale-100"
                                    x-transition:leave="transition ease-in duration-75 transform"
                                    x-transition:leave-start="opacity-100 scale-100"
                                    x-transition:leave-end="opacity-0 scale-95"
                                    class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black/5 focus:outline-none"
                                    role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button"
                                    tabindex="-1">
                                    <!-- Active: "bg-gray-100 outline-none", Not Active: "" -->
                                    <a href="../src/logout.php" class="block px-4 py-2 text-sm text-gray-700"
                                        role="menuitem" tabindex="-1" id="user-menu-item-2">Sign out</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Mobile menu, show/hide based on menu state. -->
                <div class="sm:hidden" id="mobile-menu">
                    <div class="space-y-1 px-2 pb-3 pt-2">
                        <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                        <a href="#" class="block rounded-md bg-gray-900 px-3 py-2 text-base font-medium text-white"
                            aria-current="page">Dashboard</a>
                        <a href="#"
                            class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Team</a>
                        <a href="#"
                            class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Projects</a>
                        <a href="#"
                            class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Calendar</a>
                    </div>
                </div>
            </nav>

            <!-- Content -->
            <div class="m-4">
                <div class="bg-gray-100">
                    <div class="container mx-auto p-4">
                        <div class="bg-white p-4 rounded shadow">

                            <div class="bg-white p-4 rounded shadow">
                                <div class="flex items-center mb-4">
                                    <i class="fas fa-user-md text-2xl mr-2"></i>
                                    <h1 class="text-2xl font-bold">Data Dokter & Staff Klinik</h1>
                                </div>
                                <div class="flex justify-between items-center mb-4">
                                    <div class="flex space-x-2">
                                        <a href="add_staff.php">
                                            <button class="bg-green-500 text-white px-4 py-2 rounded"><i
                                                    class="fas fa-plus mr-2"></i>Entry Data</button>
                                        </a>
                                        <button class="bg-red-500 text-white px-4 py-2 rounded" onclick='printLaporan("print-employee")'><i
                                                class="fas fa-file-export mr-2"></i>Export Full Data</button>
                                        <a href="schedule.php">
                                            <button class="bg-yellow-500 text-white px-4 py-2 rounded"><i
                                                    class="fas fa-calendar-alt mr-2"></i>Lihat Jadwal Dokter</button>
                                        </a>
                                    </div>
                                </div>
                                <div class="flex justify-between items-center mb-4">
                                    <div class="flex items-center space-x-2">
                                        <label for="show" class="text-sm">Show</label>
                                        <select id="show" class="border rounded p-1">
                                            <option value="10">10</option>
                                        </select>
                                        <span class="text-sm">entries</span>
                                    </div>
                                    <div>
                                        <input type="text" placeholder="Search" class="border rounded p-1">
                                    </div>
                                </div>
                                <div class="h-80 overflow-y-auto" id="print-employee">
                                    <table class="min-w-full bg-white">
                                        <thead>
                                            <tr>
                                                <th class="py-2 px-4 border-b">KODE</th>
                                                <th class="py-2 px-4 border-b">NAMA LENGKAP</th>
                                                <th class="py-2 px-4 border-b">ALAMAT</th>
                                                <th class="py-2 px-4 border-b">TELP</th>
                                                <th class="py-2 px-4 border-b">JABATAN</th>
                                                <th class="py-2 px-4 border-b" id="noprint">ACTION</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            include '../db_connection.php';
                                            $result = $conn->query('SELECT * FROM staff');
                                            if (!$result) {
                                                echo "Invalid query: " . $conn->error;
                                            }
                                            while ($row = $result->fetch_assoc()) {
                                                echo "
                                                    <tr class='bg-gray-50'>
                                                        <td class='py-2 px-4 border-b'>AB01</td>
                                                        <td class='py-2 px-4 border-b'>{$row['name']}</td>
                                                        <td class='py-2 px-4 border-b'>{$row['address']}</td>
                                                        <td class='py-2 px-4 border-b'>{$row['phone']}</td>
                                                        <td class='py-2 px-4 border-b'>{$row['role']}</td>
                                                        <td class='py-2 px-4 border-b' id='noprint'>
                                                            <div x-data='{ open: false }' class='relative'>
                                                                <button @click='open = !open' class='bg-blue-500 text-white px-4 py-1 rounded'>Proses <i
                                                                        class='fas fa-caret-down'></i>
                                                                </button>
                                                        
                                                                <div x-show='open' @click.away='open = false' class='absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded shadow-lg z-10' x-transition>
                                                                    <a href='add_schedule.php?id={$row['id']}' class='block px-4 py-2 text-gray-800 hover:bg-gray-100'>Jadwal Dokter   </a>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                ";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            function printLaporan(targetID) {
                const printableContent = document.getElementById(targetID).innerHTML;
                console.log(printableContent)
                const newWindow = window.open('', '_blank', 'width=800,height=600');
                newWindow.document.write(`
                    <html>
                        <head>
                            <title>Print Laporan</title>
                            <style>
                                body { font-family: Arial, sans-serif; margin: 20px; }
                                table { width: 100%; border-collapse: collapse; margin-top: 20px; }
                                th, td { border: 1px solid black; padding: 8px; text-align: left; }
                                th { background-color: #f4f4f4; }
                                #noprint { display: none; }
                            </style>
                        </head>
                        <body>
                            <h1>Laporan Data Karyawan</h1>
                            <table>
                                ${printableContent}
                            </table>
                        </body>
                    </html>
                `);
                newWindow.document.close();
                newWindow.print();
            }
        </script>
</body>

</html>