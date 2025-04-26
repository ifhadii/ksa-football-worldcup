<?php
session_start();
require_once 'z_db.php'; // Make sure this file connects to your database

$error = ''; // Variable to store error message

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = mysqli_real_escape_string($con, $_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($email) || empty($password)) {
        $error = "البريد الإلكتروني وكلمة المرور مطلوبان";
    } else {
        // First check admin table
        $stmt = mysqli_prepare($con, "SELECT * FROM admin WHERE email = ?");
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $adminResult = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($adminResult) == 1) {
            $admin = mysqli_fetch_assoc($adminResult);
            if (password_verify($password, $admin['password'])) {
                $_SESSION['user_id'] = $admin['id'];
                $_SESSION['username'] = $admin['username'];
                $_SESSION['user_email'] = $admin['email'];
                $_SESSION['is_admin'] = true;
                $_SESSION['logged_in'] = true;
                header("Location: admin_dashboard.php");
                exit();
            } else {
                $error = "كلمة المرور غير صحيحة للمشرف.";
            }
        } else {
            // Check the users table if not found in admin
            $stmt = mysqli_prepare($con, "SELECT * FROM users WHERE email = ?");
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            $userResult = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($userResult) == 1) {
                $user = mysqli_fetch_assoc($userResult);
                if (password_verify($password, $user['password'])) {
                    $_SESSION['user_id'] = $user['user_id'];
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['user_email'] = $user['email'];
                    $_SESSION['is_admin'] = false;
                    $_SESSION['logged_in'] = true;
                    header("Location: dashboard.php");
                    exit();
                } else {
                    $error = "كلمة المرور غير صحيحة للمستخدم.";
                }
            } else {
                $error = "لا يوجد مستخدم بهذا البريد الإلكتروني.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8" />
    <title>تسجيل الدخول</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="col-md-6 offset-md-3">
            <div class="card p-4">
                <h3 class="text-center mb-3">تسجيل الدخول</h3>
                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger"><?= $error ?></div>
                <?php endif; ?>
                <form method="post">
                    <div class="mb-3">
                        <label for="email" class="form-label">البريد الإلكتروني</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">كلمة المرور</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">دخول</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
