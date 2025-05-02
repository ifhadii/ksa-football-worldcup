<?php 
include "header.php";
include "sidebar.php";
include "z_db.php";

// Initialize variables
$status = "OK";
$msg = "";
$errormsg = "";

if (isset($_POST['save'])) {
    // Sanitize inputs
    $full_name = mysqli_real_escape_string($con, $_POST['full_name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $user_type = mysqli_real_escape_string($con, $_POST['user_type']);
    $role = ($user_type == 'admin' ? 'admin' : 'user');

    // Reset status
    $status = "OK";
    $msg = "";
    
    // Username validation
    $username = $full_name;
    
    // 1. Check for numbers only
    if (preg_match('/^[0-9]+$/', $username)) {
        $msg .= "لا يمكن استخدام أرقام فقط كاسم مستخدم.<br>";
        $status = "NOTOK";
    }
    
    // 2. Check allowed characters
    if (!preg_match('/^[\w.@+-]+$/', $username)) {
        $msg .= "يمكن أن يحتوي الاسم على أحرف وأرقام و @/./+/-/_ فقط.<br>";
        $status = "NOTOK";
    }
    
    // 3. Check length
    if (strlen($username) < 1 || strlen($username) > 150) {
        $msg .= "يجب أن يكون الاسم بين 1 و 150 حرفاً.<br>";
        $status = "NOTOK";
    }
    
    // Email validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $msg .= "بريد إلكتروني غير صالح.<br>";
        $status = "NOTOK";
    }
    
    // Password validation
    if (strlen($password) < 8) {
        $msg .= "كلمة المرور يجب أن تكون 8 أحرف على الأقل.<br>";
        $status = "NOTOK";
    }
    
    if ($password !== $confirm_password) {
        $msg .= "كلمة المرور غير متطابقة.<br>";
        $status = "NOTOK";
    }
    
    // Check username and email existence
    if ($status == "OK") {
        $check_query = "SELECT user_id FROM users WHERE LOWER(full_name) = LOWER(?) OR LOWER(email) = LOWER(?)";
        $stmt = mysqli_prepare($con, $check_query);
        mysqli_stmt_bind_param($stmt, "ss", $username, $email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        
        if (mysqli_stmt_num_rows($stmt) > 0) {
            $msg .= "اسم المستخدم أو البريد الإلكتروني مسجل مسبقاً<br>";
            $status = "NOTOK";
        }
        mysqli_stmt_close($stmt);
    }

    if ($status == "OK") {
        // Hash password
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        
        // Insert user
        $insert_query = "INSERT INTO users (full_name, email, password, role) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($con, $insert_query);
        mysqli_stmt_bind_param($stmt, "ssss", $username, $email, $hashed_password, $role);
        
        if (mysqli_stmt_execute($stmt)) {
            $errormsg = "<div class='alert alert-success alert-dismissible fade show'>✅ تم إضافة المستخدم بنجاح<button type='button' class='btn-close' data-bs-dismiss='alert'></button></div>";
        } else {
            $errormsg = "<div class='alert alert-danger alert-dismissible fade show'>خطأ في الإضافة: ".mysqli_error($con)."<button type='button' class='btn-close' data-bs-dismiss='alert'></button></div>";
        }
        mysqli_stmt_close($stmt);
    }
    
    // Show validation errors if any
    if ($status == "NOTOK") {
        $errormsg = "<div class='alert alert-danger alert-dismissible fade show'>$msg<button type='button' class='btn-close' data-bs-dismiss='alert'></button></div>";
    }
}
?>

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">إضافة مستخدم</h4>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xxl-9">
                    <div class="card mt-xxl-n5">
                        <div class="card-header">
                            <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#addUserTab" role="tab">
                                        <i class="fas fa-user-plus"></i> إضافة مستخدم
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <div class="card-body p-4">
                            <?php 
                            // Display error message if exists
                            if (!empty($errormsg)) {
                                echo $errormsg;
                            }
                            ?>
                            <form method="post">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">اسم المستخدم</label>
                                            <input type="text" class="form-control" name="full_name" value="<?= isset($_POST['full_name']) ? htmlspecialchars($_POST['full_name']) : '' ?>" required>
                                            <small class="form-text text-muted">يجب أن يحتوي على أحرف (لا يمكن استخدام أرقام فقط)</small>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">البريد الإلكتروني</label>
                                            <input type="email" class="form-control" name="email" value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">كلمة المرور</label>
                                            <input type="password" class="form-control" name="password" required>
                                            <small class="form-text text-muted">8 أحرف على الأقل</small>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">تأكيد كلمة المرور</label>
                                            <input type="password" class="form-control" name="confirm_password" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">نوع المستخدم</label>
                                            <select class="form-select" name="user_type" required>
                                                <option value="user" <?= (isset($_POST['user_type']) && $_POST['user_type'] == 'user') ? 'selected' : '' ?>>مستخدم عادي</option>
                                                <option value="admin" <?= (isset($_POST['user_type']) && $_POST['user_type'] == 'admin') ? 'selected' : '' ?>>مسؤول</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <button type="submit" name="save" class="btn btn-primary">إضافة مستخدم</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "footer.php"; ?>