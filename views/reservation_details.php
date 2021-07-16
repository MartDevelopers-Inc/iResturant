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
admin_check_login();
require_once('../partials/head.php');
?>

<body>
    <!-- Left Sidenav -->
    <?php require_once('../partials/aside.php'); ?>

    <!-- end left-sidenav-->


    <div class="page-wrapper">
        <!-- Top Bar Start -->
        <?php require_once('../partials/header.php');
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
                    $days_reserved = $secs / 86400;
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
                                                <h4 class="page-title"><?php echo $reservation->code; ?> Details</h4>
                                                <ol class="breadcrumb">
                                                    <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
                                                    <li class="breadcrumb-item"><a href="reservations_manage">Resevations</a></li>
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
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end row-->
                            <div class="pb-4">
                                <ul class="nav-border nav nav-pills mb-0" id="pills-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="Profile_Project_tab" data-bs-toggle="pill" href="#Profile_Project">Reserved Room Details</a>
                                    </li>
                                </ul>
                            </div>
                            <!--end card-body-->
                            <div class="row">
                                <div class="col-12">
                                    <div class="tab-content" id="pills-tabContent">
                                        <div class="tab-pane fade show active " id="Profile_Project" role="tabpanel" aria-labelledby="Profile_Project_tab">
                                            <div class="row mb-4">
                                                <div class="col">
                                                    <form>
                                                        <div class="input-group">
                                                            <input type="text" id="example-input1-group2" name="example-input1-group2" class="form-control" placeholder="Search">
                                                            <button type="button" class="btn btn-primary"><i class="fas fa-search"></i></button>
                                                        </div>
                                                    </form>
                                                </div>
                                                <!--end col-->
                                                <div class="col-auto">
                                                    <button type="button" class="btn btn-primary"><i class="fas fa-filter"></i></button>
                                                    <button type="button" class="btn btn-primary">Add Project</button>
                                                </div>
                                                <!--end col-->
                                            </div>
                                            <!--end row-->
                                            <div class="row">
                                                <div class="col-3">
                                                    <div class="card">
                                                        <div class="card-body ">
                                                            <div class="text-center">
                                                                <img src="assets/images/widgets/project2.jpg" alt="" class="rounded-circle d-block mx-auto mt-2" height="70">
                                                                <h4 class="m-0 fw-semibold text-dark font-16 mt-3">Body Care</h4>
                                                                <p class="text-muted  mb-0 font-13"><span class="text-dark">Client : </span>Hyman M. Cross</p>
                                                            </div>
                                                            <div class="row mt-4 d-flex align-items-center">
                                                                <div class="col">
                                                                    <h5 class="font-22 m-0 fw-bold">$26,100</h5>
                                                                    <p class="mb-0 text-muted">Total Budget</p>
                                                                </div>
                                                                <div class="col-auto">
                                                                    <a href="#" class="btn btn-sm btn-outline-secondary  px-4">More Details</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--end card-body-->
                                                    </div>
                                                    <!--end card-->
                                                </div>
                                                <!--end col-->
                                                <div class="col-3">
                                                    <div class="card">
                                                        <div class="card-body ">
                                                            <div class="text-center">
                                                                <img src="assets/images/widgets/project4.jpg" alt="" class="rounded-circle d-block mx-auto mt-2" height="70">
                                                                <h4 class="m-0 fw-semibold text-dark font-16 mt-3">Book My World</h4>
                                                                <p class="text-muted  mb-0 font-13"><span class="text-dark">Client : </span>Johnson M. delly</p>
                                                            </div>
                                                            <div class="row mt-4 d-flex align-items-center">
                                                                <div class="col">
                                                                    <h5 class="font-22 m-0 fw-bold">$71,100</h5>
                                                                    <p class="mb-0 text-muted">Total Budget</p>
                                                                </div>
                                                                <div class="col-auto">
                                                                    <a href="#" class="btn btn-sm btn-outline-secondary  px-4">More Details</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--end card-body-->
                                                    </div>
                                                    <!--end card-->
                                                </div>
                                                <!--end col-->

                                                <div class="col-3">
                                                    <div class="card">
                                                        <div class="card-body ">
                                                            <div class="text-center">
                                                                <img src="assets/images/widgets/project3.jpg" alt="" class="rounded-circle d-block mx-auto mt-2" height="70">
                                                                <h4 class="m-0 fw-semibold text-dark font-16 mt-3">Banking</h4>
                                                                <p class="text-muted  mb-0 font-13"><span class="text-dark">Client : </span>Hyman M. Cross</p>
                                                            </div>
                                                            <div class="row mt-4 d-flex align-items-center">
                                                                <div class="col">
                                                                    <h5 class="font-22 m-0 fw-bold">$56,700</h5>
                                                                    <p class="mb-0 text-muted">Total Budget</p>
                                                                </div>
                                                                <div class="col-auto">
                                                                    <a href="#" class="btn btn-sm btn-outline-secondary  px-4">More Details</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--end card-body-->
                                                    </div>
                                                    <!--end card-->
                                                </div>
                                                <!--end col-->
                                                <div class="col-3">
                                                    <div class="card">
                                                        <div class="card-body ">
                                                            <div class="text-center">
                                                                <img src="assets/images/widgets/project1.jpg" alt="" class="rounded-circle d-block mx-auto mt-2" height="70">
                                                                <h4 class="m-0 fw-semibold text-dark font-16 mt-3">Transfer money</h4>
                                                                <p class="text-muted  mb-0 font-13"><span class="text-dark">Client : </span>Jack Z Jackson</p>
                                                            </div>
                                                            <div class="row mt-4 d-flex align-items-center">
                                                                <div class="col">
                                                                    <h5 class="font-22 m-0 fw-bold">$48,200</h5>
                                                                    <p class="mb-0 text-muted">Total Budget</p>
                                                                </div>
                                                                <div class="col-auto">
                                                                    <a href="#" class="btn btn-sm btn-outline-secondary  px-4">More Details</a>
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

                                            <div class="row">
                                                <div class="col-3">
                                                    <div class="card">
                                                        <div class="card-body ">
                                                            <div class="text-center">
                                                                <img src="assets/images/widgets/project1.jpg" alt="" class="rounded-circle d-block mx-auto mt-2" height="70">
                                                                <h4 class="m-0 fw-semibold text-dark font-16 mt-3">Body Care</h4>
                                                                <p class="text-muted  mb-0 font-13"><span class="text-dark">Client : </span>Hyman M. Cross</p>
                                                            </div>
                                                            <div class="row mt-4 d-flex align-items-center">
                                                                <div class="col">
                                                                    <h5 class="font-22 m-0 fw-bold">$26,100</h5>
                                                                    <p class="mb-0 text-muted">Total Budget</p>
                                                                </div>
                                                                <div class="col-auto">
                                                                    <a href="#" class="btn btn-sm btn-outline-secondary  px-4">More Details</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--end card-body-->
                                                    </div>
                                                    <!--end card-->
                                                </div>
                                                <!--end col-->
                                                <div class="col-3">
                                                    <div class="card">
                                                        <div class="card-body ">
                                                            <div class="text-center">
                                                                <img src="assets/images/widgets/project3.jpg" alt="" class="rounded-circle d-block mx-auto mt-2" height="70">
                                                                <h4 class="m-0 fw-semibold text-dark font-16 mt-3">Book My World</h4>
                                                                <p class="text-muted  mb-0 font-13"><span class="text-dark">Client : </span>Johnson M. delly</p>
                                                            </div>
                                                            <div class="row mt-4 d-flex align-items-center">
                                                                <div class="col">
                                                                    <h5 class="font-22 m-0 fw-bold">$71,100</h5>
                                                                    <p class="mb-0 text-muted">Total Budget</p>
                                                                </div>
                                                                <div class="col-auto">
                                                                    <a href="#" class="btn btn-sm btn-outline-secondary  px-4">More Details</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--end card-body-->
                                                    </div>
                                                    <!--end card-->
                                                </div>
                                                <!--end col-->

                                                <div class="col-3">
                                                    <div class="card">
                                                        <div class="card-body ">
                                                            <div class="text-center">
                                                                <img src="assets/images/widgets/project4.jpg" alt="" class="rounded-circle d-block mx-auto mt-2" height="70">
                                                                <h4 class="m-0 fw-semibold text-dark font-16 mt-3">Banking</h4>
                                                                <p class="text-muted  mb-0 font-13"><span class="text-dark">Client : </span>Hyman M. Cross</p>
                                                            </div>
                                                            <div class="row mt-4 d-flex align-items-center">
                                                                <div class="col">
                                                                    <h5 class="font-22 m-0 fw-bold">$56,700</h5>
                                                                    <p class="mb-0 text-muted">Total Budget</p>
                                                                </div>
                                                                <div class="col-auto">
                                                                    <a href="#" class="btn btn-sm btn-outline-secondary  px-4">More Details</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--end card-body-->
                                                    </div>
                                                    <!--end card-->
                                                </div>
                                                <!--end col-->
                                                <div class="col-3">
                                                    <div class="card">
                                                        <div class="card-body ">
                                                            <div class="text-center">
                                                                <img src="assets/images/widgets/project2.jpg" alt="" class="rounded-circle d-block mx-auto mt-2" height="70">
                                                                <h4 class="m-0 fw-semibold text-dark font-16 mt-3">Transfer money</h4>
                                                                <p class="text-muted  mb-0 font-13"><span class="text-dark">Client : </span>Jack Z Jackson</p>
                                                            </div>
                                                            <div class="row mt-4 d-flex align-items-center">
                                                                <div class="col">
                                                                    <h5 class="font-22 m-0 fw-bold">$48,200</h5>
                                                                    <p class="mb-0 text-muted">Total Budget</p>
                                                                </div>
                                                                <div class="col-auto">
                                                                    <a href="#" class="btn btn-sm btn-outline-secondary  px-4">More Details</a>
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
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php

                        require_once('../partials/footer.php'); ?>
                    </div>
    </div>
    <!-- jQuery  -->
<?php
                }
            }
        }
        require_once('../partials/scripts.php'); ?>

</body>

</html>