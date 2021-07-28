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


/* Add Resturant Order */
if (isset($_POST['add_order'])) {
    $id = $sys_gen_id_alt_1;
    $code = $a . $b;
    $supplier_id = $_POST['supplier_id'];
    $amount = $_POST['amount'];
    $details  = $_POST['details'];
    $status = 'Un Paid';

    $sql = "SELECT * FROM  iResturant_Expenses WHERE  (code='$code')  ";
    $res = mysqli_query($mysqli, $sql);
    if (mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_assoc($res);
        if ($code == $row['code']) {
            $err =  "An Order With This Code Already Exists";
        }
    } else {
        $query = "INSERT INTO iResturant_Expenses (id, code, supplier_id, amount, details, status) VALUES(?,?,?,?,?,?)";
        $stmt = $mysqli->prepare($query);
        $rc = $stmt->bind_param('ssssss', $id, $code, $supplier_id, $amount, $details, $status);
        $stmt->execute();
        if ($stmt) {
            $success = "$code Submitted";
        } else {
            $info = "Please Try Again Or Try Later";
        }
    }
}


/* Udpate Order */
if (isset($_POST['update_order'])) {
    $code = $_POST['code'];
    $amount = $_POST['amount'];
    $details  = $_POST['details'];
    $status = $_POST['status'];

    $query = "UPDATE  iResturant_Expenses SET amount =?, details =?, status =? WHERE code = ?";
    $stmt = $mysqli->prepare($query);
    $rc = $stmt->bind_param('ssss', $amount, $details, $status, $code);
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
    $adn = 'DELETE FROM iResturant_Expenses WHERE code=?';
    $stmt = $mysqli->prepare($adn);
    $stmt->bind_param('s', $id);
    $stmt->execute();
    $stmt->close();
    if ($stmt) {
        $success = 'Order Deleted' && header('refresh:1; url=order_resturants');;
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
                                    <h4 class="page-title">Resturant Expenses</h4>
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                                        <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="order_resturants">Orders</a></li>
                                        <li class="breadcrumb-item active">Resturant Expenses</li>
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
                                                <th class="border-top-0">Supplier Details</th>
                                                <th class="border-top-0">Order Amount </th>
                                                <th class="border-top-0">Created At</th>
                                                <th class="border-top-0">Manage Orders</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $ret = "SELECT * FROM `iResturant_Currencies` WHERE status = 'Active'  ";
                                            $stmt = $mysqli->prepare($ret);
                                            $stmt->execute(); //ok
                                            $res = $stmt->get_result();
                                            while ($currency = $res->fetch_object()) {
                                                $ret = "SELECT * FROM iResturant_Suppliers s INNER JOIN iResturant_Expenses e ON e.supplier_id = s.id ";
                                                $stmt = $mysqli->prepare($ret);
                                                $stmt->execute(); //ok
                                                $res = $stmt->get_result();
                                                while ($orders = $res->fetch_object()) {
                                            ?>
                                                    <tr>
                                                        <td>
                                                            <a class="text-primary" href="order_resturant?view=<?php echo $orders->code; ?>">
                                                                <?php echo $orders->code; ?>
                                                            </a>
                                                        </td>
                                                        <td>
                                                            Name: <?php echo $orders->name; ?><br>
                                                            Phone: <?php echo $orders->phone; ?><br>
                                                            Email: <?php echo $orders->email; ?> <br>
                                                            Address: <?php echo $orders->adr; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $currency->code . "" . $orders->amount; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo date('d M Y g:ia', strtotime($orders->amount)); ?>
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
                                                                            <h6 class="modal-title m-0 text-white" id="exampleModalPrimary1">Update Resturant Supplier Order</h6>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="row">
                                                                                <form method="post" enctype="multipart/form-data" role="form">
                                                                                    <div class="card-body">
                                                                                        <div class="row">
                                                                                            <div class="form-group col-md-6">
                                                                                                <label for="">Order Amount </label>
                                                                                                <input value="<?php echo $orders->amount; ?>" required name="amount" class="form-control">

                                                                                                <input type="hidden" required name="code" value="<?php echo $orders->code; ?>" class="form-control">
                                                                                            </div>
                                                                                            <div class="form-group col-md-6">
                                                                                                <label for="">Order Status </label>
                                                                                                <select required name="status" class="form-control">
                                                                                                    <option><?php echo $orders->status; ?></option>
                                                                                                    <option>Paid</option>
                                                                                                    <option>Un Paid</option>
                                                                                                </select>
                                                                                                <input type="hidden" required name="code" value="<?php echo $orders->code; ?>" class="form-control">
                                                                                            </div>

                                                                                            <div class="form-group col-md-12">
                                                                                                <label for="">Order Details</label>
                                                                                                <textarea name="details" class="form-control" rows="5"><?php echo $orders->details; ?></textarea>
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
                                                                            <a href="order_resturants?delete_order=<?php echo $orders->code; ?>" class="text-center btn btn-danger"> Delete </a>
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
                                        <h6 class="modal-title m-0 text-white" id="exampleModalPrimary1">Add Supplier Expense</h6>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <form method="post" enctype="multipart/form-data" role="form">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label for="">Supplier Name</label>
                                                            <select name="supplier_id" class="select form-control">
                                                                <option>Select Supplier Name</option>
                                                                <?php
                                                                $ret = "SELECT * FROM  iResturant_Suppliers ";
                                                                $stmt = $mysqli->prepare($ret);
                                                                $stmt->execute(); //ok
                                                                $res = $stmt->get_result();
                                                                while ($suppliers = $res->fetch_object()) {
                                                                ?>
                                                                    <option value="<?php echo $suppliers->id; ?>"><?php echo $suppliers->name; ?></option>
                                                                <?php
                                                                } ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="">Order Amount </label>
                                                            <input type="text" required name="amount" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-md-12">
                                                            <label for="">Order Details</label>
                                                            <textarea name="details" class="form-control" rows="5"></textarea>
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