 <?php
    /*
 * Created on Mon Aug 02 2021
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
    require_once('../config/codeGen.php');
    /* Sign Up  */
    if (isset($_POST['Sign_Up'])) {
        $id = $sys_gen_id;
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $adr = $_POST['adr'];
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
                $query = "INSERT INTO iResturant_Customer (id, name, email, phone, adr, login_password) VALUES(?,?,?,?,?,?)";
                $stmt = $mysqli->prepare($query);
                $rc = $stmt->bind_param('sssssss', $id, $name, $email, $phone, $adr, $confirm_password);
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

    /* Sign In */
    if (isset($_POST['Sign_In'])) {
        $email = trim($_POST['email']);
        $login_password = sha1(md5($_POST['login_password']));
        $stmt = $mysqli->prepare("SELECT email, login_password, id   FROM iResturant_Customer  WHERE email =? AND login_password =?");
        $stmt->bind_param('ss', $email, $login_password);
        $stmt->execute();
        $stmt->bind_result($email, $login_password, $id);
        $rs = $stmt->fetch();
        $_SESSION['id'] = $id;
        $_SESSION['email'] = $email;
        if ($rs) {
            header("location:my_dashboard");
        } else {
            $err = "Access Denied Please Check Your Credentials";
        }
    }

    ?>
 <!-- end modal-shared -->
 <div class="modal-popup">
     <div class="modal fade" id="signupPopupForm" tabindex="-1" role="dialog" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered" role="document">
             <div class="modal-content">
                 <div class="modal-header">
                     <div>
                         <h5 class="modal-title title" id="exampleModalLongTitle">Sign Up</h5>
                         <p class="font-size-14">Hello! Welcome Create a New Account</p>
                     </div>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true" class="la la-close"></span>
                     </button>
                 </div>
                 <div class="modal-body">
                     <div class="contact-form-action">
                         <form method="post">
                             <div class="input-box">
                                 <label class="label-text">First Name & Last Name</label>
                                 <div class="form-group">
                                     <span class="la la-user form-icon"></span>
                                     <input class="form-control" required type="text" name="name">
                                 </div>
                             </div><!-- end input-box -->
                             <div class="input-box">
                                 <label class="label-text">Phone Number</label>
                                 <div class="form-group">
                                     <span class="la la-phone form-icon"></span>
                                     <input class="form-control" required type="number" name="phone">
                                 </div>
                             </div><!-- end input-box -->
                             <div class="input-box">
                                 <label class="label-text">Email Address</label>
                                 <div class="form-group">
                                     <span class="la la-envelope form-icon"></span>
                                     <input class="form-control" required type="email" name="email">
                                 </div>
                             </div><!-- end input-box -->
                             <div class="input-box">
                                 <label class="label-text">Address</label>
                                 <div class="form-group">
                                     <span class="la la-map-pin form-icon"></span>
                                     <input class="form-control" required type="text" name="adr">
                                 </div>
                             </div><!-- end input-box -->
                             <div class="input-box">
                                 <label class="label-text">Password</label>
                                 <div class="form-group">
                                     <span class="la la-lock form-icon"></span>
                                     <input class="form-control" required type="password" name="new_password">
                                 </div>
                             </div><!-- end input-box -->
                             <div class="input-box">
                                 <label class="label-text">Confirm Password</label>
                                 <div class="form-group">
                                     <span class="la la-lock form-icon"></span>
                                     <input class="form-control" required type="password" name="confirm_password">
                                 </div>
                             </div><!-- end input-box -->
                             <div class="btn-box pt-3 pb-4">
                                 <button type="submit" name="Sign_Up" class="theme-btn w-100">Register Account</button>
                             </div>
                         </form>
                     </div><!-- end contact-form-action -->
                 </div>
             </div>
         </div>
     </div>
 </div><!-- end modal-popup -->

 <!-- end modal-shared -->
 <div class="modal-popup">
     <div class="modal fade" id="loginPopupForm" tabindex="-1" role="dialog" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered" role="document">
             <div class="modal-content">
                 <div class="modal-header">
                     <div>
                         <h5 class="modal-title title" id="exampleModalLongTitle2">Login</h5>
                         <p class="font-size-14">Hello! Welcome to your account</p>
                     </div>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true" class="la la-close"></span>
                     </button>
                 </div>
                 <div class="modal-body">
                     <div class="contact-form-action">
                         <form method="post">
                             <div class="input-box">
                                 <label class="label-text">Email Addrsss</label>
                                 <div class="form-group">
                                     <span class="la la-user form-icon"></span>
                                     <input class="form-control" type="email" required name="email">
                                 </div>
                             </div><!-- end input-box -->
                             <div class="input-box">
                                 <label class="label-text">Password</label>
                                 <div class="form-group mb-2">
                                     <span class="la la-lock form-icon"></span>
                                     <input class="form-control" type="password" required name="login_password">
                                 </div>
                                 <div class="d-flex align-items-center justify-content-between">
                                     <div class="custom-checkbox mb-0">

                                     </div>
                                     <p class="forgot-password">
                                         <a href="landing_reset_password">Forgot Password?</a>
                                     </p>
                                 </div>
                             </div><!-- end input-box -->
                             <div class="btn-box pt-3 pb-4">
                                 <button type="submit" name="Sign_In" class="theme-btn w-100">Login Account</button>
                             </div>
                         </form>
                     </div><!-- end contact-form-action -->
                 </div>
             </div>
         </div>
     </div>
 </div><!-- end modal-popup -->

 <script src="../public/js/jquery-3.4.1.min.js"></script>
 <script src="../public/js/jquery-ui.js"></script>
 <script src="../public/js/popper.min.js"></script>
 <script src="../public/js/bootstrap.min.js"></script>
 <script src="../public/js/bootstrap-select.min.js"></script>
 <script src="../public/js/moment.min.js"></script>
 <script src="../public/js/daterangepicker.js"></script>
 <script src="../public/js/owl.carousel.min.js"></script>
 <script src="../public/js/jquery.fancybox.min.js"></script>
 <script src="../public/js/jquery.countTo.min.js"></script>
 <script src="../public/js/animated-headline.js"></script>
 <script src="../public/js/jquery.ripples-min.js"></script>
 <script src="../public/js/quantity-input.js"></script>
 <script src="../public/js/jquery.superslides.min.js"></script>
 <script src="../public/js/superslider-script.js"></script>
 <script src="../public/js/main.js"></script>
 <!-- Izi Toast Js -->
 <script src="../public/plugins/iziToast/iziToast.min.js"></script>
 <!-- Init Izi Toast -->
 <?php if (isset($success)) { ?>
     <!--This code for injecting success alert-->
     <script>
         iziToast.success({
             title: 'Success',
             position: 'topRight',
             transitionIn: 'flipInX',
             transitionOut: 'flipOutX',
             transitionInMobile: 'fadeInUp',
             transitionOutMobile: 'fadeOutDown',
             message: '<?php echo $success; ?>',
         });
     </script>

 <?php } ?>

 <?php if (isset($err)) { ?>
     <!--This code for injecting error alert-->
     <script>
         iziToast.error({
             title: 'Error',
             timeout: 10000,
             resetOnHover: true,
             position: 'topRight',
             transitionIn: 'flipInX',
             transitionOut: 'flipOutX',
             transitionInMobile: 'fadeInUp',
             transitionOutMobile: 'fadeOutDown',
             message: '<?php echo $err; ?>',
         });
     </script>

 <?php } ?>

 <?php if (isset($info)) { ?>
     <!--This code for injecting info alert-->
     <script>
         iziToast.warning({
             title: 'Warning',
             position: 'topLeft',
             transitionIn: 'flipInX',
             transitionOut: 'flipOutX',
             transitionIn: 'fadeInUp',
             transitionInMobile: 'fadeInUp',
             transitionOutMobile: 'fadeOutDown',
             message: '<?php echo $info; ?>',
         });
     </script>

 <?php }
    ?>