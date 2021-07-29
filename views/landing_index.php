<?php
/*
 * Created on Sat Jul 24 2021
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

        <section class="hero-wrapper hero-wrapper2">
            <div class="hero-box pb-0">
                <div id="fullscreen-slide-contain">
                    <ul class="slides-container">
                        <li><img src="../public/images/<?php echo $sys->landing_slide_1; ?>" alt=""></li>
                        <li><img src="../public/images/<?php echo $sys->landing_slide_2; ?>" alt=""></li>
                        <li><img src="../public/images/<?php echo $sys->landing_slide_3; ?>" alt=""></li>
                        <li><img src="../public/images/<?php echo $sys->landing_slide_4; ?>" alt=""></li>
                        <li><img src="../public/images/<?php echo $sys->landing_slide_5; ?>" alt=""></li>
                    </ul>
                </div><!-- End background slider -->
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="hero-content pb-5">
                                <div class="section-heading">
                                    <p class="sec__desc pb-2"><?php echo $sys->landing_des; ?></p>
                                    <h2 class="sec__title"><?php echo $sys->landing_title; ?></h2>
                                </div>
                            </div><!-- end hero-content -->
                        </div><!-- end col-lg-12 -->
                    </div><!-- end row -->
                </div><!-- end container -->
            </div>
        </section><!-- end hero-wrapper -->

        <section class="about-area section--padding overflow-hidden">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="about-content pr-5">
                            <div class="section-heading">
                                <h4 class="font-size-16 pb-2">Our Story</h4>
                                <h2 class="sec__title"><?php echo $sys->landing_about_title; ?></h2>
                                <p class="sec__desc pt-4 pb-2"><?php echo $sys->landing_about; ?></p>
                                <p class="sec__desc"><?php echo $sys->landing_about_desc; ?></p>
                            </div><!-- end section-heading -->
                            <div class="btn-box pt-4">
                                <a href="landing_about" class="theme-btn">Read More <i class="la la-arrow-right ml-1"></i></a>
                            </div>
                        </div>
                    </div><!-- end col-lg-6 -->
                    <div class="col-lg-6">
                        <div class="image-box about-img-box">
                            <img src="../public/images/img5.jpg" alt="about-img" class="img__item img__item-1">
                        </div>
                    </div><!-- end col-lg-6 -->
                </div><!-- end row -->
            </div><!-- end container -->
        </section>

        <div class="section-block"></div>
        <section class="room-type-area section--padding">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-heading text-center">
                            <h2 class="sec__title">Find Your Room Type</h2>
                        </div><!-- end section-heading -->
                    </div><!-- end col-lg-12 -->
                </div><!-- end row -->
                <div class="row padding-top-50px">
                    <?php
                    $ret = "SELECT * FROM iResturant_Room_Category  ";
                    $stmt = $mysqli->prepare($ret);
                    $stmt->execute(); //ok
                    $res = $stmt->get_result();
                    while ($cat = $res->fetch_object()) {
                    ?>
                        <div class="col-lg-6">
                            <div class="room-type-content">
                                <div class="image-box">
                                    <a href="landing_room_category?view=<?php echo $cat->id; ?>" class="d-block">
                                        <img src="../public/images/room.svg" height="200" width="250" alt="room type img" class="img__item">
                                        <div class="room-type-link">
                                            <?php echo $cat->name; ?> <i class="la la-arrow-right ml-2"></i>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div><!-- end col-lg-6 -->
                    <?php } ?>
                </div><!-- end row -->
            </div><!-- end container -->
        </section>

        <section class="discount-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="discount-box">
                            <div class="discount-img">
                                <img src="../public/images/discount-hotel-img.jpg" alt="discount img">
                            </div><!-- end discount-img -->
                            <div class="discount-content">
                                <div class="section-heading">
                                    <p class="sec__desc text-white">Hot deal, save 50%</p>
                                    <h2 class="sec__title mb-0 line-height-50 text-white">Discount 50% for the <br> First Booking</h2>
                                </div><!-- end section-heading -->
                                <div class="btn-box pt-4">
                                    <a href="landing_rooms" class="theme-btn border-0">Learn More <i class="la la-arrow-right ml-1"></i></a>
                                </div>
                            </div><!-- end discount-content -->
                            <div class="company-logo">
                                <p class="text-white font-size-14 text-right"><?php echo $sys->system_name; ?></p>
                                <p class="text-white font-size-14 text-right">*Terms And Conditions Applied</p>
                            </div><!-- end company-logo -->
                        </div>
                    </div><!-- end col-lg-12 -->
                </div><!-- end row -->
            </div><!-- end container -->
        </section><!-- end discount-area -->

        <section class="testimonial-area section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-heading text-center mb-0">
                            <h2 class="sec__title line-height-50">What Our Customers <br> Are Saying </h2>
                        </div><!-- end section-heading -->
                    </div><!-- end col-lg-12 -->
                </div><!-- end row  -->
                <div class="row padding-top-50px">
                    <div class="col-lg-12">
                        <div class="testimonial-carousel carousel-action">
                            <?php
                            /* Load Testimonials */
                            $ret = "SELECT * FROM iResturant_Testimonials t
                            INNER JOIN iResturant_Customer c ON t.testimonial_customer_id = c.id
                            ";
                            $stmt = $mysqli->prepare($ret);
                            $stmt->execute(); //ok
                            $res = $stmt->get_result();
                            while ($testimonials = $res->fetch_object()) {
                                if ($testimonials->profile_pic == '') {
                                    $dir = '../public/uploads/user_images/no-profile.png';
                                } else {
                                    $dir = "../public/uploads/user_images/$testimonials->profile_pic";
                                }
                            ?>
                                <div class="testimonial-card">
                                    <div class="testi-desc-box">
                                        <p class="testi__desc">
                                            <?php echo $testimonials->testimonial_details; ?>
                                        </p>
                                    </div>
                                    <div class="author-content d-flex align-items-center">
                                        <div class="author-img">
                                            <img src="<?php echo $dir; ?>" alt="testimonial image">
                                        </div>
                                        <div class="author-bio">
                                            <h4 class="author__title"><?php echo $testimonials->name; ?></h4>
                                            <span class="ratings d-flex align-items-center">
                                                <i class="la la-star"></i>
                                                <i class="la la-star"></i>
                                                <i class="la la-star"></i>
                                                <i class="la la-star"></i>
                                                <i class="la la-star"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div><!-- end testimonial-card -->
                            <?php
                            } ?>

                        </div><!-- end testimonial-carousel -->
                    </div><!-- end col-lg-12 -->
                </div><!-- end row -->
            </div><!-- end container -->
        </section><!-- end testimonial-area -->


        <div class="section-block"></div>


        <section class="cta-area subscriber-area section-bg-2 padding-top-60px padding-bottom-60px">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-7">
                        <div class="section-heading">
                            <p class="sec__desc text-white-50 pb-1">Newsletter Sign up</p>
                            <h2 class="sec__title font-size-30 text-white">Subscribe to Get Special Offers</h2>
                        </div><!-- end section-heading -->
                    </div><!-- end col-lg-7 -->
                    <div class="col-lg-5">
                        <div class="subscriber-box">
                            <div class="contact-form-action">
                                <form action="#">
                                    <div class="input-box">
                                        <label class="label-text text-white">Enter email address</label>
                                        <div class="form-group mb-0">
                                            <span class="la la-envelope form-icon"></span>
                                            <input class="form-control" type="email" name="email" placeholder="Email address">
                                            <button class="theme-btn theme-btn-small submit-btn" type="submit">Subscribe</button>
                                            <span class="font-size-14 pt-1 text-white-50"><i class="la la-lock mr-1"></i>Don't worry your information is safe with us.</span>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div><!-- end section-heading -->
                    </div><!-- end col-lg-5 -->
                </div><!-- end row -->
            </div><!-- end container -->
        </section><!-- end cta-area -->

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