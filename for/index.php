<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Start session at the very beginning
session_start();

// Include database connection
include "z_db.php";

$msg = "";

// Process form submissions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'] ?? '';
    
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
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['role'];
            
            // Redirect to home page
            header("Location: index.php");
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
                $new_user_id = $stmt->insert_id;
                $_SESSION['user_id'] = $new_user_id;
                $_SESSION['full_name'] = $full_name;
                $_SESSION['email'] = $email;
                $_SESSION['role'] = 'user';
                
                header("Location: index.php");
                exit();
            } else {
                $msg = "❌ حدث خطأ أثناء إنشاء الحساب: " . $con->error;
            }
        }
    }
}

// Include header after all processing
include "header.php";
?>
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





<style>
    .single-review[dir='rtl'] .reviewer {
        display: flex;
        flex-direction: row-reverse; /* This makes the image come before the text */
        text-align: right; /* Ensures that text is aligned to the right */
    }
    
    .single-review[dir='rtl'] .reviewer-meta {
        text-align: right; /* Right-aligns the reviewer details */
    }
    
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
    
    .row {
        margin-right: -10px;
        margin-left: -10px;
    }
    .col-12, .col-md-6, .col-lg-4 {
        padding-right: 10px;
        padding-left: 10px;
    }


    .owl-carousel .owl-nav button.owl-prev,
    .owl-carousel .owl-nav button.owl-next {
        color: white !important;
        font-size: 24px !important;
        background: rgba(0,0,0,0.5) !important;
        width: 40px;
        height: 40px;
        border-radius: 50% !important;
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
    }
    .owl-carousel .owl-nav button.owl-prev {
        right: -50px;
    }
    .owl-carousel .owl-nav button.owl-next {
        left: -50px;
    }
    .owl-carousel .owl-nav button.owl-prev:hover,
    .owl-carousel .owl-nav button.owl-next:hover {
        background: rgba(0,0,0,0.8) !important;
    }
    </style>




<section id="home" class="section welcome-area  overflow-hidden d-flex align-items-center">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12 col-md-12">
                <div class="welcome-intro text-center">
                    <h1 class="text-white">كأس العالم لكرة القدم 2034</h1>
                    <br>
                    <p class="text-white font-weight-bold">
                        🇸🇦 السعودية ترحب بالعالم في أكبر حدث كروي في التاريخ.
                    </p>
                </div>
            </div>
            
        </div>
    </div>
    <div class="shape shape-bottom">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" preserveAspectRatio="none" fill="#FFFFFF">
            <path class="shape-fill" d="M421.9,6.5c22.6-2.5,51.5,0.4,75.5,5.3c23.6,4.9,70.9,23.5,100.5,35.7c75.8,32.2,133.7,44.5,192.6,49.7
            c23.6,2.1,48.7,3.5,103.4-2.5c54.7-6,106.2-25.6,106.2-25.6V0H0v30.3c0,0,72,32.6,158.4,30.5c39.2-0.7,92.8-6.7,134-22.4
            c21.2-8.1,52.2-18.2,79.7-24.2C399.3,7.9,411.6,7.5,421.9,6.5z"></path>
        </svg>
    </div>
</section>



<section class="section promo-area ptb_100">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-4 res-margin">
                <div class="single-promo color-1 bg-hover hover-bottom text-center p-5">
                    <h3 class="mb-3">مدن مستضيفة عالمية</h3>
                    <p>تعرف على المدن السعودية التي ستحتضن مباريات كأس العالم، من الرياض إلى جدة والدمام والمدينة، كل مدينة ستبهر العالم بطابعها الخاص.</p>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 res-margin">
                <div class="single-promo color-1 bg-hover hover-bottom text-center p-5">
                    <h3 class="mb-3">تجربة ثقافية فريدة</h3>
                    <p>استعد لاكتشاف تاريخ المملكة وثقافتها من خلال الفعاليات المصاحبة والمهرجانات التي ترافق مباريات البطولة.</p>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 res-margin">
                <div class="single-promo color-1 bg-hover hover-bottom text-center p-5">
                    <h3 class="mb-3">أجواء رياضية استثنائية</h3>
                    <p>أحدث التقنيات، ملاعب متطورة، وتنظيم عالمي ينتظرك في بطولة كأس العالم 2034. كن جزءًا من الحدث!</p>
                </div>
            </div>
        </div>
    </div>
</section>









