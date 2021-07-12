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
                                <div class="col-auto align-self-center">
                                    <a href="#" class="btn btn-sm btn-outline-primary" id="Dash_Date">
                                        <span class="ay-name" id="Day_Name">Today:</span>&nbsp;
                                        <span class="" id="Select_date">Jan 11</span>
                                        <i data-feather="calendar" class="align-self-center icon-xs ms-1"></i>
                                    </a>
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
                    <div class="col-lg-9">
                        <div class="row justify-content-center">
                            <div class="col-md-6 col-lg-3">
                                <div class="card report-card">
                                    <div class="card-body">
                                        <div class="row d-flex justify-content-center">
                                            <div class="col">
                                                <p class="text-dark mb-0 fw-semibold">Sessions</p>
                                                <h3 class="m-0">24k</h3>
                                                <p class="mb-0 text-truncate text-muted"><span class="text-success"><i class="mdi mdi-trending-up"></i>8.5%</span> New Sessions Today</p>
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
                                                <p class="text-dark mb-0 fw-semibold">Avg.Sessions</p>
                                                <h3 class="m-0">00:18</h3>
                                                <p class="mb-0 text-truncate text-muted"><span class="text-success"><i class="mdi mdi-trending-up"></i>1.5%</span> Weekly Avg.Sessions</p>
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
                                                <p class="text-dark mb-0 fw-semibold">Bounce Rate</p>
                                                <h3 class="m-0">$2400</h3>
                                                <p class="mb-0 text-truncate text-muted"><span class="text-danger"><i class="mdi mdi-trending-down"></i>35%</span> Bounce Rate Weekly</p>
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
                                                <p class="text-dark mb-0 fw-semibold">Goal Completions</p>
                                                <h3 class="m-0">85000</h3>
                                                <p class="mb-0 text-truncate text-muted"><span class="text-success"><i class="mdi mdi-trending-up"></i>10.5%</span> Completions Weekly</p>
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
                            <!--end col-->
                        </div>
                        <!--end row-->
                        <div class="card">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h4 class="card-title">Audience Overview</h4>
                                    </div>
                                    <!--end col-->
                                    <div class="col-auto">
                                        <div class="dropdown">
                                            <a href="#" class="btn btn-sm btn-outline-light dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                This Year<i class="las la-angle-down ms-1"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item" href="#">Today</a>
                                                <a class="dropdown-item" href="#">Last Week</a>
                                                <a class="dropdown-item" href="#">Last Month</a>
                                                <a class="dropdown-item" href="#">This Year</a>
                                            </div>
                                        </div>
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
                    <!--end col-->
                    <div class="col-lg-3">
                        <div class="card">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h4 class="card-title">Sessions Device</h4>
                                    </div>
                                    <!--end col-->
                                    <div class="col-auto">
                                        <div class="dropdown">
                                            <a href="#" class="btn btn-sm btn-outline-light dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                All<i class="las la-angle-down ms-1"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item" href="#">Purchases</a>
                                                <a class="dropdown-item" href="#">Emails</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end col-->
                                </div>
                                <!--end row-->
                            </div>
                            <!--end card-header-->
                            <div class="card-body">
                                <div class="text-center">
                                    <div id="ana_device" class="apex-charts"></div>
                                    <h6 class="bg-light-alt py-3 px-2 mb-0">
                                        <i data-feather="calendar" class="align-self-center icon-xs me-1"></i>
                                        01 January 2020 to 31 December 2020
                                    </h6>
                                </div>
                                <div class="table-responsive mt-2">
                                    <table class="table border-dashed mb-0">
                                        <thead>
                                            <tr>
                                                <th>Device</th>
                                                <th class="text-end">Sassions</th>
                                                <th class="text-end">Day</th>
                                                <th class="text-end">Week</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Dasktops</td>
                                                <td class="text-end">1843</td>
                                                <td class="text-end">-3</td>
                                                <td class="text-end">-12</td>
                                            </tr>
                                            <tr>
                                                <td>Tablets</td>
                                                <td class="text-end">2543</td>
                                                <td class="text-end">-5</td>
                                                <td class="text-end">-2</td>
                                            </tr>
                                            <tr>
                                                <td>Mobiles</td>
                                                <td class="text-end">3654</td>
                                                <td class="text-end">-5</td>
                                                <td class="text-end">-6</td>
                                            </tr>

                                        </tbody>
                                    </table>
                                    <!--end /table-->
                                </div>
                                <!--end /div-->
                            </div>
                            <!--end card-body-->
                        </div>
                        <!--end card-->
                    </div>
                    <!--end col-->
                </div>
                <!--end row-->

                <div class="row">
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h4 class="card-title">Pages View by Users</h4>
                                    </div>
                                    <!--end col-->
                                    <div class="col-auto">
                                        <div class="dropdown">
                                            <a href="#" class="btn btn-sm btn-outline-light dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Today<i class="las la-angle-down ms-1"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item" href="#">Today</a>
                                                <a class="dropdown-item" href="#">Yesterday</a>
                                                <a class="dropdown-item" href="#">Last Week</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end col-->
                                </div>
                                <!--end row-->
                            </div>
                            <!--end card-header-->
                            <div class="card-body">
                                <ul class="list-group custom-list-group mb-n3">
                                    <li class="list-group-item align-items-center d-flex justify-content-between pt-0">
                                        <div class="media">
                                            <img src="assets/images/small/rgb.svg" height="30" class="me-3 align-self-center rounded" alt="...">
                                            <div class="media-body align-self-center">
                                                <h6 class="m-0">Dastone - Admin Dashboard</h6>
                                                <p class="mb-0 text-muted">analytic-index.html</p>
                                            </div>
                                            <!--end media body-->
                                        </div>
                                        <div class="align-self-center">
                                            <a href="#" class="btn btn-sm btn-soft-primary">4.3k <i class="las la-external-link-alt font-15"></i></a>
                                        </div>
                                    </li>
                                    <li class="list-group-item align-items-center d-flex justify-content-between">
                                        <div class="media">
                                            <img src="assets/images/small/cobweb.svg" height="30" class="me-3 align-self-center rounded" alt="...">
                                            <div class="media-body align-self-center">
                                                <h6 class="m-0">Metrica Simple- Admin Dashboard</h6>
                                                <p class="mb-0 text-muted">sales-index.html</p>
                                            </div>
                                            <!--end media body-->
                                        </div>
                                        <div class="align-self-center">
                                            <a href="#" class="btn btn-sm btn-soft-primary">3.7k <i class="las la-external-link-alt font-15"></i></a>
                                        </div>
                                    </li>
                                    <li class="list-group-item align-items-center d-flex justify-content-between">
                                        <div class="media">
                                            <img src="assets/images/small/blocks.svg" height="30" class="me-3 align-self-center rounded" alt="...">
                                            <div class="media-body align-self-center">
                                                <h6 class="m-0">Crovex - Admin Dashboard</h6>
                                                <p class="mb-0 text-muted">helpdesk-index.html</p>
                                            </div>
                                            <!--end media body-->
                                        </div>
                                        <div class="align-self-center">
                                            <a href="#" class="btn btn-sm btn-soft-primary">2.9k <i class="las la-external-link-alt font-15"></i></a>
                                        </div>
                                    </li>
                                    <li class="list-group-item align-items-center d-flex justify-content-between">
                                        <div class="media">
                                            <img src="assets/images/small/atom.svg" height="30" class="me-3 align-self-center rounded" alt="...">
                                            <div class="media-body align-self-center">
                                                <h6 class="m-0">Annex - Admin Dashboard</h6>
                                                <p class="mb-0 text-muted">calendar.html</p>
                                            </div>
                                            <!--end media body-->
                                        </div>
                                        <div class="align-self-center">
                                            <a href="#" class="btn btn-sm btn-soft-primary">1.6k <i class="las la-external-link-alt font-15"></i></a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <!--end card-body-->
                        </div>
                        <!--end card-->
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex">
                                    <h2 class="m-0 align-self-center">80</h2>
                                    <div class="d-block ms-2 align-self-center">
                                        <span class="text-warning">Right now</span>
                                        <h5 class="my-1">Traffic Sources</h5>
                                        <p class="mb-0 text-muted">It is a long established fact that a reader will
                                            be of a page when looking at its layout.
                                            <a href="#" class="text-primary">Read More <i class="las la-arrow-right"></i></a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!--end card-body-->
                        </div>
                        <!--end card-->
                    </div>
                    <!--end col-->
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h4 class="card-title">Sessions By Channel</h4>
                                    </div>
                                    <!--end col-->
                                </div>
                                <!--end row-->
                            </div>
                            <!--end card-header-->
                            <div class="card-body">
                                <div id="barchart" class="apex-charts ms-n4"></div>
                            </div>
                            <!--end card-body-->
                        </div>
                        <!--end card-->
                    </div>
                    <!--end col-->


                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h4 class="card-title">Activity</h4>
                                    </div>
                                    <!--end col-->
                                    <div class="col-auto">
                                        <div class="dropdown">
                                            <a href="#" class="btn btn-sm btn-outline-light dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                All<i class="las la-angle-down ms-1"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item" href="#">Purchases</a>
                                                <a class="dropdown-item" href="#">Emails</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end col-->
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

                                        <div class="activity-info">
                                            <div class="icon-info-activity">
                                                <i class="mdi mdi-timer-off bg-soft-primary"></i>
                                            </div>
                                            <div class="activity-info-text">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <p class="text-muted mb-0 font-13 w-75"><span>Lucy Peterson</span>
                                                        was added to the group, group name is <a href="#">Overtake</a>
                                                    </p>
                                                    <small class="text-muted">50 Min ago</small>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="activity-info">
                                            <div class="icon-info-activity">
                                                <img src="assets/images/users/user-5.jpg" alt="" class="rounded-circle thumb-sm">
                                            </div>
                                            <div class="activity-info-text">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <p class="text-muted mb-0 font-13 w-75"><span>Joseph Rust</span>
                                                        opened new showcase <a href="#">Mannat #112233</a> with theme market
                                                    </p>
                                                    <small class="text-muted">10 hours ago</small>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="activity-info">
                                            <div class="icon-info-activity">
                                                <i class="mdi mdi-clock-outline bg-soft-primary"></i>
                                            </div>
                                            <div class="activity-info-text">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <p class="text-muted mb-0 font-13 w-75"><span>Donald</span>
                                                        updated the status of <a href="#">Refund #1234</a> to awaiting customer response
                                                    </p>
                                                    <small class="text-muted">Yesterday</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="activity-info">
                                            <div class="icon-info-activity">
                                                <i class="mdi mdi-alert-outline bg-soft-primary"></i>
                                            </div>
                                            <div class="activity-info-text">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <p class="text-muted mb-0 font-13 w-75"><span>Lucy Peterson</span>
                                                        was added to the group, group name is <a href="#">Overtake</a>
                                                    </p>
                                                    <small class="text-muted">14 Nov 2019</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="activity-info">
                                            <div class="icon-info-activity">
                                                <img src="assets/images/users/user-4.jpg" alt="" class="rounded-circle thumb-sm">
                                            </div>
                                            <div class="activity-info-text">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <p class="text-muted mb-0 font-13 w-75"><span>Joseph Rust</span>
                                                        opened new showcase <a href="#">Mannat #112233</a> with theme market
                                                    </p>
                                                    <small class="text-muted">15 Nov 2019</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end activity-->
                                </div>
                                <!--end analytics-dash-activity-->
                            </div>
                            <!--end card-body-->
                        </div>
                        <!--end card-->
                    </div>
                    <!--end col-->

                </div>
                <!--end row-->
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h4 class="card-title">Browser Used & Traffic Reports</h4>
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
                                            <!--end tr-->
                                            <tr>
                                                <td><a href="#" class="text-primary">Direct</a></td>
                                                <td>2545<small class="text-muted">(47%)</small></td>
                                                <td>498<small class="text-muted">(81%)</small></td>
                                                <td> -17.20% <i class="fas fa-caret-down text-danger font-16"></i></td>

                                            </tr>
                                            <!--end tr-->
                                            <tr>
                                                <td><a href="#" class="text-primary">Referal</a></td>
                                                <td>1836<small class="text-muted">(38%)</small></td>
                                                <td>455<small class="text-muted">(74%)</small></td>
                                                <td> 41.12% <i class="fas fa-caret-up text-success font-16"></i></td>

                                            </tr>
                                            <!--end tr-->
                                            <tr>
                                                <td><a href="#" class="text-primary">Email</a></td>
                                                <td>1958<small class="text-muted">(31%)</small></td>
                                                <td>361<small class="text-muted">(61%)</small></td>
                                                <td> -8.24% <i class="fas fa-caret-down text-danger font-16"></i></td>
                                            </tr>
                                            <!--end tr-->
                                            <tr>
                                                <td><a href="#" class="text-primary">Social</a></td>
                                                <td>1566<small class="text-muted">(26%)</small></td>
                                                <td>299<small class="text-muted">(49%)</small></td>
                                                <td> 29.33% <i class="fas fa-caret-up text-success"></i></td>
                                            </tr>
                                            <!--end tr-->
                                        </tbody>
                                    </table>
                                    <!--end table-->
                                </div>
                                <!--end /div-->
                            </div>
                            <!--end card-body-->
                        </div>
                        <!--end card-->
                    </div>
                    <!--end col-->

                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h4 class="card-title">Browser Used & Traffic Reports</h4>
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
                                            <!--end tr-->
                                            <tr>
                                                <td><img src="assets/images/browser_logo/micro-edge.png" alt="" height="16" class="me-2">Microsoft Edge</td>
                                                <td>2545<small class="text-muted">(47%)</small></td>
                                                <td> 47.54%</td>
                                                <td>498<small class="text-muted">(81%)</small></td>
                                            </tr>
                                            <!--end tr-->
                                            <tr>
                                                <td><img src="assets/images/browser_logo/in-explorer.png" alt="" height="16" class="me-2">Internet-Explorer</td>
                                                <td>1836<small class="text-muted">(38%)</small></td>
                                                <td> 41.12%</td>
                                                <td>455<small class="text-muted">(74%)</small></td>
                                            </tr>
                                            <!--end tr-->
                                            <tr>
                                                <td><img src="assets/images/browser_logo/opera.png" alt="" height="16" class="me-2">Opera</td>
                                                <td>1958<small class="text-muted">(31%)</small></td>
                                                <td> 36.82%</td>
                                                <td>361<small class="text-muted">(61%)</small></td>
                                            </tr>
                                            <!--end tr-->
                                            <tr>
                                                <td><img src="assets/images/browser_logo/chrome.png" alt="" height="16" class="me-2">Chrome</td>
                                                <td>10853<small class="text-muted">(52%)</small></td>
                                                <td> 52.80%</td>
                                                <td>566<small class="text-muted">(92%)</small></td>
                                            </tr>
                                            <!--end tr-->
                                        </tbody>
                                    </table>
                                    <!--end table-->
                                </div>
                                <!--end /div-->
                            </div>
                            <!--end card-body-->
                        </div>
                        <!--end card-->
                    </div>
                    <!--end col-->
                </div>
                <!--end row-->


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