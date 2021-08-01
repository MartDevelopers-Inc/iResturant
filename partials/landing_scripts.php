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
                                     <input class="form-control" required type="text" name="email">
                                 </div>
                             </div><!-- end input-box -->
                             <div class="input-box">
                                 <label class="label-text">Address</label>
                                 <div class="form-group">
                                     <span class="la la-map-pin form-icon"></span>
                                     <input class="form-control" required type="text" name="email">
                                 </div>
                             </div><!-- end input-box -->
                             <div class="input-box">
                                 <label class="label-text">Password</label>
                                 <div class="form-group">
                                     <span class="la la-lock form-icon"></span>
                                     <input class="form-control" required type="password" name="password">
                                 </div>
                             </div><!-- end input-box -->
                             <div class="input-box">
                                 <label class="label-text">Confirm Password</label>
                                 <div class="form-group">
                                     <span class="la la-lock form-icon"></span>
                                     <input class="form-control" required type="password" name="password">
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
                                     <input class="form-control" type="text" name="email">
                                 </div>
                             </div><!-- end input-box -->
                             <div class="input-box">
                                 <label class="label-text">Password</label>
                                 <div class="form-group mb-2">
                                     <span class="la la-lock form-icon"></span>
                                     <input class="form-control" type="text" name="login_password">
                                 </div>
                                 <div class="d-flex align-items-center justify-content-between">
                                     <div class="custom-checkbox mb-0">

                                     </div>
                                     <p class="forgot-password">
                                         <a href="reset_password">Forgot Password?</a>
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