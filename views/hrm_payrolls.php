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


/* Add Staff Payroll */
if (isset($_POST['add_payroll'])) {
    $error = 0;
    if (isset($_POST['id']) && !empty($_POST['id'])) {
        $id = mysqli_real_escape_string($mysqli, trim($_POST['id']));
    } else {
        $error = 1;
        $err = "Room  ID Cannot Be Empty";
    }

    if (isset($_POST['code']) && !empty($_POST['code'])) {
        $code = mysqli_real_escape_string($mysqli, trim($_POST['code']));
    } else {
        $error = 1;
        $err = "Payroll Code Cannot Be Empty";
    }

    if (isset($_POST['month']) && !empty($_POST['month'])) {
        $month = mysqli_real_escape_string($mysqli, trim($_POST['month']));
    } else {
        $error = 1;
        $err = "Month Cannot Be Empty";
    }

    if (isset($_POST['staff_id']) && !empty($_POST['staff_id'])) {
        $staff_id = mysqli_real_escape_string($mysqli, trim($_POST['staff_id']));
    } else {
        $error = 1;
        $err = "Staff ID Cannot Be Empty";
    }

    if (isset($_POST['amount']) && !empty($_POST['amount'])) {
        $amount = mysqli_real_escape_string($mysqli, trim($_POST['amount']));
    } else {
        $error = 1;
        $err = "Amount Cannot Be Empty";
    }

    /* Notify The Staff That Payroll Has Been Generated */
    $icon = 'dollar-sign';
    $title = "$month - $code Payroll Generated";
    $details = 'Your Payroll For ' . $month . ' Has Been Generated. Navigate To Payrolls Under HRM To Manage Them';
    $status = "Unread";


    if (!$error) {
        $sql = "SELECT * FROM  iResturant_Payroll WHERE  (code='$code')  ";
        $res = mysqli_query($mysqli, $sql);
        if (mysqli_num_rows($res) > 0) {
            $row = mysqli_fetch_assoc($res);
            if ($code == $row['code']) {
                $err =  "A Staff Payroll With This Code Exists";
            }
        } else {
            $query = "INSERT INTO iResturant_Payroll (id, code, month, staff_id, amount) VALUES(?,?,?,?,?)";
            $notify = "INSERT INTO iResturant_Notification(user_id, icon, title, details, status) VALUES(?,?,?,?)";

            $stmt = $mysqli->prepare($query);
            $notify_stmt = $mysqli->prepare($notify);

            $rc = $stmt->bind_param('sssss', $id, $code, $month, $staff_id, $amount);
            $rc = $notify_stmt->bind_param('sssss', $staff_id, $icon, $title, $details, $status);

            $stmt->execute();
            $notify_stmt->execute();

            if ($stmt && $notify_stmt) {
                $success = "Staff Payroll Added";
            } else {
                $info = "Please Try Again Or Try Later";
            }
        }
    }
}

/* Update Payroll */
if (isset($_POST['update_payroll'])) {
    $error = 0;

    if (isset($_POST['code']) && !empty($_POST['code'])) {
        $code = mysqli_real_escape_string($mysqli, trim($_POST['code']));
    } else {
        $error = 1;
        $err = "Payroll Code Cannot Be Empty";
    }

    if (isset($_POST['month']) && !empty($_POST['month'])) {
        $month = mysqli_real_escape_string($mysqli, trim($_POST['month']));
    } else {
        $error = 1;
        $err = "Month Cannot Be Empty";
    }


    if (isset($_POST['amount']) && !empty($_POST['amount'])) {
        $amount = mysqli_real_escape_string($mysqli, trim($_POST['amount']));
    } else {
        $error = 1;
        $err = "Amount Cannot Be Empty";
    }

    if (!$error) {
        $query = "UPDATE  iResturant_Payroll  SET month =?, amount =?  WHERE code = ?";
        $stmt = $mysqli->prepare($query);
        $rc = $stmt->bind_param('sss', $month, $amount, $code);
        $stmt->execute();
        if ($stmt) {
            $success = "Staff Payroll Updated";
        } else {
            $info = "Please Try Again Or Try Later";
        }
    }
}

