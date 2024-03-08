<?php
session_start();

if (isset($_SESSION['status']) != 'login') {
    header("location: login");
?>

<?php } else if (isset($_SESSION['status']) == 'login') {
    header("location: dashboard");
}
?>