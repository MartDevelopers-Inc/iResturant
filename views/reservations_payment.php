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


/* Delete Reservation Payment */
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $adn = 'DELETE FROM iResturant_Room_Reservation WHERE code=?';
    $stmt = $mysqli->prepare($adn);
    $stmt->bind_param('s', $id);
    $stmt->execute();
    $stmt->close();
    if ($stmt) {
        $success = 'Payment Deleted' && header('refresh:1; url=reservtion_payments');;
    } else {
        $info = 'Please Try Again Or Try Later';
    }
}

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
                                                <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                                                <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
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
                                <table class="body-wrap" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; width: 100%; background-color: transparent; margin: 0;" bgcolor="transparent">
                                    <tr>
                                        <td valign="top"></td>
                                        <td class="container" width="600" style="display: block !important; max-width: 600px !important; clear: both !important;" valign="top">
                                            <div class="content" style="padding: 20px;">
                                                <table class="main" width="100%" cellpadding="0" cellspacing="0" style="border: 1px dashed #4d79f6;">
                                                    <tr>
                                                        <td class="content-wrap aligncenter" style="padding: 20px; background-color: transparent;" align="center" valign="top">
                                                            <table width="100%" cellpadding="0" cellspacing="0">
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
                                                                            <h2 class="aligncenter" style="font-family: 'Helvetica Neue',Helvetica,Arial,'Lucida Grande',sans-serif;font-size: 24px; color:#50649c; line-height: 1.2em; font-weight: 600; text-align: center;" align="center">Thanks For Reserving Room At <span style="color: #4d79f6; font-weight: 700;"><?php echo $sys->name; ?></span>.</h2>
                                                                        </td>
                                                                    </tr>
                                                                <?php
                                                                }
                                                                $ret = "SELECT * FROM iResturant_Customer c
                                                                INNER JOIN iResturant_Room_Reservation r ON c.id = r.client_id
                                                                INNER JOIN iResturant_Room rm
                                                                ON r.room_id = rm.id WHERE r.code = '$view'                                                        
                                                                ";
                                                                $stmt = $mysqli->prepare($ret);
                                                                $stmt->execute(); //ok
                                                                $res = $stmt->get_result();
                                                                while ($reservation = $res->fetch_object()) {
                                                                ?>

                                                                    <tr>
                                                                        <td class="content-block aligncenter" style="padding: 0 0 20px;" align="center" valign="top">
                                                                            <table class="invoice" style="width: 80%;">
                                                                                <tr>
                                                                                    <td style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; font-size: 14px; padding: 5px 0;" valign="top">Mannatthemes
                                                                                        <br />Room #<?php echo $reservation->number; ?>
                                                                                        <br />01 Sep 2018
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td style="padding: 5px 0;" valign="top">
                                                                                        <table class="invoice-items" cellpadding="0" cellspacing="0" style="width: 100%;">
                                                                                            <tr>
                                                                                                <td style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; font-size: 14px; vertical-align: top; border-top-width: 1px; border-top-color: #eee; border-top-style: solid; margin: 0; padding: 10px 0;" valign="top">Apple iphone X</td>
                                                                                                <td class="alignright" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; font-size: 14px; vertical-align: top; text-align: right; border-top-width: 1px; border-top-color: #eee; border-top-style: solid; margin: 0; padding: 10px 0;" align="right" valign="top">$ 1499.99</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; font-size: 14px; vertical-align: top; border-top-width: 1px; border-top-color: #eee; border-top-style: solid; margin: 0; padding: 10px 0;" valign="top">Data cable</td>
                                                                                                <td class="alignright" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; font-size: 14px; vertical-align: top; text-align: right; border-top-width: 1px; border-top-color: #eee; border-top-style: solid; margin: 0; padding: 10px 0;" align="right" valign="top">$ 20.00</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; font-size: 14px; vertical-align: top; border-top-width: 1px; border-top-color: #eee; border-top-style: solid; margin: 0; padding: 10px 0;" valign="top">Phone Cover</td>
                                                                                                <td class="alignright" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; font-size: 14px; vertical-align: top; text-align: right; border-top-width: 1px; border-top-color: #eee; border-top-style: solid; margin: 0; padding: 10px 0;" align="right" valign="top">$ 40.00</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td class="alignright" width="80%" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; font-size: 14px; vertical-align: top; text-align: right; border-top-width: 2px; border-top-color: #50649c; border-top-style: solid; border-bottom-color: #50649c; border-bottom-width: 2px; border-bottom-style: solid; font-weight: 700; margin: 0; padding: 10px 0;" align="right" valign="top">Total</td>
                                                                                                <td class="alignright" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; font-size: 14px; vertical-align: top; text-align: right; border-top-width: 2px; border-top-color: #50649c; border-top-style: solid; border-bottom-color: #50649c; border-bottom-width: 2px; border-bottom-style: solid; font-weight: 700; margin: 0; padding: 10px 0;" align="right" valign="top">$ 1559.99</td>
                                                                                            </tr>
                                                                                        </table>
                                                                                    </td>
                                                                                </tr>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                <?php
                                                                }
                                                                ?>
                                                                <tr>
                                                                    <td class="content-block aligncenter" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 0 0 20px;" align="center" valign="top">
                                                                        Dastone Inc. 123 my street, And my Country
                                                                    </td>
                                                                </tr>
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