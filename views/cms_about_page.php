<?php
/*
 * Created on Thu Jul 29 2021
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

/* Update System Settings */
if (isset($_POST['update_system_settings'])) {

    $about = $_POST['about'];
    $patners = $_POST['patners'];
    $properties = $_POST['properties'];
    $orders_made = $_POST['orders_made'];
    $bookings = $_POST['bookings'];

    $query = "UPDATE iResturant_System_Details SET  about=?, patners = ?, properties =?, orders_made =?, bookings=?  ";
    $stmt = $mysqli->prepare($query);
    $rc = $stmt->bind_param('sssss', $about, $patners, $properties, $orders_made, $bookings);
    $stmt->execute();
    if ($stmt) {
        $success = "About Page Content Updated";
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
        <?php require_once('../partials/header.php');
        $ret = "SELECT * FROM iResturant_System_Details";
        $stmt = $mysqli->prepare($ret);
        $stmt->execute(); //ok
        $res = $stmt->get_result();
        while ($system_settings = $res->fetch_object()) {
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
                                        <h4 class="page-title">About <?php echo $system_settings->system_name; ?></h4>
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                                            <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
                                            <li class="breadcrumb-item"><a href="dashboard">Lite CMS</a></li>
                                            <li class="breadcrumb-item active">About Pages</li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end page title end breadcrumb -->


                    <div class="row">
                        <div class="col-lg-12 col-sm-12">
                            <div class="card">
                                <!--end card-header-->
                                <div class="card-body table-responsive">
                                    <div class="">
                                        <h3 class="text-center">About Page Content</h3>

                                        <form method="post" enctype="multipart/form-data" role="form">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="form-group col-md-3">
                                                        <label for="">Partners</label>
                                                        <input type="text" required name="patners" required value="<?php echo $system_settings->patners; ?>" class="form-control" id="exampleInputEmail1">
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <label for="">Properties</label>
                                                        <input type="text" required name="properties" required value="<?php echo $system_settings->properties; ?>" class="form-control" id="exampleInputEmail1">
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <label for="">Orders Made</label>
                                                        <input type="text" required name="orders_made" required value="<?php echo $system_settings->orders_made; ?>" class="form-control" id="exampleInputEmail1">
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <label for="">Booking</label>
                                                        <input type="text" required name="bookings" required value="<?php echo $system_settings->bookings; ?>" class="form-control" id="exampleInputEmail1">
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label for=""><?php echo $system_settings->system_name; ?></label>
                                                        <textarea type="text" required name="about" class="summernote form-control" required><?php echo $system_settings->about; ?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-end">
                                                <button type="submit" name="update_system_settings" class="btn btn-primary">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            <?php
        }
        require_once('../partials/footer.php'); ?>
            <!--end footer-->
            </div>
            <!-- end page content -->
    </div>
    <!-- end page-wrapper -->
    <!-- jQuery  -->
    <?php require_once('../partials/scripts.php'); ?>

</body>

</html>