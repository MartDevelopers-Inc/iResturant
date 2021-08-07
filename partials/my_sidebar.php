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
                    <img src="../public/uploads/sys_logo/<?php echo $sys->logo; ?>" height="65" width="150">
                </span>
            </a>
        </div>
        <!--end logo-->
        <div class="menu-content h-100" data-simplebar>
            <ul class="metismenu left-sidenav-menu">
                <li>
                    <a href="my_dashboard"><i data-feather="home" class="align-self-center menu-icon"></i><span>Dashboard</span></a>
                </li>

                <li>
                    <a href="javascript: void(0);"> <i data-feather="user-check" class="align-self-center menu-icon"></i><span>Reservations</span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li class="nav-item"><a class="nav-link" href="my_reservations_manage"><i class="ti-control-record"></i>Manage</a></li>
                        <li class="nav-item"><a class="nav-link" href="my_reservations_payments"><i class="ti-control-record"></i>Payments</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);"> <i data-feather="file-plus" class="align-self-center menu-icon"></i><span>Orders </span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li class="nav-item"><a class="nav-link" href="my_order_customers"><i class="ti-control-record"></i>My Orders </a></li>
                        <li class="nav-item"><a class="nav-link" href="my_order_payments"><i class="ti-control-record"></i>Orders Payments </a></li>

                    </ul>
                </li>
                <li>
                    <a href="my_reviews"><i data-feather="message-square" class="align-self-center menu-icon"></i><span>Reviews</span></a>
                </li>

                <li>
                    <a href="logout"><i data-feather="log-out" class="align-self-center menu-icon"></i><span>End Session</span></a>
                </li>
            </ul>
        </div>
    </div>
<?php
} ?>