<?php
include "header.php";
include "sidebar.php";


session_start();
 
// Check if user is admin
if (!isset($_SESSION['user_id'])) {
   echo json_encode(['status' => 'error', 'message' => 'يجب تسجيل الدخول أولاً']);
   exit();
}

// Verify admin role
if ($_SESSION['role'] !== 'admin') {
    header("Location: access-denied.php");
    exit();
}

// Check if user has admin role
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
   echo json_encode(['status' => 'error', 'message' => 'ليست لديك صلاحية للقيام بهذا الإجراء']);
   exit();
}

// Fetch all testimonies
$testimony_query = "SELECT * FROM review";
$testimony_result = mysqli_query($con, $testimony_query);
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
                                <h4 class="card-title mb-0">إدارة الشهادات</h4>
                                <a href="add-testimony.php" class="btn btn-primary">
                                    <i class="ri-add-line align-bottom me-1"></i> إضافة شهادة جديدة
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <?php if(mysqli_num_rows($testimony_result) > 0): ?>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover table-bordered">
                                    <thead class="table-light">
                                        <tr>
                                            <th style="width: 80px;">الصورة</th>
                                            <th>الاسم</th>
                                            <th>الوظيفة</th>
                                            <th>الرسالة</th>
                                            <th>تاريخ التحديث</th>
                                            <th style="width: 80px;">الإجراءات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        while ($row = mysqli_fetch_array($testimony_result)) {
                                            echo "<tr id='row-testimony-{$row['id']}'>";
                                            echo "<td><img src='../for/uploads/testimonials/{$row['ufile']}' alt='صورة العميل' class='rounded-circle' style='width:50px; height:50px; object-fit:cover;'></td>";
                                            echo "<td class='fw-semibold'>{$row['name']}</td>";
                                            echo "<td>{$row['position']}</td>";
                                            echo "<td><span class='text-truncate d-inline-block' style='max-width: 200px;' title='{$row['message']}'>" . substr($row['message'], 0, 50) . "...</span></td>";
                                            echo "<td>" . date('Y-m-d H:i', strtotime($row['updated_at'])) . "</td>";
                                            echo "<td>
                                                <div class='dropdown'>
                                                    <button class='btn btn-soft-secondary btn-sm dropdown-toggle' type='button' data-bs-toggle='dropdown' aria-expanded='false'>
                                                        <i class='ri-more-2-fill'></i>
                                                    </button>
                                                    <ul class='dropdown-menu dropdown-menu-end'>
                                                        <li>
                                                            <a href='edit_testimonylist.php?id={$row['id']}' class='dropdown-item'>
                                                                <i class='ri-pencil-fill align-bottom me-2'></i> تعديل
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href='javascript:void(0);' class='dropdown-item text-danger' onclick='deleteTestimony({$row['id']})'>
                                                                <i class='ri-delete-bin-fill align-bottom me-2'></i> حذف
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>";
                                            echo "</tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <?php else: ?>
                            <div class="text-center py-5">
                                <i class="ri-chat-quote-line display-4 text-muted mb-4"></i>
                                <h4 class="text-muted">لا توجد شهادات مسجلة</h4>
                                <p class="text-muted mb-4">يمكنك البدء بإضافة شهادات جديدة</p>
                                <a href="add_testimony.php" class="btn btn-primary px-4">
                                    <i class="ri-add-line me-2"></i> إضافة شهادة جديدة
                                </a>
                            </div>
                            <?php endif; ?>
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
function deleteTestimony(id) {
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
                url: 'deletetest.php',
                type: 'POST',
                data: { 
                    id: id,
                    table: 'testimony'
                },
                dataType: 'json',
                success: function(response) {
                    if(response.status === 'success') {
                        Swal.fire({
                            title: 'تم الحذف!',
                            text: response.message,
                            icon: 'success',
                            confirmButtonText: 'حسناً',
                            customClass: {
                                confirmButton: 'btn btn-success'
                            }
                        }).then(() => {
                            $('#row-testimony-'+id).fadeOut(300, function() {
                                $(this).remove();
                                if ($('tbody tr').length === 0) {
                                    $('.card-body').html(`
                                        <div class="text-center py-5">
                                            <i class="ri-chat-quote-line display-4 text-muted mb-4"></i>
                                            <h4 class="text-muted">لا توجد شهادات مسجلة</h4>
                                            <p class="text-muted mb-4">يمكنك البدء بإضافة شهادات جديدة</p>
                                            <a href="add_testimony.php" class="btn btn-primary px-4">
                                                <i class="ri-add-line me-2"></i> إضافة شهادة جديدة
                                            </a>
                                        </div>
                                    `);
                                }
                            });
                        });
                    } else {
                        Swal.fire({
                            title: 'خطأ!',
                            text: response.message,
                            icon: 'error',
                            confirmButtonText: 'حسناً',
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
                        confirmButtonText: 'حسناً',
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