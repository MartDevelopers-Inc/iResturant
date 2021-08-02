<?php
/*
 * Created on Sat Jul 17 2021
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


/* Payment Details - Update */
if (isset($_POST['update_payment'])) {

    $id = $_POST['id'];
    $means = $_POST['means'];
    $amount = $_POST['amount'];

    $query = "UPDATE iResturant_Payments SET means =?, amount =? WHERE id =?";
    $stmt = $mysqli->prepare($query);
    $rc = $stmt->bind_param('sss', $means, $amount, $id);
    $stmt->execute();
    if ($stmt) {
        $success = "Reservation Payment Updated";
    } else {
        $info = "Please Try Again Or Try Later";
    }
}

require_once('../partials/head.php');
?>

<body>
    <!-- Left Sidenav -->
    <?php require_once('../partials/my_sidebar.php'); ?>
    <!-- end left-sidenav-->


    <div class="page-wrapper">
        <!-- Top Bar Start -->
        <?php require_once('../partials/my_header.php'); ?>
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
                                    <h4 class="page-title">Reservations Payments</h4>
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="my_dashboard">Home</a></li>
                                        <li class="breadcrumb-item"><a href="my_dashboard">Dashboard</a></li>
                                        <li class="breadcrumb-item active">Reservations Payments</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end page title end breadcrumb -->


                <div class="row">
                    <div class="col-lg-12 col-sm-12">

                        <hr>
                        <div class="card">
                            <!--end card-header-->
                            <div class="card-body table-responsive">
                                <div class="">
                                    <table class="table dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th class="border-top-0">Reservation Code</th>
                                                <th class="border-top-0">Payment Code</th>
                                                <th class="border-top-0">Payment Means</th>
                                                <th class="border-top-0">Payment Amount</th>
                                                <th class="border-top-0">Date Paid</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $id = $_SESSION['id'];
                                            $ret = "SELECT * FROM `iResturant_Currencies` WHERE status = 'Active'  ";
                                            $stmt = $mysqli->prepare($ret);
                                            $stmt->execute(); //ok
                                            $res = $stmt->get_result();
                                            while ($currency = $res->fetch_object()) {
                                                $ret = "SELECT * FROM iResturant_Payments p 
                                                INNER JOIN iResturant_Room_Reservation rr ON rr.code = p.reservation_code
                                                INNER JOIN iResturant_Customer c ON c.id = rr.client_id";
                                                $stmt = $mysqli->prepare($ret);
                                                $stmt->execute(); //ok
                                                $res = $stmt->get_result();
                                                while ($payments = $res->fetch_object()) {

                                            ?>
                                                    <tr>
                                                        <td>
                                                            <a class="text-primary" href="reservation_details?view=<?php echo $payments->reservation_code; ?>">
                                                                <?php echo $payments->reservation_code; ?>
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <?php echo $payments->code; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $payments->means; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $currency->code . " " . $payments->amount; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo date('d M Y g:ia', strtotime($payments->date_paid)); ?>
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