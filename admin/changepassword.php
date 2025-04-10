<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
error_reporting(0);
if (strlen($_SESSION['fosaid']==0)) {
  header('location:logout.php');
  } else{
if(isset($_POST['submit']))
{
$adminid=$_SESSION['fosaid'];
$cpassword=md5($_POST['currentpassword']);
$newpassword=md5($_POST['newpassword']);
$query=mysqli_query($con,"select ID from tbladmin where ID='$adminid' and Password='$cpassword'");
$row=mysqli_fetch_array($query);
if($row>0){
$ret=mysqli_query($con,"update tbladmin set Password='$newpassword' where ID='$adminid'");
echo '<script>alert("Your password successfully changed.")</script>';
} else {
echo '<script>alert("Your current password is wrong.")</script>';
}
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cake Bakery  | Change Password</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
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
            padding: 25px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            font-size: 14px;
            color: var(--text-color);
            font-weight: 500;
            display: flex;
            align-items: center;
        }

        .form-control {
            height: 35px;
            border: 1px solid var(--border-color);
            border-radius: 4px;
            font-size: 14px;
            padding: 8px 12px;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: none;
        }

        .icon-label {
            color: var(--primary-color);
            width: 20px;
            margin-right: 8px;
            text-align: center;
            font-size: 16px;
        }

        .btn-container {
            text-align: center;
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid var(--border-color);
        }

        .btn {
            margin: 0 8px;
            padding: 8px 20px;
            font-size: 14px;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .btn i {
            margin-right: 8px;
            font-size: 14px;
        }

        .btn-primary {
            background: var(--primary-color);
            border: none;
            color: white;
        }

        .btn-primary:hover {
            background: var(--hover-color);
            opacity: 0.9;
            transform: translateY(-1px);
        }

        .btn-secondary {
            background: #6c757d;
            border: none;
            color: white;
        }

        .btn:hover {
            /* background-color: #DC3545; */
            opacity: 0.9;
            transform: translateY(-1px);
        }

        @media (max-width: 768px) {
            .btn {
                margin: 5px;
            }
        }
    </style>
    <script type="text/javascript">
        function checkpass() {
            if(document.changepassword.newpassword.value != document.changepassword.confirmpassword.value) {
                alert('New Password and Confirm Password field does not match');
                document.changepassword.confirmpassword.focus();
                return false;
            }
            return true;
        }   
    </script>
</head>

<body>
    <div id="wrapper">
        <?php include_once('includes/leftbar.php');?>
        <div id="page-wrapper" class="gray-bg">
            <?php include_once('includes/header.php');?>
            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="breadcrumb-container">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="dashboard.php"><i class="fa fa-home"></i> Dashboard</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="#"><i class="fa fa-cog"></i> Settings</a>
                                </li>
                                <li class="breadcrumb-item active">
                                    <i class="fa fa-key"></i> Change Password
                                </li>
                            </ol>
                        </div>

                        <h2 class="page-title">
                            <i class="fa fa-lock"></i> Change Password
                        </h2>

                        <div class="card">
                            <div class="card-body">
                                <?php
                                    $adminid=$_SESSION['fosaid'];
                                    $ret=mysqli_query($con,"select * from tbladmin where ID='$adminid'");
                                    while ($row=mysqli_fetch_array($ret)) {
                                ?>
                                <form name="changepassword" method="post" onsubmit="return checkpass();">
                                    <div class="form-group row">
                                        <label class="col-sm-3 form-label">
                                            <i class="fa fa-lock icon-label"></i><strong>Current Password</strong>
                                        </label>
                                        <div class="col-sm-9">
                                            <input type="password" name="currentpassword" id="currentpassword" 
                                                   class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 form-label">
                                            <i class="fa fa-key icon-label"></i><strong>New Password</strong>
                                        </label>
                                        <div class="col-sm-9">
                                            <input type="password" name="newpassword" id="newpassword" 
                                                   class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 form-label">
                                            <i class="fa fa-check-circle icon-label"></i><strong>Confirm Password</strong>
                                        </label>
                                        <div class="col-sm-9">
                                            <input type="password" name="confirmpassword" id="confirmpassword" 
                                                   class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="btn-container">
                                        <a href="adminprofile.php" class="btn btn-secondary">
                                            <i class="fa fa-arrow-circle-left"></i>Back to Profile
                                        </a>
                                        <button type="submit" name="submit" class="btn btn-primary">
                                            <i class="fa fa-refresh"></i>Update Password
                                        </button>
                                    </div>
                                </form>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php include_once('includes/footer.php');?>
        </div>
    </div>

    <!-- Scripts -->
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="js/inspinia.js"></script>
    <script src="js/plugins/pace/pace.min.js"></script>
</body>
</html>
<?php } ?>