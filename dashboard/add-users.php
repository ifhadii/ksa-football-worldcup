<?php include "header.php"; ?>
<?php include "sidebar.php"; ?>


<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- Page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">إضافة مستخدم</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">المستخدمين</a></li>
                                <li class="breadcrumb-item active">إضافة</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form section -->
            <div class="row">
                <div class="col-xxl-9">
                    <br>
                    <br>
                    <br>
                    <br>
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

                        <?php
                        $status = "OK";
                        $msg = "";

                        if (isset($_POST['save'])) {
                            $full_name = mysqli_real_escape_string($con, $_POST['full_name']);
                            $email = mysqli_real_escape_string($con, $_POST['email']);
                            $password = mysqli_real_escape_string($con, $_POST['password']);
                            $confirm_password = mysqli_real_escape_string($con, $_POST['confirm_password']);
                            $user_type = mysqli_real_escape_string($con, $_POST['user_type']);
                            
                            // Validation
                            if (strlen($full_name) < 2) {
                                $msg .= "يجب أن يتكون الاسم الكامل من حرفين على الأقل.<br>";
                                $status = "NOTOK";
                            }
                            
                            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                                $msg .= "البريد الإلكتروني غير صالح.<br>";
                                $status = "NOTOK";
                            }
                            
                            if (strlen($password) < 6) {
                                $msg .= "يجب أن تتكون كلمة المرور من 6 أحرف على الأقل.<br>";
                                $status = "NOTOK";
                            }
                            
                            if ($password !== $confirm_password) {
                                $msg .= "كلمة المرور وتأكيدها غير متطابقين.<br>";
                                $status = "NOTOK";
                            }
                            
                            // Check if email already exists
                            $check_email = mysqli_query($con, "SELECT * FROM users WHERE email = '$email'");
                            if (mysqli_num_rows($check_email) > 0) {
                                $msg .= "البريد الإلكتروني مسجل بالفعل.<br>";
                                $status = "NOTOK";
                            }
                            
                            if ($user_type == 'admin') {
                                $check_admin_email = mysqli_query($con, "SELECT * FROM admin WHERE email = '$email'");
                                if (mysqli_num_rows($check_admin_email) > 0) {
                                    $msg .= "البريد الإلكتروني مسجل بالفعل كمسؤول.<br>";
                                    $status = "NOTOK";
                                }
                            }

                            if ($status == "OK") {
                                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                                
                                if ($user_type == 'admin') {
                                    $query = mysqli_query($con, "INSERT INTO admin (username, email, password) VALUES ('$full_name', '$email', '$hashed_password')");
                                } else {
                                    $query = mysqli_query($con, "INSERT INTO users (full_name, email, password) VALUES ('$full_name', '$email', '$hashed_password')");
                                }
                                
                                if ($query) {
                                    $errormsg = "<div class='alert alert-success alert-dismissible alert-outline fade show'>
                                        تم إضافة المستخدم بنجاح.
                                        <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                                    </div>";
                                } else {
                                    $errormsg = "<div class='alert alert-danger alert-dismissible alert-outline fade show'>
                                        حدث خطأ أثناء إضافة المستخدم.
                                        <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                                    </div>";
                                }
                            } else {
                                $errormsg = "<div class='alert alert-danger alert-dismissible alert-outline fade show'>
                                    $msg
                                    <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                                </div>";
                            }
                        }
                        ?>

                        <div class="card-body p-4">
                            <div class="tab-content">
                                <div class="tab-pane active" id="addUserTab" role="tabpanel">
                                    <?php
                                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                                        echo $errormsg;
                                    }
                                    ?>
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="fullName" class="form-label">الاسم الكامل</label>
                                                    <input type="text" class="form-control" id="fullName" name="full_name" placeholder="أدخل الاسم الكامل" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="email" class="form-label">البريد الإلكتروني</label>
                                                    <input type="email" class="form-control" id="email" name="email" placeholder="example@domain.com" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="password" class="form-label">كلمة المرور</label>
                                                    <input type="password" class="form-control" id="password" name="password" placeholder="أدخل كلمة المرور" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="confirmPassword" class="form-label">تأكيد كلمة المرور</label>
                                                    <input type="password" class="form-control" id="confirmPassword" name="confirm_password" placeholder="أعد إدخال كلمة المرور" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="userType" class="form-label">نوع المستخدم</label>
                                                    <select class="form-select" id="userType" name="user_type" required>
                                                        <option value="user">مستخدم عادي</option>
                                                        <option value="admin">مسؤول</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="hstack gap-2 justify-content-end">
                                                    <button type="submit" name="save" class="btn btn-primary">إضافة مستخدم</button>
                                                </div>
                                            </div>
                                        </div> <!-- end row -->
                                    </form>
                                </div> <!-- end tab-pane -->
                            </div> <!-- end tab-content -->
                        </div> <!-- end card-body -->
                    </div> <!-- end card -->
                </div> <!-- end col -->
            </div> <!-- end row -->

        </div> <!-- container-fluid -->
    </div> <!-- page-content -->
</div> <!-- main-content -->

<?php include "footer.php"; ?>