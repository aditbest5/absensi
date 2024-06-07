<?php include('../layouts/header.php') ?>
<div class="main-content">
    <div class="container-fluid">
        <div class="text_color-bg text-white mb-30 h-full">
            <div class="card-body py-30 pb-0">
                <h4 class="font-20">Data Karyawan</h4>
                <a href="tambah-karyawan" class="btn btn-primary mt-2">Tambah Karyawan</a>
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
                            echo "<td class='text-center'>" . htmlspecialchars($row['name']) . "</td>";
                            echo "<td class='text-center'>" . htmlspecialchars($row['nik']) . "</td>";
                            echo "<td class='text-center'>" . htmlspecialchars($row['email']) . "</td>";
                            echo "<td class='text-center'>" . htmlspecialchars($row['username']) . "</td>";
                            echo "<td class='text-center'>" . htmlspecialchars($row['role']) . "</td>";
                            echo "<td class='text-center'><a href='edit-karyawan?id=" . $row['id'] .  "' class='btn btn-warning'>Edit</a> | <button class='btn btn-danger' onclick='deleteKaryawan(" . $row['id'] . ")'>Delete</button></td>";
                            echo "</tr>";
                        }
                        mysqli_close($conn);
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    function deleteKaryawan(id) {
        swal({
                title: "Are you sure?",
                text: "Are you sure you want to delete this employee?",
                icon: "warning",
                buttons: {
                    cancel: "No",
                    confirm: {
                        text: "Yes",
                        value: true,
                        visible: true,
                        className: "",
                        closeModal: true
                    }
                },
                dangerMode: true,
            })
            .then(willDelete => {
                if (willDelete) {
                    fetch(`api.php?act=delete-karyawan&id=${id}`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded'
                            },
                        }).then(response => response.json())
                        .then(res => {
                            swal("Deleted!", "Employee Data has been deleted!", "success");
                            window.location.href = 'pengaturan-akun '
                        })
                }
            });
    }
</script>
<?php include('../layouts/footer.php') ?>