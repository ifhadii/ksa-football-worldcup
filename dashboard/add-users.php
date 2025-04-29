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
    $password = $_POST['password']; // Don't escape password
    $confirm_password = $_POST['confirm_password'];
    $user_type = mysqli_real_escape_string($con, $_POST['user_type']);
    
    // Validation
    if (strlen($full_name) < 2) {
        $msg .= "الاسم يجب أن يكون أكثر من حرفين.<br>";
        $status = "NOTOK";
    }
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $msg .= "بريد إلكتروني غير صالح.<br>";
        $status = "NOTOK";
    }
    
    if (strlen($password) < 6) {
        $msg .= "كلمة المرور يجب أن تكون 6 أحرف على الأقل.<br>";
        $status = "NOTOK";
    }
    
    if ($password !== $confirm_password) {
        $msg .= "كلمة المرور غير متطابقة.<br>";
        $status = "NOTOK";
    }
    
    // Check email existence
    $check_query = "SELECT email FROM ".($user_type == 'admin' ? 'admin' : 'users')." WHERE email = ?";
    $stmt = mysqli_prepare($con, $check_query);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    
    if (mysqli_stmt_num_rows($stmt) > 0) {
        $msg .= "البريد الإلكتروني مسجل مسبقاً.<br>";
        $status = "NOTOK";
    }
    mysqli_stmt_close($stmt);

    if ($status == "OK") {
        // Hash password
        // $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        
        // Insert user
        $table = ($user_type == 'admin' ? 'admin' : 'users');
        $name_field = ($user_type == 'admin' ? 'username' : 'full_name');
        
        $insert_query = "INSERT INTO $table ($name_field, email, password) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($con, $insert_query);
        mysqli_stmt_bind_param($stmt, "sss", $full_name, $email, $password);
        
        if (mysqli_stmt_execute($stmt)) {
            $errormsg = "<div class='alert alert-success alert-dismissible fade show'>
                تم إضافة المستخدم بنجاح ✅
                <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
            </div>";
        } else {
            $errormsg = "<div class='alert alert-danger alert-dismissible fade show'>
                خطأ في الإضافة: ".mysqli_error($con)."
                <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
            </div>";
        }
        mysqli_stmt_close($stmt);
    } else {
        $errormsg = "<div class='alert alert-danger alert-dismissible fade show'>
            $msg
            <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
        </div>";
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
                            <?= $errormsg ?? '' ?>
                            <form method="post">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">الاسم الكامل</label>
                                            <input type="text" class="form-control" name="full_name" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">البريد الإلكتروني</label>
                                            <input type="email" class="form-control" name="email" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">كلمة المرور</label>
                                            <input type="password" class="form-control" name="password" required>
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
                                                <option value="user">مستخدم عادي</option>
                                                <option value="admin">مسؤول</option>
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