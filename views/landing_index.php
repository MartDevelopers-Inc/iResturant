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
                        <li><img src="images/hero-bg2.jpg" alt=""></li>
                        <li><img src="images/hero--bg2.jpg" alt=""></li>
                        <li><img src="images/hero--bg3.jpg" alt=""></li>
                    </ul>
                </div><!-- End background slider -->
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="hero-content pb-5">
                                <div class="section-heading">
                                    <p class="sec__desc pb-2">Hotel stays, Dream getaways</p>
                                    <h2 class="sec__title">Find the Perfect Place to Stay <br> for Your Next Trip</h2>
                                </div>
                            </div><!-- end hero-content -->
                            <div class="search-fields-container">
                                <div class="contact-form-action">
                                    <form action="#" class="row">
                                        <div class="col-lg-3 pr-0">
                                            <div class="input-box">
                                                <label class="label-text">Destination / Hotel name</label>
                                                <div class="form-group">
                                                    <span class="la la-map-marker form-icon"></span>
                                                    <input class="form-control" type="text" placeholder="Enter City or property">
                                                </div>
                                            </div>
                                        </div><!-- end col-lg-3 -->
                                        <div class="col-lg-3 pr-0">
                                            <div class="input-box">
                                                <label class="label-text">Check in - Check out</label>
                                                <div class="form-group">
                                                    <span class="la la-calendar form-icon"></span>
                                                    <input class="date-range form-control" type="text" name="daterange" readonly>
                                                </div>
                                            </div>
                                        </div><!-- end col-lg-3 -->
                                        <div class="col-lg-3 pr-0">
                                            <div class="input-box">
                                                <label class="label-text">Room Type</label>
                                                <div class="form-group">
                                                    <div class="select-contain select-contain-shadow w-auto">
                                                        <select class="select-contain-select">
                                                            <option value="0">Select Type</option>
                                                            <option value="1">Single</option>
                                                            <option value="2">Double</option>
                                                            <option value="3">Triple</option>
                                                            <option value="4">Quad</option>
                                                            <option value="5">Queen</option>
                                                            <option value="6">King</option>
                                                            <option value="7">Twin</option>
                                                            <option value="8">Double-double</option>
                                                            <option value="9">Studio</option>
                                                            <option value="10">Suite</option>
                                                            <option value="11">Mini Suite</option>
                                                            <option value="12">President Suite</option>
                                                            <option value="13">President Suite</option>
                                                            <option value="14">Apartments</option>
                                                            <option value="15">Connecting rooms</option>
                                                            <option value="16">Murphy Room</option>
                                                            <option value="17">Accessible Room</option>
                                                            <option value="18">Cabana</option>
                                                            <option value="19">Adjoining rooms</option>
                                                            <option value="20">Adjacent rooms</option>
                                                            <option value="21">Villa</option>
                                                            <option value="22">Executive Floor</option>
                                                            <option value="23">Smoking room</option>
                                                            <option value="24">Non-Smoking Room</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- end col-lg-3 -->
                                        <div class="col-lg-3">
                                            <div class="input-box">
                                                <label class="label-text">Guests</label>
                                                <div class="form-group">
                                                    <div class="dropdown dropdown-contain gty-container">
                                                        <a class="dropdown-toggle dropdown-btn" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                                                            <span class="adult" data-text="Adult" data-text-multi="Adults">0 Adult</span>
                                                            -
                                                            <span class="children" data-text="Child" data-text-multi="Children">0 Children</span>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-wrap">
                                                            <div class="dropdown-item">
                                                                <div class="qty-box d-flex align-items-center justify-content-between">
                                                                    <label>Rooms</label>
                                                                    <div class="qtyBtn d-flex align-items-center">
                                                                        <div class="qtyDec"><i class="la la-minus"></i></div>
                                                                        <input type="text" name="room_number" value="0" class="qty-input">
                                                                        <div class="qtyInc"><i class="la la-plus"></i></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="dropdown-item">
                                                                <div class="qty-box d-flex align-items-center justify-content-between">
                                                                    <label>Adults</label>
                                                                    <div class="qtyBtn d-flex align-items-center">
                                                                        <div class="qtyDec"><i class="la la-minus"></i></div>
                                                                        <input type="text" name="adult_number" value="0">
                                                                        <div class="qtyInc"><i class="la la-plus"></i></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="dropdown-item">
                                                                <div class="qty-box d-flex align-items-center justify-content-between">
                                                                    <label>Children</label>
                                                                    <div class="qtyBtn d-flex align-items-center">
                                                                        <div class="qtyDec"><i class="la la-minus"></i></div>
                                                                        <input type="text" name="child_number" value="0">
                                                                        <div class="qtyInc"><i class="la la-plus"></i></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div><!-- end dropdown -->
                                                </div>
                                            </div>
                                        </div><!-- end col-lg-3 -->
                                    </form>
                                    <div class="btn-box pt-2">
                                        <a href="room-search-result.html" class="theme-btn">Search Now</a>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end col-lg-12 -->
                    </div><!-- end row -->
                </div><!-- end container -->
            </div>
        </section><!-- end hero-wrapper -->
        <!-- ================================
    END HERO-WRAPPER AREA
