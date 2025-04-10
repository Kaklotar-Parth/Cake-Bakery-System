<?php
session_start();
include('includes/dbconnection.php');
include('includes/checklogin.php');
check_login();

// Block/Unblock delivery boy
if(isset($_GET['block'])) {
    $id = $_GET['block'];
    mysqli_query($con, "UPDATE tbldeliveryboys SET Status='Rejected' WHERE ID='$id'");
    echo "<script>alert('Delivery boy blocked successfully');</script>";
}

if(isset($_GET['unblock'])) {
    $id = $_GET['unblock'];
    mysqli_query($con, "UPDATE tbldeliveryboys SET Status='Approved' WHERE ID='$id'");
    echo "<script>alert('Delivery boy unblocked successfully');</script>";
}

// Fetch all delivery boys
$query = mysqli_query($con, "SELECT * FROM tbldeliveryboys WHERE Status != 'Pending' ORDER BY RegDate DESC");

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Delivery Boys</title>
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
                    <h2>Manage Delivery Boys</h2>
                </div>
            </div>

            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox">
                            <div class="ibox-content">
                                <table class="table table-bordered dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Address</th>
                                            <th>Status</th>
                                            <th>Reg. Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        while($row = mysqli_fetch_array($query)) {
                                        ?>
                                        <tr>
                                            <td><?php echo $row['ID']; ?></td>
                                            <td><?php echo $row['Name']; ?></td>
                                            <td><?php echo $row['Email']; ?></td>
                                            <td><?php echo $row['Phone']; ?></td>
                                            <td><?php echo $row['Address']; ?></td>
                                            <td>
                                                <span style="background-color: #0B5ED7; color:white;" class="badge <?php echo $row['Status'] == 'Approved' ? 'badge-primary' : 'badge-danger'; ?>">
                                                    <?php echo $row['Status']; ?>
                                                </span>
                                            </td>
                                            <td><?php echo $row['RegDate']; ?></td>
                                            <td>
                                                <?php if($row['Status'] == 'Approved') { ?>
                                                    <a href="?block=<?php echo $row['ID']; ?>" class="btn btn-danger btn-sm">Block</a>
                                                <?php } else { ?>
                                                    <a href="?unblock=<?php echo $row['ID']; ?>" class="btn btn-success btn-sm">Unblock</a>
                                                <?php } ?>
                                                <a style="background-color:rgb(111, 111, 111); color:white;" href="view-delivery-boy.php?id=<?php echo $row['ID']; ?>" class="btn btn-info btn-sm">View Details</a>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="text-center mt-4 mb-3">
                <a  style="background-color: #0B5ED7; color:white;"  href="dashboard.php" class="btn btn-secondary">
                    <i class="fa fa-arrow-left"></i> Back to Dashboard
                </a>
            </div>
                    </div>
                   
            
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
    <style>
        .page-item.active .page-link {
            background-color: #0B5ED7;
            border-color: #0B5ED7;
        }
    </style>
    
</body>
</html>