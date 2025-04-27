<?php include "header.php"; ?>
<?php include "sidebar.php"; ?>

<!-- ============================================================== -->
<!-- بداية المحتوى الأيمن -->
<!-- ============================================================== -->
<div class="main-content" dir="rtl">
    <div class="page-content">
        <div class="container-fluid">

            <!-- عنوان الصفحة -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">المدن</h4>

                        <div class="page-title-left">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">الكل</a></li>
                                <li class="breadcrumb-item active">المدن</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- نهاية عنوان الصفحة -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="card shadow-sm">
                        <div class="card-header bg-light">
                            <h5 class="card-title mb-0">قائمة المدن</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="table table-bordered table-hover table-striped align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th>اسم المدينة</th>
                                            <th>الإجراءات</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php
                                    $q = "SELECT * FROM city ORDER BY id DESC";
                                    $r123 = mysqli_query($con, $q);
                                    while ($ro = mysqli_fetch_array($r123)) {
                                        $id = $ro["id"];
                                        $city_title = $ro["city_title"];
                                        echo "<tr>
                                            <td>$city_title</td>
                                            <td>
                                                <div class='dropdown d-inline-block'>
                                                    <button class='btn btn-soft-secondary btn-sm dropdown-toggle' type='button' data-bs-toggle='dropdown' aria-expanded='false'>
                                                        <i class='ri-more-fill align-middle'></i>
                                                    </button>
                                                    <ul class='dropdown-menu dropdown-menu-start'>
                                                        <li>
                                                            <a href='editcity.php?id=$id' class='dropdown-item'>
                                                                <i class='ri-pencil-fill align-bottom me-2 text-muted'></i> تعديل
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href='deletecity.php?id=$id' class='dropdown-item text-danger'>
                                                                <i class='ri-delete-bin-fill align-bottom me-2'></i> حذف
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>";
                                    }
                                    ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div><!-- نهاية العمود -->
            </div><!-- نهاية الصف -->

        </div><!-- نهاية container-fluid -->
    </div><!-- نهاية Page-content -->

<?php include "footer.php"; ?>
