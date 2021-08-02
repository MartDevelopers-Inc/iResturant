<?php
/*
 * Created on Fri Jul 16 2021
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
require_once('../config/codeGen.php');
client();
require_once('../partials/head.php');
?>

<body>
    <!-- Left Sidenav -->
    <?php require_once('../partials/my_sidebar.php'); ?>

    <!-- end left-sidenav-->


    <div class="page-wrapper">
        <!-- Top Bar Start -->
        <?php require_once('../partials/my_header.php');
        /* Load Room Details */
        $ret = "SELECT * FROM `iResturant_Currencies` WHERE status = 'Active'  ";
        $stmt = $mysqli->prepare($ret);
        $stmt->execute(); //ok
        $res = $stmt->get_result();
        while ($currency = $res->fetch_object()) {
            $view = $_GET['view'];
            $ret = "SELECT * FROM iResturant_Customer c
            INNER JOIN iResturant_Room_Reservation r ON c.id = r.client_id
            INNER JOIN iResturant_Room rm
            ON r.room_id = rm.id
            WHERE r.code = '$view'                                                     
                ";
            $stmt = $mysqli->prepare($ret);
            $stmt->execute(); //ok
            $res = $stmt->get_result();
            while ($reservation = $res->fetch_object()) {
                $country_id = $reservation->client_country;
                $ret = "SELECT * FROM `iResturant_Country` WHERE id = '$country_id'  ";
                $stmt = $mysqli->prepare($ret);
                $stmt->execute(); //ok
                $res = $stmt->get_result();
                while ($country = $res->fetch_object()) {
                    /* Number Of Days Reserved */
                    $checkin = strtotime($reservation->arrival);
                    $checkout = strtotime($reservation->departure);
                    $secs = $checkout - $checkin;
                    $days_reserved = $secs / 86400; ?>
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
                                                <h4 class="page-title"><?php echo $reservation->code; ?> Details</h4>
                                                <ol class="breadcrumb">
                                                    <li class="breadcrumb-item"><a href="my_dashboard">Dashboard</a></li>
                                                    <li class="breadcrumb-item"><a href="my_reservations_manage">Resevations</a></li>
                                                    <li class="breadcrumb-item active"><?php echo $reservation->code; ?></li>
                                                </ol>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end page title end breadcrumb -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">

                                        <!--end card-body-->
                                        <div class="card-body">
                                            <div class="dastone-profile">
                                                <div class="row">
                                                    <div class="col-lg-4 align-self-center mb-3 mb-lg-0">
                                                        <div class="dastone-profile-main">
                                                            <div class="dastone-profile-main-pic">
                                                                <?php
                                                                if ($reservation->profile_pic == '') {
                                                                    $dir = '../public/uploads/user_images/no-profile.png';
                                                                } else {
                                                                    $dir = "../public/uploads/user_images/$reservation->profile_pic";
                                                                } ?>
                                                                <img src="<?php echo $dir; ?>" alt="" height="110" class="rounded-circle">
                                                                <!-- <span class="dastone-profile_main-pic-change">
                                                                <i class="fas fa-camera"></i>
                                                            </span> -->
                                                            </div>
                                                            <div class="dastone-profile_user-detail">
                                                                <h5 class="dastone-user-name"><?php echo $reservation->name; ?></h5>
                                                                <p class="mb-0 dastone-user-name-post"><?php echo $reservation->adr; ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--end col-->

                                                    <div class="col-lg-4 ms-auto align-self-center">
                                                        <ul class="list-unstyled personal-detail mb-0">
                                                            <li class=""><i class="ti ti-mobile me-2 text-secondary font-16 align-middle"></i> <b> Phone No </b> : <?php echo $reservation->phone; ?></li>
                                                            <li class="mt-2"><i class="ti ti-email text-secondary font-16 align-middle me-2"></i> <b> Email </b> : <?php echo $reservation->email; ?></li>
                                                            <li class="mt-2"><i class="ti ti-shortcode text-secondary font-16 align-middle me-2"></i> <b> Country Code </b> : <?php echo $country->code; ?></li>
                                                            <li class="mt-2"><i class="ti ti-world text-secondary font-16 align-middle me-2"></i> <b> Country Name </b> : <?php echo $country->name; ?></li>
                                                        </ul>
                                                    </div>

                                                    <div class="col-lg-4 ms-auto align-self-center">
                                                        <ul class="list-unstyled personal-detail mb-0">
                                                            <li class=""><i class="ti ti-check-box me-2 text-secondary font-16 align-middle"></i> <b> Reservation Code </b> : <?php echo $reservation->code; ?></li>
                                                            <li class="mt-2"><i class="ti ti-calendar text-secondary font-16 align-middle me-2"></i> <b> Check In </b> : <?php echo date('d-M-Y', strtotime($reservation->arrival)); ?></li>
                                                            <li class="mt-2"><i class="ti ti-agenda text-secondary font-16 align-middle me-2"></i> <b> Check Out </b> : <?php echo date('d-M-Y', strtotime($reservation->departure)); ?></li>
                                                            <li class="mt-2"><i class="ti ti-time text-secondary font-16 align-middle me-2"></i> <b> Days Reserved </b> : <?php echo $days_reserved; ?> Days</li>
                                                            <li class="mt-2"><i class="ti ti-write text-secondary font-16 align-middle me-2"></i> <b> Purpose </b> : <?php echo $reservation->purpose; ?></li>
                                                            <li class="mt-2"><i class="ti ti-pin-alt me-2 text-secondary font-16 align-middle"></i> <b> Room Number </b> : <?php echo $reservation->number; ?></li>
                                                            <li class="mt-2"><i class="ti ti-money text-secondary font-16 align-middle me-2"></i> <b> Single Night Price </b> : <?php echo $currency->code . " " . $reservation->price; ?></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="pb-4">
                                <ul class="nav-border nav nav-pills mb-0" id="pills-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="Profile_Project_tab" data-bs-toggle="pill" href="#Profile_Project">Attached Reservation Special Request</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link " id="Profile_Post_tab" data-bs-toggle="pill" href="#Profile_Post">Reservation Payment Details</a>
                                    </li>

                                </ul>
                            </div>
                            <!--end card-body-->
                            <div class="row">
                                <div class="col-12">
                                    <div class="tab-content" id="pills-tabContent">
                                        <!-- Distinct Room Features -->
                                        <div class="tab-pane fade show active " id="Profile_Project" role="tabpanel" aria-labelledby="Profile_Project_tab">
                                            <div class="row">
                                                <div class="col-12">
                                                    <?php echo $reservation->special_request; ?>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade " id="Profile_Post" role="tabpanel" aria-labelledby="Profile_Post_tab">
                                            <div class="row align-items-center">
                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <?php
                                                        $ret = "SELECT * FROM  iResturant_Payments  WHERE reservation_code = '$view'";
                                                        $stmt = $mysqli->prepare($ret);
                                                        $stmt->execute(); //ok
                                                        $res = $stmt->get_result();
                                                        while ($payment_details = $res->fetch_object()) {
                                                        ?>
                                                            <div class="card-body border-bottom-dashed">
                                                                <div class="earning-data text-center">
                                                                    <img src="../public/images/money-bag.png" alt="" class="money-bag my-3" height="60">
                                                                    <h5 class="earn-money mb-1"><?php echo $currency->code . " " . $payment_details->amount; ?></h5>
                                                                    <p class="text-muted font-15 mb-4">Total Reservation Fee For <?php echo $days_reserved; ?> Day (s) </p>
                                                                </div>
                                                            </div>
                                                            <div class="card-body my-1">
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="media">
                                                                            <i data-feather="tag" class="align-self-center icon-md text-secondary me-2"></i>
                                                                            <div class="media-body align-self-center">
                                                                                <h6 class="m-0 font-24"><?php echo $payment_details->code; ?></h6>
                                                                                <p class="text-muted mb-0">Payment Code:</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col">
                                                                        <div class="media">
                                                                            <i data-feather="anchor" class="align-self-center icon-md text-secondary me-2"></i>
                                                                            <div class="media-body align-self-center">
                                                                                <h6 class="m-0 font-24"><?php echo $payment_details->means; ?></h6>
                                                                                <p class="text-muted mb-0">Payment Means: </p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col">
                                                                        <div class="media">
                                                                            <i data-feather="calendar" class="align-self-center icon-md text-secondary me-2"></i>
                                                                            <div class="media-body align-self-center">
                                                                                <h6 class="m-0 font-24"><?php echo date('d-M-Y g:ia', strtotime($payment_details->date_paid)); ?></h6>
                                                                                <p class="text-muted mb-0">Date Paid: </p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php
                                                        } ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php require_once('../partials/footer.php'); ?>
                    </div>
        <?php
                }
            }
        } ?>
    </div>
    <!-- jQuery  -->
    <?php require_once('../partials/scripts.php'); ?>

</body>

</html>