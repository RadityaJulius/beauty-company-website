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
          <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
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
                <svg class="block size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                  aria-hidden="true" data-slot="icon">
                  <path stroke-linecap="round" stroke-linejoin="round"
                    d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
                <!--
            Icon when menu is open.

            Menu open: "block", Menu closed: "hidden"
          -->
                <svg class="hidden size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                  aria-hidden="true" data-slot="icon">
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
                <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                  aria-hidden="true" data-slot="icon">
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
                  x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                  x-transition:leave="transition ease-in duration-75 transform"
                  x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                  class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black/5 focus:outline-none"
                  role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                  <!-- Active: "bg-gray-100 outline-none", Not Active: "" -->
                  <a href="../src/logout.php" class="block px-4 py-2 text-sm text-gray-700" role="menuitem"
                    tabindex="-1" id="user-menu-item-2">Sign out</a>
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
        <!-- Overview -->
        <div class="bg-gray-100 font-roboto">
          <div class="container mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-4">
              <!-- Number of active staff -->
              <div class="flex justify-around items-center p-2 bg-white rounded-lg shadow-md">
                <div class="flex">
                  <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-user-md text-green-500 text-2xl"></i>
                  </div>
                  <div class="ml-4">
                    <h2 class="text-xl font-bold">Active Staff</h2>
                    <p class="text-gray-600">Number</p>
                    <?php
                    include '../db_connection.php';
                    $query = 'SELECT COUNT(id) AS NumberOfStaff FROM staff;';
                    $result = $conn->query($query);
                    $resultData = $result->fetch_assoc();
                    echo "<p class='text-2xl font-bold'>{$resultData['NumberOfStaff']}</p>";
                    ?>
                  </div>
                </div>
                <button onclick='printLaporan("print-staff")'
                  class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                  <i class="fas fa-print mr-2"></i> Print
                </button>
              </div>
              <!-- Today's appointments -->
              <div class="flex justify-around items-center p-2 bg-white rounded-lg shadow-md">
                <div class="flex">
                  <div class="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-calendar-day text-yellow-500 text-2xl"></i>
                  </div>
                  <div class="ml-4">
                    <h2 class="text-xl font-bold">Total</h2>
                    <p class="text-gray-600">Appointments</p>
                    <?php
                    include '../db_connection.php';
                    $query = 'SELECT COUNT(id) AS NumberOfAppointments FROM costumer;';
                    $result = $conn->query($query);
                    $resultData = $result->fetch_assoc();
                    echo "<p class='text-2xl font-bold'>{$resultData['NumberOfAppointments']}</p>";
                    ?>
                  </div>
                </div>
                <button onclick='printLaporan("print-appointment")'
                  class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                  <i class="fas fa-print mr-2"></i> Print
                </button>
              </div>
              <!-- Revenue overview -->
              <div class="flex justify-around items-center p-2 bg-white rounded-lg shadow-md">
                <div class="flex  ">
                  <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-dollar-sign text-red-500 text-2xl"></i>
                  </div>
                  <div class="ml-4">
                    <h2 class="text-xl font-bold">Revenue</h2>
                    <p class="text-gray-600">Overview</p>
                    <p class="text-2xl font-bold" id="totalAmount"></p>
                  </div>
                </div>
                <!-- Tombol Print Laporan -->
                <button onclick='printLaporan("print-revenue")'
                  class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                  <i class="fas fa-print mr-2"></i> Print
                </button>
              </div>
            </div>
          </div>
        </div>
        <!-- End of overview -->


        <div class="mb-4 border rounded-lg h-64 overflow-y-auto bg-white shadow-md" id="print-appointment">
          <table class="min-w-full">
            <thead>
              <tr>
                <th class='py-2 px-4 text-left text-sm font-semibold text-gray-900'>Jadwal treatment</th>
                <th class='py-2 px-4 text-left text-sm font-semibold text-gray-900'>Nama</th>
                <th class='py-2 px-4 text-left text-sm font-semibold text-gray-900'>Treatment</th>
                <th class='py-2 px-4 text-left text-sm font-semibold text-gray-900'>Contact</th>
                <th class='py-2 px-4 text-left text-sm font-semibold text-gray-900 hidden'>ID</th>
                <th class='py-2 px-4 text-left text-sm font-semibold text-gray-900 hidden'>Alamat</th>
                <th class='py-2 px-4 text-left text-sm font-semibold text-gray-900 hidden'>Email</th>
                <th class='py-2 px-4 text-left text-sm font-semibold text-gray-900 hidden'>Treatment id</th>
                <th class='py-2 px-4 text-left text-sm font-semibold text-gray-900' id="noprint">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $sql = "SELECT * FROM costumer";
              $result = $conn->query($sql);
              if (!$result) {
                die("Invalid Query: " . $conn->error);
              }

              while ($row = $result->fetch_assoc()) {
                echo "
                  <tr>
                    <td class='py-2 px-4 text-sm text-gray-900  book-date' data-book-date='{$row['tanggal_treatment']}'></td>
                    <td class='py-2 px-4 text-sm text-gray-900 font-semibold'>{$row['nama']}</td>
                    <td class='py-2 px-4 text-sm text-gray-900'>{$row['nama_treatment']}</td>
                    <td class='py-2 px-4 text-sm text-gray-900'>{$row['nomor_hp']}</td>
                    <td class='py-2 px-4 text-sm text-gray-900 hidden'>{$row['id']}</td>
                    <td class='py-2 px-4 text-sm text-gray-900 hidden'>{$row['alamat']}</td>
                    <td class='py-2 px-4 text-sm text-gray-900 hidden'>{$row['email']}</td>
                    <td class='py-2 px-4 text-sm text-gray-900 hidden'>{$row['treatment_id']}</td>
                    <td class='py-2 px-4 text-sm text-gray-900' id='noprint'>
                      <a href='../src/delete_customer.php?id={$row['id']}'>
                        <button class='bg-red-500 text-white font-semibold py-2 px-4 rounded hover:bg-blue-600 transition duration-200'>
                            Cancel
                        </button>
                      </a>
                      <a href='../src/confirm.php?id={$row['id']}'>
                        <button class='bg-green-500 text-white font-semibold py-2 px-4 rounded hover:bg-green-600 transition duration-200'>
                            Confirm
                        </button>
                      </a>
                    </td>
                  </tr>
                ";
              }
              ?>
            </tbody>
          </table>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-2">
          <div class="md:col-span-3">
            <div class="mb-4 border rounded-lg h-52 overflow-y-auto bg-white shadow-md" id="print-revenue">
              <table class="min-w-full">
                <thead>
                  <tr>
                    <th class='py-2 px-4 text-left text-sm font-semibold text-gray-900'>Payment</th>
                    <th class='py-2 px-4 text-left text-sm font-semibold text-gray-900'>Amount</th>
                    <th class='py-2 px-4 text-left text-sm font-semibold text-gray-900'>Name</th>
                    <th class='py-2 px-4 text-left text-sm font-semibold text-gray-900'>Treatment</th>
                    <th class='py-2 px-4 text-left text-sm font-semibold text-gray-900'>Treatment date</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  include '../db_connection.php';

                  $query = 'SELECT * FROM revenue';
                  $result = $conn->query($query);

                  if (!$result) {
                    die("Invalid Query: " . $conn->error);
                  }
                  ;

                  $totalAmount = 0;

                  while ($row = $result->fetch_assoc()) {
                    $totalAmount += $row["amount"];
                    echo "
                      <tr>
                        <td class='py-2 px-4 text-sm text-gray-900 payment-date' data-payment-date='{$row['payment_date']}'></td>
                        <td class='py-2 px-4 text-sm text-gray-900' id='amount'>{$row['amount']}</td>
                        <td class='py-2 px-4 text-sm text-gray-900'>{$row['name']}</td>
                        <td class='py-2 px-4 text-sm text-gray-900'>{$row['treatment']}</td>
                        <td class='py-2 px-4 text-sm text-gray-900'>{$row['treatment_date']}</td>
                      </tr>
                    ";

                    echo "
                        <script>
                          document.addEventListener('DOMContentLoaded', () => {
                            const totalElement = document.getElementById('totalAmount');
                            if (totalElement) {
                              totalElement.textContent = 'Rp. ' + ($totalAmount).toLocaleString('id-ID');
                            }
                          });
                        </script>
                      ";
                  }
                  ?>

                </tbody>
              </table>
            </div>
          </div>
          <div>
            <div class="mb-4 border rounded-lg h-52 overflow-y-auto bg-white min-w-full shadow-md" id="print-staff">
              <table class="min-w-1/2">
                <thead>
                  <tr>
                    <th class='py-2 px-4 text-left text-sm font-semibold text-gray-900'>Active staff:</th>
                    <th class='hidden'>Role:</th>
                    <th class='hidden'>Phone:</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $query = 'SELECT * FROM staff';
                  $result = $conn->query($query);
                  while ($row = $result->fetch_assoc()) {
                    echo "
                        <tr class='border-b' x-data='{ tooltip: false }' @mouseenter='tooltip = true' @mouseleave='tooltip = false'>
                            <td class='py-2 px-4 text-sm text-gray-900 relative cursor-default'>
                                <span>{$row['name']}</span>
                                <!-- Tooltip -->
                                <div 
                                    x-show='tooltip' 
                                    x-cloak 
                                    class='absolute bg-gray-700 text-white text-sm p-2 rounded shadow-lg w-64 ml-2 bottom-1 left-1 transform'>
                                    <p><strong>Full Name: </strong>{$row['name']}</p>
                                    <p><strong>Role: </strong>{$row['role']}</p>
                                    <p><strong>Phone: </strong>{$row['phone']}</p>
                                </div>
                            </td>
                            <td class='hidden'>{$row['role']}</td>
                            <td class='hidden'>{$row['phone']}</td>
                        </tr>
                    ";
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>


        <!-- End -->
      </div>
    </div>
  </div>
  <script>
    // Get all elements with the ID 'amount'
    const amountElements = document.querySelectorAll('#amount');

    // Iterate through each element and format its value
    amountElements.forEach(amountElement => {
      const value = parseFloat(amountElement.textContent);
      if (!isNaN(value)) {
        amountElement.textContent = "Rp. " + value.toLocaleString('id-ID');
      }
    });

    var timeElement = document.querySelector(".data-time");

    // Update time
    function updateTime() {
      var now = new Date();
      var time = now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });
      timeElement.textContent = time;
    }
    updateTime();
    setInterval(updateTime, 1000);

    // Format waktu
    document.addEventListener('DOMContentLoaded', () => {
      // Cari semua elemen dengan class 'payment-date'
      const paymentDateElements = document.querySelectorAll('.payment-date');
      const bookDateElements = document.querySelectorAll('.book-date');

      paymentDateElements.forEach(element => {
        // Ambil nilai tanggal asli dari atribut data-payment-date
        const paymentDate = element.getAttribute('data-payment-date')

        if (paymentDate) {
          element.textContent = moment(paymentDate).calendar();
        }
      })

      bookDateElements.forEach(element => {
        // Ambil nilai tanggal asli dari atribut data-payment-date
        const bookDate = element.getAttribute('data-book-date')

        if (bookDate) {
          element.textContent = moment(bookDate).calendar();
        }
      })
    })

    const buttonAppointment = document.querySelector("#printppointment")
    const buttonRevenue = document.querySelector("#printprevenue")

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
                    <h1 id='title'>Laporan Data</h1>
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