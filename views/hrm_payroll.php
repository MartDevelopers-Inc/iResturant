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
        $ret = "SELECT * FROM iResturant_Staff S
        INNER JOIN iResturant_Payroll P ON P.staff_id = S.id WHERE P.code = '$view'";
        $stmt = $mysqli->prepare($ret);
        $stmt->execute(); //ok
        $res = $stmt->get_result();
        while ($payroll = $res->fetch_object()) {
            /* Load Currency */
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
                                            <h4 class="page-title"><?php echo $payroll->code; ?> Payroll </h4>
                                            <ol class="breadcrumb">
                                                <li class="breadcrumb-item"><a href="dashboard">Dastone</a></li>
                                                <li class="breadcrumb-item"><a href="hrm_staffs">HRM </a></li>
                                                <li class="breadcrumb-item"><a href="hrm_staffs">Staffs Payrolls</a></li>
                                                <li class="breadcrumb-item active">Payroll Details</li>
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
                                            <h5 class="text-bold text-center">Staff Details</h5>
                                            <div class="row">
                                                <div class="col-lg-4 align-self-center mb-3 mb-lg-0">
                                                    <div class="dastone-profile-main">
                                                        <div class="dastone-profile-main-pic">
                                                            <?php
                                                            if ($payroll->passport == '') {
                                                                $dir = '../public/uploads/user_images/no-profile.png';
                                                            } else {
                                                                $dir = "../public/uploads/user_images/$payroll->passport";
                                                            } ?>
                                                            <img src="<?php echo $dir; ?>" alt="" height="110" class="rounded-circle">
                                                        </div>
                                                        <div class="dastone-profile_user-detail">
                                                            <h5 class="dastone-user-name"><?php echo $payroll->name; ?></h5>
                                                            <p class="mb-0 dastone-user-name-post"><?php echo $payroll->number; ?></p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-4 ms-auto align-self-center">
                                                    <ul class="list-unstyled personal-detail mb-0">
                                                        <li class="mt-2"><i class="ti ti-mobile me-2 text-secondary font-16 align-middle"></i> <b> Phone </b> : <?php echo $payroll->phone; ?></li>
                                                        <li class="mt-2"><i class="ti ti-email text-secondary font-16 align-middle me-2"></i> <b> Email </b> : <?php echo $payroll->email; ?></li>
                                                        <li class="mt-2"><i class="ti ti-tag text-secondary font-16 align-middle me-2"></i> <b> Gender </b> : <?php echo $payroll->gender; ?>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col-lg-4 ms-auto align-self-center">
                                                    <ul class="list-unstyled personal-detail mb-0">
                                                        <li class="mt-2"><i class="ti ti-gift me-2 text-secondary font-16 align-middle"></i> <b> D.O.B </b> : <?php echo date('d M Y', strtotime($payroll->dob)); ?></li>
                                                        <li class="mt-2"><i class="ti ti-email text-secondary font-16 align-middle me-2"></i> <b> Address </b> : <?php echo $payroll->adr; ?></li>
                                                        <li class="mt-2"><i class="ti ti-calendar text-secondary font-16 align-middle me-2"></i> <b> Date Employed </b> : <?php echo date('d M Y', strtotime($payroll->date_employed)); ?>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <!--end card-body-->
                                    <div class="card-body">
                                        <div class="dastone-profile">
                                            <h5 class="text-bold text-center">Payroll Details</h5>
                                            <div class="row">
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
                                                                                            <h2 class="aligncenter" style="font-family: 'Helvetica Neue',Helvetica,Arial,'Lucida Grande',sans-serif;font-size: 24px; color:#50649c; line-height: 1.2em; font-weight: 600; text-align: center;" align="center"><span style="color: #4d79f6; font-weight: 700;"><?php echo $sys->system_name; ?></span><br>Payroll #<?php echo $payroll->code; ?></h2>
                                                                                        </td>
                                                                                    </tr>
                                                                                <?php
                                                                                }
                                                                                ?>

                                                                                <tr>
                                                                                    <td class="content-block aligncenter" style="padding: 0 0 20px;" align="center" valign="top">
                                                                                        <table class="invoice" style="width: 80%;">
                                                                                            <tr>
                                                                                                <td style="padding: 5px 0;" valign="top">
                                                                                                    <table class="invoice-items" cellpadding="0" cellspacing="0" style="width: 100%;">
                                                                                                        <tr>
                                                                                                            <td style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; font-size: 14px; vertical-align: top; border-top-width: 1px; border-top-color: #eee; border-top-style: solid; margin: 0; padding: 10px 0;" valign="top">Month</td>
                                                                                                            <td class="alignright" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; font-size: 14px; vertical-align: top; text-align: right; border-top-width: 1px; border-top-color: #eee; border-top-style: solid; margin: 0; padding: 10px 0;" align="right" valign="top"><?php echo $payroll->month; ?></td>
                                                                                                        </tr>

                                                                                                        <tr>
                                                                                                            <td style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; font-size: 14px; vertical-align: top; border-top-width: 1px; border-top-color: #eee; border-top-style: solid; margin: 0; padding: 10px 0;" valign="top">Total Salary </td>
                                                                                                            <td class="alignright" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; font-size: 14px; vertical-align: top; text-align: right; border-top-width: 2px; border-top-color: #50649c; border-top-style: solid; border-bottom-color: #50649c; border-bottom-width: 2px; border-bottom-style: solid; font-weight: 700; margin: 0; padding: 10px 0;" align="right" valign="top"> <?php echo "" . $currency->code . " " . $payroll->amount; ?></td>
                                                                                                        </tr>
                                                                                                    </table>
                                                                                                </td>
                                                                                            </tr>
                                                                                        </table>
                                                                                    </td>
                                                                                </tr>

                                                                                <tr>
                                                                                    <td class="content-block aligncenter" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 0 0 20px;" align="center" valign="top">
                                                                                        Thank You For Being Our Loyal Employee
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
                            <br>
                        </div>
                    </div><!-- container -->

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