<section id="service" class="section service-area bg-grey ptb_150" dir="rtl">
    <div class="shape shape-top">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" preserveAspectRatio="none" fill="#FFFFFF">
            <path class="shape-fill" d="..."></path>
        </svg>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-7">
                <div class="section-heading text-center">
                    <h2>المدن المستضيفة</h2>
                    <p class="d-none d-sm-block mt-4">تعرف على أبرز المدن التي ستستضيف مباريات كأس العالم 2034 في المملكة العربية السعودية.</p>
                </div>
            </div>
        </div>

        <div class="row">

            <?php
            $qs = "SELECT * FROM city  ORDER BY id ASC LIMIT 6";
            $r1 = mysqli_query($con, $qs);

            while ($rod = mysqli_fetch_array($r1)) {
                $id = "$rod[id]";
                $serviceg = "$rod[city_title]";
                $service_desc = "$rod[city_desc]";
                echo "
                <div class='col-12 col-md-6 col-lg-4 mb-4'>
                    <div class='single-service p-4 h-100' style='border: solid 1px #788282; text-align: right;'>
                        <h3 class='my-3'>$serviceg</h3>
                        <p>$service_desc</p>
                        <a class='service-btn mt-3 d-inline-block' href='citydetail.php?id=$id'>عرض التفاصيل</a>
                    </div>
                </div>
                ";
            }
            ?>

        </div>
    </div>

    <div class="shape shape-bottom">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" preserveAspectRatio="none" fill="#FFFFFF">
            <path class="shape-fill" d="..."></path>
        </svg>
    </div>
</section>



<section id="testimonials" class="section review-area ptb_100" style="background-color: rgb(16, 36, 18);">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-7">
                <div class="section-heading text-center">
                    <h2 class="mb-3" style="color:rgb(9, 128, 68);">آراء الزوار والمشجعين</h2>
                    <p class="d-none d-sm-block mt-4 text-white">
                        آراء مشجعين من مختلف دول العالم شاركوا في تجربة كأس العالم في السعودية. كلماتهم تُلخص الشغف، التنظيم، والضيافة.
                    </p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="owl-carousel testimonial-carousel">
                    <?php
                    $q = "SELECT * FROM event ORDER BY id ASC LIMIT 6";
                    $r123 = mysqli_query($con, $q);
                    while ($ro = mysqli_fetch_array($r123)) {
                        $id = $ro['id'];
                        $name = $ro['port_title'];
                        $position = $ro['port_desc'];
                        $message = $ro['port_desc'];
                        $ufile = $ro['ufile'];
                                            
                        echo '
                        <div class="item" >
                            <div class="card h-100 shadow" style="border: none; border-radius: 10px; overflow: hidden; background-color: rgb(18, 54, 25);">
                                <div class="card-img-top" style="height: 200px; overflow: hidden;">
                                    <img src="../dashboard/uploads/event/'.$ufile.'" alt="'.$name.'" style="width: 100%; height: 100%; object-fit: cover;">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title text-white">'.$name.'</h5>
                                    <h6 class="text-light" style="color: #aaa !important; font-size: 14px;">'.$position.'</h6>
                                </div>
                                <div class="card-footer bg-transparent border-0">
                                    <a  href="eventail.php?id='.$id.'" class="btn btn-sm w-100" style="background-color: rgb(9, 128, 68); color: white; border: none;">قراءة المزيد</a>
                                </div>
                            </div>
                        </div>';
                    }
                    ?>
                </div>
            </div>
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

        <div class="row mt-4">
    <div class="row">
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







