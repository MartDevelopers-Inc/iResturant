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
require_once('../config/DataSource.php');
require_once('../vendor/autoload.php');
admin_check_login();

/* Bulk Upload Staffs Via XLS */
$time = time();

use MartDevelopersAPI\DataSource;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

$db = new DataSource();
$conn = $db->getConnection();

if (isset($_POST["upload"])) {

    $allowedFileType = [
        'application/vnd.ms-excel',
        'text/xls',
        'text/xlsx',
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
    ];

    /* Where Magic Happens */
    if (in_array($_FILES["file"]["type"], $allowedFileType)) {
        $targetPath = '../public/uploads/sys_data/XLS/' . $time . $_FILES['file']['name'];
        move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);

        /* Initaite XLS Class */
        $Reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();

        $spreadSheet = $Reader->load($targetPath);
        $excelSheet = $spreadSheet->getActiveSheet();
        $spreadSheetAry = $excelSheet->toArray();
        $sheetCount = count($spreadSheetAry);

        /* Decode XLS File */
        for ($i = 1; $i <= $sheetCount; $i++) {
            $id = "";
            if (isset($spreadSheetAry[$i][0])) {
                $id = sha1(md5(rand(mysqli_real_escape_string($conn, $spreadSheetAry[$i][0]), date('Y'))));
            }

            $number = "";
            if (isset($spreadSheetAry[$i][1])) {
                $number = mysqli_real_escape_string($conn, $spreadSheetAry[$i][1]);
            }

            $name = "";
            if (isset($spreadSheetAry[$i][2])) {
                $name = mysqli_real_escape_string($conn, $spreadSheetAry[$i][2]);
            }

            $dob = "";
            if (isset($spreadSheetAry[$i][3])) {
                $dob = mysqli_real_escape_string($conn, $spreadSheetAry[$i][3]);
            }

            $gender = "";
            if (isset($spreadSheetAry[$i][4])) {
                $gender = mysqli_real_escape_string($conn, $spreadSheetAry[$i][4]);
            }

            $phone = "";
            if (isset($spreadSheetAry[$i][5])) {
                $phone = mysqli_real_escape_string($conn, $spreadSheetAry[$i][5]);
            }

            $email = "";
            if (isset($spreadSheetAry[$i][6])) {
                $email = mysqli_real_escape_string($conn, $spreadSheetAry[$i][6]);
            }

            $adr = "";
            if (isset($spreadSheetAry[$i][7])) {
                $adr = mysqli_real_escape_string($conn, $spreadSheetAry[$i][7]);
            }

            $gender = "";
            if (isset($spreadSheetAry[$i][8])) {
                $gender = mysqli_real_escape_string($conn, $spreadSheetAry[$i][8]);
            }

            $login_password = "";
            if (isset($spreadSheetAry[$i][9])) {
                $login_password = mysqli_real_escape_string($conn, $spreadSheetAry[$i][9]);
            }

            $date_employed = "";
            if (isset($spreadSheetAry[$i][10])) {
                $date_employed = mysqli_real_escape_string($conn, $spreadSheetAry[$i][10]);
            }

            /* Constant Values K */
            $login_permission = 'Allow Login';

            if (!empty($name) || !empty($email) || !empty($phone)) {
                $query = "INSERT INTO iResturant_Staff (id, number, name, dob, gender, phone, email, adr, login_password, login_permission, date_employed) 
                VALUES(?,?,?,?,?,?,?,?,?,?,?)";
                $paramType = "sssssssssss";
                $paramArray = array(
                    $id,
                    $number,
                    $name,
                    $dob,
                    $gender,
                    $phone,
                    $email,
                    $adr,
                    $login_password,
                    $login_permission,
                    $date_employed
                );
                $insertId = $db->insert($query, $paramType, $paramArray);

                if (!empty($insertId)) {
                    $err = "Error Occured While Importing Data";
                } else {
                    $success = "Data Imported";
                }
            }
        }
    } else {
        $info = "Invalid File Type. Upload Excel File.";
    }
}

