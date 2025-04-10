<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Include SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<body>

</body>
</html>

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

    if (isset($_GET['userid']) && isset($_GET['email'])) {
        $userid = intval($_GET['userid']);
        $email  = $_GET['email'];

        // Insert into deleted users log
        $stmt = $con->prepare("INSERT INTO tbl_deleted_users (user_id, email, deleted_at) VALUES (?, ?, NOW())");
        $stmt->bind_param('is', $userid, $email);

        if ($stmt->execute()) {
            $stmt->close();

            // Send email notification
            $mail = new PHPMailer(true);
            try {
                $mail->isSMTP();
                $mail->SMTPAuth   = true;
                $mail->Host       = 'smtp.gmail.com';
                $mail->Username   = 'your email id';
                $mail->Password   = 'your password';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port       = 587;

                $mail->setFrom('your email id');
                $mail->addAddress($email, 'User Notification');

                $mail->isHTML(true);
                $mail->Subject = 'Account Deletion Notification';
                $mail->Body    = "Dear customer, you have been blocked by the admin due to excessive order cancellations.";

                $mail->send();

                echo "<script>
                Swal.fire({
                    title: 'Email sent successfully!',
                    icon: 'success'
                }).then(function() {
                    window.location.href = 'user-detail.php';
                });
            </script>";
            } catch (Exception $e) {
                echo "<script>
                Swal.fire({
                    title: 'User deleted but email failed to send!',
                    icon: 'error'
                }).then(function() {
                    window.location.href = 'user-detail.php';
                });
            </script>";
            }
        } else {
            echo "<script>
            Swal.fire({
                title: 'Failed to record deletion!',
                icon: 'error'
            }).then(function() {
                window.location.href = 'user-detail.php';
            });
        </script>";
        }
    }
?>
