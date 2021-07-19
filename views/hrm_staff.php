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
admin_check_login();
/* Update User Profile */
if (isset($_POST['update_profile_pic'])) {
    $id = $_POST['id'];
    $time = time();
    $passport = $time . $_FILES['passport']['name'];
    move_uploaded_file($_FILES["passport"]["tmp_name"], "../public/uploads/user_images/" . $time . $_FILES["passport"]["name"]);

    $query = "UPDATE iResturant_Staff  SET  passport =? WHERE id =?";
    $stmt = $mysqli->prepare($query);
    $rc = $stmt->bind_param('ss', $passport, $id);
    $stmt->execute();
    if ($stmt) {
        $success = "Profile Picture Updated";
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
        $view = $_GET['view'];
        $ret = "SELECT * FROM  iResturant_Staff WHERE id = '$view' ";
        $stmt = $mysqli->prepare($ret);
        $stmt->execute(); //ok
        $res = $stmt->get_result();
        while ($staff = $res->fetch_object()) {
        ?>

            <!-- Top Bar End -->
            <div class="page-content">
                <div class="container-fluid">
                    <!-- Page-Title -->
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="page-title-box">
                                <div class="row">
                                    <div class="col">
                                        <h4 class="page-title"><?php echo $staff->name; ?> Profile</h4>
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="dashboard">Dastone</a></li>
                                            <li class="breadcrumb-item"><a href="hrm_staffs">HRM </a></li>
                                            <li class="breadcrumb-item"><a href="hrm_staffs">Staffs</a></li>
                                            <li class="breadcrumb-item active">Profile</li>
                                        </ol>
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

                    <div class="row">
                        <div class="col-12" id="Print">
                            <div class="card">
                                <!--end card-body-->
                                <div class="card-body">
                                    <div class="dastone-profile">
                                        <div class="row">
                                            <div class="col-lg-12 align-self-center mb-3 mb-lg-0">
                                                <div class="dastone-profile-main">
                                                    <div class="dastone-profile-main-pic">
                                                        <?php
                                                        if ($staff->passport == '') {
                                                            $dir = '../public/uploads/user_images/no-profile.png';
                                                        } else {
                                                            $dir = "../public/uploads/user_images/$staff->passport";
                                                        } ?>
                                                        <img src="<?php echo $dir; ?>" alt="" height="110" class="rounded-circle">
                                                        <a href="#profile" data-bs-toggle="modal" data-bs-target="#profile" class="dastone-profile_main-pic-change">
                                                            <i class="fas fa-camera"></i>
                                                        </a>
                                                        <!-- Update Profile Modal -->
                                                        <div class="modal fade" id="profile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Edit Profile Picture</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form method="post" enctype="multipart/form-data" role="form">
                                                                            <div class="card-body">
                                                                                <div class="row">
                                                                                    <div class="form-group col-md-12">
                                                                                        <label for="">Passport (Profile Picture) </label>
                                                                                        <input type="file" name="passport" required class="form-control">
                                                                                        <input type="hidden" value="<?php echo $staff->id; ?>" name="id" class="form-control">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="text-center">
                                                                                <button type="submit" name="update_profile_pic" class="btn btn-primary">Submit</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- End Modal -->
                                                    </div>
                                                    <div class="dastone-profile_user-detail">
                                                        <h5 class="dastone-user-name"><?php echo $staff->name; ?></h5>
                                                        <p class="mb-0 dastone-user-name-post"><?php echo $staff->number; ?></p>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <!--end card-body-->
                                <div class="card-body">
                                    <div class="dastone-profile">
                                        <div class="row">
                                            <div class="col-lg-12 ms-auto align-self-center">
                                                <ul class="list-unstyled personal-detail mb-0">
                                                    <li class="mt-2"><i class="ti ti-mobile me-2 text-secondary font-16 align-middle"></i> <b> Phone </b> : <?php echo $staff->phone; ?></li>
                                                    <li class="mt-2"><i class="ti ti-email text-secondary font-16 align-middle me-2"></i> <b> Email </b> : <?php echo $staff->email; ?></li>
                                                    <li class="mt-2"><i class="ti ti-tag text-secondary font-16 align-middle me-2"></i> <b> Gender </b> : <?php echo $staff->gender; ?>
                                                    </li>
                                                </ul>

                                                <ul class="list-unstyled personal-detail mb-0">
                                                    <li class="mt-2"><i class="ti ti-gift me-2 text-secondary font-16 align-middle"></i> <b> D.O.B </b> : <?php echo date('d M Y', strtotime($staff->dob)); ?></li>
                                                    <li class="mt-2"><i class="ti ti-email text-secondary font-16 align-middle me-2"></i> <b> Address </b> : <?php echo $staff->adr; ?></li>
                                                    <li class="mt-2"><i class="ti ti-calendar text-secondary font-16 align-middle me-2"></i> <b> Date Employed </b> : <?php echo date('d M Y', strtotime($staff->date_employed)); ?>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="text-center">
                            <button id="print" onclick="printContent('Print');" type="button" class="btn btn-primary">
                                <i data-feather="printer" class="align-self-center icon-xs ms-1"></i>
                                Print
                            </button>
                        </div>
                    </div>
                </div><!-- container -->

                <?php require_once('../partials/footer.php'); ?>
                <!--end footer-->
            </div>
        <?php
        } ?>
        <!-- end page content -->
    </div>
    <!-- end page-wrapper -->

    <?php require_once('../partials/scripts.php'); ?>

</body>

</html>