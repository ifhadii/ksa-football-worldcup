<?php include "header.php"; ?>
<?php include "sidebar.php"; ?>

<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<style>
.summernote {
  direction: rtl !important;
  text-align: right !important;
}
.note-editable {
  direction: rtl !important;
  text-align: right !important;
}
</style>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- عنوان الصفحة -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">إضافة مدينة</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">المدن</a></li>
                                <li class="breadcrumb-item active">إضافة</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <!-- النموذج -->
            <div class="row">
                <div class="col-xxl-9">
                    <div class="card mt-xxl-n5">
                        <div class="card-header">
                            <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#personalDetails" role="tab" aria-selected="false">
                                        <i class="fas fa-home"></i> إضافة مدينة
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <?php
                        $status = "OK";
                        $msg = "";

                        if (isset($_POST['save'])) {
                            $city_title = mysqli_real_escape_string($con, $_POST['city_title']);
                            $city_desc = mysqli_real_escape_string($con, $_POST['city_desc']);
                            $city_detail = mysqli_real_escape_string($con, $_POST['city_detail']);

                            if (strlen($city_title) < 5) {
                                $msg .= "🛑 عنوان المدينة يجب أن يكون أكثر من 5 أحرف.<br>";
                                $status = "NOTOK";
                            }
                            if (strlen($city_desc) > 150) {
                                $msg .= "🛑 الوصف المختصر يجب أن لا يتجاوز 150 حرفًا.<br>";
                                $status = "NOTOK";
                            }
                            if (strlen($city_detail) < 15) {
                                $msg .= "🛑 التفاصيل يجب أن تكون أكثر من 15 حرفًا.<br>";
                                $status = "NOTOK";
                            }

                            $uploads_dir = 'uploads/services';
                            $tmp_name = $_FILES["ufile"]["tmp_name"];
                            $name = basename($_FILES["ufile"]["name"]);
                            $random_digit = rand(0000, 9999);
                            $new_file_name = $random_digit . $name;
                            move_uploaded_file($tmp_name, "$uploads_dir/$new_file_name");

                            if ($status == "OK") {
                                $qb = mysqli_query($con, "INSERT INTO city (city_title, city_desc, city_detail, ufile) VALUES ('$city_title', '$city_desc', '$city_detail', '$new_file_name')");
                                if ($qb) {
                                    $errormsg = "<div class='alert alert-success alert-dismissible fade show'>✅ تم إضافة المدينة بنجاح.<button type='button' class='btn-close' data-bs-dismiss='alert'></button></div>";
                                }
                            } elseif ($status !== "OK") {
                                $errormsg = "<div class='alert alert-danger alert-dismissible fade show'>$msg<button type='button' class='btn-close' data-bs-dismiss='alert'></button></div>";
                            } else {
                                $errormsg = "<div class='alert alert-danger alert-dismissible fade show'>حدث خطأ تقني. يرجى المحاولة لاحقًا.<button type='button' class='btn-close' data-bs-dismiss='alert'></button></div>";
                            }
                        }
                        ?>

                        <div class="card-body p-4">
                            <div class="tab-content">
                                <div class="tab-pane active" id="personalDetails" role="tabpanel">
                                    <?php if ($_SERVER['REQUEST_METHOD'] == 'POST') echo $errormsg; ?>

                                    <form action="" method="post" enctype="multipart/form-data">
                                        <div class="row">

                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label">عنوان المدينة</label>
                                                    <input type="text" class="form-control" name="city_title" placeholder="أدخل عنوان المدينة">
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label">وصف مختصر</label>
                                                    <textarea class="form-control" name="city_desc" rows="2" placeholder="نبذة عن المدينة"></textarea>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label">تفاصيل المدينة</label>
                                                    <textarea name="city_detail" class="form-control summernote" placeholder="أدخل التفاصيل..."></textarea>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label">صورة</label>
                                                    <input type="file" class="form-control" name="ufile">
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <div class="hstack gap-2 justify-content-end">
                                                    <button type="submit" name="save" class="btn btn-primary">حفظ المدينة</button>
                                                </div>
                                            </div>

                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!--end col-->
            </div>

        </div>
    </div>
</div>

<?php include "footer.php"; ?>
