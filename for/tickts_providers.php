
<?php
// worldcup2034_ticket_providers.php - مواقع بيع تذاكر كأس العالم 2034


$page_title = "مواقع بيع تذاكر كأس العالم 2034 في السعودية";
$official_sites = array(
);

$other_sites = array(
    array(
        "name" => "FIFA الرسمية",
        "url" => "https://www.fifa.com/en/tickets",
        "logo" => "https://upload.wikimedia.org/wikipedia/commons/thumb/a/aa/FIFA_logo_without_slogan.svg/1200px-FIFA_logo_without_slogan.svg.png",
        "description" => "الموقع الرسمي للفيفا لبيع تذاكر كأس العالم",
        "type" => "منصة عالمية"
    ),
    array(
        "name" => "WeBook",
        "url" => "https://www.webook.com",
        "logo" => "https://images.ctfassets.net/vy53kjqs34an/RmOPxv5902vlbBXO5odL7/42360b98d30bbff1df875268e5f63298/wbk-logo-webookcom-bottompadding.svg",
        "description" => "منصة سعودية معتمدة لبيع تذاكر الفعاليات الكبرى",
        "type" => "موقع معتمد"
    ),
    array(
        "name" => "Prime Ticket",
        "url" => "https://primeticketsa.com/",
        "logo" => "https://primeticketsa.com/client/site/images/logo220x68.png",
        "description" => "منصة تذاكر معتمدة في المملكة العربية السعودية",
        "type" => "موقع معتمد"
    ),
    array(
        "name" => "تذاكر موسم الرياض",
        "url" => "https://riyadhseason.com/ar",
        "logo" => "https://images.ctfassets.net/vy53kjqs34an/3b6vBa9H4jGNZQvpCDV9sm/ca9a29433c61e153eaa123f7fb59ec15/website_RiyadhSeason_w.png?fm=webp&w=85&h=110",
        "description" => "منصة موسم الرياض الرسمية لبيع التذاكر",
        "type" => "موقع معتمد"
    ),
    array(
        "name" => "TicketMX",
        "url" => "https://www.ticketmx.com",
        "logo" => "https://s3.ticketmx.com/images/shared/logo-white.svg",
        "description" => "منصة تذاكر معتمدة في المملكة العربية السعودية",
        "type" => "موقع معتمد"
    ),
    array(
        "name" => "StubHub",
        "url" => "https://www.stubhub.com",
        "logo" => "https://img.vggcdn.net/images/Assets/Icons/bfx/stubhub-purple-logo-light-theme.svg",
        "description" => "منصة تذاكر عالمية معتمدة",
        "type" => "منصة عالمية"
    ),
    array(
        "name" => "LiveFootballTickets",
        "url" => "https://www.livefootballtickets.com",
        "logo" => "https://www.livefootballtickets.com/images/logo.svg",
        "description" => "متخصصون في تذاكر المباريات الكبرى حول العالم",
        "type" => "منصة عالمية"
    ),
);


?>

