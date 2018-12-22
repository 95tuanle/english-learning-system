<?php
session_start();
$conn = mysqli_connect("s3618861-db.cavq78vobfpn.ap-southeast-1.rds.amazonaws.com", "imhikarucat", "12345abcde", "tuanle");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "UPDATE words SET word = '{$conn->real_escape_string($_SESSION['word'])}', 
vietnamese_meaning = '{$conn->real_escape_string($_SESSION['vietnamese_meaning'])}', 
similar_words = '{$conn->real_escape_string($_SESSION['similar_words'])}', example_one = '{$conn->real_escape_string($_SESSION['example_one'])}', 
example_two = '{$conn->real_escape_string($_SESSION['example_two'])}' WHERE id='".$_SESSION['id']."'";

if (mysqli_query($conn, $sql)) {
    mysqli_close($conn);
    header("Location: ../manage_words.php");
}