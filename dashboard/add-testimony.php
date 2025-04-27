<?php include "header.php"; ?>
<?php include "sidebar.php"; ?>

<!-- ============================================================== -->
<!-- بدء المحتوى الأيمن هنا -->
<!-- ============================================================== -->
<div class="main-content">
 <div class="page-content">
       <div class="container-fluid">

                    <!-- بدء عنوان الصفحة -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0">إضافة شهادة</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">الشهادات</a></li>
                                        <li class="breadcrumb-item active">إضافة</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- نهاية عنوان الصفحة -->

                    <div class="row">

                        <!-- نهاية العمود -->
                        <div class="col-xxl-9">
                            <div class="card mt-xxl-n5">
                                <div class="card-header">
                                    <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-bs-toggle="tab" href="#personalDetails" role="tab" aria-selected="false">
                                                <i class="fas fa-home"></i> شهادة جديدة
                                            </a>
                                        </li>


                                    </ul>
                                </div>



                                <?php
                                $status = "OK";
                                // الحالة الأولية
                                $msg = "";
                                if (isset($_POST["save"])) {
                                    $namex = mysqli_real_escape_string(
                                        $con,
                                        $_POST["name"]
                                    );
                                    $message = mysqli_real_escape_string(
                                        $con,
                                        $_POST["message"]
                                    );
                                    $position = mysqli_real_escape_string(
                                        $con,
                                        $_POST["position"]
                                    );
                                    if (strlen($namex) < 1) {
                                        $msg =
                                            $msg .
                                            "يجب أن يحتوي الاسم على حرف واحد على الأقل.<BR>";
                                        $status = "NOTOK";
                                    }
                                    if (strlen($position) < 1) {
                                        $msg =
                                            $msg .
                                            "يجب أن يحتوي المنصب على حرف واحد على الأقل.<BR>";
                                        $status = "NOTOK";
                                    }
                                    if (strlen($message) < 10) {
                                        $msg =
                                            $msg .
                                            "يجب أن تكون رسالة الشهادة أكثر من 10 أحرف.<BR>";
                                        $status = "NOTOK";
                                    }
                                    $uploads_dir = "uploads/testimony";
                                    $tmp_name = $_FILES["ufile"]["tmp_name"]; // basename() قد يمنع هجمات التصفح عبر نظام الملفات; // قد يكون التحقق الإضافي من اسم الملف مناسبًا
                                    $name = basename($_FILES["ufile"]["name"]);
                                    $random_digit = rand(0000, 9999);
                                    $new_file_name = $random_digit . $name;
                                    move_uploaded_file(
                                        $tmp_name,
                                        "$uploads_dir/$new_file_name"
                                    );
                                    if ($status == "OK") {
                                        $qf = mysqli_query(
                                            $con,
                                            "INSERT INTO testimony (name, message, position,ufile) VALUES ('$namex', '$message', '$position', '$new_file_name')"
                                        );
                                        if ($qf) {
                                            $errormsg = "
<div class='alert alert-success alert-dismissible alert-outline fade show'>
                 تم إضافة الشهادة بنجاح.
                  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                  </div>
 "; // طباعة الخطأ إذا تم العثور عليه في التحقق
                                        } else {
                                            $errormsg = "
            <div class='alert alert-danger alert-dismissible alert-outline fade show'>
                       هناك مشكلة تقنية. يرجى المحاولة مرة أخرى لاحقًا أو طلب المساعدة من المسؤول.
                       <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                       </div>"; // طباعة الخطأ إذا تم العثور عليه في التحقق
                                        }
                                    } elseif ($status !== "OK") {
                                        $errormsg =
                                            "
<div class='alert alert-danger alert-dismissible alert-outline fade show'>
                     " .
                                            $msg .
                                            " <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button> </div>"; // طباعة الخطأ إذا تم العثور عليه في التحقق
                                    } else {
                                        $errormsg = "
      <div class='alert alert-danger alert-dismissible alert-outline fade show'>
                 هناك مشكلة تقنية. يرجى المحاولة مرة أخرى لاحقًا أو طلب المساعدة من المسؤول.
                 <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                 </div>"; // طباعة الخطأ إذا تم العثور عليه في التحقق
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
                                                            <label for="firstnameInput" class="form-label">اسم العميل</label>
                                                            <input type="text" class="form-control"  name="name" placeholder="أدخل اسم العميل">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="firstnameInput" class="form-label">المنصب</label>
                                                            <input type="text" class="form-control"  name="position" placeholder="أدخل منصب العميل">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="firstnameInput" class="form-label">الشهادة</label>
                                                            <textarea class="form-control"  name="message" rows="2"></textarea>
                                                        </div>
                                                    </div>



                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="firstnameInput" class="form-label">الصورة</label>
                                                            <input type="file" class="form-control" name="ufile" >
                                                        </div>
                                                    </div>
                                                    <!-- نهاية العمود -->
                                                    <div class="col-lg-12">
                                                        <div class="hstack gap-2 justify-content-end">
                                                            <button type="submit" name="save" class="btn btn-primary">إضافة شهادة</button>

                                                        </div>
                                                    </div>
                                                    <!-- نهاية العمود -->
                                                </div>
                                                <!-- نهاية الصف -->
                                            </form>
                                        </div>
                                        <!-- نهاية تبويب التفاصيل الشخصية -->

                                        <!-- نهاية تبويب -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- نهاية العمود -->
                    </div>


                </div>
                <!-- حاوية السائل -->
            </div>
            <!-- نهاية المحتوى -->
            <?php include "footer.php"; ?>
