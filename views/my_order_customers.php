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
client();


/* Add Customer Order */
if (isset($_POST['add_order'])) {
    $id = $sys_gen_id_alt_1;
    $code = $a . $b;
    $customer_id = $_SESSION['id'];
    $meal_menu_id = $_POST['meal_menu_id'];
    $meal_count = $_POST['meal_count'];
    $speacial_request = $_POST['speacial_request'];
    $order_amount = $_POST['order_amount'];
    $status = 'Un Paid';

    /* MAiling Varibles */
    $customer_name = $_POST['customer_name'];
    $customer_email = $_POST['customer_email'];
    $bill = $order_amount * $meal_count;
    $meal = $_POST['meal'];

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
        /* Load Mailer */
        require_once('../config/meal_order_mailer.php');

        if ($mail->send() && $stmt) {
            $success = "$code - Order Submitted";
        } else {
            $info = "Please Connnect To The Internet And  Try Again ";
        }
    }
}


/* Udpate Order */
if (isset($_POST['update_order'])) {
    $code = $_POST['code'];
    $meal_count = $_POST['meal_count'];
    $speacial_request = $_POST['speacial_request'];
    $order_amount = $_POST['order_amount'];

    $query = "UPDATE iResturant_Customer_Orders SET meal_count =?, speacial_request =?, order_amount =? WHERE code = ?";
    $stmt = $mysqli->prepare($query);
    $rc = $stmt->bind_param('ssss', $meal_count, $speacial_request, $order_amount, $code);
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
    $adn = 'DELETE FROM iResturant_Customer_Orders WHERE code=?';
    $stmt = $mysqli->prepare($adn);
    $stmt->bind_param('s', $id);
    $stmt->execute();
    $stmt->close();
    if ($stmt) {
        $success = 'Order Deleted' && header('refresh:1; url=my_order_customers');;
    } else {
        $info = 'Please Try Again Or Try Later';
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
                                    <h4 class="page-title">Customer Orders</h4>
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="my_dashboard">Home</a></li>
                                        <li class="breadcrumb-item"><a href="my_dashboard">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="my_order_customers">Orders</a></li>
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
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_modal">Add Order</button>
                        </div>


                        <hr>
                        <div class="card">
                            <!--end card-header-->
                            <div class="card-body table-responsive">
                                <div class="">
                                    <table class="table dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th class="border-top-0">Order Code</th>
                                                <th class="border-top-0">Customer Details</th>
                                                <th class="border-top-0">Ordered Meal</th>
                                                <th class="border-top-0">Manage Orders</th>
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
                                                $ret =
                                                    "SELECT * FROM iResturant_Customer c INNER JOIN iResturant_Customer_Orders cs ON cs.customer_id = c.id 
                                                    INNER JOIN iResturant_Menu rm
                                                    ON rm.meal_id = cs.meal_menu_id WHERE c.id = '$id'
                                                    /* INNER JOIN iResturant_Payments pa ON cs.code = pa.order_code  */                                                                                                                 
                                                            ";
                                                $stmt = $mysqli->prepare($ret);
                                                $stmt->execute(); //ok
                                                $res = $stmt->get_result();
                                                while ($orders = $res->fetch_object()) {
                                                    /* Order Bill Amount */
                                                    $order_bill = $orders->meal_count * $orders->order_amount;
                                            ?>
                                                    <tr>
                                                        <td>
                                                            <a class="text-primary" href="my_order_customer?view=<?php echo $orders->code; ?>">
                                                                <?php echo $orders->code; ?>
                                                            </a>
                                                        </td>
                                                        <td>
                                                            Name:<?php echo $orders->name; ?><br>
                                                            Phone:<?php echo $orders->phone; ?><br>
                                                            Email:<?php echo $orders->email; ?>
                                                        </td>
                                                        <td>
                                                            Meal : <?php echo $orders->meal_name; ?><br>
                                                            Quantity : <?php echo $orders->meal_count; ?><br>
                                                            Order Bill : <?php echo $currency->code . " " . $order_bill; ?><br>
                                                            Date Ordered: <?php echo date('d-M-Y g:ia', strtotime($orders->created_at)); ?>
                                                        </td>
                                                        <td>

                                                            <a href="#edit-<?php echo $orders->code; ?>" data-bs-toggle="modal" data-bs-target="#edit-<?php echo $orders->code; ?>" class="btn btn-sm btn-outline-warning">
                                                                <i data-feather="edit" class="align-self-center icon-xs ms-1"></i> Edit
                                                            </a>
                                                            <a href="#delete-<?php echo $orders->code; ?>" data-bs-toggle="modal" data-bs-target="#delete-<?php echo $orders->code; ?>" class="btn btn-sm btn-outline-danger">
                                                                <i data-feather="trash" class="align-self-center icon-xs ms-1"></i> Delete
                                                            </a>


                                                            <!-- Edit  Modal -->
                                                            <div class="modal fade" id="edit-<?php echo $orders->code; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalPrimary1" aria-hidden="true">
                                                                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header bg-warning">
                                                                            <h6 class="modal-title m-0 text-white" id="exampleModalPrimary1">Update Customer Order</h6>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="row">
                                                                                <form method="post" enctype="multipart/form-data" role="form">
                                                                                    <div class="card-body">
                                                                                        <div class="row">
                                                                                            <div class="form-group col-md-6">
                                                                                                <label for="">Meal Count </label>
                                                                                                <input type="number" required name="meal_count" value="<?php echo $orders->meal_count; ?>" class="form-control">
                                                                                                <input type="hidden" required name="code" value="<?php echo $orders->code; ?>" class="form-control">
                                                                                            </div>
                                                                                            <div class="form-group col-md-6">
                                                                                                <label for="">Unit Meal Price </label>
                                                                                                <input type="text" readonly value="<?php echo $orders->order_amount; ?>" required name="order_amount" class="form-control">
                                                                                            </div>
                                                                                            <div class="form-group col-md-12">
                                                                                                <label for="">Special Requests</label>
                                                                                                <textarea name="speacial_request" class="form-control" rows="5"><?php echo $orders->speacial_request; ?></textarea>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="d-flex justify-content-end">
                                                                                        <button type="submit" name="update_order" class="btn btn-primary">Submit</button>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- End Edit Modal -->

                                                            <!-- Delete Room Category Modal -->
                                                            <div class="modal fade" id="delete-<?php echo $orders->code; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLabel">CONFIRM</h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                                                                        </div>
                                                                        <div class="modal-body text-center text-danger">
                                                                            <h4>Delete Order ?</h4>
                                                                            <br>
                                                                            <p>Heads Up, You are about to delete customer order.<br> This action is irrevisble.</p>
                                                                            <button type="button" class="btn btn-soft-success" data-bs-dismiss="modal">No</button>
                                                                            <a href="my_order_customers?delete_order=<?php echo $orders->code; ?>" class="text-center btn btn-danger"> Delete </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- End Delete Modal -->
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
                                                        <?php
                                                        $ret = "SELECT * FROM  iResturant_Customer WHERE id = '$id'";
                                                        $stmt = $mysqli->prepare($ret);
                                                        $stmt->execute(); //ok
                                                        $res = $stmt->get_result();
                                                        while ($customer = $res->fetch_object()) {
                                                        ?>
                                                            <input type="hidden" required name="customer_email" value="<?php echo $customer->email; ?>" class="form-control">
                                                            <input type="hidden" required name="customer_name" value="<?php echo $customer->name; ?>" class="form-control">
                                                        <?php
                                                        } ?>
                                                        </select>
                                                        <!-- Hidden -->

                                                        <div class="form-group col-md-12">
                                                            <label for="">Meal Name</label>
                                                            <select class="select form-control" name="meal_menu_id" onchange="getMenuDetails(this.value);" id="MealID">
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
                                                            <input type="hidden" required name="meal" id="MealName" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label for="">Meal Quantity </label>
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
                                                <div class="d-flex justify-content-end">
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