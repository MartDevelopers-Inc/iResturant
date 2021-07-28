<section class="footer-area section-bg padding-top-40px padding-bottom-30px">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
            </div><!-- end col-lg-8 -->
            <div class="col-lg-4">
                <div class="footer-social-box text-right">
                    <ul class="social-profile">
                        <li><a href="<?php echo $sys->sys_facebook; ?>"><i class="lab la-facebook-f"></i></a></li>
                        <li><a href="<?php echo $sys->sys_twitter; ?>"><i class="lab la-twitter"></i></a></li>
                        <li><a href="<?php echo $sys->sys_instagram; ?>"><i class="lab la-instagram"></i></a></li>
                        <li><a href="<?php echo $sys->sys_linked_in; ?>"><i class="lab la-linkedin-in"></i></a></li>
                    </ul>
                </div>
            </div><!-- end col-lg-4 -->
        </div><!-- end row -->
    </div>
    <div class="section-block mt-4 mb-5"></div>

    <div class="container">
        <div class="row">
            <div class="col-lg-3 responsive-column">
                <div class="footer-item">
                    <div class="footer-logo padding-bottom-30px">
                        <a href="index.html" class="foot__logo"><img height="70" width="100" src="../public/uploads/sys_logo/<?php echo $sys->logo; ?>" alt="logo"></a>
                    </div><!-- end logo -->
                    <p class="footer__desc"><?php echo substr($sys->about, 0, 100); ?>...</p>
                    <ul class="list-items pt-3">
                        <li><?php echo $sys->address; ?></li>
                        <li><?php echo $sys->contact_details; ?></li>
                        <li><a href="mailto:<?php echo $sys->mail; ?>"><?php echo $sys->mail; ?></a></li>
                    </ul>
                </div><!-- end footer-item -->
            </div><!-- end col-lg-3 -->
            <div class="col-lg-3 responsive-column">
                <div class="footer-item">
                    <h4 class="title curve-shape pb-3 margin-bottom-20px" data-text="curvs">Company</h4>
                    <ul class="list-items list--items">
                        <li><a href="landing_about">About Us</a></li>
                        <li><a href="landing_mission">Vision & Mission</a></li>
                        <li><a href="landing_values">Values</a></li>
                        <li><a href="landing_rooms">Rooms & Rates</a></li>
                        <li><a href="landing_restutant">Resturant</a></li>
                        <li><a href="landing_contact">Contact Us</a></li>
                    </ul>
                </div><!-- end footer-item -->
            </div><!-- end col-lg-3 -->

            <div class="col-lg-3 responsive-column">
                <div class="footer-item">
                    <h4 class="title curve-shape pb-3 margin-bottom-20px" data-text="curvs">Other Links</h4>
                    <ul class="list-items list--items">
                        <li><a href="landing_privacy_policy">Privacy Policy</a></li>
                        <li><a href="landing_tc">Terms And Conditions</a></li>
                        <li><a href="landing_faq">FAQ</a></li>
                    </ul>
                </div><!-- end footer-item -->
            </div><!-- end col-lg-3 -->

            <div class="col-lg-3 responsive-column">
                <div class="footer-item">
                    <h4 class="title curve-shape pb-3 margin-bottom-20px" data-text="curvs">Payment Methods & Options</h4>
                    <p class="footer__desc pb-3">Pay any way you choose, we support all payment options.</p>
                    <img src="../public/images/payment-img.png" alt="">
                </div><!-- end footer-item -->
            </div><!-- end col-lg-3 -->
        </div><!-- end row -->
        <div class="section-block"></div>
        <div class="row">
            <div class="col-lg-12">
                <div class="copy-right padding-top-30px text-center">
                    <p class="copy__desc">
                        &copy; Copyright <?php echo $sys->system_name; ?> 2021-<?php echo date('Y'); ?>. Made with
                        <span class="la la-heart"></span> by <a href="http://martdev.info" target="_blank">MartDevelopers Inc</a>
                    </p>
                </div><!-- end copy-right -->
            </div><!-- end col-lg-12 -->
        </div><!-- end row -->
    </div><!-- end container -->
</section><!-- end footer-area -->