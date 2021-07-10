<?php
/*
 * Created on Sat Jul 10 2021
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
        <?php require_once('../partials/header.php');
        $id = $_SESSION['id'];
        $ret = "SELECT * FROM `iResturant_Admin_Login` WHERE id = '$id'  ";
        $stmt = $mysqli->prepare($ret);
        $stmt->execute(); //ok
        $res = $stmt->get_result();
        while ($logged_in_user = $res->fetch_object()) {
        ?>
            <!-- Top Bar End -->

            <!-- Page Content-->
            <div class="page-content">
                <div class="container-fluid">
                    <!-- Page-Title -->
                    <div class="row">
                        <div class="col">
                            <h4 class="page-title">Administrator Profile Settings</h4>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Setings</li>
                            </ol>
                        </div>
                        <!--end col-->
                        <div class="col-sm-12">
                            <div class="page-title-box">
                                <div class="col-md-12">
                                    <div class="card card-primary card-outline">
                                        <div class="card-body">
                                            <form method='post' class="form-horizontal">
                                                <div class="form-group row">
                                                    <label for="inputName" class="col-sm-2 col-form-label">Email</label>
                                                    <div class="col-sm-10">
                                                        <input type="email" name="email" value="<?php echo $logged_in_user->email; ?>" required class="form-control" id="inputName">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputName" class="col-sm-2 col-form-label">Old Password</label>
                                                    <div class="col-sm-10">
                                                        <input type="password" name="old_password" required class="form-control" id="inputName">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputEmail" class="col-sm-2 col-form-label">New Password</label>
                                                    <div class="col-sm-10">
                                                        <input type="password" name="new_password" required class="form-control" id="inputEmail">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputName2" class="col-sm-2 col-form-label">Confirm New Password</label>
                                                    <div class="col-sm-10">
                                                        <input type="password" name="confirm_password" required class="form-control" id="inputName2">
                                                    </div>
                                                </div>
                                                <div class="form-group text-right row">
                                                    <div class="offset-sm-2 col-sm-10">
                                                        <button type="submit" name="change_password" class="btn btn-primary">Update Profile</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end row-->
                        </div>
                        <!--end page-title-box-->
                    </div>
                    <!--end col-->
                </div>
                <!--end row-->
                <!-- end page title end breadcrumb -->


            </div><!-- container -->

            <?php require_once('../partials/footer.php'); ?>
            <!--end footer-->
    </div>
<?php
        } ?>
<!-- end page content -->
</div>
<!-- end page-wrapper -->

<!-- App Js -->
<?php require_once('../partials/scripts.php'); ?>
</body>


</html>