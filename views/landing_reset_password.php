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
session_start();
require_once('../config/config.php');
/* Load System COnfigurations And Settings */
$ret = "SELECT * FROM `iResturant_System_Details`  ";
$stmt = $mysqli->prepare($ret);
$stmt->execute(); //ok
$res = $stmt->get_result();
while ($sys = $res->fetch_object()) {
    require_once('../partials/landing_head.php');
?>

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

        <section class="breadcrumb-area bread-bg-9">
            <div class="breadcrumb-wrap">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <div class="breadcrumb-content">
                                <div class="section-heading">
                                    <h2 class="sec__title text-white">Recover Password</h2>
                                </div>
                            </div><!-- end breadcrumb-content -->
                        </div><!-- end col-lg-6 -->
                        <div class="col-lg-6">
                            <div class="breadcrumb-list text-right">
                                <ul class="list-items">
                                    <li><a href="landing_index">Home</a></li>
                                    <li>Recover Password</li>
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

        <section class="contact-area padding-top-100px padding-bottom-70px">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 mx-auto">
                        <div class="form-box">
                            <div class="form-title-wrap">
                                <h3 class="title">Recover Password</h3>
                                <p class="font-size-15 pt-2">Enter the email of your account to reset password. Then you will receive a link to email to reset the password.If you have any issue about reset password
                                    <a href="landing_contact" class="text-color">contact us</a>
                                </p>
                            </div><!-- form-title-wrap -->
                            <div class="form-content ">
                                <div class="contact-form-action">
                                    <form method="post">
                                        <div class="input-box">
                                            <label class="label-text">Your Email</label>
                                            <div class="form-group">
                                                <span class="la la-envelope-o form-icon"></span>
                                                <input class="form-control" type="email" name="email" placeholder="Enter email address">
                                            </div>
                                        </div>
                                        <div class="btn-box">
                                            <button type="submit" name="Reset_Password" class="theme-btn">Reset Password</button>
                                        </div>
                                    </form>
                                </div><!-- end contact-form-action -->
                            </div><!-- end form-content -->
                        </div><!-- end form-box -->
                    </div><!-- end col-lg-8 -->
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
<?php } ?>