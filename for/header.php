<?php
// Start output buffering
ob_start();

// Include DB connection
include "z_db.php";

// Prevent caching
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// Start secure session
if (session_status() === PHP_SESSION_NONE) {
    session_start([
        'cookie_httponly' => true,
        'cookie_secure' => isset($_SERVER['HTTPS']),
        'cookie_samesite' => 'Strict'
    ]);
}

// Check if user is logged in and get user details
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    
    // Prepared statement for security
    $stmt = mysqli_prepare($con, "SELECT email, full_name, role FROM users WHERE user_id = ?");
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $user_data = mysqli_fetch_assoc($result);
        $_SESSION['email'] = $user_data['email'];
        $_SESSION['full_name'] = $user_data['full_name'];
        $_SESSION['role'] = $user_data['role'];
    }
    mysqli_stmt_close($stmt);
}
?>

<!doctype html>
<html class="no-js" lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <?php
    // Site settings with prepared statement
    // $stmt = mysqli_prepare($con, "SELECT site_title FROM siteconfig WHERE id = 1");
    // mysqli_stmt_execute($stmt);
    // $result = mysqli_stmt_get_result($stmt);
    // $r = mysqli_fetch_assoc($result);
    // mysqli_stmt_close($stmt);
    ?>
    
    <title>KSA Welcome Cup - <?= htmlspecialchars($r['site_title'] ?? '') ?></title>
    <link rel="icon" href="assets/img/favicon.png">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
</head>

<body>
    <div class="main overflow-hidden">
        <header id="header">
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
                            <?php if ($_SESSION['role'] === 'admin'): ?>
                                <li class="nav-item">
                                    <a href="../dashboard/" class="nav-link">لوحة التحكم</a>
                                </li>
                            <?php endif; ?>
                            
                            <li class="nav-item"><a href="profile.php" class="nav-link">حسابي</a></li>
                            <li class="nav-item"><a href="user_testimony.php" class="nav-link">عطنا رايك</a></li>
                        <?php endif; ?>
                    </ul>

                    <ul class="navbar-nav toggle">
                        <li class="nav-item">
                            <a href="#" class="nav-link" data-toggle="modal" data-target="#menu">
                                <i class="fas fa-bars toggle-icon m-0"></i>
                            </a>
                        </li>
                    </ul>

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
<?php ob_end_flush(); ?>