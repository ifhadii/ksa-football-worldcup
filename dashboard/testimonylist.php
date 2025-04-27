<?php include "header.php"; ?>
<?php include "sidebar.php"; ?>

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- Start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">الشهادات</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">الكل</a></li>
                                <li class="breadcrumb-item active">الشهادات</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End page title -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0">قائمة الشهادات</h5>
                                <a href="add_testimony.php" class="btn btn-primary">
                                    <i class="fas fa-plus me-1"></i> إضافة شهادة جديدة
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>صورة العميل</th>
                                        <th>اسم العميل</th>
                                        <th>المنصب</th>
                                        <th>الشهادة</th>
                                        <th>آخر تحديث</th>
                                        <th>الإجراءات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $q = "SELECT * FROM testimony ORDER BY updated_at DESC";
                                    $result = mysqli_query($con, $q);
                                    while ($row = mysqli_fetch_array($result)) {
                                        echo "<tr id='row-testimony-{$row['id']}'>
                                            <td><img src='uploads/testimony/{$row['ufile']}' alt='صورة العميل' style='max-height:50px;'></td>
                                            <td>{$row['name']}</td>
                                            <td>{$row['position']}</td>
                                            <td>" . substr($row['message'], 0, 50) . "...</td>
                                            <td>" . date('Y-m-d H:i', strtotime($row['updated_at'])) . "</td>
                                            <td>
                                                <div class='dropdown'>
                                                    <button class='btn btn-secondary dropdown-toggle' type='button' id='dropdownMenuButton{$row['id']}' data-bs-toggle='dropdown' aria-expanded='false'>
                                                        <i class='fas fa-cog'></i>
                                                    </button>
                                                    <ul class='dropdown-menu' aria-labelledby='dropdownMenuButton{$row['id']}'>
                                                        <li>
                                                            <a class='dropdown-item' href='edit_testimonylist.php?id={$row['id']}'>
                                                                <i class='fas fa-edit me-2'></i> تعديل
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class='dropdown-item' href='javascript:void(0);' onclick='deleteTestimony({$row['id']})'>
                                                                <i class='fas fa-trash me-2'></i> حذف
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
            </div>
        </div>
    </div>
</div>

<script>
function deleteTestimony(id) {
    Swal.fire({
        title: 'هل أنت متأكد؟',
        text: "لن تتمكن من استعادة هذه البيانات!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'نعم، احذف!',
        cancelButtonText: 'إلغاء',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: 'deletetest.php',
                type: 'POST',
                data: {id: id},
                dataType: 'json',
                success: function(response) {
                    if(response.status === 'success') {
                        Swal.fire({
                            title: 'تم الحذف!',
                            text: response.message,
                            icon: 'success',
                            confirmButtonText: 'حسناً'
                        }).then(() => {
                            $('#row-testimony-'+id).remove();
                            if ($('#example tbody tr').length === 0) {
                                $('#example').closest('.card-body').html(`
                                    <div class="text-center py-5">
                                        <i class="fas fa-comment fa-4x text-muted mb-4"></i>
                                        <h4 class="text-muted">لا توجد شهادات مسجلة</h4>
                                        <p class="text-muted mb-4">يمكنك البدء بإضافة شهادات جديدة</p>
                                        <a href="add_testimony.php" class="btn btn-primary px-4">
                                            <i class="fas fa-plus me-2"></i> إضافة شهادة
                                        </a>
                                    </div>
                                `);
                            }
                        });
                    } else {
                        Swal.fire({
                            title: 'خطأ!',
                            text: response.message,
                            icon: 'error',
                            confirmButtonText: 'حسناً'
                        });
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        title: 'خطأ!',
                        text: 'حدث خطأ في الاتصال بالخادم: ' + error,
                        icon: 'error',
                        confirmButtonText: 'حسناً'
                    });
                }
            });
        }
    });
}
</script>

<?php include "footer.php"; ?>