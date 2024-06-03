    <?php include('../layouts/header.php'); ?>
    <div class="main-content">
        <div class="container-fluid">
            <div class="card mb-30">
                <div class="card-body">
                    <div class="d-sm-flex justify-content-between align-items-center">
                        <h4 class="font-20">Data Absensi Karyawan</h4>

                        <div class="d-flex flex-wrap">
                            <!-- Month Picker -->

                            <!-- End Month Picker -->
                            <!-- Dropdown Karyawan -->

                            <!-- End Dropdown Karyawan -->
                            <!-- Dropdown Button -->
                            <div class="dropdown-button mt-3 mt-sm-0">
                                <button type="button" class="btn style--two orange" data-toggle="dropdown">Download <i class="icofont-simple-down"></i></button>

                                <div class="dropdown-menu">
                                    <button onclick="printTable()" class="dropdown-item" href="#">Print</button>
                                    <button onclick="downloadExcel()" class="dropdown-item" href="#">EXL</button>
                                    <button onclick="downloadPDF()" class="dropdown-item" href="#">PDF</button>
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
                                <th>Tanggal </th>
                                <th>Nama </th>
                                <th>NIK </th>
                                <th>Jadwal Shift </th>
                                <th>Operasi </th>
                                <th>Longitude </th>
                                <th>Latitude </th>
                                <th>Status </th>
                            </tr>
                        </thead>
                        <tbody id="attendance-table">
                            <?php
                            include("../config/connection.php");
                            $data = mysqli_query($conn, "SELECT * FROM tbl_kehadiran JOIN tbl_users on tbl_kehadiran.user_id = tbl_users.id");
                            $array = mysqli_fetch_array($data);
                            while ($row = mysqli_fetch_array($data)) {
                            ?>
                                <tr>
                                    <td><?php echo $row['created_date']; ?></td>
                                    <td><?php echo $row['name']; ?></td>
                                    <td><?php echo $row['nik']; ?></td>
                                    <td><?php echo $row['pilih_jadwal']; ?></td>
                                    <td><?php echo $row['operasi']; ?></td>
                                    <td><?php echo $row['longitude']; ?></td>
                                    <td><?php echo $row['latitude']; ?></td>
                                    <td><?php echo $row['status']; ?></td>
                                </tr>
                            <?php } ?>
                            <!-- Data akan dimuat di sini oleh JavaScript -->
                        </tbody>
                    </table>
                    <!-- End Invoice List Table -->
                </div>
            </div>
        </div>
    </div>
    <script>
        // Fungsi untuk mengonversi tabel menjadi Excel
        function downloadExcel() {
            let table = document.querySelector('.dh-table');
            let workbook = XLSX.utils.table_to_book(table, {
                sheet: "Sheet1"
            });
            XLSX.writeFile(workbook, 'log_absensi.xlsx');
        }

        // Fungsi untuk mengonversi tabel menjadi PDF
        function downloadPDF() {
            let {
                jsPDF
            } = window.jspdf;
            let doc = new jsPDF();

            doc.autoTable({
                html: '.dh-table',
                startY: 20,
                headStyles: {
                    fillColor: [0, 0, 0]
                }, // Ubah warna sesuai kebutuhan
                theme: 'grid'
            });

            doc.save('log_absensi.pdf');
        }

        // Fungsi untuk mencetak tabel
        function printTable() {
            $('.dh-table').printThis({
                importCSS: true,
                importStyle: true
            });
        }
    </script>
    <?php include('../layouts/footer.php'); ?>