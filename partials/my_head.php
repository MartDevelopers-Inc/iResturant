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
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <meta name="author" content="TechyDevs">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title><?php echo $sys->system_name . " - " . $sys->tagline; ?></title>
        <!-- Favicon -->
        <link rel="shortcut icon" href="../public/uploads/sys_logo/<?php echo $sys->logo; ?>">
        <meta content="<?php echo $sys->system_name . "-" . $sys->tagline; ?>" name="description" />


        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css2bff7.css?family=Roboto:wght@100;300;400;500;700;900&amp;display=swap" rel="stylesheet">

        <!-- Template CSS Files -->
        <link rel="stylesheet" href="../partials/css/bootstrap.min.css">
        <link rel="stylesheet" href="../partials/css/bootstrap-select.min.css">
        <link rel="stylesheet" href="../partials/css/line-awesome.css">
        <link rel="stylesheet" href="../partials/css/owl.carousel.min.css">
        <link rel="stylesheet" href="../partials/css/owl.theme.default.min.css">
        <link rel="stylesheet" href="../partials/css/jquery.fancybox.min.css">
        <link rel="stylesheet" href="../partials/css/daterangepicker.css">
        <link rel="stylesheet" href="../partials/css/animate.min.css">
        <link rel="stylesheet" href="../partials/css/animated-headline.css">
        <link rel="stylesheet" href="../partials/css/jquery-ui.css">
        <link rel="stylesheet" href="../partials/css/flag-icon.min.css">
        <link rel="stylesheet" href="../partials/css/style.css">
    </head>
<?php } ?>