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
client();

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
    <?php require_once('../partials/my_sidebar.php'); ?>

    <!-- end left-sidenav-->


    <div class="page-wrapper">
        <!-- Top Bar Start -->
        <?php require_once('../partials/my_header.php');
        $id = $_SESSION['id'];
        $ret = "SELECT * FROM  iResturant_Customer WHERE id = '$id' ";
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
                                            <li class="breadcrumb-item"><a href="my_dashboard">Dastone</a></li>
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
                                                        }
                                                        ?>
                                                        <img src="<?php echo $dir; ?>" alt="" height="110" class="rounded-circl">
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

                                                    <div class="dastone-profile_user-detail d-flex justify-content-end">

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
                                            <div class="col-lg-6 ms-auto align-self-center">
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
                            <div class="pb-4">
                                <ul class="nav-border nav nav-pills mb-0" id="pills-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="Profile_Project_tab" data-bs-toggle="pill" href="#Profile_Project">Update Profile Details</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link " id="Profile_Post_tab" data-bs-toggle="pill" href="#Profile_Post">Update Authentication Details</a>
                                    </li>
                                </ul>
                            </div>
                            <!--end card-body-->
                            <div class="row">
                                <div class="col-12">
                                    <div class="tab-content" id="pills-tabContent">
                                        <!-- Distinct Room Features -->
                                        <div class="tab-pane fade show active " id="Profile_Project" role="tabpanel" aria-labelledby="Profile_Project_tab">

                                            <!--end row-->
                                            <div class="row">
                                                <div class="col-12">
                                                    <form method="post" enctype="multipart/form-data" role="form">
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="form-group col-md-12">
                                                                    <label for="">Full Name </label>
                                                                    <input type="hidden" required name="id" value="<?php echo $customer->id; ?>" class="form-control">
                                                                    <input type="text" required name="name" class="form-control" value="<?php echo $customer->name; ?>" id="exampleInputEmail1">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label for="">Phone Number </label>
                                                                    <input type="text" required name="phone" value="<?php echo $customer->phone; ?>" class="form-control" id="exampleInputEmail1">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label for="">Email Address </label>
                                                                    <input type="text" required name="email" value="<?php echo $customer->email; ?>" class="form-control" id="exampleInputEmail1">
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
                                                                <div class="form-group col-md-12">
                                                                    <label for="">Address</label>
                                                                    <textarea type="text" required name="adr" class="form-control" rows="4" id="exampleInputEmail1"><?php echo $customer->adr; ?></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex justify-content-end">
                                                            <button type="submit" name="update_customer" class="btn btn-primary">Submit</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Previous Room Reservations -->
                                        <div class="tab-pane fade " id="Profile_Post" role="tabpanel" aria-labelledby="Profile_Post_tab">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <form method="post" enctype="multipart/form-data" role="form">
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="form-group col-md-12">
                                                                    <label for="">Old Password </label>
                                                                    <input type="password" required name="old_password" class="form-control" id="exampleInputEmail1">
                                                                    <input type="hidden" required name="id" value="<?php echo $customer->id; ?>" class="form-control">
                                                                </div>
                                                                <div class="form-group col-md-12">
                                                                    <label for="">New Password </label>
                                                                    <input type="password" required name="new_password" class="form-control" id="exampleInputEmail1">
                                                                </div>
                                                                <div class="form-group col-md-12">
                                                                    <label for="">Confirm Password</label>
                                                                    <input type="password" required name="confirm_password" class="form-control" id="exampleInputEmail1">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex justify-content-end">
                                                            <button type="submit" name="update_staff_password" class="btn btn-primary">Submit</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
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