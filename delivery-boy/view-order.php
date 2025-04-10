<?php
session_start();
include('../includes/dbconnection.php');

if(!isset($_SESSION['delivery_boy_id'])) {
    header('location: ../delivery-boy-login.php');
    exit();
}

$delivery_boy_id = $_SESSION['delivery_boy_id'];
$orderid = $_GET['orderid'];

// Get order details
$order_query = mysqli_query($con, "SELECT o.*, oa.*, u.FirstName, u.LastName, u.MobileNumber, u.Email 
    FROM tblorders o 
    JOIN tblorderaddresses oa ON o.OrderNumber = oa.Ordernumber 
    JOIN tbluser u ON oa.UserId = u.ID 
    WHERE o.OrderNumber='$orderid' AND o.DeliveryBoyId='$delivery_boy_id'
    LIMIT 1");
$order_details = mysqli_fetch_array($order_query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Order Details</title>
    <link href="../admin/css/bootstrap.min.css" rel="stylesheet">
    <link href="../admin/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="../admin/css/style.css" rel="stylesheet">
</head>
<body>
    <div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4 p-3 bg-light rounded shadow-sm">
            <div class="col-md-12">
                <h2>Order Details #<?php echo $orderid; ?></h2>
                <a style="background-color:rgb(84, 84, 84); color:white;" href="dashboard.php" class="btn btn-primary float-right">Back to Dashboard</a>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Customer Information</h4>
                    </div>
                    <div class="card-body">
                        <p><strong>Name:</strong> <?php echo $order_details['FirstName'].' '.$order_details['LastName']; ?></p>
                        <p><strong>Phone:</strong> <?php echo $order_details['MobileNumber']; ?></p>
                        <p><strong>Email:</strong> <?php echo $order_details['Email']; ?></p>
                        <p><strong>Delivery Address:</strong><br>
                            <?php echo $order_details['Flatnobuldngno'].', '.$order_details['StreetName']; ?><br>
                            <?php echo $order_details['Area'].', '.$order_details['Landmark']; ?><br>
                            <?php echo $order_details['City']; ?>
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Order Information</h4>
                    </div>
                    <div class="card-body">
                        <p><strong>Order Date:</strong> <?php echo $order_details['OrderTime']; ?></p>
                        <p><strong>Status:</strong> <?php echo $order_details['OrderFinalStatus']; ?></p>
                        <p><strong>Payment Method:</strong> <?php echo $order_details['CashonDelivery']; ?></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Order Items</h4>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Weight</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $items_query = mysqli_query($con, "SELECT f.ItemName, o.Weight, o.Price 
                                    FROM tblorders o 
                                    JOIN tblfood f ON o.FoodId = f.ID 
                                    WHERE o.OrderNumber='$orderid'");
                                $total = 0;
                                while($item = mysqli_fetch_array($items_query)) {
                                    $total += $item['Price'];
                                ?>
                                <tr>
                                    <td><?php echo $item['ItemName']; ?></td>
                                    <td><?php echo $item['Weight']; ?></td>
                                    <td>$<?php echo $item['Price']; ?></td>
                                </tr>
                                <?php } ?>
                                <tr>
                                    <td colspan="2" class="text-right"><strong>Total:</strong></td>
                                    <td><strong>Rs.<?php echo $total; ?></strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../admin/js/jquery-3.1.1.min.js"></script>
    <script src="../admin/js/bootstrap.min.js"></script>
</body>
</html>