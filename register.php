<?php
session_start();

function register($username, $password) {
  $file = __DIR__ . '/users.json';
  $data = file_exists($file) ? file_get_contents($file) : '{"users":[]}';
  $json = json_decode($data, true);
  $users = $json['users'];

  foreach ($users as $user) {
    if (strtolower($user['username']) === strtolower($username)) {
      return "Username already exists.";
    }
  }

  $users[] = [
    'username' => $username,
    'password' => $password,
    'role'     => 'user'
  ];

  file_put_contents($file, json_encode(['users' => $users], JSON_PRETTY_PRINT));
  return true;
}

function password_check($password) {
  if (strlen($password) < 6) return "Password must be at least 6 characters.";
  if (!preg_match('/[A-Z]/', $password)) return "Password must include at least one uppercase letter.";
  if (!preg_match('/[a-z]/', $password)) return "Password must include at least one lowercase letter.";
  if (!preg_match('/\d/', $password)) return "Password must include at least one number.";
  if (!preg_match('/[^a-zA-Z\d]/', $password)) return "Password must include at least one special character.";
  return true;
}

$error = null;
$success = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = trim($_POST['username']) ?? '';
  $password = $_POST['password'] ?? '';

  if (empty($username) || empty($password)) {
    $error = "Username or password cannot be empty.";
  } else {
    $check = password_check($password);
    if ($check !== true) {
      $error = $check;
    } else {
      $result = register($username, $password);
      if ($result === true) {
        $success = "✅ Registration successful! Welcome, $username.";
      } else {
        $error = $result;
      }
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register | Cyber Portal</title>
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

    .register-box {
      background: #1e1e1e;
      padding: 40px;
      border-radius: 16px;
      box-shadow: 0 0 30px rgba(0, 255, 255, 0.2);
      width: 100%;
      max-width: 420px;
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
      font-weight: bold;
    }

    .error {
      color: #ff4d4d;
    }

    .success {
      color: #00ff99;
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

  <div class="register-box">
    <h2>Create Your Account</h2>
    <form method="POST">
      <input type="text" name="username" placeholder="Username" required>
      <input type="password" name="password" placeholder="Password" required>
      <input type="submit" value="Register">
    </form>

    <?php if ($error): ?>
      <div class="message error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <?php if ($success): ?>
      <div class="message success"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>

    <a class="back-link" href="index.php">← Back to Homepage</a>
  </div>

</body>
</html>
