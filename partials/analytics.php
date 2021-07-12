<?php
/*
 * Created on Mon Jul 12 2021
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


/* Perform All System Analytics Here */


/* Load Default Currency */
$ret = "SELECT * FROM `iResturant_Currencies` WHERE status = 'Active'  ";
$stmt = $mysqli->prepare($ret);
$stmt->execute(); //ok
$res = $stmt->get_result();
while ($currency = $res->fetch_object()) {

    /* Rooms Revenue */
    $query = "SELECT SUM(amount)  FROM `iResturant_Payments`  WHERE type = 'Reservations'";
    $stmt = $mysqli->prepare($query);
    $stmt->execute();
    $stmt->bind_result($rooms_revenue);
    $stmt->fetch();
    $stmt->close();
    $rr = $currency->code . " " . $rooms_revenue;


    /* Hotel Sales Revenue */
    $query = "SELECT SUM(amount)  FROM `iResturant_Payments`  WHERE type = 'Resturant Sales'";
    $stmt = $mysqli->prepare($query);
    $stmt->execute();
    $stmt->bind_result($sales_revenue);
    $stmt->fetch();
    $stmt->close();
    $hsr = $currency->code . " " . $sales_revenue;

    /* Supplier Expenes */
    $query = "SELECT SUM(amount)  FROM `iResturant_Expenses` ";
    $stmt = $mysqli->prepare($query);
    $stmt->execute();
    $stmt->bind_result($supplier_expenses);
    $stmt->fetch();
    $stmt->close();
    $se = $currency->code . "" . $supplier_expenses;

    /* Payroll Expenses */
    $query = "SELECT SUM(amount)  FROM `iResturant_Payroll` ";
    $stmt = $mysqli->prepare($query);
    $stmt->execute();
    $stmt->bind_result($payroll_expenses);
    $stmt->fetch();
    $stmt->close();
    $pe = $currency->code . "" . $payroll_expenses;
}

/* Total Rooms */
$query = "SELECT COUNT(*)  FROM `iResturant_Room` ";
$stmt = $mysqli->prepare($query);
$stmt->execute();
$stmt->bind_result($tr);
$stmt->fetch();
$stmt->close();

/* Vacant Rooms */
$query = "SELECT COUNT(*)  FROM `iResturant_Room` WHERE status = 'Vacant' ";
$stmt = $mysqli->prepare($query);
$stmt->execute();
$stmt->bind_result($vr);
$stmt->fetch();
$stmt->close();

/* Reserved Rooms */
$query = "SELECT COUNT(*)  FROM `iResturant_Room` WHERE status = 'Reserved' ";
$stmt = $mysqli->prepare($query);
$stmt->execute();
$stmt->bind_result($resr);
$stmt->fetch();
$stmt->close();


/* Under Mantainance Rooms */
$query = "SELECT COUNT(*)  FROM `iResturant_Room` WHERE status = 'Under Repair' ";
$stmt = $mysqli->prepare($query);
$stmt->execute();
$stmt->bind_result($urr);
$stmt->fetch();
$stmt->close();

/* Staffs */
$query = "SELECT COUNT(*)  FROM `iResturant_Staff` ";
$stmt = $mysqli->prepare($query);
$stmt->execute();
$stmt->bind_result($sff);
$stmt->fetch();
$stmt->close();

/* Customers */
$query = "SELECT COUNT(*)  FROM `iResturant_Customer` ";
$stmt = $mysqli->prepare($query);
$stmt->execute();
$stmt->bind_result($cus);
$stmt->fetch();
$stmt->close();

/* Suppliers */
$query = "SELECT COUNT(*)  FROM `iResturant_Suppliers` ";
$stmt = $mysqli->prepare($query);
$stmt->execute();
$stmt->bind_result($sp);
$stmt->fetch();
$stmt->close();


/* Company Assets / Equipments */
$query = "SELECT SUM(how_many)  FROM `iResturant_Machines` ";
$stmt = $mysqli->prepare($query);
$stmt->execute();
$stmt->bind_result($ce);
$stmt->fetch();
$stmt->close();
