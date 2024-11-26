<?php
// Koneksi ke database
$host = "localhost";
$user = "root";
$password = "";
$database = "db_testimoni";

$conn = new mysqli($host, $user, $password, $database);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Proses form jika data dikirim
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = htmlspecialchars(trim($_POST["name"]));
    $testimonial = htmlspecialchars(trim($_POST["testimonial"]));

    if (!empty($name) && !empty($testimonial)) {
        $stmt = $conn->prepare("INSERT INTO testimonials (name, testimonial) VALUES (?, ?)");
        $stmt->bind_param("ss", $name, $testimonial);
        $stmt->execute();
        $success = "Testimoni berhasil ditambahkan!";
        $stmt->close();
    } else {
        $error = "Semua kolom wajib diisi.";
    }
}

// Ambil semua testimoni dari database
$result = $conn->query("SELECT * FROM testimonials ORDER BY date DESC");
$testimonials = $result->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Testimoni</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .form-container {
            margin-bottom: 20px;
        }
        .form-container input, .form-container textarea {
            display: block;
            margin: 10px 0;
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
        }
        .testimonials {
            margin-top: 20px;
        }
        .testimonial-item {
            border-bottom: 1px solid #ccc;
            padding: 10px 0;
        }
        .testimonial-item:last-child {
            border-bottom: none;
        }
    </style>
</head>
<body>
    <h1>Testimoni</h1>
    <div class="form-container">
        <h2>Tambahkan Testimoni</h2>
        <?php if (!empty($success)): ?>
            <p style="color: green;"><?= $success; ?></p>
        <?php endif; ?>
        <?php if (!empty($error)): ?>
            <p style="color: red;"><?= $error; ?></p>
        <?php endif; ?>
        <form action="" method="POST">
            <input type="text" name="name" placeholder="Nama Anda" required>
            <textarea name="testimonial" placeholder="Tulis testimoni Anda..." rows="5" required></textarea>
            <button type="submit">Kirim</button>
        </form>
    </div>
    <div class="testimonials">
        <h2>Daftar Testimoni</h2>
        <?php if (!empty($testimonials)): ?>
            <?php foreach ($testimonials as $testimonial): ?>
                <div class="testimonial-item">
                    <p><strong><?= htmlspecialchars($testimonial["name"]); ?></strong> (<?= htmlspecialchars($testimonial["date"]); ?>)</p>
                    <p><?= htmlspecialchars($testimonial["testimonial"]); ?></p>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Belum ada testimoni.</p>
        <?php endif; ?>
    </div>
</body>
</html>
[12.29, 19/11/2024] Charissa gundar: <?php
// Koneksi ke database
$host = "localhost";
$user = "root";
$password = "";
$database = "db_testimoni";

$conn = new mysqli($host, $user, $password, $database);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Proses form jika data dikirim
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = htmlspecialchars(trim($_POST["name"]));
    $testimonial = htmlspecialchars(trim($_POST["testimonial"]));

    if (!empty($name) && !empty($testimonial)) {
        $stmt = $conn->prepare("INSERT INTO testimonials (name, testimonial) VALUES (?, ?)");
        $stmt->bind_param("ss", $name, $testimonial);
        $stmt->execute();
        $success = "Testimoni berhasil ditambahkan!";
        $stmt->close();
    } else {
        $error = "Semua kolom wajib diisi.";
    }
}

// Ambil semua testimoni dari database
$result = $conn->query("SELECT * FROM testimonials ORDER BY date DESC");
$testimonials = $result->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Testimoni</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .form-container {
            margin-bottom: 20px;
        }
        .form-container input, .form-container textarea {
            display: block;
            margin: 10px 0;
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
        }
        .testimonials {
            margin-top: 20px;
        }
        .testimonial-item {
            border-bottom: 1px solid #ccc;
            padding: 10px 0;
        }
        .testimonial-item:last-child {
            border-bottom: none;
        }
    </style>
</head>
<body>
    <h1>Testimoni</h1>
    <div class="form-container">
        <h2>Tambahkan Testimoni</h2>
        <?php if (!empty($success)): ?>
            <p style="color: green;"><?= $success; ?></p>
        <?php endif; ?>
        <?php if (!empty($error)): ?>
            <p style="color: red;"><?= $error; ?></p>
        <?php endif; ?>
        <form action="" method="POST">
            <input type="text" name="name" placeholder="Nama Anda" required>
            <textarea name="testimonial" placeholder="Tulis testimoni Anda..." rows="5" required></textarea>
            <button type="submit">Kirim</button>
        </form>
    </div>
    <div class="testimonials">
        <h2>Daftar Testimoni</h2>
        <?php if (!empty($testimonials)): ?>
            <?php foreach ($testimonials as $testimonial): ?>
                <div class="testimonial-item">
                    <p><strong><?= htmlspecialchars($testimonial["name"]); ?></strong> (<?= htmlspecialchars($testimonial["date"]); ?>)</p>
                    <p><?= htmlspecialchars($testimonial["testimonial"]); ?></p>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Belum ada testimoni.</p>
        <?php endif; ?>
    </div>
</body>
</html>