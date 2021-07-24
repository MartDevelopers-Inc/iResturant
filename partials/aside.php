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
            </a>
        </div>
        <!--end logo-->
        <div class="menu-content h-100" data-simplebar>
            <ul class="metismenu left-sidenav-menu">
                <li>
                    <a href="dashboard"><i data-feather="home" class="align-self-center menu-icon"></i><span>Dashboard</span></a>
                </li>

                <li>
                    <a href="javascript: void(0);"> <i data-feather="activity" class="align-self-center menu-icon"></i><span>Rooms</span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li class="nav-item"><a class="nav-link" href="room_categories"><i class="ti-control-record"></i>Room Categories</a></li>
                        <li class="nav-item"><a class="nav-link" href="rooms"><i class="ti-control-record"></i>Rooms</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);"> <i data-feather="user-check" class="align-self-center menu-icon"></i><span>Reservations</span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li class="nav-item"><a class="nav-link" href="reservations_manage"><i class="ti-control-record"></i>Manage</a></li>
                        <li class="nav-item"><a class="nav-link" href="reservations_payments"><i class="ti-control-record"></i>Payments</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);"> <i data-feather="layers" class="align-self-center menu-icon"></i><span>Resturant Management</span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li class="nav-item"><a class="nav-link" href="resturant_meals"><i class="ti-control-record"></i>Meals Categories </a></li>
                        <li class="nav-item"><a class="nav-link" href="resturant_menus"><i class="ti-control-record"></i>Menus</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);"> <i data-feather="users" class="align-self-center menu-icon"></i><span>HRM</span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li class="nav-item"><a class="nav-link" href="hrm_staffs"><i class="ti-control-record"></i>Staffs </a></li>
                        <li class="nav-item"><a class="nav-link" href="hrm_payrolls"><i class="ti-control-record"></i>Payrolls </a></li>
                        <li class="nav-item"><a class="nav-link" href="hrm_suppliers"><i class="ti-control-record"></i>Suppliers</a></li>
                        <li class="nav-item"><a class="nav-link" href="hrm_customers"><i class="ti-control-record"></i>Customers</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);"> <i data-feather="file-plus" class="align-self-center menu-icon"></i><span>Orders Engine</span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li class="nav-item"><a class="nav-link" href="order_customers"><i class="ti-control-record"></i>Customer Orders </a></li>
                        <li class="nav-item"><a class="nav-link" href="order_resturants"><i class="ti-control-record"></i>Resturant Orders </a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);"> <i data-feather="check" class="align-self-center menu-icon"></i><span>Equipments</span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li class="nav-item"><a class="nav-link" href="inventory_assets"><i class="ti-control-record"></i>Manage </a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);"> <i data-feather="file" class="align-self-center menu-icon"></i><span>Reports</span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li class="nav-item"><a class="nav-link" href="reports_rooms"><i class="ti-control-record"></i>Rooms </a></li>
                        <li class="nav-item"><a class="nav-link" href="reports_reservations"><i class="ti-control-record"></i>Reservations</a></li>
                        <li class="nav-item"><a class="nav-link" href="reports_revenue"><i class="ti-control-record"></i>Revenue</a></li>
                        <li class="nav-item"><a class="nav-link" href="reports_menus"><i class="ti-control-record"></i>Menus</a></li>
                        <li class="nav-item"><a class="nav-link" href="reports_customer_orders"><i class="ti-control-record"></i>Customer Orders</a></li>
                        <li class="nav-item"><a class="nav-link" href="reports_suppliers"><i class="ti-control-record"></i>Suppliers</a></li>
                        <li class="nav-item"><a class="nav-link" href="reports_staffs"><i class="ti-control-record"></i>Staffs</a></li>
                        <li class="nav-item"><a class="nav-link" href="reports_equipments"><i class="ti-control-record"></i>Equipments</a></li>
                        <li class="nav-item"><a class="nav-link" href="reports_resturant_orders"><i class="ti-control-record"></i>Resturant Orders</a></li>

                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);"> <i data-feather="settings" class="align-self-center menu-icon"></i><span>System Settings</span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li class="nav-item"><a class="nav-link" href="settings_currency"><i class="ti-control-record"></i>Currencies </a></li>
                        <li class="nav-item"><a class="nav-link" href="settings_landing_pages"><i class="ti-control-record"></i>Landing Pages </a></li>
                        <li class="nav-item"><a class="nav-link" href="settings_mailer"><i class="ti-control-record"></i>Mailer Settings </a></li>
                    </ul>
                </li>
                <li>
                    <a href="logout"><i data-feather="log-out" class="align-self-center menu-icon"></i><span>End Session</span></a>
                </li>
            </ul>
        </div>
    </div>
<?php
} ?>