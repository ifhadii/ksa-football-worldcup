<?php
include "header.php";
include "sidebar.php";

if (!isset($_GET['id'])) {
    header("Location: manage_social.php");
    exit();
}

$id = (int)$_GET['id'];
$social = [];

// Fetch data
$query = "SELECT * FROM social WHERE id = $id";
$result = mysqli_query($con, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $social = mysqli_fetch_assoc($result);
} else {
    header("Location: manage_social.php");
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $fa = mysqli_real_escape_string($con, $_POST['fa']);
    $social_link = mysqli_real_escape_string($con, $_POST['social_link']);

    $query = "UPDATE social SET 
              name = '$name',
              fa = '$fa',
              social_link = '$social_link'
              WHERE id = $id";
    
    if (mysqli_query($con, $query)) {
        echo '<script>
                Swal.fire({
                    title: "تم التعديل بنجاح",
                    text: "تم تحديث الرابط الاجتماعي بنجاح",
                    icon: "success",
                    confirmButtonColor: "#3085d6",
                    confirmButtonText: "حسناً",
                    timer: 3000,
                    timerProgressBar: true,
                    background: "#f8f9fa",
                    iconColor: "#28a745",
                    willClose: () => {
                        window.location.href = "manage_social.php";
                    }
                });
              </script>';
        exit();
    } else {
        echo '<script>
                Swal.fire({
                    title: "خطأ", 
                    text: "حدث خطأ أثناء التحديث: ' . addslashes(mysqli_error($con)) . '",
                    icon: "error",
                    confirmButtonText: "حسناً",
                    background: "#f8f9fa",
                    iconColor: "#dc3545"
                });
              </script>';
    }
}
?>

<div class="main-content" dir="rtl">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">تعديل رابط اجتماعي</h5>
                        </div>
                        <div class="card-body">
                            <form method="POST" id="editForm">
                                <div class="mb-3">
                                    <label class="form-label">اسم المنصة</label>
                                    <input type="text" class="form-control" name="name" 
                                           value="<?= htmlspecialchars($social['name']) ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">الرابط</label>
                                    <input type="url" class="form-control" name="social_link" 
                                           value="<?= htmlspecialchars($social['social_link']) ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">أيقونة Font Awesome</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i id="iconPreview" class="fas <?= htmlspecialchars($social['fa']) ?>"></i></span>
                                        <input type="text" class="form-control" name="fa" 
                                               value="<?= htmlspecialchars($social['fa']) ?>" required>
                                    </div>
                                    <small class="text-muted">مثال: fa-facebook, fa-twitter</small>
                                </div>
                                <div class="d-flex justify-content-between mt-4">
                                    <button type="submit" class="btn btn-primary px-4">
                                        <i class="fas fa-save me-2"></i> حفظ التغييرات
                                    </button>
                                    <a href="manage_social.php" class="btn btn-outline-secondary px-4">
                                        <i class="fas fa-times me-2"></i> إلغاء
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Live icon preview
document.querySelector('input[name="fa"]').addEventListener('input', function() {
    const iconValue = this.value.trim();
    const iconPreview = document.getElementById('iconPreview');
    
    if (iconValue.startsWith('fa-')) {
        iconPreview.className = 'fas ' + iconValue;
    } else {
        iconPreview.className = 'fas fa-question-circle';
    }
});

// Form validation
document.getElementById('editForm').addEventListener('submit', function(e) {
    const faInput = document.querySelector('input[name="fa"]');
    if (!faInput.value.startsWith('fa-')) {
        e.preventDefault();
        Swal.fire({
            title: 'خطأ في الأيقونة',
            text: 'يجب أن تبدأ أيقونة Font Awesome بـ fa-',
            icon: 'error',
            confirmButtonText: 'حسناً'
        });
        faInput.focus();
    }
});
</script>

<?php include "footer.php"; ?>
