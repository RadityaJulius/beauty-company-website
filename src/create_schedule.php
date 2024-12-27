<?php
$host = 'localhost';
$db = 'klinik_db';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $id = $_POST["id"];
    $days = $_POST['days'] ?? [];
    $pagi_start = $_POST['pagi_start'] ?? [];
    $pagi_end = $_POST['pagi_end'] ?? [];
    $sore_start = $_POST['sore_start'] ?? [];
    $sore_end = $_POST['sore_end'] ?? [];


    if(!empty($days) && !empty($pagi_start) && !empty($pagi_end)) {
        $stmt = $pdo->prepare("INSERT INTO staff_schedule (staff_id, day, pagi_start, pagi_end, sore_start, sore_end) VALUES (?, ?, ?, ?, ?, ?)");

        // Loop through each day and insert the corresponding times
        foreach ($days as $day) {
            // Get the times for the current day
            $pagi_start = $_POST['pagi_start'][array_search($day, $days)];
            $pagi_end = $_POST['pagi_end'][array_search($day, $days)];
            $sore_start = $_POST['sore_start'][array_search($day, $days)];
            $sore_end = $_POST['sore_end'][array_search($day, $days)];

            // Execute the prepared statement
            $stmt->execute([$id, $day, $pagi_start, $pagi_end, $sore_start, $sore_end]);
        }

        echo "Entity, days, and shifts saved successfully!";
        header("location: ../public/schedule.php");
    }
    
}

?>