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
require_once('../config/codeGen.php');
require_once('../config/config.php');
require_once('../partials/head.php');

/* Sign Up */
if (isset($_POST['Sign_Up'])) {
    $id = $sys_gen_id;
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $adr = $_POST['adr'];
    $client_country = $_POST['client_country'];
    /* Check If Passwords Match */
    if ($new_password = sha1(md5($_POST['new_password'])) != $confirm_password = sha1(md5($_POST['confirm_password']))) {
        $err  = "Passwords Do Not Match";
    } else {
        $sql = "SELECT * FROM  iResturant_Customer  WHERE  (email='$email' || phone = '$phone')  ";
        $res = mysqli_query($mysqli, $sql);
        if (mysqli_num_rows($res) > 0) {
            $row = mysqli_fetch_assoc($res);
            if ($email == $row['email'] || $phone == $row['phone']) {
                $err =  "A Client Account With This Email Or Phone Number Already Exists";
            }
        } else {
            $query = "INSERT INTO iResturant_Customer (id, name, email, phone, adr, client_country, login_password) VALUES(?,?,?,?,?,?,?)";
            $stmt = $mysqli->prepare($query);
            $rc = $stmt->bind_param('sssssss', $id, $name, $email, $phone, $adr, $client_country, $confirm_password);
            $stmt->execute();
            /* Mail Customer */
            require_once('../config/welcome_mailer.php');

            if ($mail->send() && $stmt) {
                $success = "$name Account Created Proceed To Login";
            } else {
                $info = "Please Try Again Or Try Later $mail->ErrorInfo";
            }
        }
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
                                        <h4 class="mt-3 mb-1 fw-semibold text-white font-18">Sign Up</h4>
                                        <p class="text-muted  mb-0">Create Your Client Account</p>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <form class="form-horizontal auth-form" method="POST">
                                        <div class="form-group mb-2">
                                            <label class="form-label" for="username">First Name & Last Name</label>
                                            <div class="input-group">
                                                <input required type="text" name="name" id="username" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group mb-2">
                                            <label class="form-label" for="username">Phone Number</label>
                                            <div class="input-group">
                                                <input required type="number" name="phone" id="username" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group mb-2">
                                            <label class="form-label" for="username">Email</label>
                                            <div class="input-group">
                                                <input required type="email" name="email" id="username" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group mb-2">
                                            <label class="form-label" for="username">Address</label>
                                            <div class="input-group">
                                                <input required type="text" name="adr" id="username" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group mb-2">
                                            <label class="form-label" for="username">Country</label>
                                            <div class="input-group">
                                                <select required type="text" name="client_country" class="form-control">
                                                    <?php
                                                    $ret = "SELECT * FROM  iResturant_Country ";
                                                    $stmt = $mysqli->prepare($ret);
                                                    $stmt->execute(); //ok
                                                    $res = $stmt->get_result();
                                                    while ($country = $res->fetch_object()) {
                                                    ?>
                                                        <option value="<?php echo $country->id; ?>"><?php echo $country->name; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group mb-2">
                                            <label class="form-label" for="userpassword">Password</label>
                                            <div class="input-group">
                                                <input required type="password" id="password" name="new_password" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group mb-2">
                                            <label class="form-label" for="userpassword">Confirm Password</label>
                                            <div class="input-group">
                                                <input required type="password" id="password" name="confirm_password" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row my-3">
                                            <div class="col-sm-4">
                                            </div>
                                            <div class="col-sm-8 text-end">
                                                <a href="my_login" class="text-muted font-13"><i class="dripicons-user"></i> Login</a>
                                            </div>
                                        </div>
                                        <div class="form-group mb-0 row">
                                            <div class="col-12">
                                                <button name="Sign_Up" class="btn btn-primary w-100 waves-effect waves-light" type="submit">Sign Up <i class="fas fa-user-check ms-1"></i></button>
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