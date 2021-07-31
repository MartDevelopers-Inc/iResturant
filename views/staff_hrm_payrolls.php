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
staff();


require_once('../partials/head.php');
?>

<body>
    <!-- Left Sidenav -->
    <?php require_once('../partials/staff_sidebar.php'); ?>
    <!-- end left-sidenav-->


    <div class="page-wrapper">
        <!-- Top Bar Start -->
        <?php require_once('../partials/staff_header.php'); ?>
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
                                    <h4 class="page-title">Payrolls</h4>
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="staff_dashboard">Home</a></li>
                                        <li class="breadcrumb-item"><a href="staff_dashboard">Dashboard</a></li>
                                        <li class="breadcrumb-item active">Payrolls</li>
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
                                    <table class="table dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>Payroll Code</th>
                                                <th>Staff Details </th>
                                                <th>Paid Month</th>
                                                <th>Paid Amount</th>
                                                <th>Date Generated</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            /* Load Currency */
                                            $ret = "SELECT * FROM `iResturant_Currencies` WHERE status = 'Active'  ";
                                            $stmt = $mysqli->prepare($ret);
                                            $stmt->execute(); //ok
                                            $res = $stmt->get_result();
                                            while ($currency = $res->fetch_object()) {
                                                $number = $_SESSION['number'];
                                                $ret = "SELECT * FROM iResturant_Staff S
                                            INNER JOIN iResturant_Payroll P ON P.staff_id = S.id WHERE S.number = '$number'
                                            ";
                                                $stmt = $mysqli->prepare($ret);
                                                $stmt->execute(); //ok
                                                $res = $stmt->get_result();
                                                while ($payrolls = $res->fetch_object()) {
                                            ?>
                                                    <tr>
                                                        <td>
                                                            <a href="staff_hrm_payroll?view=<?php echo $payrolls->code; ?>" class="text-primary">
                                                                <?php echo $payrolls->code; ?>
                                                            </a>
                                                        </td>
                                                        <td>
                                                            Number: <?php echo $payrolls->number; ?><br>
                                                            Name: <?php echo $payrolls->name; ?><br>
                                                            Email: <?php echo $payrolls->email; ?>
                                                        </td>
                                                        <td><?php echo $payrolls->month; ?></td>
                                                        <td><?php echo $currency->code . " " . $payrolls->amount; ?></td>
                                                        <td><?php echo date('d M Y g:ia', strtotime($payrolls->created_at)); ?></td>

                                                    </tr>
                                            <?php
                                                }
                                            }
                                            ?>
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