<?php
session_start();
include('includes/dbconnection.php');
include('includes/checklogin.php');
check_login();

// Initialize message variables
$success_message = '';
$error_message = '';

// Handle approve/reject actions
if(isset($_GET['approve'])) {
    $id = mysqli_real_escape_string($con, $_GET['approve']);
    $update_query = mysqli_query($con, "UPDATE tbldeliveryboys SET Status='Approved' WHERE ID='$id'");
    if($update_query) {
        $_SESSION['success_message'] = "Delivery boy approved successfully";
    } else {
        $_SESSION['error_message'] = "Error approving delivery boy: " . mysqli_error($con);
    }
    header("Location: pending-delivery-boys.php");
    exit();
}

if(isset($_GET['reject'])) {
    $id = mysqli_real_escape_string($con, $_GET['reject']);
    $update_query = mysqli_query($con, "UPDATE tbldeliveryboys SET Status='Rejected' WHERE ID='$id'");
    if($update_query) {
        $_SESSION['success_message'] = "Delivery boy rejected successfully";
    } else {
        $_SESSION['error_message'] = "Error rejecting delivery boy: " . mysqli_error($con);
    }
    header("Location: pending-delivery-boys.php");
    exit();
}

// Get pending delivery boys
$query = mysqli_query($con, "SELECT * FROM tbldeliveryboys WHERE Status='Pending' ORDER BY RegDate DESC");

// Check for messages in session
if(isset($_SESSION['success_message'])) {
    $success_message = $_SESSION['success_message'];
    unset($_SESSION['success_message']);
}
if(isset($_SESSION['error_message'])) {
    $error_message = $_SESSION['error_message'];
    unset($_SESSION['error_message']);
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pending Delivery Boys - Cake Bakery System</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/plugins/dataTables/datatables.min.css" rel="stylesheet">
</head>
<body>
    <div id="wrapper">
        <?php include('includes/leftbar.php');?>
        <div id="page-wrapper" class="gray-bg">
            <?php include('includes/header.php');?>
            
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Pending Delivery Boy Applications</h2>
                </div>
            </div>

            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox">
                            <div class="ibox-content">
                                <?php if($success_message): ?>
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <?php echo $success_message; ?>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                <?php endif; ?>

                                <?php if($error_message): ?>
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <?php echo $error_message; ?>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                <?php endif; ?>

                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Address</th>
                                                <th>Registration Date</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if(mysqli_num_rows($query) > 0) {
                                                while($row = mysqli_fetch_array($query)) {
                                            ?>
                                            <tr>
                                                <td><?php echo htmlspecialchars($row['ID']); ?></td>
                                                <td><?php echo htmlspecialchars($row['Name']); ?></td>
                                                <td><?php echo htmlspecialchars($row['Email']); ?></td>
                                                <td><?php echo htmlspecialchars($row['Phone']); ?></td>
                                                <td><?php echo htmlspecialchars($row['Address']); ?></td>
                                                <td><?php echo date('d M Y', strtotime($row['RegDate'])); ?></td>
                                                <td>
                                                    <div class="btn-group">
                                                        <a href="?approve=<?php echo $row['ID']; ?>" 
                                                           class="btn btn-success btn-sm" 
                                                           onclick="return confirm('Are you sure you want to approve this delivery boy?');">
                                                            <i class="fa fa-check"></i> Approve
                                                        </a>
                                                        <a href="?reject=<?php echo $row['ID']; ?>" 
                                                           class="btn btn-danger btn-sm"
                                                           onclick="return confirm('Are you sure you want to reject this delivery boy?');">
                                                            <i class="fa fa-times"></i> Reject
                                                        </a>
                                                        <a style="background-color: #0B5ED7; color:white;" href="view-delivery-boy.php?id=<?php echo $row['ID']; ?>" 
                                                           class="btn btn-info btn-sm">
                                                            <i class="fa fa-eye"></i> View
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php 
                                                }
                                            } else {
                                            ?>
                                            <tr>
                                                <td colspan="7" class="text-center">No pending applications found</td>
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
                responsive: true
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