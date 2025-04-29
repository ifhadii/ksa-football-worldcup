<?php include "header.php"; ?>
<section class="section breadcrumb-area d-flex align-items-center" style="direction: rtl; text-align: right; background: rgb(16 36 18);">
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
                $updated_at = isset($ro['updated_at']) ? $ro['updated_at'] : '';

                echo "
                <div class='col-12 col-sm-6 col-lg-4 event-item mb-4'>
                    <div class='card event-card h-100'>
                        <a href='eventail.php?id=$id'>
                            <img src='../dashboard/uploads/event/$ufile' class='card-img-top' alt='$port_title'>
                        </a>
                        <div class='card-body'>
                            <h3 class='card-title'>$port_title</h3>
                            <div class='event-meta mb-2'>";
                            
                            if (!empty($updated_at)) {
                                echo "<span class='meta-item'>
                                    <i class='fas fa-calendar-alt me-2'></i>
                                    $updated_at
                                </span>";
                            }
                            
                            echo "</div>
                            <p class='card-text'>$port_desc</p>
                        </div>
                        <div class='card-footer bg-transparent border-top-0'>
                            <a href='eventail.php?id=$id' class='btn btn-primary w-100'>
                                <i class='fas fa-eye me-2'></i>عرض التفاصيل
                            </a>
                        </div>
                    </div>
                </div>
                ";
            }
            ?>
        </div>
    </div>
</section>

<style>
    .event-card {
        border: none;
        border-radius: 15px;
        overflow: hidden;
        transition: all 0.3s ease;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05), 
                    0 1px 3px rgba(0, 0, 0, 0.1);
    }
    
    .event-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1),
                    0 4px 6px -2px rgba(0, 0, 0, 0.05),
                    0 0 20px 0 rgba(0, 0, 0, 0.1);
    }
    
    .event-card .card-img-top {
        height: 200px;
        object-fit: cover;
        width: 100%;
        transition: transform 0.3s ease;
    }
    
    .event-card:hover .card-img-top {
        transform: scale(1.03);
    }
    
    .event-meta {
        color: #6c757d;
        font-size: 0.9rem;
    }
    
    .meta-item {
        display: inline-flex;
        align-items: center;
    }
    
    .event-card .card-title {
        color: #343a40;
        font-weight: 700;
        font-size: 1.2rem;
        margin-bottom: 0.75rem;
    }
    
    .event-card .card-text {
        color: #495057;
        line-height: 1.6;
        font-size: 0.95rem;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    
    .event-card .card-footer {
        padding: 1rem 1.25rem;
        background: transparent !important;
    }
    
    @media (max-width: 768px) {
        .event-card .card-img-top {
            height: 180px;
        }
    }
</style>

<?php include "footer.php"; ?>