/* Add Staff */
if (isset($_POST['add_staff'])) {
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
    if (isset($_POST['login_password']) && !empty($_POST['login_password'])) {
        $login_password  = sha1(md5(mysqli_real_escape_string($mysqli, trim($_POST['login_password']))));
    } else {
        $error = 1;
        $err = "Staff Login Password Cannot Be Empty";
    }
    $login_permission = $_POST['login_permission'];
    $date_employed = $_POST['date_employed'];
    $time = time();
    $passport = $time . $_FILES['passport']['name'];
    move_uploaded_file($_FILES["passport"]["tmp_name"], "../public/uploads/user_images/" . $time . $_FILES["passport"]["name"]);

    if (!$error) {
        $sql = "SELECT * FROM  iResturant_Staff  WHERE  (email='$email' || phone = '$phone')  ";
        $res = mysqli_query($mysqli, $sql);
        if (mysqli_num_rows($res) > 0) {
            $row = mysqli_fetch_assoc($res);
            if ($email == $row['email'] || $phone == $row['phone']) {
                $err =  "A Staff With This Email Or Phone Number Already Exists";
            }
        } else {
            $query = "INSERT INTO iResturant_Staff (id, number, name, dob, gender, phone, email, adr, passport, login_password, login_permission, date_employed) 
            VALUES(?,?,?,?,?,?,?,?,?,?,?,?)";
            $stmt = $mysqli->prepare($query);
            $rc = $stmt->bind_param('ssssssssssss', $id, $number, $name, $dob, $gender, $phone, $email, $adr, $passport, $login_password, $login_permission, $date_employed);
            $stmt->execute();
            if ($stmt) {
                $success = "$name - $number  Added";
            } else {
                $info = "Please Try Again Or Try Later";
            }
        }
    }
}

/* Update Staff Account */
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

