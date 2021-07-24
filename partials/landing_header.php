<header class="header-area">
    <div class="header-top-bar padding-right-100px padding-left-100px">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="header-top-content">
                        <div class="header-left">
                            <ul class="list-items">
                                <li><a href="#"><i class="la la-phone mr-1"></i><?php echo $sys->contact_details; ?></a></li>
                                <li><a href="mailto:<?php echo $sys->mail; ?>"><i class="la la-envelope mr-1"></i><?php echo $sys->mail; ?></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="header-top-content">
                        <div class="header-right d-flex align-items-center justify-content-end">

                            <div class="header-right-action">
                                <a href="#" class="theme-btn theme-btn-small theme-btn-transparent mr-1" data-toggle="modal" data-target="#signupPopupForm">Sign Up</a>
                                <a href="#" class="theme-btn theme-btn-small" data-toggle="modal" data-target="#loginPopupForm">Login</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-menu-wrapper padding-right-100px padding-left-100px">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="menu-wrapper justify-content-between">
                        <a href="#" class="down-button"><i class="la la-angle-down"></i></a>
                        <div class="logo">
                            <a href="../index"><img src="../public/uploads/sys_logo/<?php echo $sys->logo; ?>" height="70" width="100" alt="logo"></a>
                            <div class="menu-toggler">
                                <i class="la la-bars"></i>
                                <i class="la la-times"></i>
                            </div><!-- end menu-toggler -->
                        </div><!-- end logo -->
                        <div class="main-menu-content pr-0 ml-0">
                            <nav>
                                <ul>
                                    <li>
                                        <a href="landing_index">Home</a>
                                    </li>
                                    <li>
                                        <a href="#">About Us <i class="la la-angle-down"></i></a>
                                        <ul class="dropdown-menu-item">
                                            <li><a href="car-grid.html"></a></li>
                                            <li><a href="car-list.html">car list</a></li>
                                            <li><a href="car-sidebar.html">car sidebar </a></li>
                                            <li><a href="car-single.html">car details</a></li>
                                            <li><a href="car-booking.html">Car Booking</a></li>
                                            <li><a href="car-search-result.html">Car Search Result</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="landing_rooms">Rooms & Rates</a>
                                    </li>
                                    </li>
                                    <li>
                                        <a href="#">car <i class="la la-angle-down"></i></a>
                                        <ul class="dropdown-menu-item">
                                            <li><a href="car-grid.html">car grid</a></li>
                                            <li><a href="car-list.html">car list</a></li>
                                            <li><a href="car-sidebar.html">car sidebar </a></li>
                                            <li><a href="car-single.html">car details</a></li>
                                            <li><a href="car-booking.html">Car Booking</a></li>
                                            <li><a href="car-search-result.html">Car Search Result</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </nav>
                        </div><!-- end main-menu-content -->
                        <div class="nav-btn">
                            <a href="become-local-expert.html" class="theme-btn">Become Local Expert</a>
                        </div><!-- end nav-btn -->
                    </div><!-- end menu-wrapper -->
                </div><!-- end col-lg-12 -->
            </div><!-- end row -->
        </div><!-- end container-fluid -->
    </div><!-- end header-menu-wrapper -->
</header>