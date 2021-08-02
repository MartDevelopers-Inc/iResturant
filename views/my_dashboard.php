<?php
/*
 * Created on Sat Jul 10 2021
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
require_once('../config/checklogin.php');
client();
require_once('../partials/my_analytics.php');
require_once('../partials/head.php');
?>

<body class="">
    <!-- Left Sidenav -->
    <?php require_once('../partials/my_sidebar.php'); ?>
    <!-- end left-sidenav-->

    <div class="page-wrapper">
        <!-- Top Bar Start -->
        <?php require_once('../partials/my_header.php');
        $id = $_SESSION['id'];
        ?>
        <!-- Top Bar End -->

        <!-- Page Content-->
        <div class="page-content">
            <div class="container-fluid">
                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <div class="row">
                                <div class="col">
                                    <h4 class="page-title">My Dashboard</h4>
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="my_dashboard">Home</a></li>
                                        <li class="breadcrumb-item active">Dashboard</li>
                                    </ol>
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->
                        </div>
                        <!--end page-title-box-->
                    </div>
                    <!--end col-->
                </div>
                <!--end row-->
                <!-- end page title end breadcrumb -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row justify-content-center">
                            <!-- Revenues And Expenses -->
                            <div class="col-md-6 col-lg-3">
                                <div class="card report-card">
                                    <div class="card-body">
                                        <div class="row d-flex justify-content-center">
                                            <div class="col">
                                                <p class="text-dark mb-0 fw-semibold">My Reservations</p>
                                                <h3 class="m-0"><?php echo $reservations; ?> </h3>
                                            </div>
                                            <div class="col-auto align-self-center">
                                                <div class="report-main-icon bg-light-alt">
                                                    <i data-feather="calendar" class="align-self-center text-muted icon-sm"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end card-body-->
                                </div>
                                <!--end card-->
                            </div>
                            <!--end col-->
                            <div class="col-md-6 col-lg-3">
                                <div class="card report-card">
                                    <div class="card-body">
                                        <div class="row d-flex justify-content-center">
                                            <div class="col">
                                                <p class="text-dark mb-0 fw-semibold">My Orders</p>
                                                <h3 class="m-0"><?php echo $my_orders; ?></h3>
                                            </div>
                                            <div class="col-auto align-self-center">
                                                <div class="report-main-icon bg-light-alt">
                                                    <i data-feather="check" class="align-self-center text-muted icon-sm"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end card-body-->
                                </div>
                                <!--end card-->
                            </div>
                            <!--end col-->
                            <div class="col-md-6 col-lg-3">
                                <div class="card report-card">
                                    <div class="card-body">
                                        <div class="row d-flex justify-content-center">
                                            <div class="col">
                                                <p class="text-dark mb-0 fw-semibold">Reservations Debits</p>
                                                <h3 class="m-0"><?php echo $reservations_payments; ?></h3>
                                            </div>
                                            <div class="col-auto align-self-center">
                                                <div class="report-main-icon bg-light-alt">
                                                    <i data-feather="dollar-sign" class="align-self-center text-muted icon-sm"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end card-body-->
                                </div>
                                <!--end card-->
                            </div>
                            <!--end col-->
                            <div class="col-md-6 col-lg-3">
                                <div class="card report-card">
                                    <div class="card-body">
                                        <div class="row d-flex justify-content-center">
                                            <div class="col">
                                                <p class="text-dark mb-0 fw-semibold">Orders Debits</p>
                                                <h3 class="m-0"><?php echo $orders_payment; ?></h3>
                                            </div>
                                            <div class="col-auto align-self-center">
                                                <div class="report-main-icon bg-light-alt">
                                                    <i data-feather="dollar-sign" class="align-self-center text-muted icon-sm"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end card-body-->
                                </div>
                                <!--end card-->
                            </div>
                        </div>
                        <!--end row-->
                    </div>
                </div>
                <!--end row-->

                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h4 class="card-title">My Orders Activity</h4>
                                    </div>
                                </div>
                                <!--end row-->
                            </div>
                            <!--end card-header-->
                            <div class="card-body">
                                <div class="analytic-dash-activity" data-simplebar>
                                    <?php
                                    $ret =
                                        "SELECT * FROM iResturant_Customer c INNER JOIN iResturant_Customer_Orders cs ON cs.customer_id = c.id 
                                    INNER JOIN iResturant_Menu rm
                                    ON rm.meal_id = cs.meal_menu_id WHERE c.id = '$id' ORDER BY cs.created_at DESC LIMIT 10";
                                    $stmt = $mysqli->prepare($ret);
                                    $stmt->execute(); //ok
                                    $res = $stmt->get_result();
                                    while ($orders = $res->fetch_object()) {
                                    ?>
                                        <div class="activity">
                                            <div class="activity-info">
                                                <div class="icon-info-activity">
                                                    <i class="las la-user-check bg-soft-primary"></i>
                                                </div>
                                                <div class="activity-info-text">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <p class="text-muted mb-0 font-13 w-75"><span><?php echo $orders->name; ?><br></span>
                                                            Ordered <?php echo $orders->meal_count . " " . $orders->meal_name; ?>
                                                        </p>

                                                        <small class="text-muted"><?php echo date('d M Y g:ia', strtotime($orders->created_at)); ?></small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                    <?php
                                    } ?>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h4 class="card-title">My Reservation Activity</h4>
                                    </div>
                                </div>
                                <!--end row-->
                            </div>
                            <!--end card-header-->
                            <div class="card-body">
                                <div class="analytic-dash-activity" data-simplebar>
                                    <div class="activity">
                                        <?php

                                        $ret = "SELECT * FROM iResturant_Customer c
                                            INNER JOIN iResturant_Room_Reservation r ON c.id = r.client_id
                                            INNER JOIN iResturant_Room rm
                                            ON r.room_id = rm.id WHERE c.id = '$id' ORDER BY r.reserved_on  ASC LIMIT 10                                                 
                                            ";
                                        $stmt = $mysqli->prepare($ret);
                                        $stmt->execute(); //ok
                                        $res = $stmt->get_result();
                                        while ($reservations = $res->fetch_object()) {
                                        ?>
                                            <div class="activity-info">
                                                <div class="icon-info-activity">
                                                    <i class="las la-user-check bg-soft-primary"></i>
                                                </div>
                                                <div class="activity-info-text">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <p class="text-muted mb-0 font-13 w-75">You
                                                            Reserved Room Number:<?php echo $reservations->number; ?>. Reservation Code: <a href="my_reservation_details?view=<?php echo $reservations->code; ?>"><?php echo $reservations->code; ?>
                                                            </a>
                                                            On <?php echo date('d M Y', strtotime($reservations->reserved_on)); ?>. Your check in time is <?php echo date('d M Y', strtotime($reservations->arrival)); ?>
                                                            and check out is <?php echo date('d M Y', strtotime($reservations->departure)); ?>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                        <?php
                                        } ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- container -->

            <?php require_once('../partials/footer.php'); ?>
            <!--end footer-->
        </div>

        <!-- end page content -->
    </div>
    <!-- end page-wrapper -->
    <?php require_once('../partials/scripts.php'); ?>

</body>


</html>