================================= -->

        <!-- ================================
    START INFO AREA
================================= -->
        <section class="info-area info-bg info-area2 padding-top-80px padding-bottom-45px">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 responsive-column">
                        <div class="icon-box icon-layout-2 d-flex">
                            <div class="info-icon flex-shrink-0 bg-rgb text-color-2">
                                <i class="las la-radiation"></i>
                            </div><!-- end info-icon-->
                            <div class="info-content">
                                <h4 class="info__title">Unique Atmosphere</h4>
                                <p class="info__desc">
                                    Varius quam quisque id diam vel quam
                                </p>
                            </div><!-- end info-content -->
                        </div><!-- end icon-box -->
                    </div><!-- end col-lg-3 -->
                    <div class="col-lg-3 responsive-column">
                        <div class="icon-box icon-layout-2 d-flex">
                            <div class="info-icon flex-shrink-0 bg-rgb-2 text-color-3">
                                <i class="la la-tree"></i>
                            </div><!-- end info-icon-->
                            <div class="info-content">
                                <h4 class="info__title">Environment</h4>
                                <p class="info__desc">
                                    Varius quam quisque id diam vel quam
                                </p>
                            </div><!-- end info-content -->
                        </div><!-- end icon-box -->
                    </div><!-- end col-lg-3 -->
                    <div class="col-lg-3 responsive-column">
                        <div class="icon-box icon-layout-2 d-flex">
                            <div class="info-icon flex-shrink-0 bg-rgb-3 text-color-4">
                                <i class="las la-map-marked-alt"></i>
                            </div><!-- end info-icon-->
                            <div class="info-content">
                                <h4 class="info__title">Great Location</h4>
                                <p class="info__desc">
                                    Varius quam quisque id diam vel quam
                                </p>
                            </div><!-- end info-content -->
                        </div><!-- end icon-box -->
                    </div><!-- end col-lg-3 -->
                    <div class="col-lg-3 responsive-column">
                        <div class="icon-box icon-layout-2 d-flex">
                            <div class="info-icon flex-shrink-0 bg-rgb-4 text-color-5">
                                <i class="las la-bed"></i>
                            </div><!-- end info-icon-->
                            <div class="info-content">
                                <h4 class="info__title">Homey Comfort</h4>
                                <p class="info__desc">
                                    Varius quam quisque id diam vel quam
                                </p>
                            </div><!-- end info-content -->
                        </div><!-- end icon-box -->
                    </div><!-- end col-lg-3 -->
                </div><!-- end row -->
            </div><!-- end container -->
        </section><!-- end info-area -->
        <!-- ================================
    END INFO AREA
================================= -->

        <!-- ================================
    START ABOUT AREA
