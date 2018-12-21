<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>English Learning System</title>
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
    <img src="assets/banner.png" class="img-fluid">
</div>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark sticky-top justify-content-center">
    <a class="navbar-brand" href="index.php"><img src="assets/logo.png" width="30" height="30" alt=""></a>
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="add_a_word.php">Add word</a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="manage_words.php">Manage words</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="logout.php">Sign out</a>
        </li>
    </ul>
</nav>
<br>
<div class="container text-dark">
    <h2>Words</h2>
    <table class="table">
        <thead>
        <tr>
            <th>Word</th>
            <th>Vietnamese meaning</th>
            <th>Similar words</th>
            <th>Example 1</th>
            <th>Example 1</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $dataAsArray;
//        for ($position = 0; $position < count($dataAsArray); $position++) {
//            $fields = explode(",", $dataAsArray[$position]);
//            echo "<tr>";
//            echo "<td>$fields[0]</td>";
//            echo "<td>$fields[1]</td>";
//            echo "<td>$fields[2]</td>";
//            echo "<td>$fields[3]</td>";
//            echo "<td>$fields[4]</td>";
//            echo "<td><a type='button' class='btn btn-warning text-dark' href='update_a_word.php?position=$position'>Update</a><a type='button' class='btn btn-danger text-dark' href='actions/delete_a_word_action.php?position=$position'>Delete</a></td>";
//            echo "</tr>";
//        }
        ?>
        </tbody>
    </table>
</div>
<br>
<footer class="page-footer font-small lighten-5"">
<div class="footer-copyright text-center text-black-50 py-3">
    <p>Copyright &copy; <?php echo date('Y') ?> Tuan Le</p>
</div>
</body>
</html>