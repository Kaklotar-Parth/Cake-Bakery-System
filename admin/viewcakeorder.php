<?php
    session_start();
    error_reporting(0);
    include 'includes/dbconnection.php';
    if (strlen($_SESSION['fosaid'] == 0)) {
        header('location:logout.php');
    } else {

        if (isset($_POST['submit'])) {

            $oid    = $_GET['orderid'];
            $ressta = $_POST['status'];
            $remark = $_POST['restremark'];
            $delivery_boy_id = $_POST['delivery_boy_id']; // New field

            // Insert tracking record
            $query1 = mysqli_query($con, "INSERT INTO tblfoodtracking(OrderId, remark, status) VALUES('$oid', '$remark', '$ressta')");
            
            // Update order status and delivery boy
            $query2 = mysqli_query($con, "UPDATE tblorderaddresses SET OrderFinalStatus='$ressta' WHERE Ordernumber='$oid'");
            
            // Assign delivery boy when order is confirmed
            if ($ressta == 'Order Confirmed' && !empty($delivery_boy_id)) {
                $query3 = mysqli_query($con, "UPDATE tblorders SET DeliveryBoyId='$delivery_boy_id' WHERE OrderNumber='$oid'");
            }

            if ($query1 && $query2) {
                header("Location: sendmail.php?orderid=$oid&status=$ressta&remark=$remark");
                exit();
            } else {
                $msg = "Something went wrong. Please try again.";
            }

        }

    ?>
<!DOCTYPE html>
<html>

<head>

    <title>Cake Bakery  | Order Details</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="css/plugins/steps/jquery.steps.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #0B5ED7;
            --secondary-color: #6c757d;
            --success-color: #28a745;
            --danger-color: #dc3545;
            --warning-color: #ffc107;
            --info-color: #17a2b8;
            --light-color: #f8f9fa;
            --dark-color: #343a40;
            --border-radius: 0.25rem;
            --box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }
        
        .card {
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            margin-bottom: 1.5rem;
        }
        
        .card-header {
            background-color: #fff;
            border-bottom: 1px solid rgba(0,0,0,.125);
            padding: 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .card-title {
            margin-bottom: 0;
            color: var(--dark-color);
            font-weight: 500;
        }
        
        .card-title i {
            margin-right: 0.5rem;
            color: var(--primary-color);
        }
        
        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
        }
        
        .table th {
            background-color: #f8f9fa;
            border-bottom: 2px solid #dee2e6;
            font-weight: 500;
            text-align: left;
            padding: 0.75rem;
        }
        
        .table td {
            padding: 0.75rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
        }
        
        .table tbody tr:hover {
            background-color: rgba(0,0,0,.075);
        }
        
        .btn {
            display: inline-block;
            font-weight: 400;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            user-select: none;
            border: 1px solid transparent;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            border-radius: var(--border-radius);
            transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
        }
        
        .btn-primary {
            color: #fff;
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .btn-primary:hover {
            background-color: #0a58ca;
            border-color: #0a58ca;
        }
        
        .btn-secondary {
            color: #fff;
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
        }
        
        .btn-secondary:hover {
            background-color: #5a6268;
            border-color: #545b62;
        }
        
        .btn-view {
            color: var(--primary-color);
            background: rgba(11, 94, 215, 0.1);
            border: none;
            text-decoration: none;
        }
        
        .btn-view:hover {
            background: rgba(11, 94, 215, 0.2);
            color: var(--primary-color);
            text-decoration: none;
        }
        
        .breadcrumb {
            display: flex;
            flex-wrap: wrap;
            padding: 0.75rem 0;
            margin-bottom: 1rem;
            list-style: none;
            background-color: transparent;
            border-radius: var(--border-radius);
        }
        
        .breadcrumb-item {
            display: flex;
            align-items: center;
        }
        
        .breadcrumb-item + .breadcrumb-item {
            padding-left: 0.5rem;
        }
        
        .breadcrumb-item + .breadcrumb-item::before {
            display: inline-block;
            padding-right: 0.5rem;
            color: #6c757d;
            content: "/";
        }
        
        .breadcrumb-item.active {
            color: #6c757d;
        }
        
        .page-title {
            margin-bottom: 1.5rem;
            font-weight: 500;
            color: var(--dark-color);
        }
        
        .page-title i {
            margin-right: 0.5rem;
            color: var(--primary-color);
        }
        
        .order-status {
            padding: 0.25rem 0.5rem;
            border-radius: 0.25rem;
            font-weight: 500;
            display: inline-block;
        }
        
        .status-confirmed {
            background-color: rgba(40, 167, 69, 0.1);
            color: var(--success-color);
        }
        
        .status-cancelled {
            background-color: rgba(220, 53, 69, 0.1);
            color: var(--danger-color);
        }
        
        .status-prepared {
            background-color: rgba(255, 193, 7, 0.1);
            color: var(--warning-color);
        }
        
        .status-pickup {
            background-color: rgba(23, 162, 184, 0.1);
            color: var(--info-color);
        }
        
        .status-delivered {
            background-color: rgba(40, 167, 69, 0.1);
            color: var(--success-color);
        }
        
        .status-pending {
            background-color: rgba(108, 117, 125, 0.1);
            color: var(--secondary-color);
        }
        
        .order-image {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 0.25rem;
        }
        
        .tracking-history th {
            background-color: var(--primary-color);
            color: white;
        }
        
        @media (max-width: 768px) {
            .table-responsive {
                display: block;
                width: 100%;
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }
            
            .btn {
                padding: 0.25rem 0.5rem;
                font-size: 0.875rem;
            }
        }
    </style>
</head>

<body>

    <div id="wrapper">

    <?php include_once 'includes/leftbar.php'; ?>

        <div id="page-wrapper" class="gray-bg">
             <?php include_once 'includes/header.php'; ?>
        <div class="row border-bottom">

        </div>
            <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2><i class="fa fa-shopping-cart"></i> Order Details #<?php echo $_GET['orderid']; ?></h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="dashboard.php">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a>Order Detail</a>
                    </li>
                    <li class="breadcrumb-item active">
                        <strong>Update</strong>
                    </li>
                </ol>
            </div>
           
        </div>
        <div class="wrapper wrapper-content animated fadeInRight">

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title"><i class="fa fa-info-circle"></i> Order Information</h4>
                        </div>
                        <div class="card-body">
                           <?php
                               $oid = $_GET['orderid'];
                                   $ret = mysqli_query($con, "select * from tblorderaddresses join tbluser on tbluser.ID=tblorderaddresses.UserId where tblorderaddresses.Ordernumber='$oid'");
                                   $cnt = 1;
                                   while ($row = mysqli_fetch_array($ret)) {

                                   ?>
<div class="row">
  <div class="col-md-6">
     <?php if ($msg) { ?>
     <div class="alert alert-danger" role="alert">
         <?php echo $msg; ?>
     </div>
     <?php } ?>
     
     <div  class="card mb-4">
         <div style="background-color: #0B5ED7 !important ;"  class="card-header bg-primary text-white">
             <h5  class="mb-0"><i  class="fa fa-user"></i> Customer Details</h5>
         </div>
         <div class="card-body">
             <table class="table table-bordered">
                 <tr>
                     <th width="40%">Order Number</th>
                     <td><?php echo $row['Ordernumber']; ?></td>
                 </tr>
                 <tr>
                     <th>First Name</th>
                     <td><?php echo $row['FirstName']; ?></td>
                 </tr>
                 <tr>
                     <th>Last Name</th>
                     <td><?php echo $row['LastName']; ?></td>
                 </tr>
                 <tr>
                     <th>Email</th>
                     <td><?php echo $row['Email']; ?></td>
                 </tr>
                 <tr>
                     <th>Mobile Number</th>
                     <td><?php echo $row['MobileNumber']; ?></td>
                 </tr>
                 <tr>
                     <th>Flat no./buldng no.</th>
                     <td><?php echo $row['Flatnobuldngno']; ?></td>
                 </tr>
                 <tr>
                     <th>Street Name</th>
                     <td><?php echo $row['StreetName']; ?></td>
                 </tr>
                 <tr>
                     <th>Area</th>
                     <td><?php echo $row['Area']; ?></td>
                 </tr>
                 <tr>
                     <th>Land Mark</th>
                     <td><?php echo $row['Landmark']; ?></td>
                 </tr>
                 <tr>
                     <th>City</th>
                     <td><?php echo $row['City']; ?></td>
                 </tr>
                 <tr>
                     <th>Order Date</th>
                     <td><?php echo $row['OrderTime']; ?></td>
                 </tr>
                 <tr>
                     <th>Order Status</th>
                     <td>
                         <?php
                         $orserstatus = $row['OrderFinalStatus'];
                         // Simplified status display with fallback
                         if (!empty($orserstatus)) {
                             $statusClass = '';
                             switch($orserstatus) {
                                 case 'Order Confirmed':
                                     $statusClass = 'status-confirmed';
                                     break;
                                 case 'Order Cancelled':
                                     $statusClass = 'status-cancelled';
                                     break;
                                 case 'Cake being Prepared':
                                     $statusClass = 'status-prepared';
                                     break;
                                 case 'Cake Pickup':
                                     $statusClass = 'status-pickup';
                                     break;
                                 case 'Cake Delivered':
                                     $statusClass = 'status-delivered';
                                     break;
                                 default:
                                     $statusClass = 'status-pending';
                             }
                             echo "<span class='order-status {$statusClass}'>{$orserstatus}</span>";
                             
                             // Show delivery boy info for all statuses except cancelled
                             if ($orserstatus != "Order Cancelled") {
                                 $order_query = mysqli_query($con, "SELECT d.Name, d.Phone FROM tblorders o 
                                           JOIN tbldeliveryboys d ON d.ID = o.DeliveryBoyId 
                                           WHERE o.OrderNumber='$oid'");
                                 $delivery_details = mysqli_fetch_array($order_query);
                                 if($delivery_details) {
                                     echo "<br><small class='text-muted'>Delivery Boy: ".$delivery_details['Name']." (".$delivery_details['Phone'].")</small>";
                                 }
                             }
                         } else {
                             echo "<span class='order-status status-pending'>Wait for restaurant approval</span>";
                         }
                         ?>
                     </td>
                 </tr>
             </table>
         </div>
     </div>
  </div>
  
  <div class="col-md-6">
      <?php
          $query = mysqli_query($con, "select tblfood.Image,tblfood.ItemName,tblfood.ItemDes,tblorders.Price,tblorders.Weight,tblorders.Quantity,tblorders.FoodId,tblorders.CashonDelivery from tblorders join tblfood on tblfood.ID=tblorders.FoodId where tblorders.IsOrderPlaced=1 and tblorders.OrderNumber='$oid'");
          $num   = mysqli_num_rows($query);
          $cnt   = 1;
          $grandtotal = 0;
      ?>
      
      <div class="card mb-4">
          <div style="background-color: #0B5ED7 !important ;" class="card-header bg-primary text-white">
              <h5 class="mb-0"><i class="fa fa-shopping-basket"></i> Order Items</h5>
          </div>
          <div class="card-body">
              <div class="table-responsive">
                  <table class="table table-bordered">
                      <thead>
                          <tr>
                              <th width="5%">#</th>
                              <th width="15%">Image</th>
                              <th width="20%">Item Name</th>
                              <th width="15%">Weight</th>
                              <th width="10%">Qty</th>
                              <th width="15%">Delivery Type</th>
                              <th width="20%">Price</th>
                          </tr>
                      </thead>
                      <tbody>
                          <?php
                          while ($row1 = mysqli_fetch_array($query)) {
                              // Remove the multiplication since price already includes quantity
                              $total = $row1['Price'];
                              $grandtotal += $total;
                          ?>
                          <tr>
                              <td><?php echo $cnt; ?></td>
                              <td><img src="itemimages/<?php echo $row1['Image'] ?>" class="order-image" alt="<?php echo $row1['ItemName'] ?>"></td>
                              <td><?php echo $row1['ItemName']; ?></td>
                              <td><?php echo $row1['Weight']; ?></td>
                              <td><?php echo $row1['Quantity']; ?></td>
                              <td><?php echo $row1['CashonDelivery']; ?></td>
                              <td>₹<?php echo number_format($total, 2); ?></td>
                          </tr>
                          <?php
                              $cnt = $cnt + 1;
                          }?>
                          <tr>
                              <th colspan="6" class="text-right">Grand Total</th>
                              <th>₹<?php echo number_format($grandtotal, 2); ?></th>
                          </tr>
                      </tbody>
                  </table>
              </div>
          </div>
      </div>
  </div>
</div>

<div class="row mt-4">
    <div class="col-md-12">
        <?php
        if ($orserstatus == "Order Confirmed" || $orserstatus == "Cake being Prepared" || $orserstatus == "Cake Pickup" || $orserstatus == "") {
        ?>
        
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"><i class="fa fa-edit"></i> Update Order Status</h4>
            </div>
            <div class="card-body">
                <?php 
                // Only show form if order is not confirmed yet
                if ($orserstatus == "" || $orserstatus == "Order Cancelled") { 
                ?>
                <form name="submit" method="post">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Restaurant Remark:</label>
                        <div class="col-sm-10">
                            <textarea name="restremark" placeholder="Enter your remarks here" rows="4" class="form-control" required="true"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Order Status:</label>
                        <div class="col-sm-10">
                            <select name="status" class="form-control" required="true" id="orderStatus" onchange="toggleDeliveryBoy()">
                                <option value="Order Confirmed" selected="true">Order Confirmed</option>
                                <option value="Order Cancelled">Order Cancelled</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Delivery Boy:</label>
                        <div class="col-sm-10">
                            <select name="delivery_boy_id" class="form-control" id="deliveryBoy" required="true">
                                <option value="">Select Delivery Boy</option>
                                <?php
                                $delivery_boys = mysqli_query($con, "SELECT * FROM tbldeliveryboys WHERE Status='Approved'");
                                while($d_boy = mysqli_fetch_array($delivery_boys)) {
                                    echo "<option value='".$d_boy['ID']."'>".$d_boy['Name']." (".$d_boy['Phone'].")</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10 offset-sm-2">
                            <button type="submit" name="submit" class="btn btn-primary">
                                <i class="fa fa-save"></i> Update Order
                            </button>
                        </div>
                    </div>
                </form>
                <?php } ?>
                
                <?php if ($orserstatus != "") { 
                // Show tracking history table
                $ret = mysqli_query($con, "select tblfoodtracking.OrderCanclledByUser,tblfoodtracking.remark,tblfoodtracking.status as fstatus,tblfoodtracking.StatusDate from tblfoodtracking where tblfoodtracking.OrderId ='$oid'");
                $cnt = 1;
                
                $cancelledby = $row['OrderCanclledByUser'];
                ?>
                <div class="card mt-4">
                    <div style="background-color: #0B5ED7 !important ;" class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="fa fa-history"></i> Order Tracking History</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered tracking-history">
                                <thead>
                                    <tr>
                                        <th style="color:black;" width="5%">#</th>
                                        <th style="color:black;" width="40%">Remark</th>
                                        <th style="color:black;" width="30%">Status</th>
                                        <th style="color:black;" width="25%">Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    while ($row = mysqli_fetch_array($ret)) {
                                        $statusClass = '';
                                        switch($row['fstatus']) {
                                            case 'Order Confirmed':
                                                $statusClass = 'status-confirmed';
                                                break;
                                            case 'Order Cancelled':
                                                $statusClass = 'status-cancelled';
                                                break;
                                            case 'Cake being Prepared':
                                                $statusClass = 'status-prepared';
                                                break;
                                            case 'Cake Pickup':
                                                $statusClass = 'status-pickup';
                                                break;
                                            case 'Cake Delivered':
                                                $statusClass = 'status-delivered';
                                                break;
                                            default:
                                                $statusClass = 'status-pending';
                                        }
                                    ?>
                                    <tr>
                                        <td><?php echo $cnt; ?></td>
                                        <td><?php echo $row['remark']; ?></td>
                                        <td>
                                            <span class="order-status <?php echo $statusClass; ?>">
                                                <?php echo $row['fstatus'];
                                                if ($cancelledby == 1) {
                                                    echo " (by user)";
                                                } else {
                                                    // echo " (by Bakery)";
                                                }
                                                ?>
                                            </span>
                                        </td>
                                        <td><?php echo $row['StatusDate']; ?></td>
                                    </tr>
                                    <?php $cnt = $cnt + 1; } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
        <?php } ?>
    </div>
</div>
                        </div>
                    </div>
                    <div class="text-center mt-4 mb-3">
                <a  style="background-color: #0B5ED7; color:white;"  href="dashboard.php" class="btn btn-secondary">
                    <i class="fa fa-arrow-left"></i> Back to Dashboard
                </a>
            </div>
                </div>
                
            </div>
        <?php include_once 'includes/footer.php'; ?>

        </div>
        </div>



    <!-- Mainly scripts -->
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="js/inspinia.js"></script>
    <script src="js/plugins/pace/pace.min.js"></script>

    <!-- Steps -->
    <script src="js/plugins/steps/jquery.steps.min.js"></script>

    <!-- Jquery Validate -->
    <script src="js/plugins/validate/jquery.validate.min.js"></script>


    <script>
        $(document).ready(function(){
            $("#wizard").steps();
            $("#form").steps({
                bodyTag: "fieldset",
                onStepChanging: function (event, currentIndex, newIndex)
                {
                    // Always allow going backward even if the current step contains invalid fields!
                    if (currentIndex > newIndex)
                    {
                        return true;
                    }

                    // Forbid suppressing "Warning" step if the user is to young
                    if (newIndex === 3 && Number($("#age").val()) < 18)
                    {
                        return false;
                    }

                    var form = $(this);

                    // Clean up if user went backward before
                    if (currentIndex < newIndex)
                    {
                        // To remove error styles
                        $(".body:eq(" + newIndex + ") label.error", form).remove();
                        $(".body:eq(" + newIndex + ") .error", form).removeClass("error");
                    }

                    // Disable validation on fields that are disabled or hidden.
                    form.validate().settings.ignore = ":disabled,:hidden";

                    // Start validation; Prevent going forward if false
                    return form.valid();
                },
                onStepChanged: function (event, currentIndex, priorIndex)
                {
                    // Suppress (skip) "Warning" step if the user is old enough.
                    if (currentIndex === 2 && Number($("#age").val()) >= 18)
                    {
                        $(this).steps("next");
                    }

                    // Suppress (skip) "Warning" step if the user is old enough and wants to the previous step.
                    if (currentIndex === 2 && priorIndex === 3)
                    {
                        $(this).steps("previous");
                    }
                },
                onFinishing: function (event, currentIndex)
                {
                    var form = $(this);

                    // Disable validation on fields that are disabled.
                    // At this point it's recommended to do an overall check (mean ignoring only disabled fields)
                    form.validate().settings.ignore = ":disabled";

                    // Start validation; Prevent form submission if false
                    return form.valid();
                },
                onFinished: function (event, currentIndex)
                {
                    var form = $(this);

                    // Submit form input
                    form.submit();
                }
            }).validate({
                        errorPlacement: function (error, element)
                        {
                            element.before(error);
                        },
                        rules: {
                            confirm: {
                                equalTo: "#password"
                            }
                        }
                    });
       });
    </script>

</body>

</html>
   
<?php } }   ?>

<script>
function toggleDeliveryBoy() {
    const statusSelect = document.getElementById('orderStatus');
    const deliveryBoySelect = document.getElementById('deliveryBoy');
    
    if(statusSelect.value === 'Order Cancelled') {
        deliveryBoySelect.disabled = true;
        deliveryBoySelect.removeAttribute('required');
        deliveryBoySelect.value = '';
    } else {
        deliveryBoySelect.disabled = false;
        deliveryBoySelect.setAttribute('required', 'true');
    }
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    toggleDeliveryBoy();
    document.getElementById('orderStatus').addEventListener('change', toggleDeliveryBoy);
});
</script>
