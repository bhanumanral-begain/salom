<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "salon_db";

// database connection..
$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get latest 5 feedbacks
$sql = "SELECT name, rating, message, created_at FROM feedback ORDER BY id DESC LIMIT 5";
$result = $conn->query($sql);

if ($result->num_rows > 0): ?>
  <section class="feedback-display">
    <h2>Client Reviews ⭐</h2>
    <?php while ($row = $result->fetch_assoc()):
        $name = htmlspecialchars($row['name']);
        $rating = max(0, min(5, (int)$row['rating']));
        $message = nl2br(htmlspecialchars($row['message']));
        $createdAt = strtotime($row['created_at']);
        $formattedDate = $createdAt ? date("d M Y", $createdAt) : 'Unknown date';
    ?>
      <div class="feedback-card">
        <h4 class="feedback-name">
          <?= $name ?>
          <span class="stars"><?= str_repeat("⭐", $rating) ?></span>
        </h4>
        <p class="feedback-message"><?= $message ?></p>
        <small class="feedback-date">Reviewed on <?= $formattedDate ?></small>
      </div>
    <?php endwhile; ?>
  </section>
<?php else: ?>
  <p>No feedback yet.</p>
<?php endif;

$conn->close();
?>
