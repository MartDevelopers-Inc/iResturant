<?php
/*
 * Created on Thu Jul 15 2021
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

/* Update Hotel Room */
if (isset($_POST['Update_Room'])) {
    $error = 0;
    if (isset($_POST['id']) && !empty($_POST['id'])) {
        $id = mysqli_real_escape_string($mysqli, trim($_POST['id']));
    } else {
        $error = 1;
        $err = "Room  ID Cannot Be Empty";
    }

    if (isset($_POST['number']) && !empty($_POST['number'])) {
        $number = mysqli_real_escape_string($mysqli, trim($_POST['number']));
    } else {
        $error = 1;
        $err = "Room Number Cannot Be Empty";
    }


    if (isset($_POST['price']) && !empty($_POST['price'])) {
        $price = mysqli_real_escape_string($mysqli, trim($_POST['price']));
    } else {
        $error = 1;
        $err = "Room Price Cannot Be Empty";
    }

    if (isset($_POST['room_category_id']) && !empty($_POST['room_category_id'])) {
        $room_category_id = mysqli_real_escape_string($mysqli, trim($_POST['room_category_id']));
    } else {
        $error = 1;
        $err = "Room Category ID  Cannot Be Empty";
    }


    if (isset($_POST['details']) && !empty($_POST['details'])) {
        $details = ($_POST['details']);
    } else {
        $error = 1;
        $err = "Room Details Cannot Be Empty";
    }

    if (!$error) {
        $query = "UPDATE iResturant_Room SET  number =?,  price =?, room_category_id =?,  details =? WHERE  id = ?";
        $stmt = $mysqli->prepare($query);
        $rc = $stmt->bind_param('sssss', $number, $price, $room_category_id, $details, $id);
        $stmt->execute();
        if ($stmt) {
            $success = "Room $number Updated";
        } else {
            $info = "Please Try Again Or Try Later";
        }
    }
}

