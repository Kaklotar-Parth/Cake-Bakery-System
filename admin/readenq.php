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
    <title>Cake Bakery  | Manage Enquiry</title>

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
            --primary-light: #e7f1ff;
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
            border: 1px solid #dee2e6;
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
            background-color: transparent;
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
            font-weight: 500;
            color: var(--dark-color);
        }
        
        .table tbody tr:hover {
            background-color: var(--primary-light);
        }
        
        .table tbody tr:nth-of-type(odd) {
            background-color: rgba(0,0,0,.05);
        }
        
        .badge {
            display: inline-block;
            padding: 0.25em 0.4em;
            font-size: 75%;
            font-weight: 700;
            line-height: 1;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: 0.25rem;
        }
        
        .badge-primary {
            color: #fff;
            background-color: var(--primary-color);
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
            transition: all .15s ease-in-out;
        }
        
        .btn-primary {
            color: #fff;
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .btn-primary:hover {
            background-color: var(--primary-hover);
            border-color: var(--primary-hover);
            box-shadow: 0 0 0 0.2rem rgba(11, 94, 215, 0.25);
        }
        
        .btn-info {
            color: #fff;
            background-color:gray;
            /* border-color: var(--info-color); */
        }
        
        .btn-info:hover {
            background-color:rgb(39, 60, 152);
            border-color: #117a8b;
            box-shadow: 0 0 0 0.2rem rgba(23, 162, 184, 0.25);
        }
        
        .btn-secondary {
            color: #fff;
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
        }
        
        .btn-secondary:hover {
            background-color: #5a6268;
            border-color: #545b62;
            box-shadow: 0 0 0 0.2rem rgba(108, 117, 125, 0.25);
        }
        
        .btn-sm {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
            line-height: 1.5;
            border-radius: 0.2rem;
        }
        
        .pagination {
            display: flex;
            padding-left: 0;
            list-style: none;
            border-radius: var(--border-radius);
            margin: 1rem 0;
            justify-content: center;
        }
        
        .page-item {
            margin: 0 2px;
        }
        
        .page-link {
            position: relative;
            display: block;
            padding: 0.5rem 0.75rem;
            line-height: 1.25;
            color: var(--primary-color);
            background-color: #fff;
            border: 1px solid #dee2e6;
            text-decoration: none;
            border-radius: var(--border-radius);
        }
        
        .page-item.active .page-link {
            z-index: 3;
            color: #fff;
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .page-item.disabled .page-link {
            color: var(--secondary-color);
            pointer-events: none;
            background-color: #fff;
            border-color: #dee2e6;
        }
        
        .page-link:hover {
            z-index: 2;
            color: var(--primary-hover);
            text-decoration: none;
            background-color: var(--primary-light);
            border-color: #dee2e6;
        }
        
        .action-buttons .btn {
            margin: 0 0.25rem;
        }

        .wrapper-content {
            padding: 20px;
            background-color: #f8f9fa;
        }

        .table-responsive {
            margin-bottom: 1rem;
        }

        .card-body {
            padding: 1.25rem;
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
                            <h4 class="card-title"><i class="fa fa-envelope"></i> Manage Enquiry</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Enquiry Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (isset($_GET['page_no']) && $_GET['page_no'] != "") {
                                            $page_no = $_GET['page_no'];
                                        } else {
                                            $page_no = 1;
                                        }

                                        $total_records_per_page = 4;
                                        $offset                 = ($page_no - 1) * $total_records_per_page;
                                        $previous_page          = $page_no - 1;
                                        $next_page              = $page_no + 1;
                                        $adjacents              = "2";

                                        $result_count      = mysqli_query($con, "SELECT COUNT(*) As total_records FROM tblcontact where IsRead='1'");
                                        $total_records     = mysqli_fetch_array($result_count);
                                        $total_records     = $total_records['total_records'];
                                        $total_no_of_pages = ceil($total_records / $total_records_per_page);
                                        $second_last       = $total_no_of_pages - 1; // total page minus 1
                                        $ret               = mysqli_query($con, "select * from tblcontact where IsRead='1' LIMIT $offset, $total_records_per_page");
                                        $cnt               = 1;
                                        while ($row = mysqli_fetch_array($ret)) {

                                        ?>
                                        <tr>
                                            <td class="text-center"><?php echo($cnt); ?></td>
                                            <td><?php echo htmlspecialchars($row['Name']); ?></td>
                                            <td><?php echo htmlspecialchars($row['Email']); ?></td>
                                            <td><h3> 
                                                <span  style="background:none; color:black;" class="badge badge-primary"><?php echo htmlspecialchars($row['EnquiryDate']); ?></span>
                                            </h3></td>
                                            <td class="action-buttons">
                                                <a href="view-enquiry.php?viewid=<?php echo htmlspecialchars($row['ID']); ?>" 
                                                   class="btn btn-primary btn-sm">
                                                    <i class="fa fa-eye"></i> View
                                                </a>
                                                <a href="reply.php?viewid=<?php echo htmlspecialchars($row['ID']); ?>" 
                                                   class="btn btn-info btn-sm">
                                                    <i class="fa fa-reply"></i> Reply
                                                </a>
                                            </td>
                                        </tr>
                                        <?php
                                            $cnt = $cnt + 1;
                                        }?>

                                    </tbody>
                                </table>
                            </div>

                            <?php if($total_no_of_pages > 1): ?>
                                <nav aria-label="Page navigation" class="mt-4">
                                    <ul class="pagination justify-content-center">
                                        <li class="page-item <?php echo $page_no <= 1 ? 'disabled' : ''; ?>">
                                            <a class="page-link" href="?page_no=<?php echo $previous_page; ?>">Previous</a>
                                        </li>

                                        <?php
                                        if ($total_no_of_pages <= 10) {
                                            for ($counter = 1; $counter <= $total_no_of_pages; $counter++) {
                                                if ($counter == $page_no) {
                                                    echo "<li class='page-item active'><a class='page-link'>$counter</a></li>";
                                                } else {
                                                    echo "<li class='page-item'><a class='page-link' href='?page_no=$counter'>$counter</a></li>";
                                                }
                                            }
                                        } elseif ($total_no_of_pages > 10) {
                                            if ($page_no <= 4) {
                                                for ($counter = 1; $counter < 8; $counter++) {
                                                    if ($counter == $page_no) {
                                                        echo "<li class='page-item active'><a class='page-link'>$counter</a></li>";
                                                    } else {
                                                        echo "<li class='page-item'><a class='page-link' href='?page_no=$counter'>$counter</a></li>";
                                                    }
                                                }
                                                echo "<li  class='page-item disabled'><a class='page-link'>...</a></li>";
                                                echo "<li class='page-item'><a class='page-link' href='?page_no=$second_last'>$second_last</a></li>";
                                                echo "<li class='page-item'><a class='page-link' href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
                                            } elseif ($page_no > 4 && $page_no < $total_no_of_pages - 4) {
                                                echo "<li class='page-item'><a class='page-link' href='?page_no=1'>1</a></li>";
                                                echo "<li class='page-item'><a class='page-link' href='?page_no=2'>2</a></li>";
                                                echo "<li class='page-item disabled'><a class='page-link'>...</a></li>";
                                                for ($counter = $page_no - $adjacents; $counter <= $page_no + $adjacents; $counter++) {
                                                    if ($counter == $page_no) {
                                                        echo "<li  class='page-item active'><a class='page-link'>$counter</a></li>";
                                                    } else {
                                                        echo "<li class='page-item'><a class='page-link' href='?page_no=$counter'>$counter</a></li>";
                                                    }
                                                }
                                                echo "<li class='page-item disabled'><a class='page-link'>...</a></li>";
                                                echo "<li class='page-item'><a class='page-link' href='?page_no=$second_last'>$second_last</a></li>";
                                                echo "<li class='page-item'><a class='page-link' href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
                                            } else {
                                                echo "<li class='page-item'><a class='page-link' href='?page_no=1'>1</a></li>";
                                                echo "<li class='page-item'><a class='page-link' href='?page_no=2'>2</a></li>";
                                                echo "<li class='page-item disabled'><a class='page-link'>...</a></li>";
                                                for ($counter = $total_no_of_pages - 6; $counter <= $total_no_of_pages; $counter++) {
                                                    if ($counter == $page_no) {
                                                        echo "<li  class='page-item active'><a class='page-link'>$counter</a></li>";
                                                    } else {
                                                        echo "<li class='page-item'><a class='page-link' href='?page_no=$counter'>$counter</a></li>";
                                                    }
                                                }
                                            }
                                        }
                                        ?>

                                        <li class="page-item <?php echo $page_no >= $total_no_of_pages ? 'disabled' : ''; ?>">
                                            <a class="page-link" href="?page_no=<?php echo $next_page; ?>">Next</a>
                                        </li>
                                        <?php if ($page_no < $total_no_of_pages): ?>
                                            <li class="page-item">
                                                <a class="page-link" href="?page_no=<?php echo $total_no_of_pages; ?>">Last &rsaquo;&rsaquo;</a>
                                            </li>
                                        <?php endif; ?>
                                    </ul>
                                </nav>
                            <?php endif; ?>
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
