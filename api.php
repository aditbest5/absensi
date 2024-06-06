<?php
// Aktifkan error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);
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
if ($_GET['act'] == 'insert_karyawan') {
    $name = $_POST['name'];
    $nik = $_POST['nik'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $hash_password = password_hash($password, PASSWORD_DEFAULT);
    $insert_karyawan = mysqli_query($conn, "INSERT INTO tbl_users(name,nik,email,username,password) VALUES('" . $name . "','" . $nik . "','" . $email . "','" . $username . "','" . $hash_password . "')");
    if ($insert_karyawan) {
        $response = array("status" => "success");
        header("Location: pengaturan-akun");
    } else {
        $response = array("status" => "Gagal Insert");
        header("Location: tambah_karyawan");
    }
    echo json_encode($response);
}
if ($_GET['act'] == 'checkin_status') {
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
}
if ($_GET['act'] == 'update_kehadiran') {
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
}
if ($_GET['act'] == 'update_password') {
    // Pastikan untuk selalu melakukan validasi input
    $old_password = isset($_POST['old_password']) ? $_POST['old_password'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $confirm_password = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : '';
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';

    // Menggunakan prepared statement untuk menghindari SQL injection
    $stmt = $conn->prepare("SELECT password FROM tbl_users WHERE id = ?");
    $stmt->bind_param("s", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    $stmt->close();

    if ($data && password_verify($old_password, $data['password'])) {
        if ($password == $confirm_password) {
            $new_password_hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("UPDATE tbl_users SET password = ? WHERE id= ?");
            $stmt->bind_param("ss", $new_password_hash, $user_id);
            $stmt->execute();
            $stmt->close();

            // Redirect ke halaman setting
            header("Location: setting");
            exit();
        } else {
            // Jika password baru tidak cocok
            header("Location: ubah-password?status=password_mismatch");
            exit();
        }
    } else {
        // Jika password lama salah
        header("Location: ubah-password?status=incorrect_old_password");
        exit();
    }
}
if ($_GET['act'] == 'month') {
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
}
if ($_GET['act'] === 'get_attendance') {
    $month = $_POST['month'];
    $employee = $_POST['employee'];
    $year = date('Y');
    $start_date = "$year-$month-01";
    $end_date = date("Y-m-t", strtotime($start_date));
    while ($start_date <= $end_date) {
        // Periksa apakah ada data absensi pada tanggal ini
        $query = mysqli_query($conn, "SELECT * FROM tbl_kehadiran where user_id = '" . $employee . "' and created_date = '" . $start_date . "'");
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
}
if ($_GET['act'] == 'check_attendance') {
    $user_id = $_SESSION['user_id'];
    $query = "SELECT created_date FROM tbl_kehadiran WHERE user_id='$user_id' AND DATE(created_date) = CURDATE() AND status = 'checkin'";
    $result = mysqli_query($conn, $query);
    if ($row = mysqli_fetch_assoc($result)) {
        echo json_encode(['status' => 'found', 'created_date' => $row['created_date']]);
    } else {
        echo json_encode(['status' => 'not_found']);
    }
}
if ($_GET['act'] == 'update_profil') {
    $user_id = $_SESSION['user_id'];
    $query = "UPDATE tbl_users SET email = '" . $_POST['email'] . "', username = '" . $_POST['username'] . "', name = '" . $_POST['name'] . "', nik='" . $_POST['nik'] . "' WHERE user_id = '" . $user_id . "'";
    $result = mysqli_query($conn, $query);
    if ($result) {
        $response = array("status" => "success");
        header("Location: dashboard.php");
    } else {
        $response = array("status" => "failed");
        header("Location: setting?message=error");
    }
}
if ($_GET['act'] == 'delete-karyawan' && isset($_GET['id'])) {
    $user_id = $_GET['id'];
    $query = "DELETE FROM tbl_users WHERE id = ?";

    if ($stmt = mysqli_prepare($conn, $query)) {
        mysqli_stmt_bind_param($stmt, "i", $user_id);
        $result = mysqli_stmt_execute($stmt);

        if ($result) {
            $response = array("status" => "success");
            // header("Location: pengaturan-akun");
        } else {
            $response = array("status" => "failed");
            // header("Location: pengaturan-akun?message=gagal-delete");
        }

        mysqli_stmt_close($stmt);
    } else {
        $response = array("status" => "failed");
        // header("Location: pengaturan-akun?message=gagal-prepare");
    }

    echo json_encode($response);
}
