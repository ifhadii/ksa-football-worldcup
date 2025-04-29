<?php
include "header.php";

// Database connection and query remains the same
// Verify database connection
if (!$con) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Validate and sanitize the ID parameter
$event_id = isset($_GET["id"]) ? intval($_GET["id"]) : 0;

// Check if ID is valid
if ($event_id <= 0) {
    header("Location: index.php");
    exit();
}

// Prepare the query safely
$sql = "SELECT port_title, port_detail, port_desc, ufile, updated_at FROM event WHERE id = ?";
$stmt = mysqli_prepare($con, $sql);

if (!$stmt) {
    die("Prepare failed: " . mysqli_error($con));
}

// Bind parameters and execute
mysqli_stmt_bind_param($stmt, "i", $event_id);

if (!mysqli_stmt_execute($stmt)) {
    die("Execute failed: " . mysqli_stmt_error($stmt));
}

$result = mysqli_stmt_get_result($stmt);

// Check if event exists
if (mysqli_num_rows($result) == 0) {
    header("Location: index.php");
    exit();
}

$event = mysqli_fetch_assoc($result);
$port_title = htmlspecialchars($event['port_title']);
$port_detail = htmlspecialchars($event['port_detail']);
$port_desc = htmlspecialchars($event['port_desc']);
$ufile = htmlspecialchars($event['ufile']);
$event_date = htmlspecialchars($event['updated_at']);
?>

<!-- ***** Header Section ***** -->
<section class="section breadcrumb-area d-flex align-items-center" style="direction: rtl; background-color: rgb(16, 36, 18);">
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

<!-- ***** Horizontal Event Section ***** -->
<section class="section ptb_100" style="direction: rtl;">
    <div class="container">
        <div class="row align-items-stretch">
            <!-- Image Column -->
            <div class="col-md-6 mb-4 mb-md-0">
                <div class="h-100 event-image-container shadow-lg rounded">
                    <?php if (!empty($ufile)): ?>
                        <img src="../dashboard/uploads/event/<?php echo $ufile; ?>" class="img-fluid h-100 w-100" alt="<?php echo $port_title; ?>" style="object-fit: cover;">
                    <?php else: ?>
                        <div class="d-flex align-items-center justify-content-center bg-light h-100">
                            <span class="text-muted">لا توجد صورة</span>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            
            <!-- Content Column -->
            <div class="col-md-6">
                <div class="h-100 event-content-container p-4 shadow-lg rounded" style="background-color: #f8f9fa;">
                    <!-- Event Title -->
                    <h1 class="mb-3"><?php echo $port_title; ?></h1>
                    
                    <!-- Event Meta -->
                    <div class="event-meta mb-4">
                        <?php if (!empty($event_date)): ?>
                            <span class="meta-item me-3">
                                <i class="fas fa-calendar-alt me-2"></i>
                                <?php echo date('Y-m-d', strtotime($event_date)); ?>
                            </span>
                        <?php endif; ?>
                    </div>
                    
                    <!-- Event Description -->
                    <div class="lead mb-4">
                        <?php echo nl2br($port_detail); ?>
                    </div>
                    
                    <!-- Event Full Description -->
                    <div class="lead mb-4">
                        <?php echo nl2br($port_desc); ?>
                    </div>

                    <style>
                        .buttons {
                            display: flex;
                            justify-content: space-between;
                        }
                    </style>
                    
                    <!-- Action Button -->
                    <div class="buttons mt-auto pt-3 border-top">
                        <a href="event.php" class="btn btn-primary">
                            <i class="fas fa-arrow-right me-2"></i>عودة إلى الفعاليات
                        </a>
                        <a href="event.php" class="btn btn-primary">
                            <i class="fas fa-arrow-right me-2"></i>عودة إلى الفعاليات
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ***** End Horizontal Event Section ***** -->

<style>
    .event-image-container {
        min-height: 400px;
        overflow: hidden;
        border-radius: 15px;
    }
    
    .event-content-container {
        display: flex;
        flex-direction: column;
        border-radius: 15px;
    }
    
    .event-meta {
        color: #6c757d;
        font-size: 1.1rem;
    }
    
    .meta-item {
        display: inline-flex;
        align-items: center;
    }
    
    @media (max-width: 768px) {
        .event-image-container {
            min-height: 250px;
        }
        
        .event-content-container {
            min-height: auto;
        }
    }
</style>

<?php 
// Close statement and connection
if (isset($stmt)) {
    mysqli_stmt_close($stmt);
}
mysqli_close($con);
include "footer.php"; 
?>