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
staff();
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

/* Update Profile */
if (isset($_POST['update_staff'])) {
    $error = 0;
    if (isset($_POST['id']) && !empty($_POST['id'])) {
        $id = mysqli_real_escape_string($mysqli, trim($_POST['id']));
    } else {
        $error = 1;
        $err = "ID Cannot Be Empty";
    }
    if (isset($_POST['number']) && !empty($_POST['number'])) {
        $number = mysqli_real_escape_string($mysqli, trim($_POST['number']));
    } else {
        $error = 1;
        $err = "Staff Number Cannot Be Empty";
    }
    if (isset($_POST['name']) && !empty($_POST['name'])) {
        $name = mysqli_real_escape_string($mysqli, trim($_POST['name']));
    } else {
        $error = 1;
        $err = "Staff Name Cannot Be Empty";
    }
    if (isset($_POST['dob']) && !empty($_POST['dob'])) {
        $dob = mysqli_real_escape_string($mysqli, trim($_POST['dob']));
    } else {
        $error = 1;
        $err = "Staff DOB Cannot Be Empty";
    }
    if (isset($_POST['gender']) && !empty($_POST['gender'])) {
        $gender = mysqli_real_escape_string($mysqli, trim($_POST['gender']));
    } else {
        $error = 1;
        $err = "Staff Gender Cannot Be Empty";
    }
    if (isset($_POST['phone']) && !empty($_POST['phone'])) {
        $phone = mysqli_real_escape_string($mysqli, trim($_POST['phone']));
    } else {
        $error = 1;
        $err = "Staff Phone Number Cannot Be Empty";
    }
    if (isset($_POST['email']) && !empty($_POST['email'])) {
        $email = mysqli_real_escape_string($mysqli, trim($_POST['email']));
    } else {
        $error = 1;
        $err = "Staff Email Number Cannot Be Empty";
    }
    if (isset($_POST['adr']) && !empty($_POST['adr'])) {
        $adr = mysqli_real_escape_string($mysqli, trim($_POST['adr']));
    } else {
        $error = 1;
        $err = "Staff Address Cannot Be Empty";
    }

    $date_employed = $_POST['date_employed'];

    if (!$error) {

        $query = "UPDATE  iResturant_Staff SET name =?, dob =?, gender =?, phone =?, email =?, adr =?, date_employed =? WHERE id =?";
        $stmt = $mysqli->prepare($query);
        $rc = $stmt->bind_param('ssssssss', $name, $dob, $gender, $phone, $email, $adr, $date_employed, $id);
        $stmt->execute();
        if ($stmt) {
            $success = "$name - $number  Account Updated";
        } else {
            $info = "Please Try Again Or Try Later";
        }
    }
}

