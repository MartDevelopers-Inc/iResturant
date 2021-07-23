<?php
/*
 * Created on Fri Jul 23 2021
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

/* Update Update STMT Settings */
if (isset($_POST['update_mailer'])) {
    $host = $_POST['host'];
    $port = $_POST['port'];
    $protocol  = $_POST['protocol'];
    $username = $_POST['username'];
    $mail_from_name = $_POST['mail_from_name'];
    $password = $_POST['password'];
    $mail_from = $_POST['mail_from'];

    $query = "UPDATE iResturant_Mailer_Settings SET host =?, port = ?, protocol =?, username =?, mail_from_name=?, password=?, mail_from=? ";
    $stmt = $mysqli->prepare($query);
    $rc = $stmt->bind_param('sssssss', $host, $port, $protocol, $username, $mail_from_name, $password, $mail_from);
    $stmt->execute();
    if ($stmt) {
        $success = "Mailer Settings Updated";
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
                                    <h4 class="page-title">Mailer Settings</h4>
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                                        <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="dashboard">Settings</a></li>
                                        <li class="breadcrumb-item active">Mailing Settings</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end page title end breadcrumb -->


                <div class="row">
                    <div class="col-lg-12 col-sm-12">
                        <div class="card">
                            <!--end card-header-->
                            <div class="card-body table-responsive">
                                <div class="">
                                    <h3 class="text-center">STMP Mail Settings</h3>
                                    <?php
                                    $ret = "SELECT * FROM iResturant_Mailer_Settings";
                                    $stmt = $mysqli->prepare($ret);
                                    $stmt->execute(); //ok
                                    $res = $stmt->get_result();
                                    while ($mailer = $res->fetch_object()) {
                                    ?>
                                        <form method="post" enctype="multipart/form-data" role="form">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="form-group col-md-12">
                                                        <label for="">Host</label>
                                                        <input type="text" required name="host" value="<?php echo $mailer->host; ?>" class="form-control" id="exampleInputEmail1">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="">Mailing Protocol</label>
                                                        <select required name="port" class="form-control" id="exampleInputEmail1">
                                                            <option value="ssl">SSL</option>
                                                            <option value="tls">TLS</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="">Port</label>
                                                        <select required name="protocol" class="form-control" id="exampleInputEmail1">
                                                            <option>465</option>
                                                            <option>587</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label for="">Mail From</label>
                                                        <input type="text" required name="mail_from" value="<?php echo $mailer->mail_from; ?>" class="form-control" id="exampleInputEmail1">
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label for="">Mail From Name</label>
                                                        <input type="text" required name="mail_from_name" value="<?php echo $mailer->mail_from_name; ?>" class="form-control" id="exampleInputEmail1">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="">Username</label>
                                                        <input type="text" required name="username" value="<?php echo $mailer->username; ?>" class="form-control" id="exampleInputEmail1">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="">Password</label>
                                                        <input type="text" required name="password" value="<?php echo $mailer->password; ?>" class="form-control" id="exampleInputEmail1">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <button type="submit" name="update_mailer" class="btn btn-primary">Submit</button>
                                            </div>
                                        </form>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>

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