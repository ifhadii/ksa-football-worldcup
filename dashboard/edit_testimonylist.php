<?php
include "header.php";
include "sidebar.php";

if (!isset($_GET['id'])) {
    header("Location: testimonylist.php");
    exit();
}

$id = (int)$_GET['id'];
$testimony = [];

$query = "SELECT * FROM testimony WHERE id = $id";
$result = mysqli_query($con, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $testimony = mysqli_fetch_assoc($result);
} else {
    header("Location: testimonylist.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $position = mysqli_real_escape_string($con, $_POST['position']);
    $message = mysqli_real_escape_string($con, $_POST['message']);
    
    if ($_FILES['ufile']['size'] > 0) {
        $target_dir = "uploads/testimony/";
        $target_file = $target_dir . basename($_FILES["ufile"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $new_filename = uniqid() . '.' . $imageFileType;
        $target_path = $target_dir . $new_filename;
        
        $check = getimagesize($_FILES["ufile"]["tmp_name"]);
        if ($check !== false) {
            if (move_uploaded_file($_FILES["ufile"]["tmp_name"], $target_path)) {
                if (file_exists($target_dir . $testimony['ufile'])) {
                    unlink($target_dir . $testimony['ufile']);
                }
                $ufile = $new_filename;
            } else {
                echo '<script>
                    Swal.fire({
                        title: "خطأ",
                        text: "حدث خطأ أثناء رفع الملف",
                        icon: "error"
                    });
                </script>';
            }
        } else {
            echo '<script>
                Swal.fire({
                    title: "خطأ",
                    text: "الملف المرفوع ليس صورة",
                    icon: "error"
                });
            </script>';
        }
    } else {
        $ufile = $testimony['ufile'];
    }
    
    $query = "UPDATE testimony SET 
              name = '$name',
              position = '$position',
              message = '$message',
              ufile = '$ufile'
              WHERE id = $id";
    
    if (mysqli_query($con, $query)) {
        echo '<script>
                Swal.fire({
                    title: "تم التحديث بنجاح",
                    text: "تم تحديث الشهادة بنجاح",
                    icon: "success",
                    confirmButtonColor: "#3085d6",
                    timer: 3000,
                    timerProgressBar: true,
                    willClose: () => {
                        window.location.href = "testimonylist.php";
                    }
                });
              </script>';
    } else {
        echo '<script>
                Swal.fire({
                    title: "خطأ", 
                    text: "حدث خطأ أثناء التحديث: ' . addslashes(mysqli_error($con)) . '",
                    icon: "error"
                });
              </script>';
    }
}
?>

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <br>
                    <br>
                    <br>
                    <br>
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">تعديل شهادة</h5>
                        </div>
                        <div class="card-body">
                            <form method="POST" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label class="form-label">اسم العميل</label>
                                    <input type="text" class="form-control" name="name" 
                                           value="<?= htmlspecialchars($testimony['name']) ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">الوظيفة/المنصب</label>
                                    <input type="text" class="form-control" name="position" 
                                           value="<?= htmlspecialchars($testimony['position']) ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">رسالة الشهادة</label>
                                    <textarea class="form-control" name="message" rows="5" required><?= htmlspecialchars($testimony['message']) ?></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">صورة العميل</label>
                                    <input type="file" class="form-control" name="ufile">
                                    <small class="text-muted">اتركه فارغاً إذا كنت لا تريد تغيير الصورة</small>
                                    <?php if ($testimony['ufile']): ?>
                                        <div class="mt-2">
                                            <img src="uploads/testimony/<?= htmlspecialchars($testimony['ufile']) ?>" 
                                                 alt="الصورة الحالية" style="max-height: 100px;">
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="d-flex justify-content-between mt-4">
                                    <button type="submit" class="btn btn-primary px-4">
                                        <i class="fas fa-save me-2"></i> حفظ التغييرات
                                    </button>
                                    <a href="testimonylist.php" class="btn btn-outline-secondary px-4">
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

<?php include "footer.php"; ?>