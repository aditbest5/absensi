<?php
session_start();
if ($_SESSION['status'] != 'login') {
    header("location: login?pesan=belum_login");
}
?>
<!DOCTYPE html>
<html lang="zxx">

<head>
    <!-- Page Title -->
    <title>Jasamarga - Dashboard Absensi</title>

    <!-- Meta Data -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <script src="logout.js"></script>

    <!-- Favicon -->
    <link rel="shortcut icon" href="template/assets/img/favicon.png">

    <!-- Web Fonts -->
    <link href="https://fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i&display=swap" rel="stylesheet">

    <!-- ======= BEGIN GLOBAL MANDATORY STYLES ======= -->
    <link rel="stylesheet" href="template/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="template/assets/fonts/icofont/icofont.min.css">
    <link rel="stylesheet" href="template/assets/plugins/perfect-scrollbar/perfect-scrollbar.min.css">
    <!-- ======= END BEGIN GLOBAL MANDATORY STYLES ======= -->

    <!-- ======= BEGIN PAGE LEVEL PLUGINS STYLES ======= -->
    <link rel="stylesheet" href="template/assets/plugins/apex/apexcharts.css">
    <!-- ======= END BEGIN PAGE LEVEL PLUGINS STYLES ======= -->
    <script src=" https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="template/assets/js/geolocation.js"></script>

    <!-- ======= MAIN STYLES ======= -->
    <link rel="stylesheet" href="template/assets/css/style.css">
    <!-- ======= END MAIN STYLES ======= -->

</head>

