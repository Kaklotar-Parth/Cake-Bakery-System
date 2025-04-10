<?php
session_start();
include_once 'includes/dbconnection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userid         = $_SESSION['fosuid'];
    $payment_id     = $_POST['payment_id'];
    $flatbldgnumber = $_POST['flatbldgnumber'];
    $street         = $_POST['streename'];
    $area           = $_POST['area'];
    $landmark       = $_POST['landmark'];
    $city           = $_POST['city'];

    // Generate order number
    $orderno = mt_rand(100000000, 999999999);

    // Update order status and insert payment details
    $query = "UPDATE tblorders SET OrderNumber='$orderno', IsOrderPlaced='1', PaymentID='$payment_id' WHERE UserId='$userid' AND IsOrderPlaced IS NULL;";
    $query .= "INSERT INTO tblorderaddresses (UserId, Ordernumber, Flatnobuldngno, StreetName, Area, Landmark, City)
               VALUES ('$userid', '$orderno', '$flatbldgnumber', '$street', '$area', '$landmark', '$city');";

    if (mysqli_multi_query($con, $query)) {
        echo "success";
    } else {
        echo "error";
    }
}
