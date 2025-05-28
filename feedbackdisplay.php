<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "salon_db";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT name, rating, message, created_at FROM feedback ORDER BY id DESC LIMIT 5";
$result = $conn->query($sql);

if ($result->num_rows > 0): ?>
  <section class="feedback-display">
    <h2>Client Reviews ⭐</h2>
    <?php while($row = $result->fetch_assoc()): ?>
      <div class="feedback-card">
        <h4><?= htmlspecialchars($row['name']) ?> <span class="stars"><?= str_repeat("⭐", $row['rating']) ?></span></h4>
        <p class="msg"><?= nl2br(htmlspecialchars($row['message'])) ?></p>
        <small>Reviewed on <?= date("d M Y", strtotime($row['created_at'])) ?></small>
      </div>
    <?php endwhile; ?>
  </section>
<?php else: ?>
  <p>No feedback yet.</p>
<?php endif;

$conn->close();
?>