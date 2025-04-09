<!-- 3. cart.php -->
<?php
include 'db.php';

session_start();
if (!isset($_SESSION['user'])) {
  header("Location: index.php");
  exit();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $_SESSION['cart'] = $_POST['books'];
  header("Location: order.php");
  exit();
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Book Cart</title>
  <style>
    body { font-family: sans-serif; background: #eef; }
    form { background: white; padding: 20px; width: 400px; margin: 40px auto; }
    input { margin: 5px 0; padding: 8px; width: 100%; }
  </style>
</head>
<body>
<h2 style="text-align:center;">Welcome, <?= $_SESSION['user'] ?>!</h2>
<form method="post">
  <h3>Select books and quantity:</h3>
  Book A: <input type="number" name="books[Book A]" min="0"><br>
  Book B: <input type="number" name="books[Book B]" min="0"><br>
  Book C: <input type="number" name="books[Book C]" min="0"><br>
  <button type="submit">Add to Cart</button>
</form>
<a href="logout.php" style="display:block; text-align:center;">Logout</a>
</body>
</html>
