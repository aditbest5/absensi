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
} else if ($_GET['act'] === 'checkin_status') {
    // Memeriksa apakah pengguna telah melakukan checkin hari ini
    $user_id = $_SESSION['user_id'];
    $current_date = date('Y-m-d');

    $query = mysqli_query($conn, "SELECT * FROM tbl_kehadiran WHERE user_id = '$user_id' AND created_date = '$current_date'");

    if (mysqli_num_rows($query) > 0) {
        // Pengguna telah melakukan checkin hari ini
        echo json_encode(["status" => "checked_in"]);
    } else {
        // Pengguna belum melakukan checkin hari ini
        echo json_encode(["status" => "not_checked_in"]);
    }
} else if ($_GET['act'] == 'update_kehadiran') {
    if (isset($_POST['status'])) {
        $status = $_POST['status'];

        // Lakukan tindakan update kehadiran sesuai dengan status yang diterima
        if ($status == "checkout") {

            $user_id = $_SESSION['user_id'];
            $query = mysqli_query($conn, "UPDATE tbl_kehadiran SET status = 'checkout' WHERE user_id = '$user_id' AND created_date = CURDATE()");

            // Success response
            $response = array("status" => "success");
        } else {
            // Jika status tidak valid
            $response = array("status" => "Invalid status");
        }
    } else {
        // Jika status tidak diterima
        $response = array("status" => "Status not received");
    }

    // Mengirimkan response dalam format JSON
    echo json_encode($response);
} else if (isset($_GET['act']) == 'month') {
    $month = $_POST['month'];
    $year = date('Y');
    $start_date = "$year-$month-01";
    $end_date = date("Y-m-t", strtotime($start_date));

    while ($start_date <= $end_date) {
        // Periksa apakah ada data absensi pada tanggal ini
        $query = mysqli_query($conn, "SELECT * FROM tbl_kehadiran where user_id = '" . $_SESSION['user_id'] . "' and created_date = '" . $start_date . "'");
        $attendance_data = mysqli_fetch_array($query); // Mengisi data absensi dari database

        if ($attendance_data) {
            // Tampilkan data absensi
            echo "<tr>";
            echo "<td>$start_date</td>"; // Tampilkan tanggal
            echo "<td> $_SESSION[nik] </td>"; // Tampilkan NIK
            echo "<td>$attendance_data[pilih_jadwal]</td>"; // Tampilkan jadwal shift
            echo "<td>$attendance_data[operasi]</td>"; // Tampilkan operasi
            echo "<td>$attendance_data[longitude]</td>"; // Tampilkan longitude
            echo "<td>$attendance_data[latitude]</td>"; // Tampilkan latitude
            echo "<td><button type='button' class='status-btn un_paid'>Hadir</button></td>";
            echo "</tr>";
        } else {
            // Tampilkan status "libur"
            echo "<tr>";
            echo "<td>$start_date</td>"; // Tampilkan tanggal
            echo "<td>" . $_SESSION['nik'] . "</td>"; // Tampilkan NIK
            echo "<td>-</td>"; // Kolom jadwal shift diisi dengan "-"
            echo "<td>-</td>"; // Kolom operasi diisi dengan "-"
            echo "<td>-</td>"; // Kolom longitude diisi dengan "-"
            echo "<td>-</td>"; // Kolom latitude diisi dengan "-"
            echo "<td>Libur</td>"; // Tampilkan status "libur"
            echo "</tr>";
        }
        // Pindah ke tanggal berikutnya
        $start_date = date('Y-m-d', strtotime($start_date . ' +1 day'));
    }
} else if ($_GET['act'] == 'check_attendance') {
    $user_id = $_SESSION['user_id'];
    $query = "SELECT created_date FROM tbl_kehadiran WHERE user_id='$user_id' AND DATE(created_date) = CURDATE() AND status = 'checkin'";
    $result = mysqli_query($conn, $query);
    if ($row = mysqli_fetch_assoc($result)) {
        echo json_encode(['status' => 'found', 'created_date' => $row['created_date']]);
    } else {
        echo json_encode(['status' => 'not_found']);
    }
}
