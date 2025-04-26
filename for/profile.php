<?php
// Start session only if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 1. First include the database connection file
require_once 'z_db.php';

// Verify the database connection exists
if (!isset($con) || !($con instanceof mysqli)) {
    die("فشل الاتصال بقاعدة البيانات. الرجاء المحاولة لاحقاً.");
}

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Get current user data
$userId = $_SESSION['user_id'];
$currentUser = [];

try {
    $stmt = $con->prepare("SELECT user_id, full_name, email, password FROM users WHERE user_id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $currentUser = $result->fetch_assoc();

    if (!$currentUser) {
        header("Location: login.php");
        exit();
    }

} catch (Exception $e) {
    die("حدث خطأ في جلب بيانات المستخدم: " . $e->getMessage());
}

// Handle form submission
$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Get form data
        $full_name = trim($_POST['full_name']);
        $email = trim($_POST['email']);
        $current_password = $_POST['current_password'] ?? '';
        $new_password = $_POST['new_password'] ?? '';
        $confirm_password = $_POST['confirm_password'] ?? '';
        
        // Validate required fields
        if (empty($full_name) || empty($email)) {
            throw new Exception("الاسم الكامل والبريد الإلكتروني مطلوبان");
        }
        
        // Validate email format
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("البريد الإلكتروني غير صالح");
        }
        
        // Check if email exists (excluding current user)
        $emailCheck = $con->prepare("SELECT user_id FROM users WHERE email = ? AND user_id != ?");
        $emailCheck->bind_param("si", $email, $userId);
        $emailCheck->execute();
        if ($emailCheck->get_result()->num_rows > 0) {
            throw new Exception("البريد الإلكتروني مسجل بالفعل");
        }
        
        // Password change logic
        if (!empty($new_password)) {
            // Verify current password
            if (!password_verify($current_password, $currentUser['password'])) {
                throw new Exception("كلمة المرور الحالية غير صحيحة");
            }
            
            // Validate new password
            if (strlen($new_password) < 8) {
                throw new Exception("كلمة المرور الجديدة يجب أن تكون 8 أحرف على الأقل");
            }
            
            if ($new_password !== $confirm_password) {
                throw new Exception("كلمة المرور الجديدة غير متطابقة");
            }
            
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            $updateSql = "UPDATE users SET full_name = ?, email = ?, password = ? WHERE user_id = ?";
            $stmt = $con->prepare($updateSql);
            $stmt->bind_param("sssi", $full_name, $email, $hashed_password, $userId);
        } else {
            $updateSql = "UPDATE users SET full_name = ?, email = ? WHERE user_id = ?";
            $stmt = $con->prepare($updateSql);
            $stmt->bind_param("ssi", $full_name, $email, $userId);
        }
        
        if (!$stmt->execute()) {
            throw new Exception("حدث خطأ أثناء التحديث: " . $con->error);
        }
        
        $success = "تم تحديث الملف الشخصي بنجاح";
        // Update current user data
        $currentUser['full_name'] = $full_name;
        $currentUser['email'] = $email;
        
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}

// Check if user is admin
$isAdmin = false;
try {
    $adminCheck = $con->prepare("SELECT id FROM admin WHERE email = ?");
    $adminCheck->bind_param("s", $currentUser['email']);
    $adminCheck->execute();
    $isAdmin = $adminCheck->get_result()->num_rows > 0;
} catch (Exception $e) {
    // Silently fail admin check - it's not critical
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الملف الشخصي</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Tajawal', sans-serif;
            background-color: #f8f9fa;
            padding-top: 80px;
        }
        .profile-container {
            max-width: 800px;
            margin: 30px auto;
            padding: 30px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        .profile-header {
            border-bottom: 1px solid #eee;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .form-section {
            margin-bottom: 30px;
        }
        .password-toggle {
            cursor: pointer;
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
        }
        .password-container {
            position: relative;
        }
        .admin-badge {
            background-color: #dc3545;
            color: white;
            padding: 3px 8px;
            border-radius: 4px;
            font-size: 12px;
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="profile-container">
            <div class="profile-header">
                <h2>
                    <i class="fas fa-user-circle me-2"></i>
                    الملف الشخصي
                    <?php if ($isAdmin): ?>
                        <span class="admin-badge">مدير</span>
                    <?php endif; ?>
                </h2>
                <?php if ($success): ?>
                    <div class="alert alert-success"><?= $success ?></div>
                <?php endif; ?>
                <?php if ($error): ?>
                    <div class="alert alert-danger"><?= $error ?></div>
                <?php endif; ?>
            </div>
            
            <form method="POST">
                <div class="form-section">
                    <h4><i class="fas fa-user me-2"></i>معلومات أساسية</h4>
                    <div class="mb-3">
                        <label class="form-label">الاسم الكامل</label>
                        <input type="text" class="form-control" name="full_name" 
                               value="<?= htmlspecialchars($currentUser['full_name']) ?>" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">البريد الإلكتروني</label>
                        <input type="email" class="form-control" name="email" 
                               value="<?= htmlspecialchars($currentUser['email']) ?>" required>
                    </div>
                </div>
                
                <div class="form-section">
                    <h4><i class="fas fa-lock me-2"></i>تغيير كلمة المرور</h4>
                    <div class="alert alert-info">
                        اترك الحقول فارغة إذا لم ترغب في تغيير كلمة المرور
                    </div>
                    
                    <div class="mb-3 password-container">
                        <label class="form-label">كلمة المرور الحالية</label>
                        <input type="password" class="form-control" name="current_password">
                        <i class="fas fa-eye password-toggle" onclick="togglePassword('current_password')"></i>
                    </div>
                    
                    <div class="mb-3 password-container">
                        <label class="form-label">كلمة المرور الجديدة</label>
                        <input type="password" class="form-control" name="new_password" id="new_password">
                        <i class="fas fa-eye password-toggle" onclick="togglePassword('new_password')"></i>
                    </div>
                    
                    <div class="mb-3 password-container">
                        <label class="form-label">تأكيد كلمة المرور الجديدة</label>
                        <input type="password" class="form-control" name="confirm_password" id="confirm_password">
                        <i class="fas fa-eye password-toggle" onclick="togglePassword('confirm_password')"></i>
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary w-100 py-2">
                    <i class="fas fa-save me-2"></i>حفظ التغييرات
                </button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function togglePassword(id) {
            const input = document.getElementById(id);
            const icon = input.nextElementSibling;
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        }
        
        // Validate password match on form submission
        document.querySelector('form').addEventListener('submit', function(e) {
            const newPass = document.querySelector('input[name="new_password"]');
            const confirmPass = document.querySelector('input[name="confirm_password"]');
            
            if (newPass.value && newPass.value !== confirmPass.value) {
                e.preventDefault();
                alert('كلمة المرور الجديدة غير متطابقة');
                confirmPass.focus();
            }
        });
    </script>
</body>
</html>