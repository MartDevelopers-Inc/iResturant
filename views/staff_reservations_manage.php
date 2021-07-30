<?php
/*
 * Created on Fri Jul 16 2021
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

/* Add Room  Reservation*/
if (isset($_POST['add_room_reservation'])) {
    $error = 0;
    if (isset($_POST['id']) && !empty($_POST['id'])) {
        $id = mysqli_real_escape_string($mysqli, trim($_POST['id']));
    } else {
        $error = 1;
        $err = "Reservation ID Cannot Be Empty";
    }

    if (isset($_POST['code']) && !empty($_POST['code'])) {
        $code = mysqli_real_escape_string($mysqli, trim($_POST['code']));
    } else {
        $error = 1;
        $err = "Reservation Code Cannot Be Empty";
    }

    if (isset($_POST['client_id']) && !empty($_POST['client_id'])) {
        $client_id = mysqli_real_escape_string($mysqli, trim($_POST['client_id']));
    } else {
        $error = 1;
        $err = "Client ID Cannot Be Empty";
    }

    if (isset($_POST['room_id']) && !empty($_POST['room_id'])) {
        $room_id = mysqli_real_escape_string($mysqli, trim($_POST['room_id']));
    } else {
        $error = 1;
        $err = "Room ID Cannot Be Empty";
    }

    if (isset($_POST['arrival']) && !empty($_POST['arrival'])) {
        $arrival = mysqli_real_escape_string($mysqli, trim($_POST['arrival']));
    } else {
        $error = 1;
        $err = "Check In  Time Cannot Be Empty";
    }

    if (isset($_POST['departure']) && !empty($_POST['departure'])) {
        $departure  = mysqli_real_escape_string($mysqli, trim($_POST['departure']));
    } else {
        $error = 1;
        $err = "Check Out Time Cannot Be Empty";
    }

    if (isset($_POST['purpose']) && !empty($_POST['purpose'])) {
        $purpose  = mysqli_real_escape_string($mysqli, trim($_POST['purpose']));
    } else {
        $error = 1;
        $err = "Purpose Cannot Be Empty";
    }

    if (isset($_POST['payment_status']) && !empty($_POST['payment_status'])) {
        $payment_status  = mysqli_real_escape_string($mysqli, trim($_POST['payment_status']));
    } else {
        $error = 1;
        $err = "Status Cannot Be Empty";
    }

    $special_request = $_POST['special_request'];
    $reserved_on = date('d-M-Y');
    $room_status = 'Reserved';
    /* For Mailing Purposes */
    $client_email = $_POST['client_email'];
    $client_name = $_POST['client_name'];
    $room_number = $_POST['room_number'];

    /* Reservation Cost */
    $room_cost = $_POST['room_cost'];
    $checkin = strtotime($_POST['arrival']);
    $checkout = strtotime($_POST['departure']);
    $secs = $checkout - $checkin;
    $days_reserved = $secs / 86400;
    $total_payable_amt = $days_reserved * $room_cost;

    if (!$error) {
        $sql = "SELECT * FROM  iResturant_Room_Reservation WHERE  (code='$code')  ";
        $res = mysqli_query($mysqli, $sql);
        if (mysqli_num_rows($res) > 0) {
            $row = mysqli_fetch_assoc($res);
            if ($code == $row['code']) {
                $err =  "A Room Reservation  With This Number Already Exists";
            }
        } else {
            $query = "INSERT INTO iResturant_Room_Reservation (id, code, client_id, room_id, arrival, departure, purpose, payment_status, special_request, reserved_on) VALUES(?,?,?,?,?,?,?,?,?,?)";
            $roomqrry = "UPDATE iResturant_Room SET status  =? WHERE id = ?";

            $stmt = $mysqli->prepare($query);
            $rstmt = $mysqli->prepare($roomqrry);

            $rc = $stmt->bind_param('ssssssssss', $id, $code, $client_id, $room_id, $arrival, $departure, $purpose, $payment_status, $special_request, $reserved_on);
            $rc = $rstmt->bind_param('ss', $room_status, $room_id);

            $stmt->execute();
            $rstmt->execute();

            /* Load Reservations Mailer */
            require_once('../config/reservations_mailer.php');

            if ($mail->send() && $stmt && $rstmt) {
                $success = "Reservation Added";
            } else {
                $info = "Please Connect To The Internet And Try Again";
            }
        }
    }
}

