<?php

$host = "localhost";
$username = "root";
$password = ""; // default XAMPP password is empty
$database = "bookstore";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
