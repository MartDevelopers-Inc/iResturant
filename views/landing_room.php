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
require_once('../config/codeGen.php');

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

        <?php require_once('../partials/landing_header.php');
        $view = $_GET['view'];
        $ret = "SELECT  * FROM iResturant_Room WHERE number = '$view'";
        $stmt = $mysqli->prepare($ret);
        $stmt->execute(); //ok
        $res = $stmt->get_result();
        while ($rooms = $res->fetch_object()) {
        ?>

            <section class="room-detail-bread">
                <div class="full-width-slider carousel-action">
                    <?php
                    $ret = "SELECT * FROM `iResturant_Room_Images` WHERE room_id = '$rooms->id'  ";
                    $stmt = $mysqli->prepare($ret);
                    $stmt->execute(); //ok
                    $res = $stmt->get_result();
                    while ($images = $res->fetch_object()) {
                    ?>
                        <div class="full-width-slide-item">
                            <img src="../public/uploads/sys_data/rooms/<?php echo $images->image; ?>" alt="">
                        </div>
                    <?php
                    } ?>
                </div><!-- end full-width-slider -->
            </section><!-- end room-detail-bread -->

            <section class="tour-detail-area padding-bottom-90px">
                <div class="single-content-navbar-wrap menu section-bg" id="single-content-navbar">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="single-content-nav" id="single-content-nav">
                                    <ul>
                                        <li><a data-scroll="description" href="#description" class="scroll-link active">Room Details</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- end single-content-navbar-wrap -->
                <?php
                $ret = "SELECT  * FROM iResturant_Room_Category rc
                INNER JOIN iResturant_Room r ON r.room_category_id = rc.id WHERE r.number = '$view'";
                $stmt = $mysqli->prepare($ret);
                $stmt->execute(); //ok
                $res = $stmt->get_result();
                while ($room_category = $res->fetch_object()) {
                ?>
                    <div class="single-content-box">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="single-content-wrap padding-top-60px">
                                        <div id="description" class="page-scroll">
                                            <div class="single-content-item pb-4">
                                                <h3 class="title font-size-26"><?php echo $room_category->name; ?></h3>
                                            </div><!-- end single-content-item -->
                                            <div class="section-block"></div>
                                            <div class="single-content-item padding-top-30px padding-bottom-40px">
                                                <h3 class="title font-size-20">Room Details</h3>
                                                <p class="pb-4">
                                                    <?php echo $rooms->details; ?>
                                                </p>
                                                <h3 class="title font-size-15 font-weight-medium pb-3">Room Rules</h3>
                                                <ul class="list-items">
                                                    <li><i class="la la-dot-circle mr-2"></i>No smoking, parties or events.</li>
                                                    <li><i class="la la-dot-circle mr-2"></i>Check-in time is 2 PM - 4 PM and check-out by 10 AM.</li>
                                                </ul>
                                            </div><!-- end single-content-item -->
                                            <div class="section-block"></div>
                                        </div><!-- end description -->

                                    </div><!-- end single-content-wrap -->
                                </div><!-- end col-lg-8 -->
                                <div class="col-lg-4">
                                    <div class="sidebar single-content-sidebar mb-0">
                                        <div class="sidebar-widget single-content-widget">
                                            <h3 class="title stroke-shape">Your Reservation</h3>
                                            <div class="sidebar-widget-item">
                                                <div class="contact-form-action">
                                                    <form action="#">
                                                        <a href="my_login" class="theme-btn theme-btn-small">Login To Reserve This Room</a>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="sidebar-widget single-content-widget">
                                            <h3 class="title stroke-shape">Why Book With Us?</h3>
                                            <div class="sidebar-list">
                                                <ul class="list-items">
                                                    <li><i class="la la-dollar icon-element mr-2"></i> No-hassle best price guarantee</li>
                                                    <li><i class="la la-microphone icon-element mr-2"></i> Customer care available 24/7</li>
                                                    <li><i class="la la-thumbs-up icon-element mr-2"></i> Hand-picked Tours & Activities</li>
                                                    <li><i class="la la-file-text icon-element mr-2"></i> Free Travel Insureance</li>
                                                </ul>
                                            </div><!-- end sidebar-list -->
                                        </div><!-- end sidebar-widget -->
                                        <div class="sidebar-widget single-content-widget">
                                            <h3 class="title stroke-shape">Get a Question?</h3>
                                            <p class="font-size-14 line-height-24">Do not hesitate to give us a call. We are an expert team and we are happy to talk to you.</p>
                                            <div class="sidebar-list pt-3">
                                                <ul class="list-items">
                                                    <li><i class="la la-phone icon-element mr-2"></i><a href="#"> <?php echo $sys->contact_details; ?></a></li>
                                                    <li><i class="la la-envelope icon-element mr-2"></i><a href="mailto:<?php echo $sys->mail; ?>"> <?php echo $sys->mail; ?></a></li>
                                                </ul>
                                            </div><!-- end sidebar-list -->
                                        </div><!-- end sidebar-widget -->
                                    </div><!-- end sidebar -->
                                </div><!-- end col-lg-4 -->
                            </div><!-- end row -->
                        </div><!-- end container -->
                    </div><!-- end single-content-box -->
                <?php } ?>
            </section><!-- end tour-detail-area -->
        <?php
        } ?>

        <div class="section-block"></div>


        <?php require_once('../partials/landing_footer.php'); ?>

        <!-- start back-to-top -->
        <div id="back-to-top">
            <i class="la la-angle-up" title="Go top"></i>
        </div>
        <!-- end back-to-top -->

        <!-- Template JS Files -->
        <?php require_once('../partials/landing_scripts.php'); ?>
    </body>

    </html>
<?php } ?>