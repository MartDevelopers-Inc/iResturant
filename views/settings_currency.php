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

/* Add Currency */
if (isset($_POST['add_currency'])) {
    $code = $_POST['code'];
    $name = $_POST['name'];
    $status = 'In active';

    $sql = "SELECT * FROM  iResturant_Currencies WHERE  (code='$code')  ";
    $res = mysqli_query($mysqli, $sql);
    if (mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_assoc($res);
        if ($code == $row['code']) {
            $err =  "Currency Already Exists";
        }
    } else {
        $query = "INSERT INTO iResturant_Currencies (code, name, status) VALUES(?,?,?)";
        $stmt = $mysqli->prepare($query);
        $rc = $stmt->bind_param('sss',  $code, $name, $status);
        $stmt->execute();
        if ($stmt) {
            $success = "$name Currency Added";
        } else {
            $info = "Please Try Again Or Try Later";
        }
    }
}

/* Update Currency */
if (isset($_POST['update_currency'])) {
    $id = $_POST['id'];
    $code = $_POST['code'];
    $name = $_POST['name'];

    $query = "UPDATE iResturant_Currencies SET code =?, name = ? WHERE id = ?";
    $stmt = $mysqli->prepare($query);
    $rc = $stmt->bind_param('sss', $code, $name, $id);
    $stmt->execute();
    if ($stmt) {
        $success = "$name Currency Updated";
    } else {
        $info = "Please Try Again Or Try Later";
    }
}

/* Delete Currency */
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $adn = 'DELETE FROM iResturant_Currencies WHERE id=?';
    $stmt = $mysqli->prepare($adn);
    $stmt->bind_param('s', $id);
    $stmt->execute();
    $stmt->close();
    if ($stmt) {
        $success = 'Deleted' && header('refresh:1; url=settings_currency');;
    } else {
        $info = 'Please Try Again Or Try Later';
    }
}

