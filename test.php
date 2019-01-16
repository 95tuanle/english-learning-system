<?php
session_start();

?>
<!DOCTYPE html>
<html>
<body>

<?php
echo " time started: ";
echo ($_SESSION['time_started']);
echo " time ended: ";
echo ($_SESSION['time_ended']);
echo " time spent: ";
echo ($_SESSION['total_time_spent']);
echo " user id: ";
echo($_SESSION['user_id']);
echo " word id: ";
echo ($_SESSION['word_id_for_quiz']);
?>

</body>
</html>
