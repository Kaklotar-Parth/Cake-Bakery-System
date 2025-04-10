<?php
    session_start();
    error_reporting(0);
    include 'includes/dbconnection.php';

    // Check if user is logged in
    if (!isset($_SESSION['fosaid']) || strlen($_SESSION['fosaid']) == 0) {
        header('location:logout.php');
        exit();
    } else {

    }
?>
<!DOCTYPE html>
<html>

<head>


    <title>Cake Bakery  | Search Order</title>

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
        
        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: var(--dark-color);
            background-color: transparent;
            border-collapse: collapse;
        }
        
        .table th,
        .table td {
            padding: 0.75rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
        }
        
        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #dee2e6;
            background-color: var(--light-color);
            font-weight: 500;
        }
        
        .table tbody tr:hover {
            background-color: rgba(0,0,0,.075);
        }
        
        .table tbody tr:nth-of-type(odd) {
            background-color: rgba(0,0,0,.05);
        }
        
        .search-icon {
            font-size: 180px;
            color: var(--primary-color);
            opacity: 0.1;
            margin-top: 20px;
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
                <h2>Search Order</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="dashboard.php">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a>Search Order</a>
                    </li>
                    <li class="breadcrumb-item active">
                        <strong>Search</strong>
                    </li>
                </ol>
            </div>
        </div>

        <div class="wrapper wrapper-content animated fadeInRight">

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title"><i class="fa fa-search"></i> Search Order</h4>
                        </div>
                        <div class="card-body">
                            <?php if(isset($msg)): ?>
                                <div class="alert alert-danger">
                                    <?php echo $msg; ?>
                                </div>
                            <?php endif; ?>

                            <form name="directory" method="post" class="mb-4">
                                <div class="form-group text-center">
                                    <label for="searchdata" class="h5">Search by Order Number:</label>
                                    <div class="input-group justify-content-center">
                                        <input type="text" id="searchdata" name="searchdata" 
                                               class="form-control" style="max-width: 400px;" 
                                               required pattern="[0-9]{1,20}" 
                                               title="Please enter numbers only"
                                               placeholder="Enter order number">
                                        <div class="input-group-append">
                                            <button type="submit" name="search" class="btn btn-primary">
                                                <i class="fa fa-search"></i> Search
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <?php
                                if (isset($_POST['search'])) {
                                    $sdata = mysqli_real_escape_string($con, $_POST['searchdata']);
                                ?>
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>S.No</th>
                                                    <th>Order Number</th>
                                                    <th>Order Date</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $ret = mysqli_query($con, "SELECT * FROM tblorderaddresses WHERE Ordernumber LIKE '$sdata%'");
                                                $num = mysqli_num_rows($ret);
                                                
                                                if ($num > 0) {
                                                    $cnt = 1;
                                                    while ($row = mysqli_fetch_array($ret)) {
                                                ?>
                                                    <tr>
                                                        <td><?php echo $cnt; ?></td>
                                                        <td><?php echo htmlspecialchars($row['Ordernumber']); ?></td>
                                                        <td><?php echo htmlspecialchars($row['OrderTime']); ?></td>
                                                        <td>
                                                            <a href="viewcakeorder.php?orderid=<?php echo htmlspecialchars($row['Ordernumber']); ?>" 
                                                               class="btn btn-primary btn-sm">
                                                                <i class="fa fa-eye"></i> View Details
                                                            </a>
                                                        </td>
                                                    </tr>
                                                <?php
                                                        $cnt++;
                                                    }
                                                } else {
                                                ?>
                                                    <tr>
                                                        <td colspan="4" class="text-center">No records found for this search</td>
                                                    </tr>
                                                <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
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
