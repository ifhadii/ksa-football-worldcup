<?php
include "header.php";
$username = $_SESSION["username"];
?>
<?php include "sidebar.php"; ?>

<div class="main-content" dir="rtl" style="">
    <div class="page-content">
        <div class="container-fluid">

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

            <div class="row">
                <div class="col-12">
                    <div class="h-100">
                        <div class="row mb-3 pb-1">
                            <div class="col-12">
                                <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                                    <div class="flex-grow-1">
                                        <h4 class="fs-16 mb-1">مرحباً  بالإداري  ,<?php echo htmlspecialchars(
                                            $username
                                        ); ?></h4>
                                        <p class="text-muted mb-0">أهلاً بك في لوحة التحكم</p>
                                    </div>
                                </div>
                            </div>
                        </div>

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
                                                    <i class="ri-server-line"></i>
                                                </span>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <p class="text-uppercase fw-semibold fs-12 text-muted mb-1">إجمالي المستخدمين</p>
                                                <h3>
                                                <?php
                                                $result = mysqli_query(
                                                    $con,
                                                    "SELECT count(user_id) FROM users"
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
                                                <p class="text-uppercase fw-semibold fs-12 text-muted mb-1">إجمالي الإداريين</p>
                                                <h3>
                                                <?php
                                                $result = mysqli_query(
                                                    $con,
                                                    "SELECT count(id) FROM admin"
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "footer.php"; ?>