<?php
include "header.php";
include "sidebar.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $position = mysqli_real_escape_string($con, $_POST['position']);
    $message = mysqli_real_escape_string($con, $_POST['message']);
    
    // Handle file upload
    $target_dir = "uploads/testimony/";
    $target_file = $target_dir . basename($_FILES["ufile"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $new_filename = uniqid() . '.' . $imageFileType;
    $target_path = $target_dir . $new_filename;
    
    $check = getimagesize($_FILES["ufile"]["tmp_name"]);
    if ($check !== false) {
        if (move_uploaded_file($_FILES["ufile"]["tmp_name"], $target_path)) {
            $query = "INSERT INTO review (name, position, message, ufile) 
                      VALUES ('$name', '$position', '$message', '$new_filename')";
            
            if (mysqli_query($con, $query)) {
                echo '<script>
                    Swal.fire({
                        title: "✅ تمت الإضافة بنجاح",
                        text: "تمت إضافة الشهادة بنجاح",
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
                        text: "حدث خطأ أثناء الإضافة: ' . addslashes(mysqli_error($con)) . '",
                        icon: "error"
                    });
                </script>';
            }
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
}
?>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">إضافة شهادة جديدة</h5>
                        </div>
                        <div class="card-body">
                            <form method="POST" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label class="form-label">اسم العميل</label>
                                    <input type="text" class="form-control" name="name" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">الوظيفة/المنصب</label>
                                    <input type="text" class="form-control" name="position" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">رسالة الشهادة</label>
                                    <textarea class="form-control" name="message" rows="5" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">صورة العميل</label>
                                    <input type="file" class="form-control" name="ufile" required>
                                </div>
                                <div class="d-flex justify-content-between mt-4">
                                    <button type="submit" class="btn btn-primary px-4">
                                        <i class="fas fa-save me-2"></i> حفظ
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