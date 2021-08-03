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
require_once('../config/codeGen.php');
require_once('../partials/head.php');

/* Reset Password */
if (isset($_POST['Reset_Password'])) {
    if (isset($_POST['email']) && !empty($_POST['email'])) {
        $email = mysqli_real_escape_string($mysqli, trim($_POST['email']));
    } else {
        $error = 1;
        $err = "Enter Your E-mail";
    }
    $query = mysqli_query($mysqli, "SELECT * from `iResturant_Admin_Login` WHERE email='" . $email . "'");
    $num_rows = mysqli_num_rows($query);

    if ($num_rows > 0) {
        $password = $sys_gen_password;
        /* Mail User Plain Password */
        $new_password = substr($password, 0, 10);
        /* Hash Password  */
        $hashed_password = sha1(md5($new_password));
        $query = "UPDATE iResturant_Admin_Login SET  password =? WHERE  email =?";
        $stmt = $mysqli->prepare($query);
        $rc = $stmt->bind_param('ss', $hashed_password, $email);
        $stmt->execute();
        /* Load Mailer */
        require_once('../config/password_reset_mailer.php');
        if ($stmt && $mail->send()) {
            $success = "Password Reset Instructions Sent To Your Mail";
        } else {
            $err = "Password Reset Failed!, Try again $mail->ErrorInfo";
        }
    } else {
        $err = "Sorry, User Account With That Email Does Not Exist";
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
                                        <h4 class="mt-3 mb-1 fw-semibold text-white font-18">Reset Password</h4>
                                        <p class="text-muted  mb-0">Enter your Email and instructions will be sent to you!</p>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <form class="form-horizontal auth-form" method="POST">
                                        <div class="form-group mb-2">
                                            <label class="form-label" for="username">Email</label>
                                            <div class="input-group">
                                                <input type="email" name="email" class="form-control" id="email" placeholder="Enter Email">
                                            </div>
                                        </div>
                                        <!--end form-group-->
                                        <div class="form-group mb-0 row">
                                            <div class="col-12 mt-2">
                                                <button name="Reset_Password" class="btn btn-primary w-100 waves-effect waves-light" type="submit">Reset <i class="fas fa-user-lock ms-1"></i></button>
                                            </div>
                                            <!--end col-->
                                        </div>
                                        <!--end form-group-->
                                    </form>
                                    <!--end form-->
                                    <p class="text-muted mb-0 mt-3">Remembered Password? <a href="../" class="text-primary ms-2">Sign In</a></p>
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