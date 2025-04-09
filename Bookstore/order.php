<?php
include 'db.php';
session_start();

// Check if user and cart are set
if (!isset($_SESSION['user']) || !isset($_SESSION['email']) || !isset($_SESSION['cart'])) {
  echo "<p style='color:red;'>Session expired. <a href='cart.php'>Go back</a></p>";
  exit();
}

$userName = $_SESSION['user'];
$userEmail = $_SESSION['email'];
$cart = $_SESSION['cart'];

// Fetch user ID from the database using email
$stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
$stmt->bind_param("s", $userEmail);
$stmt->execute();
$result = $stmt->get_result();
$userData = $result->fetch_assoc();

if (!$userData) {
  echo "<p style='color:red;'>User not found in database.</p>";
  exit();
}

$userId = $userData['id'];

// Prepare order details string
$orderDetails = '';
foreach ($cart as $book => $qty) {
  if ((int)$qty > 0) {
    $orderDetails .= "$book - Qty: $qty\n";
  }
}

// Insert order into database
$stmt = $conn->prepare("INSERT INTO orders (user_id, details) VALUES (?, ?)");
if ($stmt) {
  $stmt->bind_param("is", $userId, $orderDetails);
  $stmt->execute();
} else {
  echo "<p style='color:red;'>Order insert failed. Check your 'orders' table structure.</p>";
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Order Summary</title>
  <style>
    body { font-family: sans-serif; background: #f4f4f4; padding: 20px; }
    .summary { background: #fff; padding: 20px; width: 400px; margin: auto; }
  </style>
</head>
<body>
  <div class="summary">
    <h2>Order Summary</h2>
    <?php foreach ($_SESSION['cart'] as $book => $qty): ?>
      <?php if ((int)$qty > 0): ?>
        <p><?= htmlspecialchars($book) ?> - Qty: <?= (int)$qty ?></p>
      <?php endif; ?>
    <?php endforeach; ?>
    <p><strong>Thank you for your order, <?= htmlspecialchars($_SESSION['user']) ?>!</strong></p>
    <a href="logout.php">Logout</a>
  </div>
</body>
</html>
