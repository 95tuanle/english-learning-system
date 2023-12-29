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
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Congratulation</title>
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

<div class="container">
  <h1 class="display-1">CONGRATULATION!!!</h1>
</div>


<br>
<footer class="page-footer font-small lighten-5"
">
<div class="footer-copyright text-center text-black-50 py-3">
  <p>Copyright &copy; <?php echo date('Y') ?> Tuan Le & Toan Do</p>
</div>
</body>
</html>