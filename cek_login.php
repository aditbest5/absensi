<?php
error_reporting(0);
session_start();
include "config/connection.php";

if ($_GET['act'] == 'login') {

    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql = mysqli_query($conn, "select * from tbl_users where email = '" . $email . "'");
    $data = mysqli_fetch_array($sql);
    $cek = mysqli_num_rows($sql);
    if ($cek > 0 && password_verify($password, $data['password'])) {
        $_SESSION['id'] = $data['id'];
        $_SESSION['email'] = $data['email'];
        $_SESSION['first_name'] = $data['first_name'];
        $_SESSION['last_name'] = $data['last_name'];
        $_SESSION['role'] = $data['role'];
        $_SESSION['status'] = "login";
        $response = array("status" => "success");
    } else {
        $response = array("status" => "Email/Password Salah");
    }
    echo json_encode($response);
} else if ($_GET['act'] == 'register') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $email = $_POST['email'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $role = 'pegawai';
    $sql = mysqli_query($conn, "select * from tbl_users where email = '" . $email . "' and username = '" . $username . "'");
    $cek = mysqli_num_rows($sql);
    if ($cek > 0) {
        $response = array("status" => "Email/Username sudah ada");
    } else {
        $insert_user = mysqli_query($conn, "insert into tbl_users(username,password,email,first_name,last_name,role)values('" . $username . "','" . $hashedPassword . "','" . $email . "','" . $first_name . "','" . $last_name . "','" . $role . "')");
        if ($insert_user) {
            $_SESSION['email'] = $email;
            $_SESSION['first_name'] = $first_name;
            $_SESSION['last_name'] = $last_name;
            $_SESSION['role'] = $role;
            $_SESSION['status'] = "login";
            $response = array("status" => "Sukses");
        } else {
            $response = array("status" => "Gagal Register");
        }
    }

    echo json_encode($response);
}
