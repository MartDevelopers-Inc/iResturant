<?php
/*
 * Created on Thu Jul 29 2021
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

require_once('../config/config.php');
require_once('../config/codeGen.php');

/* Process Mailing */
if (isset($_POST['send_mail'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    /* Load Mailer */
    require_once('../config/contact_mailer.php');
    if ($mail->send()) {
        $success = "Messange Send, We Will Contact You";
    } else {
        $err = "Please Try Again Later";
    }
}

/* Load System COnfigurations And Settings */
$ret = "SELECT * FROM `iResturant_System_Details` JOIN iResturant_Currencies c 
WHERE c.status = 'Active'  ";
$stmt = $mysqli->prepare($ret);
$stmt->execute(); //ok
$res = $stmt->get_result();
while ($sys = $res->fetch_object()) {
    require_once('../partials/landing_head.php'); ?>

    <body>
        <!-- start cssload-loader -->
        <div class="preloader" id="preloader">
            <div class="loader">
                <svg class="spinner" viewBox="0 0 50 50">
                    <circle class="path" cx="25" cy="25" r="20" fill="none" stroke-width="5"></circle>
                </svg>
            </div>
        </div>
        <!-- end cssload-loader -->


        <?php require_once('../partials/landing_header.php'); ?>

        <section class="breadcrumb-area bread-bg-5">
            <div class="breadcrumb-wrap">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <div class="breadcrumb-content">
                                <div class="section-heading">
                                    <h2 class="sec__title text-white">Contact us</h2>
                                </div>
                            </div><!-- end breadcrumb-content -->
                        </div><!-- end col-lg-6 -->
                        <div class="col-lg-6">
                            <div class="breadcrumb-list text-right">
                                <ul class="list-items">
                                    <li><a href="landing_index">Home</a></li>
                                    <li>Contact us</li>
                                </ul>
                            </div><!-- end breadcrumb-list -->
                        </div><!-- end col-lg-6 -->
                    </div><!-- end row -->
                </div><!-- end container -->
            </div><!-- end breadcrumb-wrap -->
            <div class="bread-svg-box">
                <svg class="bread-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 10" preserveAspectRatio="none">
                    <polygon points="100 0 50 10 0 0 0 10 100 10"></polygon>
                </svg>
            </div><!-- end bread-svg -->
        </section><!-- end breadcrumb-area -->

        <section class="contact-area section--padding">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="form-box">
                            <div class="form-title-wrap">
                                <h3 class="title">We'd love to hear from you</h3>
                                <p class="font-size-15">Send us a message and we'll respond as soon as possible</p>
                            </div><!-- form-title-wrap -->
                            <div class="form-content ">
                                <div class="contact-form-action">
                                    <form class="row messenger-box-form" method="post">
                                        <div class="alert alert-success messenger-box-contact__msg col-lg-12" style="display: none" role="alert">
                                            Thank You! Your message has been sent.
                                        </div>
                                        <div class="col-lg-6 responsive-column">
                                            <div class="input-box messenger-box-input-wrap">
                                                <label class="label-text" for="name">Your Name</label>
                                                <div class="form-group">
                                                    <span class="la la-user form-icon"></span>
                                                    <input class="form-control" type="text" id="name" name="name" placeholder="Your name" required>
                                                </div>
                                            </div>
                                        </div><!-- end col-lg-6 -->
                                        <div class="col-lg-6 responsive-column">
                                            <div class="input-box messenger-box-input-wrap">
                                                <label class="label-text" for="email">Your Email</label>
                                                <div class="form-group">
                                                    <span class="la la-envelope-o form-icon"></span>
                                                    <input class="form-control" type="email" name="email" id="email" placeholder="Email address" required>
                                                </div>
                                            </div>
                                        </div><!-- end col-lg-6 -->
                                        <div class="col-lg-12">
                                            <div class="input-box messenger-box-input-wrap">
                                                <label class="label-text" for="message">Message</label>
                                                <div class="form-group">
                                                    <span class="la la-pencil form-icon"></span>
                                                    <textarea class="message-control form-control" name="message" id="message" placeholder="Write message" required></textarea>
                                                </div>
                                            </div>
                                        </div><!-- end col-lg-12 -->

                                        <div class="col-lg-12">
                                            <div class="btn-box messenger-box-input-wrap">
                                                <br>
                                                <button name="send_mail" type="submit" class="theme-btn send-message-btn" id="send-message-btn">Send Message</button>
                                            </div>
                                        </div><!-- end col-lg-12 -->
                                    </form>
                                </div><!-- end contact-form-action -->
                            </div><!-- end form-content -->
                        </div><!-- end form-box -->
                    </div><!-- end col-lg-8 -->
                    <div class="col-lg-4">
                        <div class="form-box">
                            <div class="form-title-wrap">
                                <h3 class="title">Contact Us</h3>
                            </div><!-- form-title-wrap -->
                            <div class="form-content">
                                <div class="address-book">
                                    <ul class="list-items contact-address">
                                        <li>
                                            <i class="la la-map-marker icon-element"></i>
                                            <h5 class="title font-size-16 pb-1">Address</h5>
                                            <p class="map__desc">
                                                <?php echo $sys->address; ?>
                                            </p>
                                        </li>
                                        <li>
                                            <i class="la la-phone icon-element"></i>
                                            <h5 class="title font-size-16 pb-1">Phone</h5>
                                            <p class="map__desc">Mobile: <?php echo $sys->contact_details; ?></p>
                                        </li>
                                        <li>
                                            <i class="la la-envelope-o icon-element"></i>
                                            <h5 class="title font-size-16 pb-1">Email</h5>
                                            <p class="map__desc"><?php echo $sys->mail; ?></p>
                                        </li>
                                    </ul>
                                    <ul class="social-profile text-center">
                                        <li><a href="https://facebook.com/<?php echo $sys->sys_facebook; ?>"><i class="lab la-facebook-f"></i></a></li>
                                        <li><a href="https://twitter.com/<?php echo $sys->sys_twitter; ?>"><i class="lab la-twitter"></i></a></li>
                                        <li><a href="https://instagram.com/<?php echo $sys->sys_instagram; ?>"><i class="lab la-instagram"></i></a></li>
                                        <li><a href="https://linkedin.com/<?php echo $sys->sys_linked_in; ?>"><i class="lab la-linkedin-in"></i></a></li>
                                    </ul>
                                </div>
                            </div><!-- end form-content -->
                        </div><!-- end form-box -->
                    </div><!-- end col-lg-4 -->
                </div><!-- end row -->
            </div><!-- end container -->
        </section><!-- end contact-area -->


        <?php require_once('../partials/landing_footer.php'); ?>

        <!-- start back-to-top -->
        <div id="back-to-top">
            <i class="la la-angle-up" title="Go top"></i>
        </div>
        <!-- end back-to-top -->

        <?php require_once('../partials/landing_scripts.php'); ?>
    </body>

    </html>
<?php
} ?>