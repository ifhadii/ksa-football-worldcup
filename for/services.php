<?php include "header.php"; ?>
<section class="section breadcrumb-area d-flex align-items-center" style="direction: rtl; text-align: right; background: rgb(16 36 18);">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <!-- محتوى العنوان -->
                <div class="breadcrumb-content text-center">
                    <h2 class="text-white text-uppercase mb-3">المدن المستضيفة</h2>
                    <ol class="breadcrumb d-flex justify-content-center">
                        <li class="breadcrumb-item"><a class="text-uppercase text-white" href="index.php">الرئيسية</a></li>
                        <li class="breadcrumb-item text-white active">المدن</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ***** منطقة المدن ***** -->
<section id="city" class="section city-area ptb_100" style="direction: rtl; text-align: right;">
    <!-- شكل علوي -->
    <div class="shape shape-top">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" preserveAspectRatio="none" fill="#FFFFFF">
            <path class="shape-fill" d="M421.9,6.5c22.6-2.5,51.5,0.4,75.5,5.3c23.6,4.9,70.9,23.5,100.5,35.7c75.8,32.2,133.7,44.5,192.6,49.7
            c23.6,2.1,48.7,3.5,103.4-2.5c54.7-6,106.2-25.6,106.2-25.6V0H0v30.3c0,0,72,32.6,158.4,30.5c39.2-0.7,92.8-6.7,134-22.4
            c21.2-8.1,52.2-18.2,79.7-24.2C399.3,7.9,411.6,7.5,421.9,6.5z"></path>
        </svg>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-7">
                <!-- العنوان -->
                <div class="section-heading text-center">
                    <h2>اكتشف المدن المستضيفة</h2>
                    <p class="d-none d-sm-block mt-4">تعرف على أبرز المدن التي ستحتضن مباريات كأس العالم</p>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <?php
            $qs = "SELECT * FROM city ORDER BY id DESC";
            $r1 = mysqli_query($con, $qs);
            $total_cities = mysqli_num_rows($r1);
            $counter = 0;
            
            while ($rod = mysqli_fetch_array($r1)) {
                $id = $rod['id'];
                $cityg = $rod['city_title'];
                $city_desc = $rod['city_desc'];
                
                echo "
                <div class='col-12 col-md-6 col-lg-4 mb-4'>
                    <div class='single-city p-4 h-100' style='border: solid 1px #788282; background-color: #fff; border-radius: 10px;'>
                        <h3 class='my-3'>$cityg</h3>
                        <p class='mb-3'>$city_desc</p>
                        <a class='city-btn mt-3 btn btn-primary' href='citydetail.php?id=$id'>عرض المزيد</a>
                    </div>
                </div>
                ";
                
                $counter++;
            }
            
            // إذا كان عدد المدن ليس من مضاعفات 3، نضيف عناصر فارغة لتحقيق التوازن
            if($total_cities % 3 != 0) {
                $remaining = 3 - ($total_cities % 3);
                for($i = 0; $i < $remaining; $i++) {
                    echo '<div class="col-12 col-md-6 col-lg-4 mb-4 d-lg-flex d-none"></div>';
                }
            }
            ?>
        </div>
    </div>

    <!-- شكل سفلي -->
    <div class="shape shape-bottom">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" preserveAspectRatio="none" fill="#FFFFFF">
            <path class="shape-fill" d="M421.9,6.5c22.6-2.5,51.5,0.4,75.5,5.3c23.6,4.9,70.9,23.5,100.5,35.7c75.8,32.2,133.7,44.5,192.6,49.7
            c23.6,2.1,48.7,3.5,103.4-2.5c54.7-6,106.2-25.6,106.2-25.6V0H0v30.3c0,0,72,32.6,158.4,30.5c39.2-0.7,92.8-6.7,134-22.4
            c21.2-8.1,52.2-18.2,79.7-24.2C399.3,7.9,411.6,7.5,421.9,6.5z"></path>
        </svg>
    </div>
</section>

<style>
    /* تنسيق إضافي لتحسين المظهر */
    .single-city {
        transition: all 0.3s ease;
    }
    .single-city:hover {
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        transform: translateY(-5px);
    }
</style>



