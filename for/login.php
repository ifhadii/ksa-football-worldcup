<?php
session_start();
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Database connection (replace with your actual connection code)
    require_once 'config.php';
    
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = $_POST['password'];
    
    // Validate inputs
    if (empty($email) || empty($password)) {
        $error = "البريد الإلكتروني وكلمة المرور مطلوبان";
    } else {
        // Check user in database
        $query = "SELECT * FROM users WHERE email='$email'";
        $result = mysqli_query($con, $query);
        
        if (mysqli_num_rows($result) == 1) {
            $user = mysqli_fetch_assoc($result);
            
            // Verify password (assuming passwords are hashed)
            if (password_verify($password, $user['password'])) {
                // Login successful - set session variables
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_email'] = $user['email'];
                $_SESSION['logged_in'] = true;
                
                // Redirect to dashboard
                header("Location: dashboard.php");
                exit();
            } else {
                $error = "كلمة المرور غير صحيحة";
            }
        } else {
            $error = "البريد الإلكتروني غير مسجل";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>تسجيل الدخول | برنامج المبرمج</title>
  <link href="https://fonts.googleapis.com/css2?family=Cairo&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
<style>
    body {
      font-family: 'Cairo', sans-serif;
      background-color: #f8f9fa;
    }
    .modal-content {
      background-color: #1c1c1c;
      color: white;
      border-radius: 15px;
      overflow: hidden;
    }
    .form-side {
      padding: 40px;
    }
    .form-side h2 {
      font-size: 28px;
      margin-bottom: 10px;
    }
    .form-side p {
      font-size: 14px;
      color: #ccc;
      margin-bottom: 25px;
    }
    .form-group input {
      text-align: right;
    }
    .login-btn {
      background-color: #2962ff;
      color: #fff;
      padding: 15px;
      width: 100%;
      border: none;
      border-radius: 8px;
      font-size: 16px;
      cursor: pointer;
      margin-bottom: 15px;
      transition: all 0.3s;
    }
    .login-btn:hover {
      background-color: #1a4fd8;
    }
    .google-btn {
      margin-top: 10px;
      background-color: transparent;
      border: 1px solid #2962ff;
      color: #fff;
      padding: 12px;
      width: 100%;
      border-radius: 8px;
      font-size: 14px;
      cursor: pointer;
      transition: all 0.3s;
    }
    .google-btn:hover {
      background-color: rgba(41, 98, 255, 0.1);
    }
    .image-side img {
      width: 100%;
    }
    .alert-danger {
      background-color: #dc3545;
      color: white;
      border: none;
      margin-bottom: 20px;
    }
  </style>

<!-- زر لفتح المودال -->
<div class="container mt-5 text-center">
  <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#loginModal">
    تسجيل الدخول
  </button>
</div>

<!-- المودال -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="row g-0">
        <!-- الصورة -->
        <div class="col-md-5 d-none d-md-flex align-items-center justify-content-center bg-white">
          <img src="assets/img/signup.png" alt="login illustration" class="img-fluid p-4">
        </div>
        <!-- النموذج -->
        <div class="col-md-7">
          <div class="form-side">
            <h2>تسجيل الدخول</h2>
            <p>سجّل الدخول للوصول إلى حسابك</p>
            
            <?php if (!empty($error)): ?>
              <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>

            <form method="POST" action="">
              <div class="mb-3">
                <input type="email" class="form-control" name="email" placeholder="البريد الإلكتروني" required>
              </div>
              <div class="mb-3">
                <input type="password" class="form-control" name="password" placeholder="كلمة المرور" required>
              </div>

              <button type="submit" class="login-btn">تسجيل الدخول</button>

              <div class="text-center">
                ليس لديك حساب؟ <a href="register.php" class="text-danger">إنشاء حساب</a>
              </div>

              <button type="button" class="google-btn mt-3">
                <i class="fab fa-google"></i> التسجيل بواسطة Google
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap JS & FontAwesome -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>

</body>
</html>