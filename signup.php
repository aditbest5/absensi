<?php
session_start();
if (isset($_SESSION['status']) == 'login') {
    header("location: dashboard.php");
}
?>
<!DOCTYPE html>
<html lang="zxx">

<head>
    <!-- Page Title -->
    <title>Sign Up | Jasamarga</title>

    <!-- Meta Data -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicon -->
    <link rel="shortcut icon" href="/absensi/template/assets/img/favicon.png">

    <!-- Web Fonts -->
    <link href="https://fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i&display=swap" rel="stylesheet">

    <!-- ======= BEGIN GLOBAL MANDATORY STYLES ======= -->
    <link rel="stylesheet" href="/absensi/template/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/absensi/template/assets/fonts/icofont/icofont.min.css">
    <link rel="stylesheet" href="/absensi/template/assets/plugins/perfect-scrollbar/perfect-scrollbar.min.css">
    <!-- ======= END BEGIN GLOBAL MANDATORY STYLES ======= -->
    <script src=" https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- ======= MAIN STYLES ======= -->
    <link rel="stylesheet" href="/absensi/template/assets/css/style.css">
    <!-- ======= END MAIN STYLES ======= -->
    <script>
        function signup_process(e) {
            e.preventDefault();
            let url = "cek_login.php?act=register";
            let username = document.getElementById("username").value
            let first_name = document.getElementById("first_name").value
            let last_name = document.getElementById("last_name").value
            let email = document.getElementById("email").value;
            let password = document.getElementById("password").value;
            let confirm_password = document.getElementById("confirm_password").value;
            if (!email && !password && !first_name && !last_name && !username) {
                swal({
                    title: "Warning",
                    text: "Harap isi semua kolom",
                    icon: "warning",
                }).then(function() {

                });
            } else if (confirm_password != password) {
                swal({
                    title: "Warning",
                    text: "Password tidak sama! Harap ulangi",
                    icon: "warning",
                }).then(function() {
                    document.getElementById("password").value = ""
                    document.getElementById("confirm_password").value = ""
                });
            } else if (confirm_password == password && email && password && first_name && last_name && username) {
                fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: new URLSearchParams({
                        email,
                        password,
                        username,
                        first_name,
                        last_name

                    })
                }).then(response => response.json()).then(data => {
                    if (data?.status == "Sukses") {
                        swal({
                            title: "Register Success",
                            text: data?.status,
                            icon: "success",
                        }).then(function() {
                            window.location.href = "dashboard.php";
                        });
                    } else {
                        swal({
                            title: "Register Failed",
                            text: data?.status,
                            icon: "error",
                        }).then(function() {});
                    }

                })
            }

        }
    </script>
</head>

<body>
    <div class="mn-vh-100 d-flex align-items-center">
        <div class="container">
            <!-- Card -->
            <div class="card justify-content-center auth-card">
                <div class="row justify-content-center">
                    <div class="col-xl-10">
                        <h4 class="mb-5 font-20">Welcome To Dashmin</h4>

                        <form onsubmit="return signup_process(event)">
                            <div class="row">
                                <div class="col-lg-6">
                                    <!-- Form Group -->
                                    <div class="form-group mb-20">
                                        <label for="first_name" class="mb-2 font-14 bold black">First Name</label>
                                        <input type="text" id="first_name" class="theme-input-style" placeholder="First Name">
                                    </div>
                                    <!-- End Form Group -->
                                </div>

                                <div class="col-lg-6">
                                    <!-- Form Group -->
                                    <div class="form-group mb-20">
                                        <label for="last_name" class="mb-2 font-14 bold black">Last Name</label>
                                        <input type="text" id="last_name" class="theme-input-style" placeholder="Last Name">
                                    </div>
                                    <!-- End Form Group -->
                                </div>

                                <div class="col-lg-6">
                                    <!-- Form Group -->
                                    <div class="form-group mb-20">
                                        <label for="username" class="mb-2 font-14 bold black">User Name</label>
                                        <input type="text" id="username" class="theme-input-style" placeholder="User Name">
                                    </div>
                                    <!-- End Form Group -->
                                </div>

                                <div class="col-lg-6">
                                    <!-- Form Group -->
                                    <div class="form-group mb-20">
                                        <label for="email" class="mb-2 font-14 bold black">Email Address</label>
                                        <input type="email" id="email" class="theme-input-style" placeholder="Email Address">
                                    </div>
                                    <!-- End Form Group -->
                                </div>

                                <div class="col-lg-6">
                                    <!-- Form Group -->
                                    <div class="form-group mb-20">
                                        <label for="password" class="mb-2 font-14 bold black">Password</label>
                                        <input type="password" id="password" class="theme-input-style" placeholder="Password">
                                    </div>
                                    <!-- End Form Group -->
                                </div>

                                <div class="col-lg-6">
                                    <!-- Form Group -->
                                    <div class="form-group mb-20">
                                        <label for="confirm_password" class="mb-2 font-14 bold black">Retype Password</label>
                                        <input type="password" id="confirm_password" class="theme-input-style" placeholder="Password">
                                    </div>
                                    <!-- End Form Group -->
                                </div>
                            </div>

                            <div class="d-flex align-items-center pt-4">
                                <button type="submit" class="btn long mr-20">Register</button>
                                <span class="font-12 d-block"><a href="login.php" class="bold">Log In</a>,If you already have an account.</span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- End Card -->
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer style--two">
        Dashmin © 2020 created by <a href="https://www.themelooks.com/"> ThemeLooks</a>
    </footer>
    <!-- End Footer -->

    <!-- ======= BEGIN GLOBAL MANDATORY SCRIPTS ======= -->
    <script src="/absensi/template/assets/js/jquery.min.js"></script>
    <script src="/absensi/template/assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/absensi/template/assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="/absensi/template/assets/js/script.js"></script>
    <!-- ======= BEGIN GLOBAL MANDATORY SCRIPTS ======= -->
</body>

</html>