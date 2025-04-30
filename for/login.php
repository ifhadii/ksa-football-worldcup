<?php
// Error reporting configuration
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', 'php_errors.log');

// Start secure session
if (session_status() === PHP_SESSION_NONE) {
    session_start([
        'cookie_httponly' => true,
        'cookie_secure' => isset($_SERVER['HTTPS']),
        'cookie_samesite' => 'Strict'
    ]);
}

include "z_db.php";

// Security headers
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("X-Frame-Options: DENY");
header("X-Content-Type-Options: nosniff");

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // CSRF protection
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        $error = "Invalid request";
    } else {
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $password = $_POST['password'];
        
        // Input validation
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "البريد الإلكتروني غير صحيح";
        } elseif (empty($password) || strlen($password) < 8) {
            $error = "كلمة المرور يجب أن تحتوي على 8 أحرف على الأقل";
        } else {
            // Initialize login attempts if not set
            if (!isset($_SESSION['login_attempts'])) {
                $_SESSION['login_attempts'] = 0;
                $_SESSION['last_login_attempt'] = time();
            }

            // Check for too many attempts
            if ($_SESSION['login_attempts'] > 5 && (time() - $_SESSION['last_login_attempt'] < 300)) {
                $error = "Too many login attempts. Please try again later.";
            } else {
                // Define the query to select user
                $query = "SELECT user_id, email, password, full_name, role FROM users WHERE email = ? LIMIT 1";
                $stmt = mysqli_prepare($con, $query);
                
                if ($stmt === false) {
                    error_log("MySQL prepare error: " . mysqli_error($con));
                    $error = "حدث خطأ في النظام، الرجاء المحاولة لاحقاً";
                } else {
                    mysqli_stmt_bind_param($stmt, "s", $email);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    
                    if ($user = mysqli_fetch_assoc($result)) {
                        // Verify password
                        if (password_verify($password, $user['password'])) {
                            // Reset login attempts on success
                            $_SESSION['login_attempts'] = 0;
                            
                            // Regenerate session ID to prevent fixation
                            session_regenerate_id(true);
                            
                            // Set secure session variables
                            $_SESSION = [
                                'user_id' => $user['user_id'],
                                'email' => $user['email'],
                                'full_name' => htmlspecialchars($user['full_name']),
                                'role' => $user['role']
                            ];
                            
                            // Check for stored redirect URL
                            $redirect = isset($_SESSION['redirect_url']) ? $_SESSION['redirect_url'] : 
                                        ($user['role'] ? '../dashboard/' : 'profile.php');
                            
                            // Clear the redirect URL
                            unset($_SESSION['redirect_url']);
                            
                            header("Location: $redirect");
                            exit;
                        } else {
                            // Increment failed attempts
                            $_SESSION['login_attempts']++;
                            $_SESSION['last_login_attempt'] = time();
                            $error = "البريد الإلكتروني أو كلمة المرور غير صحيحة";
                        }
                    } else {
                        // Increment failed attempts
                        $_SESSION['login_attempts']++;
                        $_SESSION['last_login_attempt'] = time();
                        $error = "البريد الإلكتروني أو كلمة المرور غير صحيحة";
                    }
                    mysqli_stmt_close($stmt);
                }
            }
        }
    }
}

