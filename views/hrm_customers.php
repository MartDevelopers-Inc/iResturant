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

/* Add Customer */
if (isset($_POST['add_customer'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $adr = $_POST['adr'];
    $status = 'Active';
    $client_country = $_POST['client_country'];
    $login_password = sha1(md5('login_password'));

    $sql = "SELECT * FROM  iResturant_Customer  WHERE  (email='$email' || phone = '$phone')  ";
    $res = mysqli_query($mysqli, $sql);
    if (mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_assoc($res);
        if ($email == $row['email'] || $phone == $row['phone']) {
            $err =  "A Client Account With This Email Or Phone Number Already Exists";
        }
    } else {
        $query = "INSERT INTO iResturant_Customer (id, name, email, phone, adr, client_country, login_password) VALUES(?,?,?,?,?,?,?)";
        $stmt = $mysqli->prepare($query);
        $rc = $stmt->bind_param('sssssss', $id, $name, $email, $phone, $adr, $client_country, $login_password);
        $stmt->execute();
        if ($stmt) {
            $success = "$name Account Created";
        } else {
            $info = "Please Try Again Or Try Later";
        }
    }
}


/* Update Client */
if (isset($_POST['update_customer'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $adr = $_POST['adr'];
    $status = 'Active';
    $query = "UPDATE  iResturant_Customer SET  name =?, email =?, phone =?, adr =? WHERE id = ?";
    $stmt = $mysqli->prepare($query);
    $rc = $stmt->bind_param('sssss', $name, $email, $phone, $adr, $id);
    $stmt->execute();
    if ($stmt) {
        $success = "$name Account Created";
    } else {
        $info = "Please Try Again Or Try Later";
    }
}


/* Delete Client */
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $adn = 'DELETE FROM iResturant_Customer WHERE id=?';
    $stmt = $mysqli->prepare($adn);
    $stmt->bind_param('s', $id);
    $stmt->execute();
    $stmt->close();
    if ($stmt) {
        $success = 'Customer Account Deleted' && header('refresh:1; url=hrm_customers');;
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
                                    <h4 class="page-title">HRM - Customers</h4>
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="dashboard">HRM</a></li>
                                        <li class="breadcrumb-item active">Customers</li>
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
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_modal">Add Customer</button>

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
                                                        <div class="form-group col-md-6">
                                                            <label for="">Country </label>
                                                            <select name="client_country" value required class="form-control" id="exampleInputEmail1">
                                                                <?php
                                                                $ret = "SELECT * FROM  iResturant_Country ";
                                                                $stmt = $mysqli->prepare($ret);
                                                                $stmt->execute(); //ok
                                                                $res = $stmt->get_result();
                                                                while ($country = $res->fetch_object()) {
                                                                ?>
                                                                    <option value="<?php echo $country->id; ?>"><?php echo $country->name; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="">Login Password </label>
                                                            <input type="text" required name="login_password" value="<?php echo $sys_gen_password; ?>" class="form-control" id="exampleInputEmail1">
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <label for="">Address</label>
                                                            <textarea type="text" required name="adr" class="form-control" rows="4" id="exampleInputEmail1"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="text-center">
                                                    <button type="submit" name="add_customer" class="btn btn-primary">Submit</button>
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
                                            $ret =
                                                "SELECT * FROM iResturant_Customer  ";
                                            $stmt = $mysqli->prepare($ret);
                                            $stmt->execute(); //ok
                                            $res = $stmt->get_result();
                                            while ($client = $res->fetch_object()) {
                                            ?>
                                                <tr>
                                                    <td><?php echo $client->name; ?></td>
                                                    <td>
                                                        Phone: <?php echo $client->phone; ?><br>
                                                        Email: <?php echo $client->email; ?><br>
                                                        Adr: <?php echo $client->adr; ?>
                                                    </td>
                                                    <td>
                                                        <a href="#edit-<?php echo $client->id; ?>" data-bs-toggle="modal" data-bs-target="#edit-<?php echo $client->id; ?>" class="btn btn-sm btn-outline-warning">
                                                            <i data-feather="edit" class="align-self-center icon-xs ms-1"></i> Edit
                                                        </a>
                                                        <a href="#delete-<?php echo $client->id; ?>" data-bs-toggle="modal" data-bs-target="#delete-<?php echo $client->id; ?>" class="btn btn-sm btn-outline-danger">
                                                            <i data-feather="trash" class="align-self-center icon-xs ms-1"></i> Delete
                                                        </a>
                                                        <!-- Edit  Modal -->
                                                        <div class="modal fade" id="edit-<?php echo $client->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalPrimary1" aria-hidden="true">
                                                            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header bg-warning">
                                                                        <h6 class="modal-title m-0 text-white" id="exampleModalPrimary1">Edit Client Account</h6>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="row">
                                                                            <form method="post" enctype="multipart/form-data" role="form">
                                                                                <div class="card-body">
                                                                                    <div class="row">
                                                                                        <div class="form-group col-md-12">
                                                                                            <label for="">Full Name </label>
                                                                                            <input type="hidden" required name="id" value="<?php echo $client->email; ?>" class="form-control">
                                                                                            <input type="text" required name="name" value="<?php echo $client->name; ?>" class="form-control" id="exampleInputEmail1">
                                                                                        </div>
                                                                                        <div class="form-group col-md-6">
                                                                                            <label for="">Phone Number </label>
                                                                                            <input type="text" required name="phone" class="form-control" value="<?php echo $client->email; ?>" id="exampleInputEmail1">
                                                                                        </div>
                                                                                        <div class="form-group col-md-6">
                                                                                            <label for="">Email Address </label>
                                                                                            <input type="text" required name="email" class="form-control" value="<?php echo $client->email; ?>" id="exampleInputEmail1">
                                                                                        </div>
                                                                                        <div class="form-group col-md-12">
                                                                                            <label for="">Address</label>
                                                                                            <textarea type="text" required name="adr" class="form-control" rows="4" id="exampleInputEmail1"><?php echo $client->adr; ?></textarea>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="text-center">
                                                                                    <button type="submit" name="update_customer" class="btn btn-primary">Submit</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- End Edit Modal -->

                                                        <!-- Delete Room Category Modal -->
                                                        <div class="modal fade" id="delete-<?php echo $client->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">CONFIRM</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                                                                    </div>
                                                                    <div class="modal-body text-center text-danger">
                                                                        <h4>Delete <?php echo $client->name; ?> ?</h4>
                                                                        <br>
                                                                        <p>Heads Up, You are about to delete <?php echo $client->name; ?> account.<br> This action is irrevisble.</p>
                                                                        <button type="button" class="btn btn-soft-success" data-bs-dismiss="modal">No</button>
                                                                        <a href="hrm_customers?delete=<?php echo $client->id; ?>" class="text-center btn btn-danger"> Delete </a>
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