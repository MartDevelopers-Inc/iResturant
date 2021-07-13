<?php
/*
 * Created on Tue Jul 13 2021
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
admin_check_login();
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
                                    <h4 class="page-title">Rooms</h4>
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                                        <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
                                        <li class="breadcrumb-item active">Rooms</li>
                                    </ol>
                                </div>
                                <!--end col-->
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
                    <div class="col-lg-12 col-sm-12">
                        <div class="text-center">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalPrimary">Add Room Category</button>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalPrimary">Manage Room Categories</button>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalPrimary">Add Room</button>
                        </div>
                        <!-- Add Room Category Modal -->
                        <div class="modal fade" id="add_room_category">
                            <div class="modal-dialog  modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Fill All Values</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" enctype="multipart/form-data" role="form">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <label for="">Room Category Name</label>
                                                        <input type="text" required name="name" class="form-control" id="exampleInputEmail1">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <button type="submit" name="add_category" class="btn btn-primary">Add Category</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Add Room Categor -->

                        <!-- Manage Room Category Modal -->

                        <!-- End Manage Room Category Modal -->


                        <!-- Add Room Category Modal -->

                        <!-- End Add Room Category Modal -->
                        <hr>
                        <div class="card">
                            <!--end card-header-->
                            <div class="card-body table-responsive">
                                <div class="">
                                    <table class="table dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>Room Number</th>
                                                <th>Room Category</th>
                                                <th>Room Price</th>
                                                <th>Room Status</th>
                                                <th>Manage Room</th>
                                            </tr>
                                        </thead>


                                        <tbody>
                                            <?php
                                            $ret = "SELECT iResturant_Room.number, iResturant_Room.price, iResturant_Room.status, iResturant_Room_Category.name FROM iResturant_Room LEFT JOIN iResturant_Room_Category ON iResturant_Room.room_category_id; ";
                                            $stmt = $mysqli->prepare($ret);
                                            $stmt->execute(); //ok
                                            $res = $stmt->get_result();
                                            while ($rooms = $res->fetch_object()) {
                                                /* Load Currency */
                                                $ret = "SELECT * FROM `iResturant_Currencies` WHERE status = 'Active'  ";
                                                $stmt = $mysqli->prepare($ret);
                                                $stmt->execute(); //ok
                                                $res = $stmt->get_result();
                                                while ($currency = $res->fetch_object()) {
                                            ?>
                                                    <tr>
                                                        <td><?php echo $rooms->number; ?></td>
                                                        <td><?php echo $rooms->name; ?></td>
                                                        <td><?php echo $currency->code . "" . $rooms->price; ?></td>
                                                        <td><?php echo $rooms->status; ?></td>
                                                        <td>
                                                        </td>

                                                    </tr>
                                            <?php
                                                }
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