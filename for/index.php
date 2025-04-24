<?php
ob_start(); // تشغيل التخزين المؤقت للخروج
session_start();
include "header.php";


$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'];

    if ($action == 'login') {
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $password = $_POST['password'];

        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['full_name'] = $user['full_name'];


            // نجاح: توجيه إلى الصفحة الرئيسية
            header("Location: home");
            exit();
        } else {
            $msg = "❌ البريد الإلكتروني أو كلمة المرور غير صحيحة.";
        }
    } elseif ($action == 'register') {
        $full_name = mysqli_real_escape_string($con, $_POST['full_name']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        if ($password !== $confirm_password) {
            $msg = "❌ كلمة المرور وتأكيدها غير متطابقتين.";
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $con->prepare("INSERT INTO users (full_name, email, password) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $full_name, $email, $hash);

            if ($stmt->execute()) {
                // ✅ تسجيل الدخول تلقائي بعد الإنشاء
                $new_user_id = $stmt->insert_id;
                $_SESSION['user_id'] = $new_user_id;
                $_SESSION['full_name'] = $full_name;

                header("Location: home"); // التوجيه للصفحة الرئيسية
                exit();
            } else {
                $msg = "❌ حدث خطأ أثناء إنشاء الحساب: " . $con->error;
            }
        }
    }
}
?>
<style>



</style>

<!-- Modal Dialog -->
<div class="modal fade" id="feedbackModal" tabindex="-1" aria-labelledby="feedbackModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="direction: rtl;">
            <div class="modal-header">
                <h5 class="modal-title" id="feedbackModalLabel">رسالة النظام</h5>
                <button type="button" class="btn-close ms-0" data-bs-dismiss="modal" aria-label="إغلاق"></button>
            </div>
            <div class="modal-body">
                <?php echo $msg; ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
            </div>
        </div>
    </div>
</div>

<?php if (!empty($msg)) : ?>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var feedbackModal = new bootstrap.Modal(document.getElementById('feedbackModal'));
            feedbackModal.show();
        });
    </script>
<?php endif; ?>



<!-- Bootstrap CSS -->


<style>
    .modal-content {
        background-color: #1c1c1c;
        color: white;
        border-radius: 15px;
        overflow: hidden;
    }

    .form-side {
        padding: 40px;
    }

    .form-side h2 {
        font-size: 28px;
        margin-bottom: 10px;
    }

    .form-side p {
        font-size: 14px;
        color: #ccc;
        margin-bottom: 25px;
    }

    .form-group input {
        text-align: right;
    }

    .login-btn {
        background-color: #2962ff;
        color: #fff;
        padding: 15px;
        width: 100%;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        cursor: pointer;
        margin-bottom: 15px;
    }

    .google-btn {
        margin-top: 10px;
        background-color: transparent;
        border: 1px solid #2962ff;
        color: #fff;
        padding: 12px;
        width: 100%;
        border-radius: 8px;
        font-size: 14px;
        cursor: pointer;
    }

    .image-side img {
        width: 100%;
    }
</style>
<!-- زر لفتح المودال -->




<!-- ***** Welcome Area Start ***** -->
<section id="home" class="section welcome-area  overflow-hidden d-flex align-items-center">
    <div class="container">
        <div class="row align-items-center">
            <!-- Welcome Intro Start -->
            <div class="col-12 col-md-12">
                <div class="welcome-intro text-center">
                    <h1 class="text-">كأس العالم لكرة القدم 2034</h1>
                    <br>
                    <p class="text-white font-weight-bold">
                        🇸🇦 السعودية ترحب بالعالم في أكبر حدث كروي في التاريخ.
                    </p>
                </div>
            </div>
          
        </div>
    </div>
    <!-- Shape Bottom -->
    <div class="shape shape-bottom">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" preserveAspectRatio="none" fill="#FFFFFF">
            <path class="shape-fill" d="M421.9,6.5c22.6-2.5,51.5,0.4,75.5,5.3c23.6,4.9,70.9,23.5,100.5,35.7c75.8,32.2,133.7,44.5,192.6,49.7
                c23.6,2.1,48.7,3.5,103.4-2.5c54.7-6,106.2-25.6,106.2-25.6V0H0v30.3c0,0,72,32.6,158.4,30.5c39.2-0.7,92.8-6.7,134-22.4
                c21.2-8.1,52.2-18.2,79.7-24.2C399.3,7.9,411.6,7.5,421.9,6.5z"></path>
        </svg>
    </div>
