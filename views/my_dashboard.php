<?php
/*
 * Created on Mon Aug 02 2021
 *
 * The MIT License (MIT)
 * Copyright (c) 2021 Martdevelopers Inc
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
require_once('../config/checklogin.php');
require_once('../partials/my_analytics.php');
require_once('../partials/my_head.php');
?>

<body class="section-bg">
    <!-- start cssload-loader -->
    <div class="preloader" id="preloader">
        <div class="loader">
            <svg class="spinner" viewBox="0 0 50 50">
                <circle class="path" cx="25" cy="25" r="20" fill="none" stroke-width="5"></circle>
            </svg>
        </div>
    </div>
    <!-- end cssload-loader -->

    <?php require_once('../partials/my_sidebar.php');
    $id = $_SESSION['id'];
    $ret = "SELECT * FROM  iResturant_Customer WHERE id = '$id' ";
    $stmt = $mysqli->prepare($ret);
    $stmt->execute(); //ok
    $res = $stmt->get_result();
    while ($customer = $res->fetch_object()) { ?>

        <section class="dashboard-area">
            <div class="dashboard-content-wrap">
                <div class="dashboard-bread">
                    <div class="container-fluid">
                        <div class="row align-items-center">
                            <div class="col-lg-6">
                                <div class="breadcrumb-content">
                                    <div class="section-heading">
                                        <h3 class="sec__title font-size-30 text-white">Hi, <?php echo $customer->name; ?> Welcome Back!</h3>
                                    </div>
                                </div><!-- end breadcrumb-content -->
                            </div><!-- end col-lg-6 -->
                            <div class="col-lg-6">
                                <div class="breadcrumb-list text-right">
                                    <ul class="list-items">
                                        <li><a href="my_dashboard" class="text-white">Home</a></li>
                                        <li>User Dashboard</li>
                                    </ul>
                                </div><!-- end breadcrumb-list -->
                            </div><!-- end col-lg-6 -->
                        </div><!-- end row -->
                        <div class="row mt-4">
                            <div class="col-lg-6 responsive-column-m">
                                <div class="icon-box icon-layout-2 dashboard-icon-box">
                                    <div class="d-flex">
                                        <div class="info-icon icon-element flex-shrink-0">
                                            <i class="la la-shopping-cart"></i>
                                        </div><!-- end info-icon-->
                                        <div class="info-content">
                                            <p class="info__desc">Reservations</p>
                                            <h4 class="info__title"><?php echo $reservations; ?></h4>
                                        </div><!-- end info-content -->
                                    </div>
                                </div>
                            </div><!-- end col-lg-3 -->
                            <div class="col-lg-6 responsive-column-m">
                                <div class="icon-box icon-layout-2 dashboard-icon-box">
                                    <div class="d-flex">
                                        <div class="info-icon icon-element bg-2 flex-shrink-0">
                                            <i class="la la-bookmark"></i>
                                        </div><!-- end info-icon-->
                                        <div class="info-content">
                                            <p class="info__desc">Orders</p>
                                            <h4 class="info__title"><?php echo $my_orders; ?></h4>
                                        </div><!-- end info-content -->
                                    </div>
                                </div>
                            </div><!-- end col-lg-3 -->
                            <div class="col-lg-6 responsive-column-m">
                                <div class="icon-box icon-layout-2 dashboard-icon-box">
                                    <div class="d-flex">
                                        <div class="info-icon icon-element bg-3 flex-shrink-0">
                                            <i class="la la-plane"></i>
                                        </div><!-- end info-icon-->
                                        <div class="info-content">
                                            <p class="info__desc">Reservations Payments</p>
                                            <h4 class="info__title"><?php echo $reservations_payments; ?></h4>
                                        </div><!-- end info-content -->
                                    </div>
                                </div>
                            </div><!-- end col-lg-3 -->
                            <div class="col-lg-6 responsive-column-m">
                                <div class="icon-box icon-layout-2 dashboard-icon-box">
                                    <div class="d-flex">
                                        <div class="info-icon icon-element bg-4 flex-shrink-0">
                                            <i class="la la-star"></i>
                                        </div><!-- end info-icon-->
                                        <div class="info-content">
                                            <p class="info__desc">Orders Payments</p>
                                            <h4 class="info__title"><?php echo $orders_payment; ?></h4>
                                        </div><!-- end info-content -->
                                    </div>
                                </div>
                            </div><!-- end col-lg-3 -->
                        </div><!-- end row -->
                    </div>
                </div><!-- end dashboard-bread -->
                <div class="dashboard-main-content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-6 responsive-column--m">
                                <div class="form-box">
                                    <div class="form-title-wrap">
                                        <h3 class="title">Statics Results</h3>
                                    </div>
                                    <div class="form-content">
                                        <canvas id="bar-chart"></canvas>
                                    </div>
                                </div><!-- end form-box -->
                            </div><!-- end col-lg-6 -->
                            <div class="col-lg-6 responsive-column--m">
                                <div class="form-box dashboard-card">
                                    <div class="form-title-wrap">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h3 class="title">Notifications</h3>
                                            <button type="button" class="icon-element mark-as-read-btn ml-auto mr-0" data-toggle="tooltip" data-placement="left" title="Mark all as read">
                                                <i class="la la-check-square"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="form-content p-0">
                                        <div class="list-group drop-reveal-list">
                                            <a href="#" class="list-group-item list-group-item-action border-top-0">
                                                <div class="msg-body d-flex align-items-center">
                                                    <div class="icon-element flex-shrink-0 mr-3 ml-0"><i class="la la-bell"></i></div>
                                                    <div class="msg-content w-100">
                                                        <h3 class="title pb-1">Group Trip - Available</h3>
                                                        <p class="msg-text">2 min ago</p>
                                                    </div>
                                                    <span class="icon-element mark-as-read-btn flex-shrink-0 ml-auto mr-0" data-toggle="tooltip" data-placement="left" title="Mark as read">
                                                        <i class="la la-check-square"></i>
                                                    </span>
                                                </div><!-- end msg-body -->
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <div class="msg-body d-flex align-items-center">
                                                    <div class="icon-element bg-1 flex-shrink-0 mr-3 ml-0"><i class="la la-bell"></i></div>
                                                    <div class="msg-content w-100">
                                                        <h3 class="title pb-1">50% Discount Offer</h3>
                                                        <p class="msg-text">2 min ago</p>
                                                    </div>
                                                    <span class="icon-element mark-as-read-btn flex-shrink-0 ml-auto mr-0" data-toggle="tooltip" data-placement="left" title="Mark as read">
                                                        <i class="la la-check-square"></i>
                                                    </span>
                                                </div><!-- end msg-body -->
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <div class="msg-body d-flex align-items-center">
                                                    <div class="icon-element bg-2 flex-shrink-0 mr-3 ml-0"><i class="la la-check"></i></div>
                                                    <div class="msg-content w-100">
                                                        <h3 class="title pb-1">Your account has been created</h3>
                                                        <p class="msg-text">1 day ago</p>
                                                    </div>
                                                    <span class="icon-element mark-as-read-btn flex-shrink-0 ml-auto mr-0" data-toggle="tooltip" data-placement="left" title="Mark as read">
                                                        <i class="la la-check-square"></i>
                                                    </span>
                                                </div><!-- end msg-body -->
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <div class="msg-body d-flex align-items-center">
                                                    <div class="icon-element bg-3 flex-shrink-0 mr-3 ml-0"><i class="la la-user"></i></div>
                                                    <div class="msg-content w-100">
                                                        <h3 class="title pb-1">Your account updated</h3>
                                                        <p class="msg-text">2 hrs ago</p>
                                                    </div>
                                                    <span class="icon-element mark-as-read-btn flex-shrink-0 ml-auto mr-0" data-toggle="tooltip" data-placement="left" title="Mark as read">
                                                        <i class="la la-check-square"></i>
                                                    </span>
                                                </div><!-- end msg-body -->
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <div class="msg-body d-flex align-items-center">
                                                    <div class="icon-element bg-4 flex-shrink-0 mr-3 ml-0"><i class="la la-lock"></i></div>
                                                    <div class="msg-content w-100">
                                                        <h3 class="title pb-1">Your password changed</h3>
                                                        <p class="msg-text">Yesterday</p>
                                                    </div>
                                                    <span class="icon-element mark-as-read-btn flex-shrink-0 ml-auto mr-0" data-toggle="tooltip" data-placement="left" title="Mark as read">
                                                        <i class="la la-check-square"></i>
                                                    </span>
                                                </div><!-- end msg-body -->
                                            </a>
                                        </div>
                                    </div>
                                </div><!-- end form-box -->
                            </div><!-- end col-lg-6 -->
                            <div class="col-lg-6 responsive-column--m">
                                <div class="form-box dashboard-card">
                                    <div class="form-title-wrap">
                                        <h3 class="title">Tasks</h3>
                                    </div>
                                    <div class="form-content">
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <i class="la la-check mr-2"></i>Your booking <a href="#" class="alert-link">Shimla to Goa</a> has been done!
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <i class="la la-check mr-2"></i>Sent Email to <strong>dev@gmail.com</strong>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <i class="la la-check mr-2"></i>Received Email from <strong>tripstar@yahoo.com</strong>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <i class="la la-check mr-2"></i>your payment is pending for <a href="#" class="alert-link">Manali</a> Trip tour!
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <i class="la la-check mr-2"></i>Someone reply on your comment on <a href="#" class="alert-link">London Trip</a> Tour!
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <i class="la la-check mr-2"></i>You have canceled <a href="#" class="alert-link">Dubai to london Trip</a>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <i class="la la-check mr-2"></i>You have give a review on <span class="badge badge-warning text-white">4.5</span> <a href="#" class="alert-link">EnVision Hotel Boston</a>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    </div>
                                </div><!-- end form-box -->
                            </div><!-- end col-lg-6 -->
                            <div class="col-lg-6 responsive-column--m">
                                <div class="form-box dashboard-card order-card border-0">
                                    <div class="form-title-wrap">
                                        <h3 class="title">Orders</h3>
                                    </div>
                                    <div class="form-content p-0">
                                        <div class="list-group drop-reveal-list">
                                            <div class="list-group-item list-group-item-action border-top-0">
                                                <div class="msg-body d-flex align-items-center justify-content-between">
                                                    <div class="msg-content">
                                                        <h3 class="title pb-2">3 - Night Bahamas - Miami Round-Trip</h3>
                                                        <ul class="list-items d-flex align-items-center">
                                                            <li class="font-size-14 mr-2"><span class="badge badge-success py-1 px-2 font-size-13 font-weight-medium">Paid</span></li>
                                                            <li class="font-size-14 mr-2">Order: #232</li>
                                                            <li class="font-size-14">Date: 11/05/2019</li>
                                                        </ul>
                                                    </div>
                                                    <a href="#" class="theme-btn theme-btn-small theme-btn-transparent font-size-13">
                                                        View Invoice
                                                    </a>
                                                </div><!-- end msg-body -->
                                            </div>
                                            <div class="list-group-item list-group-item-action">
                                                <div class="msg-body d-flex align-items-center justify-content-between">
                                                    <div class="msg-content">
                                                        <h3 class="title pb-2">California To Newyork</h3>
                                                        <ul class="list-items d-flex align-items-center">
                                                            <li class="font-size-14 mr-2"><span class="badge badge-danger py-1 px-2 font-size-13 font-weight-medium">UnPaid</span></li>
                                                            <li class="font-size-14 mr-2">Order: #232</li>
                                                            <li class="font-size-14">Date: 11/05/2019</li>
                                                        </ul>
                                                    </div>
                                                    <a href="#" class="theme-btn theme-btn-small theme-btn-transparent font-size-13">
                                                        Finish Payment
                                                    </a>
                                                </div><!-- end msg-body -->
                                            </div>
                                            <div class="list-group-item list-group-item-action">
                                                <div class="msg-body d-flex align-items-center justify-content-between">
                                                    <div class="msg-content">
                                                        <h3 class="title pb-2">Two Hour Walking Tour of Manhattan</h3>
                                                        <ul class="list-items d-flex align-items-center">
                                                            <li class="font-size-14 mr-2"><span class="badge badge-success py-1 px-2 font-size-13 font-weight-medium">Paid</span></li>
                                                            <li class="font-size-14 mr-2">Order: #232</li>
                                                            <li class="font-size-14">Date: 11/05/2019</li>
                                                        </ul>
                                                    </div>
                                                    <a href="#" class="theme-btn theme-btn-small theme-btn-transparent font-size-13">
                                                        View Invoice
                                                    </a>
                                                </div><!-- end msg-body -->
                                            </div>
                                            <div class="list-group-item list-group-item-action">
                                                <div class="msg-body d-flex align-items-center justify-content-between">
                                                    <div class="msg-content">
                                                        <h3 class="title pb-2">Dubai to Spain</h3>
                                                        <ul class="list-items d-flex align-items-center">
                                                            <li class="font-size-14 mr-2"><span class="badge badge-success py-1 px-2 font-size-13 font-weight-medium">Paid</span></li>
                                                            <li class="font-size-14 mr-2">Order: #232</li>
                                                            <li class="font-size-14">Date: 11/05/2019</li>
                                                        </ul>
                                                    </div>
                                                    <a href="#" class="theme-btn theme-btn-small theme-btn-transparent font-size-13">
                                                        View Invoice
                                                    </a>
                                                </div><!-- end msg-body -->
                                            </div>
                                            <div class="list-group-item list-group-item-action">
                                                <div class="msg-body d-flex align-items-center justify-content-between">
                                                    <div class="msg-content">
                                                        <h3 class="title pb-2">Parian Holiday Villas</h3>
                                                        <ul class="list-items d-flex align-items-center">
                                                            <li class="font-size-14 mr-2"><span class="badge badge-success py-1 px-2 font-size-13 font-weight-medium">Paid</span></li>
                                                            <li class="font-size-14 mr-2">Order: #232</li>
                                                            <li class="font-size-14">Date: 11/05/2019</li>
                                                        </ul>
                                                    </div>
                                                    <a href="#" class="theme-btn theme-btn-small theme-btn-transparent font-size-13">
                                                        View Invoice
                                                    </a>
                                                </div><!-- end msg-body -->
                                            </div>
                                            <div class="list-group-item list-group-item-action">
                                                <div class="msg-body d-flex align-items-center justify-content-between">
                                                    <div class="msg-content">
                                                        <h3 class="title pb-2">Lake Palace Hotel</h3>
                                                        <ul class="list-items d-flex align-items-center">
                                                            <li class="font-size-14 mr-2"><span class="badge badge-success py-1 px-2 font-size-13 font-weight-medium">Paid</span></li>
                                                            <li class="font-size-14 mr-2">Order: #232</li>
                                                            <li class="font-size-14">Date: 11/05/2019</li>
                                                        </ul>
                                                    </div>
                                                    <a href="#" class="theme-btn theme-btn-small theme-btn-transparent font-size-13">
                                                        View Invoice
                                                    </a>
                                                </div><!-- end msg-body -->
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end form-box -->
                            </div><!-- end col-lg-6 -->
                        </div><!-- end row -->
                        <div class="border-top mt-4"></div>
                        <?php require_once('../partials/my_footer.php'); ?>
                    </div><!-- end container-fluid -->
                </div><!-- end dashboard-main-content -->
            </div><!-- end dashboard-content-wrap -->
        </section>
    <?php } ?>


    <!-- start scroll top -->
    <div id="back-to-top">
        <i class="la la-angle-up" title="Go top"></i>
    </div>
    <!-- end scroll top -->

    <!-- Template JS Files -->
    <?php require_once('../partials/my_scripts.php'); ?>
</body>

</html>