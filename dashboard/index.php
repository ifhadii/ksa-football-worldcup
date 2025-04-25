<?php
include "header.php";
$username = $_SESSION['username'];
?>


<?php 
include "sidebar.php";

?>
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content" dir="ltr" style="margin-left: 250px;">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Dashboard</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="h-100">
                        <div class="row mb-3 pb-1">
                            <div class="col-12">
                                <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                                    <div class="flex-grow-1">
                                        <h4 class="fs-16 mb-1">Hello, <?php echo htmlspecialchars($username); ?></h4>
                                        <p class="text-muted mb-0">Welcome to the Dashboard</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Stats Cards Row -->
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
                                                <p class="text-uppercase fw-semibold fs-12 text-muted mb-1">Total Cities</p>
                                                <h3>
                                                <?php
                                                $result = mysqli_query($con, "SELECT count(city_title) FROM city");
                                                $numrows = ($result) ? mysqli_fetch_row($result)[0] : 0;
                                                echo $numrows
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
                                                <p class="text-uppercase fw-semibold fs-12 text-muted mb-1">Total Events</p>
                                                <h3>
                                                <?php
                                                $result = mysqli_query($con, "SELECT count(id) FROM event");
                                                $numrows = ($result) ? mysqli_fetch_row($result)[0] : 0;
                                                echo $numrows
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

                                                <p class="text-uppercase fw-semibold fs-12 text-muted mb-1">Total Blogs</p>
                                                <h3>
                                                <?php
                                                $result = mysqli_query($con, "SELECT count(id) FROM event");
                                                $numrows = ($result) ? mysqli_fetch_row($result)[0] : 0;
                                                echo $numrows
                                                ?>
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Stats Cards Row -->

                    </div>
                </div>
            </div>

        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
</div>
<!-- end main content-->

<?php include "footer.php"; ?>
