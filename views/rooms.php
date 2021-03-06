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
require_once('../config/codeGen.php');
admin_check_login();


/* Add Room */
if (isset($_POST['add_room'])) {
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

    if (isset($_POST['room_category_id']) && !empty($_POST['room_category_id'])) {
        $room_category_id = mysqli_real_escape_string($mysqli, trim($_POST['room_category_id']));
    } else {
        $error = 1;
        $err = "Room Category ID Cannot Be Empty";
    }

    if (isset($_POST['price']) && !empty($_POST['price'])) {
        $price = mysqli_real_escape_string($mysqli, trim($_POST['price']));
    } else {
        $error = 1;
        $err = "Room Price Cannot Be Empty";
    }

    if (isset($_POST['status']) && !empty($_POST['status'])) {
        $status = mysqli_real_escape_string($mysqli, trim($_POST['status']));
    } else {
        $error = 1;
        $err = "Room Status Cannot Be Empty";
    }

    if (isset($_POST['details']) && !empty($_POST['details'])) {
        $details = ($_POST['details']);
    } else {
        $error = 1;
        $err = "Room Details Cannot Be Empty";
    }

    if (!$error) {
        $sql = "SELECT * FROM  iResturant_Room WHERE  (number='$number')  ";
        $res = mysqli_query($mysqli, $sql);
        if (mysqli_num_rows($res) > 0) {
            $row = mysqli_fetch_assoc($res);
            if ($number == $row['number']) {
                $err =  "A Room With This Number Already Exists";
            }
        } else {
            $query = "INSERT INTO iResturant_Room (id, number, room_category_id, price, status, details) VALUES(?,?,?,?,?,?)";
            $stmt = $mysqli->prepare($query);
            $rc = $stmt->bind_param('ssssss', $id, $number, $room_category_id, $price, $status, $details);
            $stmt->execute();
            if ($stmt) {
                $success = "Room $number  Added";
            } else {
                $info = "Please Try Again Or Try Later";
            }
        }
    }
}

/* Update Room */
if (isset($_POST['update_room'])) {
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


    if (isset($_POST['details']) && !empty($_POST['details'])) {
        $details = ($_POST['details']);
    } else {
        $error = 1;
        $err = "Room Details Cannot Be Empty";
    }
    $status = $_POST['status'];

    if (!$error) {

        $query = "UPDATE iResturant_Room SET  number =?,  price =?, status= ?,  details =? WHERE  id = ?";
        $stmt = $mysqli->prepare($query);
        $rc = $stmt->bind_param('sssss', $number, $price, $status, $details, $id);
        $stmt->execute();
        if ($stmt) {
            $success = "Room $number  Updated";
        } else {
            $info = "Please Try Again Or Try Later";
        }
    }
}

