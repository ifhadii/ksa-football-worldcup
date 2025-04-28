<?php
include "header.php";
$username = $_SESSION["username"];
?>
<?php include "sidebar.php"; ?>

<!-- <style>
    /* RTL Layout Fixes */
body {
    direction: rtl;
    text-align: right;
    font-family: 'Tajawal', 'Arial', sans-serif;
}

/* Main Content Area */
.main-content {
    margin-right: 250px;
    transition: margin-right 0.3s ease;
    min-height: 100vh;
    padding-top: 70px;
}

/* Header Fixes */
#page-topbar {
    right: 0;
    left: auto;
    padding-right: 250px;
    padding-left: 0;
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
}

.navbar-header {
    flex-direction: row-reverse;
}

/* Sidebar Positioning */
.app-menu {
    right: 0;
    left: auto;
    border-right: none;
    border-left: 1px solid #eff0f2;
}

/* Card Styling */
.card {
    border-radius: 0.5rem;
    box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,0.075);
    transition: transform 0.3s ease;
}

.card:hover {
    transform: translateY(-5px);
}

.avatar-title {
    display: flex;
    align-items: center;
    justify-content: center;
}

/* Breadcrumb Fixes */
.breadcrumb {
    padding-right: 0;
    padding-left: 1rem;
}

.breadcrumb-item + .breadcrumb-item::before {
    float: right;
    padding-left: 0.5rem;
    padding-right: 0;
}

/* Form Elements */
.form-control {
    text-align: right;
}

/* Dropdown Fixes */
.dropdown-menu {
    right: auto !important;
    left: 0 !important;
    text-align: right;
}

/* Footer Fixes */
.footer {
    text-align: center;
    padding: 1rem 0;
    margin-right: 250px;
    background-color: #f8f9fa;
    border-top: 1px solid #e9ecef;
}

/* Responsive Adjustments */
@media (max-width: 991.98px) {
    .main-content {
        margin-right: 0;
    }
    
    #page-topbar {
        padding-right: 0;
    }
    
    .app-menu {
        right: -250px;
    }
    
    .app-menu.show {
        right: 0;
    }
    
    .footer {
        margin-right: 0;
    }
}

/* Animation for sidebar toggle */
@keyframes slideIn {
    from { right: -250px; }
    to { right: 0; }
}

@keyframes slideOut {
    from { right: 0; }
    to { right: -250px; }
}

/* Utility Classes */
.text-start {
    text-align: right !important;
}

.text-end {
    text-align: left !important;
}

.ms-3 {
    margin-right: 1rem !important;
    margin-left: 0 !important;
}

/* Button Styling */
.btn {
    padding: 0.375rem 0.75rem;
    font-weight: 500;
}

.btn-primary {
    background-color: #405189;
    border-color: #405189;
}

/* Avatar Styling */
.avatar-sm {
    width: 3rem;
    height: 3rem;
}

/* Typography */
h4 {
    font-weight: 600;
    color: #495057;
}

.text-muted {
    color: #878a99 !important;
}
</style> -->
<!-- ============================================================== -->
<!-- ابدأ المحتوى من هنا -->
<!-- ============================================================== -->
<div class="main-content" dir="rtl" style="">
    <div class="page-content">
        <div class="container-fluid">

            <!-- عنوان الصفحة -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">لوحة التحكم</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">لوحة التحكم</a></li>
                                <li class="breadcrumb-item active">لوحة التحكم</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- نهاية عنوان الصفحة -->

            <div class="row">
                <div class="col-12">
                    <div class="h-100">
                        <div class="row mb-3 pb-1">
                            <div class="col-12">
                                <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                                    <div class="flex-grow-1">
                                        <h4 class="fs-16 mb-1">مرحباً، بالإداري ,<?php echo htmlspecialchars(
                                            $username
                                        ); ?></h4>
                                        <p class="text-muted mb-0">أهلاً بك في لوحة التحكم</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- صف بطاقات الإحصائيات -->
                        <div class="row">
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-sm flex-shrink-0">
                                                <span class="avatar-title bg-light text-primary rounded-circle fs-3">
                                                    <i class="ri-git-merge-fill"></i>
                                                </span>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <p class="text-uppercase fw-semibold fs-12 text-muted mb-1">إجمالي المدن</p>
                                                <h3>
                                                <?php
                                                $result = mysqli_query(
                                                    $con,
                                                    "SELECT count(city_title) FROM city"
                                                );
                                                $numrows = $result
                                                    ? mysqli_fetch_row(
                                                        $result
                                                    )[0]
                                                    : 0;
                                                echo $numrows;
                                                ?>
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-sm flex-shrink-0">
                                                <span class="avatar-title bg-light text-primary rounded-circle fs-3">
                                                    <i class="ri-server-line"></i>
                                                </span>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <p class="text-uppercase fw-semibold fs-12 text-muted mb-1">إجمالي الأحداث</p>
                                                <h3>
                                                <?php
                                                $result = mysqli_query(
                                                    $con,
                                                    "SELECT count(id) FROM event"
                                                );
                                                $numrows = $result
                                                    ? mysqli_fetch_row(
                                                        $result
                                                    )[0]
                                                    : 0;
                                                echo $numrows;
                                                ?>
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-sm flex-shrink-0">
                                                <span class="avatar-title bg-light text-primary rounded-circle fs-3">
                                                    <i class="ri-pages-line"></i>
                                                </span>
                                            </div>
                                            <div class="flex-grow-1 ms-3">

                                                <p class="text-uppercase fw-semibold fs-12 text-muted mb-1">إجمالي الاراء</p>
                                                <h3>
                                                <?php
                                                $result = mysqli_query(
                                                    $con,
                                                    "SELECT count(id) FROM testimony"
                                                );
                                                $numrows = $result
                                                    ? mysqli_fetch_row(
                                                        $result
                                                    )[0]
                                                    : 0;
                                                echo $numrows;
                                                ?>
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- نهاية صف بطاقات الإحصائيات -->

                    </div>
                </div>
            </div>

        </div>
        <!-- container-fluid -->
    </div>
    <!-- نهاية محتوى الصفحة -->
</div>
<!-- نهاية المحتوى الرئيسي -->

<?php include "footer.php"; ?>