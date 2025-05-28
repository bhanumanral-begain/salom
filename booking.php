<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "salon_db";

// Create connection
$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Sanitize input to avoid SQL injection
function clean($data, $conn) {
    return htmlspecialchars($conn->real_escape_string(trim($data)));
}

$name = clean($_POST['name'], $conn);
$phone = clean($_POST['phone'], $conn);
$email = clean($_POST['email'], $conn);
$service = clean($_POST['service'], $conn);
$date = clean($_POST['date'], $conn);
$time = clean($_POST['time'], $conn);
$note = clean($_POST['note'] ?? '', $conn);

$sql = "INSERT INTO bookings (name, phone, email, service, date, time, note)
        VALUES ('$name', '$phone', '$email', '$service', '$date', '$time', '$note')";

if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Thank you, your booking is confirmed!'); window.location.href='booking.html';</script>";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>