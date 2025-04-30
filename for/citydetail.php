<?php
include "header.php";
$todo = mysqli_real_escape_string($con, $_GET["id"]);
?>
<section class="section breadcrumb-area d-flex align-items-center" style="background: rgb(16 36 18);">
    <div class="container" >
        <div class="row" >
            <div class="col-12">
                <div class="breadcrumb-content d-flex flex-column align-items-center text-center" >
                    <h2 class="text-white text-uppercase mb-3">تفاصيل المدينة </h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a class="text-uppercase text-white" href="index.php">الرئيسيه</a></li>
                        <li class="breadcrumb-item text-white active">المدينة</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>


<?php
$rt = mysqli_query($con, "SELECT * FROM city where id='$todo'");
$tr = mysqli_fetch_array($rt);
$city_title = "$tr[city_title]";
$city_detail = "$tr[city_detail]";
$upadated_at = "$tr[upadated_at]";
$ufile = "$tr[ufile]";
?>






    <div class="container">
        <div class="row justify-content-between align-items-center">
            <div class="col-12 col-lg-6">
                <div class="about-thumb text-center">
                    <!-- <img src="../dashboard/uploads/services/<?php print $ufile; ?>" alt="img"> -->
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="about-content section-heading text-center text-lg-left pl-md-4 mt-5 mt-lg-0 mb-0 ">
                    <!-- <h2 class="mb-3"><?php echo $city_title; ?></h2> -->
                    <div class="summernote-content">
                        <?php echo $city_detail; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<section class="section city-cards-area ptb_100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="text-center mb-5">الأماكن السياحية في <?php echo $city_title; ?></h2>
            </div>
        </div>
        
        <div class="row">
            <?php
            // Fetch city cards for this city
            $cards_query = mysqli_query($con, "SELECT * FROM city_cards WHERE city_id='$todo' ORDER BY id ASC");
            
            if(mysqli_num_rows($cards_query) > 0) {
                while($card = mysqli_fetch_array($cards_query)) {
                    $place_name = $card['place_name'];
                    $place_description = $card['place_description'];
                    $place_image = $card['place_image'];
                    ?>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <?php if(!empty($place_image)) { ?>
                                <img src="../dashboard/uploads/services/<?php echo $place_image; ?>" class="card-img-top" alt="<?php echo $place_name; ?>">
                            <?php } ?>
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $place_name; ?></h5>
                                <p class="card-text"><?php echo $place_description; ?></p>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo '<div class="col-12 text-center"><p>لا توجد أماكن سياحية مسجلة لهذه المدينة بعد.</p></div>';
            }
            ?>
        </div>
    </div>
</section>



<section class="section city-hotels-area ptb_100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="text-center mb-5">الفنادق في <?php echo $city_title; ?></h2>
            </div>
        </div>
        <div class="row">
            <?php
            $hotels_query = mysqli_query($con, "SELECT * FROM city_hotels WHERE city_id='$todo' ORDER BY id ASC");
            if (mysqli_num_rows($hotels_query) > 0) {
                while ($hotel = mysqli_fetch_array($hotels_query)) {
                    $hotel_name = $hotel['hotel_name'];
                    // $hotel_description = $hotel['hotel_description'];
                    // $hotel_image = $hotel['hotel_image'];
                    ?>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <?php if (!empty($hotel_image)) { ?>
                                <img src="../dashboard/uploads/services/<?php echo $hotel_image; ?>" class="card-img-top" alt="<?php echo $hotel_name; ?>">
                            <?php } ?>
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $hotel_name; ?></h5>
                                <!-- <p class="card-text"><?php echo $hotel_description; ?></p> -->
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo '<div class="col-12 text-center"><p>لا توجد فنادق مسجلة لهذه المدينة بعد.</p></div>';
            }
            ?>
        </div>
    </div>
</section>




<?php include "footer.php"; ?>

<style>
.city-cards-area {
    background-color: #f8f9fa;
    padding: 60px 0;
}
.card {
    border: none;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    transition: transform 0.3s ease;
}
.card:hover {
    transform: translateY(-10px);
}
.card-img-top {
    height: 200px;
    object-fit: cover;
}
.card-body {
    padding: 20px;
}
.card-title {
    font-weight: 600;
    margin-bottom: 15px;
    color: #333;
}


.city-hotels-area {
    background-color: #ffffff;
    padding: 60px 0;
}

</style>