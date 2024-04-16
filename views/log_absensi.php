<?php include('../layouts/header.php'); ?>
<div class="main-content">
    <div class="container-fluid">
        <div class="card mb-30">
            <div class="card-body">
                <div class="d-sm-flex justify-content-between align-items-center">
                    <h4 class="font-20">Log Absensi</h4>

                    <div class="d-flex flex-wrap">
                        <!-- Date Picker -->
                        <div class="dashboard-date style--six mr-20 mt-3 mt-sm-0">
                            <span class="input-group-addon">
                                <img src="../template/assets/img/svg/calender-color.svg" alt="" class="svg">
                            </span>

                            <input type="text" id="default-date" value="<?php echo date('d M Y') ?>" />
                        </div>
                        <!-- End Date Picker -->


                        <!-- Dropdown Button -->
                        <div class="dropdown-button mt-3 mt-sm-0">
                            <button type="button" class="btn style--two orange" data-toggle="dropdown">Download <i class="icofont-simple-down"></i></button>

                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#">Print</a>
                                <a class="dropdown-item" href="#">EXL</a>
                                <a class="dropdown-item" href="#">PDF</a>
                            </div>
                        </div>
                        <!-- End Dropdown Button -->
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <!-- Invoice List Table -->
                <table class="text-nowrap bg-white dh-table">
                    <thead>
                        <tr>
                            <th>Tanggal <img src="../template/assets/img/svg/table-down-arrow.svg" alt="" class="svg"></th>
                            <th>NIK <img src="../template/assets/img/svg/table-down-arrow.svg" alt="" class="svg"></th>
                            <th>Jadwal Shift <img src="../template/assets/img/svg/table-down-arrow.svg" alt="" class="svg"></th>
                            <th>Operasi <img src="../template/assets/img/svg/table-down-arrow.svg" alt="" class="svg"></th>
                            <th>Longitude <img src="../template/assets/img/svg/table-down-arrow.svg" alt="" class="svg"></th>
                            <th>Latitude <img src="../template/assets/img/svg/table-down-arrow.svg" alt="" class="svg"></th>
                            <th>Status <img src="../template/assets/img/svg/table-down-arrow.svg" alt="" class="svg"></th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include "../config/connection.php";
                        // Iterasi dari tanggal 1 sampai akhir bulan
                        $current_date = date('Y-m-01'); // Tanggal awal bulan ini
                        $last_day = date('Y-m-t'); // Tanggal akhir bulan ini
                        while ($current_date <= $last_day) {
                            // Periksa apakah ada data absensi pada tanggal ini
                            // Jika ada, tampilkan data absensi
                            // Jika tidak ada, tampilkan status "libur"
                            // (Anda perlu mengubah ini sesuai dengan hasil query dari database Anda)
                            $query = mysqli_query($conn, "SELECT * FROM tbl_kehadiran where user_id = '" . $_SESSION['user_id'] . "' and created_date = '" . $current_date . "'");
                            $attendance_data = mysqli_fetch_array($query); // Anda perlu mengisi data absensi dari database
                            if ($attendance_data) {
                                // Tampilkan data absensi
                                echo "<tr>";
                                echo "<td>$current_date</td>"; // Tampilkan tanggal
                                echo "<td> $_SESSION[nik] </td>"; // Tampilkan status "hadir"
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
                                echo "<td>$current_date</td>"; // Tampilkan tanggal
                                echo "<td>" . $_SESSION['nik'] . "</td>"; // Tampilkan status "hadir"   
                                echo "<td>-</td>"; // Kolom jadwal shift diisi dengan "-"
                                echo "<td>-</td>"; // Kolom operasi diisi dengan "-"
                                echo "<td>-</td>"; // Kolom longitude diisi dengan "-"
                                echo "<td>-</td>"; // Kolom latitude diisi dengan "-"
                                echo "<td>Libur</td>"; // Tampilkan status "libur"
                                echo "<td><a href='invoice-details.html' class='details-btn'>View Details <i class='icofont-arrow-right'></i></a></td>";
                                echo "</tr>";
                            }
                            // Pindah ke tanggal berikutnya
                            $current_date = date('Y-m-d', strtotime($current_date . ' +1 day'));
                        }
                        ?>
                    </tbody>
                </table>
                <!-- End Invoice List Table -->
            </div>
        </div>
    </div>
</div>
<?php include('../layouts/footer.php'); ?>