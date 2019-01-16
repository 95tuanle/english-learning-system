<?php
    session_start();

    if (!$_SESSION['is_logged_in']) {
        header("Location: login.php");
        exit();
    } else {
        if ($_SESSION['is_admin_logged_in']) {
            header("Location: index.php");
            exit();
        }
    }

    $answer_Err = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["answer"])) {
            $answer_Err = "You need to pick an answer";
        } else {
            if ($_POST['answer'] == $_SESSION['vietnamese_meaning_for_quiz']) {
                $_SESSION['time_ended'] = microtime(true);
                $_SESSION['total_time_spent'] = $_SESSION['time_ended'] - $_SESSION['time_started'];
                header("Location: actions/add_a_record_action.php");
                exit();
            } else {
                $_SESSION['message'] = "Incorrect, try again!";
            }
        }
    }

    if ($_SESSION['learning_word']["id"] == null) {
        header("Location: index.php");
    } else {
        $conn = mysqli_connect("s3618861-db.cavq78vobfpn.ap-southeast-1.rds.amazonaws.com", "imhikarucat", "12345abcde", "tuanle");
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $sql = "SELECT * FROM words WHERE id='".$_SESSION['learning_word']["id"]."'";
        $data = mysqli_query($conn, $sql);
        if (mysqli_num_rows($data) > 0) {
            $_SESSION['learning_word'] = mysqli_fetch_assoc($data);
            $_SESSION['vietnamese_meaning_for_quiz'] = $_SESSION['learning_word']["vietnamese_meaning"];
            $answers = array();
            array_push($answers, $_SESSION['vietnamese_meaning_for_quiz']);
            $sql = "SELECT * FROM words WHERE NOT id='".$_SESSION['learning_word']["id"]."' ORDER BY RAND() LIMIT 3";
            $data = mysqli_query($conn, $sql);
            if (mysqli_num_rows($data) > 0) {
                while($row = mysqli_fetch_assoc($data)) {
                    array_push($answers, $row["vietnamese_meaning"]);
                }
            }
            if (sizeof($answers) < 4) {
                header("Location: do_a_mini_quiz.php?id=$id");
            } else {
                shuffle($answers);
            }
        }
        mysqli_close($conn);
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Do a Mini Quiz</title>
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
        <li class="nav-item">
            <a class="nav-link" href="manage_words.php">Manage words</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="learn_a_random_word.php">Learn a random word</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="logout.php">Sign out</a>
        </li>
    </ul>
</nav>
<br>

<div class="container">
    <?php
        if (isset($_SESSION['message'])) {
            echo "<div class=\"alert alert-danger\">{$_SESSION['message']}</div>";
            unset($_SESSION['message']);
        }
    ?>
    <h3>What is the Vietnamese meaning of "<?php echo $_SESSION['learning_word']["word"]?>"?</h3>
    <form action=" <?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?> " method="post">
        <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" name="answer" value="<?php echo $answers[0]?>" <?php if ($_POST['answer']==$answers[0]) {echo "checked";} ?> id="<?php echo $answers[0]?>" class="custom-control-input">
            <label class="custom-control-label" for="<?php echo $answers[0]?>"><?php echo $answers[0]?></label>
        </div>
        <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" name="answer" value="<?php echo $answers[1]?>" <?php if ($_POST['answer']==$answers[1]) {echo "checked";} ?> id="<?php echo $answers[1]?>" class="custom-control-input">
            <label class="custom-control-label" for="<?php echo $answers[1]?>"><?php echo $answers[1]?></label>
        </div>
        <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" name="answer" value="<?php echo $answers[2]?>" <?php if ($_POST['answer']==$answers[2]) {echo "checked";} ?> id="<?php echo $answers[2]?>" class="custom-control-input">
            <label class="custom-control-label" for="<?php echo $answers[2]?>"><?php echo $answers[2]?></label>
        </div>
        <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" name="answer" value="<?php echo $answers[3]?>" <?php if ($_POST['answer']==$answers[3]) {echo "checked";} ?> id="<?php echo $answers[3]?>" class="custom-control-input">
            <label class="custom-control-label" for="<?php echo $answers[3]?>"><?php echo $answers[3]?></label>
        </div>
            <span class="error">* <?php echo $answer_Err;?></span>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>


<br>
<footer class="page-footer font-small lighten-5"">
<div class="footer-copyright text-center text-black-50 py-3">
    <p>Copyright &copy; <?php echo date('Y') ?> Tuan Le & Toan Do</p>
</div>
</body>
</html>