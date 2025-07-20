<?php
session_start();

if (!isset($_SESSION['username']) || $_SESSION['role'] === 'admin') {
  header("Location: login.php");
  exit;
}

$username = $_SESSION['username'];
$feedbacks = [];
$file = __DIR__ . '/feedbacks.json';

if (file_exists($file)) {
  $all = json_decode(file_get_contents($file), true);
  foreach ($all as $entry) {
    if ($entry['username'] === $username) {
      $feedbacks[] = $entry;
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>My Feedbacks</title>
  <style>
    body {
      background: #121212;
      color: #f1f1f1;
      font-family: 'Segoe UI', sans-serif;
      padding: 40px;
    }

    h2 {
      color: #00f7ff;
      text-align: center;
      margin-bottom: 30px;
    }

    .feedback {
      background: #1e1e1e;
      border: 1px solid #333;
      padding: 20px;
      border-radius: 12px;
      margin-bottom: 20px;
      box-shadow: 0 0 10px rgba(0, 255, 255, 0.1);
    }

    .feedback h3 {
      margin-top: 0;
      color: #00ffcc;
    }

    .feedback p {
      margin: 5px 0;
    }

    .feedback small {
      color: #888;
    }

    .back {
      text-align: center;
      margin-top: 30px;
    }

    .back a {
      color: #00f7ff;
      text-decoration: none;
      font-weight: bold;
    }

    .back a:hover {
      text-decoration: underline;
    }

    .no-feedback {
      text-align: center;
      font-size: 18px;
      color: #bbb;
    }
  </style>
</head>
<body>

  <h2>My Submitted Feedbacks</h2>

  <?php if (count($feedbacks) > 0): ?>
    <?php foreach ($feedbacks as $item): ?>
      <div class="feedback">
        <h3><?= htmlspecialchars($item['title']) ?></h3>
        <p><?= nl2br(htmlspecialchars($item['message'])) ?></p>
        <small>Submitted on: <?= htmlspecialchars($item['date']) ?></small>
      </div>
    <?php endforeach; ?>
  <?php else: ?>
    <div class="no-feedback">You haven't submitted any feedback yet.</div>
  <?php endif; ?>

  <div class="back">
    <a href="dashboard.php">← Back to Dashboard</a>
  </div>

</body>
</html>
