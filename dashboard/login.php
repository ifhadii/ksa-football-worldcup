<?php
include_once "z_db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["email"])) {
    $status = "OK";
    $msg = "";
    $email = mysqli_real_escape_string($con, $_POST["email"]);
    $password = $_POST['password'];

    if ($status == "OK") {
        $query = "SELECT user_id, email, password, full_name, role 
                 FROM users 
                 WHERE email = ? 
                 AND role = 'admin'  
                 LIMIT 1";

        if ($stmt = mysqli_prepare($con, $query)) {
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            
            if ($user = mysqli_fetch_assoc($result)) {
                if (password_verify($password, $user['password'])) {
                    session_start();
                    $_SESSION["user_id"] = $user['user_id'];
                    $_SESSION["email"] = $user['email'];
                    $_SESSION["full_name"] = $user['full_name'];
                    $_SESSION["role"] = $user['role'];
                    
                    print "
                    <script language='javascript'>
                        window.location = 'index.php';
                    </script>";
                    exit();
                } else {
                    $errormsg = "
                    <div class='alert alert-danger alert-dismissible alert-outline fade show'>
                        البريد الإلكتروني أو كلمة المرور غير صحيحة
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
                }
            } else {
                $errormsg = "
                <div class='alert alert-danger alert-dismissible alert-outline fade show'>
                    لا يوجد حساب مسؤول بهذا البريد الإلكتروني
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
            }
            mysqli_stmt_close($stmt);
        } else {
            $errormsg = "
            <div class='alert alert-danger alert-dismissible alert-outline fade show'>
                خطأ في قاعدة البيانات
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
        }
    }
}
?>

<!doctype html>
<html lang="ar" dir="rtl" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">

<head>
  <meta charset="utf-8" />
  <title>تسجيل الدخول الإدارة</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
  <meta content="Themesbrand" name="author" />
  <link rel="shortcut icon" href="assets/images/favicon.ico">

  <script src="assets/js/layout.js"></script>
  <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="assets/css/bootstrap.rtl.min.css" rel="stylesheet" type="text/css" />
  <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
  <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" />
  <link href="assets/css/app.rtl.min.css" rel="stylesheet" type="text/css" />
  <link href="assets/css/custom.min.css" rel="stylesheet" type="text/css" />
  <style>
    body {
      font-family: 'Tajawal', sans-serif;
      text-align: right;
      /* background-image: url('uploads/dashboard/circuit_photo.jpg'); */
    }
    body::before {
  content: "";
  background-image: url('uploads/dashboard/circuit_photo.jpg');
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  opacity: 0.2; /* Adjust this value (0.0 to 1.0) */
  z-index: -1;
}
    .auth-pass-inputgroup .form-control {
      padding-left: 45px;
      padding-right: 12px;
    }
    .auth-pass-inputgroup button {
      left: 0;
      right: auto;
    }
    .form-label {
      text-align: right;
      display: block;
      margin-bottom: 0.5rem;
      float: right;
    }
    .text-start {
      text-align: right !important;
    }
    .text-end {
      text-align: left !important;
    }
    .pe-5 {
      padding-left: 3rem !important;
      padding-right: 1rem !important;
    }
  </style>
</head>

<body style="background-color:rgb(219, 218, 218); color: white;">
  <div class="auth-page-wrapper py-5 d-flex justify-content-center align-items-center min-vh-100">
    <!-- <div class="bg-overlay"></div> -->
    <div class="auth-page-content overflow-hidden pt-lg-5">
      <div class="container  d-flex justify-content-center align-items-center">
        <!-- <div class="row"> -->
          <!-- <div class="col-lg-12"> -->
            <!-- <div class="card overflow-hidden"> -->
              <!-- <div class="row g-0"> -->
                <!-- <div class="col-lg-6"> -->
                  <!-- <div class="p-lg-5 p-4 auth-one-bg h-100"> -->
                    <!-- <div class="bg-overlay"></div> -->
                    <!-- <div class="position-relative h-100 d-flex flex-column"> -->
                      <div class="">
                        <h3>
                        </h3>
                      <?php
                      $rr = mysqli_query($con, "SELECT ufile FROM logo");
                      $r = mysqli_fetch_row($rr);
                      $ufile = $r[0];
                      ?>
                        <a href="index.html" class="d-block">
                          <!-- <img src="uploads/logo/<?php print $ufile; ?>" alt="" height="18"> -->
                        </a>
                      <!-- </div> -->
                    <!-- </div> -->
                  <!-- </div> -->
                  
                  <!-- <div class="col-lg-6"> -->
              </div>

  <div class="card w-50">
  <div class="card-header py-3" style="background-color: rgb(16, 36, 18); color: white;">
    <h3 class="text-center font-weight-bold text-white">أهلا بالإداري</h5>
    <h4 class="text-white text-center mb-0 font-weight-bold">سجل دخولك للوحة التحكم</h5>
  </div>
  <div class="card-body">
    <div class="px-4">
      <?php if (isset($errormsg)) { echo $errormsg; } ?>
      <form class="user" method="POST">
        <div class="mb-3">
          <label for="email" class="form-label">البريد الإلكتروني</label>
          <input type="email" class="form-control" id="email" name="email" placeholder="أدخل البريد الإلكتروني" required>
        </div>

        <div class="mb-3">
          <label class="form-label" for="password-input">كلمة المرور</label>
          <div class="position-relative auth-pass-inputgroup mb-3">
            <input type="password" class="form-control pe-5" name="password" placeholder="أدخل كلمة المرور" id="password-input" required>
            <button class="btn btn-link position-absolute end-30 top-50 text-decoration-none text-muted" type="button" id="password-addon">
              <i class="ri-eye-fill align-middle"></i>
            </button>
          </div>
        </div>

        <div class="mt-4">
          <button class="btn btn-success w-100" type="submit">تسجيل الدخول</button>
        </div>
      </form>
    </div>
  </div>
</div>



                <!-- </div> -->
              <!-- </div> -->
            <!-- </div> -->
          <!-- </div> -->
        <!-- </div> -->
      </div>
    </div>

    <footer class="footer" style="background-color: rgb(16, 36, 18); color: white;">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="text-center">
            <?php
            $rr = mysqli_query($con, "SELECT site_footer FROM siteconfig");
            $r = mysqli_fetch_row($rr);
            $site_footer = $r[0];
            ?>
            <p class="mb-0"><?php print $site_footer; ?></p>
            </div>
          </div>
        </div>
      </div>
    </div>
    </footer>

  <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/libs/simplebar/simplebar.min.js"></script>
  <script src="assets/libs/node-waves/waves.min.js"></script>
  <script src="assets/libs/feather-icons/feather.min.js"></script>
  <script src="assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
  <script src="assets/js/plugins.js"></script>
  <script src="assets/js/pages/password-addon.init.js"></script>
  <script>
    // Toggle password visibility
    document.getElementById('password-addon').addEventListener('click', function () {
      var passwordInput = document.getElementById("password-input");
      if (passwordInput.type === "password") {
        passwordInput.type = "text";
        this.innerHTML = '<i class="ri-eye-off-fill align-middle"></i>';
      } else {
        passwordInput.type = "password";
        this.innerHTML = '<i class="ri-eye-fill align-middle"></i>';
      }
    });
  </script>
</body>
</html>