/* Update Login Details */
if (isset($_POST['update_staff_password'])) {

    $error = 0;
    if (isset($_POST['old_password']) && !empty($_POST['old_password'])) {
        $old_password = mysqli_real_escape_string($mysqli, trim(sha1(md5($_POST['old_password']))));
    } else {
        $error = 1;
        $err = "Old Password Cannot Be Empty";
    }
    if (isset($_POST['new_password']) && !empty($_POST['new_password'])) {
        $new_password = mysqli_real_escape_string($mysqli, trim(sha1(md5($_POST['new_password']))));
    } else {
        $error = 1;
        $err = "New Password Cannot Be Empty";
    }
    if (isset($_POST['confirm_password']) && !empty($_POST['confirm_password'])) {
        $confirm_password = mysqli_real_escape_string($mysqli, trim(sha1(md5($_POST['confirm_password']))));
    } else {
        $error = 1;
        $err = "Confirmation Password Cannot Be Empty";
    }

    if (!$error) {
        $id = $_SESSION['id'];
        $sql = "SELECT * FROM  iResturant_Staff  WHERE id = '$id'";
        $res = mysqli_query($mysqli, $sql);
        if (mysqli_num_rows($res) > 0) {
            $row = mysqli_fetch_assoc($res);
            if ($old_password != $row['login_password']) {
                $err =  "Please Enter Correct Old Password";
            } elseif ($new_password != $confirm_password) {
                $err = "Confirmation Password Does Not Match";
            } else {
                $id = $_SESSION['id'];
                $new_password  = sha1(md5($_POST['new_password']));
                $query = "UPDATE iResturant_Staff SET  login_password =? WHERE id =?";
                $stmt = $mysqli->prepare($query);
                $rc = $stmt->bind_param('ss', $new_password, $id);
                $stmt->execute();
                if ($stmt) {
                    $success = "Profile Updated";
                } else {
                    $err = "Please Try Again Or Try Later";
                }
            }
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
        $number = $_SESSION['number'];
        $ret = "SELECT * FROM  iResturant_Staff WHERE number = '$number' ";
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
                                            <li class="breadcrumb-item"><a href="staff_dashboard">Dashboard</a></li>
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
                                                    <li class="mt-2"><i class="ti ti-user me-2 text-secondary font-16 align-middle"></i> <b> Name </b> : <?php echo $staff->name; ?></li>
                                                    <li class="mt-2"><i class="ti ti-tag me-2 text-secondary font-16 align-middle"></i> <b> Number </b> : <?php echo $staff->number; ?></li>
                                                    <li class="mt-2"><i class="ti ti-mobile me-2 text-secondary font-16 align-middle"></i> <b> Phone </b> : <?php echo $staff->phone; ?></li>
                                                    <li class="mt-2"><i class="ti ti-email text-secondary font-16 align-middle me-2"></i> <b> Email </b> : <?php echo $staff->email; ?></li>
                                                </ul>
                                            </div>
                                            <div class="col-lg-6 ms-auto align-self-center">
                                                <ul class="list-unstyled personal-detail mb-0">
                                                    <li class="mt-2"><i class="ti ti-tag text-secondary font-16 align-middle me-2"></i> <b> Gender </b> : <?php echo $staff->gender; ?>
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
                                                                <div class="form-group col-md-6">
                                                                    <label for="">Number </label>
                                                                    <input type="text" readonly required name="number" value="<?php echo $staff->number; ?>" class="form-control" id="exampleInputEmail1">
                                                                    <input type="hidden" required name="id" value="<?php echo $staff->id; ?>" class="form-control">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label for="">Full Name </label>
                                                                    <input type="text" required name="name" value="<?php echo $staff->name; ?>" class="form-control" id="exampleInputEmail1">
                                                                </div>
                                                                <div class="form-group col-md-4">
                                                                    <label for="">Gender </label>
                                                                    <select type="text" required name="gender" class="form-control">
                                                                        <option>Male</option>
                                                                        <option>Female</option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group col-md-4">
                                                                    <label for="">D.O.B </label>
                                                                    <input type="text" placeholder="DD/MM/YYYY" value="<?php echo $staff->dob; ?>" required name="dob" class="form-control" id="exampleInputEmail1">
                                                                </div>
                                                                <div class="form-group col-md-4">
                                                                    <label for="">Phone Number </label>
                                                                    <input type="text" required name="phone" value="<?php echo $staff->phone; ?>" class="form-control" id="exampleInputEmail1">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label for="">Email Address </label>
                                                                    <input type="text" required value="<?php echo $staff->email; ?>" name="email" class="form-control" id="exampleInputEmail1">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label for="">Date Employed </label>
                                                                    <input type="date" readonly required value="<?php echo $staff->date_employed; ?>" name="date_employed" class="form-control" id="exampleInputEmail1">
                                                                </div>

                                                                <div class="form-group col-md-12">
                                                                    <label for="">Address</label>
                                                                    <textarea type="text" required name="adr" class="form-control" rows="4" id="exampleInputEmail1"><?php echo $staff->adr; ?></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex justify-content-end">
                                                            <button type="submit" name="update_staff" class="btn btn-primary">Submit</button>
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
                                                                    <input type="hidden" required name="id" value="<?php echo $staff->id; ?>" class="form-control">
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