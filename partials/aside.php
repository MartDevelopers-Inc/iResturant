<?php
/*
 * Created on Sat Jul 10 2021
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
$ret = "SELECT * FROM `iResturant_System_Details`  ";
$stmt = $mysqli->prepare($ret);
$stmt->execute(); //ok
$res = $stmt->get_result();
while ($sys = $res->fetch_object()) {
?>
    <div class="left-sidenav">
        <!-- LOGO -->
        <div class="brand">
            <a href="dashboard" class="logo">
                <span>
                    <img src="../public/uploads/sys_logo/<?php echo $sys->logo; ?>" alt="logo-small" class="logo-sm">
                </span>
                <span>
                    <img src="../public/uploads/sys_logo/<?php echo $sys->logo; ?>" alt="logo-large" class="logo-lg logo-light">
                    <img src="../public/uploads/sys_logo/<?php echo $sys->logo; ?>" alt="logo-large" class="logo-lg logo-dark">
                </span>
            </a>
        </div>
        <!--end logo-->
        <div class="menu-content h-100" data-simplebar>
            <ul class="metismenu left-sidenav-menu">
                <li>
                    <a href="dashboard"><i data-feather="layers" class="align-self-center menu-icon"></i><span>Dashboard</span></a>
                </li>
                <li>
                    <a href="rooms"><i data-feather="layers" class="align-self-center menu-icon"></i><span>Rooms</span></a>
                </li>

                <li>
                    <a href="reservations"><i data-feather="layers" class="align-self-center menu-icon"></i><span>Widgets</span></a>
                </li>
                <li>
                    <a href="javascript: void(0);"> <i data-feather="home" class="align-self-center menu-icon"></i><span>Reservations</span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li class="nav-item"><a class="nav-link" href="reservations_manage"><i class="ti-control-record"></i>Manage</a></li>
                        <li class="nav-item"><a class="nav-link" href="reservations_payments"><i class="ti-control-record"></i>Payments</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);"><i data-feather="grid" class="align-self-center menu-icon"></i><span>Apps</span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li>
                            <a href="javascript: void(0);"><i class="ti-control-record"></i>Email <span class="menu-arrow left-has-menu"><i class="mdi mdi-chevron-right"></i></span></a>
                            <ul class="nav-second-level" aria-expanded="false">
                                <li><a href="apps-email-inbox.html">Inbox</a></li>
                                <li><a href="apps-email-read.html">Read Email</a></li>
                            </ul>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="apps-chat.html"><i class="ti-control-record"></i>Chat</a></li>
                        <li class="nav-item"><a class="nav-link" href="apps-contact-list.html"><i class="ti-control-record"></i>Contact List</a></li>
                        <li class="nav-item"><a class="nav-link" href="apps-calendar.html"><i class="ti-control-record"></i>Calendar</a></li>
                        <li class="nav-item"><a class="nav-link" href="apps-files.html"><i class="ti-control-record"></i>File Manager</a></li>
                        <li class="nav-item"><a class="nav-link" href="apps-invoice.html"><i class="ti-control-record"></i>Invoice</a></li>
                        <li class="nav-item"><a class="nav-link" href="apps-tasks.html"><i class="ti-control-record"></i>Tasks</a></li>
                        <li>
                            <a href="javascript: void(0);"><i class="ti-control-record"></i>Projects <span class="menu-arrow left-has-menu"><i class="mdi mdi-chevron-right"></i></span></a>
                            <ul class="nav-second-level" aria-expanded="false">
                                <li><a href="apps-project-overview.html">Overview</a></li>
                                <li><a href="apps-project-projects.html">Projects</a></li>
                                <li><a href="apps-project-board.html">Board</a></li>
                                <li><a href="apps-project-teams.html">Teams</a></li>
                                <li><a href="apps-project-files.html">Files</a></li>
                                <li><a href="apps-new-project.html">New Project</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript: void(0);"><i class="ti-control-record"></i>Ecommerce <span class="menu-arrow left-has-menu"><i class="mdi mdi-chevron-right"></i></span></a>
                            <ul class="nav-second-level" aria-expanded="false">
                                <li><a href="apps-ecommerce-products.html">Products</a></li>
                                <li><a href="apps-ecommerce-product-list.html">Product List</a></li>
                                <li><a href="apps-ecommerce-product-detail.html">Product Detail</a></li>
                                <li><a href="apps-ecommerce-cart.html">Cart</a></li>
                                <li><a href="apps-ecommerce-checkout.html">Checkout</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);"><i data-feather="lock" class="align-self-center menu-icon"></i><span>Authentication</span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li class="nav-item"><a class="nav-link" href="auth-login.html"><i class="ti-control-record"></i>Log in</a></li>
                        <li class="nav-item"><a class="nav-link" href="auth-register.html"><i class="ti-control-record"></i>Register</a></li>
                        <li class="nav-item"><a class="nav-link" href="auth-recover-pw.html"><i class="ti-control-record"></i>Recover Password</a></li>
                        <li class="nav-item"><a class="nav-link" href="auth-lock-screen.html"><i class="ti-control-record"></i>Lock Screen</a></li>
                        <li class="nav-item"><a class="nav-link" href="auth-404.html"><i class="ti-control-record"></i>Error 404</a></li>
                        <li class="nav-item"><a class="nav-link" href="auth-500.html"><i class="ti-control-record"></i>Error 500</a></li>
                    </ul>
                </li>

                <hr class="hr-dashed hr-menu">
                <li class="menu-label my-2">Components & Extra</li>

                <li>
                    <a href="javascript: void(0);"><i data-feather="box" class="align-self-center menu-icon"></i><span>UI Kit</span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li>
                            <a href="javascript: void(0);"><i class="ti-control-record"></i>UI Elements <span class="menu-arrow left-has-menu"><i class="mdi mdi-chevron-right"></i></span></a>
                            <ul class="nav-second-level" aria-expanded="false">
                                <li><a href="ui-alerts.html">Alerts</a></li>
                                <li><a href="ui-avatar.html">Avatar</a></li>
                                <li><a href="ui-buttons.html">Buttons</a></li>
                                <li><a href="ui-badges.html">Badges</a></li>
                                <li><a href="ui-cards.html">Cards</a></li>
                                <li><a href="ui-carousels.html">Carousels</a></li>
                                <li><a href="ui-check-radio.html"><span>Check & Radio</span></a></li>
                                <li><a href="ui-dropdowns.html">Dropdowns</a></li>
                                <li><a href="ui-grids.html">Grids</a></li>
                                <li><a href="ui-images.html">Images</a></li>
                                <li><a href="ui-list.html">List</a></li>
                                <li><a href="ui-modals.html">Modals</a></li>
                                <li><a href="ui-navs.html">Navs</a></li>
                                <li><a href="ui-navbar.html">Navbar</a></li>
                                <li><a href="ui-offcanvas.html">Offcanvas <span class="badge badge-soft-success ms-auto">New</span></a></li>
                                <li><a href="ui-paginations.html">Paginations</a></li>
                                <li><a href="ui-popover-tooltips.html">Popover & Tooltips</a></li>
                                <li><a href="ui-progress.html">Progress</a></li>
                                <li><a href="ui-spinners.html">Spinners</a></li>
                                <li><a href="ui-tabs-accordions.html">Tabs & Accordions</a></li>
                                <li><a href="ui-toasts.html">Toasts</a></li>
                                <li><a href="ui-typography.html">Typography</a></li>
                                <li><a href="ui-videos.html">Videos</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript: void(0);"><i class="ti-control-record"></i>Advanced UI <span class="menu-arrow left-has-menu"><i class="mdi mdi-chevron-right"></i></span></a>
                            <ul class="nav-second-level" aria-expanded="false">
                                <li><a href="advanced-animation.html">Animation</a></li>
                                <li><a href="advanced-clipboard.html">Clip Board</a></li>
                                <li><a href="advanced-highlight.html">Highlight</a></li>
                                <li><a href="advanced-idle-timer.html">Idle Timer</a></li>
                                <li><a href="advanced-kanban.html">Kanban</a></li>
                                <li><a href="advanced-lightbox.html">Lightbox</a></li>
                                <li><a href="advanced-nestable.html">Nestable List</a></li>
                                <li><a href="advanced-rangeslider.html">Range Slider</a></li>
                                <li><a href="advanced-ratings.html">Ratings</a></li>
                                <li><a href="advanced-ribbons.html">Ribbons</a></li>
                                <li><a href="advanced-session.html">Session Timeout</a></li>
                                <li><a href="advanced-sweetalerts.html">Sweet Alerts</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript: void(0);"><i class="ti-control-record"></i>Forms <span class="menu-arrow left-has-menu"><i class="mdi mdi-chevron-right"></i></span></a>
                            <ul class="nav-second-level" aria-expanded="false">
                                <li><a href="forms-advanced.html">Advance Elements</a></li>
                                <li><a href="forms-elements.html">Basic Elements</a></li>
                                <li><a href="forms-editors.html">Editors</a></li>
                                <li><a href="forms-uploads.html">File Upload</a></li>
                                <li><a href="forms-repeater.html">Repeater</a></li>
                                <li><a href="forms-validation.html">Validation</a></li>
                                <li><a href="forms-wizard.html">Wizard</a></li>
                                <li><a href="forms-x-editable.html">X Editable</a></li>

                            </ul>
                        </li>
                        <li>
                            <a href="javascript: void(0);"><i class="ti-control-record"></i>Charts <span class="menu-arrow left-has-menu"><i class="mdi mdi-chevron-right"></i></span></a>
                            <ul class="nav-second-level" aria-expanded="false">
                                <li><a href="charts-apex.html">Apex</a></li>
                                <li><a href="charts-chartjs.html">Chartjs</a></li>
                                <li><a href="charts-flot.html">Flot</a></li>
                                <li><a href="charts-morris.html">Morris</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript: void(0);"><i class="ti-control-record"></i>Tables <span class="menu-arrow left-has-menu"><i class="mdi mdi-chevron-right"></i></span></a>
                            <ul class="nav-second-level" aria-expanded="false">
                                <li><a href="tables-basic.html">Basic</a></li>
                                <li><a href="tables-datatable.html">Datatables</a></li>
                                <li><a href="tables-editable.html">Editable</a></li>
                                <li><a href="tables-responsive.html">Responsive</a></li>

                            </ul>
                        </li>
                        <li>
                            <a href="javascript: void(0);"><i class="ti-control-record"></i>Icons <span class="menu-arrow left-has-menu"><i class="mdi mdi-chevron-right"></i></span></a>
                            <ul class="nav-second-level" aria-expanded="false">

                                <li><a href="icons-dripicons.html">Dripicons</a></li>
                                <li><a href="icons-feather.html">Feather</a></li>
                                <li><a href="icons-fontawesome.html">Font awesome</a></li>
                                <li><a href="icons-materialdesign.html">Material Design</a></li>
                                <li><a href="icons-themify.html">Themify</a></li>
                                <li><a href="icons-typicons.html">Typicons</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript: void(0);"><i class="ti-control-record"></i>Maps <span class="menu-arrow left-has-menu"><i class="mdi mdi-chevron-right"></i></span></a>
                            <ul class="nav-second-level" aria-expanded="false">
                                <li><a href="maps-google.html">Google Maps</a></li>
                                <li><a href="maps-leaflet.html">Leaflet Maps</a></li>
                                <li><a href="maps-vector.html">Vector Maps</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript: void(0);"><i class="ti-control-record"></i>Email Template <span class="menu-arrow left-has-menu"><i class="mdi mdi-chevron-right"></i></span></a>
                            <ul class="nav-second-level" aria-expanded="false">
                                <li><a href="email-templates-alert.html">Alert Email</a></li>
                                <li><a href="email-templates-basic.html">Basic Action Email</a></li>
                                <li><a href="email-templates-billing.html">Billing Email</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="widgets.html"><i data-feather="layers" class="align-self-center menu-icon"></i><span>Widgets</span><span class="badge badge-soft-success menu-arrow">New</span></a>
                </li>

                <li>
                    <a href="javascript: void(0);"><i data-feather="file-plus" class="align-self-center menu-icon"></i><span>Pages</span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li class="nav-item"><a class="nav-link" href="pages-blogs.html"><i class="ti-control-record"></i>Blogs</a></li>
                        <li class="nav-item"><a class="nav-link" href="pages-faqs.html"><i class="ti-control-record"></i>FAQs</a></li>
                        <li class="nav-item"><a class="nav-link" href="pages-pricing.html"><i class="ti-control-record"></i>Pricing</a></li>
                        <li class="nav-item"><a class="nav-link" href="pages-profile.html"><i class="ti-control-record"></i>Profile</a></li>
                        <li class="nav-item"><a class="nav-link" href="pages-starter.html"><i class="ti-control-record"></i>Starter Page</a></li>
                        <li class="nav-item"><a class="nav-link" href="pages-timeline.html"><i class="ti-control-record"></i>Timeline</a></li>
                        <li class="nav-item"><a class="nav-link" href="pages-treeview.html"><i class="ti-control-record"></i>Treeview</a></li>
                    </ul>
                </li>
            </ul>

            <div class="update-msg text-center">
                <a href="javascript: void(0);" class="float-end close-btn text-muted" data-dismiss="update-msg" aria-label="Close" aria-hidden="true">
                    <i class="mdi mdi-close"></i>
                </a>
                <h5 class="mt-3">Mannat Themes</h5>
                <p class="mb-3">We Design and Develop Clean and High Quality Web Applications</p>
                <a href="javascript: void(0);" class="btn btn-outline-warning btn-sm">Upgrade your plan</a>
            </div>
        </div>
    </div>
<?php
} ?>