================================= -->
        <section class="about-area section--padding overflow-hidden">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="about-content pr-5">
                            <div class="section-heading">
                                <h4 class="font-size-16 pb-2">Our Story</h4>
                                <h2 class="sec__title">Atmosphere and Design</h2>
                                <p class="sec__desc pt-4 pb-2">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters</p>
                                <p class="sec__desc">Lorem ipsum dolor sit amet, consectetur adipisicing elit. A accusamus amet consectetur ipsa officia. Doloremque error porro sit soluta totam! A iste nobis vel voluptatem!</p>
                            </div><!-- end section-heading -->
                            <div class="btn-box pt-4">
                                <a href="about.html" class="theme-btn">Read More <i class="la la-arrow-right ml-1"></i></a>
                            </div>
                        </div>
                    </div><!-- end col-lg-6 -->
                    <div class="col-lg-6">
                        <div class="image-box about-img-box">
                            <img src="images/img5.jpg" alt="about-img" class="img__item img__item-1">
                            <img src="images/tripadvisor.png" alt="about-img" class="img__item img__item-2">
                        </div>
                    </div><!-- end col-lg-6 -->
                </div><!-- end row -->
            </div><!-- end container -->
        </section>
        <!-- ================================
    END ABOUT AREA
================================= -->

        <div class="section-block"></div>

        <!-- ================================
    START ROOM TYPE AREA
================================= -->
        <section class="room-type-area section--padding">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-heading text-center">
                            <h2 class="sec__title">Find a Room Type</h2>
                        </div><!-- end section-heading -->
                    </div><!-- end col-lg-12 -->
                </div><!-- end row -->
                <div class="row padding-top-50px">
                    <div class="col-lg-6">
                        <div class="room-type-content">
                            <div class="image-box">
                                <a href="room-list.html" class="d-block">
                                    <img src="images/img27.jpg" alt="room type img" class="img__item">
                                    <div class="room-type-link">
                                        Dorm Beds <i class="la la-arrow-right ml-2"></i>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div><!-- end col-lg-6 -->
                    <div class="col-lg-6">
                        <div class="room-type-content">
                            <div class="image-box">
                                <a href="room-list.html" class="d-block">
                                    <img src="images/img28.jpg" alt="room type img" class="img__item">
                                    <div class="room-type-link">
                                        Private Room <i class="la la-arrow-right ml-2"></i>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div><!-- end col-lg-6 -->
                </div><!-- end row -->
            </div><!-- end container -->
        </section>
        <!-- ================================
    END ROOM TYPE AREA
================================= -->

        <!-- ================================
    START HOTEL AREA