<?php include 'header.php'; ?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Tajawal', sans-serif;
        }

        header {
            background-color: rgb(16, 38, 18);
        }
        header a {
            color: white;

        }
        .worldcup-banner {
            background: linear-gradient(90deg, #245e3d, #1a3e72);
            color: white;
            padding: 1rem;
            text-align: center;
            margin-bottom: 2rem;
            border-radius: 5px;
        }
        .site-card {
            transition: transform 0.3s, box-shadow 0.3s;
            margin-bottom: 20px;
            border-radius: 10px;
            overflow: hidden;
            border: none;
            position: relative;
        }
        .site-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        .site-logo {
            height: 80px;
            width: 150px;
            object-fit: contain;
            margin: 10px auto;
            display: block;
            background-color: #f1f1f1;
            padding: 5px;
            border-radius: 5px;
        }
        .btn-visit {
            background-color: #245e3d;
            border: none;
            width: 100%;
        }
        .btn-visit:hover {
            background-color: #1a3e72;
        }
        .footer {
            background-color: #245e3d;
            color: white;
            padding: 1.5rem 0;
            margin-top: 2rem;
        }
        .badge-type {
            position: absolute;
            top: 10px;
            left: 10px;
            font-size: 0.8rem;
        }
        .official-badge {
            background-color: #28a745;
        }
        .approved-badge {
            background-color: #d4af37;
            color: #000;
        }
        .global-badge {
            background-color: #6c757d;
        }
        .section-title {
            margin: 30px 0 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #eee;
            color: #245e3d;
        }
        .alert-info {
            background-color: #e7f5ff;
            border-color: #d0ebff;
            color: #1864ab;
        }
        .promo-card {
            background: rgba(255,255,255,0.9);
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }
        .promo-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        }
        .nav-tabs .nav-link.active {
            background-color: #245e3d;
            color: white;
            border-color: #245e3d;
        }
        .nav-tabs .nav-link {
            color: #245e3d;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="worldcup-banner">
            <h3>كأس العالم FIFA 2034 - السعودية</h3>
            <p class="text-white">احجز تذكرتك الآن لأكبر حدث كروي في العالم</p>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="promo-card">
                    <h4>نصائح للشراء الآمن</h4>
                    <ul>
                        <li>تفضل الشراء من المصادر الرسمية</li>
                        <li>تحقق من شهادات الأمان للموقع</li>
                        <li>تجنب الدفع نقدًا خارج المنصات</li>
                        <li>احتفظ بإيصال الشراء</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-4">
                <div class="promo-card">
                    <h4>مواعيد بيع التذاكر</h4>
                    <ul>
                        <li>المرحلة الأولى: يناير 2033</li>
                        <li>المرحلة الثانية: يوليو 2033</li>
                        <li>المرحلة الأخيرة: يناير 2034</li>
                        <li>تذاكر اللحظة الأخيرة: يونيو 2034</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-4">
                <div class="promo-card">
                    <h4>أنواع التذاكر</h4>
                    <ul>
                        <li>تذاكر المباريات الفردية</li>
                        <li>باقات المباريات</li>
                        <li>تذاكر الضيافة</li>
                        <li>تذاكر الجمهور المحلي</li>
                    </ul>
                </div>
            </div>
        </div>
<!--
        <h2 class="section-title">المواقع الرسمية</h2>
        <div class="row">
            <?php foreach ($official_sites as $site): ?>
            <div class="col-md-3 mb-4">
                <div class="card site-card h-100">
                    <span class="badge badge-type official-badge"><?php echo $site['type']; ?></span>
                    <div class="card-body text-center">
                        <img src="<?php echo $site['logo']; ?>" alt="<?php echo $site['name']; ?>" class="site-logo" onerror="this.onerror=null; this.src='https://via.placeholder.com/150x80?text=Logo+Not+Found'">
                        <h5 class="card-title mt-2"><?php echo $site['name']; ?></h5>
                        <p class="card-text text-muted"><?php echo $site['description']; ?></p>
                    </div>
                    <div class="card-footer bg-white">
                        <a href="<?php echo $site['url']; ?>" target="_blank" class="btn btn-primary btn-visit">زيارة الموقع</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

            -->

        <h2 class="section-title">مواقع أخرى لبيع التذاكر</h2>
        <div class="alert alert-info">
            <strong>ملاحظة:</strong> هذه المواقع معتمدة في المملكة أو دوليًا، ولكنها ليست تابعة رسميًا للفيفا أو اللجنة المنظمة. يرجى التأكد من سياسات الإلغاء والاسترداد قبل الشراء.
        </div>
        
        <ul class="nav nav-tabs mb-4" id="ticketTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="all-tab" data-bs-toggle="tab" data-bs-target="#all" type="button" role="tab">الكل</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="approved-tab" data-bs-toggle="tab" data-bs-target="#approved" type="button" role="tab">مواقع سعودية معتمدة</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="global-tab" data-bs-toggle="tab" data-bs-target="#global" type="button" role="tab">منصات عالمية</button>
            </li>
        </ul>
        
        <div class="tab-content" id="ticketTabsContent">
            <div class="tab-pane fade show active" id="all" role="tabpanel">
                <div class="row">
                    <?php foreach ($other_sites as $site): ?>
                    <div class="col-md-3 mb-4">
                        <div class="card site-card h-100">
                            <span class="badge badge-type <?php echo $site['type'] == 'موقع معتمد' ? 'approved-badge' : 'global-badge'; ?>"><?php echo $site['type']; ?></span>
                            <div class="card-body text-center">
                                <img src="<?php echo $site['logo']; ?>" alt="<?php echo $site['name']; ?>" class="site-logo" onerror="this.onerror=null; this.src='https://via.placeholder.com/150x80?text=Logo+Not+Found'">
                                <h5 class="card-title mt-2"><?php echo $site['name']; ?></h5>
                                <p class="card-text text-muted"><?php echo $site['description']; ?></p>
                            </div>
                            <div class="card-footer bg-white">
                                <a href="<?php echo $site['url']; ?>" target="_blank" class="btn btn-primary btn-visit">زيارة الموقع</a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            
            <div class="tab-pane fade" id="approved" role="tabpanel">
                <div class="row">
                    <?php foreach (array_filter($other_sites, fn($site) => $site['type'] == 'موقع معتمد') as $site): ?>
                    <div class="col-md-3 mb-4">
                        <div class="card site-card h-100">
                            <span class="badge badge-type approved-badge"><?php echo $site['type']; ?></span>
                            <div class="card-body text-center">
                                <img src="<?php echo $site['logo']; ?>" alt="<?php echo $site['name']; ?>" class="site-logo" onerror="this.onerror=null; this.src='https://via.placeholder.com/150x80?text=Logo+Not+Found'">
                                <h5 class="card-title mt-2"><?php echo $site['name']; ?></h5>
                                <p class="card-text text-muted"><?php echo $site['description']; ?></p>
                            </div>
                            <div class="card-footer bg-white">
                                <a href="<?php echo $site['url']; ?>" target="_blank" class="btn btn-primary btn-visit">زيارة الموقع</a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            
            <div class="tab-pane fade" id="global" role="tabpanel">
                <div class="row">
                    <?php foreach (array_filter($other_sites, fn($site) => $site['type'] == 'منصة عالمية') as $site): ?>
                    <div class="col-md-3 mb-4">
                        <div class="card site-card h-100">
                            <span class="badge badge-type global-badge"><?php echo $site['type']; ?></span>
                            <div class="card-body text-center">
                                <img src="<?php echo $site['logo']; ?>" alt="<?php echo $site['name']; ?>" class="site-logo" onerror="this.onerror=null; this.src='https://via.placeholder.com/150x80?text=Logo+Not+Found'">
                                <h5 class="card-title mt-2"><?php echo $site['name']; ?></h5>
                                <p class="card-text text-muted"><?php echo $site['description']; ?></p>
                            </div>
                            <div class="card-footer bg-white">
                                <a href="<?php echo $site['url']; ?>" target="_blank" class="btn btn-primary btn-visit">زيارة الموقع</a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <?php include 'footer.php' ?>
</body>
</html>