<?php
    session_start();
    error_reporting(0);
    include 'includes/dbconnection.php';
    error_reporting(0);
    if (strlen($_SESSION['fosaid'] == 0)) {
        header('location:logout.php');
    } else {
        if (isset($_POST['submit'])) {
            $adminid   = $_SESSION['fosaid'];
            $adminname = $_POST['adminname'];
            $mobno     = $_POST['mobilenumber'];
            $email     = $_POST['email'];

            if (!preg_match('/^[0-9]{10}$/', $mobno)) {
                echo '<script>alert("Invalid Mobile Number! Please enter exactly 10 digits.")</script>';
            }
            elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo '<script>alert("Invalid Email Format! Please enter a valid email address.")</script>';
            } else {
                $query = mysqli_query($con, "update tbladmin set AdminName ='$adminname', MobileNumber='$mobno', Email='$email' where ID='$adminid'");
                if ($query) {
                    echo '<script>alert("Profile has been updated")</script>';
                } else {
                    echo '<script>alert("Something Went Wrong. Please try again.")</script>';
                }
            }
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Cake Bakery  | Admin Profile</title>
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

        .form-label {
            font-size: 14px;
            color: var(--text-color);
            font-weight: 500;
            display: flex;
            align-items: center;
        }

        .icon-label {
            color: var(--primary-color);
            /* color: var(--icon-color); */
            width: 20px;
            margin-right: 8px;
            text-align: center;
            font-size: 16px;
            transition: color 0.3s ease;
        }

        .form-group:hover .icon-label {
            color: var(--primary-color);
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
        }

        .btn-primary:hover {
            background: var(--hover-color);
            transform: translateY(-1px);
        }

        .btn-secondary {
            background: #6c757d;
            border: none;
            color: white;
        }

        .btn-secondary:hover {
            background: #5a6268;
            transform: translateY(-1px);
        }

        .readonly-field {
            background-color: var(--bg-color);
            cursor: not-allowed;
        }

        @media (max-width: 768px) {
            .btn {
                margin: 5px;
            }
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
                                    <a href="#"><i class="fa fa-cog"></i> Admin</a>
                                </li>
                                <li class="breadcrumb-item active">
                                    <i class="fa fa-user"></i> Profile
                                </li>
                            </ol>
                        </div>

                        <h2 class="page-title">
                            <i class="fa fa-user-circle"></i> Admin Profile Management
                        </h2>
                        
                        <div class="card">
                            <div class="card-header">
                                <h3><i class="fa fa-edit"></i> Update Profile Information</h3>
                            </div>
                            <div class="card-body">
                                <?php
                                    $adminid = $_SESSION['fosaid'];
                                    $ret = mysqli_query($con, "select * from tbladmin where ID='$adminid'");
                                    while ($row = mysqli_fetch_array($ret)) {
                                ?>
                                <form id="profileForm" action="#" method="post" onsubmit="return validateForm(event)">
                                    <div class="form-group row">
                                        <label class="col-sm-3 form-label">
                                            <i class="fa fa-user-circle icon-label"></i><strong>Admin Name</strong>
                                        </label>
                                        <div class="col-sm-9">
                                            <input name="adminname" id="adminname" class="form-control" 
                                                   value="<?php echo $row['AdminName']; ?>" required>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 form-label">
                                            <i class="fa fa-id-card icon-label"></i><strong>Username</strong>
                                        </label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control readonly-field" name="username" 
                                                   readonly value="<?php echo $row['UserName']; ?>">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 form-label">
                                            <i class="fa fa-mobile-phone icon-label" style="font-size: 20px;"></i><strong>Mobile Number</strong>
                                        </label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="mobilenumber" id="mobilenumber" 
                                                   value="<?php echo $row['MobileNumber']; ?>" 
                                                   required maxlength="10" 
                                                   oninput="validateMobileNumber()">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 form-label">
                                            <i class="fa fa-envelope-o icon-label"></i><strong>Email</strong>
                                        </label>
                                        <div class="col-sm-9">
                                            <input type="email" class="form-control" name="email" id="email" 
                                                   value="<?php echo $row['Email']; ?>" 
                                                   required onblur="validateEmail()">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 form-label">
                                            <i class="fa fa-clock-o icon-label"></i><strong>Registration Date</strong>
                                        </label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control readonly-field" 
                                                   readonly value="<?php echo $row['AdminRegdate']; ?>">
                                        </div>
                                    </div>

                                    <div class="btn-container">
                                        <a href="dashboard.php" class="btn btn-secondary">
                                            <i class="fa fa-arrow-circle-left"></i>Back to Dashboard
                                        </a>
                                        <button type="submit" name="submit" class="btn btn-primary">
                                            <i class="fa fa-save"></i>Update Profile
                                        </button>
                                        <!-- <a href="change-password.php" class="btn btn-primary">
                                            <i class="fa fa-lock"></i>Change Password
                                        </a> -->
                                    </div>
                                </form>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php include_once 'includes/footer.php'; ?>
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
    
    <script>
        function validateMobileNumber() {
            let mobileField = document.getElementById("mobilenumber");
            mobileField.value = mobileField.value.replace(/[^0-9]/g, "");
            if (mobileField.value.length > 10) {
                mobileField.value = mobileField.value.slice(0, 10);
            }
        }

        function validateEmail() {
            let emailField = document.getElementById("email");
            let emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
            if (!emailPattern.test(emailField.value)) {
                alert("Invalid Email Format! Please enter a valid email.");
                emailField.focus();
                return false;
            }
            return true;
        }

        function validateForm(event) {
            let mobileField = document.getElementById("mobilenumber");
            if (!/^\d{10}$/.test(mobileField.value)) {
                alert("Invalid Mobile Number! Please enter exactly 10 digits.");
                event.preventDefault();
                return false;
            }
            if (!validateEmail()) {
                event.preventDefault();
                return false;
            }
            return true;
        }
    </script>
</body>
</html>