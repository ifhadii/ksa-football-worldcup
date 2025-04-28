<?php
include "header.php";
include "sidebar.php";

// Fetch all social links with proper column names
$query = "SELECT * FROM social";
$result = mysqli_query($con, $query);

// Check for query errors
if ($result === false) {
    die("خطأ في قاعدة البيانات: " . mysqli_error($con));
}
?> 

<link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
<link href="assets/css/rtl.css" rel="stylesheet" type="text/css" />

<div class="main-content" dir="rtl">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <h4 class="card-title mb-0">إدارة الروابط الاجتماعية</h4>
                                <a href="add-social.php" class="btn btn-primary">
                                    <i class="ri-add-line align-bottom me-1"></i> إضافة جديد
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <?php if (mysqli_num_rows($result) > 0) { ?>
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover table-bordered">
                                        <thead class="table-light">
                                            <tr>
                                                <th width="5%">#</th>
                                                <th width="20%">المنصة</th>
                                                <th width="30%">الرابط</th>
                                                <th width="20%">الأيقونة</th>
                                                <th width="15%">الإجراءات</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                                <tr id="row-social-<?= $row['id'] ?>">
                                                    <td><?= $row['id'] ?></td>
                                                    <td class="fw-semibold"><?= htmlspecialchars($row['name']) ?></td>
                                                    <td>
                                                        <a href="<?= htmlspecialchars($row['social_link']) ?>" target="_blank" class="text-truncate d-inline-block" style="max-width: 250px;">
                                                            <?= htmlspecialchars($row['social_link']) ?>
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <i class="<?= htmlspecialchars($row['fa']) ?> align-middle me-2"></i>
                                                        <span><?= htmlspecialchars($row['fa']) ?></span>
                                                    </td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <button class="btn btn-soft-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                <i class="ri-more-2-fill"></i>
                                                            </button>
                                                            <ul class="dropdown-menu dropdown-menu-end">
                                                                <li>
                                                                    <a href="edit_social.php?id=<?= $row['id'] ?>" class="dropdown-item">
                                                                        <i class="ri-pencil-fill align-bottom me-2"></i> تعديل
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a href="javascript:void(0);" class="dropdown-item text-danger" onclick="confirmDelete(<?= $row['id'] ?>)">
                                                                        <i class="ri-delete-bin-fill align-bottom me-2"></i> حذف
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php } else { ?>
                                <div class="text-center py-5">
                                    <i class="ri-share-line display-4 text-muted mb-4"></i>
                                    <h4 class="text-muted">لا توجد روابط اجتماعية مسجلة</h4>
                                    <p class="text-muted mb-4">يمكنك البدء بإضافة روابط جديدة للتواصل الاجتماعي</p>
                                    <a href="add-social.php" class="btn btn-primary px-4">
                                        <i class="ri-add-line me-2"></i> إضافة رابط جديد
                                    </a>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
function confirmDelete(id) {
    Swal.fire({
        title: 'هل أنت متأكد؟',
        text: "لن تتمكن من استعادة هذه البيانات!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'نعم، احذف!',
        cancelButtonText: 'إلغاء',
        customClass: {
            confirmButton: 'btn btn-danger me-2',
            cancelButton: 'btn btn-secondary'
        },
        buttonsStyling: false,
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: 'delete_social.php',
                type: 'POST',
                data: {id: id},
                dataType: 'json',
                success: function(response) {
                    if(response.status === 'success') {
                        Swal.fire({
                            title: 'تم الحذف!',
                            text: response.message || 'تم حذف الرابط الاجتماعي بنجاح',
                            icon: 'success',
                            customClass: {
                                confirmButton: 'btn btn-success'
                            }
                        }).then(() => {
                            $('#row-social-'+id).fadeOut(300, function() {
                                $(this).remove();
                                if ($('tbody tr').length === 0) {
                                    $('.card-body').html(`
                                        <div class="text-center py-5">
                                            <i class="ri-share-line display-4 text-muted mb-4"></i>
                                            <h4 class="text-muted">لا توجد روابط اجتماعية مسجلة</h4>
                                            <p class="text-muted mb-4">يمكنك البدء بإضافة روابط جديدة للتواصل الاجتماعي</p>
                                            <a href="add-social.php" class="btn btn-primary px-4">
                                                <i class="ri-add-line me-2"></i> إضافة رابط جديد
                                            </a>
                                        </div>
                                    `);
                                }
                            });
                        });
                    } else {
                        Swal.fire({
                            title: 'خطأ!',
                            text: response.message || 'حدث خطأ أثناء الحذف',
                            icon: 'error',
                            customClass: {
                                confirmButton: 'btn btn-danger'
                            }
                        });
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        title: 'خطأ!',
                        text: 'حدث خطأ في الاتصال بالخادم: ' + error,
                        icon: 'error',
                        customClass: {
                            confirmButton: 'btn btn-danger'
                        }
                    });
                }
            });
        }
    });
}
</script>

<?php include "footer.php"; ?>