</section>



<!-- ***** Promo Area Start ***** -->
<section class="section promo-area ptb_100">
    <div class="container">
        <div class="row">
            <!-- عنصر 1 -->
            <div class="col-12 col-md-6 col-lg-4 res-margin">
                <div class="single-promo color-1 bg-hover hover-bottom text-center p-5">
                    <h3 class="mb-3">مدن مستضيفة عالمية</h3>
                    <p>تعرف على المدن السعودية التي ستحتضن مباريات كأس العالم، من الرياض إلى جدة والدمام والمدينة، كل مدينة ستبهر العالم بطابعها الخاص.</p>
                </div>
            </div>
            <!-- عنصر 2 -->
            <div class="col-12 col-md-6 col-lg-4 res-margin">
                <div class="single-promo color-1 bg-hover hover-bottom text-center p-5">
                    <h3 class="mb-3">تجربة ثقافية فريدة</h3>
                    <p>استعد لاكتشاف تاريخ المملكة وثقافتها من خلال الفعاليات المصاحبة والمهرجانات التي ترافق مباريات البطولة.</p>
                </div>
            </div>
            <!-- عنصر 3 -->
            <div class="col-12 col-md-6 col-lg-4 res-margin">
                <div class="single-promo color-1 bg-hover hover-bottom text-center p-5">
                    <h3 class="mb-3">أجواء رياضية استثنائية</h3>
                    <p>أحدث التقنيات، ملاعب متطورة، وتنظيم عالمي ينتظرك في بطولة كأس العالم 2034. كن جزءًا من الحدث!</p>
                </div>
            </div>
        </div>
    </div>
</section>









<!-- ***** Service Area End ***** -->
<section id="service" class="section service-area bg-grey ptb_150" dir="rtl">
    <!-- Shape Top -->
    <div class="shape shape-top">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" preserveAspectRatio="none" fill="#FFFFFF">
            <path class="shape-fill" d="..."></path>
        </svg>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-7">
                <!-- Section Heading -->
                <div class="section-heading text-center">
                    <h2>المدن المستضيفة</h2>
                    <p class="d-none d-sm-block mt-4">تعرف على أبرز المدن التي ستستضيف مباريات كأس العالم 2034 في المملكة العربية السعودية.</p>
                </div>
            </div>
        </div>

        <div class="row">

            <?php
            $qs = "SELECT * FROM city  ORDER BY id DESC LIMIT 6";
            $r1 = mysqli_query($con, $qs);

            while ($rod = mysqli_fetch_array($r1)) {
                $id = "$rod[id]";
                $serviceg = "$rod[city_title]";
                $service_desc = "$rod[city_desc]";

                echo "
                <div class='col-12 col-md-6 col-lg-4'>
                    <!-- Single Service -->
                    <div class='single-service p-4' style='border: solid 1px #788282; text-align: right;'>
                        <h3 class='my-3'>$serviceg</h3>
                        <p>$service_desc</p>
                        <a class='service-btn mt-3' href='citydetail.php?id=$id'>عرض التفاصيل</a>
                    </div>
                </div>
                ";
            }
            ?>

        </div>
    </div>

    <!-- Shape Bottom -->
    <div class="shape shape-bottom">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" preserveAspectRatio="none" fill="#FFFFFF">
            <path class="shape-fill" d="..."></path>
        </svg>
    </div>
</section>






