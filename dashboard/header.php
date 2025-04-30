<?php
include "z_db.php";

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");


session_start();
// Check, if username session is NOT set then this page will jump to login page

if (!isset($_SESSION["username"])) {
    print "
				<script language='javascript'>
					window.location = 'login.php';
				</script>
			";
}

// Check, if username session is NOT set then this page will jump to login page
if (isset($_SESSION["username"])) {
    $username = $_SESSION["username"];
} else {
    print "
				<script language='javascript'>
					window.location = 'login.php';
				</script>
			";
}
?>



<!doctype html>
<html  data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">


<!-- Mirrored from themesbrand.com/velzon/html/default/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 24 Jun 2022 20:35:42 GMT -->
<head>
    <meta charset="utf-8" />
    <title>Dashboard KSAWC</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <link href="assets/libs/jsvectormap/css/jsvectormap.min.css" rel="stylesheet" type="text/css" />

    <link href="assets/libs/swiper/swiper-bundle.min.css" rel="stylesheet" type="text/css" />

    <script src="assets/js/layout.js"></script>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/custom.min.css" rel="stylesheet" type="text/css" />

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.css" rel="stylesheet">


</head>

<body>

    <div id="layout-wrapper">
    <header id="page-topbar">
            <div class="layout-width">
                <div class="navbar-header">
                    <div class="d-flex">
                        <div class="navbar-brand-box horizontal-logo">
                            <a href="index.php" class="logo logo-dark">
                                <span class="logo-sm">
                                    <!-- <img src="assets/images/logo-sm.png" alt="شعار فوغ" height="22"> -->
                                </span>
                                <span class="logo-lg">
                                    <!-- <img src="assets/images/logo-dark.png" alt="شعار فوغ" height="17"> -->
                                </span>
                            </a>
                            <a href="index.php" class="logo logo-light">
                                <span class="logo-sm">
                                    <!-- <img src="assets/images/logo-sm.png" alt="شعار فوغ" height="22"> -->
                                </span>
                                <span class="logo-lg">
                                    <!-- <img src="assets/images/logo-light.png" alt="شعار فوغ" height="17"> -->
                                </span>
                            </a>
                        </div>
                        <button type="button" class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger me-auto"
                            id="topnav-hamburger-icon">
                            <span class="hamburger-icon">
                                <span></span>
                                <span></span>
                                <span></span>
                            </span>
                        </button>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="dropdown d-md-none topbar-head-dropdown header-item">
                            <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle"
                                id="page-header-search-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <i class="bx bx-search fs-22"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-start p-0"
                                aria-labelledby="page-header-search-dropdown">
                                <form class="p-3">
                                    <div class="form-group m-0">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="بحث..."
                                                aria-label="بحث">
                                            <button class="btn btn-primary" type="submit"><i
                                                    class="mdi mdi-magnify"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="me-1 header-item d-none d-sm-flex">
                            <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle"
                                data-toggle="fullscreen">
                                <i class='bx bx-fullscreen fs-22'></i>
                            </button>
                        </div>
                        <div class="me-1 header-item d-none d-sm-flex">
                            <button type="button"
                                class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle light-dark-mode">
                                <i class='bx bx-moon fs-22'></i>
                            </button>
                        </div>
                        <div class="dropdown me-sm-3 header-item topbar-user">
                            <button type="button" class="btn" id="page-header-user-dropdown" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <span class="d-flex align-items-center">
                                    <span class="text-start me-xl-2">
                                        <span class="d-none d-xl-inline-block me-1 fw-medium user-name-text"><?php echo htmlspecialchars(
                                            $username
                                        ); ?></span>
                                    </span>
                                </span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-start">
                                <h6 class="dropdown-header">مرحباً <?php echo htmlspecialchars(
                                    $username
                                ); ?>!</h6>
                                <a class="dropdown-item" href="logout">
                                    <i class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i>
                                    <span class="align-middle">تسجيل الخروج</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const toggleBtn = document.getElementById("topnav-hamburger-icon");
    const sidebar = document.querySelector(".app-menu");
    const mainContent = document.querySelector(".main-content");

    toggleBtn.addEventListener("click", function () {
        sidebar.classList.toggle("d-none"); // Hides/shows sidebar
        if (sidebar.classList.contains("d-none")) {
            mainContent.style.marginLeft = "0";
        } else {
            mainContent.style.marginLeft = "250px";
        }
    });
});
</script>