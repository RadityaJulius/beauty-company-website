<div?php session_start(); if (!isset($_SESSION['role']) || $_SESSION['role'] !='admin' ) { header("Location:
    login.php"); exit; } ?>

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

    </head>

    <body class="font-sans antialiased bg-gray-100">

        <div x-data="{ open: false }" class="flex h-screen">
            <!-- Sidebar -->
            <div x-show="open" class="fixed inset-0 z-30 bg-gray-800 bg-opacity-75 lg:hidden" @click="open = false"
                x-cloak>
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

                <body class="bg-gray-100">
                    <div class="container mx-auto p-4">
                        <div class="flex items-center mb-4">
                            <i class="fas fa-thumbtack text-gray-500 mr-2"></i>
                            <h1 class="text-2xl font-semibold">Daftar Jadwal Dokter</h1>
                        </div>
                        <div class="bg-white shadow-md rounded-lg p-4">
                            <div class="flex justify-between items-center mb-4">
                                <h2 class="text-xl font-semibold">Jadwal Dokter</h2>
                                <button class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600"
                                    onclick='printLaporan("print-schedule")'>
                                    Cetak Jadwal
                                </button>
                            </div>
                            <div class="overflow-x-auto" id="print-schedule">
                                <table class="min-w-full bg-white">
                                    <thead>
                                        <tr>
                                            <th class="py-2 px-4 bg-blue-100 border-b border-gray-200">ID</th>
                                            <th class="py-2 px-4 bg-blue-100 border-b border-gray-200">DOKTER</th>
                                            <th class="py-2 px-4 bg-blue-100 border-b border-gray-200">HARI</th>
                                            <th class="py-2 px-4 bg-blue-100 border-b border-gray-200">PAGI</th>
                                            <th class="py-2 px-4 bg-blue-100 border-b border-gray-200">SIANG/SORE</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        include '../db_connection.php';

                                        $result = $conn->query("SELECT e.name, e.id, ed.pagi_start, ed.pagi_end, ed.sore_start, ed.sore_end, ed.day FROM staff e JOIN staff_schedule ed ON e.id = ed.staff_id");

                                        // Initialize an array to hold the days for each name
                                        $namesDays = [];
                                        $idsDays = [];

                                        // Organize the data by name
                                        foreach ($result as $row) {
                                            $namesDays[$row['name']][] = [
                                                'id' => $row['id'],
                                                'day' => $row['day'],
                                                'pagi_start' => $row['pagi_start'],
                                                'pagi_end' => $row['pagi_end'],
                                                'sore_start' => $row['sore_start'],
                                                'sore_end' => $row['sore_end'],
                                            ];
                                        }

                                        // Display the data in the desired format
                                        foreach ($namesDays as $name => $days) {
                                            // Prepare the day information
                                            $dayList = [];

                                            // Use an associative array to collect unique IDs
                                            $uniqueIds = [];

                                            foreach ($days as $dayInfo) {
                                                $dayList[] = $dayInfo['day'];
                                                $uniqueIds[$dayInfo['id']] = true; // Store unique IDs
                                            }

                                            // Prepare the pagi and sore time information
                                            $pagiTime = [];
                                            $soreTime = [];

                                            foreach ($days as $dayInfo) {
                                                $pagiTime[] = $dayInfo['pagi_start'] . " - " . $dayInfo['pagi_end'];
                                                $soreTime[] = $dayInfo['sore_start'] . " - " . $dayInfo['sore_end'];
                                            }

                                            // Get the unique IDs as an array
                                            $uniqueIdList = array_keys($uniqueIds);

                                            // Display the first row for the name
                                            echo "
                                                <tr>
                                                    <td class='py-2 px-4 border-b border-gray-200'>" . implode(", ", $uniqueIdList) . "</td>
                                                    <td class='py-2 px-4 border-b border-gray-200'>{$name}</td>
                                                    <td class='py-2 px-4 border-b border-gray-200'>
                                                        " . implode("<br>", $dayList) . "
                                                    </td>
                                                    <td class='py-2 px-4 border-b border-gray-200'>
                                                        " . implode("<br>", $pagiTime) . "
                                                    </td>
                                                    <td class='py-2 px-4 border-b border-gray-200'>
                                                        " . implode("<br>", $soreTime) . "
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
                </body>
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