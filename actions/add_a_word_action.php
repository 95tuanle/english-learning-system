<?php
session_start();

$conn = mysqli_connect("s3618861-db.cavq78vobfpn.ap-southeast-1.rds.amazonaws.com", "imhikarucat", "12345abcde", "tuanle");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "INSERT INTO words (word, vietnamese_meaning, similar_words, example_one, example_two)
VALUES ('{$conn->real_escape_string($_SESSION['word'])}', '{$conn->real_escape_string($_SESSION['vietnamese_meaning'])}',
'{$conn->real_escape_string($_SESSION['similar_words'])}', '{$conn->real_escape_string($_SESSION['example_one'])}', '{$conn->real_escape_string($_SESSION['example_two'])}')";

if (mysqli_query($conn, $sql)) {
    mysqli_close($conn);
    header("Location: ../manage_words.php");
}