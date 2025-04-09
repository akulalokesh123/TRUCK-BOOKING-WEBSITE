<!-- Full Bookstore App with HTML, CSS, and PHP (Simplified for DA Submission) -->
<!-- 1. register.php -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register</title>
  <style>
    body { font-family: Arial; background: #f9f9f9; }
    form { background: #fff; padding: 20px; width: 300px; margin: 50px auto; box-shadow: 0 0 10px #ccc; }
    input { margin: 10px 0; padding: 8px; width: 100%; }
    button { background: #28a745; color: white; padding: 10px; border: none; cursor: pointer; }
    a { display: block; text-align: center; margin-top: 10px; }
  </style>
</head>
<body>
<?php
include "db.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
  $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
  $stmt->bind_param("sss", $name, $email, $password);
  if ($stmt->execute()) {
    echo "<p style='text-align:center;'>Registered successfully. <a href='index.php'>Login</a></p>";
  } else {
    echo "<p style='color:red;'>Error: ".$conn->error."</p>";
  }
}
?>
<form method="post" >
  <h2>Register</h2>
  <input type="text" name="name" placeholder="Full Name" required>
  <input type="email" name="email" placeholder="Email" required>
  <input type="password" name="password" placeholder="Password" required>
  <button type="submit">Register</button>
</form>
</body>
</html>
