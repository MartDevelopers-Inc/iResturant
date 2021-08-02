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
                                <div class="form-box dashboard-card">
                                    <div class="form-title-wrap">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h3 class="title">My Reservations History</h3>
                                        </div>
                                    </div>
                                    <div class="form-content p-0">
                                        <div class="list-group drop-reveal-list">
                                            <?php
                                            $ret = "SELECT * FROM iResturant_Customer c
                                            INNER JOIN iResturant_Room_Reservation r ON c.id = r.client_id
                                            INNER JOIN iResturant_Room rm
                                            ON r.room_id = rm.id WHERE c.id = '$id'
                                            ORDER BY r.reserved_on ASC LIMIT 10                                                 
                                            ";
                                            $stmt = $mysqli->prepare($ret);
                                            $stmt->execute(); //ok
                                            $res = $stmt->get_result();
                                            while ($reservations = $res->fetch_object()) {
                                            ?>
                                                <a href="my_reservation?view=<?php echo $reservations->code; ?>" class="list-group-item list-group-item-action border-top-0">
                                                    <div class="msg-body d-flex align-items-center">
                                                        <div class="icon-element flex-shrink-0 mr-3 ml-0"><i class="la la-calendar-check"></i></div>
                                                        <div class="msg-content w-100">
                                                            <h3 class="title pb-1"> <?php echo $reservations->code; ?></h3>
                                                            <p class="msg-text">
                                                                You have reserved room number : <?php echo $reservations->number; ?> Your check in time is
                                                                <?php echo date('d M Y', strtotime($reservations->arrival)); ?>.
                                                                Your check out time is <?php echo date('d M Y', strtotime($reservations->departure)); ?>
                                                            </p>
                                                        </div>
                                                    </div><!-- end msg-body -->
                                                </a>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div><!-- end form-box -->
                            </div><!-- end col-lg-6 -->

                            <div class="col-lg-6 responsive-column--m">
                                <div class="form-box dashboard-card">
                                    <div class="form-title-wrap">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h3 class="title">My Orders History</h3>
                                        </div>
                                    </div>
                                    <div class="form-content p-0">
                                        <div class="list-group drop-reveal-list">
                                            <?php
                                            /* Load My Orders History Details */
                                            $ret =
                                                "SELECT * FROM iResturant_Customer c INNER JOIN iResturant_Customer_Orders cs ON cs.customer_id = c.id 
                                            INNER JOIN iResturant_Menu rm
                                            ON rm.meal_id = cs.meal_menu_id WHERE c.id = '$id' ORDER BY cs.created_at DESC LIMIT 10
                                            /* INNER JOIN iResturant_Payments pa ON cs.code = pa.order_code  */";
                                            $stmt = $mysqli->prepare($ret);
                                            $stmt->execute(); //ok
                                            $res = $stmt->get_result();
                                            while ($orders = $res->fetch_object()) {
                                            ?>
                                                <a href="my_order?view=<?php echo $orders->code; ?>" class="list-group-item list-group-item-action border-top-0">
                                                    <div class="msg-body d-flex align-items-center">
                                                        <div class="icon-element flex-shrink-0 mr-3 ml-0"><i class="la la-list-alt"></i></div>
                                                        <div class="msg-content w-100">
                                                            <h3 class="title pb-1"> <?php echo $orders->name; ?></h3>
                                                            <p class="msg-text"> Ordered <?php echo $orders->meal_count . " " . $orders->meal_name; ?></p>
                                                            <p class="msg-text"><?php echo date('d M Y g:ia', strtotime($orders->created_at)); ?></p>
                                                        </div>
                                                    </div><!-- end msg-body -->
                                                </a>
                                            <?php
                                            }
                                            ?>
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