<!-- ***** event Area Start ***** -->
<section id="event" class="event-area overflow-hidden ptb_100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-7">
                <!-- Section Heading -->
                <div class="section-heading text-center">
                    <h2>فعاليات كأس العالم 2034</h2>
                    <p class="d-none d-sm-block mt-4">استكشف أبرز المواقع، الفعاليات، والمشاريع التي ستُضيء المملكة خلال هذا الحدث التاريخي.</p>
                </div>
            </div>
        </div>
        <!-- event Items -->
        <div class="row items event-items">

            <?php
            $q = "SELECT * FROM  event ORDER BY id DESC LIMIT 6";


            $r123 = mysqli_query($con, $q);

            while ($ro = mysqli_fetch_array($r123)) {

                $id = "$ro[id]";
                $port_title = "$ro[port_title]";
                $port_desc = "$ro[port_desc]";
                $ufile = "$ro[ufile]";

                print "
    <div class='col-12 col-sm-6 col-lg-4 event-item' data-groups='['marketing','development']'>
    <!-- Single Case Studies -->
    <div class='single-case-studies'>
        <!-- Case Studies Thumb -->
        <a href='eventail.php?id=$id'>
            <img src='../dashboard/uploads/event/$ufile' alt=''>
        </a>
        <!-- Case Studies Overlay -->
        <a href='eventail.php?id=$id' class='case-studies-overlay'>
            <!-- Overlay Text -->
            <span class='overlay-text text-center p-3'>
                <h3 class='text-white mb-3'>$port_title</h3>
                <p class='text-white'>$port_desc.</p>
            </span>
        </a>
    </div>
    </div>
    ";
            }
            ?>

        </div>
        <div class="row justify-content-center">
            <a href="event" class="btn btn-bordered mt-4">View More</a>
        </div>
    </div>
</section>


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


<!-- ***** event Area End ***** -->

<!-- ***** Price Plan Area Start ***** -->

<!-- ***** Price Plan Area End ***** -->

<!-- ***** Review Area Start ***** -->
<section id="review" class="section review-area bg-overlay ptb_100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-7">
                <!-- Section Heading -->
                <div class="section-heading text-center">
                    <h2 class="text-white">آراء الزوار والمشجعين</h2>
                    <p class="text-white d-none d-sm-block mt-4">
                        آراء مشجعين من مختلف دول العالم شاركوا في تجربة كأس العالم في السعودية. كلماتهم تُلخص الشغف، التنظيم، والضيافة.
                    </p>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- Client Reviews -->
            <div class="client-reviews owl-carousel">
                <?php
                $q = "SELECT * FROM testimony ORDER BY id DESC LIMIT 6";
                $r123 = mysqli_query($con, $q);
                while ($ro = mysqli_fetch_array($r123)) {
                    $name = $ro['name'];
                    $position = $ro['position'];
                    $message = $ro['message'];
                    $ufile = $ro['ufile'];

                    echo "
                    <div class='single-review p-5'>
                        <div class='review-content'>
                            <div class='review-text'>
                                <p>$message</p>
                            </div>
                        </div>
                        <div class='reviewer media mt-3'>
                            <div class='reviewer-thumb'>
                                <img class='avatar-lg radius-100' src='../dashboard/uploads/testimony/$ufile' alt='img'>
                            </div>
                            <div class='reviewer-meta media-body align-self-center ml-4'>
                                <h5 class='reviewer-name color-primary mb-2'>$name</h5>
                                <h6 class='text-secondary fw-6'>$position</h6>
                            </div>
                        </div>
                    </div>";
                }
                ?>
            </div>
        </div>
    </div>
</section>
<!-- ***** Review Area End ***** -->







        
<!--====== Emergency Numbers Area Start ======-->
<section id="emergency" class="section ptb_100 bg-light">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-12 col-md-10 col-lg-8">
                <div class="section-heading">
                    <h2 class="text-danger">🚨 أرقام الطوارئ العامة</h2>
                    <p class="mt-3 text-muted">لضمان سلامتك خلال زيارتك للمملكة العربية السعودية خلال كأس العالم 2034، نضع بين يديك أهم أرقام الطوارئ التي قد تحتاجها.</p>
                </div>
            </div>
        </div>
        <div class="row text-center mt-4">
            <div class="col-12 col-md-6 col-lg-3 mb-4">
                <div class="p-4 border rounded h-100">
                    <h3 class="text-dark">911</h3>
                    <p class="mb-0 text-muted">الرقم الموحد للطوارئ (يعمل في معظم المناطق)</p>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3 mb-4">
                <div class="p-4 border rounded h-100">
                    <h3 class="text-dark">112</h3>
                    <p class="mb-0 text-muted">الطوارئ من الهواتف المحمولة (حتى بدون شريحة)</p>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3 mb-4">
                <div class="p-4 border rounded h-100">
                    <h3 class="text-dark">999</h3>
                    <p class="mb-0 text-muted">الشرطة</p>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3 mb-4">
                <div class="p-4 border rounded h-100">
                    <h3 class="text-dark">997</h3>
                    <p class="mb-0 text-muted">الإسعاف</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!--====== Emergency Numbers Area End ======-->





<?php include "footer.php"; ?>