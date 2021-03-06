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

$id = $_SESSION['number'];

$ret = "SELECT * FROM `iResturant_Staff` WHERE number = '$id'  ";
$stmt = $mysqli->prepare($ret);
$stmt->execute(); //ok
$res = $stmt->get_result();
while ($logged_in_user = $res->fetch_object()) {
    $user_id = $logged_in_user->id;
    /* Count Notifications */
    $query = "SELECT COUNT(*)  FROM `iResturant_Notification`  WHERE user_id = '$user_id' AND status = 'Unread'";
    $stmt = $mysqli->prepare($query);
    $stmt->execute();
    $stmt->bind_result($notification_count);
    $stmt->fetch();
    $stmt->close();

    /* Load Default Profile Picture */
    if ($logged_in_user->passport == '') {
        $dir = '../public/uploads/user_images/no-profile.png';
    } else {
        $dir = "../public/uploads/user_images/$logged_in_user->passport";
    }

?>
    <div class="topbar">
        <!-- Navbar -->
        <nav class="navbar-custom">
            <ul class="list-unstyled topbar-nav float-end mb-0">

                <li class="dropdown notification-list">
                    <a class="nav-link dropdown-toggle arrow-none waves-light waves-effect" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <i data-feather="bell" class="align-self-center topbar-icon"></i>
                        <span class="badge bg-danger rounded-pill noti-icon-badge"><?php echo $notification_count; ?></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-lg pt-0">

                        <h6 class="dropdown-item-text font-15 m-0 py-3 border-bottom d-flex justify-content-between align-items-center">
                            Notifications <span class="badge bg-primary rounded-pill"><?php echo $notification_count; ?></span>
                        </h6>
                        <div class="notification-menu" data-simplebar>
                            <?php
                            $ret = "SELECT * FROM `iResturant_Notification` WHERE user_id = '$user_id'";
                            $stmt = $mysqli->prepare($ret);
                            $stmt->execute(); //ok
                            $res = $stmt->get_result();
                            while ($notification = $res->fetch_object()) {
                            ?>
                                <!-- item-->
                                <a href="staff_notifications" class="dropdown-item py-3">
                                    <div class="media">
                                        <div class="avatar-md bg-soft-primary">
                                            <i data-feather="<?php echo $notification->icon; ?>" class="align-self-center icon-xs"></i>
                                        </div>
                                        <div class="media-body align-self-center ms-2 ">
                                            <h6 class="my-0 fw-normal text-dark "> <?php echo $notification->title; ?></h6>
                                            <small class="text-muted mb-0"> <?php echo substr($notification->details, 0, 35); ?>...</small>
                                            <small class="float-end text-muted ps-2"><?php echo date('d-M-Y g:ia', strtotime($notification->created_at)); ?></small>
                                        </div>
                                        <!--end media-body-->
                                    </div>
                                    <!--end media-->
                                </a>
                            <?php
                            } ?>
                            <!--end-item-->

                            <!--end-item-->
                        </div>
                        <!-- All-->
                        <a href="staff_notifications" class="dropdown-item text-center text-primary">
                            View all <i class="fi-arrow-right"></i>
                        </a>
                    </div>
                </li>

                <li class="dropdown">
                    <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <span class="ms-1 nav-user-name hidden-sm">Hello <?php echo substr($logged_in_user->name, 0, 50); ?>...</span>
                        <img src="<?php echo $dir; ?>" alt="profile-user" class="rounded-circle thumb-xs" />
                    </a>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item" href="staff_settings"><i data-feather="settings" class="align-self-center icon-xs icon-dual me-1"></i> Settings</a>
                        <div class="dropdown-divider mb-0"></div>
                        <a class="dropdown-item" href="logout"><i data-feather="power" class="align-self-center icon-xs icon-dual me-1"></i> Logout</a>
                    </div>
                </li>
            </ul>
            <!--end topbar-nav-->

            <ul class="list-unstyled topbar-nav mb-0">
                <li>
                    <button class="nav-link button-menu-mobile">
                        <i data-feather="menu" class="align-self-center topbar-icon"></i>
                    </button>
                </li>

            </ul>
        </nav>
        <!-- end navbar-->
    </div>
<?php
} ?>