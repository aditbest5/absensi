<?php
error_reporting(0);
session_start();
include "config/connection.php";

if ($_GET['act'] == 'login') {

    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql = mysqli_query($conn, "select * from tbl_users where email = '" . $email . "' or nik = '" . $email . "'");
    $data = mysqli_fetch_array($sql);
    $cek = mysqli_num_rows($sql);
    if ($cek > 0 && password_verify($password, $data['password'])) {
        $_SESSION['user_id'] = $data['id'];
        $_SESSION['email'] = $data['email'];
        $_SESSION['name'] = $data['name'];
        $_SESSION['nik'] = $data['nik'];
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
    $name = $_POST['name'];
    $nik = $_POST['nik'];
    $role = 'pegawai';
    $sql = mysqli_query($conn, "select * from tbl_users where email = '" . $email . "' and username = '" . $username . "'");
    $cek = mysqli_num_rows($sql);
    if ($cek > 0) {
        $response = array("status" => "Email/Username sudah ada");
    } else {
        $insert_user = mysqli_query($conn, "insert into tbl_users(username,password,email,name,nik,role)values('" . $username . "','" . $hashedPassword . "','" . $email . "','" . $name . "','" . $nik . "','" . $role . "')");
        if ($insert_user) {
            $_SESSION['user_id'] = mysqli_insert_id($conn);
            $_SESSION['email'] = $email;
            $_SESSION['name'] = $name;
            $_SESSION['nik'] = $nik;
            $_SESSION['role'] = $role;
            $_SESSION['status'] = "login";
            $response = array("status" => "Sukses");
        } else {
            $response = array("status" => "Gagal Register");
        }
    }

    echo json_encode($response);
} else if ($_GET['act'] == 'register' && $_GET['role'] == 'admin') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $email = $_POST['email'];
    $name = $_POST['name'];
    $nik = $_POST['nik'];
    $role = 'admin';
    $sql = mysqli_query($conn, "select * from tbl_users where email = '" . $email . "' and username = '" . $username . "'");
    $cek = mysqli_num_rows($sql);
    $data = mysqli_fetch_array($sql);
    if ($cek > 0) {
        $response = array("status" => "Email/Username sudah ada");
    } else {
        $insert_user = mysqli_query($conn, "insert into tbl_users(username,password,email,name,nik,role)values('" . $username . "','" . $hashedPassword . "','" . $email . "','" . $name . "','" . $nik . "','" . $role . "')");
        if ($insert_user) {
            $_SESSION['user_id'] = $data['id'];
            $_SESSION['email'] = $email;
            $_SESSION['name'] = $name;
            $_SESSION['nik'] = $nik;
            $_SESSION['role'] = $role;
            $_SESSION['status'] = "login";
            $response = array("status" => "Sukses");
        } else {
            $response = array("status" => "Gagal Register");
        }
    }

    echo json_encode($response);
}
