<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Welcome | My Finance Panel</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: 'Roboto', sans-serif;
    }

    body {
      background: linear-gradient(135deg, #4facfe, #00f2fe);
      color: #333;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .container {
      background: white;
      padding: 50px;
      border-radius: 16px;
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
      text-align: center;
      max-width: 500px;
      width: 100%;
    }

    h2 {
      font-size: 28px;
      margin-bottom: 15px;
      color: #222;
    }

    p {
      margin-bottom: 30px;
      color: #555;
    }

    .btn-group {
      display: flex;
      justify-content: center;
      gap: 20px;
    }

    .btn {
      padding: 12px 25px;
      background: #007bff;
      color: white;
      text-decoration: none;
      border-radius: 8px;
      font-weight: bold;
      transition: background 0.3s;
    }

    .btn:hover {
      background: #0056b3;
    }
  </style>
</head>
<body>

  <div class="container">
    <h2>Welcome to My Finance Panel</h2>
    <p>Please login to your account or create one if you're new!</p>

    <div class="btn-group">
      <a href="login.php" class="btn">Login</a>
      <a href="register.php" class="btn">Register</a>
    </div>
  </div>

</body>
</html>
