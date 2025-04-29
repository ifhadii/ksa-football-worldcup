<?php include "header.php"; ?>
<?php include "sidebar.php"; ?>
<!-- ============================================================== -->
<!-- بداية المحتوى الرئيسي هنا -->
<!-- ============================================================== -->
<div class="main-content" style="text-align: right;">
    <div class="page-content">
        <div class="container-fluid">

            <!-- بداية عنوان الصفحة -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">إضافة فعالية</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">الفعاليات</a></li>
                                <li class="breadcrumb-item active">إضافة</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- نهاية عنوان الصفحة -->

            <div class="row">
                <div class="col-xxl-9">
                    <div class="card mt-xxl-n5">
                        <div class="card-header">
                            <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#personalDetails" role="tab">
                                        <i class="fas fa-home"></i> إضافة فعالية
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <?php
                        $status = "OK";
                        $msg = "";
                        if (isset($_POST["save"])) {
                            $port_title = mysqli_real_escape_string(
                                $con,
                                $_POST["port_title"]
                            );
                            $port_desc = mysqli_real_escape_string(
                                $con,
                                $_POST["port_desc"]
                            );
                            $port_detail = mysqli_real_escape_string(
                                $con,
                                $_POST["port_detail"]
                            );
                            if (strlen($port_title) < 5) {
                                $msg .=
                                    "عنوان الفعالية يجب أن يكون أكثر من 5 أحرف.<br>";
                                $status = "NOTOK";
                            }
                            if (strlen($port_desc) > 150) {
                                $msg .=
                                    "الوصف المختصر يجب أن يكون أقل من 150 حرفًا.<br>";
                                $status = "NOTOK";
                            }
                            if (strlen($port_detail) < 15) {
                                $msg .=
                                    "تفاصيل الفعالية يجب أن تكون أكثر من 15 حرفًا.<br>";
                                $status = "NOTOK";
                            }
                            $uploads_dir = "uploads/event";
                            $tmp_name = $_FILES["ufile"]["tmp_name"];
                            $name = basename($_FILES["ufile"]["name"]);
                            $random_digit = rand(0000, 9999);
                            $new_file_name = $random_digit . $name;
                            move_uploaded_file(
                                $tmp_name,
                                "$uploads_dir/$new_file_name"
                            );
                            if ($status == "OK") {
                                $qb = mysqli_query(
                                    $con,
                                    "INSERT INTO event (port_title, port_desc, port_detail, ufile) VALUES ('$port_title', '$port_desc', '$port_detail', '$new_file_name')"
                                );
                                if ($qb) {
                                    $errormsg = "
                    <div class='alert alert-success alert-dismissible fade show'>✅ تم إضافة المدينة بنجاح.<button type='button' class='btn-close' data-bs-dismiss='alert'></button></div>"; // Handle card data if city was added successfully
                                }
                            } elseif ($status != "OK") {
                                $errormsg = "
                                    <div class='alert alert-danger alert-dismissible alert-outline fade show'>
                                        $msg
                                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                    </div>";
                            } else {
                                $errormsg = "
                                    <div class='alert alert-danger alert-dismissible alert-outline fade show'>
                                        حدث خلل تقني، حاول لاحقًا.
                                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                    </div>";
                            }
                        }
                        ?>

                        <div class="card-body p-4">
                            <div class="tab-content">
                                <div class="tab-pane active" id="personalDetails" role="tabpanel">
                                    <?php if (
                                        $_SERVER["REQUEST_METHOD"] == "POST"
                                    ) {
                                        print $errormsg;
                                    } ?>
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <div class="row">

                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label">عنوان الفعالية</label>
                                                    <input type="text" class="form-control" name="port_title" placeholder="أدخل عنوان الفعالية">
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label">الوصف المختصر</label>
                                                    <textarea class="form-control" name="port_desc" rows="2"></textarea>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label">تفاصيل الفعالية</label>
                                                    <textarea class="form-control" name="port_detail" rows="3"></textarea>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label">الصورة</label>
                                                    <input type="file" class="form-control" name="ufile">
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <div class="hstack gap-2 justify-content-end">
                                                    <button type="submit" name="save" class="btn btn-primary">إضافة</button>
                                                </div>
                                            </div>

                                        </div>
                                    </form>
                                </div> <!-- end tab-pane -->
                            </div>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>

        </div> <!-- container-fluid -->
    </div> <!-- End Page-content -->
</div>

<?php include "footer.php"; ?>
