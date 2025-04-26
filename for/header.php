<?php
include "z_db.php";

// منع كاش المتصفح
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if user is logged in and admin status
$is_admin = false;
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    
    // First get the user's email or username from users table
    $user_query = mysqli_query($con, "SELECT email, username FROM users WHERE id = '$user_id'");
    
    if ($user_query && mysqli_num_rows($user_query) > 0) {
        $user_data = mysqli_fetch_assoc($user_query);
        $user_email = $user_data['email'];
        $user_username = $user_data['username'];
        
        // Check if either email or username exists in admin table
        $admin_query = mysqli_query($con, "SELECT * FROM admin WHERE email = '$user_email' OR username = '$user_username'");
        
        if ($admin_query && mysqli_num_rows($admin_query) > 0) {
            $is_admin = true;
        }
    }
}
?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- SEO Meta Description -->
    <meta name="description" content="">
    <meta name="author" content="Themeland">
    <?php
    $rr = mysqli_query($con, "SELECT * FROM siteconfig where id=1");
    $r = mysqli_fetch_array($rr);
    $site_title = "$r[site_title]";
    $site_about = "$r[site_about]";
    $site_footer = "$r[site_footer]";
    $follow_text = "$r[follow_text]";
    ?>
    <!-- Title  -->
    <title>KSA Welcome Cup - <?php print $site_title ?></title>

    <!-- Favicon  -->
    <link rel="icon" href="assets/img/favicon.png">
 
    <!-- ***** All CSS Files ***** -->

    <!-- Style css -->
    <link rel="stylesheet" href="assets/css/style.css">

    <!-- Responsive css -->
    <link rel="stylesheet" href="assets/css/responsive.css">

</head>

<body>
    <!--====== Preloader Area Start ======-->
    <div id="preloader">
        <!-- KSA Welcome Preloader -->
        <div id="digimax-preloader" class="digimax-preloader">
            <!-- Preloader Animation -->
            <div class="preloader-animation">
                <!-- Spinner -->
                <div class="spinner"></div>
                <!-- Loader -->
                <div class="loader">
                    <span data-text-preloader="K" class="animated-letters">K</span>
                    <span data-text-preloader="S" class="animated-letters">S</span>
                    <span data-text-preloader="A" class="animated-letters">A</span>
                    <span data-text-preloader="W" class="animated-letters">W</span>
                    <span data-text-preloader="C" class="animated-letters">C</span>
                </div>
                <p class="fw-5 text-center text-uppercase">جارٍ التحميل</p>
            </div>

            <!-- Loader Animation -->
            <div class="loader-animation">
                <div class="row h-100">
                    <div class="col-3 single-loader p-0">
                        <div class="loader-bg"></div>
                    </div>
                    <div class="col-3 single-loader p-0">
                        <div class="loader-bg"></div>
                    </div>
                    <div class="col-3 single-loader p-0">
                        <div class="loader-bg"></div>
                    </div>
                    <div class="col-3 single-loader p-0">
                        <div class="loader-bg"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--====== Preloader Area End ======-->

    <!--====== Scroll To Top Area Start ======-->
    <div id="scrollUp" title="Scroll To Top">
        <i class="fas fa-arrow-up"></i>
    </div>
    <!--====== Scroll To Top Area End ======-->

    <div class="main overflow-hidden">
        <!-- ***** Header Start ***** -->
        <header id="header" dir="rtl">
            <!-- Navbar -->
            <nav data-aos="zoom-out" data-aos-delay="800" class="navbar navbar-expand">
                <div class="container header" style="display: flex;flex-direction: row-reverse;">
                    <!-- Navbar Brand -->
                    <?php
                    $rt = mysqli_query($con, "SELECT ufile FROM logo WHERE id=1");
                    $tr = mysqli_fetch_array($rt);
                    $ufile = $tr['ufile'];
                    ?>

                    <a class="navbar-brand" href="index.php">
                        <!-- <img class="navbar-brand-regular" src="../dashboard/uploads/logo/<?php echo $ufile; ?>" alt="شعار" style="border-radius: 50%; background: white; max-height: 40px;"> -->
                        <!-- <img class="navbar-brand-sticky" src="../dashboard/uploads/logo/<?php echo $ufile; ?>" alt="شعار ثابت" style="border-radius: 50%; background: white; max-height: 40px;"> -->
                    </a>

                    <div class="ml-auto"></div>

                    <!-- Navbar Links -->
                    <ul class="navbar-nav items">
                        <li class="nav-item">
                            <a class="nav-link" href="home">الرئيسية</a>
                        </li>
                        <li class="nav-item">
                            <a href="about" class="nav-link"> نتائج المباريات</a>
                        </li>
                        <li class="nav-item">
                            <a href="services" class="nav-link">أماكن الاستضافة والملاعب</a>
                        </li>
                        <li class="nav-item">
                            <a href="event" class="nav-link">الفعاليات</a>
                        </li>
                        
                        <?php if (isset($_SESSION['user_id'])): ?>
                            <li class="nav-item">
                                <?php if ($is_admin): ?>
                                    <a href="http://localhost/Project/dashboard/" class="nav-link">لوحة التحكم</a>
                                <?php endif; ?>
                                <a href="profile.php" class="nav-link">حسابي</a>
                                <a href="user_testimony.php" class="nav-link">عطنا رايك</a>
                            </li>
                        <?php endif; ?>
                    </ul>

                    <!-- Navbar Toggler -->
                    <ul class="navbar-nav toggle">
                        <li class="nav-item">
                            <a href="#" class="nav-link" data-toggle="modal" data-target="#menu">
                                <i class="fas fa-bars toggle-icon m-0"></i>
                            </a>
                        </li>
                    </ul>

                    <!-- Login Button -->
                    <ul class="navbar-nav action">
                        <li class="nav-item ml-3">
                            <?php if (isset($_SESSION['user_id'])): ?>
                                <a href="logout.php" class="btn ml-lg-auto btn-bordered-white">
                                    <i class="fas fa-sign-out-alt contact-icon mr-md-2"></i>تسجيل الخروج
                                </a>
                            <?php else: ?>
                                <a href="login.php" class="btn ml-lg-auto btn-bordered-white" data-bs-toggle="modal" data-bs-target="#loginModal">
                                    <i class="fas fa-sign-in-alt contact-icon mr-md-2"></i>تسجيل الدخول
                                </a>
                            <?php endif; ?>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ***** Header End ***** -->

        <style>
            .navbar-brand img {
                max-height: 40px;
                height: auto;
                width: auto;
                border-radius: 50%;         /* يجعلها دائرية */
                background-color: white;    /* خلفية بيضاء */
                padding: 2px;               /* مسافة بسيطة لتظهر الخلفية حول الصورة */
                object-fit: cover;          /* لتناسب الشكل داخل الدائرة */
            }
        </style>