/* Delete Room */
if (isset($_GET['delete_room'])) {
    $id = $_GET['delete_room'];
    $adn = 'DELETE FROM iResturant_Room WHERE id=?';
    $stmt = $mysqli->prepare($adn);
    $stmt->bind_param('s', $id);
    $stmt->execute();
    $stmt->close();
    if ($stmt) {
        $success = 'Room Deleted' && header('refresh:1; url=rooms');;
    } else {
        $info = 'Please Try Again Or Try Later';
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
                                    <h4 class="page-title">Rooms</h4>
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                                        <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
                                        <li class="breadcrumb-item active">Rooms</li>
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
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_room">Add Room</button>
                        </div>


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
                                            /* Load Currency */
                                            $ret = "SELECT * FROM `iResturant_Currencies` WHERE status = 'Active'  ";
                                            $stmt = $mysqli->prepare($ret);
                                            $stmt->execute(); //ok
                                            $res = $stmt->get_result();
                                            while ($currency = $res->fetch_object()) {
                                                $ret = "SELECT iResturant_Room_Category.name, iResturant_Room.number, iResturant_Room.id, iResturant_Room.details, iResturant_Room.price, iResturant_Room.status FROM iResturant_Room_Category INNER JOIN iResturant_Room ON iResturant_Room.room_category_id = iResturant_Room_Category.id;  ";
                                                $stmt = $mysqli->prepare($ret);
                                                $stmt->execute(); //ok
                                                $res = $stmt->get_result();
                                                while ($rooms = $res->fetch_object()) {
                                            ?>
                                                    <tr>
                                                        <td>
                                                            <a href="room?view=<?php echo $rooms->id; ?>" class="text-primary">
                                                                <?php echo $rooms->number; ?>
                                                            </a>
                                                        </td>
                                                        <td><?php echo $rooms->name; ?></td>
                                                        <td><?php echo $currency->code . " " . $rooms->price; ?></td>
                                                        <td><?php echo $rooms->status; ?></td>
                                                        <td>

                                                            <a href="#edit-<?php echo $rooms->id; ?>" data-bs-toggle="modal" data-bs-target="#edit-<?php echo $rooms->id; ?>" class="btn btn-sm btn-outline-warning">
                                                                <i data-feather="edit" class="align-self-center icon-xs ms-1"></i> Edit
                                                            </a>
                                                            <!-- Update Modal -->
                                                            <div class="modal fade" id="edit-<?php echo $rooms->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalPrimary1" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header bg-warning">
                                                                            <h6 class="modal-title m-0 text-white" id="exampleModalPrimary1">Edit Room</h6>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="row">
                                                                                <form method="post" enctype="multipart/form-data" role="form">
                                                                                    <div class="card-body">
                                                                                        <div class="row">
                                                                                            <div class="form-group col-md-4">
                                                                                                <label for="">Room Number</label>
                                                                                                <input type="text" required name="number" value="<?php echo $rooms->number; ?>" class="form-control" id="exampleInputEmail1">
                                                                                                <input type="hidden" required name="id" value="<?php echo $rooms->id; ?>" class="form-control">
                                                                                            </div>
                                                                                            <div class="form-group col-md-4">
                                                                                                <label for="">Room Price</label>
                                                                                                <input type="number" required name="price" value="<?php echo $rooms->price; ?>" class="form-control">
                                                                                            </div>
                                                                                            <div class="form-group col-md-4">
                                                                                                <label for="">Status</label>
                                                                                                <select type="status" required name="status" value="<?php echo $rooms->price; ?>" class="form-control">
                                                                                                    <option><?php echo $rooms->status; ?></option>
                                                                                                    <option>Vacant</option>
                                                                                                    <option>Under Repair</option>
                                                                                                </select>
                                                                                            </div>
                                                                                            <div class="form-group col-md-12">
                                                                                                <label for="">Room Details</label>
                                                                                                <textarea required name="details" class="form-control" rows="5"><?php echo $rooms->details; ?></textarea>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="d-flex justify-content-end">
                                                                                        <button type="submit" name="update_room" class="btn btn-primary">Submit</button>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- End Update Modal -->
                                                            <a href="#delete-<?php echo $rooms->id; ?>" data-bs-toggle="modal" data-bs-target="#delete-<?php echo $rooms->id; ?>" class="btn btn-sm btn-outline-danger">
                                                                <i data-feather="trash" class="align-self-center icon-xs ms-1"></i> Delete
                                                            </a>
                                                            <!-- Delete Modal -->
                                                            <div class="modal fade" id="delete-<?php echo $rooms->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLabel">CONFIRM</h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                                                                        </div>
                                                                        <div class="modal-body text-center text-danger">
                                                                            <h4>Delete <?php echo $rooms->number; ?> ?</h4>
                                                                            <br>
                                                                            <p>Heads Up, You are about to delete <?php echo $rooms->number; ?>. This action is irrevisble.</p>
                                                                            <button type="button" class="btn btn-soft-success" data-bs-dismiss="modal">No</button>
                                                                            <a href="rooms?delete_room=<?php echo $rooms->id; ?>" class="text-center btn btn-danger"> Delete </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- End Delete Modal -->
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
                        <!-- Add Room Modal -->
                        <div class="modal fade" id="add_room" tabindex="-1" role="dialog" aria-labelledby="exampleModalPrimary1" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-primary">
                                        <h6 class="modal-title m-0 text-white" id="exampleModalPrimary1">Add Room</h6>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <form method="post" enctype="multipart/form-data" role="form">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label for="">Room Number</label>
                                                            <input type="text" required name="number" class="form-control" id="exampleInputEmail1">
                                                            <input type="hidden" required name="id" value="<?php echo $sys_gen_id_alt_1; ?>" class="form-control">
                                                            <input type="hidden" required name="status" value="Vacant" class="form-control">
                                                        </div>

                                                        <div class="form-group col-md-6">
                                                            <label for="">Room Category</label>
                                                            <select id="RoomCategoryName" class="select form-control" onchange="GetRoomCategoryID(this.value);">
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
                                                    <div class="row">
                                                        <div class="form-group col-md-12">
                                                            <label for="">Room Price (Per Night / Day)</label>
                                                            <input type="number" required name="price" class="form-control">
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <label for="">Room Details</label>
                                                            <textarea required name="details" class="form-control" rows="5"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-end">
                                                    <button type="submit" name="add_room" class="btn btn-primary">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Add Room Modal -->
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