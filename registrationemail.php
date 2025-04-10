<?php
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

require 'C:\xampp\htdocs\cakebakerysystem\PHPMailer\PHPMailer.php';
require 'C:\xampp\htdocs\cakebakerysystem\PHPMailer\SMTP.php';
require 'C:\xampp\htdocs\cakebakerysystem\PHPMailer\Exception.php';

session_start();

if (isset($_GET['email'])) {
    $email = $_GET['email'];

    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->SMTPAuth   = true;
        $mail->Host       = 'smtp.gmail.com';
        $mail->Username   = 'your email id';
        $mail->Password   = 'your password';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        $mail->setFrom('your email id', 'Cake Bakery');
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = 'Welcome to Cake Bakery!';
        $mail->Body    = "<h3>Thank you for registering with Cake Bakery!</h3><p>Your account has been created successfully.</p>";

        $mail->send();

        $_SESSION['message']    = "Registration successful! A confirmation email has been sent to your email address.";
        $_SESSION['alert_type'] = "success";

    } catch (Exception $e) {
        $_SESSION['message']    = "Registration successful but failed to send confirmation email. You can still login to your account.";
        $_SESSION['alert_type'] = "warning";
    }

    // Redirect to success.php where the alert will be shown
    header("Location: success.php");
    exit();
} else {
    $_SESSION['message']    = "Invalid access! Please try registering again.";
    $_SESSION['alert_type'] = "error";
    header("Location: success.php");
    exit();
}
