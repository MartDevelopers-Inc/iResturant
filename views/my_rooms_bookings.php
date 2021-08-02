<?php
/*
 * Created on Mon Aug 02 2021
 *
 * The MIT License (MIT)
 * Copyright (c) 2021 Martdevelopers Inc
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
require_once('../partials/my_analytics.php');
require_once('../partials/my_head.php');
?>

<body class="section-bg">
    <!-- start cssload-loader -->
    <div class="preloader" id="preloader">
        <div class="loader">
            <svg class="spinner" viewBox="0 0 50 50">
                <circle class="path" cx="25" cy="25" r="20" fill="none" stroke-width="5"></circle>
            </svg>
        </div>
    </div>
    <!-- end cssload-loader -->

    <!-- ================================
       START USER CANVAS MENU
================================= -->
    <div class="user-canvas-container">
        <div class="side-menu-close">
            <i class="la la-times"></i>
        </div><!-- end menu-toggler -->


    </div><!-- end user-canvas-container -->

    <?php require_once('../partials/my_sidebar.php');    ?>

    <section class="dashboard-area">
        <div class="dashboard-content-wrap">
            <div class="dashboard-bread dashboard--bread">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <div class="breadcrumb-content">
                                <div class="section-heading">
                                    <h2 class="sec__title font-size-30 text-white">My Rooms Reservations</h2>
                                </div>
                            </div><!-- end breadcrumb-content -->
                        </div><!-- end col-lg-6 -->
                        <div class="col-lg-6">
                            <div class="breadcrumb-list text-right">
                                <ul class="list-items">
                                    <li><a href="my_dashboard" class="text-white">Home</a></li>
                                    <li>Dashboard</li>
                                    <li>My Reservations</li>
                                </ul>
                            </div><!-- end breadcrumb-list -->
                        </div><!-- end col-lg-6 -->
                    </div><!-- end row -->
                </div>
            </div><!-- end dashboard-bread -->
            <div class="dashboard-main-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-box">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                    Launch demo modal
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                ...
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary">Save changes</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-content">
                                    <div class="table-form table-responsive">
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
                                                $id = $_SESSION['id'];
                                                $ret = "SELECT * FROM `iResturant_Currencies` WHERE status = 'Active'  ";
                                                $stmt = $mysqli->prepare($ret);
                                                $stmt->execute(); //ok
                                                $res = $stmt->get_result();
                                                while ($currency = $res->fetch_object()) {
                                                    $ret = "SELECT * FROM iResturant_Customer c
                                                    INNER JOIN iResturant_Room_Reservation r ON c.id = r.client_id
                                                    INNER JOIN iResturant_Room rm
                                                    ON r.room_id = rm.id WHERE c.id = '$id'                                                   
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
                                                                <a class="text-primary" href="reservation_details?view=<?php echo $reservations->code; ?>">
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
                                                                ?>
                                                                <a href="#edit-<?php echo $reservations->code; ?>" data-toggle="modal" data-target="#edit-<?php echo $reservations->code; ?>" class="btn btn-sm btn-outline-warning">
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
                                                                <a href="#delete-<?php echo $reservations->code; ?>" data-toggle="modal" data-target="#delete-<?php echo $reservations->code; ?>" class="btn btn-sm btn-outline-danger">
                                                                    <i data-feather="trash" class="align-self-center icon-xs ms-1"></i> Delete
                                                                </a>
                                                                <!-- Delete Modal -->
                                                                <div class="modal fade" id="delete-<?php echo $reservations->code; ?>" tabindex="-1" role="dialog">
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
                                                                                <a href="reservations_manage?delete=<?php echo $reservations->code; ?>&number=<?php echo $reservations->number; ?>" class="text-center btn btn-danger"> Delete </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- End Delete Modal -->
                                                            </td>
                                                        </tr>
                                                <?php
                                                    }
                                                } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div><!-- end form-box -->
                        </div><!-- end col-lg-12 -->
                    </div><!-- end row -->
                    <div class="border-top mt-5"></div>
                    <?php require_once('../partials/my_footer.php'); ?>
                </div><!-- end container-fluid -->
            </div><!-- end dashboard-main-content -->
        </div><!-- end dashboard-content-wrap -->
    </section><!-- end dashboard-area -->
    <!-- ================================
    END DASHBOARD AREA
================================= -->

    <!-- start scroll top -->
    <div id="back-to-top">
        <i class="la la-angle-up" title="Go top"></i>
    </div>
    <!-- end scroll top -->

    <?php require_once('../partials/my_scripts.php'); ?>
</body>


</html>