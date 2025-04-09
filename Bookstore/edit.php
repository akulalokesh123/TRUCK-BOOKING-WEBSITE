<?php
include 'db.php';

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM books WHERE id=$id");
$book = $result->fetch_assoc();

if (isset($_POST['update'])) {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $price = $_POST['price'];

    $conn->query("UPDATE books SET title='$title', author='$author', price='$price' WHERE id=$id");
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head><title>Edit Book</title></head>
<body>
    <h2>Edit Book</h2>
    <form method="POST">
        <input type="text" name="title" value="<?= $book['title'] ?>" required><br>
        <input type="text" name="author" value="<?= $book['author'] ?>" required><br>
        <input type="number" step="0.01" name="price" value="<?= $book['price'] ?>" required><br>
        <button type="submit" name="update">Update</button>
    </form>
</body>
</html>
