<?php
include "header.php";

// Validate and sanitize the ID parameter
$event_id = isset($_GET["id"]) ? intval($_GET["id"]) : 0;

// Check if ID is valid
if ($event_id <= 0) {
    header("Location: index.php");
    exit();
}

// Prepare and execute the query safely
$stmt = mysqli_prepare($con, "SELECT port_title, port_detail, ufile, event_date, location FROM event WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $event_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Check if event exists
if (mysqli_num_rows($result) == 0) {
    header("Location: index.php");
    exit();
}

$event = mysqli_fetch_assoc($result);
$port_title = htmlspecialchars($event['port_title']);
$port_detail = htmlspecialchars($event['port_detail']);
$ufile = htmlspecialchars($event['ufile']);
$event_date = htmlspecialchars($event['event_date']);
$location = htmlspecialchars($event['location']);
?>

<!-- ***** Header Section ***** -->
<section class="section breadcrumb-area overlay-dark d-flex align-items-center" style="direction: rtl;">
    <div class="container">
        <div class="row">
            <div class="col-12">
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
<!-- ***** End Header Section ***** -->

<!-- ***** Event Card Section ***** -->
<section class="section ptb_100" style="direction: rtl;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8">
                <div class="card event-detail-card shadow-lg">
                    <!-- Event Image -->
                    <?php if (!empty($ufile)): ?>
                        <img src="/uploads/event/<?php echo $ufile; ?>" class="card-img-top" alt="<?php echo $port_title; ?>">
                    <?php else: ?>
                        <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 300px;">
                            <span class="text-muted">لا توجد صورة</span>
                        </div>
                    <?php endif; ?>
                    
                    <div class="card-body">
                        <!-- Event Title -->
                        <h1 class="card-title mb-3"><?php echo $port_title; ?></h1>
                        
                        <!-- Event Meta -->
                        <div class="event-meta mb-4">
                            <?php if (!empty($event_date)): ?>
                                <span class="meta-item me-3">
                                    <i class="fas fa-calendar-alt me-2"></i>
                                    <?php echo $event_date; ?>
                                </span>
                            <?php endif; ?>
                            
                            <?php if (!empty($location)): ?>
                                <span class="meta-item">
                                    <i class="fas fa-map-marker-alt me-2"></i>
                                    <?php echo $location; ?>
                                </span>
                            <?php endif; ?>
                        </div>
                        
                        <!-- Event Description -->
                        <div class="card-text lead">
                            <?php echo nl2br($port_detail); ?>
                        </div>
                        
                        <!-- Action Buttons -->
                        <div class="mt-4 pt-3 border-top">
                            <a href="events.php" class="btn btn-primary">
                                <i class="fas fa-arrow-right me-2"></i>عودة إلى الفعاليات
                            </a>
                            <button class="btn btn-outline-secondary ms-2">
                                <i class="fas fa-share-alt me-2"></i>مشاركة
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ***** End Event Card Section ***** -->

<style>
    .event-detail-card {
        border: none;
        border-radius: 15px;
        overflow: hidden;
    }
    
    .event-detail-card .card-img-top {
        height: 400px;
        object-fit: cover;
    }
    
    .event-meta {
        color: #6c757d;
        font-size: 1.1rem;
    }
    
    .meta-item {
        display: inline-flex;
        align-items: center;
    }
    
    .card-title {
        color: #343a40;
        font-weight: 700;
    }
    
    .card-text {
        color: #495057;
        line-height: 1.8;
    }
    
    @media (max-width: 768px) {
        .event-detail-card .card-img-top {
            height: 250px;
        }
    }
</style>

<?php include "footer.php"; ?>