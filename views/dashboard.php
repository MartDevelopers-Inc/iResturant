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
admin_check_login();
require_once('../partials/analytics.php');
require_once('../partials/head.php');
?>

<body class="">
    <!-- Left Sidenav -->
    <?php require_once('../partials/aside.php'); ?>
    <!-- end left-sidenav-->


    <div class="page-wrapper">
        <!-- Top Bar Start -->
        <?php require_once('../partials/header.php'); ?>
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
                                    <h4 class="page-title">Administrator Dashboard</h4>
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
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
                                                <p class="text-dark mb-0 fw-semibold">Rooms Revenue</p>
                                                <h3 class="m-0"><?php echo $rr; ?> </h3>
                                            </div>
                                            <div class="col-auto align-self-center">
                                                <div class="report-main-icon bg-light-alt">
                                                    <i data-feather="users" class="align-self-center text-muted icon-sm"></i>
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
                                                <p class="text-dark mb-0 fw-semibold">Hotel Sales Revenue</p>
                                                <h3 class="m-0"><?php echo $hsr; ?></h3>
                                            </div>
                                            <div class="col-auto align-self-center">
                                                <div class="report-main-icon bg-light-alt">
                                                    <i data-feather="clock" class="align-self-center text-muted icon-sm"></i>
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
                                                <p class="text-dark mb-0 fw-semibold">Supplier Expenses</p>
                                                <h3 class="m-0"><?php echo $se; ?></h3>
                                            </div>
                                            <div class="col-auto align-self-center">
                                                <div class="report-main-icon bg-light-alt">
                                                    <i data-feather="activity" class="align-self-center text-muted icon-sm"></i>
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
                                                <p class="text-dark mb-0 fw-semibold">Payrolls Expenses</p>
                                                <h3 class="m-0"><?php echo $pe; ?></h3>
                                            </div>
                                            <div class="col-auto align-self-center">
                                                <div class="report-main-icon bg-light-alt">
                                                    <i data-feather="briefcase" class="align-self-center text-muted icon-sm"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end card-body-->
                                </div>
                                <!--end card-->
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <!-- Rooms -->
                            <div class="col-md-6 col-lg-3">
                                <div class="card report-card">
                                    <div class="card-body">
                                        <div class="row d-flex justify-content-center">
                                            <div class="col">
                                                <p class="text-dark mb-0 fw-semibold">Rooms</p>
                                                <h3 class="m-0"><?php echo $tr; ?> </h3>
                                            </div>
                                            <div class="col-auto align-self-center">
                                                <div class="report-main-icon bg-light-alt">
                                                    <i data-feather="users" class="align-self-center text-muted icon-sm"></i>
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
                                                <p class="text-dark mb-0 fw-semibold">Reserved Rooms</p>
                                                <h3 class="m-0"><?php echo $resr; ?></h3>
                                            </div>
                                            <div class="col-auto align-self-center">
                                                <div class="report-main-icon bg-light-alt">
                                                    <i data-feather="clock" class="align-self-center text-muted icon-sm"></i>
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
                                                <p class="text-dark mb-0 fw-semibold">Vacant Rooms</p>
                                                <h3 class="m-0"><?php echo $vr; ?></h3>
                                            </div>
                                            <div class="col-auto align-self-center">
                                                <div class="report-main-icon bg-light-alt">
                                                    <i data-feather="activity" class="align-self-center text-muted icon-sm"></i>
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
                                                <p class="text-dark mb-0 fw-semibold">On Renovation Rooms</p>
                                                <h3 class="m-0"><?php echo $urr; ?></h3>
                                            </div>
                                            <div class="col-auto align-self-center">
                                                <div class="report-main-icon bg-light-alt">
                                                    <i data-feather="briefcase" class="align-self-center text-muted icon-sm"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end card-body-->
                                </div>
                                <!--end card-->
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <!-- Staffs And Others -->
                            <div class="col-md-6 col-lg-3">
                                <div class="card report-card">
                                    <div class="card-body">
                                        <div class="row d-flex justify-content-center">
                                            <div class="col">
                                                <p class="text-dark mb-0 fw-semibold">Staffs</p>
                                                <h3 class="m-0"><?php echo $sff; ?> </h3>
                                            </div>
                                            <div class="col-auto align-self-center">
                                                <div class="report-main-icon bg-light-alt">
                                                    <i data-feather="users" class="align-self-center text-muted icon-sm"></i>
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
                                                <p class="text-dark mb-0 fw-semibold">Customers</p>
                                                <h3 class="m-0"><?php echo $cus; ?></h3>
                                            </div>
                                            <div class="col-auto align-self-center">
                                                <div class="report-main-icon bg-light-alt">
                                                    <i data-feather="clock" class="align-self-center text-muted icon-sm"></i>
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
                                                <p class="text-dark mb-0 fw-semibold">Suppliers</p>
                                                <h3 class="m-0"><?php echo $sp; ?></h3>
                                            </div>
                                            <div class="col-auto align-self-center">
                                                <div class="report-main-icon bg-light-alt">
                                                    <i data-feather="activity" class="align-self-center text-muted icon-sm"></i>
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
                                                <p class="text-dark mb-0 fw-semibold">Corp. Equipments</p>
                                                <h3 class="m-0"><?php echo $ce; ?></h3>
                                            </div>
                                            <div class="col-auto align-self-center">
                                                <div class="report-main-icon bg-light-alt">
                                                    <i data-feather="briefcase" class="align-self-center text-muted icon-sm"></i>
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
                        <div class="card">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h4 class="card-title">Revenue Flow Overview</h4>
                                    </div>
                                    <!--end col-->
                                </div>
                                <!--end row-->
                            </div>
                            <!--end card-header-->
                            <div class="card-body">
                                <div class="">
                                    <div id="ana_dash_1" class="apex-charts"></div>
                                </div>
                            </div>
                            <!--end card-body-->
                        </div>
                        <!--end card-->
                    </div>
                </div>
                <!--end row-->

                <div class="row">
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h4 class="card-title">Customer Resturant Order Activity</h4>
                                    </div>
                                </div>
                                <!--end row-->
                            </div>
                            <!--end card-header-->
                            <div class="card-body">
                                <div class="analytic-dash-activity" data-simplebar>
                                    <div class="activity">
                                        <div class="activity-info">
                                            <div class="icon-info-activity">
                                                <i class="las la-user-clock bg-soft-primary"></i>
                                            </div>
                                            <div class="activity-info-text">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <p class="text-muted mb-0 font-13 w-75"><span>Donald</span>
                                                        updated the status of <a href="#">Refund #1234</a> to awaiting customer response
                                                    </p>
                                                    <small class="text-muted">10 Min ago</small>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h4 class="card-title">Rooms Reservation Activity</h4>
                                    </div>
                                </div>
                                <!--end row-->
                            </div>
                            <!--end card-header-->
                            <div class="card-body">
                                <div class="analytic-dash-activity" data-simplebar>
                                    <div class="activity">
                                        <div class="activity-info">
                                            <div class="icon-info-activity">
                                                <i class="las la-user-clock bg-soft-primary"></i>
                                            </div>
                                            <div class="activity-info-text">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <p class="text-muted mb-0 font-13 w-75"><span>Donald</span>
                                                        updated the status of <a href="#">Refund #1234</a> to awaiting customer response
                                                    </p>
                                                    <small class="text-muted">10 Min ago</small>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h4 class="card-title">Revenue Vs Expenses</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="text-center">
                                    <div id="ana_device" class="apex-charts"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!--end row-->
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h4 class="card-title">Recent Resturant Revenue</h4>
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->
                        </div>
                        <!--end card-header-->
                        <div class="card-body">
                            <div class="table-responsive browser_users">
                                <table class="table mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="border-top-0">Channel</th>
                                            <th class="border-top-0">Sessions</th>
                                            <th class="border-top-0">Prev.Period</th>
                                            <th class="border-top-0">% Change</th>
                                        </tr>
                                        <!--end tr-->
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><a href="#" class="text-primary">Organic search</a></td>
                                            <td>10853<small class="text-muted">(52%)</small></td>
                                            <td>566<small class="text-muted">(92%)</small></td>
                                            <td> 52.80% <i class="fas fa-caret-up text-success font-16"></i></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h4 class="card-title">Recent Rooms Reservations Revenue</h4>
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->
                        </div>
                        <!--end card-header-->
                        <div class="card-body">
                            <div class="table-responsive browser_users">
                                <table class="table mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="border-top-0">Browser</th>
                                            <th class="border-top-0">Sessions</th>
                                            <th class="border-top-0">Bounce Rate</th>
                                            <th class="border-top-0">Transactions</th>
                                        </tr>
                                        <!--end tr-->
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><img src="assets/images/browser_logo/chrome.png" alt="" height="16" class="me-2">Chrome</td>
                                            <td>10853<small class="text-muted">(52%)</small></td>
                                            <td> 52.80%</td>
                                            <td>566<small class="text-muted">(92%)</small></td>
                                        </tr>

                                    </tbody>
                                </table>
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