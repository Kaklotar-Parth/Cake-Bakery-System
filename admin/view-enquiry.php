<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['fosaid']==0)) {
  header('location:logout.php');
  } else{
$vid=$_GET['viewid'];
$isread=1;
$query=mysqli_query($con, "update   tblcontact set IsRead ='$isread' where ID='$vid'");

  ?>
<!DOCTYPE html>
<html>

<head>
    <title>Cake Bakery System || View Enquiry</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="css/plugins/steps/jquery.steps.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #0B5ED7;
            --primary-hover: #0a58ca;
            --primary-light: rgba(11, 94, 215, 0.1);
            --text-color: #333;
            --dark-color: #212529;
            --light-color: #f8f9fa;
            --border-color: #dee2e6;
            --border-radius: 0.25rem;
            --secondary-color: #6c757d;
        }

        .breadcrumb-container {
            background: var(--light-color);
            padding: 12px 15px;
            border-radius: 4px;
            margin-bottom: 20px;
            border: 1px solid var(--border-color);
            box-shadow: 0 1px 2px rgba(0,0,0,0.05);
        }

        .breadcrumb-item i {
            color: var(--primary-color);
            margin-right: 5px;
        }

        .page-title {
            font-size: 22px;
            color: var(--text-color);
            margin-bottom: 20px;
            padding-bottom: 12px;
            border-bottom: 2px solid var(--border-color);
            display: flex;
            align-items: center;
        }

        .page-title i {
            color: var(--primary-color);
            margin-right: 10px;
            font-size: 24px;
        }

        .card {
            background: #fff;
            border: 1px solid var(--border-color);
            border-radius: 4px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }

        .card-header {
            padding: 15px 20px;
            background: #fff;
            border-bottom: 2px solid var(--border-color);
        }

        .card-header h3 {
            font-size: 18px;
            margin: 0;
            color: var(--text-color);
            display: flex;
            align-items: center;
        }

        .card-header h3 i {
            color: var(--primary-color);
            margin-right: 8px;
        }

        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: var(--text-color);
            border-collapse: collapse;
        }

        .table th,
        .table td {
            padding: 0.75rem;
            vertical-align: middle;
            border-top: 1px solid var(--border-color);
        }

        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid var(--border-color);
            background-color: var(--light-color);
            font-weight: 600;
        }

        .table tbody tr:hover {
            background-color: rgba(0, 0, 0, 0.075);
        }

        .wrapper-content {
            padding: 20px;
            background-color: #f8f9fa;
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
                    <div class="breadcrumb-container">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="dashboard.php"><i class="fa fa-home"></i> Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="readenq.php"><i class="fa fa-envelope"></i> Enquiry</a>
                            </li>
                            <li class="breadcrumb-item active">
                                <i class="fa fa-eye"></i> View Enquiry
                            </li>
                        </ol>
                    </div>

                    <h2 class="page-title">
                        <i class="fa fa-eye"></i> View Enquiry Details
                    </h2>

                    <div class="card">
                        <div class="card-body">
                            <?php
             
$ret=mysqli_query($con,"select * from tblcontact where ID=$vid");
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {

?>
                                 <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th width="15%">Name</th>
                                            <td width="35%"><?php echo $row['Name'];?></td>
                                            <th width="15%">Email</th>
                                            <td width="35%"><?php echo $row['Email'];?></td>
                                        </tr>
                                        <tr>
                                            <th>Message</th>
                                            <td colspan="3"><?php echo $row['Message'];?></td>
                                        </tr>
                                    </table>
                                </div>
              
             
            

                           
                        </div>
                    </div>
                    </div>

                </div>
               
            </div>
            <div class="text-center mt-4 mb-3">
                <a  style="background-color: #0B5ED7; color:white;"  href="dashboard.php" class="btn btn-secondary">
                    <i class="fa fa-arrow-left"></i> Back to Dashboard
                </a>
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

</html><?php } }?>
