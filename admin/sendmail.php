<?php
// Database connection
include 'includes/dbconnection.php';

// Include PHPMailer
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require 'C:\xampp\htdocs\cakebakerysystem\PHPMailer\PHPMailer.php';
require 'C:\xampp\htdocs\cakebakerysystem\PHPMailer\SMTP.php';
require 'C:\xampp\htdocs\cakebakerysystem\PHPMailer\Exception.php';

$orderid = $_GET['orderid'];
$status  = $_GET['status'];
$remark  = $_GET['remark'];

// Fetch user email, price, and delivery details
$result = mysqli_query($con, "SELECT
    tbluser.Email,
    tblorderaddresses.Flatnobuldngno,
    tblorderaddresses.StreetName,
    tblorderaddresses.Area,
    tblorderaddresses.Landmark,
    tblorderaddresses.City,
    tblorders.Price
    FROM tblorderaddresses
    JOIN tbluser ON tbluser.ID = tblorderaddresses.UserId
    JOIN tblorders ON tblorders.Ordernumber = tblorderaddresses.Ordernumber
    WHERE tblorderaddresses.Ordernumber='$orderid'");

$row = mysqli_fetch_array($result);

if (! $row) {
    echo "<script>alert('Order not found!'); window.location.href = 'viewcakeorder.php';</script>";
    exit();
}

$userEmail = $row['Email'];
$price     = $row['Price']; // Fetching the price from the database

// Construct the full delivery address
$address = "{$row['Flatnobuldngno']}, {$row['StreetName']}, {$row['Area']},
            Near {$row['Landmark']}, {$row['City']}";

$deliveryAgent = "Mehul Sondagar";
$agentContact  = "9023771156";
$awbNumber     = "$orderid";                       // Using Order ID as AWB Number
$orderValue    = "₹" . number_format($price, 2); // Formatting price

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'your email id';
    $mail->Password   = 'your password';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    $mail->setFrom('your email id', 'Cake Bakery');
    $mail->addAddress($userEmail);
    $mail->isHTML(true);
    $mail->Subject = "Your Order Update - Order #$orderid";
    $mail->Body    = "
        <p><b>Greetings from Cake Bakery!</b></p>
        <p>Your <b>Order ID: #$orderid</b> is out for delivery.</p>
        <p><b>Order Status:</b> $status</p>
        <p><b>Remark:</b> $remark</p>
        <p><b>Delivery Address:</b> $address</p>
        <p><b>Order Value:</b> $orderValue (Paid)</p>
        <p><b>Best Regards,</b><br>Cake Bakery</p>
    ";

    $mail->send();

    // JavaScript Alert with SweetAlert and Redirect with Dynamic Order ID
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
    echo "<script>
        window.onload = function() {
            Swal.fire({
                title: 'Email Sent!',
                text: 'Email has been sent successfully.',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'viewcakeorder.php?orderid=$orderid';
                }
            });
        }
    </script>";

} catch (Exception $e) {
    // Show error with SweetAlert
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
    echo "<script>
        window.onload = function() {
            Swal.fire({
                title: 'Error!',
                text: 'Email could not be sent. Mailer Error: {$mail->ErrorInfo}',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        }
    </script>";
}