/* Delete Payroll */
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $adn = 'DELETE FROM iResturant_Payroll WHERE code=?';
    $stmt = $mysqli->prepare($adn);
    $stmt->bind_param('s', $id);
    $stmt->execute();
    $stmt->close();
    if ($stmt) {
        $success = 'Payroll Deleted' && header('refresh:1; url=hrm_payrolls');;
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
                                    <h4 class="page-title">Payrolls</h4>
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                                        <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
                                        <li class="breadcrumb-item active">Payrolls</li>
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
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_room">Add Payroll</button>
                        </div>

                        <hr>
                        <div class="card">
                            <!--end card-header-->
                            <div class="card-body table-responsive">
                                <div class="">
                                    <table class="table dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>Payroll Code</th>
                                                <th>Staff Details </th>
                                                <th>Paid Month</th>
                                                <th>Paid Amount</th>
                                                <th>Date Generated</th>
                                                <th>Manage</th>
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
                                                $ret = "SELECT * FROM iResturant_Staff S
                                            INNER JOIN iResturant_Payroll P ON P.staff_id = S.id
                                            ";
                                                $stmt = $mysqli->prepare($ret);
                                                $stmt->execute(); //ok
                                                $res = $stmt->get_result();
                                                while ($payrolls = $res->fetch_object()) {
                                            ?>
                                                    <tr>
                                                        <td>
                                                            <a href="hrm_payroll?view=<?php echo $payrolls->code; ?>" class="text-primary">
                                                                <?php echo $payrolls->code; ?>
                                                            </a>
                                                        </td>
                                                        <td>
                                                            Number: <?php echo $payrolls->number; ?><br>
                                                            Name: <?php echo $payrolls->name; ?><br>
                                                            Email: <?php echo $payrolls->email; ?>
                                                        </td>
                                                        <td><?php echo $payrolls->month; ?></td>
                                                        <td><?php echo $currency->code . " " . $payrolls->amount; ?></td>
                                                        <td><?php echo date('d M Y g:ia', strtotime($payrolls->created_at)); ?></td>
                                                        <td>

                                                            <a href="#edit-<?php echo $payrolls->code; ?>" data-bs-toggle="modal" data-bs-target="#edit-<?php echo $payrolls->code; ?>" class="btn btn-sm btn-outline-warning">
                                                                <i data-feather="edit" class="align-self-center icon-xs ms-1"></i> Edit
                                                            </a>
                                                            <!-- Update Modal -->
                                                            <div class="modal fade" id="edit-<?php echo $payrolls->code; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalPrimary1" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header bg-warning">
                                                                            <h6 class="modal-title m-0 text-white" id="exampleModalPrimary1">Edit Payroll : <?php echo $payrolls->code; ?></h6>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="row">
                                                                                <form method="post" enctype="multipart/form-data" role="form">
                                                                                    <div class="card-body">
                                                                                        <div class="row">
                                                                                            <div class="form-group col-md-12">
                                                                                                <label for="">Payroll Code</label>
                                                                                                <input type="text" readonly required name="code" value="<?php echo $payrolls->code; ?>" class="form-control" id="exampleInputEmail1">
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="row">
                                                                                            <div class="form-group col-md-6">
                                                                                                <label for="">Payroll Month</label>
                                                                                                <select class="form-control" name="month">
                                                                                                    <option><?php echo $payrolls->month; ?></option>
                                                                                                    <option>January</option>
                                                                                                    <option>February</option>
                                                                                                    <option>March</option>
                                                                                                    <option>April</option>
                                                                                                    <option>May</option>
                                                                                                    <option>June</option>
                                                                                                    <option>July</option>
                                                                                                    <option>August</option>
                                                                                                    <option>September</option>
                                                                                                    <option>Octomber</option>
                                                                                                    <option>November</option>
                                                                                                    <option>December</option>
                                                                                                </select>
                                                                                            </div>
                                                                                            <div class="form-group col-md-6">
                                                                                                <label for="">Monthly Salary</label>
                                                                                                <input type="text" name="amount" value="<?php echo $payrolls->amount; ?>" required class="form-control">
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="d-flex justify-content-end">
                                                                                        <button type="submit" name="update_payroll" class="btn btn-primary">Submit</button>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- End Update Modal -->
                                                            <a href="#delete-<?php echo $payrolls->code; ?>" data-bs-toggle="modal" data-bs-target="#delete-<?php echo $payrolls->code; ?>" class="btn btn-sm btn-outline-danger">
                                                                <i data-feather="trash" class="align-self-center icon-xs ms-1"></i> Delete
                                                            </a>
                                                            <!-- Delete Modal -->
                                                            <div class="modal fade" id="delete-<?php echo $payrolls->code; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLabel">CONFIRM</h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                                                                        </div>
                                                                        <div class="modal-body text-center text-danger">
                                                                            <h4>Delete <?php echo $payrolls->code; ?> ?</h4>
                                                                            <br>
                                                                            <p>Heads Up, You are about to delete <?php echo $payrolls->code; ?>. This action is irrevisble.</p>
                                                                            <button type="button" class="btn btn-soft-success" data-bs-dismiss="modal">No</button>
                                                                            <a href="hrm_payrolls?delete=<?php echo $payrolls->code; ?>" class="text-center btn btn-danger"> Delete </a>
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

                        <!-- Add Modal -->
                        <div class="modal fade" id="add_room" tabindex="-1" role="dialog" aria-labelledby="exampleModalPrimary1" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-primary">
                                        <h6 class="modal-title m-0 text-white" id="exampleModalPrimary1">Add Staff Payroll</h6>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <form method="post" enctype="multipart/form-data" role="form">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label for="">Payroll Code</label>
                                                            <input type="text" readonly required name="code" value="<?php echo $a . $b; ?>" class="form-control" id="exampleInputEmail1">
                                                            <input type="hidden" required name="id" value="<?php echo $sys_gen_id_alt_1; ?>" class="form-control">
                                                        </div>

                                                        <div class="form-group col-md-6">
                                                            <label for="">Staff Number</label>
                                                            <select id="StaffNumber" class="select form-control" onchange="GetStaffDetails(this.value);">
                                                                <option>Select Staff Number</option>
                                                                <?php
                                                                $ret = "SELECT * FROM  iResturant_Staff ";
                                                                $stmt = $mysqli->prepare($ret);
                                                                $stmt->execute(); //ok
                                                                $res = $stmt->get_result();
                                                                while ($staffs = $res->fetch_object()) {
                                                                ?>
                                                                    <option><?php echo $staffs->number; ?></option>
                                                                <?php
                                                                } ?>
                                                            </select>
                                                            <input type="hidden" required name="staff_id" id="StaffId" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-md-4">
                                                            <label for="">Staff Name</label>
                                                            <input type="text" id="StaffName" readonly required class="form-control">
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label for="">Staff Email</label>
                                                            <input type="text" id="StaffEmail" readonly required class="form-control">
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label for="">Staff Phone Number</label>
                                                            <input type="text" id="StaffPhoneNumber" readonly required class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label for="">Payroll Month</label>
                                                            <select class="form-control" name="month">
                                                                <option>January</option>
                                                                <option>February</option>
                                                                <option>March</option>
                                                                <option>April</option>
                                                                <option>May</option>
                                                                <option>June</option>
                                                                <option>July</option>
                                                                <option>August</option>
                                                                <option>September</option>
                                                                <option>Octomber</option>
                                                                <option>November</option>
                                                                <option>December</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="">Monthly Salary</label>
                                                            <input type="text" name="amount" required class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-end">
                                                    <button type="submit" name="add_payroll" class="btn btn-primary">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Add Modal -->
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