<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

// Check if user is logged in
if (!isset($_SESSION['fosaid']) || strlen($_SESSION['fosaid']) == 0) {
    header('location:logout.php');
    exit();
}
?>
<!DOCTYPE html>
<html>

<head>

    <title>Cake Bakery  | Between Dates Report</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
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
        
        .form-control {
            border-radius: var(--border-radius);
            border: 1px solid #ced4da;
            padding: 0.375rem 0.75rem;
            transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
        }
        
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(11, 94, 215, 0.25);
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
        
        .alert {
            position: relative;
            padding: 0.75rem 1.25rem;
            margin-bottom: 1rem;
            border: 1px solid transparent;
            border-radius: var(--border-radius);
        }
        
        .alert-danger {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
        }
        
        .form-group label {
            margin-bottom: 0.5rem;
            color: var(--dark-color);
            font-weight: 500;
        }
        
        .radio-group {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            margin-top: 0.5rem;
        }
        
        .radio-option {
            display: flex;
            align-items: center;
            margin-bottom: 0.5rem;
            padding: 0.5rem;
            border: 1px solid #ced4da;
            border-radius: var(--border-radius);
            transition: all 0.2s ease-in-out;
        }
        
        .radio-option:hover {
            background-color: var(--light-color);
            border-color: var(--primary-color);
        }
        
        .radio-option input[type="radio"] {
            margin-right: 0.5rem;
        }
        
        .radio-option label {
            margin-bottom: 0;
            cursor: pointer;
        }
        
        .feature-icon {
            font-size: 180px;
            color: var(--primary-color);
            opacity: 0.1;
            margin-top: 20px;
        }
    </style>

</head>

<body>

    <div id="wrapper">

    <?php include_once('includes/leftbar.php');?>

        <div id="page-wrapper" class="gray-bg">
             <?php include_once('includes/header.php');?>
        <div class="row border-bottom">
        <p style="font-size:16px; color:red;"> <?php if($msg){
    echo $msg;
  }  ?> </p>
        </div>
            
        <div class="wrapper wrapper-content animated fadeInRight">
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        
                        <div class="card-header">
                            <h4 class="card-title"><i class="fa fa-calendar"></i> Between Dates Reports</h4>
                        </div>
                        <div class="card-body">
                            <?php if(isset($msg)): ?>
                                <div class="alert alert-danger">
                                    <?php echo $msg; ?>
                                </div>
                            <?php endif; ?>

                            <form name="bwdatesreport"  action="bwdates-reports-details.php" method="post" onsubmit="return validateDates()"> 
                                <div class="form-group">
                                    <label for="fromdate">From Date</label>
                                    <input style="width: 50%;" class="form-control" type="date"  id="fromdate" name="fromdate" required="true">
                                </div>
                                <div class="form-group">
                                    <label for="todate">To Date</label>
                                    <input  style="width: 50%;" class="form-control" type="date"  id="todate" name="todate" required="true">
                                </div>
                                <div class="form-group">
                                    <label>Request Type</label>
                                    <div class="radio-group">
                                        <div class="radio-option">
                                            <input type="radio" id="all" name="requesttype" value="all" checked>
                                            <label for="all">All Orders</label>
                                        </div>
                                        <div class="radio-option">
                                            <input type="radio" id="not_confirmed" name="requesttype" value="">
                                            <label for="not_confirmed">Not Confirmed Orders</label>
                                        </div>
                                        <div class="radio-option">
                                            <input type="radio" id="cancelled" name="requesttype" value="cancelled">
                                            <label for="cancelled">Cancelled Orders</label>
                                        </div>
                                        <div class="radio-option">
                                            <input type="radio" id="confirmed" name="requesttype" value="Order Confirmed">
                                            <label for="confirmed">Confirmed Orders</label>
                                        </div>
                                        <div class="radio-option">
                                            <input type="radio" id="preparing" name="requesttype" value="Cake being Prepared">
                                            <label for="preparing">Cake Being Prepared</label>
                                        </div>
                                        <div class="radio-option">
                                            <input type="radio" id="pickup" name="requesttype" value="Cake Pickup">
                                            <label for="pickup">Cake Pickup</label>
                                        </div>
                                        <div class="radio-option">
                                            <input type="radio" id="delivered" name="requesttype" value="Cake Delivered">
                                            <label for="delivered">Cake Delivered</label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group text-center">
                                    <button type="submit" name="submit" class="btn btn-primary">
                                        <i class="fa fa-search"></i> Generate Report
                                    </button>
                                </div>
                            </form>
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
            <?php include_once('includes/footer.php');?>
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
        function validateDates() {
            const fromDate = new Date(document.getElementById('fromdate').value);
            const toDate = new Date(document.getElementById('todate').value);

            if (fromDate > toDate) {
                alert('Invalid date range! "From Date" cannot be later than "To Date".');
                return false;
            }

            if (fromDate.getTime() === toDate.getTime()) {
                alert('Invalid date range! "From Date" and "To Date" cannot be the same.');
                return false;
            }
            return true;
        }

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
