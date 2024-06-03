<?php include('../layouts/header.php') ?>
<div class="main-content">
    <div class="container-fluid">
        <div class="form-element py-30 mb-30">
            <h4 class="font-20 mb-30">Tambah Karyawan</h4>

            <!-- Form -->
            <form action="api.php?act=insert_karyawan" method="POST">
                <!-- Form Row -->
                <div class="form-row mb-20">
                    <div class="col-sm-4">
                        <label class="font-14 bold">Nama Karyawan</label>
                    </div>
                    <div class="col-sm-8">
                        <input type="text" id="name" name="name" class="theme-input-style" placeholder="Type Name">
                    </div>
                </div>
                <!-- End Form Row -->

                <!-- Form Row -->
                <div class="form-row mb-20">
                    <div class="col-sm-4">
                        <label class="font-14 bold">Nomor Induk Karyawan</label>
                    </div>
                    <div class="col-sm-8">
                        <input type="text" name="nik" id="nik" class="theme-input-style" placeholder="Type NIK">
                    </div>
                </div>
                <!-- End Form Row -->

                <!-- Form Row -->
                <div class="form-row mb-20">
                    <div class="col-sm-4">
                        <label class="font-14 bold">Email Karyawan</label>
                    </div>
                    <div class="col-sm-8">
                        <input type="email" name="email" id="email" class="theme-input-style" placeholder="Type Email">
                    </div>
                </div>
                <!-- End Form Row -->
                <!-- Form Row -->
                <div class="form-row mb-20">
                    <div class="col-sm-4">
                        <label class="font-14 bold">Username</label>
                    </div>
                    <div class="col-sm-8">
                        <input type="text" name="username" id="username" class="theme-input-style" placeholder="Type Username">
                    </div>
                </div>
                <!-- End Form Row -->

                <!-- Form Row -->
                <div class="form-row mb-20">
                    <div class="col-sm-4">
                        <label class="font-14 bold">password</label>
                    </div>
                    <div class="col-sm-8">
                        <input type="text" name="password" id="password" class="theme-input-style" placeholder="Type Password">
                    </div>
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
<?php include('../layouts/footer.php') ?>