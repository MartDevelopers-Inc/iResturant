<?php
/*
 * Created on Thu Jul 15 2021
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
            // $ret = "SELECT * FROM iResturant_Room WHERE id = '$view'  ";
            $ret = "SELECT iResturant_Room_Category.name, iResturant_Room.number, iResturant_Room.id, iResturant_Room.details, iResturant_Room.price, iResturant_Room.status 
            FROM iResturant_Room_Category 
            INNER JOIN iResturant_Room ON 
            iResturant_Room.room_category_id = iResturant_Room_Category.id 
            WHERE iResturant_Room.id ='$view' ;  
            
            ";
            $stmt = $mysqli->prepare($ret);
            $stmt->execute(); //ok
            $res = $stmt->get_result();
            while ($room = $res->fetch_object()) {
        ?>
                <!-- Page Content-->
                <div class="page-content">
                    <div class="container-fluid">
                        <!-- Page-Title -->
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="page-title-box">
                                    <div class="row">
                                        <div class="col">
                                            <h4 class="page-title"><?php echo $room->number; ?> Details</h4>
                                            <ol class="breadcrumb">
                                                <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
                                                <li class="breadcrumb-item"><a href="rooms">Rooms</a></li>
                                                <li class="breadcrumb-item active"><?php echo $room->number; ?></li>
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                                <!--end page-title-box-->
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->
                        <!-- end page title end breadcrumb -->

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <!-- <div class="card-body p-0">
                                    <div id="user_map" class="pro-map" style="height: 220px"></div>
                                </div> -->
                                    <!--end card-body-->
                                    <div class="card-body">
                                        <div class="dastone-profile">
                                            <div class="row">
                                                <div class="col-lg-4 align-self-center mb-3 mb-lg-0">
                                                    <div class="dastone-profile-main">
                                                        <!-- <div class="dastone-profile-main-pic">
                                                        <img src="assets/images/users/user-4.jpg" alt="" height="110" class="rounded-circle">
                                                        <span class="dastone-profile_main-pic-change">
                                                            <i class="fas fa-camera"></i>
                                                        </span>
                                                    </div> -->
                                                        <div class="dastone-profile_user-detail">
                                                            <h5 class="dastone-user-name">Number : <?php echo $room->number; ?></h5>
                                                            <p class="mb-0 dastone-user-name-post">Category: <?php echo $room->name; ?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--end col-->

                                                <div class="col-lg-4 ms-auto align-self-center">
                                                    <ul class="list-unstyled personal-detail mb-0">
                                                        <li class=""><i class="ti ti-signal me-2 text-secondary font-16 align-middle"></i> <b> Status </b> : <?php echo $room->status; ?></li>
                                                        <li class="mt-2"><i class="ti ti-money text-secondary font-16 align-middle me-2"></i> <b> Price </b> : <?php echo $currency->code . " " . $room->price; ?></li>
                                                        </li>
                                                    </ul>

                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end row-->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-body  report-card">
                                                <div class="row d-flex justify-content-center">
                                                    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                                                        <div class="carousel-inner">
                                                            <?php
                                                            $ret = "SELECT * FROM `iResturant_Room_Images` WHERE room_id = '$view'  ";
                                                            $stmt = $mysqli->prepare($ret);
                                                            $stmt->execute(); //ok
                                                            $res = $stmt->get_result();
                                                            while ($images = $res->fetch_object()) {
                                                            ?>
                                                                <div class="carousel-item active">
                                                                    <img src="../public/uploads/sys_data/rooms/<?php echo $images->image; ?>" class="d-block w-100" alt="Hotel Room Image">
                                                                </div>
                                                            <?php
                                                            } ?>
                                                        </div>
                                                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-bs-slide="prev">
                                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                            <span class="visually-hidden">Previous</span>
                                                        </a>
                                                        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-bs-slide="next">
                                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                            <span class="visually-hidden">Next</span>
                                                        </a>
                                                    </div>
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
                                    <a class="nav-link active" id="Profile_Project_tab" data-bs-toggle="pill" href="#Profile_Project">Distinct Features</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " id="Profile_Post_tab" data-bs-toggle="pill" href="#Profile_Post">Reservation History</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="settings_detail_tab" data-bs-toggle="pill" href="#Profile_Settings">Settings</a>
                                </li>
                            </ul>
                        </div>
                        <!--end card-body-->
                        <div class="row">
                            <div class="col-12">
                                <div class="tab-content" id="pills-tabContent">
                                    <!-- Distinct Room Features -->
                                    <div class="tab-pane fade show active " id="Profile_Project" role="tabpanel" aria-labelledby="Profile_Project_tab">

                                        <!--end row-->
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="text-center">
                                                    <h4 class="m-0 fw-semibold text-dark font-16 mt-3">
                                                        <?php echo $room->details; ?>
                                                    </h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Previous Room Reservations -->
                                    <div class="tab-pane fade " id="Profile_Post" role="tabpanel" aria-labelledby="Profile_Post_tab">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <table class="table mb-0">
                                                    <thead class="table-light">
                                                        <tr>
                                                            <th class="border-top-0">Reservation Code</th>
                                                            <th class="border-top-0">Customer Details</th>
                                                            <th class="border-top-0">Arrival</th>
                                                            <th class="border-top-0">Departure</th>
                                                            <th class="border-top-0">Date</th>
                                                        </tr>
                                                        <!--end tr-->
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $ret = "SELECT * FROM iResturant_Customer c
                                                        INNER JOIN iResturant_Room_Reservation r ON c.id = r.client_id
                                                        INNER JOIN iResturant_Room rm
                                                        ON r.room_id = rm.id
                                                        WHERE r.room_id = '$view'
                                                         ";
                                                        $stmt = $mysqli->prepare($ret);
                                                        $stmt->execute(); //ok
                                                        $res = $stmt->get_result();
                                                        while ($reservations = $res->fetch_object()) {
                                                        ?>
                                                            <tr>
                                                                <td><?php echo $reservations->code; ?></td>
                                                                <td>
                                                                    Name:<?php echo $reservations->means; ?>
                                                                    Phone:<?php echo $reservations->phone; ?>
                                                                    Email:<?php echo $reservations->email; ?>
                                                                </td>
                                                                <td><?php echo $reservations->arrival; ?></td>
                                                                <td><?php echo $reservations->departure; ?></td>
                                                                <td><?php echo date('d-M-Y', strtotime($reservations->reserved_on)); ?></td>
                                                            </tr>
                                                        <?php
                                                        } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Room Settings -->
                                    <div class="tab-pane fade" id="Profile_Settings" role="tabpanel" aria-labelledby="settings_detail_tab">
                                        <div class="row">
                                            <div class="col-lg-6 col-xl-6">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <div class="row align-items-center">
                                                            <div class="col">
                                                                <h4 class="card-title">Personal Information</h4>
                                                            </div>
                                                            <!--end col-->
                                                        </div>
                                                        <!--end row-->
                                                    </div>
                                                    <!--end card-header-->
                                                    <div class="card-body">
                                                        <div class="form-group row">
                                                            <label class="col-xl-3 col-lg-3 text-end mb-lg-0 align-self-center">First Name</label>
                                                            <div class="col-lg-9 col-xl-8">
                                                                <input class="form-control" type="text" value="Rosa">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-xl-3 col-lg-3 text-end mb-lg-0 align-self-center">Last Name</label>
                                                            <div class="col-lg-9 col-xl-8">
                                                                <input class="form-control" type="text" value="Dodson">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-xl-3 col-lg-3 text-end mb-lg-0 align-self-center">Company Name</label>
                                                            <div class="col-lg-9 col-xl-8">
                                                                <input class="form-control" type="text" value="MannatThemes">
                                                                <span class="form-text text-muted font-12">We'll never share your email with anyone else.</span>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-xl-3 col-lg-3 text-end mb-lg-0 align-self-center">Contact Phone</label>
                                                            <div class="col-lg-9 col-xl-8">
                                                                <div class="input-group">
                                                                    <span class="input-group-text"><i class="las la-phone"></i></span>
                                                                    <input type="text" class="form-control" value="+123456789" placeholder="Phone" aria-describedby="basic-addon1">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-xl-3 col-lg-3 text-end mb-lg-0 align-self-center">Email Address</label>
                                                            <div class="col-lg-9 col-xl-8">
                                                                <div class="input-group">
                                                                    <span class="input-group-text"><i class="las la-at"></i></span>
                                                                    <input type="text" class="form-control" value="rosa.dodson@demo.com" placeholder="Email" aria-describedby="basic-addon1">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-xl-3 col-lg-3 text-end mb-lg-0 align-self-center">Website Link</label>
                                                            <div class="col-lg-9 col-xl-8">
                                                                <div class="input-group">
                                                                    <span class="input-group-text"><i class="la la-globe"></i></span>
                                                                    <input type="text" class="form-control" value=" https://mannatthemes.com/" placeholder="Email" aria-describedby="basic-addon1">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-xl-3 col-lg-3 text-end mb-lg-0 align-self-center">USA</label>
                                                            <div class="col-lg-9 col-xl-8">
                                                                <select class="form-select">
                                                                    <option>London</option>
                                                                    <option>India</option>
                                                                    <option>USA</option>
                                                                    <option>Canada</option>
                                                                    <option>Thailand</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <div class="col-lg-9 col-xl-8 offset-lg-3">
                                                                <button type="submit" class="btn btn-sm btn-outline-primary">Submit</button>
                                                                <button type="button" class="btn btn-sm btn-outline-danger">Cancel</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end col-->
                                            <div class="col-lg-6 col-xl-6">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h4 class="card-title">Change Password</h4>
                                                    </div>
                                                    <!--end card-header-->
                                                    <div class="card-body">
                                                        <div class="form-group row">
                                                            <label class="col-xl-3 col-lg-3 text-end mb-lg-0 align-self-center">Current Password</label>
                                                            <div class="col-lg-9 col-xl-8">
                                                                <input class="form-control" type="password" placeholder="Password">
                                                                <a href="#" class="text-primary font-12">Forgot password ?</a>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-xl-3 col-lg-3 text-end mb-lg-0 align-self-center">New Password</label>
                                                            <div class="col-lg-9 col-xl-8">
                                                                <input class="form-control" type="password" placeholder="New Password">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-xl-3 col-lg-3 text-end mb-lg-0 align-self-center">Confirm Password</label>
                                                            <div class="col-lg-9 col-xl-8">
                                                                <input class="form-control" type="password" placeholder="Re-Password">
                                                                <span class="form-text text-muted font-12">Never share your password.</span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <div class="col-lg-9 col-xl-8 offset-lg-3">
                                                                <button type="submit" class="btn btn-sm btn-outline-primary">Change Password</button>
                                                                <button type="button" class="btn btn-sm btn-outline-danger">Cancel</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--end card-body-->
                                                </div>
                                                <!--end card-->
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h4 class="card-title">Other Settings</h4>
                                                    </div>
                                                    <!--end card-header-->
                                                    <div class="card-body">

                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" value="" id="Email_Notifications" checked>
                                                            <label class="form-check-label" for="Email_Notifications">
                                                                Email Notifications
                                                            </label>
                                                            <span class="form-text text-muted font-12 mt-0">Do you need them?</span>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" value="" id="API_Access">
                                                            <label class="form-check-label" for="API_Access">
                                                                API Access
                                                            </label>
                                                            <span class="form-text text-muted font-12 mt-0">Enable/Disable access</span>
                                                        </div>
                                                    </div>
                                                    <!--end card-body-->
                                                </div>
                                                <!--end card-->
                                            </div> <!-- end col -->
                                        </div>
                                        <!--end row-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        <?php
            }
        }
        require_once('../partials/footer.php'); ?>
        <!--end footer-->
    </div>

    <!-- end page content -->
    </div>
    <!-- end page-wrapper -->
    <!-- jQuery  -->
    <?php require_once('../partials/scripts.php'); ?>

</body>

</html>