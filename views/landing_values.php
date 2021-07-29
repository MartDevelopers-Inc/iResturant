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

require_once('../config/config.php');
/* Load System COnfigurations And Settings */
$ret = "SELECT * FROM `iResturant_System_Details`  ";
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
        <!-- end cssload-loader -->

        <?php require_once('../partials/landing_header.php'); ?>

        <section class="breadcrumb-area bread-bg-9">
            <div class="breadcrumb-wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="breadcrumb-content">
                                <div class="section-heading">
                                    <h2 class="sec__title line-height-50 text-white"><?php echo $sys->system_name; ?><br>Values</h2>
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
        <section class="about-area padding-bottom-90px overflow-hidden">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-heading margin-bottom-40px">
                            <br>
                            <h2 class="sec__title">Our Values</h2>
                            <p class="sec__desc font-size-16">
                                <?php echo $sys->sys_values; ?>
                            </p>
                        </div><!-- end section-heading -->
                    </div><!-- end col-lg-6 -->
                </div><!-- end row -->
            </div><!-- end container -->
        </section><!-- end about-area -->

        <section class="funfact-area padding-bottom-70px">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-heading text-center">
                            <h2 class="sec__title">Our Numbers Say Everything</h2>
                        </div><!-- end section-heading -->
                    </div><!-- end col-lg-12 -->
                </div><!-- end row -->
                <div class="counter-box counter-box-2 margin-top-60px mb-0">
                    <div class="row">
                        <div class="col-lg-3 responsive-column">
                            <div class="counter-item counter-item-layout-2 d-flex">
                                <div class="counter-icon flex-shrink-0">
                                    <i class="la la-users"></i>
                                </div>
                                <div class="counter-content">
                                    <div>
                                        <span class="counter" data-from="0" data-to="<?php echo $sys->patners; ?>" data-refresh-interval="5">0</span>
                                        <span class="count-symbol">+</span>
                                    </div>
                                    <p class="counter__title">Partners</p>
                                </div><!-- end counter-content -->
                            </div><!-- end counter-item -->
                        </div><!-- end col-lg-3 -->
                        <div class="col-lg-3 responsive-column">
                            <div class="counter-item counter-item-layout-2 d-flex">
                                <div class="counter-icon flex-shrink-0">
                                    <i class="la la-building"></i>
                                </div>
                                <div class="counter-content">
                                    <div>
                                        <span class="counter" data-from="0" data-to="<?php echo $sys->properties; ?>" data-refresh-interval="5">0</span>
                                        <span class="count-symbol">k</span>
                                    </div>
                                    <p class="counter__title">Properties</p>
                                </div><!-- end counter-content -->
                            </div><!-- end counter-item -->
                        </div><!-- end col-lg-3 -->
                        <div class="col-lg-3 responsive-column">
                            <div class="counter-item counter-item-layout-2 d-flex">
                                <div class="counter-icon flex-shrink-0">
                                    <i class="la la-globe"></i>
                                </div>
                                <div class="counter-content">
                                    <div>
                                        <span class="counter" data-from="0" data-to="<?php echo $sys->orders_made; ?>" data-refresh-interval="5">0</span>
                                        <span class="count-symbol">k</span>
                                    </div>
                                    <p class="counter__title">Orders Made</p>
                                </div><!-- end counter-content -->
                            </div><!-- end counter-item -->
                        </div><!-- end col-lg-3 -->
                        <div class="col-lg-3 responsive-column">
                            <div class="counter-item counter-item-layout-2 d-flex">
                                <div class="counter-icon flex-shrink-0">
                                    <i class="la la-check-circle"></i>
                                </div>
                                <div class="counter-content">
                                    <div>
                                        <span class="counter" data-from="0" data-to="<?php echo $sys->bookings; ?>" data-refresh-interval="5">0</span>
                                        <span class="count-symbol">k</span>
                                    </div>
                                    <p class="counter__title">Booking</p>
                                </div><!-- end counter-content -->
                            </div><!-- end counter-item -->
                        </div><!-- end col-lg-3 -->
                    </div><!-- end row -->
                </div><!-- end counter-box -->
            </div><!-- end container -->
        </section>

        <?php require_once('../partials/landing_footer.php'); ?>

        <!-- start back-to-top -->
        <div id="back-to-top">
            <i class="la la-angle-up" title="Go top"></i>
        </div>
        <!-- end back-to-top -->

        <?php require_once('../partials/landing_scripts.php'); ?>
    </body>

    </html>
<?php } ?>