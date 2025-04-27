<?php 
include "header.php";
include "sidebar.php";

// Check if ID parameter exists
if(!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: social.php");
    exit();
}

$id = intval($_GET['id']);

// Fetch social network data
$query = "SELECT * FROM social WHERE id = ?";
$stmt = mysqli_prepare($con, $query);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if(mysqli_num_rows($result) == 0) {
    header("Location: social.php");
    exit();
}

$social = mysqli_fetch_assoc($result);

// Handle form submission
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $link = mysqli_real_escape_string($con, $_POST['link']);
    
    $update_query = "UPDATE social SET name = ?, social_link = ? WHERE id = ?";
    $update_stmt = mysqli_prepare($con, $update_query);
    mysqli_stmt_bind_param($update_stmt, "ssi", $name, $link, $id);
    
    if(mysqli_stmt_execute($update_stmt)) {
        echo '<script>alert("تم تحديث البيانات بنجاح"); window.location.href="social.php";</script>';
        exit();
    } else {
        $error = "حدث خطأ أثناء التحديث";
    }
}
?>

<!-- ============================================================== -->
<!-- Main Content -->
<!-- ============================================================== -->
<div class="main-content" dir="rtl">
    <div class="page-content">
        <div class="container-fluid">

            <!-- Page Title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">تعديل شبكة تواصل</h4>

                        <div class="page-title-left">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="social.php">شبكات التواصل</a></li>
                                <li class="breadcrumb-item active">تعديل</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Page Title -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">تعديل بيانات الشبكة</h5>
                        </div>
                        <div class="card-body">
                            <?php if(isset($error)): ?>
                                <div class="alert alert-danger"><?php echo $error; ?></div>
                            <?php endif; ?>
                            
                            <form method="POST">
                                <div class="mb-3">
                                    <label for="name" class="form-label">اسم الشبكة</label>
                                    <input type="text" class="form-control" id="name" name="name" 
                                           value="<?php echo htmlspecialchars($social['name']); ?>" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="link" class="form-label">رابط الشبكة</label>
                                    <input type="url" class="form-control" id="link" name="link" 
                                           value="<?php echo htmlspecialchars($social['social_link']); ?>" required>
                                    <div class="form-text">يجب أن يبدأ الرابط بـ https://</div>
                                </div>
                                
                                <div class="mt-4">
                                    <button type="submit" class="btn btn-primary">حفظ التعديلات</button>
                                    <a href="social.php" class="btn btn-secondary ms-2">إلغاء</a>
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