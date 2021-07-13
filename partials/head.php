<?php
/*
 * Created on Fri Jul 09 2021
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


/* Load System COnfigurations And Settings */
$ret = "SELECT * FROM `iResturant_System_Details`  ";
$stmt = $mysqli->prepare($ret);
$stmt->execute(); //ok
$res = $stmt->get_result();
while ($sys = $res->fetch_object()) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8" />
        <title><?php echo $sys->name . " - " . $sys->tagline; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta content="<?php echo $sys->name . "-" . $sys->tagline; ?>" name="description" />
        <meta content="MartDevelopers Inc" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="../public/uploads/sys_logo/<?php echo $sys->logo; ?>">
        <!-- Bootstrap CSS -->
        <link href="../public/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- Icons CSS -->
        <link href="../public/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- Application CSS -->
        <link href="../public/css/app.min.css" rel="stylesheet" type="text/css" />
        <!-- IziAlerts -->
        <link href="../public/plugins/iziToast/iziToast.min.css" rel="stylesheet" type="text/css">
        <!-- Mentis Menu -->
        <link href="../public/css/metisMenu.min.css" rel="stylesheet" type="text/css" />
        <!-- Date Range Picker -->
        <link href="../public/plugins/daterangepicker/daterangepicker.css" rel="stylesheet" type="text/css" />
        <!-- Vector Map  -->
        <link href="../public/plugins/jvectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet">
        <!-- Data Table Plug In Css -->
        <!-- DataTables -->
        <link href="../public/plugins/datatables/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
        <link href="../public/plugins/datatables/buttons.bootstrap5.min.css" rel="stylesheet" type="text/css" />
        <!-- Responsive datatable examples -->
        <link href="../public/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    </head>
<?php
} ?>