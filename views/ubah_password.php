<?php include('../layouts/header.php') ?>
<div class="main-content">
    <div class="container-fluid">
        <div class="form-element py-30 mb-30">
            <h4 class="font-20 mb-30">Ubah Password</h4>
            <?php if (isset($_GET['status'])) { ?>

                <!-- Form -->
                <form action="api.php?act=update_password" method="POST">
                    <!-- Form Row -->
                    <div class="form-row mb-20">
                        <div class="col-sm-4">
                            <label class="font-14 bold">Password Lama</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="text" name="old_password" id="old_password" class="theme-input-style" placeholder="Type Password">
                            <?php if ($_GET['status'] == 'incorrect_old_password') { ?>
                                <div class="alert alert-danger">
                                    Password Lama Salah
                                </div><?php
                                    } ?>
                        </div>


                    </div>
                    <!-- Form Row -->
                    <div class="form-row mb-20">
                        <div class="col-sm-4">
                            <label class="font-14 bold">Password Baru</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="text" name="password" id="password" class="theme-input-style" placeholder="Type Password">
                            <?php if ($_GET['status'] == 'password_mismatch') { ?>
                                <div class="alert alert-danger">
                                    Password Tidak Sama
                                </div><?php
                                    } ?>
                        </div>
                    </div>
                    <!-- End Form Row -->
                    <!-- Form Row -->
                    <div class="form-row mb-20">
                        <div class="col-sm-4">
                            <label class="font-14 bold">Password Konfirmasi</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="text" name="confirm_password" id="confirm_password" class="theme-input-style" placeholder="Type Password">
                            <?php if ($_GET['status'] == 'password_mismatch') { ?>
                                <div class="alert alert-danger">
                                    Password Tidak Sama
                                </div><?php
                                    }
                                        ?>
                        </div>
                    </div>
                    <!-- Form Row -->
                    <div class="form-row">
                        <div class="col-12 text-right">
                            <a href="setting" class=" btn long">Cancel</a>

                            <button type="submit" class="btn long">Submit</button>
                        </div>
                    </div>
                    <!-- End Form Row -->
                </form>
                <!-- End Form -->
            <?php } else { ?>
                <!-- Form -->
                <form action="api.php?act=update_password" method="POST">
                    <!-- Form Row -->
                    <div class="form-row mb-20">
                        <div class="col-sm-4">
                            <label class="font-14 bold">Password Lama</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="text" name="old_password" id="old_password" class="theme-input-style" placeholder="Type Password">
                        </div>


                    </div>
                    <!-- Form Row -->
                    <div class="form-row mb-20">
                        <div class="col-sm-4">
                            <label class="font-14 bold">Password Baru</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="text" name="password" id="password" class="theme-input-style" placeholder="Type Password">

                        </div>
                    </div>
                    <!-- End Form Row -->
                    <!-- Form Row -->
                    <div class="form-row mb-20">
                        <div class="col-sm-4">
                            <label class="font-14 bold">Password Konfirmasi</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="text" name="confirm_password" id="confirm_password" class="theme-input-style" placeholder="Type Password">

                        </div>
                    </div>
                    <!-- Form Row -->
                    <div class="form-row">
                        <div class="col-12 text-right">
                            <a href="setting" class=" btn long">Cancel</a>

                            <button type="submit" class="btn long">Submit</button>
                        </div>
                    </div>
                    <!-- End Form Row -->
                </form>
            <?php } ?>

        </div>
    </div>
</div>
<?php include('../layouts/footer.php') ?>