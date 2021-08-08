<?php
/*
 * Created on Mon Aug 09 2021
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
require_once('../config/checklogin.php');
require_once('../config/codeGen.php');
admin_check_login();



/* Delete Reveiew */
if (isset($_GET['delete_testimonial'])) {
    $id = $_GET['delete_testimonial'];
    $adn = 'DELETE FROM iResturant_Testimonials WHERE testimonial_id =?';
    $stmt = $mysqli->prepare($adn);
    $stmt->bind_param('s', $id);
    $stmt->execute();
    $stmt->close();
    if ($stmt) {
        $success = 'Deleted' && header('refresh:1; url=hrm_customers_testimonials');;
    } else {
        $info = 'Please Try Again Or Try Later';
    }
}

require_once('../partials/head.php');
?>

<body>
    <!-- Left Sidenav -->
    <?php require_once('../partials/my_sidebar.php'); ?>
    <!-- end left-sidenav-->


    <div class="page-wrapper">
        <!-- Top Bar Start -->
        <?php require_once('../partials/my_header.php'); ?>
        <!-- Top Bar End -->

        <!-- Page Content-->
        <div class="page-content">
            <div class="container-fluid">
                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <div class="row">
                                <div class="col">
                                    <h4 class="page-title">Testimonials</h4>
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                                        <li class="breadcrumb-item"><a href="dashboard">HRM</a></li>
                                        <li class="breadcrumb-item active">Reviews</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end page title end breadcrumb -->


                <div class="row">
                    <div class="col-lg-12 col-sm-12">

                        <div class="card">
                            <!--end card-header-->
                            <div class="card-body table-responsive">
                                <div class="">
                                    <table class="table dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th class="border-top-0">Customer Details</th>
                                                <th class="border-top-0">Review Details</th>
                                                <th class="border-top-0">Manage </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $ret = "SELECT * FROM iResturant_Testimonials t INNER JOIN iResturant_Customer c on c.id = t.testimonial_customer_id";
                                            $stmt = $mysqli->prepare($ret);
                                            $stmt->execute(); //ok
                                            $res = $stmt->get_result();
                                            while ($r = $res->fetch_object()) {
                                            ?>
                                                <tr>
                                                    <td>
                                                        Name : <?php echo $r->name; ?><br>
                                                        Email: <?php echo $r->email; ?><br>
                                                        Phone: <?php echo $r->phone; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo substr($r->testimonial_details, 0, 300); ?>...
                                                    </td>

                                                    <td>


                                                        <a href="#delete-<?php echo $r->testimonial_id; ?>" data-bs-toggle="modal" data-bs-target="#delete-<?php echo $r->testimonial_id; ?>" class="btn btn-sm btn-outline-danger">
                                                            <i data-feather="trash" class="align-self-center icon-xs ms-1"></i> Delete
                                                        </a>



                                                        <!-- Delete Room Category Modal -->
                                                        <div class="modal fade" id="delete-<?php echo $r->testimonial_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">CONFIRM</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                                                                    </div>
                                                                    <div class="modal-body text-center text-danger">
                                                                        <h4>Delete Review ?</h4>
                                                                        <button type="button" class="btn btn-soft-success" data-bs-dismiss="modal">No</button>
                                                                        <a href="hrm_customers_testimonials?delete_testimonial=<?php echo $r->testimonial_id; ?>" class="text-center btn btn-danger"> Delete </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- End Delete Modal -->
                                                    </td>
                                                </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <?php require_once('../partials/footer.php'); ?>
            <!--end footer-->
        </div>
        <!-- end page content -->
    </div>
    <!-- end page-wrapper -->
    <!-- jQuery  -->
    <?php require_once('../partials/scripts.php'); ?>

</body>

</html>