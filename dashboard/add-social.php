<?php include "header.php"; ?>
<?php include "sidebar.php"; ?>

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- عنوان الصفحة -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">إضافة شبكة اجتماعية</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">الاجتماعية</a></li>
                                <li class="breadcrumb-item active">إضافة</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <!-- قسم النموذج -->
            <div class="row">
                <div class="col-xxl-9">
                    <div class="card mt-xxl-n5">
                        <div class="card-header">
                            <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#addSocialTab" role="tab">
                                        <i class="fas fa-home"></i> إضافة شبكة اجتماعية
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

                            if (strlen($name) < 2) {
                                $msg .= "يجب أن يتكون اسم الشبكة الاجتماعية من حرفين على الأقل.<br>";
                                $status = "NOTOK";
                            }
                            if (strlen($fa) < 2) {
                                $msg .= "يجب أن يتكون كود FontAwesome من حرفين على الأقل.<br>";
                                $status = "NOTOK";
                            }
                            if (strlen($social_link) < 6) {
                                $msg .= "يجب أن يتكون رابط الشبكة الاجتماعية من 6 أحرف على الأقل.<br>";
                                $status = "NOTOK";
                            }

                            if ($status == "OK") {
                                $query = mysqli_query($con, "INSERT INTO social (name, fa, social_link) VALUES ('$name', '$fa', '$social_link')");
                                if ($query) {
                                    $errormsg = "<div class='alert alert-success alert-dismissible alert-outline fade show'>
                                        تم إضافة الرابط الاجتماعي بنجاح.
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
                                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                                        echo $errormsg;
                                    }
                                    ?>
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="socialName" class="form-label">الشبكة الاجتماعية</label>
                                                    <input type="text" class="form-control" id="socialName" name="name" placeholder="أدخل اسم الشبكة الاجتماعية">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="faCode" class="form-label">كود FontAwesome</label>
                                                    <input type="text" class="form-control" id="faCode" name="fa" placeholder="fa-envelope-o">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="socialLink" class="form-label">رابط الشبكة الاجتماعية</label>
                                                    <input type="text" class="form-control" id="socialLink" name="social_link" placeholder="https://facebook.com/yourpage/">
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="hstack gap-2 justify-content-end">
                                                    <button type="submit" name="save" class="btn btn-primary">إضافة شبكة اجتماعية</button>
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
