<?php
/*
 * Created on Thu Jul 29 2021
 *
 * The MIT License (MIT)
 * Copyright (c) 2021 MartDevelopers Inc
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy of this software
 * and associated documentation files (the "Software"), to deal in the Software without restriction,
 * including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense,
 * and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so,
 * subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all copies or substantial
 * portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED
 * TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL
 * THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT,
 * TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */
session_start();
require_once('../config/config.php');
/* Load System COnfigurations And Settings */
$ret = "SELECT * FROM `iResturant_System_Details` JOIN iResturant_Currencies c 
WHERE c.status = 'Active'  ";
$stmt = $mysqli->prepare($ret);
$stmt->execute(); //ok
$res = $stmt->get_result();
while ($sys = $res->fetch_object()) {
    require_once('../partials/landing_head.php');
?>

    <body>
        <!-- start cssload-loader -->
        <div class="preloader" id="preloader">
            <div class="loader">
                <svg class="spinner" viewBox="0 0 50 50">
                    <circle class="path" cx="25" cy="25" r="20" fill="none" stroke-width="5"></circle>
                </svg>
            </div>
        </div>

        <?php require_once('../partials/landing_header.php'); ?>

        <section class="breadcrumb-area bread-bg-10">
            <div class="breadcrumb-wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="breadcrumb-content text-center">
                                <div class="section-heading">
                                    <h2 class="sec__title text-white"><?php echo $sys->system_name; ?> Rooms</h2>
                                </div>
                            </div><!-- end breadcrumb-content -->
                        </div><!-- end col-lg-12 -->
                    </div><!-- end row -->
                </div><!-- end container -->
            </div><!-- end breadcrumb-wrap -->
            <div class="bread-svg-box">
                <svg class="bread-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 10" preserveAspectRatio="none">
                    <polygon points="100 0 50 10 0 0 0 10 100 10"></polygon>
                </svg>
            </div><!-- end bread-svg -->
        </section><!-- end breadcrumb-area -->

        <section class="card-area section--padding">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                    </div><!-- end col-lg-12 -->
                </div><!-- end row -->
                <div class="tab-content" id="may-tabContent4">
                    <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
                        <div class="row">
                            <?php
                            /* Load All Rooms */
                            $ret = "SELECT  * FROM iResturant_Room_Category rc
                            INNER JOIN iResturant_Room r ON r.room_category_id = rc.id";
                            $stmt = $mysqli->prepare($ret);
                            $stmt->execute(); //ok
                            $res = $stmt->get_result();
                            while ($rooms = $res->fetch_object()) {
                            ?>
                                <div class="col-lg-12">
                                    <div class="card-item card-item-list room-card">
                                        <div class="card-body">
                                            <div class="card-price pb-2">
                                                <p>
                                                    <span class="price__from">Rates</span>
                                                    <span class="price__num"><?php echo $sys->code . " " . $rooms->price; ?></span>
                                                </p>
                                            </div>
                                            <h3 class="card-title font-size-26"><a href="landing_room?view=<?php echo $rooms->number; ?>"><?php echo $rooms->name; ?></a></h3>
                                            <p class="card-text pt-2">
                                                <?php echo $rooms->details; ?>
                                            </p>
                                            <br>
                                            <div class="card-btn d-flex justify-content-end">
                                                <a href="landing_room?view=<?php echo $rooms->number; ?>" class="theme-btn theme-btn-transparent">Book Now</a>
                                            </div>
                                        </div>
                                    </div><!-- end card-item -->
                                </div><!-- end col-lg-12 -->
                            <?php
                            } ?>
                        </div><!-- end row -->
                    </div>

                </div>

            </div><!-- end container -->
        </section><!-- end card-area -->
       
        <?php require_once('../partials/landing_footer.php'); ?>
        <!-- start back-to-top -->
        <div id="back-to-top">
            <i class="la la-angle-up" title="Go top"></i>
        </div>

        <?php require_once('../partials/landing_scripts.php'); ?>
    </body>


    </html>
<?php
} ?>