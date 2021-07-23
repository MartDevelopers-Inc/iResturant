<?php
/*
* Created on Mon Jul 19 2021
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
        $view = $_GET['view'];
        $ret = "SELECT * FROM iResturant_Suppliers s INNER JOIN iResturant_Expenses e ON e.supplier_id = s.id WHERE e.code = '$view' ";
        $stmt = $mysqli->prepare($ret);
        $stmt->execute(); //ok
        $res = $stmt->get_result();
        while ($order = $res->fetch_object()) {
            $ret = "SELECT * FROM `iResturant_Currencies` WHERE status = 'Active'  ";
            $stmt = $mysqli->prepare($ret);
            $stmt->execute(); //ok
            $res = $stmt->get_result();
            while ($currency = $res->fetch_object()) {
        ?>

                <!-- Top Bar End -->
                <div class="page-content">
                    <div class="container-fluid">
                        <!-- Page-Title -->
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="page-title-box">
                                    <div class="row">
                                        <div class="col">
                                            <h4 class="page-title"><?php echo $order->name; ?> Order Details</h4>
                                            <ol class="breadcrumb">
                                                <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                                                <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
                                                <li class="breadcrumb-item"><a href="order_resturants">Orders</a></li>
                                                <li class="breadcrumb-item active"><?php echo $order->code; ?></li>
                                            </ol>
                                        </div>
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
                            <div class="col-12" id="Print">
                                <div class="card">
                                    <!--end card-body-->
                                    <div class="card-body">
                                        <div class="dastone-profile">
                                            <div class="row">
                                                <div class="col-lg-12 align-self-center mb-3 mb-lg-0">
                                                    <div class="dastone-profile-main">
                                                        <div class="dastone-profile-main-pic">
                                                            <img src="../public/uploads/user_images/no-profile.png" alt="" height="110" class="rounded-circle">
                                                        </div>
                                                        <div class="dastone-profile_user-detail">
                                                            <h5 class="dastone-user-name"><?php echo $order->name; ?></h5>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <!--end card-body-->
                                    <div class="card-body">
                                        <div class="dastone-profile">
                                            <div class="row">
                                                <div class="col-lg-6 ms-auto align-self-center">
                                                    <ul class="list-unstyled personal-detail mb-0">
                                                        <li class="mt-2"><i class="ti ti-mobile me-2 text-secondary font-16 align-middle"></i> <b> Phone </b> : <?php echo $order->phone; ?></li>
                                                        <li class="mt-2"><i class="ti ti-email text-secondary font-16 align-middle me-2"></i> <b> Email </b> : <?php echo $order->email; ?></li>
                                                        <li class="mt-2"><i class="ti ti-tag text-secondary font-16 align-middle me-2"></i> <b> Address </b> : <?php echo $order->adr; ?>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col-lg-6 ms-auto align-self-center">
                                                    <ul class="list-unstyled personal-detail mb-0">
                                                        <li class=""><i class="ti ti-check-box me-2 text-secondary font-16 align-middle"></i> <b> Order Code </b> : <?php echo $order->code; ?></li>
                                                        <li class="mt-2"><i class="ti ti-time text-secondary font-16 align-middle me-2"></i> <b> Order Price </b> : <?php echo $currency->code . " " . $order->amount; ?></li>
                                                        <li class="mt-2"><i class="ti ti-write text-secondary font-16 align-middle me-2"></i> <b> Order Status </b> : <?php echo $order->status; ?></li>
                                                    </ul>
                                                </div>
                                                <br>
                                                <hr>
                                                <div class="col-lg-12">
                                                    <h5 class="text-center">Order Details</h5>
                                                    <?php echo $order->details; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="text-center">
                                <button id="print" onclick="printContent('Print');" type="button" class="btn btn-primary">
                                    <i data-feather="printer" class="align-self-center icon-xs ms-1"></i>
                                    Print
                                </button>
                            </div>
                        </div>
                    </div>

                    <?php require_once('../partials/footer.php'); ?>
                    <!--end footer-->
                </div>
        <?php
            }
        } ?>
        <!-- end page content -->
    </div>
    <!-- end page-wrapper -->

    <?php require_once('../partials/scripts.php'); ?>

</body>

</html>