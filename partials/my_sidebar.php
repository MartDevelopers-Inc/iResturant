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
$id = $_SESSION['id'];
$ret = "SELECT * FROM  iResturant_Customer WHERE id = '$id' ";
$stmt = $mysqli->prepare($ret);
$stmt->execute(); //ok
$res = $stmt->get_result();
while ($customer = $res->fetch_object()) {
    if ($customer->profile_pic == '') {
        $dir = '../public/uploads/user_images/no-profile.png';
    } else {
        $dir = "../public/uploads/user_images/$customer->profile_pic";
    }
?>
    <div class="sidebar-nav">
        <div class="sidebar-nav-body">
            <div class="side-menu-close">
                <i class="la la-times"></i>
            </div><!-- end menu-toggler -->
            <div class="author-content">
                <div class="d-flex align-items-center">
                    <div class="author-img avatar-sm">
                        <img src="<?php echo $dir; ?>" alt="testimonial image">
                    </div>
                    <div class="author-bio">
                        <h4 class="author__title"><?php echo $customer->name; ?></h4>
                        <span class="author__meta">My Dashbord</span>
                    </div>
                </div>
            </div>
            <div class="sidebar-menu-wrap">
                <ul class="sidebar-menu list-items">
                    <li><a href="my_dashboard"><i class="la la-dashboard mr-2"></i> Dashboard</a></li>
                    <li><a href="my_rooms_bookings"><i class="la la-calendar-check mr-2 text-color"></i> Reservations</a></li>
                    <li><a href="my_orders"><i class="la la-list-alt mr-2 text-color-2"></i> Orders</a></li>
                    <li><a href="my_testimonials"><i class="la la-quote-left mr-2 text-color-3"></i> My Testimonials</a></li>
                    <li><a href="my_settings"><i class="la la-cog mr-2 text-color-5"></i> Settings</a></li>
                    <li><a href="logout"><i class="la la-power-off mr-2 text-color-6"></i> Log Out</a></li>
                </ul>
            </div><!-- end sidebar-menu-wrap -->
        </div>
    </div>
<?php } ?>