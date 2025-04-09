<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Book List</title>
</head>
<body>
    <h2>Book List</h2>
    <a href="create.php">Add New Book</a>
    <table border="1" cellpadding="10">
        <tr><th>ID</th><th>Title</th><th>Author</th><th>Price</th><th>Actions</th></tr>
        <?php
        $result = $conn->query("SELECT * FROM books");
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['title']}</td>
                <td>{$row['author']}</td>
                <td>\${$row['price']}</td>
                <td>
                    <a href='edit.php?id={$row['id']}'>Edit</a> |
                    <a href='delete.php?id={$row['id']}'>Delete</a>
                </td>
            </tr>";
        }
        ?>
    </table>
</body>
</html>
