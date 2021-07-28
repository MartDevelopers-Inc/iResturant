<?php
/*
 * Created on Wed Jul 14 2021
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
include('../config/pdoconfig.php');

/* Get Room Category ID */
if (!empty($_POST["RoomCategoryName"])) {
    $id = $_POST['RoomCategoryName'];
    $stmt = $DB_con->prepare("SELECT * FROM iResturant_Room_Category WHERE name = :id");
    $stmt->execute(array(':id' => $id));
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo htmlentities($row['id']);
    }
}

/* Get Room Details - Room ID */
if (!empty($_POST["RoomNumber"])) {
    $id = $_POST['RoomNumber'];
    $stmt = $DB_con->prepare("SELECT * FROM iResturant_Room WHERE number = :id");
    $stmt->execute(array(':id' => $id));
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo htmlentities($row['id']);
    }
}

/* Get Room Details - Room Cost */
if (!empty($_POST["RoomID"])) {
    $id = $_POST['RoomID'];
    $stmt = $DB_con->prepare("SELECT * FROM iResturant_Room WHERE number = :id");
    $stmt->execute(array(':id' => $id));
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo htmlentities($row['price']);
    }
}

/* Get Client Details - */
if (!empty($_POST["ClientPhone"])) {
    $id = $_POST['ClientPhone'];
    $stmt = $DB_con->prepare("SELECT * FROM iResturant_Customer WHERE phone = :id");
    $stmt->execute(array(':id' => $id));
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo htmlentities($row['id']);
    }
}

if (!empty($_POST["ClientID"])) {
    $id = $_POST['ClientID'];
    $stmt = $DB_con->prepare("SELECT * FROM iResturant_Customer WHERE phone = :id");
    $stmt->execute(array(':id' => $id));
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo htmlentities($row['email']);
    }
}

if (!empty($_POST["ClientEmail"])) {
    $id = $_POST['ClientEmail'];
    $stmt = $DB_con->prepare("SELECT * FROM iResturant_Customer WHERE phone = :id");
    $stmt->execute(array(':id' => $id));
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo htmlentities($row['name']);
    }
}


/* Get Meal Category ID  */
if (!empty($_POST["MealCategoryName"])) {
    $id = $_POST['MealCategoryName'];
    $stmt = $DB_con->prepare("SELECT * FROM iResturant_Meal_Category WHERE name = :id");
    $stmt->execute(array(':id' => $id));
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo htmlentities($row['id']);
    }
}


/* Get Staff ID */
if (!empty($_POST["StaffNumber"])) {
    $id = $_POST['StaffNumber'];
    $stmt = $DB_con->prepare("SELECT * FROM iResturant_Staff WHERE number = :id");
    $stmt->execute(array(':id' => $id));
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo htmlentities($row['id']);
    }
}

/* Get Staff Name */
if (!empty($_POST["StaffId"])) {
    $id = $_POST['StaffId'];
    $stmt = $DB_con->prepare("SELECT * FROM iResturant_Staff WHERE number = :id");
    $stmt->execute(array(':id' => $id));
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo htmlentities($row['name']);
    }
}

/* Get Staff Email */
if (!empty($_POST["StaffName"])) {
    $id = $_POST['StaffName'];
    $stmt = $DB_con->prepare("SELECT * FROM iResturant_Staff WHERE number = :id");
    $stmt->execute(array(':id' => $id));
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo htmlentities($row['email']);
    }
}

/* Get Staff Phone NUmber */
if (!empty($_POST["StaffEmail"])) {
    $id = $_POST['StaffEmail'];
    $stmt = $DB_con->prepare("SELECT * FROM iResturant_Staff WHERE number = :id");
    $stmt->execute(array(':id' => $id));
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo htmlentities($row['phone']);
    }
}

/* Get Meal Price */
if (!empty($_POST["MealID"])) {
    $id = $_POST['MealID'];
    $stmt = $DB_con->prepare("SELECT * FROM iResturant_Menu WHERE meal_id = :id");
    $stmt->execute(array(':id' => $id));
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo htmlentities($row['meal_price']);
    }
}
