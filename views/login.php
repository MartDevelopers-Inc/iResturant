<?php
/*
 * Created on Fri Jul 09 2021
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
require_once('../partials/head.php');

/* Login */
if (isset($_POST['Login'])) {
    $email = trim($_POST['email']);
    $password = sha1(md5($_POST['password']));
    $stmt = $mysqli->prepare("SELECT email, password, id  FROM iResturant_Admin_Login  WHERE email =? AND password =?");
    $stmt->bind_param('ss', $email, $password);
    $stmt->execute();
    $stmt->bind_result($email, $password, $id);
    $rs = $stmt->fetch();
    $_SESSION['id'] = $id;
    $_SESSION['email'] = $email;
    if ($rs) {
        header("location:dashboard");
    } else {
        $err = "Access Denied Please Check Your Credentials";
    }
}

/* Load System Settings */
$ret = "SELECT * FROM `iResturant_System_Details`  ";
$stmt = $mysqli->prepare($ret);
$stmt->execute(); //ok
$res = $stmt->get_result();
while ($sys = $res->fetch_object()) {
?>

    <body class="account-body accountbg">
        <div class="container">
            <div class="row vh-100 d-flex justify-content-center">
                <div class="col-12 align-self-center">
                    <div class="row">
                        <div class="col-lg-5 mx-auto">
                            <div class="card">
                                <div class="card-body p-0 auth-header-box">
                                    <div class="text-center p-3">
                                        <a href="" class="logo logo-admin">
                                            <img src="../public/uploads/sys_logo/<?php echo $sys->logo; ?>" height="50" alt="logo" class="auth-logo">
                                        </a>
                                        <h4 class="mt-3 mb-1 fw-semibold text-white font-18">Login</h4>
                                        <p class="text-muted  mb-0">Sign in to continue to <?php echo $sys->system_name; ?> Administrator dashboard.</p>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <form class="form-horizontal auth-form" method="POST">
                                        <div class="form-group mb-2">
                                            <label class="form-label" for="username">Email</label>
                                            <div class="input-group">
                                                <input required type="text" name="email" id="username" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group mb-2">
                                            <label class="form-label" for="userpassword">Password</label>
                                            <div class="input-group">
                                                <input required type="password" id="password" name="password" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row my-3">
                                            <div class="col-sm-6">
                                                <!-- <div class="custom-control custom-switch switch-success">
                                                    <input type="checkbox" class="custom-control-input" id="customSwitchSuccess">
                                                    <label class="form-label text-muted" for="customSwitchSuccess">Remember me</label>
                                                </div> -->
                                            </div>
                                            <div class="col-sm-6 text-end">
                                                <a href="reset_password" class="text-muted font-13"><i class="dripicons-lock"></i> Forgot password?</a>
                                            </div>
                                        </div>

                                        <div class="form-group mb-0 row">
                                            <div class="col-12">
                                                <button name="Login" class="btn btn-primary w-100 waves-effect waves-light" type="submit">Log In <i class="fas fa-sign-in-alt ms-1"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-body bg-light-alt text-center">
                                    <span class="text-muted d-none d-sm-inline-block">MartDevelopers Inc © <script>
                                            document.write(new Date().getFullYear())
                                        </script>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- jQuery  -->
        <?php require_once('../partials/scripts.php'); ?>
    </body>
<?php } ?>

</html>