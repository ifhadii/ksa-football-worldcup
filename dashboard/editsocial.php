<?php



// dashboard/editsocial.php

include "header.php";
include "sidebar.php";





// Check required URL parameters
if (!isset($_GET['id']) || !isset($_GET['table'])) {
    echo '<script>alert("المعرف أو الجدول غير موجود!"); window.location.href="manage_users.php";</script>';
    exit();
}

$id = (int)$_GET['id'];
$table = ($_GET['table'] === 'admin') ? 'admin' : 'users';

// Determine the correct ID column and query based on table
if ($table === 'admin') {
    $query = "SELECT * FROM admin WHERE id = ?";
    $id_column = 'id';
} else {
    $query = "SELECT * FROM users WHERE user_id = ?";
    $id_column = 'user_id';
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Process form data (if needed)
    // Then redirect:
    header("Location: social-links.php");
    exit();
}

// Fetch user data
$stmt = mysqli_prepare($con, $query);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) == 0) {
    echo '<script>alert("لم يتم العثور على المستخدم!"); window.location.href="manage_users.php";</script>';
    exit();
}

$user = mysqli_fetch_assoc($result);
?>

<div class="main-content" dir="rtl">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">تعديل بيانات المستخدم</h5>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="save-edituser.php">
                                <div class="mb-3">
                                    <label class="form-label">
                                        <?= ($table === 'admin') ? 'اسم المستخدم' : 'الاسم الكامل' ?>
                                    </label>
                                    <input type="text" class="form-control" 
                                    name="<?= ($table === 'admin') ? 'username' : 'full_name' ?>" 
                                    value="<?= htmlspecialchars(($table === 'admin') ? $user['username'] : $user['full_name']) ?>" 
                                    required>
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label">البريد الإلكتروني</label>
                                    <input type="email" class="form-control" name="email" 
                                    value="<?= htmlspecialchars($user['email']) ?>" required>
                                </div>
                                
                                <input type="hidden" name="table" value="<?= $table ?>">
                                <input type="hidden" name="id" value="<?= $id ?>">
                                <input type="hidden" name="id_column" value="<?= $id_column ?>">
                                
                                <button type="submit" class="btn btn-primary">حفظ التعديلات</button>
                                <a href="social-links.php" class="btn btn-secondary">إلغاء</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include "footer.php"; ?>