================================= -->
        <section class="hotel-area section-bg padding-top-100px padding-bottom-200px overflow-hidden">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-heading text-center">
                            <h2 class="sec__title line-height-55">Popular Hotel Destinations <br> You Might Like</h2>
                        </div><!-- end section-heading -->
                    </div><!-- end col-lg-12 -->
                </div><!-- end row -->
                <div class="row padding-top-50px">
                    <div class="col-lg-12">
                        <div class="hotel-card-wrap">
                            <div class="hotel-card-carousel-2 carousel-action">
                                <div class="card-item">
                                    <div class="card-img">
                                        <a href="hotel-single.html" class="d-block">
                                            <img src="images/img1.jpg" alt="hotel-img">
                                        </a>
                                        <span class="badge">Bestseller</span>
                                        <span class="badge badge-ribbon">30% off</span>
                                    </div>
                                    <div class="card-body">
                                        <h3 class="card-title"><a href="hotel-single.html">The Millennium Hilton New York</a></h3>
                                        <p class="card-meta">124 E Huron St, New york</p>
                                        <div class="card-rating">
                                            <span class="badge text-white">4.4/5</span>
                                            <span class="review__text">Average</span>
                                            <span class="rating__text">(30 Reviews)</span>
                                        </div>
                                        <div class="card-price d-flex align-items-center justify-content-between">
                                            <p>
                                                <span class="price__num">$90.00</span>
                                                <span class="price__num before-price color-text-3">$120.00</span>
                                                <span class="price__text">Per night</span>
                                            </p>
                                            <a href="hotel-single.html" class="btn-text">See details<i class="la la-angle-right"></i></a>
                                        </div>
                                    </div>
                                </div><!-- end card-item -->
                                <div class="card-item">
                                    <div class="card-img">
                                        <a href="hotel-single.html" class="d-block">
                                            <img src="images/img2.jpg" alt="hotel-img">
                                        </a>
                                    </div>
                                    <div class="card-body">
                                        <h3 class="card-title"><a href="hotel-single.html">Best Western Grant Park Hotel</a></h3>
                                        <p class="card-meta">124 E Huron St, Chicago</p>
                                        <div class="card-rating">
                                            <span class="badge text-white">4.4/5</span>
                                            <span class="review__text">Average</span>
                                            <span class="rating__text">(30 Reviews)</span>
                                        </div>
                                        <div class="card-price d-flex align-items-center justify-content-between">
                                            <p>
                                                <span class="price__from">From</span>
                                                <span class="price__num">$58.00</span>
                                                <span class="price__text">Per night</span>
                                            </p>
                                            <a href="hotel-single.html" class="btn-text">See details<i class="la la-angle-right"></i></a>
                                        </div>
                                    </div>
                                </div><!-- end card-item -->
                                <div class="card-item">
                                    <div class="card-img">
                                        <a href="hotel-single.html" class="d-block">
                                            <img src="images/img3.jpg" alt="hotel-img">
                                        </a>
                                        <span class="badge">Featured</span>
                                        <span class="badge badge-ribbon">20% off</span>
                                    </div>
                                    <div class="card-body">
                                        <h3 class="card-title"><a href="hotel-single.html">Hyatt Regency Maui Resort & Spa</a></h3>
                                        <p class="card-meta">200 Nohea Kai Dr, Lahaina, HI</p>
                                        <div class="card-rating">
                                            <span class="badge text-white">4.4/5</span>
                                            <span class="review__text">Average</span>
                                            <span class="rating__text">(30 Reviews)</span>
                                        </div>
                                        <div class="card-price d-flex align-items-center justify-content-between">
                                            <p>
                                                <span class="price__num">$80.00</span>
                                                <span class="price__num before-price color-text-3">$100.00</span>
                                                <span class="price__text">Per night</span>
                                            </p>
                                            <a href="hotel-single.html" class="btn-text">See details<i class="la la-angle-right"></i></a>
                                        </div>
                                    </div>
                                </div><!-- end card-item -->
                                <div class="card-item">
                                    <div class="card-img">
                                        <a href="hotel-single.html" class="d-block">
                                            <img src="images/img4.jpg" alt="hotel-img">
                                        </a>
                                        <span class="badge">Popular</span>
                                    </div>
                                    <div class="card-body">
                                        <h3 class="card-title"><a href="hotel-single.html">Four Seasons Resort Maui at Wailea</a></h3>
                                        <p class="card-meta">3900 Wailea Alanui Drive, Kihei, HI</p>
                                        <div class="card-rating">
                                            <span class="badge text-white">4.4/5</span>
                                            <span class="review__text">Average</span>
                                            <span class="rating__text">(30 Reviews)</span>
                                        </div>
                                        <div class="card-price d-flex align-items-center justify-content-between">
                                            <p>
                                                <span class="price__from">From</span>
                                                <span class="price__num">$88.00</span>
                                                <span class="price__text">Per night</span>
                                            </p>
                                            <a href="hotel-single.html" class="btn-text">See details<i class="la la-angle-right"></i></a>
                                        </div>
                                    </div>
                                </div><!-- end card-item -->
                                <div class="card-item">
                                    <div class="card-img">
                                        <a href="hotel-single.html" class="d-block">
                                            <img src="images/img5.jpg" alt="hotel-img">
                                        </a>
                                    </div>
                                    <div class="card-body">
                                        <h3 class="card-title"><a href="hotel-single.html">Ibis Styles London Heathrow</a></h3>
                                        <p class="card-meta"> 272 Bath Road, Harlington, England</p>
                                        <div class="card-rating">
                                            <span class="badge text-white">4.4/5</span>
                                            <span class="review__text">Average</span>
                                            <span class="rating__text">(30 Reviews)</span>
                                        </div>
                                        <div class="card-price d-flex align-items-center justify-content-between">
                                            <p>
                                                <span class="price__from">From</span>
                                                <span class="price__num">$88.00</span>
                                                <span class="price__text">Per night</span>
                                            </p>
                                            <a href="hotel-single.html" class="btn-text">See details<i class="la la-angle-right"></i></a>
                                        </div>
                                    </div>
                                </div><!-- end card-item -->
                                <div class="card-item">
                                    <div class="card-img">
                                        <a href="hotel-single.html" class="d-block">
                                            <img src="images/img6.jpg" alt="hotel-img">
                                        </a>
                                        <span class="badge badge-ribbon">10% off</span>
                                    </div>
                                    <div class="card-body">
                                        <h3 class="card-title"><a href="hotel-single.html">Hotel Europe Saint Severin Paris</a></h3>
                                        <p class="card-meta">38-40 Rue Saint Séverin, Paris, Paris</p>
                                        <div class="card-rating">
                                            <span class="badge text-white">4.4/5</span>
                                            <span class="review__text">Average</span>
                                            <span class="rating__text">(30 Reviews)</span>
                                        </div>
                                        <div class="card-price d-flex align-items-center justify-content-between">
                                            <p>
                                                <span class="price__num">$70.00</span>
                                                <span class="price__num before-price color-text-3">$80.00</span>
                                                <span class="price__text">Per night</span>
                                            </p>
                                            <a href="hotel-single.html" class="btn-text">See details<i class="la la-angle-right"></i></a>
                                        </div>
                                    </div>
                                </div><!-- end card-item -->
                            </div><!-- end hotel-card-carousel -->
                        </div>
                    </div><!-- end col-lg-12 -->
                </div><!-- end row -->
            </div><!-- end container-fluid -->
        </section><!-- end hotel-area -->
        <!-- ================================
    END HOTEL AREA
