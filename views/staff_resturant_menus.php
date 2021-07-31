<?php

/*
 * Created on Sun Jul 18 2021
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
staff();

/* Add Meal Menu */
if (isset($_POST['add_meal'])) {
    $error = 0;

    if (isset($_POST['meal_id']) && !empty($_POST['meal_id'])) {
        $meal_id = mysqli_real_escape_string($mysqli, trim($_POST['meal_id']));
    } else {
        $error = 1;
        $err = "Meal ID Cannot Be Empty";
    }

    if (isset($_POST['meal_category_id']) && !empty($_POST['meal_category_id'])) {
        $meal_category_id = mysqli_real_escape_string($mysqli, trim($_POST['meal_category_id']));
    } else {
        $error = 1;
        $err = "Meal Category ID  Cannot Be Empty";
    }

    if (isset($_POST['meal_name']) && !empty($_POST['meal_name'])) {
        $meal_name = mysqli_real_escape_string($mysqli, trim($_POST['meal_name']));
    } else {
        $error = 1;
        $err = "Meal Name  Cannot Be Empty";
    }

    if (isset($_POST['meal_price']) && !empty($_POST['meal_price'])) {
        $meal_price = mysqli_real_escape_string($mysqli, trim($_POST['meal_price']));
    } else {
        $error = 1;
        $err = "Meal Price  Cannot Be Empty";
    }


    if (!$error) {
        $sql = "SELECT * FROM  iResturant_Menu WHERE  (meal_name='$meal_name')  ";
        $res = mysqli_query($mysqli, $sql);
        if (mysqli_num_rows($res) > 0) {
            $row = mysqli_fetch_assoc($res);
            if ($meal_name == $row['meal_name']) {
                $err =  "Meal With This  Name Already Exists In The Menu";
            }
        } else {
            $query = "INSERT INTO iResturant_Menu (meal_id, meal_category_id, meal_name, meal_price) VALUES(?,?,?,?)";
            $stmt = $mysqli->prepare($query);
            $rc = $stmt->bind_param('ssss', $meal_id, $meal_category_id, $meal_name, $meal_price);
            $stmt->execute();
            if ($stmt) {
                $success = "$meal_name  Added To Menu";
            } else {
                $info = "Please Try Again Or Try Later";
            }
        }
    }
}

/* Update Meal  */
if (isset($_POST['update_meal'])) {
    $error = 0;

    if (isset($_POST['meal_id']) && !empty($_POST['meal_id'])) {
        $meal_id = mysqli_real_escape_string($mysqli, trim($_POST['meal_id']));
    } else {
        $error = 1;
        $err = "Meal  ID Cannot Be Empty";
    }


    if (isset($_POST['meal_name']) && !empty($_POST['meal_name'])) {
        $meal_name = mysqli_real_escape_string($mysqli, trim($_POST['meal_name']));
    } else {
        $error = 1;
        $err = "Meal Name  Cannot Be Empty";
    }

    if (isset($_POST['meal_price']) && !empty($_POST['meal_price'])) {
        $meal_price = mysqli_real_escape_string($mysqli, trim($_POST['meal_price']));
    } else {
        $error = 1;
        $err = "Meal Price  Cannot Be Empty";
    }


    if (!$error) {
        $query = "UPDATE  iResturant_Menu SET meal_name =?, meal_price =? WHERE meal_id = ?";
        $stmt = $mysqli->prepare($query);
        $rc = $stmt->bind_param('sss', $meal_name, $meal_price, $meal_id);
        $stmt->execute();
        if ($stmt) {
            $success = "$meal_name  Updated";
        } else {
            $info = "Please Try Again Or Try Later";
        }
    }
}

require_once('../partials/head.php');
?>

