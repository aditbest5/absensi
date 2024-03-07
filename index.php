<?php
session_start();

if (isset($_SESSION['status']) != 'login') {
    header("location: login.php");
?>

<?php } else if (isset($_SESSION['status']) == 'login') {
    header("location: dashboard.php");
}
?>