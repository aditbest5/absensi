<?php include('../layouts/header.php') ?>
<div class="main-content">
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ubah Password Karyawan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-row mb-20">
                        <div class="col-sm-4">
                            <label class="font-14 bold">Password Baru</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="text" name="password" id="password" class="theme-input-style" placeholder="Type Password" required>
                        </div>
                    </div>
                    <div class="form-row mb-20">
                        <div class="col-sm-4">
                            <label class="font-14 bold">Konfirmasi Password</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="text" name="confirm_password" id="confirm_password" class="theme-input-style" placeholder="Type Password" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="savePassword(<?php echo $_GET['id']; ?>)">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="form-element py-30 mb-30">
            <h4 class="font-20 mb-30">Edit Data Karyawan</h4>
            <?php
            include('../config/connection.php');
            $data_employee = mysqli_query($conn, "SELECT * FROM tbl_users WHERE id= '" . $_GET['id'] . "'");
            $employee = mysqli_fetch_assoc($data_employee);
            ?>

            <!-- Form -->
            <form action="api.php?act=update-karyawan&id=<?php echo $_GET['id'] ?>" method="POST">
                <!-- Form Row -->
                <div class="form-row mb-20">
                    <div class="col-sm-4">
                        <label class="font-14 bold">Nama Karyawan</label>
                    </div>
                    <div class="col-sm-8">
                        <input type="text" id="name" name="name" value="<?php echo $employee['name'] ?>" class="theme-input-style" placeholder="Type Name" required>
                    </div>
                </div>
                <!-- End Form Row -->

                <!-- Form Row -->
                <div class="form-row mb-20">
                    <div class="col-sm-4">
                        <label class="font-14 bold">Nomor Induk Karyawan</label>
                    </div>
                    <div class="col-sm-8">
                        <input type="text" name="nik" id="nik" value="<?php echo $employee['nik'] ?>" class="theme-input-style" placeholder="Type NIK" required>
                    </div>
                </div>
                <!-- End Form Row -->

                <!-- Form Row -->
                <div class="form-row mb-20">
                    <div class="col-sm-4">
                        <label class="font-14 bold">Email Karyawan</label>
                    </div>
                    <div class="col-sm-8">
                        <input type="email" name="email" id="email" value="<?php echo $employee['email'] ?>" class="theme-input-style" placeholder="Type Email" required>
                    </div>
                </div>
                <!-- End Form Row -->
                <!-- Form Row -->
                <div class="form-row mb-20">
                    <div class="col-sm-4">
                        <label class="font-14 bold">Username</label>
                    </div>
                    <div class="col-sm-8">
                        <input type="text" name="username" id="username" value="<?php echo $employee['username'] ?>" class="theme-input-style" placeholder="Type Username" required>
                    </div>
                </div>
                <!-- End Form Row -->

                <!-- Form Row -->
                <div class="form-row mb-20">
                    <button type="button" data-toggle="modal" data-target="#exampleModal">
                        <h4 style="cursor: pointer;;color: blue; text-decoration: underline;">Ubah Password</h4>
                    </button>
                </div>
                <!-- End Form Row -->

                <!-- Form Row -->
                <div class="form-row">
                    <div class="col-12 text-right">
                        <a href="pengaturan-akun" class=" btn long">Cancel</a>

                        <button type="submit" class="btn long">Submit</button>
                    </div>
                </div>
                <!-- End Form Row -->
            </form>
            <!-- End Form -->
        </div>
    </div>
</div>
<script>
    function savePassword(id) {
        const password = document.getElementById("password").value;
        const confirm_password = document.getElementById("confirm_password").value;
        let data = new FormData();
        data.append("password", password);
        data.append("confirm_password", confirm_password);

        if (password === confirm_password) {
            fetch(`api.php?act=update-password-karyawan&id=${id}`, {
                    method: 'POST',
                    body: data
                })
                .then(response => response.json())
                .then(res => {
                    if (res?.status === 'success') {
                        swal("Berhasil Ganti Password!", "Employee Password Has Been Changed!", "success")
                            .then(() => {
                                window.location.href = `edit-karyawan?id=${id}`;
                            });
                    } else {
                        swal("Gagal Ganti Password!", "Server Error!", "error");
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    swal("Gagal Ganti Password!", "Server Error!", "error");
                });
        } else {
            swal("Gagal Ganti Password!", "New Password And Confirmation Password Do Not Match!", "error");
        }
    }
</script>
<?php include('../layouts/footer.php') ?>