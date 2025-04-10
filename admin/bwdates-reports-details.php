<?php
    session_start();
    error_reporting(0);
    include 'includes/dbconnection.php';
    if (strlen($_SESSION['fosaid'] == 0)) {
        header('location:logout.php');
    } else {
    ?>
<!DOCTYPE html>
<html>

<head>


    <title>Cake Bakery System||Between Dates Report Details</title>

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
            color: var(--dark-color);
            border-collapse: collapse;
        }
        
        .table th,
        .table td {
            padding: 0.75rem;
            vertical-align: middle;
            border-top: 1px solid #dee2e6;
        }
        
        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #dee2e6;
            background-color: var(--light-color);
            font-weight: 600;
        }
        
        .table tbody tr:hover {
            background-color: rgba(0, 0, 0, 0.075);
        }
        
        .btn-view {
            color: #fff;
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
            line-height: 1.5;
            border-radius: var(--border-radius);
        }
        
        .btn-view:hover {
            background-color:rgb(204, 213, 226);
            border-color: #0a58ca;
        }
        
        .report-title {
            color: var(--primary-color);
            margin-bottom: 1.5rem;
            text-align: center;
        }
        
        .status-badge {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
            font-weight: 500;
            border-radius: var(--border-radius);
        }
        
        .status-not-confirmed {
            background-color: var(--warning-color);
            color: var(--dark-color);
        }
        
        .status-confirmed {
            background-color: var(--info-color);
            color: #fff;
        }
        
        .status-cancelled {
            background-color: var(--danger-color);
            color: #fff;
        }
        
        .status-preparing {
            background-color: var(--warning-color);
            color: var(--dark-color);
        }
        
        .status-pickup {
            background-color: var(--info-color);
            color: #fff;
        }
        
        .status-delivered {
            background-color: var(--success-color);
            color: #fff;
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

    <div class="wrapper wrapper-content animated fadeInRight">

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"><i class="fa fa-calendar"></i> Between Dates Reports</h4>
                    </div>
                    <div class="card-body">
                        <?php
                            $fdate = $_POST['fromdate'];
                                $tdate = $_POST['todate'];
                                $rtype = $_POST['requesttype'];

                                if (strtotime($fdate) > strtotime($tdate)) {
                                    echo "<div class='alert alert-danger'>Invalid date range! 'From Date' cannot be later than 'To Date'.</div>";
                                } elseif ($fdate == $tdate) {
                                    echo "<div class='alert alert-danger'>Invalid date range! 'From Date' and 'To Date' cannot be the same.</div>";
                                } else {
                                    // Get the status title based on the request type
                                    $status_title = "All Orders";
                                    if ($rtype == "") {
                                        $status_title = "Not Confirmed Orders";
                                    } elseif ($rtype == "cancelled") {
                                        $status_title = "Cancelled Orders";
                                    } elseif ($rtype == "Order Confirmed") {
                                        $status_title = "Confirmed Orders";
                                    } elseif ($rtype == "Cake being Prepared") {
                                        $status_title = "Cake Being Prepared";
                                    } elseif ($rtype == "Cake Pickup") {
                                        $status_title = "Cake Pickup Orders";
                                    } elseif ($rtype == "Cake Delivered") {
                                        $status_title = "Cake Delivered Orders";
                                    }
                                ?>

<hr />
<h4 class="report-title">Report from <?php echo date('d M Y', strtotime($fdate)); ?> to <?php echo date('d M Y', strtotime($tdate)); ?> - <?php echo $status_title; ?></h4>
<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>S.No</th>
                <th>Order Number</th>
                <th>Order Date</th>
                <!-- <th>Status</th> -->
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = "SELECT * FROM tblorderaddresses WHERE OrderTime BETWEEN '$fdate' AND '$tdate'";
            if ($rtype != "all") {
                if ($rtype == "") {
                    $query .= " AND (OrderFinalStatus IS NULL OR OrderFinalStatus = '')";
                } else {
                    $query .= " AND OrderFinalStatus = '$rtype'";
                }
            }
            $query .= " ORDER BY OrderTime DESC";
            
            $ret = mysqli_query($con, $query);
            $cnt = 1;
            while ($row = mysqli_fetch_array($ret)) {
                $status_class = "";
                $status_text = $row['OrderFinalStatus'] ?: "Not Confirmed";
                
                switch($row['OrderFinalStatus']) {
                    case "Order Confirmed":
                        $status_class = "status-confirmed";
                        break;
                    case "cancelled":
                        $status_class = "status-cancelled";
                        break;
                    case "Cake being Prepared":
                        $status_class = "status-preparing";
                        break;
                    case "Cake Pickup":
                        $status_class = "status-pickup";
                        break;
                    case "Cake Delivered":
                        $status_class = "status-delivered";
                        break;
                    default:
                        $status_class = "status-not-confirmed";
                }
            ?>
                <tr>
                    <td><?php echo $cnt; ?></td>
                    <td><?php echo htmlspecialchars($row['Ordernumber']); ?></td>
                    <td><?php echo date('d M Y H:i', strtotime($row['OrderTime'])); ?></td>
                    <!-- <td><span class="status-badge <?php echo $status_class; ?>"><?php echo htmlspecialchars($status_text); ?></span></td> -->
                    <td>
                        <a href="viewcakeorder.php?orderid=<?php echo htmlspecialchars($row['Ordernumber']); ?>" class="btn btn-view">
                            <i class="fa fa-eye"></i> View Details
                        </a>
                    </td>
                </tr>
            <?php
                $cnt++;
            }
            ?>
        </tbody>
    </table>
</div>
<?php }?>

                    </div>
                </div>
            </div>
        </div>
        <div class="text-center mt-4 mb-3">
        <a  style="background-color: #0B5ED7; color:white;"  href="bwdates-report-ds.php" class="btn btn-secondary">
            <i class="fa fa-arrow-left"></i> Back to report
        </a>
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
<?php }?>