<section id="review" class="section review-area bg-overlay ptb_100" style="background-color: #1a1a2e;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-7">
                <div class="section-heading text-center">
                    <h2 class="text-white fw-bold">آراء الزوار والمشجعين</h2>
                    <p class="text-white d-none d-sm-block mt-4 fw-bold">
                        آراء مشجعين من مختلف دول العالم شاركوا في تجربة كأس العالم في السعودية. كلماتهم تُلخص الشغف، التنظيم، والضيافة.
                    </p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="owl-carousel testimonial-carousel">
                    <?php
                    $q = "SELECT * FROM testimony ORDER BY id DESC LIMIT 6";
                    $r123 = mysqli_query($con, $q);
                    while ($ro = mysqli_fetch_array($r123)) {
                        $name = $ro['name'];
                        $position = $ro['position'];
                        $message = $ro['message'];
                        $ufile = $ro['ufile'];
                        
                        echo '
                        <div class="testimonial-item p-4" style="background: rgba(0,0,0,0.3); border-radius: 10px; margin: 10px; border: 1px solid rgba(255,255,255,0.1);">
                            <div class="review-content" dir="rtl">
                                <div class="review-text">
                                    <p class="text-white fw-bold" style="font-size: 16px;">'.$message.'</p>
                                </div>
                            </div>
                            <div class="reviewer media mt-3" dir="rtl">
                                <div class="reviewer-thumb">
                                    <img class="avatar-lg radius-100" src="uploads/testimonials/'.$ufile.'" alt="'.$name.'" style="width: 60px; height: 60px; object-fit: cover; border: 2px solid rgba(255,255,255,0.2);">
                                </div>
                                <div class="reviewer-meta media-body align-self-center mr-3">
                                    <h5 class="reviewer-name text-white mb-1 fw-bold">'.$name.'</h5>
                                    <h6 class="text-light fw-bold" style="color: #aaa !important;">'.$position.'</h6>
                                </div>
                            </div>
                        </div>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>








        
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

<section id="contact" class="contact-area ptb_100">
    <div class="container">
        <div class="row justify-content-between align-items-center">
            <div class="col-12 col-lg-5">
                <div class="section-heading text-center mb-3">
                    <h2>كن جزءًا من كأس العالم 2034</h2>
                    <p class="d-none d-sm-block mt-4">
                        سواء كنت مشجعًا، متطوعًا، أو جهة مشاركة في التنظيم — نحن نرحب بك للتواصل معنا.
                        دعنا نسمع منك ونرتّب لتجربة لا تُنسى في المملكة العربية السعودية!
                    </p>
                </div>
                <div class="contact-us">
                    <ul>
                        <li class="contact-info color-1 bg-hover active hover-bottom text-center p-5 m-3">
                            <span><i class="fas fa-mobile-alt fa-3x"></i></span>
                            <a class="d-block my-2" href="tel:0555555555">
                                <h3>+966 567 321 055</h3>
                            </a>
                        </li>
                        <li class="contact-info color-3 bg-hover active hover-bottom text-center p-5 m-3">
                            <span><i class="fas fa-envelope-open-text fa-3x"></i></span>
                            <a class="d-block my-2" href="mailto:any@gmail.com">
                                <h3>any@gmail.com</h3>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-12 col-lg-6 pt-4 pt-lg-0">
                <div class="contact-box text-center">
                    <?php
                    $status = "OK"; $msg = "";
                    if (isset($_POST['save'])) {
                        $name = mysqli_real_escape_string($con, $_POST['name']);
                        $email = mysqli_real_escape_string($con, $_POST['email']);
                        $phone = mysqli_real_escape_string($con, $_POST['phone']);
                        $message = mysqli_real_escape_string($con, $_POST['message']);

                        if (strlen($name) < 5) {
                            $msg .= "الاسم يجب أن يكون أكثر من 5 أحرف.<br>";
                            $status = "NOTOK";
                        }
                        if (strlen($email) < 9) {
                            $msg .= "البريد الإلكتروني يجب أن يكون أكثر من 9 أحرف.<br>";
                            $status = "NOTOK";
                        }
                        if (strlen($message) < 10) {
                            $msg .= "الرسالة يجب أن تكون أكثر من 10 أحرف.<br>";
                            $status = "NOTOK";
                        }
                        if (strlen($phone) < 8) {
                            $msg .= "رقم الهاتف يجب أن يكون أكثر من 8 أرقام.<br>";
                            $status = "NOTOK";
                        }

                        if ($status == "OK") {
                            $recipient = "awolu_faith@live.com";
                            $formcontent = "NAME: $name\nEMAIL: $email\nPHONE: $phone\nMESSAGE: $message";
                            $subject = "New Enquiry from World Cup Site";
                            $mailheader = "From: noreply@vogue.com\r\n";
                            $result = mail($recipient, $subject, $formcontent);
                            if ($result) {
                                $errormsg = "<div class='alert alert-success'>تم الإرسال بنجاح! سنقوم بالرد عليك قريبًا.</div>";
                            }
                        } else {
                            $errormsg = "<div class='alert alert-danger'>$msg</div>";
                        }
                    }

                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        echo $errormsg;
                    }
                    ?>
                    <form action="" method="post">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="name" placeholder="الاسم" required>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" name="email" placeholder="البريد الإلكتروني" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="phone" placeholder="رقم الجوال" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <textarea class="form-control" name="message" placeholder="اكتب رسالتك هنا..." required></textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" name="save" class="btn btn-bordered active btn-block mt-3">
                                    <span class="text-white pr-3"><i class="fas fa-paper-plane"></i></span>أرسل رسالتك الآن
                                </button>
                            </div>
                        </div>
                    </form>
                    <p class="form-message"></p>
                </div>
            </div>
        </div>
    </div>
</section>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">

<script>
document.addEventListener("DOMContentLoaded", function() {
    // Initialize Owl Carousel
    $('.testimonial-carousel').owlCarousel({
        loop: true,
        margin: 20,
        nav: true,
        rtl: true, // For right-to-left languages
        dots: false,
        autoplay: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 2
            },
            1000: {
                items: 3
            }
        }
    });
});
</script>
<?php include "footer.php"; ?>