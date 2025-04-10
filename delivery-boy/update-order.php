<?php
session_start();
include('../includes/dbconnection.php');

if(!isset($_SESSION['delivery_boy_id'])) {
    header('location: ../delivery-boy-login.php');
    exit();
}

$delivery_boy_id = $_SESSION['delivery_boy_id'];
$orderid = $_GET['orderid'];

// Add status validation
// Modify the allowed statuses array
$allowed_statuses = [
    'Order Confirmed' => ['Cake being Prepared'],
    'Cake being Prepared' => ['Cake Pickup'],
    'Cake Pickup' => ['Cake Delivered'],
    'Cake Delivered' => []
];

// Get current status from database
$status_query = mysqli_query($con, "SELECT OrderFinalStatus FROM tblorderaddresses WHERE Ordernumber='$orderid'");
$current_status = mysqli_fetch_array($status_query)['OrderFinalStatus'] ?? '';

// Process form submission
if(isset($_POST['submit'])) {
    // Add check for status existence
    if(!isset($_POST['status']) || empty($_POST['status'])) {
        echo "<script>alert('Please select a valid status!');</script>";
        exit();
    }
    
    $new_status = $_POST['status'];
    
    // Validate status transition
    if(isset($allowed_statuses[$current_status]) && in_array($new_status, $allowed_statuses[$current_status])) {
        $remark = mysqli_real_escape_string($con, $_POST['remark']);
        
        // Update queries
        $query1 = mysqli_query($con, "INSERT INTO tblfoodtracking(OrderId, remark, status) VALUES('$orderid', '$remark', '$new_status')");
        $query2 = mysqli_query($con, "UPDATE tblorderaddresses SET OrderFinalStatus='$new_status' WHERE Ordernumber='$orderid'");
        
        if($query1 && $query2) {
            echo "<script>alert('Status updated successfully');window.location.href='dashboard.php';</script>";
            exit();
        }
    } else {
        echo "<script>alert('Invalid status transition!');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Order Status</title>
    <link href="../admin/css/bootstrap.min.css" rel="stylesheet">
    <link href="../admin/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="../admin/css/style.css" rel="stylesheet">
</head>
<body>
    <div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4 p-3 bg-light rounded shadow-sm">
            <div class="col-md-12">
                <h2>Update Order Status</h2>
                <a style="background-color:rgb(84, 84, 84); color:white;" href="dashboard.php" class="btn btn-primary float-right">Back to Dashboard</a>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-body">
                        <form method="post">
                            <div class="form-group">
                                <label>Current Status: <strong><?php echo $current_status; ?></strong></label>
                            </div>
                            <div class="form-group">
                                <label>Update Status</label>
                                <select name="status" class="form-control" <?php echo ($current_status == 'Cake Delivered') ? 'disabled' : ''; ?> required>
                                    <option value="">Select Next Status</option>
                                    <?php 
                                    // Get valid next statuses or empty array
                                    $next_statuses = $allowed_statuses[$current_status] ?? [];
                                    foreach($next_statuses as $status): ?>
                                        <option value="<?php echo $status; ?>"><?php echo $status; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?php if($current_status == 'Cake Delivered'): ?>
                                    <p class="text-success mt-2">Order already delivered</p>
                                <?php elseif(empty($next_statuses)): ?>
                                    <p class="text-danger mt-2">No further status updates available</p>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label>Remark</label>
                                <textarea name="remark" class="form-control" rows="4" required></textarea>
                            </div>
                            <button style="background-color: #0B5ED7; color:white;" type="submit" name="submit" class="btn btn-primary">Update Status</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../admin/js/jquery-3.1.1.min.js"></script>
    <script src="../admin/js/bootstrap.min.js"></script>
</body>
</html>