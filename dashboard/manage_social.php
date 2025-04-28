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

<div class="main-content" dir="rtl">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0">إدارة الروابط الاجتماعية</h5>
                                <a href="add-social.php" class="btn btn-primary">
                                    <i class="fas fa-plus me-1"></i> إضافة جديد
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <?php if (mysqli_num_rows($result) > 0) { ?>
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover">
                                        <thead class="table-light">
                                            <tr>
                                                <th width="5%">#</th>
                                                <th width="20%">المنصة</th>
                                                <th width="25%">الرابط</th>
                                                <th width="15%">الأيقونة</th>
                                                <th width="15%">الإجراءات</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                                <tr id="row-social-<?= $row['id'] ?>">
                                                    <td><?= $row['id'] ?></td>
                                                    <td><?= htmlspecialchars($row['name']) ?></td>
                                                    <td>
                                                        <a href="<?= htmlspecialchars($row['social_link']) ?>" target="_blank" class="text-truncate d-inline-block" style="max-width: 200px;">
                                                            <?= htmlspecialchars($row['social_link']) ?>
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <i class="fas <?= htmlspecialchars($row['fa']) ?> fa-lg"></i>
                                                        <span class="ms-2"><?= htmlspecialchars($row['fa']) ?></span>
                                                    </td>
                                                    <td>
                                                        <div class="dropdown d-inline-block">
                                                            <button class="btn btn-soft-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                <i class="ri-more-fill align-middle"></i>
                                                            </button>
                                                            <ul class="dropdown-menu dropdown-menu-start">
                                                                <li>
                                                                    <a href="edit_social.php?id=<?= $row['id'] ?>" class="dropdown-item">
                                                                        <i class="ri-pencil-fill align-bottom me-2 text-muted"></i> تعديل
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
                                    <div class="empty-state">
                                        <i class="fas fa-share-alt fa-4x text-muted mb-4"></i>
                                        <h4 class="text-muted">لا توجد روابط اجتماعية مسجلة</h4>
                                        <p class="text-muted mb-4">يمكنك البدء بإضافة روابط جديدة للتواصل الاجتماعي</p>
                                        <a href="add-social.php" class="btn btn-primary px-4">
                                            <i class="fas fa-plus me-2"></i> إضافة رابط جديد
                                        </a>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function confirmDelete(id) {
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
            deleteSocial(id);
        }
    });
}

function deleteSocial(id) {
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
                    icon: 'success'
                }).then(() => {
                    $('#row-social-'+id).remove();
                    
                    // Check if table is now empty
                    if ($('.table tbody tr').length === 0) {
                        $('.table').closest('.card-body').html(`
                            <div class="text-center py-5">
                                <div class="empty-state">
                                    <i class="fas fa-share-alt fa-4x text-muted mb-4"></i>
                                    <h4 class="text-muted">لا توجد روابط اجتماعية مسجلة</h4>
                                    <p class="text-muted mb-4">يمكنك البدء بإضافة روابط جديدة للتواصل الاجتماعي</p>
                                    <a href="add-social.php" class="btn btn-primary px-4">
                                        <i class="fas fa-plus me-2"></i> إضافة رابط جديد
                                    </a>
                                </div>
                            </div>
                        `);
                    }
                });
            } else {
                Swal.fire({
                    title: 'خطأ!',
                    text: response.message || 'حدث خطأ أثناء الحذف',
                    icon: 'error'
                });
            }
        },
        error: function(xhr, status, error) {
            Swal.fire({
                title: 'خطأ!',
                text: 'حدث خطأ في الاتصال بالخادم: ' + error,
                icon: 'error'
            });
            console.error('AJAX Error:', status, error);
        }
    });
}
</script>

<?php include "footer.php"; ?>