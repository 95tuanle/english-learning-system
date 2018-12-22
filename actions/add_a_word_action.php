<?php
session_start();

$servername = 's3618861-db.cavq78vobfpn.ap-southeast-1.rds.amazonaws.com';
$username = 'imhikarucat';
$password = '12345abcde';
$schema = 'tuanle';
$port = 3306;

$conn = mysqli_connect($servername, $username, $password, $schema);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO words (word, vietnamese_meaning, similar_words, example_one, example_two) VALUES ('{$_SESSION['$username']}', '{$_SESSION['vietnamese_meaning']}', '{$_SESSION['similar_words']}', '{$_SESSION['example_one']}', '{$_SESSION['example_two']}')";

$sql = "INSERT INTO words (word, vietnamese_meaning, similar_words, example_one, example_two) VALUES ('1', '1', '1', '1', '1')";

mysqli_close($conn);

header("Location: ../manage_words.php");