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
client();

/* Update User Profile */
if (isset($_POST['update_profile_pic'])) {
    $id = $_POST['id'];
    $time = time();
    $profile_pic = $time . $_FILES['profile_pic']['name'];
    move_uploaded_file($_FILES["profile_pic"]["tmp_name"], "../public/uploads/user_images/" . $time . $_FILES["profile_pic"]["name"]);

    $query = "UPDATE iResturant_Customer  SET  profile_pic =? WHERE id =?";
    $stmt = $mysqli->prepare($query);
    $rc = $stmt->bind_param('ss', $profile_pic, $id);
    $stmt->execute();
    if ($stmt) {
        $success = "Profile Picture Updated";
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
        <?php require_once('../partials/my_header.php');
        $view = $_GET['view'];
        $ret = "SELECT * FROM iResturant_Customer c INNER JOIN iResturant_Customer_Orders cs ON cs.customer_id = c.id 
        INNER JOIN iResturant_Menu rm
        ON rm.meal_id = cs.meal_menu_id
        WHERE cs.code = '$view'";
        $stmt = $mysqli->prepare($ret);
        $stmt->execute(); //ok
        $res = $stmt->get_result();
        while ($customer = $res->fetch_object()) {
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
                                            <h4 class="page-title"><?php echo $customer->name; ?> Order Details</h4>
                                            <ol class="breadcrumb">
                                                <li class="breadcrumb-item"><a href="my_dashboard">Home</a></li>
                                                <li class="breadcrumb-item"><a href="my_dashboard">Dashboard</a></li>
                                                <li class="breadcrumb-item"><a href="my_order_customers">Orders</a></li>
                                                <li class="breadcrumb-item active"><?php echo $customer->code; ?></li>
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
                                                            <?php
                                                            if ($customer->profile_pic == '') {
                                                                $dir = '../public/uploads/user_images/no-profile.png';
                                                            } else {
                                                                $dir = "../public/uploads/user_images/$customer->profile_pic";
                                                            } ?>
                                                            <img src="<?php echo $dir; ?>" alt="" height="110" class="rounded-circle">
                                                        </div>
                                                        <div class="dastone-profile_user-detail">
                                                            <h5 class="dastone-user-name"><?php echo $customer->name; ?></h5>
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
                                                        <li class="mt-2"><i class="ti ti-mobile me-2 text-secondary font-16 align-middle"></i> <b> Phone </b> : <?php echo $customer->phone; ?></li>
                                                        <li class="mt-2"><i class="ti ti-email text-secondary font-16 align-middle me-2"></i> <b> Email </b> : <?php echo $customer->email; ?></li>
                                                        <li class="mt-2"><i class="ti ti-tag text-secondary font-16 align-middle me-2"></i> <b> Address </b> : <?php echo $customer->adr; ?>
                                                        </li>
                                                    </ul>

                                                    <ul class="list-unstyled personal-detail mb-0">
                                                        <?php
                                                        $country = $customer->client_country;
                                                        $ret = "SELECT * FROM  iResturant_Country WHERE id = '$country' ";
                                                        $stmt = $mysqli->prepare($ret);
                                                        $stmt->execute(); //ok
                                                        $res = $stmt->get_result();
                                                        while ($country = $res->fetch_object()) {
                                                        ?>
                                                            <li class="mt-2"><i class="ti ti-gift me-2 text-secondary font-16 align-middle"></i> <b> Country Code </b> : <?php echo $country->code; ?></li>
                                                            <li class="mt-2"><i class="ti ti-flag text-secondary font-16 align-middle me-2"></i> <b> Country Name </b> : <?php echo $country->name; ?></li>
                                                        <?php
                                                        } ?>
                                                    </ul>
                                                </div>
                                                <div class="col-lg-6 ms-auto align-self-center">
                                                    <ul class="list-unstyled personal-detail mb-0">
                                                        <li class=""><i class="ti ti-check-box me-2 text-secondary font-16 align-middle"></i> <b> Order Code </b> : <?php echo $customer->code; ?></li>
                                                        <li class="mt-2"><i class="ti ti-calendar text-secondary font-16 align-middle me-2"></i> <b> Meal Ordered </b> : <?php echo $customer->meal_name; ?></li>
                                                        <li class="mt-2"><i class="ti ti-agenda text-secondary font-16 align-middle me-2"></i> <b> Meal Count </b> : <?php echo $customer->meal_count; ?></li>
                                                        <li class="mt-2"><i class="ti ti-time text-secondary font-16 align-middle me-2"></i> <b> Unit Meal Price </b> : <?php echo $currency->code . " " . $customer->order_amount; ?></li>
                                                        <li class="mt-2"><i class="ti ti-write text-secondary font-16 align-middle me-2"></i> <b> Order Status </b> : <?php echo $customer->status; ?></li>
                                                    </ul>
                                                </div>
                                                <br>
                                                <hr>
                                                <div class="col-lg-12">
                                                    <h5 class="text-center">Special Order Request</h5>
                                                    <?php echo $customer->speacial_request; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="pb-4">
                                    <ul class="nav-border nav nav-pills mb-0" id="pills-tab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="Profile_Project_tab" data-bs-toggle="pill" href="#Profile_Project"><?php echo $customer->name; ?> Order Payment History</a>
                                        </li>
                                    </ul>
                                </div>
                                <!--end card-body-->
                                <div class="row">
                                    <div class="col-12">
                                        <div class="tab-content" id="pills-tabContent">
                                            <div class="tab-pane fade show active " id="Profile_Project" role="tabpanel" aria-labelledby="Profile_Project_tab">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="card">
                                                            <?php
                                                            $ret = "SELECT * FROM  iResturant_Payments  WHERE order_code = '$view'";
                                                            $stmt = $mysqli->prepare($ret);
                                                            $stmt->execute(); //ok
                                                            $res = $stmt->get_result();
                                                            while ($payment_details = $res->fetch_object()) {
                                                            ?>
                                                                <div class="card-body border-bottom-dashed">
                                                                    <div class="earning-data text-center">
                                                                        <img src="../public/images/money-bag.png" alt="" class="money-bag my-3" height="60">
                                                                        <h5 class="earn-money mb-1"><?php echo $currency->code . " " . $payment_details->amount; ?></h5>
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
                                                                                    <h6 class="m-0 font-24"><?php echo date('d M Y g:ia', strtotime($payment_details->date_paid)); ?></h6>
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