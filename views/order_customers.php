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


/* Add Customer Order */
if (isset($_POST['add_order'])) {
    $id = $sys_gen_id_alt_1;
    $code = $a . $b;
    $customer_id = $_POST['customer_id'];
    $meal_menu_id = $_POST['meal_menu_id'];
    $meal_count = $_POST['meal_count'];
    $speacial_request = $_POST['speacial_request'];
    $order_amount = $_POST['order_amount'];
    $status = 'Unpaid';

    $sql = "SELECT * FROM  iResturant_Customer_Orders WHERE  (code='$code')  ";
    $res = mysqli_query($mysqli, $sql);
    if (mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_assoc($res);
        if ($code == $row['code']) {
            $err =  "An Order With This Code Already Exists";
        }
    } else {
        $query = "INSERT INTO iResturant_Customer_Orders (id, code, customer_id, meal_menu_id, meal_count, speacial_request, order_amount, status ) VALUES(?,?,?,?,?,?,?,?)";
        $stmt = $mysqli->prepare($query);
        $rc = $stmt->bind_param('ssssssss', $id, $code, $customer_id, $meal_menu_id, $meal_count, $speacial_request, $order_amount, $status);
        $stmt->execute();
        if ($stmt) {
            $success = "$code - Order Submitted";
        } else {
            $info = "Please Try Again Or Try Later";
        }
    }
}


/* Udpate Order */
if (isset($_POST['update_order'])) {
    $id = $_POST['id'];
    $meal_count = $_POST['meal_count'];
    $speacial_request = $_POST['speacial_request'];
    $order_amount = $_POST['order_amount'];

    $query = "UPDATE iResturant_Customer_Orders SET meal_count =?, speacial_request =?, order_amount =? WHERE id = ?";
    $stmt = $mysqli->prepare($query);
    $rc = $stmt->bind_param('ssss', $meal_count, $speacial_request, $order_amount, $id);
    $stmt->execute();
    if ($stmt) {
        $success = "Order Updated";
    } else {
        $info = "Please Try Again Or Try Later";
    }
}


/* Delete Order */
if (isset($_GET['delete_order'])) {
    $id = $_GET['delete_order'];
    $adn = 'DELETE FROM iResturant_Customer_Orders WHERE id=?';
    $stmt = $mysqli->prepare($adn);
    $stmt->bind_param('s', $id);
    $stmt->execute();
    $stmt->close();
    if ($stmt) {
        $success = 'Order Deleted' && header('refresh:1; url=order_customers');;
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
                                    <h4 class="page-title">Customer Orders</h4>
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                                        <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="order_customers">Orders</a></li>
                                        <li class="breadcrumb-item active">Customer Orders</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end page title end breadcrumb -->


                <div class="row">
                    <div class="col-lg-12 col-sm-12">
                        <div class="text-center">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_modal">Add Order</button>
                        </div>


                        <hr>
                        <div class="card">
                            <!--end card-header-->
                            <div class="card-body table-responsive">
                                <div class="">

                                </div>
                            </div>
                        </div>
                        <!-- Add Room Modal -->
                        <div class="modal fade" id="add_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalPrimary1" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-primary">
                                        <h6 class="modal-title m-0 text-white" id="exampleModalPrimary1">Add Customer Order</h6>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <form method="post" enctype="multipart/form-data" role="form">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label for="">Customer Name</label>
                                                            <select class="select form-control">
                                                                <option>Select Customer Name</option>
                                                                <?php
                                                                $ret = "SELECT * FROM  iResturant_Customer ";
                                                                $stmt = $mysqli->prepare($ret);
                                                                $stmt->execute(); //ok
                                                                $res = $stmt->get_result();
                                                                while ($customer = $res->fetch_object()) {
                                                                ?>
                                                                    <option value="<?php echo $customer->id; ?>"><?php echo $customer->name; ?></option>
                                                                <?php
                                                                } ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="">Meal Name</label>
                                                            <select class="select form-control" onchange="getMenuDetails(this.value);" id="MealName">
                                                                <option>Select Meal Name</option>
                                                                <?php
                                                                $ret = "SELECT * FROM  iResturant_Menu ";
                                                                $stmt = $mysqli->prepare($ret);
                                                                $stmt->execute(); //ok
                                                                $res = $stmt->get_result();
                                                                while ($menu = $res->fetch_object()) {
                                                                ?>
                                                                    <option value="<?php echo $menu->meal_id; ?>"><?php echo $menu->meal_name; ?></option>
                                                                <?php
                                                                } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label for="">Meal Count </label>
                                                            <input type="number" required name="meal_count" class="form-control">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="">Unit Meal Price </label>
                                                            <input type="text" readonly id="MealPrice" required name="order_amount" class="form-control">
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <label for="">Special Requests</label>
                                                            <textarea name="speacial_request" class="form-control" rows="5"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="text-center">
                                                    <button type="submit" name="add_order" class="btn btn-primary">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Add Room Modal -->
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