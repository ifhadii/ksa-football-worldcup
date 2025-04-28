<?php
include "header.php";
include "sidebar.php";

// Fetch all admins
$admin_query = "SELECT * FROM admin";
$admin_result = mysqli_query($con, $admin_query);

// Fetch all users
$user_query = "SELECT * FROM users";
$user_result = mysqli_query($con, $user_query);
?>

<link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">

<div class="main-content" dir="rtl">
    <div class="page-content">
        <div class="container-fluid">
            
            <!-- Admin Table -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">إدارة المدراء</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>اسم المدير</th>
                                        <th>البريد الإلكتروني</th>
                                        <th>الإجراء</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
if (mysqli_num_rows($admin_result) > 0) {
    while ($admin = mysqli_fetch_assoc($admin_result)) {
        echo "<tr id='row-admin-{$admin['id']}'>";
        echo "<td>{$admin['id']}</td>";
        echo "<td>{$admin['username']}</td>";
        echo "<td>{$admin['email']}</td>";
        echo "<td>
            <div class='dropdown d-inline-block'>
                <button class='btn btn-soft-secondary btn-sm dropdown-toggle' type='button' data-bs-toggle='dropdown' aria-expanded='false'>
                    <i class='ri-more-fill align-middle'></i>
                </button>
                <ul class='dropdown-menu dropdown-menu-start'>
                    <li>
                        <a href='edit_users.php?id={$admin['id']}&table=admin' class='dropdown-item'>
                            <i class='ri-pencil-fill align-bottom me-2 text-muted'></i> تعديل
                        </a>
                    </li>
                    <li>
                        <a href='javascript:void(0);' class='dropdown-item text-danger' onclick='deleteUser({$admin['id']}, \"admin\")'>
                            <i class='ri-delete-bin-fill align-bottom me-2'></i> حذف
                        </a>
                    </li>
                </ul>
            </div>
        </td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='4'>لا توجد بيانات للعرض</td></tr>";
}
?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Users Table -->
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
                                            if (mysqli_num_rows($user_result) > 0) {
                                                while ($user = mysqli_fetch_assoc($user_result)) {
                                                    echo "<tr id='row-users-{$user['user_id']}'>";
                                                    echo "<td>{$user['user_id']}</td>";
                                                    echo "<td>{$user['full_name']}</td>";
                                                    echo "<td>{$user['email']}</td>";
                                                    echo "<td>
                                                        <div class='dropdown d-inline-block'>
                                                            <button class='btn btn-soft-secondary btn-sm dropdown-toggle' type='button' data-bs-toggle='dropdown' aria-expanded='false'>
                                                                <i class='ri-more-fill align-middle'></i>
                                                            </button>
                                                            <ul class='dropdown-menu dropdown-menu-start'>
                                                                <li>
                                                                    <a href='edit_users.php?id={$user['user_id']}&table=users' class='dropdown-item'>
                                                                        <i class='ri-pencil-fill align-bottom me-2 text-muted'></i> تعديل
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a href='javascript:void(0);' class='dropdown-item text-danger' onclick='deleteUser({$user['user_id']}, \"users\")'>
                                                                        <i class='ri-delete-bin-fill align-bottom me-2'></i> حذف
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </td>";
                                                    echo "</tr>";
                                                }
                                            } else {
                                                echo "<tr><td colspan='4'>لا توجد بيانات للعرض</td></tr>";
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
function deleteUser(id, table) {
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
                url: 'delete_users.php', // Make sure this path is correct
                type: 'POST',
                data: {id: id, table: table},
                dataType: 'json',
                success: function(response) {
                    if(response.status === 'success') {
                        Swal.fire({
                            title: 'تم الحذف!',
                            text: response.message || 'تم الحذف بنجاح',
                            icon: 'success'
                        }).then(() => {
                            // Remove the row from the table
                            $('#row-'+table+'-'+id).remove();
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
                        text: 'حدث خطأ في الاتصال بالخادم: ' + error + 
                              '\nالرجاء التأكد من وجود ملف deletetest.php',
                        icon: 'error'
                    });
                }
            });
        }
    });
    return false; // Prevent default action
}
</script>

<?php include "footer.php"; ?>