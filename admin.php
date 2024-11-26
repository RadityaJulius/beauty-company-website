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
<!-- 
<body>
    <h1>Selamat Datang di Dashboard Admin, <?php echo $_SESSION['username']; ?>!</h1>
</body> -->
<body class="bg-gray-100 font-sans">
    <div class="flex">
        <!-- Sidebar -->
        <div class="basis-56 bg-slate-900 h-screen px-3 py-4">
            <a href="https://flowbite.com/" class="flex items-center ps-2.5 mb-5">
                <img src="https://flowbite.com/docs/images/logo.svg" class="h-6 me-3 sm:h-7" alt="Flowbite Logo" />
                <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">Anvy</span>
            </a>
            <ul class="space-y-2 font-medium">
                <li>
                    <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                        <path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z"/>
                        <path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z"/>
                    </svg>
                    <span class="ms-3">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a id="open-modal" class="flex cursor-pointer items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <span class="flex-1 ms-3 whitespace-nowrap">+ Add Treatment</span>
                    </a>
                </li>
            </ul>
        </div>
    
        <!-- Content -->
        <div class="w-full bg-orange-100">
            <header class="bg-orange-900 text-white p-4 flex justify-between">
                <a href="logout.php" class="border p-2 rounded-lg hover:text-gray-400">Logout</a>
                <div class="flex font-bold gap-2">
                    <h1 class="p-2"><?php echo $_SESSION['username']; ?></h1>
                </div>
            </header>
            <main class="p-6">
                <!-- Form Section -->
                <section id="form-section" class="mb-8">
                <form id="treatment-form" class="space-y-4">
                    <div></div>
                </form>
                </section>
        
                <!-- Active Treatments Section -->
                <section id="cardsSection" class="mb-8">
                <div class="flex mb-2 justify-between">
                    <h2 class="text-xl font-bold text-gray-700 py-2">
                    Active Treatments
                    </h2>
                    <button
                    type="button"
                    id="clear-button"
                    class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700"
                    >
                    Clear Treatment
                    </button>
                </div>
                <div
                    id="treatment-cards"
                    class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4"
                >
                    <!-- Cards will be dynamically added here -->
                </div>
                </section>
                <div
                id="toast-success"
                class="hidden flex items-center fixed bottom-5 p-4 mb-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800"
                role="alert"
                >
                <div
                    class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200"
                >
                    <svg
                    class="w-5 h-5"
                    aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor"
                    viewBox="0 0 20 20"
                    >
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"
                    />
                    </svg>
                    <span class="sr-only">Check icon</span>
                </div>
                <div class="ml-3 text-sm font-normal">Item moved successfully.</div>
                <button
                    type="button"
                    class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
                    data-dismiss-target="#toast-success"
                    aria-label="Close"
                >
                    <span class="sr-only">Close</span>
                    <svg
                    class="w-3 h-3"
                    aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 14 14"
                    >
                    <path
                        stroke="currentColor"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"
                    />
                    </svg>
                </button>
                </div>
        
                <!-- Payment History Section -->
                <section id="history-section">
                <h2 class="text-xl font-bold text-gray-700 mb-4">Payment History</h2>
                <div
                    id="payment-history"
                    class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4"
                >
                    <!-- Payment history cards will be added here -->
                </div>
                </section>
            </main>
            
            <!-- Main modal -->
            <div id="crud-modal" tabindex="-1" aria-hidden="true" class="hidden flex overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-md max-h-full">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <!-- Modal header -->
                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                Buat Treatment
                            </h3>
                            <button type="button" id="close-modal" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="crud-modal">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <form method='POST' class="p-4 md:p-5" action="treatment_submit.php">
                            <div class="grid gap-4 mb-4 grid-cols-2">
                                <div class="col-span-2">
                                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Treatment</label>
                                    <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Ketik nama treatment" required="">
                                </div>
                                <div class="col-span-2 sm:col-span-1">
                                    <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Harga</label>
                                    <input type="number" name="price" id="price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="200.000" required="">
                                </div>
                                <div class="col-span-2 sm:col-span-1">
                                    <label for="durasi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Durasi</label>
                                    <input type="text" name="durasi" id="durasi" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="30 Menit" required="">
                                </div>   
                                <div class="col-span-2">
                                    <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi</label>
                                    <textarea id="deskripsi" name="deskripsi" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Ketik deskripsi treatment"></textarea>                    
                                </div>
                            </div>
                            <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                                Add treatment
                            </button>
                        </form>
                    </div>
                </div>
            </div> 

        </div>
    </div>
    
