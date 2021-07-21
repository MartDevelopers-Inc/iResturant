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
require_once('../config/DataSource.php');
require_once('../vendor/autoload.php');
admin_check_login();

/* Add Supllier */
if (isset($_POST['add_supplier'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $adr = $_POST['adr'];
    $status = 'Active';

    $sql = "SELECT * FROM  iResturant_Suppliers  WHERE  (email='$email' || phone = '$phone')  ";
    $res = mysqli_query($mysqli, $sql);
    if (mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_assoc($res);
        if ($email == $row['email'] || $phone == $row['phone']) {
            $err =  "A Suplier Account With This Email Or Phone Number Already Exists";
        }
    } else {
        $query = "INSERT INTO iResturant_Suppliers (id, name, email, phone, adr, status) VALUES(?,?,?,?,?,?)";
        $stmt = $mysqli->prepare($query);
        $rc = $stmt->bind_param('ssssss', $id, $name, $email, $phone, $adr, $status);
        $stmt->execute();
        if ($stmt) {
            $success = "$name Added";
        } else {
            $info = "Please Try Again Or Try Later";
        }
    }
}


/* Update Supplier */
if (isset($_POST['update_supplier'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $adr = $_POST['adr'];

    $query = "UPDATE  iResturant_Suppliers SET name =?,  email =?, phone =?, adr =? WHERE id = ?";
    $stmt = $mysqli->prepare($query);
    $rc = $stmt->bind_param('sssss', $name, $email, $phone, $adr, $id);
    $stmt->execute();
    if ($stmt) {
        $success = "$name Updated";
    } else {
        $info = "Please Try Again Or Try Later";
    }
}


/* Delete Supplier */
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $adn = 'DELETE FROM iResturant_Suppliers WHERE id=?';
    $stmt = $mysqli->prepare($adn);
    $stmt->bind_param('s', $id);
    $stmt->execute();
    $stmt->close();
    if ($stmt) {
        $success = 'Supplier Account Deleted' && header('refresh:1; url=hrm_suppliers');;
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
                                    <h4 class="page-title">HRM - Suppliers</h4>
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="dashboard">HRM</a></li>
                                        <li class="breadcrumb-item active">Suppliers</li>
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
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_modal">Add Supplier</button>

                        </div>
                        <!-- Add  Modal -->
                        <div class="modal fade" id="add_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalPrimary1" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-primary">
                                        <h6 class="modal-title m-0 text-white" id="exampleModalPrimary1">Fill All Required Fields</h6>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <form method="post" enctype="multipart/form-data" role="form">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="form-group col-md-12">
                                                            <label for="">Full Name </label>
                                                            <input type="hidden" required name="id" value="<?php echo $sys_gen_id; ?>" class="form-control">
                                                            <input type="text" required name="name" class="form-control" id="exampleInputEmail1">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="">Phone Number </label>
                                                            <input type="text" required name="phone" class="form-control" id="exampleInputEmail1">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="">Email Address </label>
                                                            <input type="text" required name="email" class="form-control" id="exampleInputEmail1">
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <label for="">Address</label>
                                                            <textarea type="text" required name="adr" class="form-control" rows="4" id="exampleInputEmail1"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="text-center">
                                                    <button type="submit" name="add_supplier" class="btn btn-primary">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Modal -->

                        <hr>
                        <div class="card">
                            <!--end card-header-->
                            <div class="card-body table-responsive">
                                <div class="">
                                    <table class="table dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Contact Details</th>
                                                <th>Manage</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $ret = "SELECT * FROM  iResturant_Suppliers ";
                                            $stmt = $mysqli->prepare($ret);
                                            $stmt->execute(); //ok
                                            $res = $stmt->get_result();
                                            while ($suppliers = $res->fetch_object()) {
                                            ?>
                                                <tr>
                                                    <td><?php echo $suppliers->name; ?></td>
                                                    <td>
                                                        Phone: <?php echo $suppliers->phone; ?><br>
                                                        Email: <?php echo $suppliers->email; ?><br>
                                                        Adr: <?php echo $suppliers->adr; ?>
                                                    </td>
                                                    <td>
                                                        <a href="#edit-<?php echo $suppliers->id; ?>" data-bs-toggle="modal" data-bs-target="#edit-<?php echo $suppliers->id; ?>" class="btn btn-sm btn-outline-warning">
                                                            <i data-feather="edit" class="align-self-center icon-xs ms-1"></i> Edit
                                                        </a>
                                                        <a href="#delete-<?php echo $suppliers->id; ?>" data-bs-toggle="modal" data-bs-target="#delete-<?php echo $suppliers->id; ?>" class="btn btn-sm btn-outline-danger">
                                                            <i data-feather="trash" class="align-self-center icon-xs ms-1"></i> Delete
                                                        </a>
                                                        <!-- Edit  Modal -->
                                                        <div class="modal fade" id="edit-<?php echo $suppliers->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalPrimary1" aria-hidden="true">
                                                            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header bg-warning">
                                                                        <h6 class="modal-title m-0 text-white" id="exampleModalPrimary1">Edit Supplier Accoun</h6>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="row">
                                                                            <form method="post" enctype="multipart/form-data" role="form">
                                                                                <div class="card-body">
                                                                                    <div class="row">
                                                                                        <div class="form-group col-md-12">
                                                                                            <label for="">Full Name </label>
                                                                                            <input type="hidden" required name="id" value="<?php echo $suppliers->id; ?>" class="form-control">
                                                                                            <input type="text" required name="name" value="<?php echo $suppliers->name; ?>" class="form-control" id="exampleInputEmail1">
                                                                                        </div>
                                                                                        <div class="form-group col-md-6">
                                                                                            <label for="">Phone Number </label>
                                                                                            <input type="text" required name="phone" value="<?php echo $suppliers->phone; ?>" class="form-control" id="exampleInputEmail1">
                                                                                        </div>
                                                                                        <div class="form-group col-md-6">
                                                                                            <label for="">Email Address </label>
                                                                                            <input type="text" required name="email" value="<?php echo $suppliers->email; ?>" class="form-control" id="exampleInputEmail1">
                                                                                        </div>
                                                                                        <div class="form-group col-md-12">
                                                                                            <label for="">Address</label>
                                                                                            <textarea type="text" required name="adr" value="" class="form-control" rows="4" id="exampleInputEmail1"><?php echo $suppliers->adr; ?></textarea>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="text-center">
                                                                                    <button type="submit" name="update_supplier" class="btn btn-primary">Submit</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- End Edit Modal -->

                                                        <!-- Delete Room Category Modal -->
                                                        <div class="modal fade" id="delete-<?php echo $suppliers->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">CONFIRM</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                                                                    </div>
                                                                    <div class="modal-body text-center text-danger">
                                                                        <h4>Delete <?php echo $suppliers->name; ?> ?</h4>
                                                                        <br>
                                                                        <p>Heads Up, You are about to delete <?php echo $suppliers->name; ?> account.<br> This action is irrevisble.</p>
                                                                        <button type="button" class="btn btn-soft-success" data-bs-dismiss="modal">No</button>
                                                                        <a href="hrm_suppliers?delete=<?php echo $suppliers->id; ?>" class="text-center btn btn-danger"> Delete </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- End Delete Modal -->
                                                    </td>
                                                </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end row-->
            </div><!-- container -->

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