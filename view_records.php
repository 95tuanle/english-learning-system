<?php
session_start();
if (!$_SESSION['is_logged_in']) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Achievements</title>
    <meta charset="utf-8">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

    <link rel="icon" href="assets/logo.png" type="image/png"
</head>
<body>
<div class="jumpotron-fluid">
    <img src="assets/banner.png" class="img-fluid" alt="">
</div>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark sticky-top justify-content-center">
    <a class="navbar-brand" href="index.php"><img src="assets/logo.png" width="30" height="30" alt=""></a>
    <ul class="navbar-nav">
        <?php
        if ($_SESSION['is_admin_logged_in']) {
            echo "<li class='nav-item'><a class='nav-link' href='add_a_word.php'>Add a word</a></li>";
        }
        ?>
        <li class="nav-item">
            <a class="nav-link" href="manage_words.php">Manage words</a>
        </li>
        <li class="nav-item">
            <?php
            if ($_SESSION['is_admin_logged_in']) {
                echo "<a class='nav-link' href='add_an_user.php'>Add an user</a>";
            } else {
                echo "<a class='nav-link' href='learn_a_random_word.php'>Learn a random word</a>";
            }
            ?>
        </li>
        <?php
        if ($_SESSION['is_admin_logged_in']) {
            echo "<li class='nav-item'><a class='nav-link' href='manage_users.php'>Manage users</a></li>";
        } else {
            echo "<li class='nav-item'><a class='nav-link' href='learn_a_sequence_word.php'>Learn a sequence word</a></li>";
        }
        ?>
        <li class="nav-item active">
            <a class="nav-link" href="view_records.php">Achievements</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="logout.php">Sign out</a>
        </li>
    </ul>
</nav>
<br>
<div class="container text-dark">
    <h2>Achievements</h2>
    <table class="table">
        <thead>
        <tr>
            <?php
                if ($_SESSION['is_admin_logged_in']) {
                    echo "<th>Learner ID</th>";
                }
            ?>
            <th>Word ID</th>
            <th>Time started</th>
            <th>Time ended</th>
            <th>Total time spent</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $conn = mysqli_connect("s3618861-db.cavq78vobfpn.ap-southeast-1.rds.amazonaws.com", "imhikarucat", "12345abcde", "tuanle");
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        if ($_SESSION['is_admin_logged_in']) {
            $sql = "SELECT * FROM records";
        } else {
            $sql = "SELECT * FROM records WHERE learner_id='".$_SESSION['user_id']."'";

        }
        $data = mysqli_query($conn, $sql);
        if (mysqli_num_rows($data) > 0) {
            while($row = mysqli_fetch_assoc($data)) {
                $learner_id = $row["learner_id"];
                $word_id = $row["word_id"];
                $time_started = $row["time_started"];
                $time_ended = $row["time_ended"];
                $total_time_spent = $row["total_time_spent"];
                echo "<tr>";
                if ($_SESSION['is_admin_logged_in']) {
                    echo "<td>$learner_id</td>";
                }
                echo "<td>$word_id</td>";
                $time_started = date("d-M-Y h:i:s",$time_started);
                echo "<td>$time_started</td>";
                $time_ended = date("d-M-Y h:i:s",$time_ended);
                echo "<td>$time_ended</td>";
                $total_time_spent = date("i:s",$total_time_spent);
                echo "<td>$total_time_spent</td>";
                echo "</tr>";
            }
        } else {
            echo "You have no achievement";
        }
        mysqli_close($conn);
        ?>
        </tbody>
    </table>
</div>
<br>
<footer class="page-footer font-small lighten-5"">
<div class="footer-copyright text-center text-black-50 py-3">
    <p>Copyright &copy; <?php echo date('Y') ?> Tuan Le & Toan Do</p>
</div>
</body>
</html>