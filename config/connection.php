<?php
$hostname = "localhost";
$database = "absensi";
$password = "";
$user = "root";
$conn = mysqli_connect($hostname, $user, $password, $database);

if ($conn->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}
