<?php
session_start();
if (isset($_SESSION['status']) == 'login') {
    header("location: dashboard");
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <!-- Page Title -->
    <title>Log In | Jasamarga</title>

    <!-- Meta Data -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicon -->
    <link rel="shortcut icon" href="template/assets/img/favicon.png">

    <!-- Web Fonts -->
    <link href="https://fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i&display=swap" rel="stylesheet">

    <!-- ======= BEGIN GLOBAL MANDATORY STYLES ======= -->
    <link rel="stylesheet" href="template/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="template/assets/fonts/icofont/icofont.min.css">
    <link rel="stylesheet" href="template/assets/plugins/perfect-scrollbar/perfect-scrollbar.min.css">
    <!-- ======= END BEGIN GLOBAL MANDATORY STYLES ======= -->

    <!-- ======= MAIN STYLES ======= -->
    <link rel="stylesheet" href="template/assets/css/style.css">

    <script src=" https://unpkg.com/sweetalert/dist/sweetalert.min.js">
    </script>
    <script>
        function login_process(e) {
            e.preventDefault();
            var url = "cek_login.php?act=login";
            var email = document.getElementById("email").value;
            var password = document.getElementById("password").value;
            if (!email && !password) {
                swal({
                    title: "Warning",
                    text: "Harap isi email dan password",
                    icon: "warning",
                }).then(function() {});
            } else {
                fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: new URLSearchParams({
                        'email': email,
                        'password': password
                    })
                }).then(response => response.json()).then(data => {
                    console.log(data?.status)
                    if (data?.status == "success") {
                        swal({
                            title: "Login Success",
                            text: data?.status,
                            icon: "success",
                        }).then(function() {
                            window.location.href = "dashboard";
                        });
                    } else {
                        swal({
                            title: "Login Failed",
                            text: data?.status,
                            icon: "error",
                        }).then(function() {
                            document.getElementById("password").value = "";
                        });
                    }

                })
            }

        }
    </script>

    <!-- ======= END MAIN STYLES ======= -->

</head>

<body>

    <div class="mn-vh-100 d-flex align-items-center">
        <div class="container">
            <!-- Card -->
            <div class="card justify-content-center auth-card">
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-9">
                        <h4 class="mb-5 font-20">Welcome To Jasamarga</h4>

                        <form onsubmit="return login_process(event)">
                            <!-- Form Group -->
                            <div class="form-group mb-20">
                                <label for="email" class="mb-2 font-14 bold black">Email Or NIK</label>
                                <input type="text" id="email" class="theme-input-style" placeholder="Email Address">
                            </div>
                            <!-- End Form Group -->

                            <!-- Form Group -->
                            <div class="form-group mb-20">
                                <label for="password" class="mb-2 font-14 bold black">Password</label>
                                <input type="password" id="password" class="theme-input-style" placeholder="********">
                            </div>
                            <!-- End Form Group -->

                            <div class="d-flex justify-content-between mb-20">
                                <div class="d-flex align-items-center">
                                    <!-- Custom Checkbox -->
                                    <label class="custom-checkbox position-relative mr-2">
                                        <input type="checkbox" id="checkbox">
                                        <span class="checkmark"></span>
                                    </label>
                                    <!-- End Custom Checkbox -->

                                    <label for="checkbox" class="font-14">Remember Me</label>
                                </div>

                                <a href="forget-pass.html" class="font-12 text_color">Forgot Password?</a>
                            </div>

                            <div class="mb-30">
                                <a href="#" class="light-btn mr-3 mb-20">Log In With Facebook</a>
                                <a href="#" class="light-btn style--two mb-20">Log In With Gmail</a>
                            </div>

                            <div class="d-flex align-items-center">
                                <button type="submit" class="btn long mr-20">Log In</button>
                                <span class="font-12 d-block"><a href="signup" class="bold">Sign Up</a>,If you have no account.</span>
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
    <script src="template/assets/js/jquery.min.js"></script>
    <script src="template/assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="template/assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="template/assets/js/script.js"></script>
    <!-- ======= BEGIN GLOBAL MANDATORY SCRIPTS ======= -->
</body>

</html>