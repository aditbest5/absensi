<?php include('../layouts/header.php') ?>
<div class="main-content">
    <div class="container-fluid">
        <div class="form-element py-30 mb-30">
            <h4 class="font-20 mb-30">Settings</h4>

            <?php
            include("../config/connection.php");
            if (isset($_SESSION['user_id'])) {
                $stmt = $conn->prepare("SELECT * FROM tbl_users WHERE id = ?");
                $stmt->bind_param("i", $_SESSION['user_id']);
                $stmt->execute();
                $result = $stmt->get_result();
                $data = $result->fetch_assoc();
                $stmt->close();
            }
            echo $_SESSION['user_id'];

            ?>
            <!-- Form -->
            <form action="update_profil.php?act=update_profil" method="POST">
                <!-- Form Row -->
                <div class="form-row mb-20">
                    <div class="col-sm-4">
                        <label class="font-14 bold">Your Name</label>
                    </div>
                    <div class="col-sm-8">
                        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($data['name']); ?>" class="theme-input-style" placeholder="Type Your Name">
                    </div>
                </div>
                <!-- End Form Row -->

                <!-- Form Row -->
                <div class="form-row mb-20">
                    <div class="col-sm-4">
                        <label class="font-14 bold">Your NIK</label>
                    </div>
                    <div class="col-sm-8">
                        <input type="text" name="nik" id="nik" value="<?php echo htmlspecialchars($data['nik']); ?>" class="theme-input-style" placeholder="Type Your NIK">
                    </div>
                </div>
                <!-- End Form Row -->

                <!-- Form Row -->
                <div class="form-row mb-20">
                    <div class="col-sm-4">
                        <label class="font-14 bold">Your Email</label>
                    </div>
                    <div class="col-sm-8">
                        <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($data['email']); ?>" class="theme-input-style" placeholder="Type Your Email">
                    </div>
                </div>
                <!-- End Form Row -->
                <!-- Form Row -->
                <div class="form-row mb-20">
                    <div class="col-sm-4">
                        <label class="font-14 bold">Your Username</label>
                    </div>
                    <div class="col-sm-8">
                        <input type="text" name="username" id="username" value="<?php echo htmlspecialchars($data['username']); ?>" class="theme-input-style" placeholder="Type Your Username">
                    </div>
                </div>
                <!-- End Form Row -->

                <!-- Form Row -->
                <div class="form-row mb-20">
                    <a href="ubah-password">
                        <h4 style="color: blue; text-decoration: underline;">Ubah Password</h4>
                    </a>
                </div>
                <!-- End Form Row -->

                <!-- Form Row -->
                <div class="form-row">
                    <div class="col-12 text-right">
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