<?php include "header.php"; ?>
<section class="section breadcrumb-area overlay-dark d-flex align-items-center" style="direction: rtl; text-align: right;">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <!-- محتوى العنوان -->
                <div class="breadcrumb-content text-center">
                    <h2 class="text-white text-uppercase mb-3">فعالياتنا السابقة</h2>
                    <ol class="breadcrumb d-flex justify-content-center">
                        <li class="breadcrumb-item"><a class="text-uppercase text-white" href="index.php">الرئيسية</a></li>
                        <li class="breadcrumb-item text-white active">الفعاليات</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ***** منطقة الفعاليات ***** -->
<section id="event" class="event-area overflow-hidden ptb_100" style="direction: rtl; text-align: right;">
    <div class="container">
        <div class="row items event-items">
            <?php
            $q = "SELECT * FROM event ORDER BY id DESC";
            $r123 = mysqli_query($con, $q);

            while ($ro = mysqli_fetch_array($r123)) {
                $id = $ro['id'];
                $port_title = $ro['port_title'];
                $port_desc = $ro['port_desc'];
                $ufile = $ro['ufile'];

                echo "
                <div class='col-12 col-sm-6 col-lg-4 event-item'>
                    <div class='single-case-studies'>
                        <a href='eventail.php?id=$id'>
                            <img src='../dashboard/uploads/event/$ufile' alt='$port_title'>
                        </a>
                        <a href='eventail.php?id=$id' class='case-studies-overlay'>
                            <span class='overlay-text text-center p-3'>
                                <h3 class='text-white mb-3'>$port_title</h3>
                                <p class='text-white'>$port_desc</p>
                            </span>
                        </a>
                    </div>
                </div>
                ";
            }
            ?>
        </div>
    </div>
</section>

<?php include "footer.php"; ?>