<script>
    fetch('fetch_costumer.php') // Replace with the actual path to your PHP file
        .then(response => response.json())
        .then(data => {

        })
        .catch(error => console.error('Error fetching data:', error));

    const api1 = 'fetch_costumer.php';
    const api2 = 'fetch_treatment.php';

    Promise.all([fetch(api1), fetch(api2)])
    .then(responses => Promise.all(responses.map(response => response.json())))
    .then(data => {
        const [data1, data2] = data; // Destructure results
        console.log('Data from API 1:', data1);
        console.log('Data from API 2:', data2);
        // Assign data to variables
        let costumers = data1.map(costumer => ({
            id: costumer.id,
            nama: costumer.nama,
            nomor_hp: costumer.nomor_hp,
            alamat: costumer.alamat,
            email: costumer.email,
            treatment_id: costumer.treatment_id,
            harga: costumer.harga,
            tanggal_treatment: costumer.tanggal_treatment
        }));

        // Display credentials on the page
        const cardsSection = document.getElementById("cardsSection");
        const treatmentCards = document.getElementById("treatment-cards");
        const paymentHistory = document.getElementById("payment-history");
        const clearButton = document.getElementById("clear-button");

        // Modal
        const modal = document.getElementById("crud-modal");
        const closeModalBtn = document.getElementById("close-modal");
        const modalContent = document.getElementById('modal-content');

        costumers.forEach((costumer, index) => {
            const card = document.createElement("div");
            card.innerHTML = `
                    <div class="bg-white rounded-lg shadow-md p-6 max-w-md mx-auto border">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Treatment</h3>
                        <p class="text-gray-600"><strong>Name: </strong><span class="userName">${costumer.nama}</span></p>
                        <p class="text-gray-600"><strong>Email: </strong><span class="userEmail">${costumer.email}</span></p>
                        <p class="text-gray-600"><strong>Phone: </strong><span id="nomor-hp">${costumer.nomor_hp}</span></p>
                        <p class="text-gray-600"><strong>Service: </strong><span class="userPhone">${costumer.treatment_id}</span></p>
                        <p class="text-gray-600"><strong>Message: </strong><span class="userAddress">${costumer.userMessage}</span></p>
                        <p class="text-gray-600"><strong>Price: </strong>${costumer.harga}</p>
                        <p class="text-gray-600"><strong>Tanggal Treatment: </strong>${costumer.tanggal_treatment}</p>
                        <div class="flex gap-2 mt-4">
                            <button class="open-modal bg-yellow-400 text-white px-3 py-1 rounded-lg hover:bg-yellow-500">
                                Delete
                            </button>
                            <button class="pay-button bg-green-500 text-white px-3 py-1 rounded-lg hover:bg-green-600">
                                Mark as Paid
                            </button>
                        </div>
                    </div>
                `;

            // Add Edit and Pay Event Listeners
            // card.querySelector('.edit-button').addEventListener('click', () => {
            //     const doctor = prompt('Enter Doctor Name:');
            //     const price = prompt('Enter Price:');
            //     userName = prompt('Masukkan Nama:')
            //     if (doctor) card.querySelector('.doctor').textContent = doctor;
            //     if (price) card.querySelector('.price').textContent = price;
            //     if (userName) card.querySelector('.userName').textContent = userName;
            // });

            card.querySelector(".pay-button").addEventListener("click", () => {
            markAsPaid(card);
            });

            // card.querySelector(".open-modal").addEventListener("click", () => {
            // openModal(card);
            // });

            treatmentCards.appendChild(card);
        });

        const openModal = document.getElementById("open-modal")

        openModal.addEventListener('click', () => {
            modal.classList.remove('hidden')
        })

        closeModalBtn.addEventListener('click', () => {
            modal.classList.add('hidden')
        })

        // Mark as Paid
        function markAsPaid(card) {
            card.querySelector(".open-modal").remove();
            card.querySelector(".pay-button").remove();
            const newCard = card.cloneNode(true);
            paymentHistory.appendChild(newCard);
            card.remove();
        }
    })
    .catch(error => console.error('Error fetching APIs:', error));

</script>
</body>

</html>