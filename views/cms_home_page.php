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
if (isset($_POST['update_home_page'])) {

    $landing_des = $_POST['landing_des'];
    $landing_title = $_POST['landing_title'];

    $landing_slide_1 = time() . $_FILES['landing_slide_1']['name'];
    move_uploaded_file($_FILES["landing_slide_1"]["tmp_name"], "../public/images/" . $landing_slide_1);

    $landing_slide_2 = time() . $_FILES['landing_slide_2']['name'];
    move_uploaded_file($_FILES["landing_slide_1"]["tmp_name"], "../public/images/" . $landing_slide_2);

    $landing_slide_3 = time() . $_FILES['landing_slide_3']['name'];
    move_uploaded_file($_FILES["landing_slide_1"]["tmp_name"], "../public/images/" . $landing_slide_3);

    $landing_slide_4 = time() . $_FILES['landing_slide_4']['name'];
    move_uploaded_file($_FILES["landing_slide_1"]["tmp_name"], "../public/images/" . $landing_slide_4);

    $landing_slide_5 = time() . $_FILES['landing_slide_5']['name'];
    move_uploaded_file($_FILES["landing_slide_1"]["tmp_name"], "../public/images/" . $landing_slide_5);

    $landing_about_title = $_POST['landing_about_title'];
    $landing_about = $_POST['landing_about'];
    $landing_about_desc = $_POST['landing_about_desc'];

    $query = "UPDATE iResturant_System_Details 
    SET  landing_des=?, landing_title = ?, landing_slide_1 =?,
    landing_slide_2 =?,  landing_slide_3 =?, landing_slide_4 =?, landing_slide_5 =?, landing_about_title =?, landing_about =?, landing_about_desc =? ";
    $stmt = $mysqli->prepare($query);
    $rc = $stmt->bind_param('ssssssssss', $landing_des, $landing_title, $landing_slide_1, $landing_slide_2, $landing_slide_3, $landing_slide_4, $landing_slide_5, $landing_about_title, $landing_about, $landing_about_desc);
    $stmt->execute();
    if ($stmt) {
        $success = "Home Page Content Updated";
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
                                    <h4 class="page-title">Home Page Settings</h4>
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                                        <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="dashboard">Lite CMS</a></li>
                                        <li class="breadcrumb-item active">Home Page Settings</li>
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
                                    <h3 class="text-center">Home Page Content Settings</h3>
                                    <?php
                                    $ret = "SELECT * FROM iResturant_System_Details";
                                    $stmt = $mysqli->prepare($ret);
                                    $stmt->execute(); //ok
                                    $res = $stmt->get_result();
                                    while ($system_settings = $res->fetch_object()) {
                                    ?>
                                        <form method="post" enctype="multipart/form-data" role="form">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="form-group col-md-4">
                                                        <label for="">Home Page Slide 1</label>
                                                        <input type="file" required name="landing_slide_1" required class="form-control" id="exampleInputEmail1">
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label for="">Home Page Slide 2</label>
                                                        <input type="file" required name="landing_slide_2" required class="form-control" id="exampleInputEmail1">
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label for="">Home Page Slide 3</label>
                                                        <input type="file" required name="landing_slide_3" required class="form-control" id="exampleInputEmail1">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="">Home Page Slide 4</label>
                                                        <input type="file" required name="landing_slide_4" required class="form-control" id="exampleInputEmail1">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="">Home Page Slide 5</label>
                                                        <input type="file" required name="landing_slide_5" required class="form-control" id="exampleInputEmail1">
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label for="">Home Page Title</label>
                                                        <input type="text" required name="landing_title" class="form-control" required value="<?php echo $system_settings->landing_title; ?>">
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label for="">Home Page About Title</label>
                                                        <input type="text" required name="landing_about_title" class="form-control" required value="<?php echo $system_settings->landing_about_title; ?>">
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label for="">Home Page Description</label>
                                                        <textarea type="text" required name="landing_des" class="summernote form-control" required><?php echo $system_settings->landing_des; ?></textarea>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label for="">Home Page About Details </label>
                                                        <textarea type="text" required name="landing_about" class="summernote form-control" required><?php echo $system_settings->landing_about; ?></textarea>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label for="">Home Page About Details </label>
                                                        <textarea type="text" required name="landing_about_desc" class="summernote form-control" required><?php echo $system_settings->landing_about_desc; ?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-end">
                                                <button type="submit" name="update_home_page" class="btn btn-primary">Submit</button>
                                            </div>
                                        </form>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>

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