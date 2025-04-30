<?php 
include "header.php";
include "sidebar.php";
?>

<div class="main-content" dir="rtl">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">الفعاليات</h4>
                        <div class="page-title-left">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">الكل</a></li>
                                <li class="breadcrumb-item active">الفعاليات</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card shadow-sm">
                        <div class="card-header bg-light">
                            <h5 class="card-title mb-0">قائمة الفعاليات</h5>
                        </div>
                        <div class="card-body">
                            <?php if(isset($_SESSION['success'])): ?>
                                <div class="alert alert-success"><?= $_SESSION['success']; unset($_SESSION['success']); ?></div>
                            <?php endif; ?>
                            <?php if(isset($_SESSION['error'])): ?>
                                <div class="alert alert-danger"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
                            <?php endif; ?>
                            
                            <div class="table-responsive">
                                <table id="example" class="table table-bordered table-hover table-striped align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th>عنوان الفعالية</th>
                                            <th>الإجراءات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $q = "SELECT * FROM event ORDER BY id DESC";
                                        $r123 = mysqli_query($con, $q);
                                        while ($ro = mysqli_fetch_array($r123)) {
                                            $id = $ro["id"];
                                            $port_title = $ro["port_title"];
                                            echo "<tr>
                                                <td>$port_title</td>
                                                <td>
                                                    <div class='dropdown d-inline-block'>
                                                        <button class='btn btn-soft-secondary btn-sm dropdown-toggle' type='button' data-bs-toggle='dropdown' aria-expanded='false'>
                                                            <i class='ri-more-fill align-middle'></i>
                                                        </button>
                                                        <ul class='dropdown-menu dropdown-menu-start'>
                                                            <li>
                                                                <a href='editport.php?id=$id' class='dropdown-item'>
                                                                    <i class='ri-pencil-fill align-bottom me-2 text-muted'></i> تعديل
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href='javascript:void(0);' class='dropdown-item text-danger' onclick='confirmDelete($id)'>
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
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
function confirmDelete(eventId) {
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
                url: 'deleteport.php',
                type: 'POST',
                data: {id: eventId},
                dataType: 'json',
                success: function(response) {
                    if(response.status === 'success') {
                        Swal.fire({
                            title: 'تم الحذف!',
                            text: response.message || 'تم حذف الفعالية بنجاح',
                            icon: 'success'
                        }).then(() => {
                            location.reload();
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
                }
            });
        }
    });
}
</script>

<?php include "footer.php"; ?>