<?php
include "header.php";
$todo = mysqli_real_escape_string($con, $_GET["id"]);
?>
<!-- ***** Breadcrumb Area Start ***** -->
<section class="section breadcrumb-area overlay-dark d-flex align-items-center">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <!-- Breamcrumb Content -->
                <div class="breadcrumb-content d-flex flex-column align-items-center text-center">
                    <h2 class="text-white text-uppercase mb-3">تفاصييل المدينه </h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a class="text-uppercase text-white" href="index.php">الرئيسيه</a></li>

                        <li class="breadcrumb-item text-white active">المدينه</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ***** Breadcrumb Area End ***** -->


<?php
$rt = mysqli_query($con, "SELECT * FROM city where id='$todo'");
$tr = mysqli_fetch_array($rt);
$city_title = "$tr[city_title]";
$city_detail = "$tr[city_detail]";
$upadated_at = "$tr[upadated_at]";
$ufile = "$tr[ufile]";
?>


<!-- ***** About Area Start ***** -->
<section class="section about-area ptb_100">
    <div class="container">
        <div class="row justify-content-between align-items-center">
            <div class="col-12 col-lg-6">
                <!-- About Thumb -->
                <div class="about-thumb text-center">
                    <img src="../dashboard/uploads/services/<?php print $ufile; ?>" alt="img">
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <!-- About Content -->
                <div class="about-content section-heading text-center text-lg-left pl-md-4 mt-5 mt-lg-0 mb-0">
                    <h2 class="mb-3"><?php echo $city_title; ?></h2>

                    <!-- ✅ عرض التفاصيل مع دعم HTML والصور -->
                    <div class="summernote-content">
                        <?php echo $city_detail; ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
<!-- ***** About Area End ***** -->


<!--====== Call To Action Area End ======-->
<?php include "footer.php"; ?>