// Generate CSRF token
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="نظام إدارة بطولة KSA Welcome Cup">
    <title>تسجيل الدخول | KSA Welcome Cup</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --accent-color: #e74c3c;
            --light-color: #ecf0f1;
            --dark-color: #2c3e50;
            --success-color: #27ae60;
            --error-color: #e74c3c;
        }
        
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        
        body {
            font-family: 'Tajawal', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: var(--dark-color);
        }
        
        .login-wrapper {
            width: 100%;
            max-width: 420px;
            padding: 2rem;
        }
        
        .login-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease;
        }
        
        .login-card:hover {
            transform: translateY(-5px);
        }
        
        .login-header {
            background: var(--primary-color);
            color: white;
            padding: 1.5rem;
            text-align: center;
        }
        
        .login-header h2 {
            font-weight: 700;
            margin-bottom: 0.5rem;
        }
        
        .login-header img {
            height: 60px;
            margin-bottom: 1rem;
        }
        
        .login-body {
            padding: 2rem;
        }
        
        .alert {
            padding: 0.75rem 1rem;
            margin-bottom: 1.5rem;
            border-radius: 8px;
            font-size: 0.9rem;
        }
        
        .alert-error {
            background-color: rgba(231, 76, 60, 0.1);
            color: var(--error-color);
            border-left: 4px solid var(--error-color);
        }
        
        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--dark-color);
        }
        
        .form-control {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-family: 'Tajawal', sans-serif;
            font-size: 1rem;
            transition: border 0.3s ease;
        }
        
        .form-control:focus {
            border-color: var(--secondary-color);
            outline: none;
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
        }
        
        .btn {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 8px;
            font-family: 'Tajawal', sans-serif;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            text-align: center;
            width: 100%;
        }
        
        .btn-primary {
            background: var(--secondary-color);
            color: white;
        }
        
        .btn-primary:hover {
            background: #2980b9;
            transform: translateY(-2px);
        }
        
        .login-footer {
            text-align: center;
            margin-top: 1.5rem;
            font-size: 0.9rem;
            color: #7f8c8d;
        }
        
        .login-footer a {
            color: var(--secondary-color);
            text-decoration: none;
        }
        
        .login-footer a:hover {
            text-decoration: underline;
        }
        
        .password-toggle {
            position: absolute;
            top: 50%;
            left: 10px;
            transform: translateY(-50%);
            cursor: pointer;
            color: #7f8c8d;
        }
        
        @media (max-width: 576px) {
            .login-wrapper {
                padding: 1rem;
            }
            
            .login-card {
                border-radius: 12px;
            }
        }

        a {
            color: white;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="login-wrapper">
        <div class="login-card">
            <div class="login-header">
                <!-- <img src="assets/img/logo-white.png" alt="KSA Welcome Cup Logo"> -->
                <h2>تسجيل الدخول</h2>
            </div>
            
            <div class="login-body">
                <?php if (!empty($error)): ?>
                    <div class="alert alert-error">
                        <i class="fa fa-exclamation-circle"></i> <?php echo htmlspecialchars($error); ?>
                    </div>
                <?php endif; ?>
                
                <form action="login.php" method="POST" autocomplete="off">
                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                    
                    <div class="form-group">
                        <label for="email">البريد الإلكتروني</label>
                        <input type="email" id="email" name="email" class="form-control" required 
                               placeholder="example@domain.com" autofocus>
                    </div>
                    
                    <div class="form-group">
                        <label for="password">كلمة المرور</label>
                        <input type="password" id="password" name="password" class="form-control" required
                               placeholder="••••••••" minlength="8">
                        <span class="password-toggle" onclick="togglePassword()">
                            <i class="fa fa-eye"></i>
                        </span>
                    </div>
                    
                    <button type="" class="btn btn-primary">
                        <i class="fa fa-sign-in-alt"></i> 
                        <a href="http://localhost/Project/for/index.php" style="width: 100%;">
                            تسجيل الدخول
                        </a> 
                        </button>
                </form>
                
                <div class="login-footer">
                    <p>ليس لديك حساب؟ <a href="http://localhost/Project/for/index.php">إنشاء حساب جديد</a></p>
                    <p><a href="http://localhost/Project/for/index.php">نسيت كلمة المرور؟</a></p>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const password = document.getElementById('password');
            const icon = document.querySelector('.password-toggle i');
            
            if (password.type === 'password') {
                password.type = 'text';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                password.type = 'password';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        }
        
        // Form validation
        document.querySelector('form').addEventListener('submit', function(e) {
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            
            if (!email || !password) {
                e.preventDefault();
                alert('الرجاء إدخال جميع الحقول المطلوبة');
            }
        });
    </script>
</body>
</html>