<?php
session_start();

$conn = mysqli_connect("s3618861-db.cavq78vobfpn.ap-southeast-1.rds.amazonaws.com", "imhikarucat", "12345abcde", "tuanle");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "INSERT INTO users (username, email, is_admin, password)
VALUES ('{$conn->real_escape_string($_SESSION['username'])}', '{$conn->real_escape_string($_SESSION['email'])}',
'{$conn->real_escape_string($_SESSION['is_admin'])}', '{$conn->real_escape_string($_SESSION['password'])}')";

if (mysqli_query($conn, $sql)) {
    mysqli_close($conn);
    header("Location: ../manage_users.php");
}

