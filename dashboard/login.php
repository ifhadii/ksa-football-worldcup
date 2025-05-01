<?php
include_once "z_db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["email"])) {
    $status = "OK";
    $msg = "";
    $email = mysqli_real_escape_string($con, $_POST["email"]);
    $password = $_POST["password"]; // Don't escape password - we'll verify the hash

    if ($status == "OK") {
        // Check only users table where role='admin'
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
                // Verify password (assuming passwords are hashed)
                if (password_verify($password, $user['password'])) {
                    session_start();
                    // Set session variables
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
                        Invalid email or password
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
                }
            } else {
                $errormsg = "
                <div class='alert alert-danger alert-dismissible alert-outline fade show'>
                    No admin account found with this email
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
            }
            mysqli_stmt_close($stmt);
        } else {
            $errormsg = "
            <div class='alert alert-danger alert-dismissible alert-outline fade show'>
                Database error
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
        }
    }
}
?>

<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">

<head>
  <meta charset="utf-8" />
  <title>Sign In | Diamond</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
  <meta content="Themesbrand" name="author" />
  <link rel="shortcut icon" href="assets/images/favicon.ico">

  <script src="assets/js/layout.js"></script>
  <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
  <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" />
  <link href="assets/css/custom.min.css" rel="stylesheet" type="text/css" />
</head>

<body>
  <div class="auth-page-wrapper auth-bg-cover py-5 d-flex justify-content-center align-items-center min-vh-100">
    <div class="bg-overlay"></div>
    <div class="auth-page-content overflow-hidden pt-lg-5">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="card overflow-hidden">
              <div class="row g-0">
                <div class="col-lg-6">
                  <div class="p-lg-5 p-4 auth-one-bg h-100">
                    <div class="bg-overlay"></div>
                    <div class="position-relative h-100 d-flex flex-column">
                      <div class="mb-4">
                      <?php
                      $rr = mysqli_query($con, "SELECT ufile FROM logo");
                      $r = mysqli_fetch_row($rr);
                      $ufile = $r[0];
                      ?>
                        <a href="index.html" class="d-block">
                          <img src="uploads/logo/<?php print $ufile; ?>" alt="" height="18">
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="p-lg-5 p-4">
                    <div>
                      <h5 class="text-primary">Welcome Back!</h5>
                      <p class="text-muted">Sign in to continue to your dashboard.</p>
                    </div>

                    <div class="mt-4">
                    <?php if (isset($errormsg)) { echo $errormsg; } ?>
                      <form class="user" method="POST">
                        <div class="mb-3">
                          <label for="email" class="form-label">Email</label>
                          <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
                        </div>

                        <div class="mb-3">
                          <label class="form-label" for="password-input">Password</label>
                          <div class="position-relative auth-pass-inputgroup mb-3">
                            <input type="password" class="form-control pe-5" name="password" placeholder="Enter password" id="password-input" required>
                            <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                          </div>
                        </div>

                        <div class="mt-4">
                          <button class="btn btn-success w-100" type="submit">Sign In</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <footer class="footer">
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
    </footer>
  </div>

  <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/libs/simplebar/simplebar.min.js"></script>
  <script src="assets/libs/node-waves/waves.min.js"></script>
  <script src="assets/libs/feather-icons/feather.min.js"></script>
  <script src="assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
  <script src="assets/js/plugins.js"></script>
  <script src="assets/js/pages/password-addon.init.js"></script>
</body>
</html>