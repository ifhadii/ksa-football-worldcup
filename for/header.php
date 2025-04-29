<?php
// Start output buffering
ob_start();

// Include DB connection
include "z_db.php";

// Prevent caching
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// Start session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Admin flag
$admin_chc = 0;

// Check if user is logged in
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // Get user details
    $user_query = mysqli_query($con, "SELECT email, full_name FROM users WHERE user_id = '$user_id'");
    if ($user_query && mysqli_num_rows($user_query) > 0) {
        $user_data = mysqli_fetch_assoc($user_query);
        $user_email = $user_data['email'];
        $user_username = $user_data['full_name'];
    }
}
?>

<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <?php
    // Site settings
    $rr = mysqli_query($con, "SELECT * FROM siteconfig WHERE id=1");
    $r = mysqli_fetch_array($rr);
    ?>
    
    <title>KSA Welcome Cup - <?= htmlspecialchars($r['site_title']) ?></title>
    <link rel="icon" href="assets/img/favicon.png">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
</head>

<body>
    <div class="main overflow-hidden">
        <!-- Header -->
        <header id="header" dir="rtl">
            <nav class="navbar navbar-expand">
                <div class="container header" style="display: flex; flex-direction: row-reverse;">
                    <a class="navbar-brand" href="index.php"></a>

                    <div class="ml-auto"></div>

                    <ul class="navbar-nav items">
                        <li class="nav-item"><a class="nav-link" href="home">الرئيسية</a></li>
                        <li class="nav-item"><a href="about" class="nav-link">نتائج المباريات</a></li>
                        <li class="nav-item"><a href="services" class="nav-link">أماكن الاستضافة والملاعب</a></li>
                        <li class="nav-item"><a href="event" class="nav-link">الفعاليات</a></li>

                        <?php if (isset($_SESSION['user_id'])): ?>

                            <li class="nav-item">
                                <!-- <a href="http://localhost/Project/dashboard/" class="nav-link">لوحة التحكم</a> -->
                            </li>
                            
                            <li class="nav-item"><a href="profile.php" class="nav-link">حسابي</a></li>
                            <li class="nav-item"><a href="user_testimony.php" class="nav-link">عطنا رايك</a></li>

                        <?php endif; ?>
                    </ul>

                    <!-- Toggler -->
                    <ul class="navbar-nav toggle">
                        <li class="nav-item">
                            <a href="#" class="nav-link" data-toggle="modal" data-target="#menu">
                                <i class="fas fa-bars toggle-icon m-0"></i>
                            </a>
                        </li>
                    </ul>

                    <!-- Login/Logout -->
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

    </div>

    <script src="assets/js/main.js"></script>
</body>
</html>