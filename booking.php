<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "salon_db";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function clean($data) {
    return trim($data);
}

$name = clean($_POST['name']);
$phone = clean($_POST['phone']);
$email = clean($_POST['email']);
$service = clean($_POST['service']);
$date = clean($_POST['date']);
$time = clean($_POST['time']);
$note = clean($_POST['note'] ?? '');

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Invalid email format");
}

$stmt = $conn->prepare("INSERT INTO bookings (name, phone, email, service, date, time, note) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssss", $name, $phone, $email, $service, $date, $time, $note);

if ($stmt->execute()) {
    echo "<script>alert('Thank you, your booking is confirmed!'); window.location.href='booking.html';</script>";
} else {
    error_log("DB Error: " . $stmt->error);
    echo "An error occurred while processing your booking.";
}

$stmt->close();
$conn->close();
?>