/* Make Currency Active */
if (isset($_GET['activate'])) {
    $delete = $_GET['activate'];
    $status = 'Active';
    /* Update Initial Current First */
    $clear_initial_current = "UPDATE  iResturant_Currencies SET status = '' ";
    $current = "UPDATE  iResturant_Currencies SET status ='$status' WHERE id = ?";

    $clear_stmt = $mysqli->prepare($clear_initial_current);
    $current_stmt = $mysqli->prepare($current);

    $current_stmt->bind_param('s', $delete);

    $clear_stmt->execute();
    $current_stmt->execute();

    $clear_stmt->close();
    $current_stmt->close();

    if ($clear_stmt && $current_stmt) {
        $success = 'Set As Active' && header('refresh:1; url=settings_currency');;
    } else {
        $info = "Please Try Again Or Try Later";
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
                                    <h4 class="page-title">Currencies</h4>
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                                        <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
                                        <li class="breadcrumb-item active">Currencies</li>
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
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_currency">Add Currency</button>
                        </div>


                        <hr>
                        <div class="card">
                            <!--end card-header-->
                            <div class="card-body table-responsive">
                                <div class="">
                                    <table class="table dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>Currency Code</th>
                                                <th>Currency Name</th>
                                                <th>Manage </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            /* Load Currency */
                                            $ret = "SELECT * FROM `iResturant_Currencies` ";
                                            $stmt = $mysqli->prepare($ret);
                                            $stmt->execute(); //ok
                                            $res = $stmt->get_result();
                                            while ($currency = $res->fetch_object()) {

                                            ?>
                                                <tr>
                                                    <td>
                                                        <?php echo $currency->code; ?>
                                                    </td>
                                                    <td><?php echo $currency->name; ?></td>
                                                    <td>
                                                        <?php
                                                        if ($currency->status == 'Active') {
                                                            /* Nothing */
                                                        } else {
                                                            echo
                                                            "
                                                                <a href='#mark-$currency->id' data-bs-toggle='modal' data-bs-target='#mark-$currency->id' class='btn btn-sm btn-outline-success'>
                                                                    <i data-feather='check' class='align-self-center icon-xs ms-1'></i> Set As Active
                                                                </a>
                                                            ";
                                                        }
                                                        ?>

                                                        <!-- Currency Active Modal -->
                                                        <div class="modal fade" id="mark-<?php echo $currency->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">CONFIRM</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body text-center text-danger">
                                                                        <h4>Set <?php echo $currency->code . " " . $currency->name; ?> As Active Currency</h4>
                                                                        <br>
                                                                        <button type="button" class="btn btn-soft-danger" data-bs-dismiss="modal">No</button>
                                                                        <a href="settings_currency?activate=<?php echo $currency->id; ?>" class="text-center btn btn-success"> Yes Set As Active </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- End  Modal -->

                                                        <a href="#edit-<?php echo $currency->id; ?>" data-bs-toggle="modal" data-bs-target="#edit-<?php echo $currency->id; ?>" class="btn btn-sm btn-outline-warning">
                                                            <i data-feather="edit" class="align-self-center icon-xs ms-1"></i> Edit
                                                        </a>

                                                        <!-- Update Modal -->
                                                        <div class="modal fade" id="edit-<?php echo $currency->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalPrimary1" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header bg-warning">
                                                                        <h6 class="modal-title m-0 text-white" id="exampleModalPrimary1">Update Currency</h6>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="row">
                                                                            <form method="post" enctype="multipart/form-data" role="form">
                                                                                <div class="card-body">
                                                                                    <div class="row">
                                                                                        <div class="form-group col-md-6">
                                                                                            <label for="">Currency Code</label>
                                                                                            <input type="text" required name="code" value="<?php echo $currency->code; ?>" class="form-control" id="exampleInputEmail1">
                                                                                            <input type="hidden" required name="id" value="<?php echo $currency->id; ?>" class="form-control" id="exampleInputEmail1">
                                                                                        </div>
                                                                                        <div class="form-group col-md-6">
                                                                                            <label for="">Currency Name</label>
                                                                                            <input type="text" required name="name" value="<?php echo $currency->name; ?>" class="form-control" id="exampleInputEmail1">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="text-center">
                                                                                    <button type="submit" name="update_currency" class="btn btn-primary">Submit</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- End Update Modal -->
                                                        <a href="#delete-<?php echo $currency->id; ?>" data-bs-toggle="modal" data-bs-target="#delete-<?php echo $currency->id; ?>" class="btn btn-sm btn-outline-danger">
                                                            <i data-feather="trash" class="align-self-center icon-xs ms-1"></i> Delete
                                                        </a>
                                                        <!-- Delete Modal -->
                                                        <div class="modal fade" id="delete-<?php echo $currency->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">CONFIRM</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                                                                    </div>
                                                                    <div class="modal-body text-center text-danger">
                                                                        <h4>Delete Currency?</h4>
                                                                        <br>
                                                                        <p>Heads Up, You are about to delete <?php echo $currency->code . " " . $currency->name; ?>. This action is irrevisble.</p>
                                                                        <button type="button" class="btn btn-soft-success" data-bs-dismiss="modal">No</button>
                                                                        <a href="settings_currency?delete=<?php echo $currency->id; ?>" class="text-center btn btn-danger"> Delete </a>
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
                        <!-- Add Room Modal -->
                        <div class="modal fade" id="add_currency" tabindex="-1" role="dialog" aria-labelledby="exampleModalPrimary1" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-primary">
                                        <h6 class="modal-title m-0 text-white" id="exampleModalPrimary1">Add Currency</h6>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <form method="post" enctype="multipart/form-data" role="form">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label for="">Currency Code</label>
                                                            <input type="text" required name="code" class="form-control" id="exampleInputEmail1">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="">Currency Name</label>
                                                            <input type="text" required name="name" class="form-control" id="exampleInputEmail1">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="text-center">
                                                    <button type="submit" name="add_currency" class="btn btn-primary">Submit</button>
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