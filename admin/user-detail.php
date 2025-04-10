<?php
    session_start();
    error_reporting(0);
    include 'includes/dbconnection.php';
    if (strlen($_SESSION['fosaid'] == 0)) {
        header('location:logout.php');
    } else {

    }
?>
<!DOCTYPE html>
<html>

<head>

    <title>Cake Bakery  | User Details</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="css/plugins/steps/jquery.steps.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #0B5ED7;
            --text-color: #333;
            --border-color: #ddd;
            --bg-color: #f5f5f5;
            --icon-color: #666;
            --hover-color: #0a58ca;
        }

        .breadcrumb-container {
            background: var(--bg-color);
            padding: 12px 15px;
            border-radius: 4px;
            margin-bottom: 20px;
            border: 1px solid var(--border-color);
            box-shadow: 0 1px 2px rgba(0,0,0,0.05);
        }

        .breadcrumb {
            margin: 0;
            padding: 0;
            background: transparent;
        }

        .breadcrumb-item {
            font-size: 14px;
        }

        .breadcrumb-item a {
            color: var(--primary-color);
            text-decoration: none;
        }

        .breadcrumb-item.active {
            color: var(--text-color);
        }

        .page-title {
            font-size: 22px;
            color: var(--text-color);
            margin-bottom: 20px;
            padding-bottom: 12px;
            border-bottom: 1px solid var(--border-color);
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
            box-shadow: 0 1px 3px rgba(0,0,0,0.08);
        }

        .card-body {
            padding: 20px;
        }

        .table {
            margin-bottom: 0;
        }

        .table thead th {
            background: var(--bg-color);
            border-bottom: 2px solid var(--border-color);
            color: var(--text-color);
            font-weight: 600;
            font-size: 14px;
            padding: 12px 15px;
        }

        .table tbody td {
            padding: 12px 15px;
            vertical-align: middle;
            border-bottom: 1px solid var(--border-color);
            font-size: 14px;
        }

        .table tbody tr:hover {
            background-color: var(--bg-color);
        }

        .btn {
            padding: 5px 12px;
            font-size: 13px;
            border-radius: 4px;
            margin: 0 3px;
            display: inline-flex;
            align-items: center;
        }

        .btn i {
            margin-right: 5px;
            font-size: 12px;
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

        .btn-block {
            color: #dc3545;
            background: rgba(220, 53, 69, 0.1);
            border: none;
            width: 70px;
            text-decoration: none;
        }

        .btn-block:hover {
            background: rgba(220, 53, 69, 0.2);
            color: #dc3545;
            text-decoration: none;
        }

        .action-btns {
            white-space: nowrap;
        }
    </style>

</head>

<body>

    <div id="wrapper">

    <?php include_once 'includes/leftbar.php'; ?>

        <div id="page-wrapper" class="gray-bg">
             <?php include_once 'includes/header.php'; ?>

        <div class="wrapper wrapper-content animated fadeInRight">

            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-container">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="dashboard.php"><i class="fa fa-home"></i> Dashboard</a>
                            </li>
                           
                            <li class="breadcrumb-item active">
                                <i class="fa fa-list"></i> User List
                            </li>
                        </ol>
                    </div>

                    <h2 class="page-title">
                        <i class="fa fa-users"></i> User Management
                    </h2>

                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th width="5%">S.NO</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Mobile Number</th>
                                            <th>Email</th>
                                            <th width="15%" class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $ret = mysqli_query($con, "select * from tbluser where status = 'active' ");
                                            $cnt = 1;
                                            while ($row = mysqli_fetch_array($ret)) {
                                        ?>
                                        <tr>
                                            <td><?php echo $cnt; ?></td>
                                            <td><?php echo $row['FirstName']; ?></td>
                                            <td><?php echo $row['LastName']; ?></td>
                                            <td><?php echo $row['MobileNumber']; ?></td>
                                            <td><?php echo $row['Email']; ?></td>
                                            <td class="text-center action-btns">
                                                <a href="edit-userprofile.php?userid=<?php echo $row['ID']; ?>" class="btn btn-view">
                                                    <i class="fa fa-eye"></i> View
                                                </a>
                                                <a href="delete-userprofile.php?userid=<?php echo $row['ID']; ?>" class="btn btn-block">
                                                    <i class="fa fa-ban"></i> Block
                                                </a>
                                            </td>
                                        </tr>
                                        <?php 
                                            $cnt = $cnt + 1;
                                        }
                                        if(mysqli_num_rows($ret) == 0) {
                                        ?>
                                        <tr>
                                            <td colspan="6" class="text-center">No users found</td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-4 mb-3">
                <a  style="background-color: #0B5ED7;"  href="dashboard.php" class="btn btn-secondary">
                    <i class="fa fa-arrow-left"></i> Back to Dashboard
                </a>
            </div>
            
        </div>
        <?php include_once 'includes/footer.php'; ?>
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
