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
    <title>Cake Bakery System | Unread Enquiries</title>
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

        .action-buttons .btn {
            margin: 0 2px;
        }

        .badge {
            padding: 0.5em 0.75em;
            font-weight: 500;
        }

        .pagination {
            margin-bottom: 0;
        }

        .pagination .page-link {
            color: var(--primary-color);
        }

        .pagination .page-item.active .page-link {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
    </style>
</head>

<body>
    <div id="wrapper">
        <?php include_once('includes/leftbar.php'); ?>

        <div id="page-wrapper" class="gray-bg">
            <?php include_once('includes/header.php'); ?>

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
                                    <i class="fa fa-envelope-o"></i> Unread Enquiries
                                </li>
                            </ol>
                        </div>

                        <h2 class="page-title">
                            <i class="fa fa-envelope-o"></i> Unread Enquiries
                        </h2>

                        <div class="card">
                            <div class="card-header">
                                <h3><i class="fa fa-list"></i> Manage Unread Enquiries</h3>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
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
                                            $offset = ($page_no - 1) * $total_records_per_page;
                                            $previous_page = $page_no - 1;
                                            $next_page = $page_no + 1;
                                            $adjacents = "2";

                                            $result_count = mysqli_query($con, "SELECT COUNT(*) As total_records FROM tblcontact where IsRead is null");
                                            $total_records = mysqli_fetch_array($result_count);
                                            $total_records = $total_records['total_records'];
                                            $total_no_of_pages = ceil($total_records / $total_records_per_page);
                                            $second_last = $total_no_of_pages - 1;

                                            $ret = mysqli_query($con, "select * from tblcontact where IsRead is null LIMIT $offset, $total_records_per_page");
                                            $cnt = 1;
                                            while ($row = mysqli_fetch_array($ret)) {
                                            ?>
                                                <tr>
                                                    <td class="text-center"><?php echo $cnt; ?></td>
                                                    <td><?php echo htmlspecialchars($row['Name']); ?></td>
                                                    <td><?php echo htmlspecialchars($row['Email']); ?></td>
                                                    <td>
                                                        <span style="background: none; color: black;" class="badge badge-primary"><?php echo htmlspecialchars($row['EnquiryDate']); ?></span>
                                                    </td>
                                                    <td class="action-buttons">
                                                        <a style="background: #0b5ed7; color: white;" href="view-enquiry.php?viewid=<?php echo htmlspecialchars($row['ID']); ?>" 
                                                           class="btn btn-primary btn-sm">
                                                            <i class="fa fa-eye"></i> View
                                                        </a>
                                                        <!-- <a href="reply.php?viewid=<?php echo htmlspecialchars($row['ID']); ?>" 
                                                           class="btn btn-info btn-sm">
                                                            <i class="fa fa-reply"></i> Reply
                                                        </a> -->
                                                    </td>
                                                </tr>
                                            <?php
                                                $cnt++;
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>

                                <?php if ($total_no_of_pages > 1) { ?>
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
                                                    echo "<li class='page-item disabled'><a class='page-link'>...</a></li>";
                                                    echo "<li class='page-item'><a class='page-link' href='?page_no=$second_last'>$second_last</a></li>";
                                                    echo "<li class='page-item'><a class='page-link' href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
                                                } elseif ($page_no > 4 && $page_no < $total_no_of_pages - 4) {
                                                    echo "<li class='page-item'><a class='page-link' href='?page_no=1'>1</a></li>";
                                                    echo "<li class='page-item'><a class='page-link' href='?page_no=2'>2</a></li>";
                                                    echo "<li class='page-item disabled'><a class='page-link'>...</a></li>";
                                                    for ($counter = $page_no - $adjacents; $counter <= $page_no + $adjacents; $counter++) {
                                                        if ($counter == $page_no) {
                                                            echo "<li class='page-item active'><a class='page-link'>$counter</a></li>";
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
                                                            echo "<li class='page-item active'><a class='page-link'>$counter</a></li>";
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
                                            <?php if ($page_no < $total_no_of_pages) { ?>
                                                <li class="page-item">
                                                    <a class="page-link" href="?page_no=<?php echo $total_no_of_pages; ?>">Last &rsaquo;&rsaquo;</a>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    </nav>
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
            <?php include_once('includes/footer.php'); ?>
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
</body>
</html>
