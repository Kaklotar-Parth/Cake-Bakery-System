<?php
    session_start();
    include 'includes/dbconnection.php';

    // Validate session
    if (!isset($_SESSION['fosaid']) || strlen($_SESSION['fosaid']) == 0) {
        header('location:logout.php');
        exit;
    }

    $row = null;
    $viewid = 0;

    if (isset($_GET['viewid'])) {
        $viewid = intval($_GET['viewid']);

        // Fetch the enquiry details using prepared statements
        $stmt = $con->prepare("SELECT * FROM tblcontact WHERE ID=?");
        $stmt->bind_param("i", $viewid);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            // Update IsRead status when viewing the enquiry
            $updateStmt = $con->prepare("UPDATE tblcontact SET IsRead=1 WHERE ID=?");
            $updateStmt->bind_param("i", $viewid);
            $updateStmt->execute();
            $updateStmt->close();
        } else {
            echo "<script>alert('No enquiry found with the provided ID.');</script>";
            echo "<script>window.location.href='manage-enquiry.php';</script>";
            exit;
        }
        $stmt->close();
    }

    if (isset($_POST['submit_reply'])) {
        $reply = trim($_POST['reply']);
        $viewid = intval($_POST['viewid']); // Get viewid from form

        if (empty($reply)) {
            echo "<script>alert('Reply message cannot be empty');</script>";
            exit;
        }

        // Update reply using prepared statements
        $stmt = $con->prepare("UPDATE tblcontact SET Reply=?, IsRead=1 WHERE ID=?");
        $stmt->bind_param("si", $reply, $viewid);

        if ($stmt->execute()) {
            echo "<script>alert('Reply sent successfully');</script>";
            echo "<script>window.location.href='readenq.php';</script>";
        } else {
            echo "<script>alert('Something went wrong. Please try again');</script>";
        }
        $stmt->close();
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cake Bakery System | Reply Enquiry</title>
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

        .form-group label {
            font-weight: 500;
            color: var(--text-color);
        }

        .form-control {
            border: 1px solid var(--border-color);
            border-radius: var(--border-radius);
            padding: 0.5rem 0.75rem;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem var(--primary-light);
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-primary:hover {
            background-color: var(--primary-hover);
            border-color: var(--primary-hover);
        }

        .wrapper-content {
            padding: 20px;
            background-color: #f8f9fa;
        }

        .alert {
            padding: 1rem;
            margin-bottom: 1rem;
            border: 1px solid transparent;
            border-radius: 0.25rem;
        }

        .alert-warning {
            color: #856404;
            background-color: #fff3cd;
            border-color: #ffeeba;
        }

        .alert i {
            margin-right: 0.5rem;
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
                                <li class="breadcrumb-item">
                                    <a href="readenq.php"><i class="fa fa-envelope"></i> Enquiry</a>
                                </li>
                                <li class="breadcrumb-item active">
                                    <i class="fa fa-reply"></i> Reply Enquiry
                                </li>
                            </ol>
                        </div>

                        <h2 class="page-title">
                            <i class="fa fa-reply"></i> Reply to Enquiry
                        </h2>

                        <div class="card">
                            <div class="card-body">
                                <?php if (!empty($row)) { ?>
                                    <div class="table-responsive mb-4">
                                        <!-- <table class="table table-bordered">
                                            <tr>
                                                <th width="15%">Name</th>
                                                <td width="35%"><?php echo htmlspecialchars($row['Name'] ?? ''); ?></td>
                                                <th width="15%">Email</th>
                                                <td width="35%"><?php echo htmlspecialchars($row['Email'] ?? ''); ?></td>
                                            </tr>
                                            <tr>
                                                <th>Message</th>
                                                <td colspan="3"><?php echo htmlspecialchars($row['Message'] ?? ''); ?></td>
                                            </tr>
                                        </table> -->
                                    </div>

                                    <form method="post" class="mt-4">
                                        <input type="hidden" name="viewid" value="<?php echo $viewid; ?>">
                                        <div class="form-group">
                                            <label for="reply">Reply Message:</label>
                                            <textarea name="reply" id="reply" class="form-control" rows="5" required><?php echo htmlspecialchars($row['reply'] ?? ''); ?></textarea>
                                        </div>
                                        <div class="mt-3">
                                            <button type="submit" name="submit_reply" class="btn btn-primary">
                                                <i class="fa fa-paper-plane"></i> Send Reply
                                            </button>
                                        </div>
                                    </form>
                                <?php } else { ?>
                                    <div class="alert alert-warning">
                                        <i class="fa fa-exclamation-triangle"></i> No enquiry details available. Please make sure you're accessing this page with a valid enquiry ID.
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
</body>
</html>