/* Update Room Reservation */
if (isset($_POST['update_room_reservation'])) {
    $error = 0;
    if (isset($_POST['code']) && !empty($_POST['code'])) {
        $code = mysqli_real_escape_string($mysqli, trim($_POST['code']));
    } else {
        $error = 1;
        $err = "Reservation Code Cannot Be Empty";
    }

    if (isset($_POST['arrival']) && !empty($_POST['arrival'])) {
        $arrival = mysqli_real_escape_string($mysqli, trim($_POST['arrival']));
    } else {
        $error = 1;
        $err = "Check In  Time Cannot Be Empty";
    }

    if (isset($_POST['departure']) && !empty($_POST['departure'])) {
        $departure  = mysqli_real_escape_string($mysqli, trim($_POST['departure']));
    } else {
        $error = 1;
        $err = "Check Out Time Cannot Be Empty";
    }

    if (isset($_POST['purpose']) && !empty($_POST['purpose'])) {
        $purpose  = mysqli_real_escape_string($mysqli, trim($_POST['purpose']));
    } else {
        $error = 1;
        $err = "Purpose Cannot Be Empty";
    }

    $special_request = $_POST['special_request'];

    if (!$error) {
        $query = "UPDATE iResturant_Room_Reservation SET arrival =?, departure =?, purpose =?, special_request=? WHERE code = ?";
        $stmt = $mysqli->prepare($query);
        $rc = $stmt->bind_param('sssss', $arrival, $departure, $purpose, $special_request,  $code);
        $stmt->execute();
        if ($stmt) {
            $success = "Reservation Updated";
        } else {
            $info = "Please Try Again Or Try Later";
        }
    }
}

/* Vacate Room */
if (isset($_GET['vacate'])) {
    $id = $_GET['vacate'];
    $status = 'Vacant';
    $adn = 'UPDATE iResturant_Room SET status  =? WHERE number = ?';
    $stmt = $mysqli->prepare($adn);
    $stmt->bind_param('ss', $status, $id);
    $stmt->execute();
    $stmt->close();
    if ($stmt) {
        $success = 'Room Vacated' && header('refresh:1; url=reservations_manage');;
    } else {
        $info = 'Please Try Again Or Try Later';
    }
}

/* Delete Reservation */
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $number = $_GET['number'];
    $status = 'Vacant';
    $adn = 'DELETE FROM iResturant_Room_Reservation WHERE code=?';
    $vacate = 'UPDATE iResturant_Room SET status  =? WHERE number = ?';
    $stmt = $mysqli->prepare($adn);
    $vacatestmt = $mysqli->prepare($vacate);
    $stmt->bind_param('s', $id);
    $vacatestmt->bind_param('ss', $status, $number);
    $stmt->execute();
    $vacatestmt->execute();
    $stmt->close();
    $vacatestmt->close();
    if ($stmt && $vacatestmt) {
        $success = 'Room Reservation Deleted' && header('refresh:1; url=reservations_manage');;
    } else {
        $info = 'Please Try Again Or Try Later';
    }
}

