<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "salon_db";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

function clean($data, $conn) {
  return htmlspecialchars($conn->real_escape_string(trim($data)));
}

$name = clean($_POST['name'], $conn);
$email = clean($_POST['email'], $conn);
$rating = clean($_POST['rating'], $conn);
$message = clean($_POST['message'], $conn);

$sql = "INSERT INTO feedback (name, email, rating, message)
        VALUES ('$name', '$email', '$rating', '$message')";

if ($conn->query($sql) === TRUE) {
  echo "<script>alert('Thank you for your feedback!'); window.location.href='feedback.html';</script>";
} else {
  echo "Error: " . $conn->error;
}

$conn->close();
?>