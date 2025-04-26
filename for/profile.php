<?php
session_start();
require_once 'User.php'; // Include your User class
require_once 'config.php'; // Database connection

// Check if user is logged in
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$user = new User($conn);
$currentUser = $_SESSION['user'];
$message = '';
$error = '';

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Update Full Name
        if (isset($_POST['update_name'])) {
            $newName = trim($_POST['full_name']);
            if (empty($newName)) {
                throw new Exception("الاسم الكامل مطلوب");
            }
            
            $sql = "UPDATE users SET full_name = ? WHERE user_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("si", $newName, $currentUser['user_id']);
            $stmt->execute();
            
            if ($stmt->affected_rows > 0) {
                $_SESSION['user']['full_name'] = $newName;
                $message = "تم تحديث الاسم بنجاح";
            }
        }
        
        // Update Email
        if (isset($_POST['update_email'])) {
            $newEmail = trim($_POST['email']);
            if (!filter_var($newEmail, FILTER_VALIDATE_EMAIL)) {
                throw new Exception("البريد الإلكتروني غير صالح");
            }
            
            // Check if email exists
            $check = $conn->prepare("SELECT user_id FROM users WHERE email = ? AND user_id != ?");
            $check->bind_param("si", $newEmail, $currentUser['user_id']);
            $check->execute();
            $check->store_result();
            
            if ($check->num_rows > 0) {
                throw new Exception("البريد الإلكتروني مسجل بالفعل");
            }
            
            $sql = "UPDATE users SET email = ? WHERE user_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("si", $newEmail, $currentUser['user_id']);
            $stmt->execute();
            
            if ($stmt->affected_rows > 0) {
                $_SESSION['user']['email'] = $newEmail;
                $message = "تم تحديث البريد الإلكتروني بنجاح";
            }
        }
        
        // Update Password
        if (isset($_POST['update_password'])) {
            $currentPass = $_POST['current_password'];
            $newPass = $_POST['new_password'];
            $confirmPass = $_POST['confirm_password'];
            
            if (!password_verify($currentPass, $currentUser['password'])) {
                throw new Exception("كلمة المرور الحالية غير صحيحة");
            }
            
            if ($newPass !== $confirmPass) {
                throw new Exception("كلمة المرور الجديدة غير متطابقة");
            }
            
            if (strlen($newPass) < 8) {
                throw new Exception("كلمة المرور يجب أن تكون 8 أحرف على الأقل");
            }
            
            $newHash = password_hash($newPass, PASSWORD_DEFAULT);
            $sql = "UPDATE users SET password = ? WHERE user_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("si", $newHash, $currentUser['user_id']);
            $stmt->execute();
            
            if ($stmt->affected_rows > 0) {
                $message = "تم تحديث كلمة المرور بنجاح";
            }
        }
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الملف الشخصي</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Tajawal', sans-serif;
            background-color: #f8f9fa;
        }
        .profile-card {
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        .form-section {
            border-bottom: 1px solid #eee;
            padding-bottom: 20px;
            margin-bottom: 20px;
        }
        .form-section:last-child {
            border-bottom: none;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card profile-card">
                    <div class="card-header bg-primary text-white">
                        <h3 class="mb-0">الملف الشخصي</h3>
                    </div>
                    <div class="card-body">
                        <?php if ($message): ?>
                            <div class="alert alert-success"><?= $message ?></div>
                        <?php endif; ?>
                        <?php if ($error): ?>
                            <div class="alert alert-danger"><?= $error ?></div>
                        <?php endif; ?>
                        
                        <!-- Update Name Section -->
                        <div class="form-section">
                            <h4>تعديل الاسم</h4>
                            <form method="POST">
                                <div class="mb-3">
                                    <label class="form-label">الاسم الكامل</label>
                                    <input type="text" class="form-control" name="full_name" 
                                           value="<?= htmlspecialchars($currentUser['full_name']) ?>" required>
                                </div>
                                <button type="submit" name="update_name" class="btn btn-primary">
                                    حفظ التغييرات
                                </button>
                            </form>
                        </div>
                        
                        <!-- Update Email Section -->
                        <div class="form-section">
                            <h4>تعديل البريد الإلكتروني</h4>
                            <form method="POST">
                                <div class="mb-3">
                                    <label class="form-label">البريد الإلكتروني</label>
                                    <input type="email" class="form-control" name="email" 
                                           value="<?= htmlspecialchars($currentUser['email']) ?>" required>
                                </div>
                                <button type="submit" name="update_email" class="btn btn-primary">
                                    حفظ التغييرات
                                </button>
                            </form>
                        </div>
                        
                        <!-- Update Password Section -->
                        <div class="form-section">
                            <h4>تغيير كلمة المرور</h4>
                            <form method="POST">
                                <div class="mb-3">
                                    <label class="form-label">كلمة المرور الحالية</label>
                                    <input type="password" class="form-control" name="current_password" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">كلمة المرور الجديدة</label>
                                    <input type="password" class="form-control" name="new_password" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">تأكيد كلمة المرور</label>
                                    <input type="password" class="form-control" name="confirm_password" required>
                                </div>
                                <button type="submit" name="update_password" class="btn btn-primary">
                                    تغيير كلمة المرور
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>