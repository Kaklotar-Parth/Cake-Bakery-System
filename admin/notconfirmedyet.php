<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['fosaid']==0)) {
  header('location:logout.php');
  } else{



  ?>
<!DOCTYPE html>
<html>

<head>

    <title>Cake Bakery  | Not Confirmed Orders</title>

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

    <?php include_once('includes/leftbar.php');?>

        <div id="page-wrapper" class="gray-bg">
             <?php include_once('includes/header.php');?>
        
        <div class="row border-bottom">
        
        </div>
            
        <div class="wrapper wrapper-content animated fadeInRight">
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title"><i class="fa fa-clock-o"></i> Not Confirmed Orders</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th width="5%">S.NO</th>
                                            <th width="15%">Order Number</th>
                                            <th width="15%">Order Date</th>
                                            <th width="20%">Customer Name</th>
                                            <th width="15%">Total Amount</th>
                                            <th width="30%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $ret=mysqli_query($con,"select * from tblorderaddresses where OrderFinalStatus is null");
                                        $cnt=1;
                                        
                                        // Debug: Check if there are any orders with null status
                                        $numRows = mysqli_num_rows($ret);
                                        if ($numRows == 0) {
                                            echo "<tr><td colspan='6' class='text-center'>No unconfirmed orders found.</td></tr>";
                                        }
                                        
                                        while ($row=mysqli_fetch_array($ret)) {
                                            // Get customer name from tbluser table
                                            $customerQuery = mysqli_query($con, "SELECT FirstName, LastName FROM tbluser WHERE ID = '".$row['UserId']."'");
                                            $customerData = mysqli_fetch_array($customerQuery);
                                            
                                            // Debug: Check if customer data was found
                                            if (!$customerData) {
                                                $customerName = "Unknown Customer";
                                            } else {
                                                $customerName = $customerData['FirstName'] . ' ' . $customerData['LastName'];
                                            }
                                            
                                            // Get total amount from tblorder table
                                            $orderQuery = mysqli_query($con, "SELECT SUM(Price) as TotalAmount FROM tblorders WHERE OrderNumber = '".$row['Ordernumber']."'");
                                            $orderData = mysqli_fetch_array($orderQuery);
                                            
                                            // Debug: Check if order data was found
                                            if (!$orderData || $orderData['TotalAmount'] === null) {
                                                $totalAmount = 0;
                                            } else {
                                                $totalAmount = $orderData['TotalAmount'];
                                            }
                                        ?>
                                        <tr>
                                            <td><?php echo $cnt;?></td>
                                            <td><?php echo $row['Ordernumber'];?></td>
                                            <td><?php echo $row['OrderTime'];?></td>
                                            <td><?php echo $customerName;?></td>
                                            <td>₹<?php echo number_format($totalAmount, 2);?></td>
                                            <td>
                                                <a href="viewcakeorder.php?orderid=<?php echo $row['Ordernumber'];?>" class="btn btn-view">
                                                    <i class="fa fa-eye"></i> View Details
                                                </a>
                                            </td>
                                        </tr>
                                        <?php 
                                        $cnt=$cnt+1;
                                        }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-4 mb-3">
                <a style="background-color: #0B5ED7;" href="dashboard.php" class="btn btn-secondary">
                    <i class="fa fa-arrow-left"></i> Back to Dashboard
                </a>
            </div>
        </div>
        <?php include_once('includes/footer.php');?>

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
<?php } ?>
