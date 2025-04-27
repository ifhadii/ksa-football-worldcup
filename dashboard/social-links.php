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

<!-- ============================================================== -->
<!-- Main Content -->
<!-- ============================================================== -->
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
                                            echo "<tr>";
                                            echo "<td>{$admin['id']}</td>";
                                            echo "<td>{$admin['username']}</td>";
                                            echo "<td>{$admin['email']}</td>";
                                            echo "<td>
                                                <div class='dropdown'>
                                                    <button class='btn btn-secondary dropdown-toggle btn-sm' type='button' id='dropdownMenuButton{$admin['id']}' data-bs-toggle='dropdown' aria-expanded='false'>
                                                        تعديل
                                                    </button>
                                                    <ul class='dropdown-menu' aria-labelledby='dropdownMenuButton{$admin['id']}'>
                                                        <li><a class='dropdown-item' href='editsocial.php?id={$admin['id']}&table=admin'>تعديل</a></li>
                                                        <li><a class='dropdown-item' href='delete_user.php?id={$admin['id']}&table=admin' onclick='return confirm(\"هل أنت متأكد من حذف هذا المدير؟\")'>حذف</a></li>
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
                                            echo "<tr>";
                                            echo "<td>{$user['user_id']}</td>";
                                            echo "<td>{$user['full_name']}</td>";
                                            echo "<td>{$user['email']}</td>";
                                            echo "<td>
                                                <div class='dropdown'>
                                                    <button class='btn btn-secondary dropdown-toggle btn-sm' type='button' id='dropdownMenuButton{$user['user_id']}' data-bs-toggle='dropdown' aria-expanded='false'>
                                                        تعديل
                                                    </button>
                                                    <ul class='dropdown-menu' aria-labelledby='dropdownMenuButton{$user['user_id']}'>
                                                        <li><a class='dropdown-item' href='editsocial.php?id={$user['user_id']}&table=users'>تعديل</a></li>
                                                        <li><a class='dropdown-item' href='delete_user.php?id={$user['user_id']}&table=users' onclick='return confirm(\"هل أنت متأكد من حذف هذا المستخدم؟\")'>حذف</a></li>
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

<?php include "footer.php"; ?>