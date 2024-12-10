<?php include '../db_connection.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Klinik Anvy</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="../assets/img/favicon.png" rel="icon">
    <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="../https://fonts.googleapis.com" rel="preconnect">
    <link href="../https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="../assets/css/main1.css" rel="stylesheet">

    <style>
        /* Centra content secara vertikal dan horizontal */
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #F3F4F6;
            margin: 0;
            font-family: 'Montserrat', sans-serif;
        }

        .form-container {
        background-color: #FFF;
        border-radius: 10px;
        padding: 30px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 600px;
        margin: auto;
        }

        .form-title {
            color: #862B0D;
            font-family: 'Montserrat', sans-serif;
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 30px;
            text-align: center;
        }

        .form-control,
        .form-select {
            border-radius: 10px;
            padding: 12px;
            font-size: 1rem;
            width: 100%;
            /* Mengubah lebar input menjadi 100% */
            margin-bottom: 15px;
            border: 1px solid #ddd;
        }

        .form-label {
            font-weight: 600;
            color: #495057;
        }

        .btn-primary {
            background-color: #FFC95F;
            border: none;
            border-radius: 50px;
            padding: 12px 30px;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            width: 100%;
            margin-bottom: 15px;
        }

        .btn-primary:hover {
            background-color: #ffb84d;
            transform: scale(1.05);
        }

        .btn-secondary {
            background-color: #D1D1D1;
            border: none;
            border-radius: 50px;
            padding: 12px 30px;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            width: 100%;
        }

        .btn-secondary:hover {
            background-color: #b7b7b7;
            transform: scale(1.05);
        }

        .form-control[readonly] {
            background-color: #e9ecef;
        }

        /* Layout adjustments for form */
        .form-group {
            margin-bottom: 20px;
        }

        .form-container form {
            display: flex;
            flex-direction: column;
        }
    </style>
</head>

<body>
    <div class="container" id="form">
        <div class="form-container">
            <h2 class="form-title">Booking Treatment</h2>
            <form action="../src/submit.php" method="POST">
                <div class="form-group">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" name="nama" class="form-control" id="nama" required>
                </div>

                <div class="form-group">
                    <label for="nomor_hp" class="form-label">Nomor HP</label>
                    <input type="text" name="nomor_hp" class="form-control" id="nomor_hp" required>
                </div>

                <div class="form-group">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea name="alamat" class="form-control" id="alamat" required></textarea>
                </div>

                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" id="email" required>
                </div>

                <div class="form-group">
                    <label for="treatment_id" class="form-label">Jenis Treatment</label>
                    <select name="treatment_id" class="form-select" id="treatment_id" required>
                        <option value="" selected>Pilih Treatment</option>
                        <?php
                        $result = $conn->query("SELECT * FROM treatment");
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='{$row['kode']}' data-harga='{$row['harga']}'>{$row['nama_treatment']}</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="harga" class="form-label">Harga</label>
                    <input type="text" id="harga" class="form-control" readonly>
                </div>

                <div class="form-group">
                    <label for="tanggal_treatment" class="form-label">Tanggal Treatment</label>
                    <input type="datetime-local" name="tanggal_treatment" class="form-control" id="tanggal_treatment"
                        required>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="dashboard.php" class="btn btn-secondary">Kembali ke Home</a>
            </form>
        </div>
    </div>

    <script>
        // Script untuk menampilkan harga sesuai treatment
        document.getElementById('treatment_id').addEventListener('change', function () {
            const selectedOption = this.options[this.selectedIndex];
            const harga = selectedOption.getAttribute('data-harga');
            document.getElementById('harga').value = harga ? 'Rp ' + parseInt(harga).toLocaleString('id-ID') : '';
        });
        const user = <?php echo isset($userJson) ? $userJson : 'null'; ?>;
        console.log(user)
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
