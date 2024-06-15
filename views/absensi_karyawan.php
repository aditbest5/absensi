    <?php include('../layouts/header.php'); ?>
    <div class="main-content">
        <div class="container-fluid">
            <div class="card mb-30">
                <div class="card-body">
                    <div class="d-sm-flex justify-content-between align-items-center">
                        <h4 class="font-20">Data Absensi Karyawan</h4>

                        <div class="d-flex flex-wrap">
                            <!-- Month Picker -->
                            <div class="mr-20 mt-3 mt-sm-0">

                                <select id="month-picker" class="form-control">
                                    <?php
                                    include("../config/connection.php");

                                    $months = [
                                        '01' => 'January', '02' => 'February', '03' => 'March', '04' => 'April',
                                        '05' => 'May', '06' => 'June', '07' => 'July', '08' => 'August',
                                        '09' => 'September', '10' => 'October', '11' => 'November', '12' => 'December'
                                    ];
                                    $current_month = date('m');
                                    foreach ($months as $num => $name) {
                                        echo "<option value='$num'" . ($num == $current_month ? " selected" : "") . ">$name</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="mr-20 mt-3 mt-sm-0">

                                <select id="employee-picker" class="form-control">
                                    <?php
                                    $data_employee = mysqli_query($conn, "SELECT * FROM tbl_users WHERE role = 'pegawai'");
                                    while ($employee = mysqli_fetch_assoc($data_employee)) {
                                        $id = $employee['id'];
                                        $nama = $employee['name'];
                                        echo "<option value='$id'>$nama</option>";
                                    }
                                    ?>
                                </select>
                            </div>
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

                            <!-- Data akan dimuat di sini oleh JavaScript -->
                        </tbody>
                    </table>
                    <!-- End Invoice List Table -->
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            loadAttendanceForCurrentMonth();

            document.getElementById('month-picker').addEventListener('change', function() {
                var month = this.value;
                var employee = document.getElementById('employee-picker').value;
                console.log(month, employee)
                fetchAttendanceData(month, employee);
            });

            document.getElementById('employee-picker').addEventListener('change', function() {
                var employee = this.value;
                var month = document.getElementById('month-picker').value;
                console.log(month, employee)

                fetchAttendanceData(month, employee);
            });
        });

        function loadAttendanceForCurrentMonth() {
            var currentMonth = new Date().getMonth() + 1; // January is 0!
            if (currentMonth < 10) {
                currentMonth = '0' + currentMonth;
            }
            var employee = document.getElementById('employee-picker').value;
            fetchAttendanceData(currentMonth, employee);
        }

        function fetchAttendanceData(month, employee) {
            fetch('api.php?act=get_attendance', {
                    method: 'POST',
                    body: 'month=' + month + '&employee=' + employee,
                    headers: {
                        "Content-type": "application/x-www-form-urlencoded",
                    },
                })
                .then(response => response.text())
                .then(data => {
                    document.getElementById('attendance-table').innerHTML = data;
                });
        }

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