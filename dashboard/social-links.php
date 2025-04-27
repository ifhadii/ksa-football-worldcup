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
                        <h4 class="mb-sm-0">شبكات التواصل الاجتماعي</h4>

                        <div class="page-title-left">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">الكل</a></li>
                                <li class="breadcrumb-item active">التواصل</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- نهاية عنوان الصفحة -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">قائمة شبكات التواصل</h5>
                        </div>
                        <div class="card-body">
                            <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                                <thead>
                                    <tr>
                                        <th data-ordering="false">اسم الشبكة</th>
                                        <th data-ordering="false">الرابط</th>
                                        <th>الإجراء</th>
                                    </tr>
                                </thead>
                                <tbody>

                                <?php
                                $q = "SELECT * FROM social ORDER BY id DESC";
                                $r123 = mysqli_query($con, $q);
                                while ($ro = mysqli_fetch_array($r123)) {
                                    $id = $ro["id"];
                                    $name = $ro["name"];
                                    $social_link = $ro["social_link"];
                                    echo "<tr>
                                        <td>$name</td>
                                        <td><a href='$social_link' target='_blank'>$social_link</a></td>
                                        <td>
                                            <div class='dropdown d-inline-block'>
                                                <button class='btn btn-soft-secondary btn-sm dropdown-toggle' type='button' data-bs-toggle='dropdown' aria-expanded='false'>
                                                    <i class='ri-more-fill align-middle'></i>
                                                </button>
                                                <ul class='dropdown-menu dropdown-menu-start'>
                                                    <li>
                                                        <a href='deletesocial.php?id=$id' class='dropdown-item text-danger'>
                                                            <i class='ri-delete-bin-fill align-bottom me-2 text-muted'></i> حذف
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
                </div><!-- نهاية العمود -->
            </div><!-- نهاية الصف -->

        </div><!-- نهاية الحاوية -->
    </div><!-- نهاية محتوى الصفحة -->

<?php include "footer.php"; ?>
