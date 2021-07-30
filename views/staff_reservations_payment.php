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
admin_check_login();


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
    <?php require_once('../partials/staff_sidebar.php'); ?>
    <!-- end left-sidenav-->


    <div class="page-wrapper">
        <!-- Top Bar Start -->
        <?php require_once('../partials/staff_header.php');
        $view = $_GET['view'];
        $ret = "SELECT * FROM iResturant_Payments WHERE  id = '$view'";
        $stmt = $mysqli->prepare($ret);
        $stmt->execute(); //ok
        $res = $stmt->get_result();
        while ($payment = $res->fetch_object()) {
            $ret = "SELECT * FROM `iResturant_Currencies` WHERE status = 'Active'  ";
            $stmt = $mysqli->prepare($ret);
            $stmt->execute(); //ok
            $res = $stmt->get_result();
            while ($currency = $res->fetch_object()) {
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
                                            <h4 class="page-title">Reservations Payment Receipt</h4>
                                            <ol class="breadcrumb">
                                                <li class="breadcrumb-item"><a href="staff_dashboard">Home</a></li>
                                                <li class="breadcrumb-item"><a href="staff_dashboard">Dashboard</a></li>
                                                <li class="breadcrumb-item active"><?php echo $payment->code; ?> Receipt</li>
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end page title end breadcrumb -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="d-flex justify-content-end">
                                    <button id="print" onclick="printContent('PrintReceipt');" type="button" class="btn btn-primary">
                                        <i data-feather="printer" class="align-self-center icon-xs ms-1"></i>
                                        Print Receipt
                                    </button>
                                </div>
                                <hr>
                                <table class="body-wrap" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; width: 100%; background-color: transparent; margin: 0;" bgcolor="transparent">
                                    <tr>
                                        <td valign="top"></td>
                                        <td class="container" width="600" style="display: block !important; max-width: 600px !important; clear: both !important;" valign="top">
                                            <div class="content" style="padding: 20px;">
                                                <table class="main" width="100%" cellpadding="0" cellspacing="0" style="border: 1px dashed #4d79f6;">
                                                    <tr>
                                                        <td class="content-wrap aligncenter" style="padding: 20px; background-color: transparent;" align="center" valign="top">
                                                            <table id="PrintReceipt" width="100%" cellpadding="0" cellspacing="0">
                                                                <?php
                                                                /* Load System COnfigurations And Settings */
                                                                $ret = "SELECT * FROM `iResturant_System_Details`  ";
                                                                $stmt = $mysqli->prepare($ret);
                                                                $stmt->execute(); //ok
                                                                $res = $stmt->get_result();
                                                                while ($sys = $res->fetch_object()) {
                                                                ?>
                                                                    <tr>

                                                                        <td>
                                                                            <a href=""><img src="../public/uploads/sys_logo/<?php echo $sys->logo; ?>" alt="" style="height: 40px; margin-left: auto; margin-right: auto; display:block;"></a>
                                                                        </td>

                                                                    </tr>
                                                                    <tr>
                                                                        <td class="content-block" style="padding: 0 0 20px;" valign="top">
                                                                            <h2 class="aligncenter" style="font-family: 'Helvetica Neue',Helvetica,Arial,'Lucida Grande',sans-serif;font-size: 24px; color:#50649c; line-height: 1.2em; font-weight: 600; text-align: center;" align="center">Thanks For Reserving Room At <span style="color: #4d79f6; font-weight: 700;"><?php echo $sys->system_name; ?></span>.</h2>
                                                                        </td>
                                                                    </tr>
                                                                    <?php

                                                                    $ret = "SELECT * FROM iResturant_Customer c
                                                                INNER JOIN iResturant_Room_Reservation r ON c.id = r.client_id
                                                                INNER JOIN iResturant_Room rm
                                                                ON r.room_id = rm.id WHERE r.code = '$payment->reservation_code'                                                        
                                                                ";
                                                                    $stmt = $mysqli->prepare($ret);
                                                                    $stmt->execute(); //ok
                                                                    $res = $stmt->get_result();
                                                                    while ($reservation = $res->fetch_object()) {
                                                                        $checkin = strtotime($reservation->arrival);
                                                                        $checkout = strtotime($reservation->departure);
                                                                        $secs = $checkout - $checkin;
                                                                        $days_reserved = $secs / 86400;
                                                                        $total_payable_amt = $days_reserved * ($reservation->price);
                                                                        $now = strtotime(date("Y-m-d")); ?>

                                                                        <tr>
                                                                            <td class="content-block aligncenter" style="padding: 0 0 20px;" align="center" valign="top">
                                                                                <table class="invoice" style="width: 80%;">
                                                                                    <tr>
                                                                                        <td style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; font-size: 14px; padding: 5px 0;" valign="top">
                                                                                            <?php echo $reservation->name; ?> <br>
                                                                                            <?php echo $reservation->phone; ?><br>
                                                                                            <?php echo $reservation->email; ?><br>
                                                                                            <br />Room #<?php echo $reservation->number; ?>
                                                                                            <br />Check In: <?php echo date('d-M-Y', strtotime($reservation->arrival)); ?>
                                                                                            <br />Check Out: <?php echo date('d-M-Y', strtotime($reservation->departure)); ?>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td style="padding: 5px 0;" valign="top">
                                                                                            <table class="invoice-items" cellpadding="0" cellspacing="0" style="width: 100%;">
                                                                                                <tr>
                                                                                                    <td style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; font-size: 14px; vertical-align: top; border-top-width: 1px; border-top-color: #eee; border-top-style: solid; margin: 0; padding: 10px 0;" valign="top">Room Reservation For <?php echo $days_reserved; ?> Day(s)</td>
                                                                                                    <td class="alignright" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; font-size: 14px; vertical-align: top; text-align: right; border-top-width: 1px; border-top-color: #eee; border-top-style: solid; margin: 0; padding: 10px 0;" align="right" valign="top"><?php echo $currency->code . " " . $total_payable_amt; ?></td>
                                                                                                </tr>

                                                                                                <tr>
                                                                                                    <td style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; font-size: 14px; vertical-align: top; border-top-width: 1px; border-top-color: #eee; border-top-style: solid; margin: 0; padding: 10px 0;" valign="top">Total </td>
                                                                                                    <td class="alignright" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; font-size: 14px; vertical-align: top; text-align: right; border-top-width: 2px; border-top-color: #50649c; border-top-style: solid; border-bottom-color: #50649c; border-bottom-width: 2px; border-bottom-style: solid; font-weight: 700; margin: 0; padding: 10px 0;" align="right" valign="top"> <?php echo "" . $currency->code . " " . $total_payable_amt; ?></td>
                                                                                                </tr>
                                                                                            </table>
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="content-block aligncenter" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 0 0 20px;" align="center" valign="top">
                                                                                <hr>
                                                                                <?php echo $sys->system_name; ?>
                                                                                <br>
                                                                                <i><?php echo $sys->tagline; ?></i>
                                                                            </td>
                                                                        </tr>
                                                                <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </table>
                                                            <!--end table-->
                                                        </td>
                                                    </tr>
                                                </table>
                                                <!--end table-->
                                            </div>
                                            <!--end content-->
                                        </td>
                                        <td style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; font-size: 14px; vertical-align: top; margin: 0;" valign="top"></td>
                                    </tr>
                                </table>
                                <!--end table-->

                            </div>
                        </div>
                        <?php require_once('../partials/footer.php'); ?>
                        <!--end footer-->
                    </div>
                    <!-- end page content -->
                </div>
        <?php
            }
        } ?>
        <!-- end page-wrapper -->
        <!-- jQuery  -->
        <?php require_once('../partials/scripts.php'); ?>

</body>

</html>