<body>
    <!-- Left Sidenav -->
    <?php require_once('../partials/staff_sidebar.php'); ?>
    <!-- end left-sidenav-->


    <div class="page-wrapper">
        <!-- Top Bar Start -->
        <?php require_once('../partials/staff_header.php');
        /* Load Currency */
        $ret = "SELECT * FROM `iResturant_Currencies` WHERE status = 'Active'  ";
        $stmt = $mysqli->prepare($ret);
        $stmt->execute(); //ok
        $res = $stmt->get_result();
        while ($currency = $res->fetch_object()) {
        ?>
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
                                        <h4 class="page-title">Resturant Meal Menus</h4>
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="staff_dashboard">Home</a></li>
                                            <li class="breadcrumb-item"><a href="staff_dashboard">Dashboard</a></li>
                                            <li class="breadcrumb-item active">Menu</li>
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
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_meal_category">Add Meal</button>
                            </div>
                            <!-- Add Room Category Modal -->
                            <div class="modal fade" id="add_meal_category" tabindex="-1" role="dialog" aria-labelledby="exampleModalPrimary1" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header bg-primary">
                                            <h6 class="modal-title m-0 text-white" id="exampleModalPrimary1">Add Meal To Menu</h6>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <form method="post" enctype="multipart/form-data" role="form">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="form-group col-md-12">
                                                                <label for="">Meal Category Name</label>
                                                                <select id="MealCategoryName" class="select form-control" onchange="GetMealCategoryDetails(this.value);">
                                                                    <option>Select Meal Category</option>
                                                                    <?php
                                                                    $ret = "SELECT * FROM  iResturant_Meal_Category ";
                                                                    $stmt = $mysqli->prepare($ret);
                                                                    $stmt->execute(); //ok
                                                                    $res = $stmt->get_result();
                                                                    while ($cat = $res->fetch_object()) {
                                                                    ?>
                                                                        <option><?php echo $cat->name; ?></option>
                                                                    <?php
                                                                    } ?>
                                                                </select>
                                                                <input type="hidden" required name="meal_category_id" id="MealCategoryID" class="form-control">
                                                                <input type="hidden" required name="meal_id" value="<?php echo $sys_gen_id; ?>" class="form-control">
                                                            </div>
                                                            <div class="form-group col-md-12">
                                                                <label for="">Meal Name</label>
                                                                <input type="text" required name="meal_name" class="form-control" id="exampleInputEmail1">
                                                            </div>
                                                            <div class="form-group col-md-12">
                                                                <label for="">Meal Price (<?php echo $currency->code; ?>)</label>
                                                                <input type="text" required name="meal_price" class="form-control" id="exampleInputEmail1">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex justify-content-end">
                                                        <button type="submit" name="add_meal" class="btn btn-primary">Submit</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Add Room Categories -->

                            <hr>
                            <div class="card">
                                <!--end card-header-->
                                <div class="card-body table-responsive">
                                    <div class="">
                                        <table class="table dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>Meal Name</th>
                                                    <th>Meal Category</th>
                                                    <th>Meal Price</th>
                                                    <th>Manage</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $ret = "SELECT * FROM iResturant_Meal_Category mc
                                                INNER JOIN iResturant_Menu mn
                                                ON mn.meal_category_id = mc.id";
                                                $stmt = $mysqli->prepare($ret);
                                                $stmt->execute(); //ok
                                                $res = $stmt->get_result();
                                                while ($meals = $res->fetch_object()) {
                                                ?>
                                                    <tr>
                                                        <td><?php echo $meals->meal_name; ?></td>
                                                        <td><?php echo $meals->name; ?></td>
                                                        <td><?php echo $currency->code . " " . $meals->meal_price; ?></td>
                                                        <td>
                                                            <a href="#edit-<?php echo $meals->meal_id; ?>" data-bs-toggle="modal" data-bs-target="#edit-<?php echo $meals->meal_id; ?>" class="btn btn-sm btn-outline-warning">
                                                                <i data-feather="edit" class="align-self-center icon-xs ms-1"></i> Edit
                                                            </a>

                                                            <!-- Edit Room Category Modal -->
                                                            <div class="modal fade" id="edit-<?php echo $meals->meal_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalPrimary1" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header bg-warning">
                                                                            <h6 class="modal-title m-0 text-white" id="exampleModalPrimary1">Edit Meal</h6>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="row">
                                                                                <form method="post" enctype="multipart/form-data" role="form">
                                                                                    <div class="card-body">
                                                                                        <div class="row">
                                                                                            <div class="form-group col-md-12">
                                                                                                <label for="">Meal Name</label>
                                                                                                <input type="text" value="<?php echo $meals->meal_name; ?>" required name="meal_name" class="form-control" id="exampleInputEmail1">
                                                                                                <input type="hidden" required name="meal_id" value="<?php echo $meals->meal_id; ?>" class="form-control" id="exampleInputEmail1">

                                                                                            </div>
                                                                                            <div class="form-group col-md-12">
                                                                                                <label for="">Meal Price (<?php echo $currency->code; ?>)</label>
                                                                                                <input type="text" required value="<?php echo $meals->meal_price; ?>" name="meal_price" class="form-control" id="exampleInputEmail1">
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="d-flex justify-content-end">
                                                                                        <button type="submit" name="update_meal" class="btn btn-primary">Submit</button>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- End Edit Modal -->
                                                        </td>
                                                    </tr>
                                                <?php
                                                } ?>
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
        <?php
        } ?>
        <!-- end page content -->
    </div>
    <!-- end page-wrapper -->
    <!-- jQuery  -->
    <?php require_once('../partials/scripts.php'); ?>

</body>

</html>