================================= -->

        <!-- ================================
    START DISCOUNT AREA
================================= -->
        <section class="discount-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="discount-box">
                            <div class="discount-img">
                                <img src="images/discount-hotel-img.jpg" alt="discount img">
                            </div><!-- end discount-img -->
                            <div class="discount-content">
                                <div class="section-heading">
                                    <p class="sec__desc text-white">Hot deal, save 50%</p>
                                    <h2 class="sec__title mb-0 line-height-50 text-white">Discount 50% for the <br> First Booking</h2>
                                </div><!-- end section-heading -->
                                <div class="btn-box pt-4">
                                    <a href="#" class="theme-btn border-0">Learn More <i class="la la-arrow-right ml-1"></i></a>
                                </div>
                            </div><!-- end discount-content -->
                            <div class="company-logo">
                                <img src="images/logo2.png" alt="">
                                <p class="text-white font-size-14 text-right">*Terms applied</p>
                            </div><!-- end company-logo -->
                        </div>
                    </div><!-- end col-lg-12 -->
                </div><!-- end row -->
            </div><!-- end container -->
        </section><!-- end discount-area -->
        <!-- ================================
    END DISCOUNT AREA
================================= -->

        <!-- ================================
       START TESTIMONIAL AREA
================================= -->
        <section class="testimonial-area section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-heading text-center mb-0">
                            <h2 class="sec__title line-height-50">What Our Customers <br> are Saying Us?</h2>
                        </div><!-- end section-heading -->
                    </div><!-- end col-lg-12 -->
                </div><!-- end row  -->
                <div class="row padding-top-50px">
                    <div class="col-lg-12">
                        <div class="testimonial-carousel carousel-action">
                            <div class="testimonial-card">
                                <div class="testi-desc-box">
                                    <p class="testi__desc">Excepteur sint occaecat cupidatat non proident sunt in culpa officia deserunt mollit anim laborum sint occaecat cupidatat non proident. Occaecat cupidatat non proident des.</p>
                                </div>
                                <div class="author-content d-flex align-items-center">
                                    <div class="author-img">
                                        <img src="images/team8.jpg" alt="testimonial image">
                                    </div>
                                    <div class="author-bio">
                                        <h4 class="author__title">Leroy Bell</h4>
                                        <span class="author__meta">United States</span>
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
                            <div class="testimonial-card">
                                <div class="testi-desc-box">
                                    <p class="testi__desc">Excepteur sint occaecat cupidatat non proident sunt in culpa officia deserunt mollit anim laborum sint occaecat cupidatat non proident. Occaecat cupidatat non proident des.</p>
                                </div>
                                <div class="author-content d-flex align-items-center">
                                    <div class="author-img">
                                        <img src="images/team9.jpg" alt="testimonial image">
                                    </div>
                                    <div class="author-bio">
                                        <h4 class="author__title">Richard Pam</h4>
                                        <span class="author__meta">Canada</span>
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
                            <div class="testimonial-card">
                                <div class="testi-desc-box">
                                    <p class="testi__desc">Excepteur sint occaecat cupidatat non proident sunt in culpa officia deserunt mollit anim laborum sint occaecat cupidatat non proident. Occaecat cupidatat non proident des.</p>
                                </div>
                                <div class="author-content d-flex align-items-center">
                                    <div class="author-img">
                                        <img src="images/team10.jpg" alt="testimonial image">
                                    </div>
                                    <div class="author-bio">
                                        <h4 class="author__title">Luke Jacobs</h4>
                                        <span class="author__meta">Australia</span>
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
                            <div class="testimonial-card">
                                <div class="testi-desc-box">
                                    <p class="testi__desc">Excepteur sint occaecat cupidatat non proident sunt in culpa officia deserunt mollit anim laborum sint occaecat cupidatat non proident. Occaecat cupidatat non proident des.</p>
                                </div>
                                <div class="author-content d-flex align-items-center">
                                    <div class="author-img">
                                        <img src="images/team8.jpg" alt="testimonial image">
                                    </div>
                                    <div class="author-bio">
                                        <h4 class="author__title">Chulbul Panday</h4>
                                        <span class="author__meta">Italy</span>
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
                        </div><!-- end testimonial-carousel -->
                    </div><!-- end col-lg-12 -->
                </div><!-- end row -->
            </div><!-- end container -->
        </section><!-- end testimonial-area -->
        <!-- ================================
       START TESTIMONIAL AREA
