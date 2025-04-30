<?php include "header.php"; ?>

<section class="section breadcrumb-area d-flex align-items-center" style="background-color: rgb(16 36 18);">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb-content text-center">
                    <h2 class="text-white text-uppercase mb-3">اتصل بنا</h2>
                    <ol class="breadcrumb d-flex justify-content-center">
                        <li class="breadcrumb-item"><a class="text-uppercase text-white" href="index.html">الرئيسية</a></li>
                        <li class="breadcrumb-item"><a class="text-uppercase text-white" href="#">الصفحات</a></li>
                        <li class="breadcrumb-item text-white active">اتصل بنا</li>
                    </ol>
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

<footer class="section footer-area" style="background-color: #f8f9fa; border-top: 1px solid #ddd;">
  <div class="container py-5">
    <div class="row text-center text-md-start">
      <div class="col-12 col-md-6 col-lg-3 mb-4">
        <h5 class="fw-bold mb-3">عن البطولة</h5>
        <p style="font-size: 14px;">
          كأس العالم 2034 هو حدث رياضي عالمي تستضيفه المملكة العربية السعودية لأول مرة. يجمع بين الشغف الرياضي، الثقافة، والتقنيات الحديثة لتقديم تجربة لا تُنسى.
        </p>
      </div>

      <div class="col-6 col-md-6 col-lg-3 mb-4">
        <h5 class="fw-bold mb-3">🎟️ التذاكر والإقامة</h5>
        <ul class="list-unstyled" style="font-size: 14px;">
          <li><a href="https://www.fifa.com/tickets" target="_blank" class="text-black-50 text-decoration-none">تذاكر فيفا</a></li>
          <li><a href="https://webook.com/ar" target="_blank" class="text-black-50 text-decoration-none">WeBook - فنادق وجولات</a></li>
          <li><a href="https://mytable.sa/contact-us" target="_blank" class="text-black-50 text-decoration-none">MyTable - مطاعم</a></li>
          <li><a href="https://riyadhseason.sa" target="_blank" class="text-black-50 text-decoration-none">موسم الرياض</a></li>
          <li><a href="https://diriyah.sa" target="_blank" class="text-black-50 text-decoration-none">فعاليات الدرعية</a></li>
          <li><a href="https://booking.com" target="_blank" class="text-black-50 text-decoration-none">Booking.com</a></li>
        </ul>
      </div>

      <div class="col-6 col-md-6 col-lg-3 mb-4">
        <h5 class="fw-bold mb-3">🚌 المواصلات</h5>
        <ul class="list-unstyled" style="font-size: 14px;">
          <li><a href="https://www.riyadhbus.sa/ar/tickets" target="_blank" class="text-black-50 text-decoration-none">ميترو الرياض</a></li>
          <li><a href="https://saptco.com.sa" target="_blank" class="text-black-50 text-decoration-none">سابتكو</a></li>
          <li><a href="https://www.careem.com" target="_blank" class="text-black-50 text-decoration-none">كريم</a></li>
          <li><a href="https://www.uber.com/sa/ar/" target="_blank" class="text-black-50 text-decoration-none">أوبر</a></li>
        </ul>
      </div>
    </div>

    <hr />

    <div class="text-center pt-3">
      <p class="mb-1" style="font-size: 14px;">&copy; <?php echo date('Y'); ?> جميع الحقوق محفوظة - KSAWelcomeCup</p>
    </div>
  </div>
</footer>

      
        <div id="menu" class="modal fade p-0">
            <div class="modal-dialog dialog-animated">
                <div class="modal-content h-100">
                    <div class="modal-header" data-dismiss="modal">
                        القائمة <i class="far fa-times-circle icon-close"></i>
                    </div>
                    <div class="menu modal-body">
                        <div class="row w-100">
                            <div class="items p-0 col-12 text-center"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


<div class="modal fade" id="loginModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="row g-0">
        <div class="col-md-12" style="background-color:#ddd;">
        <div class="form-side p-4" style="background-color:#ddd;">
            <h2>تسجيل الدخول</h2>
            <p>سجّل الدخول للوصول إلى حسابك</p>

            <form method="post">
            <input type="hidden" name="action" value="login">
              <div class="mb-3">
                <input type="email" class="form-control" placeholder="البريد الإلكتروني" required  name="email">
              </div>
              <div class="mb-3">
                <input type="password" class="form-control" placeholder="كلمة المرور" required name="password">
              </div>

              <button type="submit" class="login-btn">تسجيل الدخول</button>

              <div class="text-center">
                ليس لديك حساب؟ <a href="#" class="text-danger"  data-bs-toggle="modal" data-bs-target="#registerModal"  >إنشاء حساب</a>
              </div>

            
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="registerModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="row g-0">
        <div class="col-md-5 d-none d-md-flex align-items-center justify-content-center bg-white">
          <img src="assets/img/signup.png" alt="register illustration" class="img-fluid p-4">
        </div>

        <div class="col-md-7">
          <div class="form-side p-4" style="background-color: #ddd;">
            <h2>إنشاء حساب جديد</h2>
            <p>قم بإنشاء حساب جديد للاستفادة من خدماتنا</p>

            <form method="post">


            <input type="hidden" name="action" value="register">


              <div class="mb-3">
                <input type="text" class="form-control" placeholder="الاسم الكامل"  name="full_name" required>
              </div>
              <div class="mb-3">
                <input type="email" class="form-control" placeholder="البريد الإلكتروني"  name="email" required>
              </div>
              <div class="mb-3">
                <input type="password" class="form-control" placeholder="كلمة المرور"  name="password" required>
              </div>
              <div class="mb-3">
                <input type="password" class="form-control" placeholder="تأكيد كلمة المرور"   name="confirm_password" required>
              </div>

              <button type="submit" class="btn btn-primary w-100 py-2">إنشاء الحساب</button>

              <div class="text-center mt-3">
                لديك حساب بالفعل؟ <a href="#" class="text-danger" onclick="switchToLogin()">تسجيل الدخول</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


    </div>



    <script src="assets/js/jquery/jquery-3.5.1.min.js"></script>

    <script src="assets/js/bootstrap/popper.min.js"></script>
    <script src="assets/js/bootstrap/bootstrap.min.js"></script>

    <script src="assets/js/plugins/plugins.min.js"></script>

    <script src="assets/js/active.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
  $(document).ready(function () {
    $('#showLoginModal').click(function () {
      var loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
      loginModal.show();
    });
  });
</script>
</body>
</html>