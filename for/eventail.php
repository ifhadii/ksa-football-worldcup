<?php
include "header.php";
$todo = mysqli_real_escape_string($con, $_GET["id"]);
?>

<!-- ***** قسم العنوان ***** -->
<section class="section breadcrumb-area overlay-dark d-flex align-items-center" style="direction: rtl;">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <!-- محتوى العنوان -->
                <div class="breadcrumb-content d-flex flex-column align-items-center text-center">
                    <h2 class="text-white mb-3">تفاصيل الفعالية</h2>
                    <ol class="breadcrumb justify-content-center">
                        <li class="breadcrumb-item"><a class="text-white" href="index.php">الرئيسية</a></li>
                        <li class="breadcrumb-item text-white active">الفعالية</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ***** نهاية العنوان ***** -->

<?php
$rt = mysqli_query($con, "SELECT * FROM event WHERE id='$todo'");
$tr = mysqli_fetch_array($rt);
$port_title = $tr['port_title'];
$port_detail = $tr['port_detail'];
$ufile = $tr['ufile'];
?>

<!-- ***** قسم تفاصيل الفعالية ***** -->
<section class="section about-area ptb_100" style="direction: rtl;">
    <div class="container">
        <div class="row justify-content-between align-items-center">
            <div class="col-12 col-lg-6">
                <!-- صورة الفعالية -->
                <div class="about-thumb text-center mb-4 mb-lg-0">
                    <img src="../dashboard/uploads/event/<?php echo $ufile; ?>" alt="صورة الفعالية" class="img-fluid rounded shadow">
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <!-- محتوى الفعالية -->
                <div class="about-content section-heading text-right pl-md-4 mt-5 mt-lg-0 mb-0">
                    <h2 class="mb-3"><?php echo $port_title; ?></h2>
                    <p class="lead"><?php echo nl2br($port_detail); ?></p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ***** نهاية قسم الفعالية ***** -->

<?php include "footer.php"; ?>