================================= -->

        <div class="section-block"></div>

        <!-- ================================
       START BLOG AREA
================================= -->
        <section class="blog-area section--padding">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-heading text-center">
                            <h2 class="sec__title">Recent Articles</h2>
                        </div><!-- end section-heading -->
                    </div><!-- end col-lg-12 -->
                </div><!-- end row -->
                <div class="row padding-top-50px">
                    <div class="col-lg-4 responsive-column">
                        <div class="card-item blog-card">
                            <div class="card-img">
                                <img src="images/img5.jpg" alt="blog-img">
                                <div class="post-format icon-element">
                                    <i class="la la-photo"></i>
                                </div>
                                <div class="card-body">
                                    <div class="post-categories">
                                        <a href="#" class="badge">Travel</a>
                                        <a href="#" class="badge">lifestyle</a>
                                    </div>
                                    <h3 class="card-title line-height-26"><a href="blog-single.html">Best Scandinavian Accommodation – Treat Yourself</a></h3>
                                    <p class="card-meta">
                                        <span class="post__date"> 1 January, 2020</span>
                                        <span class="post-dot"></span>
                                        <span class="post__time">5 Mins read</span>
                                    </p>
                                </div>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <div class="author-content d-flex align-items-center">
                                    <div class="author-img">
                                        <img src="images/small-team1.jpg" alt="testimonial image">
                                    </div>
                                    <div class="author-bio">
                                        <a href="#" class="author__title">Leroy Bell</a>
                                    </div>
                                </div>
                                <div class="post-share">
                                    <ul>
                                        <li>
                                            <i class="la la-share icon-element"></i>
                                            <ul class="post-share-dropdown d-flex align-items-center">
                                                <li><a href="#"><i class="lab la-facebook-f"></i></a></li>
                                                <li><a href="#"><i class="lab la-twitter"></i></a></li>
                                                <li><a href="#"><i class="lab la-instagram"></i></a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div><!-- end card-item -->
                    </div><!-- end col-lg-4 -->
                    <div class="col-lg-4 responsive-column">
                        <div class="card-item blog-card">
                            <div class="card-img">
                                <img src="images/img6.jpg" alt="blog-img">
                                <div class="post-format icon-element">
                                    <i class="la la-play"></i>
                                </div>
                                <div class="card-body">
                                    <div class="post-categories">
                                        <a href="#" class="badge">Video</a>
                                    </div>
                                    <h3 class="card-title line-height-26"><a href="blog-single.html">Amazing Places to Stay in Norway</a></h3>
                                    <p class="card-meta">
                                        <span class="post__date"> 1 February, 2020</span>
                                        <span class="post-dot"></span>
                                        <span class="post__time">4 Mins read</span>
                                    </p>
                                </div>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <div class="author-content d-flex align-items-center">
                                    <div class="author-img">
                                        <img src="images/small-team2.jpg" alt="testimonial image">
                                    </div>
                                    <div class="author-bio">
                                        <a href="#" class="author__title">Phillip Hunt</a>
                                    </div>
                                </div>
                                <div class="post-share">
                                    <ul>
                                        <li>
                                            <i class="la la-share icon-element"></i>
                                            <ul class="post-share-dropdown d-flex align-items-center">
                                                <li><a href="#"><i class="lab la-facebook-f"></i></a></li>
                                                <li><a href="#"><i class="lab la-twitter"></i></a></li>
                                                <li><a href="#"><i class="lab la-instagram"></i></a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div><!-- end card-item -->
                    </div><!-- end col-lg-4 -->
                    <div class="col-lg-4 responsive-column">
                        <div class="card-item blog-card">
                            <div class="card-img">
                                <img src="images/img7.jpg" alt="blog-img">
                                <div class="post-format icon-element">
                                    <i class="la la-music"></i>
                                </div>
                                <div class="card-body">
                                    <div class="post-categories">
                                        <a href="#" class="badge">audio</a>
                                    </div>
                                    <h3 class="card-title line-height-26"><a href="blog-single.html">Feel Like Home on Your Business Trip</a></h3>
                                    <p class="card-meta">
                                        <span class="post__date"> 1 March, 2020</span>
                                        <span class="post-dot"></span>
                                        <span class="post__time">3 Mins read</span>
                                    </p>
                                </div>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <div class="author-content d-flex align-items-center">
                                    <div class="author-img">
                                        <img src="images/small-team3.jpg" alt="testimonial image">
                                    </div>
                                    <div class="author-bio">
                                        <a href="#" class="author__title">Luke Jacobs</a>
                                    </div>
                                </div>
                                <div class="post-share">
                                    <ul>
                                        <li>
                                            <i class="la la-share icon-element"></i>
                                            <ul class="post-share-dropdown d-flex align-items-center">
                                                <li><a href="#"><i class="lab la-facebook-f"></i></a></li>
                                                <li><a href="#"><i class="lab la-twitter"></i></a></li>
                                                <li><a href="#"><i class="lab la-instagram"></i></a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div><!-- end card-item -->
                    </div><!-- end col-lg-4 -->
                </div><!-- end row -->
            </div><!-- end container -->
        </section><!-- end blog-area -->
        <!-- ================================
       START BLOG AREA
