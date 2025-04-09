<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Book</title>
</head>
<body>
    <h2>Add Book</h2>
    <form method="POST">
        <input type="text" name="title" placeholder="Title" required><br>
        <input type="text" name="author" placeholder="Author" required><br>
        <input type="number" step="0.01" name="price" placeholder="Price" required><br>
        <button type="submit" name="save">Save</button>
    </form>

    <?php
    if (isset($_POST['save'])) {
        $title = $_POST['title'];
        $author = $_POST['author'];
        $price = $_POST['price'];

        $conn->query("INSERT INTO books (title, author, price) VALUES ('$title', '$author', '$price')");
        header("Location: index.php");
    }
    ?>
</body>
</html>
