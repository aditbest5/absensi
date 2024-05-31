<?php include('../layouts/header.php'); ?>
<div class="main-content">
    <div class="container-fluid">
        <div class="card mb-30">
            <div class="card-body">
                <div class="d-sm-flex justify-content-between align-items-center">
                    <h4 class="font-20">Log Absensi</h4>

                    <div class="d-flex flex-wrap">
                        <!-- Month Picker -->
                        <div class="mr-20 mt-3 mt-sm-0">

                            <select id="month-picker" class="form-control">
                                <?php
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
                        <!-- End Month Picker -->

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
                            <th>Tanggal <img src="../template/assets/img/svg/table-down-arrow.svg" alt="" class="svg"></th>
                            <th>NIK <img src="../template/assets/img/svg/table-down-arrow.svg" alt="" class="svg"></th>
                            <th>Jadwal Shift <img src="../template/assets/img/svg/table-down-arrow.svg" alt="" class="svg"></th>
                            <th>Operasi <img src="../template/assets/img/svg/table-down-arrow.svg" alt="" class="svg"></th>
                            <th>Longitude <img src="../template/assets/img/svg/table-down-arrow.svg" alt="" class="svg"></th>
                            <th>Latitude <img src="../template/assets/img/svg/table-down-arrow.svg" alt="" class="svg"></th>
                            <th>Status <img src="../template/assets/img/svg/table-down-arrow.svg" alt="" class="svg"></th>
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
            fetchAttendanceData(month);
        });
    });

    function loadAttendanceForCurrentMonth() {
        var currentMonth = new Date().getMonth() + 1; // January is 0!
        if (currentMonth < 10) {
            currentMonth = '0' + currentMonth;
        }
        fetchAttendanceData(currentMonth);
    }

    function fetchAttendanceData(month) {
        fetch('api.php?act=get_month', {
                method: 'POST',
                body: 'month=' + month,
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