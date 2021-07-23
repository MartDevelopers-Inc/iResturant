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
    $profile_pic = $time . $_FILES['profile_pic']['name'];
    move_uploaded_file($_FILES["profile_pic"]["tmp_name"], "../public/uploads/user_images/" . $time . $_FILES["profile_pic"]["name"]);

    $query = "UPDATE iResturant_Customer  SET  profile_pic =? WHERE id =?";
    $stmt = $mysqli->prepare($query);
    $rc = $stmt->bind_param('ss', $profile_pic, $id);
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
        $ret = "SELECT * FROM  iResturant_Customer WHERE id = '$view' ";
        $stmt = $mysqli->prepare($ret);
        $stmt->execute(); //ok
        $res = $stmt->get_result();
        while ($customer = $res->fetch_object()) {
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
                                        <h4 class="page-title"><?php echo $customer->name; ?> Profile</h4>
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="dashboard">Dastone</a></li>
                                            <li class="breadcrumb-item"><a href="hrm_customers">HRM </a></li>
                                            <li class="breadcrumb-item"><a href="hrm_customers">Customers</a></li>
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
                                                        if ($customer->profile_pic == '') {
                                                            $dir = '../public/uploads/user_images/no-profile.png';
                                                        } else {
                                                            $dir = "../public/uploads/user_images/$customer->profile_pic";
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
                                                                                        <input type="file" name="profile_pic" required class="form-control">
                                                                                        <input type="hidden" value="<?php echo $customer->id; ?>" name="id" class="form-control">
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
                                                        <h5 class="dastone-user-name"><?php echo $customer->name; ?></h5>
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
                                                    <li class="mt-2"><i class="ti ti-mobile me-2 text-secondary font-16 align-middle"></i> <b> Phone </b> : <?php echo $customer->phone; ?></li>
                                                    <li class="mt-2"><i class="ti ti-email text-secondary font-16 align-middle me-2"></i> <b> Email </b> : <?php echo $customer->email; ?></li>
                                                    <li class="mt-2"><i class="ti ti-tag text-secondary font-16 align-middle me-2"></i> <b> Address </b> : <?php echo $customer->adr; ?>

                                                    </li>
                                                </ul>

                                                <ul class="list-unstyled personal-detail mb-0">
                                                    <?php
                                                    $country = $customer->client_country;
                                                    $ret = "SELECT * FROM  iResturant_Country WHERE id = '$country' ";
                                                    $stmt = $mysqli->prepare($ret);
                                                    $stmt->execute(); //ok
                                                    $res = $stmt->get_result();
                                                    while ($country = $res->fetch_object()) {
                                                    ?>
                                                        <li class="mt-2"><i class="ti ti-gift me-2 text-secondary font-16 align-middle"></i> <b> Country Code </b> : <?php echo $country->code; ?></li>
                                                        <li class="mt-2"><i class="ti ti-flag text-secondary font-16 align-middle me-2"></i> <b> Country Name </b> : <?php echo $country->name; ?></li>
                                                    <?php } ?>
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