<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['fosuid']==0)) {
    header('location:logout.php');
} else {
    if(isset($_POST['submit'])) {
        $userid = $_SESSION['fosuid'];
        $cpassword = md5($_POST['currentpassword']);
        $newpassword = md5($_POST['newpassword']);
        $query = mysqli_query($con, "select ID from tbluser where ID='$userid' and Password='$cpassword'");
        $row = mysqli_fetch_array($query);
        if($row > 0) {
            $ret = mysqli_query($con, "update tbluser set Password='$newpassword' where ID='$userid'");
            $msg = "Your password has been changed successfully!";
            $msgClass = "success";
        } else {
            $msg = "Your current password is incorrect";
            $msgClass = "error";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cake bakery  - Change Password</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.min.css">

    <style>
        :root {
            --primary-color: #FF8E9E;
            --secondary-color: #6C63FF;
            --dark-color: #2D3047;
            --light-color: #F9F9F9;
            --accent-color: #FFD93D;
            --text-color: #333333;
            --border-color: rgba(0, 0, 0, 0.1);
            --shadow-color: rgba(0, 0, 0, 0.05);
        }

        body {
            font-family: 'Montserrat', sans-serif;
            color: var(--text-color);
            background-color: #f8f9fa;
        }

        .password-section {
            padding: 80px 0;
            background-color: white;
        }

        .section-title {
            text-align: center;
            margin-bottom: 50px;
        }

        .section-title h2 {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--dark-color);
            margin-bottom: 15px;
            position: relative;
            display: inline-block;
        }

        .section-title h2::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
             background-color: #FF6B6B;
            border-radius: 3px;
        }

        .section-title h5 {
            color: var(--text-color);
            font-size: 1.1rem;
            font-weight: 500;
        }

        .password-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 15px var(--shadow-color);
            padding: 30px;
            margin-bottom: 30px;
        }

        .form-label {
            color: var(--dark-color);
            font-weight: 500;
            margin-bottom: 8px;
        }

        .form-control {
            border: 1px solid var(--border-color);
            border-radius: 10px;
            padding: 12px 15px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(255, 142, 158, 0.25);
        }

        .submit-btn {
             background-color: #FF6B6B;
            color: white;
            border: none;
            border-radius: 50px;
            padding: 12px 30px;
            font-size: 1rem;
            font-weight: 500;
            transition: all 0.3s ease;
            width: 100%;
            margin-top: 20px;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(108, 99, 255, 0.3);
        }

        .contact-info-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 15px var(--shadow-color);
            padding: 30px;
            height: 100%;
        }

        .contact-info-card h3 {
            color: var(--dark-color);
            font-size: 1.5rem;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #eee;
        }

        .contact-item {
            margin-bottom: 20px;
        }

        .contact-item h5 {
            color: var(--dark-color);
            font-size: 1.1rem;
            margin-bottom: 10px;
        }

        .contact-item p {
            color: var(--text-color);
            margin-bottom: 0;
        }

        .contact-item i {
            color: var(--primary-color);
            margin-right: 10px;
        }

        .alert {
            border-radius: 10px;
            padding: 15px 20px;
            margin-bottom: 30px;
            border: none;
            font-weight: 500;
        }

        .alert-success {
            background-color: #D4EDDA;
            color: #155724;
        }

        .alert-error {
            background-color: #F8D7DA;
            color: #721C24;
        }

        .password-requirements {
            margin-top: 15px;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 10px;
            font-size: 0.9rem;
            color: var(--text-color);
        }

        .password-requirements ul {
            margin-bottom: 0;
            padding-left: 20px;
        }

        .password-requirements li {
            margin-bottom: 5px;
        }

        .password-requirements li i {
            color: var(--primary-color);
            margin-right: 5px;
        }

        @media (max-width: 991.98px) {
            .password-section {
                padding: 60px 0;
            }

            .contact-info-card {
                margin-top: 30px;
            }
        }

        @media (max-width: 767.98px) {
            .section-title h2 {
                font-size: 2rem;
            }

            .password-card, .contact-info-card {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <?php include_once('includes/header.php');?>

    <section class="password-section">
        <div class="container">
            <div class="section-title">
                <h2>Change Password</h2>
                <h5>Update your account password</h5>
            </div>

            <?php if (isset($msg)) { ?>
                <div class="alert alert-<?php echo $msgClass; ?>">
                    <?php echo $msg; ?>
                </div>
            <?php } ?>

            <div class="row">
                <div class="col-lg-7">
                    <div class="password-card">
                        <form action="" method="post" name="changepassword" onsubmit="return checkpass();">
                            <div class="mb-3">
                                <label class="form-label">
                                    <i class="fas fa-lock me-2"></i>Current Password
                                </label>
                                <input type="password" class="form-control" id="currentpassword" 
                                       name="currentpassword" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">
                                    <i class="fas fa-key me-2"></i>New Password
                                </label>
                                <input type="password" class="form-control" id="newpassword" 
                                       name="newpassword" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">
                                    <i class="fas fa-key me-2"></i>Confirm Password
                                </label>
                                <input type="password" class="form-control" id="confirmpassword" 
                                       name="confirmpassword" required>
                            </div>

                            <!-- <div class="password-requirements">
                                <h6 class="mb-3">Password Requirements:</h6>
                                <ul>
                                    <li><i class="fas fa-check-circle"></i>Must be at least 8 characters long</li>
                                    <li><i class="fas fa-check-circle"></i>Should include uppercase and lowercase letters</li>
                                    <li><i class="fas fa-check-circle"></i>Should include numbers and special characters</li>
                                </ul>
                            </div> -->

                            <button type="submit" name="submit" class="submit-btn">
                                <i class="fas fa-save me-2"></i>Update Password
                            </button>
                        </form>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="contact-info-card">
                        <?php
                        $ret = mysqli_query($con, "select * from tblpage where PageType='contactus'");
                        while ($row = mysqli_fetch_array($ret)) {
                        ?>
                        <h3>Contact Information</h3>
                        <div class="contact-item">
                            <h5><i class="fas fa-map-marker-alt"></i>Address</h5>
                            <p><?php echo $row['PageDescription']; ?></p>
                        </div>
                        <div class="contact-item">
                            <h5><i class="fas fa-phone"></i>Phone</h5>
                            <p><?php echo $row['MobileNumber']; ?></p>
                        </div>
                        <div class="contact-item">
                            <h5><i class="fas fa-envelope"></i>Email</h5>
                            <p><?php echo $row['Email']; ?></p>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include_once('includes/footer.php');?>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.all.min.js"></script>

    <script>
        function checkpass() {
            if(document.changepassword.newpassword.value != document.changepassword.confirmpassword.value) {
                Swal.fire({
                    icon: 'error',
                    title: 'Password Mismatch',
                    text: 'New Password and Confirm Password fields do not match',
                    confirmButtonColor: '#FF8E9E'
                });
                document.changepassword.confirmpassword.focus();
                return false;
            }
            return true;
        }
    </script>
</body>
</html>
<?php } ?>