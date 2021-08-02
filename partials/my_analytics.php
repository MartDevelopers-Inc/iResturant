<?php
/*
 * Created on Mon Aug 02 2021
 *
 * The MIT License (MIT)
 * Copyright (c) 2021 Martdevelopers Inc
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
$email = $_SESSION['email'];
$ret = "SELECT * FROM  iResturant_Customer WHERE email = '$email' ";
$stmt = $mysqli->prepare($ret);
$stmt->execute(); //ok
$res = $stmt->get_result();
while ($customer = $res->fetch_object()) {
    $ret = "SELECT * FROM `iResturant_Currencies` WHERE status = 'Active'  ";
    $stmt = $mysqli->prepare($ret);
    $stmt->execute(); //ok
    $res = $stmt->get_result();
    while ($currency = $res->fetch_object()) {

        /* Rooms Reservations */
        $query = "SELECT COUNT(*)  FROM `iResturant_Room_Reservation` WHERE client_id = '$customer->id' ";
        $stmt = $mysqli->prepare($query);
        $stmt->execute();
        $stmt->bind_result($reservations);
        $stmt->fetch();
        $stmt->close();


        /* Resturant Orders */
        $query = "SELECT COUNT(*)  FROM `iResturant_Customer_Orders` WHERE customer_id = '$customer->id' ";
        $stmt = $mysqli->prepare($query);
        $stmt->execute();
        $stmt->bind_result($my_orders);
        $stmt->fetch();
        $stmt->close();


        /* My Spendings */
        $query = "SELECT SUM(amount)  
        FROM iResturant_Payments p INNER JOIN iResturant_Room_Reservation r ON p.reservation_code = r.code  
        WHERE r.client_id = '$customer->id' ";
        $stmt = $mysqli->prepare($query);
        $stmt->execute();
        $stmt->bind_result($payments);
        $stmt->fetch();
        $stmt->close();

        $reservations_payments = $currency->code . $payments;


        /* My Reservation Payments */
        $query = "SELECT SUM(amount)  
        FROM iResturant_Payments p INNER JOIN iResturant_Customer_Orders co ON co.code = p.order_code  
        WHERE co.customer_id = '$customer->id' ";
        $stmt = $mysqli->prepare($query);
        $stmt->execute();
        $stmt->bind_result($orders);
        $stmt->fetch();
        $stmt->close();

        $orders_payment = $currency->code . $orders;
    }
}
