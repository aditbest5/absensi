<?php include('../layouts/header.php') ?>
<div class="main-content">
    <div class="container-fluid">
        <div class="text_color-bg text-white mb-30 h-full">
            <div class="card-body py-30 pb-0">
                <h4 class="font-20">Data Karyawan</h4>
                <a href="tambah-karyawan" class="btn btn-primary mt-2 ">Tambah Karyawan</a>
            </div>
            <div class="table-responsive">
                <table class="style--four table-striped table-inverse text-nowrap">
                    <thead>
                        <tr>
                            <th class="text-center" scope="col">Nama Karyawan</th>
                            <th class="text-center" scope="col">NIK</th>
                            <th class="text-center" scope="col">Email</th>
                            <th class="text-center" scope="col">Username</th>
                            <th class="text-center" scope="col">Role</th>
                            <th class="text-center" scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include('../config/connection.php');
                        $data = mysqli_query($conn, "SELECT * FROM tbl_users WHERE role='pegawai'");
                        while ($row = mysqli_fetch_assoc($data)) {
                            echo "<tr>";
                            echo "<td class='text-center'>" . $row['name'] . "</td>";
                            echo "<td class='text-center'>" . $row['nik'] . "</td>";
                            echo "<td class='text-center'>" . $row['email'] . "</td>";
                            echo "<td class='text-center'> " . $row['username'] . "</td>";
                            echo "<td class='text-center'>" . $row['role'] . "</td>";
                            echo "<td class='text-center'><a href='edit.php?id=" . $row['id'] . "' class='btn btn-warning'>Edit</a> | <a class='btn btn-danger' href='delete.php?id=" . $row['id'] . "'>Delete</a></td>";
                            echo "</tr>";
                        }

                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php include('../layouts/footer.php') ?>