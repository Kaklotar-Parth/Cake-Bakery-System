<?php
session_start();
include('includes/dbconnection.php');
include('includes/checklogin.php');
check_login();

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = mysqli_query($con, "SELECT * FROM tbldeliveryboys WHERE ID='$id'");
    $delivery_boy = mysqli_fetch_array($query);
    
    // Get assigned orders
    // Modify the orders query to include customer name and status from related tables
    $orders_query = mysqli_query($con, "SELECT o.OrderNumber, o.OrderDate, 
                                    u.FirstName, u.LastName, 
                                    oa.OrderFinalStatus AS Status
                                    FROM tblorders o
                                    JOIN tblorderaddresses oa ON o.OrderNumber = oa.Ordernumber
                                    JOIN tbluser u ON oa.UserId = u.ID
                                    WHERE o.DeliveryBoyId='$id' 
                                    ORDER BY o.OrderDate DESC");
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Delivery Boy Details</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="css/plugins/dataTables/datatables.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
    <div id="wrapper">
        <?php include('includes/leftbar.php');?>
        <div id="page-wrapper" class="gray-bg">
            <?php include('includes/header.php');?>
            
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Delivery Boy Details</h2>
                </div>
            </div>

            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox">
                            <div class="ibox-content">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group row align-items-center">
                                            <div class="col-4"><label><b>Name:</b></label></div>
                                            <div class="col-8"><p class="form-control-static"><?php echo $delivery_boy['Name']; ?></p></div>
                                        </div>
                                        <div class="form-group row align-items-center">
                                            <div class="col-4"><label><b>Email:</b></label></div>
                                            <div class="col-8"><p class="form-control-static"><?php echo $delivery_boy['Email']; ?></p></div>
                                        </div>
                                        <div class="form-group row align-items-center">
                                            <div class="col-4"><label><b>Phone:</b></label></div>
                                            <div class="col-8"><p class="form-control-static"><?php echo $delivery_boy['Phone']; ?></p></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group row align-items-center">
                                            <div class="col-4"><label><b>Address:</b></label></div>
                                            <div class="col-8"><p class="form-control-static"><?php echo $delivery_boy['Address']; ?></p></div>
                                        </div>
                                        <div class="form-group row align-items-center">
                                            <div class="col-4"><label><b>Status:</b></label></div>
                                            <div class="col-8">
                                                <p class="form-control-static">
                                                    <span style="background-color: #0B5ED7; color:white;" class="badge <?php echo $delivery_boy['Status'] == 'Approved' ? 'badge-primary' : 'badge-danger'; ?>">
                                                        <?php echo $delivery_boy['Status']; ?>
                                                    </span>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="form-group row align-items-center">
                                            <div class="col-4"><label><b>Registration Date:</b></label></div>
                                            <div class="col-8"><p class="form-control-static"><?php echo date('d-m-Y', strtotime($delivery_boy['RegDate'])); ?></p></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row m-t-lg">
                                    <div class="col-lg-12">
                                        <div class="ibox">
                                            <div class="ibox-title">
                                                <h5>Assigned Orders</h5>
                                            </div>
                                            <div class="ibox-content">
                                                <table class="table table-bordered dataTables-example">
                                                    <thead>
                                                        <tr>
                                                            <th>Order #</th>
                                                            <th>Customer Name</th>
                                                            <th>Order Date</th>
                                                            <th>Status</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php while($order = mysqli_fetch_array($orders_query)) { ?>
                                                        <tr>
                                                            <td><?php echo $order['OrderNumber']; ?></td>
                                                            <td><?php echo $order['FirstName'] . ' ' . $order['LastName']; ?></td>
                                                            <td><?php echo date('d-m-Y', strtotime($order['OrderDate'])); ?></td>
                                                            <td>
                                                                <span class="badge <?php echo $order['Status'] == 'Delivered' ? 'badge-primary' : 'badge-warning'; ?>">
                                                                    <?php echo $order['Status']; ?>
                                                                </span>
                                                            </td>
                                                            <td>
                                                                <a style="background-color: #0B5ED7; color:white;" href="viewcakeorder.php?orderid=<?php echo $order['OrderNumber']; ?>" 
                                                                   class="btn btn-primary btn-xs">View Order</a>
                                                            </td>
                                                        </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="text-center mt-4 mb-3">
                <a  style="background-color: #0B5ED7; color:white;"  href="manage-delivery-boys.php" class="btn btn-secondary">
                    <i class="fa fa-arrow-left"></i> Back to manage_delivery_boys
                </a>
            </div>
            </div>
            <?php include('includes/footer.php'); ?>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="js/plugins/dataTables/datatables.min.js"></script>
    <script src="js/plugins/dataTables/dataTables.bootstrap4.min.js"></script>
    <script src="js/inspinia.js"></script>
    <script src="js/plugins/pace/pace.min.js"></script>

    <!-- Page-Level Scripts -->
    <script>
        $(document).ready(function(){
            $('.dataTables-example').DataTable({
                pageLength: 10,
                responsive: true,
            });
        });
    </script>
</body>
</html>