================================= -->

        <!-- ================================
    START CTA AREA
================================= -->
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

        <!-- end modal-shared -->
        <div class="modal-popup">
            <div class="modal fade" id="signupPopupForm" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div>
                                <h5 class="modal-title title" id="exampleModalLongTitle">Sign Up</h5>
                                <p class="font-size-14">Hello! Welcome Create a New Account</p>
                            </div>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true" class="la la-close"></span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="contact-form-action">
                                <form method="post">
                                    <div class="input-box">
                                        <label class="label-text">Username</label>
                                        <div class="form-group">
                                            <span class="la la-user form-icon"></span>
                                            <input class="form-control" type="text" name="text" placeholder="Type your username">
                                        </div>
                                    </div><!-- end input-box -->
                                    <div class="input-box">
                                        <label class="label-text">Email Address</label>
                                        <div class="form-group">
                                            <span class="la la-envelope form-icon"></span>
                                            <input class="form-control" type="text" name="text" placeholder="Type your email">
                                        </div>
                                    </div><!-- end input-box -->
                                    <div class="input-box">
                                        <label class="label-text">Password</label>
                                        <div class="form-group">
                                            <span class="la la-lock form-icon"></span>
                                            <input class="form-control" type="text" name="text" placeholder="Type password">
                                        </div>
                                    </div><!-- end input-box -->
                                    <div class="input-box">
                                        <label class="label-text">Repeat Password</label>
                                        <div class="form-group">
                                            <span class="la la-lock form-icon"></span>
                                            <input class="form-control" type="text" name="text" placeholder="Type again password">
                                        </div>
                                    </div><!-- end input-box -->
                                    <div class="btn-box pt-3 pb-4">
                                        <button type="button" class="theme-btn w-100">Register Account</button>
                                    </div>
                                    <div class="action-box text-center">
                                        <p class="font-size-14">Or Sign up Using</p>
                                        <ul class="social-profile py-3">
                                            <li><a href="#" class="bg-5 text-white"><i class="lab la-facebook-f"></i></a></li>
                                            <li><a href="#" class="bg-6 text-white"><i class="lab la-twitter"></i></a></li>
                                            <li><a href="#" class="bg-7 text-white"><i class="lab la-instagram"></i></a></li>
                                            <li><a href="#" class="bg-5 text-white"><i class="lab la-linkedin-in"></i></a></li>
                                        </ul>
                                    </div>
                                </form>
                            </div><!-- end contact-form-action -->
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- end modal-popup -->

        <!-- end modal-shared -->
        <div class="modal-popup">
            <div class="modal fade" id="loginPopupForm" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div>
                                <h5 class="modal-title title" id="exampleModalLongTitle2">Login</h5>
                                <p class="font-size-14">Hello! Welcome to your account</p>
                            </div>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true" class="la la-close"></span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="contact-form-action">
                                <form method="post">
                                    <div class="input-box">
                                        <label class="label-text">Username</label>
                                        <div class="form-group">
                                            <span class="la la-user form-icon"></span>
                                            <input class="form-control" type="text" name="text" placeholder="Type your username">
                                        </div>
                                    </div><!-- end input-box -->
                                    <div class="input-box">
                                        <label class="label-text">Password</label>
                                        <div class="form-group mb-2">
                                            <span class="la la-lock form-icon"></span>
                                            <input class="form-control" type="text" name="text" placeholder="Type your password">
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="custom-checkbox mb-0">
                                                <input type="checkbox" id="rememberchb">
                                                <label for="rememberchb">Remember me</label>
                                            </div>
                                            <p class="forgot-password">
                                                <a href="recover.html">Forgot Password?</a>
                                            </p>
                                        </div>
                                    </div><!-- end input-box -->
                                    <div class="btn-box pt-3 pb-4">
                                        <button type="button" class="theme-btn w-100">Login Account</button>
                                    </div>
                                    <div class="action-box text-center">
                                        <p class="font-size-14">Or Login Using</p>
                                        <ul class="social-profile py-3">
                                            <li><a href="#" class="bg-5 text-white"><i class="lab la-facebook-f"></i></a></li>
                                            <li><a href="#" class="bg-6 text-white"><i class="lab la-twitter"></i></a></li>
                                            <li><a href="#" class="bg-7 text-white"><i class="lab la-instagram"></i></a></li>
                                            <li><a href="#" class="bg-5 text-white"><i class="lab la-linkedin-in"></i></a></li>
                                        </ul>
                                    </div>
                                </form>
                            </div><!-- end contact-form-action -->
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- end modal-popup -->


        <!-- Template JS Files -->
        <?php require_once('../partials/landing_scripts.php'); ?>
    </body>

    </html>
<?php } ?>