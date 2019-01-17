<?php
session_start();

if (!$_SESSION['is_logged_in']) {
    header("Location: ../login.php");
    exit();
} else {
    if (empty($_SESSION['time_started']) || empty($_SESSION['time_ended']) || empty($_SESSION['total_time_spent']) || empty($_SESSION['user_id']) || empty($_SESSION['learning_word']["id"])) {
        header("Location: ../index.php");
        exit();
    } else {
        $conn = mysqli_connect("s3618861-db.cavq78vobfpn.ap-southeast-1.rds.amazonaws.com", "imhikarucat", "12345abcde", "tuanle");
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $sql = "INSERT INTO records (learner_id, word_id, time_started, time_ended, total_time_spent)
VALUES ('{$_SESSION['user_id']}', '{$_SESSION['learning_word']["id"]}', 
'{$conn->real_escape_string($_SESSION['time_started'])}', '{$conn->real_escape_string($_SESSION['time_ended'])}', 
'{$conn->real_escape_string($_SESSION['total_time_spent'])}')";

        if (mysqli_query($conn, $sql)) {
            mysqli_close($conn);
            unset($_SESSION['time_started']);
            unset($_SESSION['time_ended']);
            unset($_SESSION['total_time_spent']);
            unset($_SESSION['message_for_learning_mode']);
            unset($_SESSION['learning_word']);
            $_SESSION['learning_randomly'] = false;
            $_SESSION['learning_sequentially'] = false;
            $_SESSION['is_timing'] = false;
            header("Location: ../congratulation.php");
            exit();
        }
    }

}
