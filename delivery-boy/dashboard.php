<?php
session_start();
include('../includes/dbconnection.php');

if(!isset($_SESSION['delivery_boy_id'])) {
    header('location: ../delivery-boy-login.php');
    exit();
}

$delivery_boy_id = $_SESSION['delivery_boy_id'];
$query = mysqli_query($con, "SELECT * FROM tbldeliveryboys WHERE ID='$delivery_boy_id'");
$delivery_boy = mysqli_fetch_array($query);

// Remove this line as it's causing the first error
// echo $row['FirstName'] . ' ' . $row['LastName'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delivery Boy Dashboard</title>
    <link href="../admin/css/bootstrap.min.css" rel="stylesheet">
    <link href="../admin/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="../admin/css/style.css" rel="stylesheet">
</head>
<body>
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4 p-3 bg-light rounded shadow-sm">
            <h2 class="mb-0">Welcome, <?php echo $delivery_boy['Name']; ?></h2>
            <a href="logout.php" class="btn btn-danger">
                <i class="fa fa-sign-out"></i> Logout
            </a>
        </div>

        <?php
        // Get order counts - Keep this PHP block right after header
        $total_query = mysqli_query($con, "SELECT COUNT(*) AS total FROM tblorders WHERE DeliveryBoyId='$delivery_boy_id'");
        $total = mysqli_fetch_assoc($total_query)['total'];

        $prepared_query = mysqli_query($con, "SELECT COUNT(*) AS cnt FROM tblorderaddresses 
                                            WHERE OrderFinalStatus='Cake being Prepared' 
                                            AND Ordernumber IN (SELECT OrderNumber FROM tblorders WHERE DeliveryBoyId='$delivery_boy_id')");
        $prepared = mysqli_fetch_assoc($prepared_query)['cnt'];

        // Confirmed orders query (replaces transit)
        // Confirmed orders query - fix status name to match your database
        $confirmed_query = mysqli_query($con, "SELECT COUNT(*) AS cnt FROM tblorderaddresses 
                                             WHERE OrderFinalStatus='Order Confirmed' 
                                             AND Ordernumber IN (SELECT OrderNumber FROM tblorders WHERE DeliveryBoyId='$delivery_boy_id')");
        $pickup_query = mysqli_query($con, "SELECT COUNT(*) AS cnt FROM tblorderaddresses 
                                          WHERE OrderFinalStatus='Cake Pickup' 
                                          AND Ordernumber IN (SELECT OrderNumber FROM tblorders WHERE DeliveryBoyId='$delivery_boy_id')");
        $pickup = mysqli_fetch_assoc($pickup_query)['cnt'];
        if($confirmed_query) {
            $confirmed = mysqli_fetch_assoc($confirmed_query)['cnt'] ?? 0;
        } else {
            $confirmed = 0;
        }

        $delivered_query = mysqli_query($con, "SELECT COUNT(*) AS cnt FROM tblorderaddresses 
                                            WHERE OrderFinalStatus='Cake Delivered' 
                                            AND Ordernumber IN (SELECT OrderNumber FROM tblorders WHERE DeliveryBoyId='$delivery_boy_id')");
        $delivered = mysqli_fetch_assoc($delivered_query)['cnt'];
        ?>

        <div class="row mb-4">&nbsp; &nbsp;
            <!-- Total Orders -->
            <div  class="col-md-2">
                <div class="card text-white bg-primary mb-3">
                    <div style="background-color: #0B5ED7; color:white;" class="card-body">
                        <h5 class="card-title"><i class="fa fa-list-alt"></i> Total Orders</h5>
                        <h2 class="card-text"><?php echo $total; ?></h2>
                    </div>
                </div>
            </div> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;
            
            <!-- Order Confirmed -->
            <div class="col-md-2">
                <div class="card text-white bg-info mb-3">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fa fa-check-circle"></i> Confirmed</h5>
                        <h2 class="card-text"><?php echo $confirmed; ?></h2>
                    </div>
                </div>
            </div>
            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            <!-- Being Prepared -->
            <div class="col-md-2">
                <div class="card text-white bg-warning mb-3">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fa fa-clock-o"></i> Preparing</h5>
                        <h2 class="card-text"><?php echo $prepared; ?></h2>
                    </div>
                </div>
            </div>
            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            <!-- Pickup -->
            <div class="col-md-2">
                <div class="card text-white bg-secondary mb-3">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fa fa-motorcycle"></i> Pickup</h5>
                        <h2 class="card-text"><?php echo $pickup; ?></h2>
                    </div>
                </div>
            </div>
            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            <!-- Delivered -->
            <div class="col-md-2">
                <div class="card text-white bg-success mb-3">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fa fa-check-square"></i> Delivered</h5>
                        <h2 class="card-text"><?php echo $delivered; ?></h2>
                    </div>
                </div>
            </div>
        </div>

        <div  class="card shadow">
            <div  style="background-color:rgb(97, 160, 255) !important; color:white !important;" class="card-header bg-primary text-white">
                <h4  class="mb-0"> Assigned Orders</h4>
            </div>
            <div class="card-body">
                <table class="table table-striped table-hover table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th class="align-middle">Order ID</th>
                            <th class="align-middle">Customer Name</th>
                            <th class="align-middle">Order Date</th>
                            <th class="align-middle">Status</th>
                            <th class="text-center align-middle">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $orders_query = mysqli_query($con, "SELECT o.*, oa.OrderTime, oa.OrderFinalStatus, 
                            u.FirstName, u.LastName 
                            FROM tblorders o 
                            JOIN tblorderaddresses oa ON o.OrderNumber = oa.Ordernumber 
                            JOIN tbluser u ON oa.UserId = u.ID 
                            WHERE o.DeliveryBoyId='$delivery_boy_id' 
                            GROUP BY o.OrderNumber 
                            ORDER BY o.OrderNumber DESC");
                        
                        while($order = mysqli_fetch_array($orders_query)) { ?>
                        <tr>
                            <td class="align-middle">#<?php echo $order['OrderNumber']; ?></td>
                            <td class="align-middle"><?php echo $order['FirstName'] . ' ' . $order['LastName']; ?></td>
                            <td class="align-middle"><?php echo date('d M Y', strtotime($order['OrderTime'])); ?></td>
                            <td class="align-middle">
                                <span class="badge 
                                    <?php echo ($order['OrderFinalStatus'] == 'Delivered') ? 
                                        'badge-success' : 'badge-warning' ?>">
                                    <?php echo $order['OrderFinalStatus']; ?>
                                </span>
                            </td>
                            <td class="text-center align-middle">
                                <a href="view-order.php?orderid=<?php echo $order['OrderNumber']; ?>" 
                                   class="btn btn-info btn-md">
                                    <i class="fa fa-eye"></i> View
                                </a>
                                <a style="background-color: #0B5ED7; color:white;" href="update-order.php?orderid=<?php echo $order['OrderNumber']; ?>" 
                                   class="btn btn-primary btn-md">
                                    <i class="fa fa-edit"></i> Update
                                </a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="../admin/js/jquery-3.1.1.min.js"></script>
    <script src="../admin/js/bootstrap.min.js"></script>
</body>
</html>