/* Payment Details */
if (isset($_POST['add_payment'])) {

    $id = $_POST['id'];
    $code = $_POST['code'];
    $reservation_code = $_POST['reservation_code'];
    $type = $_POST['type'];
    $payment_status = $_POST['payment_status'];
    $means = $_POST['means'];
    $amount = $_POST['amount'];

    /* Mailer Details */
    $client_email = $_POST['client_email'];
    $client_name = $_POST['client_name'];

    $query = "INSERT INTO iResturant_Payments (id, code, reservation_code, means, amount, type) VALUES(?,?,?,?,?,?)";
    $roomqrry = "UPDATE iResturant_Room_Reservation SET payment_status  =? WHERE code = ?";

    $stmt = $mysqli->prepare($query);
    $rstmt = $mysqli->prepare($roomqrry);

    $rc = $stmt->bind_param('ssssss', $id, $code, $reservation_code, $means, $amount, $type);
    $rc = $rstmt->bind_param('ss', $payment_status, $reservation_code);

    $stmt->execute();
    $rstmt->execute();

    /* Load Payment Mailer */
    require_once('../config/pay_reservation_mailer.php');

    if ($mail->send() && $stmt && $rstmt) {
        $success = "Reservation Payment Added";
    } else {
        $info = "Please Connect To The Internet And Try Again";
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
        <?php require_once('../partials/staff_header.php'); ?>
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
                                    <h4 class="page-title">Reservations</h4>
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="staff_dashboard">Home</a></li>
                                        <li class="breadcrumb-item"><a href="staff_dashboard">Dashboard</a></li>
                                        <li class="breadcrumb-item active">Reservations</li>
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
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_reservation">Add Reservation</button>
                        </div>

                        <hr>
                        <div class="card">
                            <!--end card-header-->
                            <div class="card-body table-responsive">
                                <div class="">
                                    <table class="table dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th class="border-top-0">Reservation Code</th>
                                                <th class="border-top-0">Customer Details</th>
                                                <th class="border-top-0">Room No</th>
                                                <th class="border-top-0">Reservation Details</th>
                                                <th class="border-top-0">Manage</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $ret = "SELECT * FROM `iResturant_Currencies` WHERE status = 'Active'  ";
                                            $stmt = $mysqli->prepare($ret);
                                            $stmt->execute(); //ok
                                            $res = $stmt->get_result();
                                            while ($currency = $res->fetch_object()) {
                                                $ret = "SELECT * FROM iResturant_Customer c
                                            INNER JOIN iResturant_Room_Reservation r ON c.id = r.client_id
                                            INNER JOIN iResturant_Room rm
                                            ON r.room_id = rm.id;                                                        
                                            ";
                                                $stmt = $mysqli->prepare($ret);
                                                $stmt->execute(); //ok
                                                $res = $stmt->get_result();
                                                while ($reservations = $res->fetch_object()) {
                                                    $checkin = strtotime($reservations->arrival);
                                                    $checkout = strtotime($reservations->departure);
                                                    $secs = $checkout - $checkin;
                                                    $days_reserved = $secs / 86400;
                                                    $total_payable_amt = $days_reserved * ($reservations->price);
                                                    $now = strtotime(date("Y-m-d"));
                                            ?>
                                                    <tr>
                                                        <td>
                                                            <a class="text-primary" href="staff_eservation_details?view=<?php echo $reservations->code; ?>">
                                                                <?php echo $reservations->code; ?>
                                                            </a>
                                                        </td>
                                                        <td>
                                                            Name:<?php echo $reservations->name; ?><br>
                                                            Phone:<?php echo $reservations->phone; ?><br>
                                                            Email:<?php echo $reservations->email; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $reservations->number; ?>
                                                        </td>
                                                        <td>
                                                            Check In: <?php echo date('d-M-Y', strtotime($reservations->arrival)); ?><br>
                                                            Check Out: <?php echo date('d-M-Y', strtotime($reservations->departure)); ?><br>
                                                            Days Reserved: <?php echo $days_reserved; ?>Days(s)<br>
                                                            Date Reserved: <?php echo date('d-M-Y', strtotime($reservations->reserved_on)); ?>
                                                        </td>

                                                        <td>
                                                            <?php
                                                            if ($reservations->payment_status == 'UnPaid') {
                                                                echo
                                                                '
                                                            <a href="#pay-' . $reservations->code . '" data-bs-toggle="modal" data-bs-target="#pay-' . $reservations->code . '" class="btn btn-sm btn-outline-success">
                                                                <i data-feather="dollar-sign" class="align-self-center icon-xs ms-1"></i> Pay
                                                            </a>
                                                            
                                                            ';
                                                            }
                                                            if ($now > $checkout) {
                                                                echo
                                                                '
                                                                <a href="#vacate-' . $reservations->code . '" data-bs-toggle="modal" data-bs-target="#vacate-' . $reservations->code . '" class="btn btn-sm btn-outline-danger">
                                                                    <i data-feather="airplay" class="align-self-center icon-xs ms-1"></i> Vacate Room
                                                                </a>
                                                                <br>
                                                                <h4></h4>                                                                
                                                                ';
                                                            }
                                                            ?>

                                                            <!-- Pay Reservation Modal -->
                                                            <div class="modal fade" id="pay-<?php echo $reservations->code; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalPrimary1" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header bg-warning">
                                                                            <h6 class="modal-title m-0 text-white" id="exampleModalPrimary1">Pay Reservation </h6>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="row">
                                                                                <form method="post" enctype="multipart/form-data" role="form">
                                                                                    <div class="card-body">
                                                                                        <div class="row">
                                                                                            <div class="form-group col-md-12">
                                                                                                <label for="">Payment Code</label>
                                                                                                <input type="hidden" value="<?php echo $reservations->code; ?>" required name="reservation_code" class="form-control">
                                                                                                <input type="hidden" value="<?php echo $sys_gen_id_alt_1; ?>" required name="id" class="form-control">
                                                                                                <input type="hidden" value="Reservations" required name="type" class="form-control">
                                                                                                <input type="hidden" value="Paid" required name="payment_status" class="form-control">
                                                                                                <input type="hidden" value="<?php echo $reservations->email; ?>" required name="client_email" class="form-control">
                                                                                                <input type="hidden" value="<?php echo $reservations->name; ?>" required name="client_name" class="form-control">

                                                                                                <input type="text" value="<?php echo $sys_gen_paycode; ?>" readonly required name="code" class="form-control">
                                                                                            </div>
                                                                                            <div class="form-group col-md-6">
                                                                                                <label for="">Payment Method</label>
                                                                                                <select name="means" class="form-control">
                                                                                                    <option>Cash</option>
                                                                                                    <option>Mpesa</option>
                                                                                                </select>
                                                                                            </div>
                                                                                            <div class="form-group col-md-6">
                                                                                                <label for="">Amount Payable (<?php echo $currency->code; ?>)</label>
                                                                                                <input type="text" readonly value="<?php echo $total_payable_amt; ?>" required name="amount" class="form-control">
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="d-flex justify-content-end">
                                                                                        <button type="submit" name="add_payment" class="btn btn-primary">Submit</button>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- End Payment -->
                                                            <a href="#edit-<?php echo $reservations->code; ?>" data-bs-toggle="modal" data-bs-target="#edit-<?php echo $reservations->code; ?>" class="btn btn-sm btn-outline-warning">
                                                                <i data-feather="edit" class="align-self-center icon-xs ms-1"></i> Edit
                                                            </a>
                                                            <!-- Update Modal -->
                                                            <div class="modal fade" id="edit-<?php echo $reservations->code; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalPrimary1" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header bg-warning">
                                                                            <h6 class="modal-title m-0 text-white" id="exampleModalPrimary1">Edit Reservation</h6>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="row">
                                                                                <form method="post" enctype="multipart/form-data" role="form">
                                                                                    <div class="card-body">
                                                                                        <div class="row">
                                                                                            <div class="form-group col-md-6">
                                                                                                <label for="">Check In</label>
                                                                                                <input type="date" value="<?php echo $reservations->arrival; ?>" required name="arrival" class="form-control">
                                                                                                <input type="hidden" value="<?php echo $reservations->code; ?>" required name="code" class="form-control">
                                                                                            </div>
                                                                                            <div class="form-group col-md-6">
                                                                                                <label for="">Check Out</label>
                                                                                                <input type="date" value="<?php echo $reservations->departure; ?>" required name="departure" class="form-control">
                                                                                            </div>
                                                                                            <div class="form-group col-md-12">
                                                                                                <label for="">Reservation Purpose</label>
                                                                                                <select name="purpose" class="form-control">
                                                                                                    <option>Business</option>
                                                                                                    <option>Educational</option>
                                                                                                    <option>Vacation</option>
                                                                                                </select>
                                                                                            </div>
                                                                                            <div class="form-group col-md-12">
                                                                                                <label for="">Any Special Request</label>
                                                                                                <textarea name="special_request" class="form-control" rows="5"><?php echo $reservations->special_request; ?></textarea>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="d-flex justify-content-end">
                                                                                        <button type="submit" name="update_room_reservation" class="btn btn-primary">Submit</button>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- End Update Modal -->
                                                            <a href="#delete-<?php echo $reservations->code; ?>" data-bs-toggle="modal" data-bs-target="#delete-<?php echo $reservations->code; ?>" class="btn btn-sm btn-outline-danger">
                                                                <i data-feather="trash" class="align-self-center icon-xs ms-1"></i> Delete
                                                            </a>
                                                            <!-- Delete Modal -->
                                                            <div class="modal fade" id="delete-<?php echo $reservations->code; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLabel">CONFIRM</h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                                                                        </div>
                                                                        <div class="modal-body text-center text-danger">
                                                                            <h4>Delete <?php echo $reservations->code; ?> ?</h4>
                                                                            <br>
                                                                            <p>Heads Up, You are about to delete <?php echo $reservations->code; ?>. <br> This action is irrevisble.</p>
                                                                            <button type="button" class="btn btn-soft-success" data-bs-dismiss="modal">No</button>
                                                                            <a href="staff_reservations_manage?delete=<?php echo $reservations->code; ?>&number=<?php echo $reservations->number; ?>" class="text-center btn btn-danger"> Delete </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- End Delete Modal -->

                                                            <!-- Vacate Room Modal -->
                                                            <div class="modal fade" id="vacate-<?php echo $reservations->code; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLabel">CONFIRM</h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                                                                        </div>
                                                                        <div class="modal-body text-center text-danger">
                                                                            <h4>Vacate Room Number <?php echo $reservations->number; ?> ?</h4>
                                                                            <br>
                                                                            <p>Heads Up, You are about vacate customer <br> in room number: <?php echo $reservations->number; ?>.</p>
                                                                            <button type="button" class="btn btn-soft-success" data-bs-dismiss="modal">No</button>
                                                                            <a href="staff_reservations_manage?vacate=<?php echo $reservations->number; ?>" class="text-center btn btn-danger"> Vacate </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- End Vacate Room Modal   -->
                                                        </td>
                                                    </tr>
                                            <?php
                                                }
                                            } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- Add Room Reservations Modal -->
                        <div class="modal fade" id="add_reservation" tabindex="-1" role="dialog" aria-labelledby="exampleModalPrimary1" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-primary">
                                        <h6 class="modal-title m-0 text-white" id="exampleModalPrimary1">Add Reservations</h6>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <form method="post" enctype="multipart/form-data" role="form">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label for="">Room Number</label>
                                                            <select id="RoomNumber" class="form-control" name="room_number" onchange="GetRoomDetails(this.value);">
                                                                <option>Select Room Number</option>
                                                                <?php
                                                                $ret = "SELECT * FROM  iResturant_Room WHERE status = 'Vacant'";
                                                                $stmt = $mysqli->prepare($ret);
                                                                $stmt->execute(); //ok
                                                                $res = $stmt->get_result();
                                                                while ($rooms = $res->fetch_object()) {
                                                                ?>
                                                                    <option><?php echo $rooms->number; ?></option>
                                                                <?php
                                                                } ?>
                                                            </select>
                                                            <input type="hidden" required name="room_id" id="RoomID" class="form-control">
                                                            <input type="hidden" required name="room_cost" id="RoomCost" class="form-control"> <input type="hidden" required name="id" value="<?php echo $sys_gen_id_alt_1; ?>" class="form-control">
                                                            <input type="hidden" required name="code" value="<?php echo $a . $b; ?>" class="form-control">
                                                            <input type="hidden" required name="payment_status" value="UnPaid" class="form-control">
                                                        </div>

                                                        <div class="form-group col-md-6">
                                                            <label for="">Customer Phone Number</label>
                                                            <select id="ClientPhone" class="form-control" onchange="GetClientDetails(this.value);">
                                                                <option>Select Customer Phone No</option>
                                                                <?php
                                                                $ret = "SELECT * FROM  iResturant_Customer";
                                                                $stmt = $mysqli->prepare($ret);
                                                                $stmt->execute(); //ok
                                                                $res = $stmt->get_result();
                                                                while ($customer = $res->fetch_object()) {
                                                                ?>
                                                                    <option><?php echo $customer->phone; ?></option>
                                                                <?php
                                                                } ?>
                                                            </select>
                                                            <input type="hidden" id="ClientID" required name="client_id" class="form-control">
                                                        </div>

                                                        <div class="form-group col-md-6">
                                                            <label for="">Customer Name</label>
                                                            <input type="text" readonly required id="ClientName" name="client_name" class="form-control">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="">Customer Email</label>
                                                            <input type="text" readonly required id="ClientEmail" name="client_email" class="form-control">
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="form-group col-md-4">
                                                            <label for="">Check In</label>
                                                            <input type="date" required name="arrival" class="form-control">
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label for="">Check Out</label>
                                                            <input type="date" required name="departure" class="form-control">
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label for="">Reservation Purpose</label>
                                                            <select name="purpose" class="form-control">
                                                                <option>Business</option>
                                                                <option>Educational</option>
                                                                <option>Vacation</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <label for="">Any Special Request</label>
                                                            <textarea name="special_request" class="form-control" rows="5"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-end">
                                                    <button type="submit" name="add_room_reservation" class="btn btn-primary">Submit</button>
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