<body>

    <!-- Offcanval Overlay -->
    <div class="offcanvas-overlay"></div>
    <!-- Offcanval Overlay -->

    <!-- Wrapper -->
    <div class="wrapper">

        <!-- Header -->
        <header class="header white-bg fixed-top d-flex align-content-center flex-wrap">
            <!-- Logo -->
            <div class="logo">
                <a href="index.html" class="default-logo"><img src="template/assets/img/jasamarga.png" alt=""></a>
                <a href="index.html" class="mobile-logo"><img src="template/assets/img/mobile-logo.png" alt=""></a>
            </div>
            <!-- End Logo -->

            <!-- Main Header -->
            <div class="main-header">
                <div class="container-fluid">
                    <div class="row justify-content-between">
                        <div class="col-3 col-lg-1 col-xl-4">
                            <!-- Header Left -->
                            <div class="main-header-left h-100 d-flex align-items-center">
                                <!-- Main Header User -->
                                <div class="main-header-user">
                                    <a href="#" class="d-flex align-items-center" data-toggle="dropdown">
                                        <div class="menu-icon">
                                            <span></span>
                                            <span></span>
                                            <span></span>
                                        </div>

                                        <div class="user-profile d-xl-flex align-items-center d-none">
                                            <!-- User Avatar -->
                                            <div class="user-avatar">
                                                <img src="template/assets/img/avatar/user.png" alt="">
                                            </div>
                                            <!-- End User Avatar -->

                                            <!-- User Info -->
                                            <div class="user-info">
                                                <h4 class="user-name"><?php echo $_SESSION['name'] ?></h4>
                                                <p class="user-email"><?php echo $_SESSION['email'] ?></p>
                                            </div>
                                            <!-- End User Info -->
                                        </div>
                                    </a>
                                    <div class="dropdown-menu">
                                        <div class="d-flex flex-column justify-content-between">
                                            <button class="" href="#">My Profile</button>
                                            <button class="" href="#">task</button>
                                            <button class="" href="#">Settings</button>
                                            <button class="btn-info" onclick="logout()">Log Out</button>
                                        </div>

                                    </div>
                                </div>
                                <!-- End Main Header User -->

                                <!-- Main Header Menu -->
                                <div class="main-header-menu d-block d-lg-none">
                                    <div class="header-toogle-menu">
                                        <!-- <i class="icofont-navigation-menu"></i> -->
                                        <img src="template/assets/img/menu.png" alt="">
                                    </div>
                                </div>
                                <!-- End Main Header Menu -->
                            </div>
                            <!-- End Header Left -->
                        </div>
                        <div class="col-9 col-lg-11 col-xl-8">
                            <!-- Header Right -->
                            <div class="main-header-right d-flex justify-content-end">
                                <ul class="nav">
                                    <li class="ml-0">
                                        <!-- Main Header Language -->
                                        <div class="main-header-language">
                                            <a href="#" data-toggle="dropdown">
                                                <img src="template/assets/img/svg/globe-icon.svg" alt="">
                                            </a>
                                            <div class="dropdown-menu style--three">
                                                <a href="#">
                                                    <span><img src="template/assets/img/usa.png" alt=""></span>
                                                    USA
                                                </a>
                                                <a href="#">
                                                    <span><img src="template/assets/img/china.png" alt=""></span>
                                                    China
                                                </a>
                                                <a href="#">
                                                    <span><img src="template/assets/img/russia.png" alt=""></span>
                                                    Russia
                                                </a>
                                                <a href="#">
                                                    <span><img src="template/assets/img/spain.png" alt=""></span>
                                                    Spain
                                                </a>
                                                <a href="#">
                                                    <span><img src="template/assets/img/brazil.png" alt=""></span>
                                                    Brazil
                                                </a>
                                                <a href="#">
                                                    <span><img src="template/assets/img/france.png" alt=""></span>
                                                    France
                                                </a>
                                                <a href="#">
                                                    <span><img src="template/assets/img/algeria.png" alt=""></span>
                                                    Algeria
                                                </a>
                                            </div>
                                        </div>
                                        <!-- End Main Header Language -->
                                    </li>
                                    <li class="ml-0 d-none d-lg-flex">
                                        <!-- Main Header Print -->
                                        <div class="main-header-print">
                                            <a href="#">
                                                <img src="template/assets/img/svg/print-icon.svg" alt="">
                                            </a>
                                        </div>
                                        <!-- End Main Header Print -->
                                    </li>
                                    <li class="d-none d-lg-flex">
                                        <!-- Main Header Time -->
                                        <div class="main-header-date-time text-right">
                                            <h3 class="time">
                                                <span id="hours">21</span>
                                                <span id="point">:</span>
                                                <span id="min">06</span>
                                            </h3>
                                            <span class="date"><span id="date">Tue, 12 October 2019</span></span>
                                        </div>
                                        <!-- End Main Header Time -->
                                    </li>
                                    <li class="d-none d-lg-flex">
                                        <!-- Main Header Button -->
                                        <div class="main-header-btn ml-md-1">
                                            <a href="#" class="btn">Pending Tasks</a>
                                        </div>
                                        <!-- End Main Header Button -->
                                    </li>
                                    <li class="order-2 order-sm-0">
                                        <!-- Main Header Search -->
                                        <div class="main-header-search">
                                            <form action="#" class="search-form">
                                                <div class="theme-input-group header-search">
                                                    <input type="text" class="theme-input-style" placeholder="Search Here">

                                                    <button type="submit"><img src="template/assets/img/svg/search-icon.svg" alt="" class="svg"></button>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- End Main Header Search -->
                                    </li>
                                    <li>
                                        <!-- Main Header Messages -->
                                        <div class="main-header-message">
                                            <a href="#" class="header-icon" data-toggle="dropdown">
                                                <img src="template/assets/img/svg/message-icon.svg" alt="" class="svg">
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <!-- Dropdown Header -->
                                                <div class="dropdown-header d-flex align-items-center justify-content-between">
                                                    <h5>3 Unread messages</h5>
                                                    <a href="#" class="text-mute d-inline-block">Clear all</a>
                                                </div>
                                                <!-- End Dropdown Header -->

                                                <!-- Dropdown Body -->
                                                <div class="dropdown-body">
                                                    <!-- Item Single -->
                                                    <a href="#" class="item-single d-flex media align-items-center">
                                                        <div class="figure">
                                                            <img src="template/assets/img/avatar/m1.png" alt="">
                                                            <span class="avatar-status bg-teal"></span>
                                                        </div>
                                                        <div class="content media-body">
                                                            <div class="d-flex align-items-center mb-2">
                                                                <h6 class="name">Sender Name</h6>
                                                                <p class="time">2 min ago</p>
                                                            </div>
                                                            <p class="main-text">Donec dapibus mauris id odio ornare tempus. Duis sit amet accumsan justo.</p>
                                                        </div>
                                                    </a>
                                                    <!-- End Item Single -->

                                                    <!-- Item Single -->
                                                    <a href="#" class="item-single d-flex media align-items-center">
                                                        <div class="figure">
                                                            <img src="template/assets/img/avatar/m2.png" alt="">
                                                            <span class="avatar-status bg-teal"></span>
                                                        </div>
                                                        <div class="content media-body">
                                                            <div class="d-flex align-items-center mb-2">
                                                                <h6 class="name">Tonya Lee</h6>
                                                                <p class="time">2 min ago</p>
                                                            </div>
                                                            <p class="main-text">Donec dapibus mauris id odio ornare tempus. Duis sit amet accumsan justo.</p>
                                                        </div>
                                                    </a>
                                                    <!-- End Item Single -->

                                                    <!-- Item Single -->
                                                    <a href="#" class="item-single d-flex media align-items-center">
                                                        <div class="figure">
                                                            <img src="template/assets/img/avatar/m3.png" alt="">
                                                            <span class="avatar-status bg-teal"></span>
                                                        </div>
                                                        <div class="content media-body">
                                                            <div class="d-flex align-items-center mb-2">
                                                                <h6 class="name">Cathy Nichols</h6>
                                                                <p class="time">2 min ago</p>
                                                            </div>
                                                            <p class="main-text">Donec dapibus mauris id odio ornare tempus. Duis sit amet accumsan justo.</p>
                                                        </div>
                                                    </a>
                                                    <!-- End Item Single -->

                                                    <!-- Item Single -->
                                                    <a href="#" class="item-single d-flex media align-items-center">
                                                        <div class="figure">
                                                            <img src="template/assets/img/avatar/m4.png" alt="">
                                                            <span class="avatar-status bg-teal"></span>
                                                        </div>
                                                        <div class="content media-body">
                                                            <div class="d-flex align-items-center mb-2">
                                                                <h6 class="name">Hubert Griffith</h6>
                                                                <p class="time">2 min ago</p>
                                                            </div>
                                                            <p class="main-text">Donec dapibus mauris id odio ornare tempus. Duis sit amet accumsan justo.</p>
                                                        </div>
                                                    </a>
                                                    <!-- End Item Single -->
                                                </div>
                                                <!-- End Dropdown Body -->
                                            </div>
                                        </div>
                                        <!-- End Main Header Messages -->
                                    </li>
                                    <li>
                                        <!-- Main Header Notification -->
                                        <div class="main-header-notification">
                                            <a href="#" class="header-icon notification-icon" data-toggle="dropdown">
                                                <span class="count" data-bg-img="template/assets/img/count-bg.png">22</span>
                                                <img src="template/assets/img/svg/notification-icon.svg" alt="" class="svg">
                                            </a>
                                            <div class="dropdown-menu style--two dropdown-menu-right">
                                                <!-- Dropdown Header -->
                                                <div class="dropdown-header d-flex align-items-center justify-content-between">
                                                    <h5>5 New notifications</h5>
                                                    <a href="#" class="text-mute d-inline-block">Clear all</a>
                                                </div>
                                                <!-- End Dropdown Header -->

                                                <!-- Dropdown Body -->
                                                <div class="dropdown-body">
                                                    <!-- Item Single -->
                                                    <a href="#" class="item-single d-flex align-items-center">
                                                        <div class="content">
                                                            <div class="mb-2">
                                                                <p class="time">2 min ago</p>
                                                            </div>
                                                            <p class="main-text">Donec dapibus mauris id odio ornare tempus amet.</p>
                                                        </div>
                                                    </a>
                                                    <!-- End Item Single -->

                                                    <!-- Item Single -->
                                                    <a href="#" class="item-single d-flex align-items-center">
                                                        <div class="content">
                                                            <div class="mb-2">
                                                                <p class="time">2 min ago</p>
                                                            </div>
                                                            <p class="main-text">Donec dapibus mauris id odio ornare tempus. Duis sit amet accumsan justo.</p>
                                                        </div>
                                                    </a>
                                                    <!-- End Item Single -->

                                                    <!-- Item Single -->
                                                    <a href="#" class="item-single d-flex align-items-center">
                                                        <div class="content">
                                                            <div class="mb-2">
                                                                <p class="time">2 min ago</p>
                                                            </div>
                                                            <p class="main-text">Donec dapibus mauris id odio ornare tempus. Duis sit amet accumsan justo.</p>
                                                        </div>
                                                    </a>
                                                    <!-- End Item Single -->

                                                    <!-- Item Single -->
                                                    <a href="#" class="item-single d-flex align-items-center">
                                                        <div class="content">
                                                            <div class="mb-2">
                                                                <p class="time">2 min ago</p>
                                                            </div>
                                                            <p class="main-text">Donec dapibus mauris id odio ornare tempus. Duis sit amet accumsan justo.</p>
                                                        </div>
                                                    </a>
                                                    <!-- End Item Single -->
                                                </div>
                                                <!-- End Dropdown Body -->
                                            </div>
                                        </div>
                                        <!-- End Main Header Notification -->
                                    </li>
                                </ul>
                            </div>
                            <!-- End Header Right -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Main Header -->
        </header>
        <!-- End Header -->

        <!-- Main Wrapper -->
        <div class="main-wrapper">
            <!-- Sidebar -->
            <nav class="sidebar" data-trigger="scrollbar">
                <!-- Sidebar Header -->
                <div class="sidebar-header d-none d-lg-block">
                    <!-- Sidebar Toggle Pin Button -->
                    <div class="sidebar-toogle-pin">
                        <i class="icofont-tack-pin"></i>
                    </div>
                    <!-- End Sidebar Toggle Pin Button -->
                </div>
                <!-- End Sidebar Header -->

                <!-- Sidebar Body -->
                <div class="sidebar-body">
                    <!-- Nav -->
                    <ul class="nav">
                        <li class="nav-category">Main</li>
                        <li class="active">
                            <a href="dashboard">
                                <i class="icofont-pie-chart"></i>
                                <span class="link-title">Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="check-in">
                                <i class="icofont-pie-chart"></i>
                                <span class="link-title">Kehadiran</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="icofont-ui-user"></i>
                                <span class="link-title">User Profile</span>
                            </a>

                            <!-- Sub Menu -->
                            <ul class="nav sub-menu">
                                <li><a href="pages/pages/user-profile/news-feed.html">My Profile</a></li>
                                <li><a href="pages/pages/user-profile/about.html">Log Absensi</a></li>
                                <li><a href="pages/pages/user-profile/gallery.html">Settings</a></li>
                            </ul>
                            <!-- End Sub Menu -->
                        </li>
                    </ul>
                    <!-- End Nav -->
                </div>
                <!-- End Sidebar Body -->
            </nav>