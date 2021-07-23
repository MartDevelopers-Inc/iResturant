<?php
/*
 * Created on Fri Jul 23 2021
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
                                    <h4 class="page-title">Reservations Reports</h4>
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                                        <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="dashboard">Reports</a></li>
                                        <li class="breadcrumb-item active">Reservations</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end page title end breadcrumb -->


                <div class="row">
                    <div class="col-lg-12 col-sm-12">

                        <div class="card">
                            <!--end card-header-->
                            <div class="card-body table-responsive">
                                <div class="">
                                    <table id="export-data-table" class="dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th class="border-top-0">Reservation Code</th>
                                                <th class="border-top-0">Customer Details</th>
                                                <th class="border-top-0">Room No</th>
                                                <th class="border-top-0">Reservation Details</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $ret = "SELECT * FROM `iResturant_Currencies` WHERE status = 'Active'  ";
                                            $stmt = $mysqli->prepare($ret);
                                            $stmt->execute(); //ok
                                            $res = $stmt->get_result();
                                            while ($currency = $res->fetch_object()) {
                                                $ret = "SELECT * FROM iResturant_Customer c
                                            INNER JOIN iResturant_Room_Reservation r ON c.id = r.client_id
                                            INNER JOIN iResturant_Room rm
                                            ON r.room_id = rm.id;                                                        
                                            ";
                                                $stmt = $mysqli->prepare($ret);
                                                $stmt->execute(); //ok
                                                $res = $stmt->get_result();
                                                while ($reservations = $res->fetch_object()) {
                                                    $checkin = strtotime($reservations->arrival);
                                                    $checkout = strtotime($reservations->departure);
                                                    $secs = $checkout - $checkin;
                                                    $days_reserved = $secs / 86400;
                                                    $total_payable_amt = $days_reserved * ($reservations->price);
                                                    $now = strtotime(date("Y-m-d"));
                                            ?>
                                                    <tr>
                                                        <td>
                                                            <a class="text-primary" href="reservation_details?view=<?php echo $reservations->code; ?>">
                                                                <?php echo $reservations->code; ?>
                                                            </a>
                                                        </td>
                                                        <td>
                                                            Name:<?php echo $reservations->name; ?><br>
                                                            Phone:<?php echo $reservations->phone; ?><br>
                                                            Email:<?php echo $reservations->email; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $reservations->number; ?>
                                                        </td>
                                                        <td>
                                                            Check In: <?php echo date('d-M-Y', strtotime($reservations->arrival)); ?><br>
                                                            Check Out: <?php echo date('d-M-Y', strtotime($reservations->departure)); ?><br>
                                                            Days Reserved: <?php echo $days_reserved; ?>Days(s)<br>
                                                            Date Reserved: <?php echo date('d-M-Y', strtotime($reservations->reserved_on)); ?>
                                                        </td>
                                                    </tr>
                                            <?php
                                                }
                                            } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <?php require_once('../partials/footer.php'); ?>
            <!--end footer-->
        </div>
        <!-- end page content -->
    </div>
    <!-- end page-wrapper -->
    <!-- jQuery  -->
    <?php require_once('../partials/scripts.php'); ?>

</body>

</html>