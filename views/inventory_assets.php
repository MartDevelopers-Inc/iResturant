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


/* Add Asset */
if (isset($_POST['add_equipment'])) {
    $id = $sys_gen_id_alt_1;
    $name = $_POST['name'];
    $manufacturer  = $_POST['manufacturer'];
    $manufacturing_date = $_POST['manufacturing_date'];
    $life_span = $_POST['life_span'];
    $how_many  = $_POST['how_many'];
    $status = $_POST['status'];

    $query = "INSERT INTO iResturant_Machines (id, name, manufacturer, manufacturing_date, life_span, how_many, status) VALUES(?,?,?,?,?,?,?)";
    $stmt = $mysqli->prepare($query);
    $rc = $stmt->bind_param('sssssss', $id, $name, $manufacturer, $manufacturing_date, $life_span, $how_many, $status);
    $stmt->execute();
    if ($stmt) {
        $success = "$name Added";
    } else {
        $info = "Please Try Again Or Try Later";
    }
}

/* Update Asset */
if (isset($_POST['update_equipment'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $manufacturer  = $_POST['manufacturer'];
    $manufacturing_date = $_POST['manufacturing_date'];
    $life_span = $_POST['life_span'];
    $how_many  = $_POST['how_many'];
    $status = $_POST['status'];

    $query = "UPDATE iResturant_Machines SET  name =?, manufacturer =?, manufacturing_date =?, life_span =?, how_many =?, status =? WHERE id =?";
    $stmt = $mysqli->prepare($query);
    $rc = $stmt->bind_param('sssssss',  $name, $manufacturer, $manufacturing_date, $life_span, $how_many, $status, $id);
    $stmt->execute();
    if ($stmt) {
        $success = "$name Updated";
    } else {
        $info = "Please Try Again Or Try Later";
    }
}

/* Delete Asset */
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $adn = 'DELETE FROM iResturant_Machines WHERE id=?';
    $stmt = $mysqli->prepare($adn);
    $stmt->bind_param('s', $id);
    $stmt->execute();
    $stmt->close();
    if ($stmt) {
        $success = 'Deleted' && header('refresh:1; url=inventory_assets');;
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
                                    <h4 class="page-title">Resturant Equipments</h4>
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                                        <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="inventory_assets">Equipments</a></li>
                                        <li class="breadcrumb-item active">Manage</li>
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
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_modal">Add Equipment</button>
                        </div>
                        <hr>
                        <div class="card">
                            <!--end card-header-->
                            <div class="card-body table-responsive">
                                <div class="">
                                    <table class="table dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Manufacturer</th>
                                                <th>Date Manufactured</th>
                                                <th>Life Span</th>
                                                <th>Quantity</th>
                                                <th>Status</th>
                                                <th>Manage</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php

                                            $ret = "SELECT * FROM  iResturant_Machines   ";
                                            $stmt = $mysqli->prepare($ret);
                                            $stmt->execute(); //ok
                                            $res = $stmt->get_result();
                                            while ($row = $res->fetch_object()) {
                                            ?>
                                                <tr>
                                                    <td>
                                                        <?php echo $row->name; ?>
                                                    </td>
                                                    <td><?php echo $row->manufacturer; ?></td>
                                                    <td><?php echo date('d M Y g:ia', strtotime($row->manufacturing_date)); ?></td>
                                                    <td><?php echo $row->life_span; ?></td>
                                                    <td><?php echo $row->how_many; ?></td>
                                                    <td><?php echo $row->status; ?></td>
                                                    <td>

                                                        <a href="#edit-<?php echo $row->id; ?>" data-bs-toggle="modal" data-bs-target="#edit-<?php echo $row->id; ?>" class="btn btn-sm btn-outline-warning">
                                                            <i data-feather="edit" class="align-self-center icon-xs ms-1"></i> Edit
                                                        </a>
                                                        <!-- Update Modal -->
                                                        <div class="modal fade" id="edit-<?php echo $row->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalPrimary1" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header bg-warning">
                                                                        <h6 class="modal-title m-0 text-white" id="exampleModalPrimary1">Edit Equipment</h6>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="row">
                                                                            <form method="post" enctype="multipart/form-data" role="form">
                                                                                <div class="card-body">
                                                                                    <div class="row">
                                                                                        <div class="form-group col-md-12">
                                                                                            <label for="">Name</label>
                                                                                            <input type="text" required name="name" value="<?php echo $row->name; ?>" class="form-control" id="exampleInputEmail1">
                                                                                            <input type="hidden" required name="id" value="<?php echo $row->id; ?>" class="form-control" id="exampleInputEmail1">
                                                                                        </div>
                                                                                        <div class="form-group col-md-6">
                                                                                            <label for="">Manufacturer</label>
                                                                                            <input type="text" required value="<?php echo $row->manufacturer; ?>" name="manufacturer" class="form-control" id="exampleInputEmail1">
                                                                                        </div>
                                                                                        <div class="form-group col-md-6">
                                                                                            <label for="">Manufacturing Date</label>
                                                                                            <input type="date" value="<?php echo $row->manufacturing_date; ?>" required name="manufacturing_date" class="form-control" id="exampleInputEmail1">
                                                                                        </div>
                                                                                        <div class="form-group col-md-4">
                                                                                            <label for="">Life Span</label>
                                                                                            <input type="text" value="<?php echo $row->life_span; ?>" required name="life_span" class="form-control" id="exampleInputEmail1">
                                                                                        </div>
                                                                                        <div class="form-group col-md-4">
                                                                                            <label for="">Quantity </label>
                                                                                            <input type="number" value="<?php echo $row->how_many; ?>" required name="how_many" class="form-control" id="exampleInputEmail1">
                                                                                        </div>
                                                                                        <div class="form-group col-md-4">
                                                                                            <label for="">Status </label>
                                                                                            <select required name="status" class="form-control">
                                                                                                <option><?php echo $row->status; ?></option>
                                                                                                <option>Functional</option>
                                                                                                <option>Faulty</option>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="d-flex justify-content-end">
                                                                                    <button type="submit" name="update_equipment" class="btn btn-primary">Submit</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- End Update Modal -->
                                                        <a href="#delete-<?php echo $row->id; ?>" data-bs-toggle="modal" data-bs-target="#delete-<?php echo $row->id; ?>" class="btn btn-sm btn-outline-danger">
                                                            <i data-feather="trash" class="align-self-center icon-xs ms-1"></i> Delete
                                                        </a>
                                                        <!-- Delete Modal -->
                                                        <div class="modal fade" id="delete-<?php echo $row->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">CONFIRM</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                                                                    </div>
                                                                    <div class="modal-body text-center text-danger">
                                                                        <h4>Delete Equipment ?</h4>
                                                                        <br>
                                                                        <p>Heads Up, You are about to delete <br> <?php echo $row->name; ?>. This action is irrevisble.</p>
                                                                        <button type="button" class="btn btn-soft-success" data-bs-dismiss="modal">No</button>
                                                                        <a href="inventory_assets?delete=<?php echo $row->id; ?>" class="text-center btn btn-danger"> Delete </a>
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
                        <div class="modal fade" id="add_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalPrimary1" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-primary">
                                        <h6 class="modal-title m-0 text-white" id="exampleModalPrimary1">Add Equipment</h6>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <form method="post" enctype="multipart/form-data" role="form">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="form-group col-md-12">
                                                            <label for="">Name</label>
                                                            <input type="text" required name="name" class="form-control" id="exampleInputEmail1">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="">Manufacturer</label>
                                                            <input type="text" required name="manufacturer" class="form-control" id="exampleInputEmail1">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="">Manufacturing Date</label>
                                                            <input type="date" required name="manufacturing_date" class="form-control" id="exampleInputEmail1">
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label for="">Life Span</label>
                                                            <input type="text" required name="life_span" class="form-control" id="exampleInputEmail1">
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label for="">Quantity </label>
                                                            <input type="number" required name="how_many" class="form-control" id="exampleInputEmail1">
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label for="">Status </label>
                                                            <select required name="status" class="form-control">
                                                                <option>Functional</option>
                                                                <option>Faulty</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-end">
                                                    <button type="submit" name="add_equipment" class="btn btn-primary">Submit</button>
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