<?php
include "config/connection.php";
session_start();

if (isset($_GET['month'])) {
    $month = $_GET['month'];
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
            echo "<td><a href='invoice-details.html' class='details-btn'>View Details <i class='icofont-arrow-right'></i></a></td>";
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
            echo "<td><a href='invoice-details.html' class='details-btn'>View Details <i class='icofont-arrow-right'></i></a></td>";
            echo "</tr>";
        }
        // Pindah ke tanggal berikutnya
        $start_date = date('Y-m-d', strtotime($start_date . ' +1 day'));
    }
}
