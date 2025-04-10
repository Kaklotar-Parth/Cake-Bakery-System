<?php
    session_start();

    // Enable error reporting
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    // Database connection
    include 'includes/dbconnection.php';

    // Include PHPMailer
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;

    require 'C:\xampp\htdocs\new cake\cake\PHPMailer\PHPMailer.php';
    require 'C:\xampp\htdocs\new cake\cake\PHPMailer\SMTP.php';
    require 'C:\xampp\htdocs\new cake\cake\PHPMailer\Exception.php';

    if (isset($_POST['submit'])) {
        // Ensure database connection exists
        if (! $con) {
            die("Database connection failed: " . mysqli_connect_error());
        }

        $orderid     = mysqli_real_escape_string($con, $_GET['oid']);
        $remark      = mysqli_real_escape_string($con, $_POST['restremark']);
        $ressta      = "Order Cancelled";
        $canclbyuser = 1;

        // Insert cancellation details into tblfoodtracking
        $query1 = mysqli_query($con, "INSERT INTO tblfoodtracking (OrderId, remark, status, OrderCanclledByUser) VALUES ('$orderid', '$remark', '$ressta', '$canclbyuser')");

        // Update order status in tblorderaddresses
        $query2 = mysqli_query($con, "UPDATE tblorderaddresses SET OrderFinalStatus='$ressta' WHERE Ordernumber='$orderid'");

        if ($query1 && $query2) {
            $msg = "Order has been cancelled and admin has been notified.";

            // Send email notification to admin
            $mail = new PHPMailer(true);
            try {
                $admin_email = "kaklotarparth2244@gmail.com"; // Change to admin email

                $mail->isSMTP();
                $mail->SMTPAuth   = true;
                $mail->Host       = 'smtp.gmail.com';
                $mail->Username   = 'kaklotarparth2244@gmail.com';
                $mail->Password   = 'dakiwwbrnespwvhc';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port       = 587;

                // Email Headers
                $mail->setFrom('kaklotarparth2244@gmail.com', 'Order Notification');
                $mail->addAddress($admin_email);

                // Email Content
                $mail->isHTML(true);
                $mail->Subject = "Order Cancellation Notification - Order #$orderid";
                $mail->Body    = "<h3>Order #$orderid has been cancelled by the user.</h3>
                              <p><strong>Reason: $remark </strong></p>
                              <p><strong>Please take necessary actions. </strong></p>";

                $mail->send();
            } catch (Exception $e) {
                echo "Order updated but email failed: " . $mail->ErrorInfo;
            }
        } else {
            echo "Something went wrong. Please try again.";
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Order Cancellation</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .container { margin: 50px; max-width: 600px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table, th, td { border: 1px solid black; padding: 10px; text-align: center; }
        th { background-color: #f2f2f2; }
        .btn { padding: 10px 15px; background-color: #ff0000; color: white; border: none; cursor: pointer; }
        .btn:hover { background-color: #cc0000; }
    </style>
</head>
<body>

<div class="container">
    <?php
        $orderid = isset($_GET['oid']) ? mysqli_real_escape_string($con, $_GET['oid']) : '';

        if (! empty($orderid)) {
            $query  = mysqli_query($con, "SELECT Ordernumber, OrderFinalStatus FROM tblorderaddresses WHERE Ordernumber='$orderid'");
            $row    = mysqli_fetch_array($query);
            $status = $row['OrderFinalStatus'];
        } else {
            $status = "Invalid Order ID";
        }
    ?>

    <h2>Cancel Order #<?php echo htmlspecialchars($orderid); ?></h2>

    <table>
        <tr>
            <th>Order Number</th>
            <th>Current Status</th>
        </tr>
        <tr>
            <td><?php echo htmlspecialchars($orderid); ?></td>
            <td><?php echo($status == "") ? "Waiting for confirmation" : $status; ?></td>
        </tr>
    </table>

    <?php if ($status == "" || $status == "Order Accept") {?>
        <form method="post">
            <table>
                <tr>
                    <th>Reason for Cancellation</th>
                    <td><textarea name="restremark" rows="4" cols="50" required></textarea></td>
                </tr>
                <tr>
                    <td colspan="2"><button type="submit" name="submit" class="btn">Cancel Order</button></td>
                </tr>
            </table>
        </form>
    <?php } else {?>
<?php if ($status == 'Order Cancelled') {?>
            <p style="color:red; font-size:20px;">Order Cancelled</p>
        <?php } else {?>
            <p style="color:red; font-size:20px;">You can't cancel this order. It is on the way or already delivered.</p>
        <?php }?>
<?php }?>
</div>

</body>
</html>
