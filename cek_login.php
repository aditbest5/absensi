<?php
error_reporting(0);
session_start();
include "config/connection.php";

if ($_GET['act'] == 'login') {

    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql = mysqli_query($conn, "select * from tbl_users where email = '" . $email . "' and password  ='" . $password . "'");
    $data = mysqli_fetch_array($sql);
    $cek = mysqli_num_rows($sql);
    if ($cek > 0) {
        $_SESSION['id'] = $data['id'];
        $_SESSION['email'] = $data['email'];
        $_SESSION['name'] = $data['name'];
        $_SESSION['password'] = $data['password'];
        $_SESSION['role'] = $data['role'];
        $response = array("status" => "success");
    } else {
        $response = array("status" => "failed");
    }
    echo json_encode($response);
} else if ($_GET['act'] == 'register') {

    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $q = mysqli_query($koneksi, "insert into tbl_users(username,password)values('" . $username . "','" . $password . "')");
    if ($q) {
        $response = "success";
    } else {
        $response = "failed";
    }
    echo $response;
}
