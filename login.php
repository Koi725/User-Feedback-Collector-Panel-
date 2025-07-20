<?php
session_start();

function login($username, $password) {
  $file = __DIR__ . '/users.json';
  if (!file_exists($file)) return false;

  $data = json_decode(file_get_contents($file), true);
  $users = $data['users'] ?? [];

  foreach ($users as $user) {
    if ($user['username'] === $username && $user['password'] === $password) {
      return $user;
    }
  }
  return false;
}

$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = $_POST['username'] ?? '';
  $password = $_POST['password'] ?? '';

  if (empty($username) || empty($password)) {
    $error = "Username or password cannot be empty!";
  } else {
    $user = login($username, $password);
    if ($user) {
      $_SESSION['username'] = $user['username'];
      $_SESSION['role'] = $user['role'];
      header("Location: dashboard.php");
      exit;
    } else {
      $error = "❌ Invalid username or password!";
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login | Finance Portal</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Orbitron&display=swap" rel="stylesheet">
  <style>
    * {
      box-sizing: border-box;
      font-family: 'Orbitron', sans-serif;
    }

    body {
      background-color: #121212;
      color: #f1f1f1;
      margin: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      background-image: radial-gradient(circle at center, #1f1f1f 0%, #0d0d0d 100%);
    }

    .login-box {
      background: #1e1e1e;
      padding: 40px;
      border-radius: 16px;
      box-shadow: 0 0 30px rgba(0, 255, 255, 0.2);
      width: 100%;
      max-width: 400px;
      text-align: center;
    }

    h2 {
      margin-bottom: 30px;
      color: #00f7ff;
      font-size: 24px;
    }

    input[type="text"],
    input[type="password"] {
      width: 100%;
      padding: 14px;
      margin: 12px 0;
      background: #2b2b2b;
      border: 1px solid #444;
      border-radius: 10px;
      color: #fff;
      font-size: 16px;
    }

    input[type="submit"] {
      width: 100%;
      padding: 14px;
      background-color: #00f7ff;
      color: #000;
      border: none;
      border-radius: 10px;
      font-weight: bold;
      font-size: 16px;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    input[type="submit"]:hover {
      background-color: #00c3cc;
    }

    .message {
      margin-top: 20px;
      color: #ff4d4d;
      font-weight: bold;
    }

    .back-link {
      display: block;
      margin-top: 20px;
      color: #00f7ff;
      text-decoration: none;
      font-size: 14px;
    }

    .back-link:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

  <div class="login-box">
    <h2>Login to Control Panel</h2>
    <form method="POST">
      <input type="text" name="username" placeholder="Username" required>
      <input type="password" name="password" placeholder="Password" required>
      <input type="submit" value="Login">
    </form>

    <?php if ($error): ?>
      <div class="message"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <a class="back-link" href="index.php">← Back to Homepage</a>
  </div>

</body>
</html>
