<?php
include "header.php";
$todo = mysqli_real_escape_string($con, $_GET["id"]);
include "sidebar.php";
?>

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Edit Event</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">User</a></li>
                                <li class="breadcrumb-item active">Event</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <?php
            $query = "SELECT * FROM event WHERE id='$todo'";
            $result = mysqli_query($con, $query);
            $i = 0;
            while ($row = mysqli_fetch_array($result)) {
                $id = $row['id'];
                $port_title = $row['port_title'];
                $port_desc = $row['port_desc'];
                $port_detail = $row['port_detail'];
            }
            ?>

            <div class="row justify-content-center">
                <div class="col-xl-8 col-lg-10">
                    <div class="card">
                        <div class="card-header">
                            <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#personalDetails" role="tab">
                                        <i class="fas fa-home"></i> Edit Event
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <?php
                        $status = "OK";
                        $msg = "";
                        if (isset($_POST["save"])) {
                            $service_title = mysqli_real_escape_string($con, $_POST["service_title"]);
                            $service_desc = mysqli_real_escape_string($con, $_POST["service_desc"]);
                            $service_detail = mysqli_real_escape_string($con, $_POST["service_detail"]);
                            
                            if ($status == "OK") {
                                // FIXED: Using the form values instead of original values
                                $qb = mysqli_query($con, "UPDATE event SET 
                                    port_title='$service_title', 
                                    port_desc='$service_desc', 
                                    port_detail='$service_detail' 
                                    WHERE id='$todo'");
                                
                                if ($qb) {
                                    $errormsg = "<div class='alert alert-success alert-dismissible fade show'>✅ تم تحديث الفعالية<button type='button' class='btn-close' data-bs-dismiss='alert'></button></div>";
                                    // Refresh the data after update
                                    $query = "SELECT * FROM event WHERE id='$todo'";
                                    $result = mysqli_query($con, $query);
                                    $row = mysqli_fetch_array($result);
                                    $port_title = $row['port_title'];
                                    $port_desc = $row['port_desc'];
                                    $port_detail = $row['port_detail'];
                                } else {
                                    $errormsg = "<div class='alert alert-danger alert-dismissible fade show'>Error updating event: " . mysqli_error($con) . "<button type='button' class='btn-close' data-bs-dismiss='alert'></button></div>";
                                }
                            } elseif ($status !== "OK") {
                                $errormsg = "<div class='alert alert-danger alert-dismissible alert-outline fade show'>$msg<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
                            } else {
                                $errormsg = "<div class='alert alert-danger alert-dismissible alert-outline fade show'>Some technical glitch occurred. Please try again later.<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
                            }
                        }
                        ?>

                        <div class="card-body p-4">
                            <div class="tab-content">
                                <div class="tab-pane active" id="personalDetails" role="tabpanel">
                                    <?php if ($_SERVER["REQUEST_METHOD"] == "POST") { print $errormsg; } ?>
                                    
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="mb-3">
                                                    <label for="eventTitle" class="form-label">Event Title</label>
                                                    <input type="text" class="form-control" id="eventTitle" name="service_title" value="<?php echo htmlspecialchars($port_title); ?>" placeholder="Enter event title">
                                                </div>
                                            </div>
                                            
                                            <div class="col-lg-12">
                                                <div class="mb-3">
                                                    <label for="shortDescription" class="form-label">Short Description</label>
                                                    <textarea class="form-control" id="shortDescription" name="service_desc" rows="3"><?php echo htmlspecialchars($port_desc); ?></textarea>
                                                </div>
                                            </div>
                                            
                                            <div class="col-lg-12">
                                                <div class="mb-3">
                                                    <label for="eventDetail" class="form-label">Event Details</label>
                                                    <textarea class="form-control" id="eventDetail" name="service_detail" rows="5"><?php echo htmlspecialchars($port_detail); ?></textarea>
                                                </div>
                                            </div>
                                            
                                            <div class="col-lg-12">
                                                <div class="hstack gap-2 justify-content-end">
                                                    <button type="submit" name="save" class="btn btn-primary">Update Event</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
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