/* Add Hotel Images */
if (isset($_POST['Upload_Images'])) {
    // Count total uploaded files
    $totalfiles = count($_FILES['file']['name']);
    $room_id = $_POST['room_id'];

    // Looping over all files
    for ($i = 0; $i < $totalfiles; $i++) {
        $filename = time() . $_FILES['file']['name'][$i];

        // Upload files and store in database
        if (move_uploaded_file($_FILES["file"]["tmp_name"][$i], '../public/uploads/sys_data/rooms/' . $filename)) {
            // Image db insert sql
            $insert = "INSERT INTO iResturant_Room_Images(room_id ,image ) values('$room_id','$filename')";
            if (mysqli_query($mysqli, $insert)) {
                $success =  'Room Images Updated';
            } else {
                $info =  'Error: ' . mysqli_error($mysqli);
            }
        } else {
            $err = 'Error in uploading file - ' . $_FILES['file']['name'][$i] . '<br/>';
        }
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
        /* Load Room Details */
        $ret = "SELECT * FROM `iResturant_Currencies` WHERE status = 'Active'  ";
        $stmt = $mysqli->prepare($ret);
        $stmt->execute(); //ok
        $res = $stmt->get_result();
        while ($currency = $res->fetch_object()) {
            $view = $_GET['view'];
            // $ret = "SELECT * FROM iResturant_Room WHERE id = '$view'  ";
            $ret = "SELECT iResturant_Room_Category.name, iResturant_Room.number, iResturant_Room.id, iResturant_Room.details, iResturant_Room.price, iResturant_Room.status 
            FROM iResturant_Room_Category 
            INNER JOIN iResturant_Room ON 
            iResturant_Room.room_category_id = iResturant_Room_Category.id 
            WHERE iResturant_Room.id ='$view' ;  
            
            ";
            $stmt = $mysqli->prepare($ret);
            $stmt->execute(); //ok
            $res = $stmt->get_result();
            while ($room = $res->fetch_object()) {
        ?>
                <!-- Page Content-->
                <div class="page-content">
                    <div class="container-fluid">
                        <!-- Page-Title -->
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="page-title-box">
                                    <div class="row">
                                        <div class="col">
                                            <h1 class="page-title"><b>Room Number : <?php echo $room->number; ?> Details</b></h1>
                                            <ol class="breadcrumb">
                                                <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
                                                <li class="breadcrumb-item"><a href="rooms">Rooms</a></li>
                                                <li class="breadcrumb-item active"><?php echo $room->number; ?></li>
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                                <!--end page-title-box-->
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->
                        <!-- end page title end breadcrumb -->

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <!-- <div class="card-body p-0">
                                    <div id="user_map" class="pro-map" style="height: 220px"></div>
                                </div> -->
                                    <!--end card-body-->
                                    <div class="card-body">
                                        <div class="dastone-profile">
                                            <div class="row">
                                                <div class="col-lg-4 align-self-center mb-3 mb-lg-0">
                                                    <div class="dastone-profile-main">
                                                        <!-- <div class="dastone-profile-main-pic">
                                                        <img src="assets/images/users/user-4.jpg" alt="" height="110" class="rounded-circle">
                                                        <span class="dastone-profile_main-pic-change">
                                                            <i class="fas fa-camera"></i>
                                                        </span>
                                                    </div> -->
                                                        <div class="dastone-profile_user-detail">
                                                            <h5 class="text-primary">Room Number : <?php echo $room->number; ?></h5>
                                                            <p class="mb-0 dastone-user-name-post text-primary">Category: <?php echo $room->name; ?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--end col-->

                                                <div class="col-lg-4 ms-auto align-self-center">
                                                    <ul class="list-unstyled personal-detail mb-0">
                                                        <li class=""><i class="ti ti-signal me-2 text-primary font-16 align-middle"></i> Status : <?php echo $room->status; ?></li>
                                                        <li class="mt-2"><i class="ti ti-money text-primary font-16 align-middle me-2"></i> Price : <?php echo $currency->code . " " . $room->price; ?></li>
                                                        </li>
                                                    </ul>

                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end row-->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-body  report-card">
                                                <div class="row">
                                                    <?php
                                                    $ret = "SELECT * FROM `iResturant_Room_Images` WHERE room_id = '$view'  ";
                                                    $stmt = $mysqli->prepare($ret);
                                                    $stmt->execute(); //ok
                                                    $res = $stmt->get_result();
                                                    while ($images = $res->fetch_object()) {
                                                    ?>
                                                        <img src="../public/uploads/sys_data/rooms/<?php echo $images->image; ?>" class="img-fluid col-md-4">
                                                    <?php
                                                    } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="pb-4">
                            <ul class="nav-border nav nav-pills mb-0" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="Profile_Project_tab" data-bs-toggle="pill" href="#Profile_Project">Distinct Features</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " id="Profile_Post_tab" data-bs-toggle="pill" href="#Profile_Post">Reservation History</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="settings_detail_tab" data-bs-toggle="pill" href="#Profile_Settings">Settings</a>
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
                                                <div class="text-center">
                                                    <h4 class="m-0 fw-semibold text-dark font-16 mt-3">
                                                        <?php echo $room->details; ?>
                                                    </h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Previous Room Reservations -->
                                    <div class="tab-pane fade " id="Profile_Post" role="tabpanel" aria-labelledby="Profile_Post_tab">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <table class="table mb-0">
                                                    <thead class="table-light">
                                                        <tr>
                                                            <th class="border-top-0">Reservation Code</th>
                                                            <th class="border-top-0">Customer Details</th>
                                                            <th class="border-top-0">Check In</th>
                                                            <th class="border-top-0">Check Out</th>
                                                            <th class="border-top-0">Reservation Date</th>
                                                        </tr>
                                                        <!--end tr-->
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $ret = "SELECT * FROM iResturant_Customer c
                                                        INNER JOIN iResturant_Room_Reservation r ON c.id = r.client_id
                                                        INNER JOIN iResturant_Room rm
                                                        ON r.room_id = rm.id
                                                        WHERE r.room_id = '$view'
                                                         ";
                                                        $stmt = $mysqli->prepare($ret);
                                                        $stmt->execute(); //ok
                                                        $res = $stmt->get_result();
                                                        while ($reservations = $res->fetch_object()) {
                                                        ?>
                                                            <tr>
                                                                <td><?php echo $reservations->code; ?></td>
                                                                <td>
                                                                    Name:<?php echo $reservations->name; ?> <br>
                                                                    Phone:<?php echo $reservations->phone; ?><br>
                                                                    Email:<?php echo $reservations->email; ?>
                                                                </td>
                                                                <td><?php echo date('d M Y', strtotime($reservations->arrival)); ?></td>
                                                                <td><?php echo date('d M Y', strtotime($reservations->departure)); ?></td>
                                                                <td><?php echo date('d M Y', strtotime($reservations->reserved_on)); ?></td>
                                                            </tr>
                                                        <?php
                                                        } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Room Settings -->
                                    <div class="tab-pane fade" id="Profile_Settings" role="tabpanel" aria-labelledby="settings_detail_tab">
                                        <div class="row">
                                            <div class="col-lg-6 col-xl-6">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <div class="row align-items-center">
                                                            <div class="col">
                                                                <h4 class="card-title">Room Information</h4>
                                                            </div>
                                                            <!--end col-->
                                                        </div>
                                                        <!--end row-->
                                                    </div>
                                                    <!--end card-header-->
                                                    <div class="card-body">
                                                        <form method="POST">
                                                            <div class="form-group row">
                                                                <label class="col-xl-3 col-lg-3 text-end mb-lg-0 align-self-center">Room Number</label>
                                                                <div class="col-lg-9 col-xl-8">
                                                                    <input class="form-control" type="text" name="number" value="<?php echo $room->number; ?>">
                                                                    <input class="form-control" type="hidden" name="id" value="<?php echo $room->id; ?>">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-xl-3 col-lg-3 text-end mb-lg-0 align-self-center"> Room Price (<?php echo $currency->code; ?>)</label>
                                                                <div class="col-lg-9 col-xl-8">
                                                                    <input class="form-control" type="number" name="price" value="<?php echo $room->price; ?>">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-xl-3 col-lg-3 text-end mb-lg-0 align-self-center">Room Category</label>
                                                                <div class="col-lg-9 col-xl-8">
                                                                    <select id="RoomCategoryName" class="form-control" onchange="GetRoomCategoryID(this.value);">
                                                                        <option>Select Room Category</option>
                                                                        <?php
                                                                        $ret = "SELECT * FROM  iResturant_Room_Category ";
                                                                        $stmt = $mysqli->prepare($ret);
                                                                        $stmt->execute(); //ok
                                                                        $res = $stmt->get_result();
                                                                        while ($rooms_categories = $res->fetch_object()) {
                                                                        ?>
                                                                            <option><?php echo $rooms_categories->name; ?></option>
                                                                        <?php
                                                                        } ?>
                                                                    </select>
                                                                    <input type="hidden" required name="room_category_id" id="RoomCategoryID" class="form-control">
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label class="col-xl-3 col-lg-3 text-end mb-lg-0 align-self-center">Room Details</label>
                                                                <div class="col-lg-9 col-xl-8">
                                                                    <textarea name="details" rows="5" class="form-control"><?php echo $room->details; ?></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="form-group   row">
                                                                <div class="d-flex justify-content-end">
                                                                    <button type="submit" name="Update_Room" class="btn btn-sm btn-outline-primary">Submit</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end col-->
                                            <div class="col-lg-6 col-xl-6">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h4 class="card-title">Room Images</h4>
                                                    </div>
                                                    <!--end card-header-->
                                                    <div class="card-body">
                                                        <form method="POST" enctype="multipart/form-data">
                                                            <div class="form-group row">
                                                                <label class="col-xl-3 col-lg-3 text-end mb-lg-0 align-self-center">Upload Multiple Room Images</label>
                                                                <div class="col-lg-9 col-xl-8">
                                                                    <input class="form-control" id="file" type="file" name="file[]" multiple>
                                                                    <input class="form-control" type="hidden" name="room_id" value="<?php echo $view; ?>">
                                                                </div>
                                                            </div>
                                                            <div class="form-group text-center row">
                                                                <div class="d-flex justify-content-end">
                                                                    <button type="submit" name="Upload_Images" class="btn btn-sm btn-outline-primary">Submit</button>
                                                                </div>
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
                    </div>
                </div>
        <?php
            }
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