<?php include "header.php"; ?>
<?php include "sidebar.php"; ?>

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- Page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">إضافة رابط اجتماعي</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">الروابط الاجتماعية</a></li>
                                <li class="breadcrumb-item active">إضافة</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form section -->
            <div class="row">
                <div class="col-xxl-9">
                    <div class="card mt-xxl-n5">
                        <div class="card-header">
                            <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#addSocialTab" role="tab">
                                        <i class="fas fa-share-alt"></i> إضافة رابط اجتماعي
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <?php
                        $status = "OK";
                        $msg = "";

                        if (isset($_POST['save'])) {
                            $name = mysqli_real_escape_string($con, $_POST['name']);
                            $fa = mysqli_real_escape_string($con, $_POST['fa']);
                            $social_link = mysqli_real_escape_string($con, $_POST['social_link']);
                            
                            // Validation
                            if (strlen($name) < 2) {
                                $msg .= "يجب أن يتكون اسم المنصة من حرفين على الأقل.<br>";
                                $status = "NOTOK";
                            }
                            
                            if (!filter_var($social_link, FILTER_VALIDATE_URL)) {
                                $msg .= "الرابط غير صالح.<br>";
                                $status = "NOTOK";
                            }
                            
                            if (!preg_match('/^fa-[a-z0-9-]+$/i', $fa)) {
                                $msg .= "يجب أن تبدأ الأيقونة بـ fa- وتحتوي على حروف لاتينية وأرقام فقط.<br>";
                                $status = "NOTOK";
                            }
                            
                            // Check if social link already exists
                            $check_link = mysqli_query($con, "SELECT * FROM social WHERE social_link = '$social_link'");
                            if (mysqli_num_rows($check_link) > 0) {
                                $msg .= "الرابط مسجل بالفعل.<br>";
                                $status = "NOTOK";
                            }

                            if ($status == "OK") {
                                $query = mysqli_query($con, "INSERT INTO social (name, fa, social_link) VALUES ('$name', '$fa', '$social_link')");
                                
                                if ($query) {
                                    $errormsg =                                         "<div class='alert alert-success alert-dismissible fade show'>✅ تم إضافة المدينة بنجاح.<button type='button' class='btn-close' data-bs-dismiss='alert'></button></div>"; // Handle card data if city was added successfully
                                    ;
                                } else {
                                    $errormsg = "<div class='alert alert-danger alert-dismissible alert-outline fade show'>
                                        حدث خطأ أثناء إضافة الرابط: " . mysqli_error($con) . "
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
                                <div class="tab-pane active" id="addSocialTab" role="tabpanel">
                                    <?php
                                    if (isset($errormsg)) {
                                        echo $errormsg;
                                    }
                                    ?>
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="name" class="form-label">اسم المنصة</label>
                                                    <input type="text" class="form-control" id="name" name="name" 
                                                           placeholder="مثال: فيسبوك" required
                                                           value="<?= isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '' ?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="social_link" class="form-label">الرابط</label>
                                                    <input type="url" class="form-control" id="social_link" name="social_link" 
                                                           placeholder="https://example.com" required
                                                           value="<?= isset($_POST['social_link']) ? htmlspecialchars($_POST['social_link']) : '' ?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="mb-3">
                                                    <label for="fa" class="form-label">أيقونة Font Awesome</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text"><i id="iconPreview" class="fas fa-question-circle"></i></span>
                                                        <input type="text" class="form-control" id="fa" name="fa" 
                                                               placeholder="fa-facebook" required
                                                               value="<?= isset($_POST['fa']) ? htmlspecialchars($_POST['fa']) : '' ?>">
                                                    </div>
                                                    <small class="text-muted">يجب أن تبدأ بـ fa- مثل: fa-facebook, fa-instagram</small>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="hstack gap-2 justify-content-end">
                                                    <button type="submit" name="save" class="btn btn-primary">
                                                        <i class="fas fa-save me-1"></i> حفظ
                                                    </button>
                                                    <a href="manage_social.php" class="btn btn-secondary">
                                                        <i class="fas fa-times me-1"></i> إلغاء
                                                    </a>
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

<script>
// Live icon preview
document.getElementById('fa').addEventListener('input', function() {
    const iconValue = this.value.trim();
    const iconPreview = document.getElementById('iconPreview');
    
    if (iconValue.startsWith('fa-')) {
        iconPreview.className = 'fas ' + iconValue;
    } else {
        iconPreview.className = 'fas fa-question-circle text-muted';
    }
});

// Form validation
document.querySelector('form').addEventListener('submit', function(e) {
    const faInput = document.getElementById('fa');
    if (!faInput.value.startsWith('fa-')) {
        e.preventDefault();
        alert('يجب أن تبدأ الأيقونة بـ fa-');
        faInput.focus();
    }
    
    const urlInput = document.getElementById('social_link');
    if (!urlInput.value.startsWith('http://') && !urlInput.value.startsWith('https://')) {
        e.preventDefault();
        alert('يجب أن يبدأ الرابط بـ http:// أو https://');
        urlInput.focus();
    }
});
</script>

<?php include "footer.php"; ?>