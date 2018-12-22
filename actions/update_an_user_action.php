<?php
session_start();
$conn = mysqli_connect("s3618861-db.cavq78vobfpn.ap-southeast-1.rds.amazonaws.com", "imhikarucat", "12345abcde", "tuanle");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "UPDATE users SET username = '{$conn->real_escape_string($_SESSION['username'])}', email = '{$conn->real_escape_string($_SESSION['email'])}', 
is_admin = '{$conn->real_escape_string($_SESSION['is_admin'])}', password = '{$conn->real_escape_string($_SESSION['password'])}' WHERE id='".$_SESSION['id']."'";

if (mysqli_query($conn, $sql)) {
    mysqli_close($conn);
    header("Location: ../manage_users.php");
}
