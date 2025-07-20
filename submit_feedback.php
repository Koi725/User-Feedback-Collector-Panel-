<?php
session_start();

if (!isset($_SESSION['username']) || $_SESSION['role'] === 'admin') {
  header("Location: login.php");
  exit;
}

$username = $_SESSION['username'];
$error = null;
$success = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $title = trim($_POST['title'] ?? '');
  $message = trim($_POST['message'] ?? '');

  if (empty($title) || empty($message)) {
    $error = "Please fill in all fields.";
  } else {
    $file = __DIR__ . '/feedbacks.json';
    $data = file_exists($file) ? json_decode(file_get_contents($file), true) : [];

    if (!isset($data['feedbacks'])) {
      $data['feedbacks'] = [];
    }

    $data['feedbacks'][] = [
      'username' => $username,
      'title'    => $title,
      'message'  => $message,
      'date'     => date('Y-m-d H:i:s')
    ];

    file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT));
    $success = "✅ Feedback submitted successfully!";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Submit Feedback</title>
  <style>
    body {
      background: #121212;
      color: #f1f1f1;
      font-family: 'Segoe UI', sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }
    .form-box {
      background: #1e1e1e;
      padding: 30px;
      border-radius: 16px;
      box-shadow: 0 0 20px rgba(0, 255, 255, 0.2);
      width: 100%;
      max-width: 500px;
    }
    h2 {
      text-align: center;
      color: #00f7ff;
      margin-bottom: 20px;
    }
    input, textarea {
      width: 100%;
      padding: 12px;
      margin: 10px 0;
      background: #2a2a2a;
      border: 1px solid #444;
      border-radius: 10px;
      color: #fff;
      font-size: 16px;
    }
    textarea {
      resize: vertical;
      min-height: 100px;
    }
    button {
      width: 100%;
      padding: 12px;
      background-color: #00f7ff;
      border: none;
      border-radius: 10px;
      color: #000;
      font-weight: bold;
      font-size: 16px;
      cursor: pointer;
      transition: 0.3s;
    }
    button:hover {
      background-color: #00c3cc;
    }
    .message {
      text-align: center;
      margin-top: 15px;
      font-weight: bold;
    }
    .error {
      color: #ff4d4d;
    }
    .success {
      color: #00ff99;
    }
    .back {
      margin-top: 20px;
      text-align: center;
    }
    .back a {
      color: #00f7ff;
      text-decoration: none;
    }
    .back a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

<div class="form-box">
  <h2>Submit Feedback</h2>
  <form method="POST">
    <input type="text" name="title" placeholder="Title" required>
    <textarea name="message" placeholder="Your message here..." required></textarea>
    <button type="submit">Send Feedback</button>
  </form>

  <?php if ($error): ?>
    <div class="message error"><?= htmlspecialchars($error) ?></div>
  <?php elseif ($success): ?>
    <div class="message success"><?= htmlspecialchars($success) ?></div>
  <?php endif; ?>

  <div class="back">
    <a href="dashboard.php">← Back to Dashboard</a>
  </div>
</div>

</body>
</html>
