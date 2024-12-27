<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Jadwal Dokter</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <div class="flex items-center mb-4">
            <i class="fas fa-thumbtack text-gray-500 mr-2"></i>
            <h1 class="text-2xl font-semibold">Daftar Jadwal Dokter</h1>
        </div>
        <div class="text-sm text-gray-500 mb-4">
            <a href="#" class="hover:underline">Home</a> &gt; 
            <a href="#" class="hover:underline">Setting & Data Dokter/Beautician/Staff</a> &gt; 
            <span class="text-gray-700">Cetak Jadwal Dokter</span>
        </div>
        <div class="bg-white shadow-md rounded-lg p-4">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold">Jadwal Dokter</h2>
                <button class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">
                    Cetak Jadwal
                </button>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 bg-blue-100 border-b border-gray-200">NO</th>
                            <th class="py-2 px-4 bg-blue-100 border-b border-gray-200">DOKTER</th>
                            <th class="py-2 px-4 bg-blue-100 border-b border-gray-200">HARI</th>
                            <th class="py-2 px-4 bg-blue-100 border-b border-gray-200">PAGI</th>
                            <th class="py-2 px-4 bg-blue-100 border-b border-gray-200">SIANG/SORE</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="py-2 px-4 border-b border-gray-200">1</td>
                            <td class="py-2 px-4 border-b border-gray-200">dr.Henny</td>
                            <td class="py-2 px-4 border-b border-gray-200">
                                Senin<br>Selasa
                            </td>
                            <td class="py-2 px-4 border-b border-gray-200">
                                10:00 - 00:00<br>10:00 - 00:00
                            </td>
                            <td class="py-2 px-4 border-b border-gray-200">
                                15:00 - 00:00<br>15:00 - 00:00
                            </td>
                        </tr>
                        <tr>
                            <td class="py-2 px-4 border-b border-gray-200">2</td>
                            <td class="py-2 px-4 border-b border-gray-200">dr.Oby</td>
                            <td class="py-2 px-4 border-b border-gray-200">
                                Senin<br>Selasa<br>Rabu
                            </td>
                            <td class="py-2 px-4 border-b border-gray-200">
                                10:00 - 12:00<br>10:00 - 12:00<br>10:00 - 12:00
                            </td>
                            <td class="py-2 px-4 border-b border-gray-200">
                                13:00 - 15:00<br>13:00 - 15:00<br>13:00 - 15:00
                            </td>
                        </tr>
                        <tr>
                            <td class="py-2 px-4 border-b border-gray-200">3</td>
                            <td class="py-2 px-4 border-b border-gray-200">Dr. Rina</td>
                            <td class="py-2 px-4 border-b border-gray-200">
                                Senin<br>Rabu
                            </td>
                            <td class="py-2 px-4 border-b border-gray-200">
                                10:00 - 12:00<br>10:00 - 12:00
                            </td>
                            <td class="py-2 px-4 border-b border-gray-200">
                                13:00 - 15:00<br>13:00 - 15:00
                            </td>
                        </tr>
                        <tr>
                            <td class="py-2 px-4 border-b border-gray-200">4</td>
                            <td class="py-2 px-4 border-b border-gray-200">dr. Dinda</td>
                            <td class="py-2 px-4 border-b border-gray-200">
                                Senin<br>Rabu<br>Kamis
                            </td>
                            <td class="py-2 px-4 border-b border-gray-200">
                                12:00 - 13:00<br>10:00 - 12:00<br>10:00 - 12:00
                            </td>
                            <td class="py-2 px-4 border-b border-gray-200">
                                14:00 - 15:00<br>14:00 - 15:00<br>14:00 - 15:00
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>