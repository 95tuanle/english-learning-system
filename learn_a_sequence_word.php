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
if ($_SESSION['learning_randomly']) {
    header("Location: learn_a_random_word.php");
    exit();
} else {
    if (!$_SESSION['is_timing']) {
        $_SESSION['time_started'] = microtime(true);
        $_SESSION['is_timing'] = true;
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Learn a Sequence Word</title>
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
    <li class="nav-item active">
      <a class="nav-link" href="learn_a_sequence_word.php">Learn a sequence word</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="view_records.php">Achievements</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="logout.php">Sign out</a>
    </li>
  </ul>
</nav>
<br>
<?php
$conn = mysqli_connect("s3618861-db.cavq78vobfpn.ap-southeast-1.rds.amazonaws.com", "imhikarucat", "12345abcde", "tuanle");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
if ($_SESSION['learning_sequentially']) {
    $sql = "SELECT * FROM words  WHERE id='" . $_SESSION['learning_word']["id"] . "'";
    $data = mysqli_query($conn, $sql);
    if (mysqli_num_rows($data) > 0) {
        $_SESSION['learning_word'] = mysqli_fetch_assoc($data);
        $word = $_SESSION['learning_word']["word"];
        $vietnamese_meaning = $_SESSION['learning_word']["vietnamese_meaning"];
        $similar_words = $_SESSION['learning_word']["similar_words"];
        $example_one = $_SESSION['learning_word']["example_one"];
        $example_two = $_SESSION['learning_word']["example_two"];
        echo "<div class='container'>";
        if (isset($_SESSION['message_for_learning_mode'])) {
            echo "<div class=\"alert alert-warning\">{$_SESSION['message_for_learning_mode']}</div>";
            unset($_SESSION['message_for_learning_mode']);
        }
        echo "<h1>Word: $word</h1>";
        echo "<br>";
        echo "<p>Vietnamese meaning: $vietnamese_meaning</p>";
        echo "<p>Similar words: $similar_words</p>";
        echo "<p>Example 1: $example_one</p>";
        echo "<p>Example 2: $example_two</p>";
        echo "<a href='do_a_mini_quiz.php'>Do a mini quiz</a>";
        echo "</div>";
        $_SESSION['learning_randomly'] = false;
        $_SESSION['learning_sequentially'] = true;
        $_SESSION['message_for_learning_mode'] = "You have to complete learning this word in order to learn another word!";
    }
} else {
    if (isset($_SESSION['previous_learned_id'])) {
        $sql = "SELECT COUNT(id) AS number_of_rows FROM words;";
        $data = mysqli_query($conn, $sql);
        if (mysqli_num_rows($data) > 0) {
            $_SESSION['number_of_rows'] = mysqli_fetch_assoc($data);
            if ($_SESSION['previous_learned_id'] < $_SESSION['number_of_rows']['number_of_rows'] - 1) {
                $_SESSION['previous_learned_id'] += 1;
            } else {
                $_SESSION['previous_learned_id'] = 0;
            }
        }
    } else {
        $_SESSION['previous_learned_id'] = 0;
    }
    $sql = "SELECT * FROM words";
    $data = mysqli_query($conn, $sql);
    $words = array();
    if (mysqli_num_rows($data) > 0) {
        while ($row = mysqli_fetch_assoc($data)) {
            array_push($words, $row);
        }
    }
    $_SESSION['learning_word'] = $words[$_SESSION['previous_learned_id']];
    $word = $_SESSION['learning_word']["word"];
    $vietnamese_meaning = $_SESSION['learning_word']["vietnamese_meaning"];
    $similar_words = $_SESSION['learning_word']["similar_words"];
    $example_one = $_SESSION['learning_word']["example_one"];
    $example_two = $_SESSION['learning_word']["example_two"];
    echo "<div class='container'>";
    if (isset($_SESSION['message_for_learning_mode'])) {
        echo "<div class=\"alert alert-warning\">{$_SESSION['message_for_learning_mode']}</div>";
        unset($_SESSION['message_for_learning_mode']);
    }
    echo "<h1>Word: $word</h1>";
    echo "<br>";
    echo "<p>Vietnamese meaning: $vietnamese_meaning</p>";
    echo "<p>Similar words: $similar_words</p>";
    echo "<p>Example 1: $example_one</p>";
    echo "<p>Example 2: $example_two</p>";
    echo "<a href='do_a_mini_quiz.php'>Do a mini quiz</a>";
    echo "</div>";
    $_SESSION['learning_randomly'] = false;
    $_SESSION['learning_sequentially'] = true;
    $_SESSION['message_for_learning_mode'] = "You have to complete learning this word in order to learn another word!";
}


mysqli_close($conn);
?>
<br>
<footer class="page-footer font-small lighten-5"
">
<div class="footer-copyright text-center text-black-50 py-3">
  <p>Copyright &copy; <?php echo date('Y') ?> Tuan Le & Toan Do</p>
</div>
</body>
</html>