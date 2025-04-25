<?php
include "../for/z_db.php";
$username = $_SESSION['username'];
?>
<div class="app-menu navbar-menu" style="direction: rtl; text-align: right;">
  <!-- الشعار -->
  <div class="navbar-brand-box">
    <?php
    $rr = mysqli_query($con, "SELECT ufile FROM logo");
    $r = mysqli_fetch_row($rr);
    $ufile = $r[0];
    ?>

    <a href="index.php" class="logo logo-dark">
      <span class="logo-sm">
        <img src="uploads/logo/<?php echo $ufile ?>" alt="شعار" height="22">
      </span>
      <span class="logo-lg">
        <img src="uploads/logo/<?php echo $ufile ?>" alt="شعار" height="30">
      </span>
    </a>
    <!-- الشعار في الوضع الفاتح -->
    <a href="index.php" class="logo logo-light">
      <span class="logo-sm">
        <!-- <img src="uploads/logo/<?php echo $ufile ?>" alt="شعار" height="22"> -->
      </span>
      <span class="logo-lg">
        <!-- <img src="uploads/logo/<?php echo $ufile ?>" alt="شعار" height="30"> -->
      </span>
    </a>
    <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
      <i class="ri-record-circle-line"></i>
    </button>
  </div>

  <div id="scrollbar">
    <div class="container-fluid">
      <ul class="navbar-nav" id="navbar-nav">
        <li class="menu-title"><span>القائمة الرئيسية</span></li>

        <li class="nav-item">
          <a href="dashboard" class="nav-link">
            <i class="ri-dashboard-2-line"></i>
            <span>لوحة التحكم</span>
          </a>
        </li>

        <!-- إدارة المدن -->
        <li class="nav-item">
          <a class="nav-link menu-link" href="#sidebarCity" data-bs-toggle="collapse" role="button" aria-expanded="true">
            <i class="ri-checkbox-multiple-line"></i> <span>إدارة المدن</span>
          </a>
          <div class="menu-dropdown collapse" id="sidebarCity">
            <ul class="nav nav-sm flex-column">
              <li class="nav-item">
                <a href="createcity" class="nav-link">إضافة مدينة</a>
              </li>
              <li class="nav-item">
                <a href="city" class="nav-link">قائمة المدن</a>
              </li>
            </ul>
          </div>
        </li>

        <!-- إدارة الفعاليات -->
        <li class="nav-item">
          <a class="nav-link menu-link" href="#sidebarEvent" data-bs-toggle="collapse" role="button" aria-expanded="true">
            <i class="ri-rhythm-fill"></i> <span>إدارة الفعاليات</span>
          </a>
          <div class="menu-dropdown collapse" id="sidebarEvent">
            <ul class="nav nav-sm flex-column">
              <li class="nav-item">
                <a href="createevent" class="nav-link">إضافة فعالية</a>
              </li>
              <li class="nav-item">
                <a href="event" class="nav-link">قائمة الفعاليات</a>
              </li>
            </ul>
          </div>
        </li>

        <!-- إدارة الروابط الاجتماعية -->
        <li class="nav-item">
          <a class="nav-link menu-link" href="#sidebarSocial" data-bs-toggle="collapse" role="button" aria-expanded="true">
            <i class="ri-chrome-fill"></i> <span>إدارة المستخدمين </span>
          </a>
          <div class="menu-dropdown collapse" id="sidebarSocial">
            <ul class="nav nav-sm flex-column">
              <li class="nav-item">
                <a href="createsocial" class="nav-link">إضافة رابط</a>
              </li>
              <li class="nav-item">
                <a href="social" class="nav-link">قائمة الروابط</a>
              </li>
            </ul>
          </div>
        </li>

        <!-- إدارة الآراء -->
        <li class="nav-item">
          <a class="nav-link menu-link" href="#sidebarTestimony" data-bs-toggle="collapse" role="button" aria-expanded="true">
            <i class="ri-message-line"></i> <span>إدارة الآراء</span>
          </a>
          <div class="menu-dropdown collapse" id="sidebarTestimony">
            <ul class="nav nav-sm flex-column">
              <li class="nav-item">
                <a href="newtestimony" class="nav-link">إضافة رأي</a>
              </li>
              <li class="nav-item">
                <a href="testimony" class="nav-link">جميع الآراء</a>
              </li>
            </ul>
          </div>
        </li>
      </ul>
    </div>
  </div>

  <div class="sidebar-background"></div>
</div>

<!-- تغطية رأسية -->
<div class="vertical-overlay"></div>
