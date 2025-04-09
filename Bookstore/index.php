<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <style>
    body { font-family: Arial; background: #f0f0f0; }
    form {
      background: white;
      padding: 20px;
      width: 300px;
      margin: 60px auto;
      box-shadow: 0 0 10px gray;
    }
    input, button {
      margin-top: 10px;
      padding: 10px;
      width: 100%;
    }
  </style>
</head>
<body>

<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $email = $_POST['email'];
  $password = $_POST['password'];

  $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $result = $stmt->get_result();
  $user = $result->fetch_assoc();

  if ($user && password_verify($password, $user['password'])) {
    // Save both name and email in session
    $_SESSION['user'] = $user['name'];
    $_SESSION['email'] = $user['email'];
    header("Location: cart.php");
    exit();
  } else {
    echo "<p style='text-align:center; color:red;'>Invalid email or password</p>";
  }
}
?>

<form method="post">
  <h2>Login</h2>
  <input type="email" name="email" placeholder="Email" required>
  <input type="password" name="password" placeholder="Password" required>
  <button type="submit">Login</button>
  <a href="register.php">New user? Register</a>
</form>

</body>
</html>
