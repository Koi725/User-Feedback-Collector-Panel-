<?php
  session_start();

  if(!isset($_SESSION['username']) || !isset($_SESSION['role'])){
    header("Location: login.php");
    exit;
  }

  $username = $_SESSION['username'];
  $role = $_SESSION['role'];

  $welcome = $role =='admin' ? "welcome Admin 👑 " : "Welcome $username 🙌" 
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Dashboard</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', sans-serif;
      background: #121212;
      color: #f1f1f1;
    }

    .dashboard-container {
      max-width: 800px;
      margin: 80px auto;
      background: #1e1e1e;
      padding: 40px;
      border-radius: 16px;
      box-shadow: 0 0 20px rgba(255,255,255,0.05);
    }

    h1 {
      text-align: center;
      margin-bottom: 30px;
      color: #00ffcc;
    }

    .actions {
      display: flex;
      flex-direction: column;
      gap: 16px;
    }

    a {
      padding: 12px 20px;
      border: 1px solid #00ffcc;
      border-radius: 10px;
      color: #00ffcc;
      text-align: center;
      text-decoration: none;
      font-weight: bold;
      transition: 0.3s;
    }

    a:hover {
      background-color: #00ffcc;
      color: #121212;
    }

    .logout {
      margin-top: 30px;
      text-align: center;
    }
    .logout a {
      color: #ff4d4d;
      border-color: #ff4d4d;
    }
    .logout a:hover {
      background: #ff4d4d;
      color: white;
    }
  </style>
</head>
<body>
  <div class="dashboard-container">
    <h1><?= $welcome ?></h1>

    <div class="actions">
      <?php if ($role === 'admin'): ?>
        <a href="view_all_feedbacks.php">📝 View All Feedbacks</a>
      <?php else: ?>
        <a href="submit_feedback.php">💬 Submit Feedback</a>
        <a href="view_feedbacks.php">📄 View My Feedback</a>
      <?php endif; ?>
    </div>

    <div class="logout">
      <a href="logout.php">🚪 Logout</a>
    </div>
  </div>
</body>
</html>