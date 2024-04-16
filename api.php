<?php
error_reporting(0);
session_start();
include "config/connection.php";

if ($_GET['act'] == 'insert_kehadiran') {
    $user_id = $_SESSION['user_id'];
    $operasi = $_POST['operasi'];
    $pilih_jadwal = $_POST['pilih_jadwal'];
    $longitude = $_POST['longitude'];
    $latitude = $_POST['latitude'];
    $date = date("Y-m-d");;
    $insert_kehadiran = mysqli_query($conn, "INSERT INTO tbl_kehadiran(user_id,operasi,pilih_jadwal,longitude,latitude,created_date) VALUES('" . $user_id . "','" . $operasi . "','" . $pilih_jadwal . "','" . $longitude . "','" . $latitude . "','" . $date . "')");
    if ($insert_kehadiran) {
        $response = array("status" => "success");
    } else {
        $response = array("status" => "Gagal Insert");
    }
    echo json_encode($response);
}
