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

                <div class="font-roboto bg-gray-100">
                    <div class="container mx-auto p-4">
                        <h1 class="text-3xl font-bold text-center mb-8">
                            Weekly Doctor Schedule
                        </h1>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 h-5/6">
                            <!-- Monday -->
                            <div class="bg-white p-4 rounded-lg shadow-md">
                                <h2 class="text-xl font-bold mb-4">
                                    Monday
                                </h2>
                                <div class="space-y-4">
                                    <div class="flex items-center">
                                        <img alt="Portrait of Dr. John Doe, a middle-aged man with glasses and a white coat"
                                            class="w-12 h-12 rounded-full mr-4" height="50"
                                            src="https://storage.googleapis.com/a1aa/image/SPuCHuD1ZmpTFx6MePBhbRmdepZdEuGkGUEPK18ojz08qJenA.jpg"
                                            width="50" />
                                        <div>
                                            <h3 class="font-bold">
                                                Dr. John Doe
                                            </h3>
                                            <p>
                                                9:00 AM - 12:00 PM
                                            </p>
                                        </div>
                                    </div>
                                    <div class="flex items-center">
                                        <img alt="Portrait of Dr. Jane Smith, a young woman with a stethoscope around her neck"
                                            class="w-12 h-12 rounded-full mr-4" height="50"
                                            src="https://storage.googleapis.com/a1aa/image/k14dLaY6npKkM9cSuoPw2Qtarv4KIF5m52XCIbZnvsdzaifJA.jpg"
                                            width="50" />
                                        <div>
                                            <h3 class="font-bold">
                                                Dr. Jane Smith
                                            </h3>
                                            <p>
                                                1:00 PM - 4:00 PM
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Tuesday -->
                            <div class="bg-white p-4 rounded-lg shadow-md">
                                <h2 class="text-xl font-bold mb-4">
                                    Tuesday
                                </h2>
                                <div class="space-y-4">
                                    <div class="flex items-center">
                                        <img alt="Portrait of Dr. Emily Johnson, a woman with curly hair and a friendly smile"
                                            class="w-12 h-12 rounded-full mr-4" height="50"
                                            src="https://storage.googleapis.com/a1aa/image/A8PE0QYqroKUPZcHBQrU9FQ0U4xvw0Rb4j9RU1mVDnZyaifJA.jpg"
                                            width="50" />
                                        <div>
                                            <h3 class="font-bold">
                                                Dr. Emily Johnson
                                            </h3>
                                            <p>
                                                9:00 AM - 12:00 PM
                                            </p>
                                        </div>
                                    </div>
                                    <div class="flex items-center">
                                        <img alt="Portrait of Dr. Michael Brown, a man with a beard and a serious expression"
                                            class="w-12 h-12 rounded-full mr-4" height="50"
                                            src="https://storage.googleapis.com/a1aa/image/le4O2aHJT1xoE6emDLXmXAFNuSeXnyeFfoCrfitdvQ23uaifJA.jpg"
                                            width="50" />
                                        <div>
                                            <h3 class="font-bold">
                                                Dr. Michael Brown
                                            </h3>
                                            <p>
                                                1:00 PM - 4:00 PM
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Wednesday -->
                            <div class="bg-white p-4 rounded-lg shadow-md">
                                <h2 class="text-xl font-bold mb-4">
                                    Wednesday
                                </h2>
                                <div class="space-y-4">
                                    <div class="flex items-center">
                                        <img alt="Portrait of Dr. Sarah Davis, a woman with short hair and a white coat"
                                            class="w-12 h-12 rounded-full mr-4" height="50"
                                            src="https://storage.googleapis.com/a1aa/image/9tM5SpTMnL58FdBOZyPDNv7lkWctRQoaFaThOPwZezXfqJenA.jpg"
                                            width="50" />
                                        <div>
                                            <h3 class="font-bold">
                                                Dr. Sarah Davis
                                            </h3>
                                            <p>
                                                9:00 AM - 12:00 PM
                                            </p>
                                        </div>
                                    </div>
                                    <div class="flex items-center">
                                        <img alt="Portrait of Dr. David Wilson, a man with glasses and a kind expression"
                                            class="w-12 h-12 rounded-full mr-4" height="50"
                                            src="https://storage.googleapis.com/a1aa/image/AypeEE7syl2EB6VKQ6je0fEcopfPow7aTCNSUkBi5Z2Asm4PB.jpg"
                                            width="50" />
                                        <div>
                                            <h3 class="font-bold">
                                                Dr. David Wilson
                                            </h3>
                                            <p>
                                                1:00 PM - 4:00 PM
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Thursday -->
                            <div class="bg-white p-4 rounded-lg shadow-md">
                                <h2 class="text-xl font-bold mb-4">
                                    Thursday
                                </h2>
                                <div class="space-y-4">
                                    <div class="flex items-center">
                                        <img alt="Portrait of Dr. Laura Martinez, a woman with long hair and a stethoscope"
                                            class="w-12 h-12 rounded-full mr-4" height="50"
                                            src="https://storage.googleapis.com/a1aa/image/qfsAD4sKL5xeE0pC49sv13outvINQMIVj2IHAV1ZgdhKrJenA.jpg"
                                            width="50" />
                                        <div>
                                            <h3 class="font-bold">
                                                Dr. Laura Martinez
                                            </h3>
                                            <p>
                                                9:00 AM - 12:00 PM
                                            </p>
                                        </div>
                                    </div>
                                    <div class="flex items-center">
                                        <img alt="Portrait of Dr. James Anderson, a man with a mustache and a white coat"
                                            class="w-12 h-12 rounded-full mr-4" height="50"
                                            src="https://storage.googleapis.com/a1aa/image/u2qQhhaIhz7JAZlS9WxAv8pkL4OEMDVUMtFRI2F4du7xaifJA.jpg"
                                            width="50" />
                                        <div>
                                            <h3 class="font-bold">
                                                Dr. James Anderson
                                            </h3>
                                            <p>
                                                1:00 PM - 4:00 PM
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Friday -->
                            <div class="bg-white p-4 rounded-lg shadow-md">
                                <h2 class="text-xl font-bold mb-4">
                                    Friday
                                </h2>
                                <div class="space-y-4">
                                    <div class="flex items-center">
                                        <img alt="Portrait of Dr. Karen Lee, a woman with glasses and a friendly smile"
                                            class="w-12 h-12 rounded-full mr-4" height="50"
                                            src="https://storage.googleapis.com/a1aa/image/JhfrC1gOY7VcWSjdDxqaGmnX5MMbTYdGP1Tf6t0t5YRBrJenA.jpg"
                                            width="50" />
                                        <div>
                                            <h3 class="font-bold">
                                                Dr. Karen Lee
                                            </h3>
                                            <p>
                                                9:00 AM - 12:00 PM
                                            </p>
                                        </div>
                                    </div>
                                    <div class="flex items-center">
                                        <img alt="Portrait of Dr. Robert Clark, a man with a bald head and a white coat"
                                            class="w-12 h-12 rounded-full mr-4" height="50"
                                            src="https://storage.googleapis.com/a1aa/image/VauRevA0yo0DeE2mASpJdqDcRX6ezI53z5fm7tPSlViSrm4PB.jpg"
                                            width="50" />
                                        <div>
                                            <h3 class="font-bold">
                                                Dr. Robert Clark
                                            </h3>
                                            <p>
                                                1:00 PM - 4:00 PM
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Saturday -->
                            <div class="bg-white p-4 rounded-lg shadow-md">
                                <h2 class="text-xl font-bold mb-4">
                                    Saturday
                                </h2>
                                <div class="space-y-4">
                                    <div class="flex items-center">
                                        <img alt="Portrait of Dr. Lisa Walker, a woman with a ponytail and a stethoscope"
                                            class="w-12 h-12 rounded-full mr-4" height="50"
                                            src="https://storage.googleapis.com/a1aa/image/MY6Cj8PUfExBUa27Zt8UKJ77Z2CT9zI8J7GQP2lk1Zui1EfTA.jpg"
                                            width="50" />
                                        <div>
                                            <h3 class="font-bold">
                                                Dr. Lisa Walker
                                            </h3>
                                            <p>
                                                9:00 AM - 12:00 PM
                                            </p>
                                        </div>
                                    </div>
                                    <div class="flex items-center">
                                        <img alt="Portrait of Dr. Steven Harris, a man with a beard and a white coat"
                                            class="w-12 h-12 rounded-full mr-4" height="50"
                                            src="https://storage.googleapis.com/a1aa/image/vgzrMHwxrQYYFVeIqeaRLV7BO1jR0sK914RFpt2T3hc4qJenA.jpg"
                                            width="50" />
                                        <div>
                                            <h3 class="font-bold">
                                                Dr. Steven Harris
                                            </h3>
                                            <p>
                                                1:00 PM - 4:00 PM
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Sunday -->
                            <div class="bg-white p-4 rounded-lg shadow-md">
                                <h2 class="text-xl font-bold mb-4">
                                    Sunday
                                </h2>
                                <div class="space-y-4">
                                    <div class="flex items-center">
                                        <img alt="Portrait of Dr. Nancy Young, a woman with short hair and a white coat"
                                            class="w-12 h-12 rounded-full mr-4" height="50"
                                            src="https://storage.googleapis.com/a1aa/image/sASVNe2JPDxuLC9cw2pMAybZ106cWaB1StZWuwQN01Tb1EfTA.jpg"
                                            width="50" />
                                        <div>
                                            <h3 class="font-bold">
                                                Dr. Nancy Young
                                            </h3>
                                            <p>
                                                9:00 AM - 12:00 PM
                                            </p>
                                        </div>
                                    </div>
                                    <div class="flex items-center">
                                        <img alt="Portrait of Dr. Paul King, a man with glasses and a serious expression"
                                            class="w-12 h-12 rounded-full mr-4" height="50"
                                            src="https://storage.googleapis.com/a1aa/image/jWg6ZJ4rvZbcO5c35GfYov1ROoeYzpwvfLYs1HAJlyMGWT8nA.jpg"
                                            width="50" />
                                        <div>
                                            <h3 class="font-bold">
                                                Dr. Paul King
                                            </h3>
                                            <p>
                                                1:00 PM - 4:00 PM
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <v>
                        </div>
                    </div>
                </div>
            </div>
    </body>

    </html>