/* Delete Staff */
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $adn = 'DELETE FROM iResturant_Staff WHERE id=?';
    $stmt = $mysqli->prepare($adn);
    $stmt->bind_param('s', $id);
    $stmt->execute();
    $stmt->close();
    if ($stmt) {
        $success = 'Staff Account Deleted' && header('refresh:1; url=hrm_staffs');;
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
                                    <h4 class="page-title">HRM - Staffs</h4>
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="dashboard">HRM</a></li>
                                        <li class="breadcrumb-item active">Staffs</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end page title end breadcrumb -->


                <div class="row">
                    <div class="col-lg-12 col-sm-12">
                        <div class="text-center">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_staff">Add Staff</button>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#bulk_import_staff">Bulk Import Staffs</button>

                        </div>
                        <!-- Add  Modal -->
                        <div class="modal fade" id="add_staff" tabindex="-1" role="dialog" aria-labelledby="exampleModalPrimary1" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-primary">
                                        <h6 class="modal-title m-0 text-white" id="exampleModalPrimary1">Fill All Required Fields</h6>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <form method="post" enctype="multipart/form-data" role="form">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label for="">Number </label>
                                                            <input type="text" readonly required name="number" value="<?php echo $b; ?>" class="form-control" id="exampleInputEmail1">
                                                            <input type="hidden" required name="id" value="<?php echo $sys_gen_id; ?>" class="form-control">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="">Full Name </label>
                                                            <input type="text" required name="name" class="form-control" id="exampleInputEmail1">
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
                                                            <input type="text" placeholder="DD/MM/YYYY" required name="dob" class="form-control" id="exampleInputEmail1">
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label for="">Phone Number </label>
                                                            <input type="text" required name="phone" class="form-control" id="exampleInputEmail1">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="">Email Address </label>
                                                            <input type="text" required name="email" class="form-control" id="exampleInputEmail1">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="">Date Employed </label>
                                                            <input type="date" required name="date_employed" class="form-control" id="exampleInputEmail1">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="">Passport (Profile Picture) </label>
                                                            <input type="file" name="passport" class="form-control" id="exampleInputEmail1">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="">Login Password </label>
                                                            <input type="text" required value='<?php echo $sys_gen_password; ?>' name="login_password" class="form-control" id="exampleInputEmail1">
                                                            <input type="hidden" required value='Allow Login' name="login_permission" class="form-control" id="exampleInputEmail1">
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <label for="">Address</label>
                                                            <textarea type="text" required name="adr" class="form-control" rows="4" id="exampleInputEmail1"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="text-center">
                                                    <button type="submit" name="add_staff" class="btn btn-primary">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Modal -->

                        <!-- Bulk Import Modal -->
                        <div class="modal fade" id="bulk_import_staff" tabindex="-1" role="dialog" aria-labelledby="exampleModalPrimary1" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-primary">
                                        <h6 class="modal-title m-0 text-white" id="exampleModalPrimary1">Bulk Import Staffs</h6>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <form method="post" enctype="multipart/form-data" role="form">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="form-group text-center col-md-12">
                                                            <label for="exampleInputFile">Allowed File Types: XLS, XLSX. Please, <a class="text-primary" href="../public/uploads/sys_data/Templates/Staff.xlsx">Download</a> A Sample File. </label>
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <input required name="file" accept=".xls,.xlsx" type="file" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="text-center">
                                                    <button type="submit" name="upload" class="btn btn-primary">Upload File</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Modal -->

                        <hr>
                        <div class="card">
                            <!--end card-header-->
                            <div class="card-body table-responsive">
                                <div class="">
                                    <table class="table dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>Number</th>
                                                <th>Name</th>
                                                <th>Contact Details</th>
                                                <th>Gender</th>
                                                <th>D.O.B</th>
                                                <th>Date Employed</th>
                                                <th>Manage</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $ret = "SELECT * FROM  iResturant_Staff ";
                                            $stmt = $mysqli->prepare($ret);
                                            $stmt->execute(); //ok
                                            $res = $stmt->get_result();
                                            while ($staffs = $res->fetch_object()) {
                                            ?>
                                                <tr>
                                                    <td>
                                                        <a href="hrm_staff?view=<?php echo $staffs->id; ?>" class="text-primary">
                                                            <?php echo $staffs->number; ?>
                                                        </a>
                                                    </td>
                                                    <td><?php echo $staffs->name; ?></td>
                                                    <td>
                                                        Phone: <?php echo $staffs->phone; ?><br>
                                                        Email: <?php echo $staffs->email; ?><br>
                                                        Adr: <?php echo $staffs->adr; ?>
                                                    </td>
                                                    <td><?php echo $staffs->gender; ?></td>
                                                    <td><?php echo date('d M Y', strtotime($staffs->dob)); ?></td>
                                                    <td><?php echo date('d M Y', strtotime($staffs->date_employed)); ?></td>
                                                    <td>
                                                        <a href="#edit-<?php echo $staffs->id; ?>" data-bs-toggle="modal" data-bs-target="#edit-<?php echo $staffs->id; ?>" class="btn btn-sm btn-outline-warning">
                                                            <i data-feather="edit" class="align-self-center icon-xs ms-1"></i> Edit
                                                        </a>
                                                        <a href="#delete-<?php echo $staffs->id; ?>" data-bs-toggle="modal" data-bs-target="#delete-<?php echo $staffs->id; ?>" class="btn btn-sm btn-outline-danger">
                                                            <i data-feather="trash" class="align-self-center icon-xs ms-1"></i> Delete
                                                        </a>
                                                        <!-- Edit  Modal -->
                                                        <div class="modal fade" id="edit-<?php echo $staffs->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalPrimary1" aria-hidden="true">
                                                            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header bg-warning">
                                                                        <h6 class="modal-title m-0 text-white" id="exampleModalPrimary1">Edit Meal Category</h6>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="row">
                                                                            <form method="post" enctype="multipart/form-data" role="form">
                                                                                <div class="card-body">
                                                                                    <div class="row">
                                                                                        <div class="form-group col-md-6">
                                                                                            <label for="">Number </label>
                                                                                            <input type="text" readonly required name="number" value="<?php echo $staffs->number; ?>" class="form-control" id="exampleInputEmail1">
                                                                                            <input type="hidden" required name="id" value="<?php echo $staffs->id; ?>" class="form-control">
                                                                                        </div>
                                                                                        <div class="form-group col-md-6">
                                                                                            <label for="">Full Name </label>
                                                                                            <input type="text" required name="name" value="<?php echo $staffs->name; ?>" class="form-control" id="exampleInputEmail1">
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
                                                                                            <input type="text" placeholder="DD/MM/YYYY" value="<?php echo $staffs->dob; ?>" required name="dob" class="form-control" id="exampleInputEmail1">
                                                                                        </div>
                                                                                        <div class="form-group col-md-4">
                                                                                            <label for="">Phone Number </label>
                                                                                            <input type="text" required name="phone" value="<?php echo $staffs->phone; ?>" class="form-control" id="exampleInputEmail1">
                                                                                        </div>
                                                                                        <div class="form-group col-md-6">
                                                                                            <label for="">Email Address </label>
                                                                                            <input type="text" required value="<?php echo $staffs->email; ?>" name="email" class="form-control" id="exampleInputEmail1">
                                                                                        </div>
                                                                                        <div class="form-group col-md-6">
                                                                                            <label for="">Date Employed </label>
                                                                                            <input type="date" required value="<?php echo $staffs->date_employed; ?>" name="date_employed" class="form-control" id="exampleInputEmail1">
                                                                                        </div>

                                                                                        <div class="form-group col-md-12">
                                                                                            <label for="">Address</label>
                                                                                            <textarea type="text" required name="adr" class="form-control" rows="4" id="exampleInputEmail1"><?php echo $staffs->adr; ?></textarea>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="text-center">
                                                                                    <button type="submit" name="update_staff" class="btn btn-primary">Submit</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- End Edit Modal -->

                                                        <!-- Delete Room Category Modal -->
                                                        <div class="modal fade" id="delete-<?php echo $staffs->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">CONFIRM</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                                                                    </div>
                                                                    <div class="modal-body text-center text-danger">
                                                                        <h4>Delete <?php echo $staffs->name; ?> ?</h4>
                                                                        <br>
                                                                        <p>Heads Up, You are about to delete <?php echo $staffs->name; ?> account. This action is irrevisble.</p>
                                                                        <button type="button" class="btn btn-soft-success" data-bs-dismiss="modal">No</button>
                                                                        <a href="hrm_staffs?delete=<?php echo $staffs->id; ?>" class="text-center btn btn-danger"> Delete </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- End Delete Modal -->
                                                    </td>
                                                </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end row-->
            </div><!-- container -->

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