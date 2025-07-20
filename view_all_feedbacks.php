<?php
session_start();

// Allow only admin users
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
  header("Location: login.php");
  exit;
}

$feedbacks = [];
$file = __DIR__ . '/feedbacks.json';

if (file_exists($file)) {
  $data = json_decode(file_get_contents($file), true);
  $feedbacks = $data['feedbacks'] ?? [];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>All Feedbacks | Admin Panel</title>
  <style>
    body {
      background-color: #0d0d0d;
      color: #f1f1f1;
      font-family: 'Segoe UI', sans-serif;
      padding: 40px;
    }

    .container {
      max-width: 900px;
      margin: auto;
      background: #1e1e1e;
      padding: 30px;
      border-radius: 16px;
      box-shadow: 0 0 25px rgba(0,255,255,0.1);
    }

    h2 {
      text-align: center;
      color: #00f7ff;
      margin-bottom: 25px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    th, td {
      padding: 12px;
      border: 1px solid #333;
      text-align: left;
    }

    th {
      background-color: #00f7ff;
      color: #000;
    }

    tr:nth-child(even) {
      background-color: #2a2a2a;
    }

    .back {
      display: block;
      margin-top: 30px;
      text-align: center;
      text-decoration: none;
      color: #00f7ff;
      font-weight: bold;
    }

    .back:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>📝 All Submitted Feedbacks</h2>

    <?php if (empty($feedbacks)): ?>
      <p style="text-align: center; color: gray;">No feedbacks submitted yet.</p>
    <?php else: ?>
      <table>
        <thead>
          <tr>
            <th>User</th>
            <th>Message</th>
            <th>Date</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($feedbacks as $fb): ?>
            <tr>
              <td><?= htmlspecialchars($fb['username']) ?></td>
              <td><?= htmlspecialchars($fb['message']) ?></td>
              <td><?= htmlspecialchars($fb['date']) ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    <?php endif; ?>

    <a class="back" href="dashboard.php">← Back to Dashboard</a>
  </div>
</body>
</html>