<section class="section ptb_100 bg-light" id="stadiums">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8">
                <h2 class="mb-3">🏟️ الملاعب المستضيفة لكأس العالم 2034</h2>
                <p class="text-muted">
                    تعرّف على أبرز الملاعب الحديثة التي ستحتضن مباريات كأس العالم في مدن المملكة المختلفة، بتقنيات متطورة وتجهيزات عالمية.
                </p>
            </div>
        </div>

        <!-- XXXXXXXXXXXXXXXXXXXXXX first maintenance XXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->
        <div class="row mt-4">
    <!-- ملعب 1 -->
    <div class="row">
        <!-- الصور مع إضافة data-bs-toggle وdata-bs-target -->
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card h-100 shadow">
                <img src="assets/img/1.jpg" class="card-img-top" alt="1" data-bs-toggle="modal" data-bs-target="#imageModal" onclick="showImage('assets/img/1.jpg')">
            </div>
        </div>
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card h-100 shadow">
                <img src="assets/img/2.jpg" class="card-img-top" alt="2" data-bs-toggle="modal" data-bs-target="#imageModal" onclick="showImage('assets/img/2.jpg')">
            </div>
        </div>
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card h-100 shadow">
                <img src="assets/img/3.jpg" class="card-img-top" alt="3" data-bs-toggle="modal" data-bs-target="#imageModal" onclick="showImage('assets/img/3.jpg')">
            </div>
        </div>
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card h-100 shadow">
                <img src="assets/img/4.jpg" class="card-img-top" alt="4" data-bs-toggle="modal" data-bs-target="#imageModal" onclick="showImage('assets/img/4.jpg')">
            </div>
        </div>
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card h-100 shadow">
                <img src="assets/img/5.jpg" class="card-img-top" alt="5" data-bs-toggle="modal" data-bs-target="#imageModal" onclick="showImage('assets/img/5.jpg')">
            </div>
        </div>
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card h-100 shadow">
                <img src="assets/img/6.jpg" class="card-img-top" alt="6" data-bs-toggle="modal" data-bs-target="#imageModal" onclick="showImage('assets/img/6.jpg')">
            </div>
        </div>
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card h-100 shadow">
                <img src="assets/img/7.jpg" class="card-img-top" alt="7" data-bs-toggle="modal" data-bs-target="#imageModal" onclick="showImage('assets/img/7.jpg')">
            </div>
        </div>
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card h-100 shadow">
                <img src="assets/img/8.jpg" class="card-img-top" alt="8" data-bs-toggle="modal" data-bs-target="#imageModal" onclick="showImage('assets/img/8.jpg')">
            </div>
        </div>
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card h-100 shadow">
                <img src="assets/img/9.jpg" class="card-img-top" alt="9" data-bs-toggle="modal" data-bs-target="#imageModal" onclick="showImage('assets/img/9.jpg')">
            </div>
        </div>
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card h-100 shadow">
                <img src="assets/img/10.jpg" class="card-img-top" alt="10" data-bs-toggle="modal" data-bs-target="#imageModal" onclick="showImage('assets/img/10.jpg')">
            </div>
        </div>
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card h-100 shadow">
                <img src="assets/img/11.jpg" class="card-img-top" alt="11" data-bs-toggle="modal" data-bs-target="#imageModal" onclick="showImage('assets/img/11.jpg')">
            </div>
        </div>
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card h-100 shadow">
                <img src="assets/img/12.jpg" class="card-img-top" alt="12" data-bs-toggle="modal" data-bs-target="#imageModal" onclick="showImage('assets/img/12.jpg')">
            </div>
        </div>
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card h-100 shadow">
                <img src="assets/img/13.jpg" class="card-img-top" alt="13" data-bs-toggle="modal" data-bs-target="#imageModal" onclick="showImage('assets/img/13.jpg')">
            </div>
        </div>
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card h-100 shadow">
                <img src="assets/img/14.jpg" class="card-img-top" alt="14" data-bs-toggle="modal" data-bs-target="#imageModal" onclick="showImage('assets/img/14.jpg')">
            </div>
        </div>
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card h-100 shadow">
                <img src="assets/img/15.jpg" class="card-img-top" alt="15" data-bs-toggle="modal" data-bs-target="#imageModal" onclick="showImage('assets/img/15.jpg')">
            </div>
        </div>
    </div>
</div>

<!-- Modal لعرض الصورة -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img id="modalImage" src="" class="img-fluid" alt="Modal Image">
            </div>
        </div>
    </div>
</div>

<script>
function showImage(imageSrc) {
    document.getElementById('modalImage').src = imageSrc;
}
</script>

        </div>
    </div>
</section>


<?php include "footer.php"; ?>
