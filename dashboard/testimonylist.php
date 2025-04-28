<?php
include "header.php";
include "sidebar.php";

// Fetch all users
$user_query = "SELECT * FROM testimony";
$user_result = mysqli_query($con, $user_query);
?>

<link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">

<div class="main-content" dir="rtl">
    <div class="page-content">
        <div class="container-fluid">
            
            <!-- testimony Table -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">إدارة المستخدمين</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>اسم المستخدم</th>
                                        <th>البريد الإلكتروني</th>
                                        <th>الإجراء</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
$q = "SELECT * FROM testimony ORDER BY updated_at DESC";
$result = mysqli_query($con, $q);
while ($row = mysqli_fetch_array($result)) {
    echo "<tr id='row-testimony-{$row['id']}'>";
    echo "<td><img src='../for/uploads/testimonials/{$row['ufile']}' alt='صورة العميل' style='max-height:50px;'></td>";
    echo "<td>{$row['name']}</td>";
    echo "<td>{$row['position']}</td>";
    echo "<td>" . substr($row['message'], 0, 50) . "...</td>";
    echo "<td>" . date('Y-m-d H:i', strtotime($row['updated_at'])) . "</td>";
    echo "<td>
        <div class='dropdown d-inline-block'>
            <button class='btn btn-soft-secondary btn-sm dropdown-toggle' type='button' data-bs-toggle='dropdown' aria-expanded='false'>
                <i class='ri-more-fill align-middle'></i>
            </button>
            <ul class='dropdown-menu dropdown-menu-start'>
                <li>
                    <a href='edit_testimonylist.php?id={$row['id']}' class='dropdown-item'>
                        <i class='ri-pencil-fill align-bottom me-2 text-muted'></i> تعديل
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
                            confirmButtonText: 'حسناً'
                        }).then(() => {
                            $('#row-testimony-'+id).fadeOut(300, function() {
                                $(this).remove();
                                // Check if table is empty
                                if ($('tbody tr').length === 0) {
                                    $('.card-body').html(`
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