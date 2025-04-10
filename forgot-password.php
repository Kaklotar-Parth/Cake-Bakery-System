<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

// Add this at the top to store alert messages
$alertType = '';
$alertTitle = '';
$alertText = '';

if(isset($_POST['submit']))
  {
    $contactno=$_POST['contactno'];
    $email=$_POST['email'];
$password=md5($_POST['newpassword']);
        $query=mysqli_query($con,"select ID from tbluser where  Email='$email' and MobileNumber='$contactno' ");
        
    $ret=mysqli_num_rows($query);
    if($ret>0){
      $_SESSION['contactno']=$contactno;
      $_SESSION['email']=$email;
      $query1=mysqli_query($con,"update tbladmin set Password='$password'  where  Email='$email' && MobileNumber='$contactno' ");
       if($query1)
   {
$alertType = 'success';
$alertTitle = 'Success!';
$alertText = 'Password has been reset successfully.';
$redirect = true;
   }
     
    }
    else{
    
      $alertType = 'error';
      $alertTitle = 'Invalid Details';
      $alertText = 'Please check your email and contact number.';
    }
  }
  ?>

<!DOCTYPE html>
<html lang="en">
    
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cake Bakery - Reset Password</title>
        
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <!-- SweetAlert2 -->
        <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.10/dist/sweetalert2.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.10/dist/sweetalert2.all.min.js"></script>
        
        <style>
            :root {
                --primary-color: #FF8E9E;
                --secondary-color: #6C63FF;
                --dark-color: #2D3047;
                --light-color: #F9F9F9;
                --accent-color: #FFD93D;
                --text-color: #333333;
                --border-color: rgba(255, 255, 255, 0.1);
                --shadow-color: rgba(0, 0, 0, 0.05);
            }

            body {
                font-family: 'Montserrat', sans-serif;
                color: var(--text-color);
                background-color: #f8f9fa;
            }

            .reset-section {
                padding: 100px 0;
                background-color: white;
            }

            .section-title {
                text-align: center;
                margin-bottom: 60px;
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
                background:#FF6B6B;
                border-radius: 3px;
            }

            .section-title h5 {
                color: var(--text-color);
                font-size: 1.1rem;
                font-weight: 500;
            }

            .reset-form {
                background: white;
                padding: 40px;
                border-radius: 15px;
                box-shadow: 0 5px 15px var(--shadow-color);
            }

            .form-control {
                border: 2px solid #eee;
                border-radius: 50px;
                padding: 15px 25px;
                font-size: 1rem;
                transition: all 0.3s ease;
                margin-bottom: 20px;
            }

            .form-control:focus {
                border-color: var(--primary-color);
                box-shadow: 0 0 0 0.2rem rgba(255, 142, 158, 0.25);
            }

            .reset-btn {
                background:#FF6B6B;
                color: white;
                border: none;
                padding: 15px 30px;
                border-radius: 50px;
                font-weight: 500;
                font-size: 1.1rem;
                transition: all 0.3s ease;
                width: 100%;
                margin-bottom: 20px;
            }

            .reset-btn:hover {
                background: linear-gradient(135deg, var(--secondary-color), var(--primary-color));
                transform: translateY(-2px);
                box-shadow: 0 5px 15px rgba(108, 99, 255, 0.3);
            }

            .action-btn {
                background: white;
                color: var(--primary-color);
                border: 2px solid var(--primary-color);
                padding: 15px 30px;
                border-radius: 50px;
                font-weight: 500;
                font-size: 1.1rem;
                transition: all 0.3s ease;
                width: 100%;
                text-decoration: none;
                display: block;
                text-align: center;
                margin-bottom: 15px;
            }

            .action-btn:hover {
                background: var(--primary-color);
                color: white;
                transform: translateY(-2px);
                box-shadow: 0 5px 15px rgba(255, 142, 158, 0.3);
            }

            .contact-details {
                background: white;
                padding: 40px;
                border-radius: 15px;
                box-shadow: 0 5px 15px var(--shadow-color);
                height: 100%;
            }

            .contact-details h3 {
                color: var(--dark-color);
                font-size: 1.5rem;
                margin-bottom: 20px;
                font-weight: 600;
            }

            .contact-details h5 {
                color: var(--text-color);
                font-size: 1.1rem;
                margin-bottom: 15px;
                font-weight: 500;
            }

            .contact-details p {
                color: var(--text-color);
                line-height: 1.6;
                margin-bottom: 20px;
            }

            @media (max-width: 768px) {
                .reset-section {
                    padding: 60px 0;
                }

                .section-title h2 {
                    font-size: 2rem;
                }

                .reset-form, .contact-details {
                    padding: 30px;
                }
            }

            /* SweetAlert2 Custom Styling */
            .custom-swal {
                font-family: 'Montserrat', sans-serif !important;
                padding: 2em !important;
            }

            .custom-swal .swal2-title {
                color: #2D3047 !important;
                font-size: 24px !important;
                font-weight: 600 !important;
            }

            .custom-swal .swal2-html-container {
                color: #333333 !important;
                font-size: 16px !important;
            }

            .custom-swal .swal2-confirm {
                background: linear-gradient(135deg, #FF8E9E, #6C63FF) !important;
                border: none !important;
                color: white !important;
                border-radius: 50px !important;
                padding: 12px 30px !important;
                font-size: 16px !important;
                font-weight: 500 !important;
                box-shadow: 0 3px 6px rgba(0,0,0,0.1) !important;
            }

            .custom-swal .swal2-confirm:hover {
                background: linear-gradient(135deg, #6C63FF, #FF8E9E) !important;
                transform: translateY(-2px);
                box-shadow: 0 5px 15px rgba(108, 99, 255, 0.3) !important;
            }

            .custom-swal .swal2-cancel {
                background: #fff !important;
                color: #FF8E9E !important;
                border: 2px solid #FF8E9E !important;
                border-radius: 50px !important;
                padding: 12px 30px !important;
                font-size: 16px !important;
                font-weight: 500 !important;
            }

            .custom-swal .swal2-cancel:hover {
                background: #FF8E9E !important;
                color: white !important;
            }

            /* Success Icon Colors */
            .custom-swal .swal2-success {
                border-color: #FF8E9E !important;
            }

            .custom-swal .swal2-success-line-tip,
            .custom-swal .swal2-success-line-long {
                background-color: #FF8E9E !important;
            }

            .custom-swal .swal2-success-ring {
                border-color: rgba(255, 142, 158, 0.3) !important;
            }

            /* Error Icon Colors */
            .custom-swal .swal2-error {
                border-color: #FF8E9E !important;
            }

            .custom-swal .swal2-x-mark-line-left,
            .custom-swal .swal2-x-mark-line-right {
                background-color: #FF8E9E !important;
            }
        </style>
    </head>
    <body>
        
        <!--================Main Header Area =================-->
		<?php include_once('includes/header.php');?>
        <!--================End Main Header Area =================-->
        
        <!--================End Main Header Area =================-->
        <!-- <section class="banner_area">
        	<div class="container">
        		<div class="banner_text">
        			<h3>Reset Password</h3>
        			<ul>
        				<li><a href="index.php">Home</a></li>
        				<li><a href="forgot-password.php">Forgot Password</a></li>
        			</ul>
        		</div>
        	</div>
        </section> -->
        <!--================End Main Header Area =================-->
        
        <!--================Contact Form Area =================-->
        <section class="reset-section">
        	<div class="container">
        		<div class="section-title">
					<h2>Reset Password</h2>
					<h5>Enter your details to reset your password</h5>
				</div>
       			<div class="row justify-content-between">
       				<div class="col-lg-6">
                
       					<div class="reset-form">
                			<form method="post" name="changepassword" onsubmit="return checkpass();">
							<div class="form-group">
								 <input type="email" class="form-control" name="email" placeholder="Enter Your Email" required>
							</div>
             <div class="form-group">
                 <input type="text" class="form-control" name="contactno" placeholder="Contact Number" required pattern="[0-9]{10}" maxlength="10">
              </div>
              <div class="form-group">
                 <input type="password" class="form-control" name="newpassword" placeholder="New Password" required>
              </div>
              <div class="form-group">
                <input type="password" class="form-control" name="confirmpassword" placeholder="Confirm Password" required>
              </div>
              
							<div class="form-group">
								<button type="submit" name="submit" class="reset-btn">
									<i class="fas fa-key me-2"></i>Reset Password
								</button>
							</div>
              <div class="form-group">
                <a href="registration.php" class="action-btn">
                    <i class="fas fa-user-plus me-2"></i>Create New Account
                </a>
              </div>
              <div class="form-group">
                <a href="login.php" class="action-btn">
                    <i class="fas fa-sign-in-alt me-2"></i>Back to Login
                </a>
              </div>
						</form>
            </div>
       				</div>
       				<div class="col-lg-6">
                    <div class="contact-details">
                        <?php
                        $ret = mysqli_query($con, "SELECT * FROM tblpage WHERE PageType='contactus'");
                        while ($row = mysqli_fetch_array($ret)) {
                        ?>
                        <h3>Contact Information</h3>
                        <p><i class="fas fa-map-marker-alt me-2"></i><?php echo $row['PageDescription']; ?></p>
                        <h5><i class="fas fa-phone me-2"></i><?php echo $row['MobileNumber']; ?></h5>
                        <h5><i class="fas fa-envelope me-2"></i><?php echo $row['Email']; ?></h5>
                        <?php }?>
                    </div>
                </div>
            </div>
        </section>
        <!--================End Contact Form Area =================-->
        
        
       
       <?php include_once('includes/footer.php');?>
        
        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <!-- Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        
        <script>
        $(document).ready(function() {
            // Handle PHP alerts
            <?php if ($alertType && $alertTitle && $alertText): ?>
                Swal.fire({
                    icon: '<?php echo $alertType; ?>',
                    title: '<?php echo $alertTitle; ?>',
                    text: '<?php echo $alertText; ?>',
                    customClass: {
                        popup: 'custom-swal',
                        title: 'swal2-title',
                        htmlContainer: 'swal2-html-container',
                        confirmButton: 'swal2-confirm'
                    },
                    showConfirmButton: true,
                    confirmButtonText: '<?php echo $alertType === "success" ? "Login Now" : "Try Again"; ?>',
                    allowOutsideClick: false
                }).then((result) => {
                    <?php if (isset($redirect) && $redirect): ?>
                    if (result.isConfirmed) {
                        window.location.href = 'login.php';
                    }
                    <?php endif; ?>
                });
            <?php endif; ?>

            // Password validation
            function checkpass() {
                var newpass = $('input[name="newpassword"]').val();
                var confpass = $('input[name="confirmpassword"]').val();
                
                if (newpass !== confpass) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Password Mismatch',
                        text: 'New Password and Confirm Password fields do not match',
                        customClass: {
                            popup: 'custom-swal',
                            title: 'swal2-title',
                            htmlContainer: 'swal2-html-container',
                            confirmButton: 'swal2-confirm'
                        }
                    });
                    return false;
                }
                return true;
            }

            // Form validation
            $('form[name="changepassword"]').on('submit', function(e) {
                if (!checkpass()) {
                    e.preventDefault();
                    return false;
                }

                var email = $('input[name="email"]').val();
                var contactno = $('input[name="contactno"]').val();
                var newpass = $('input[name="newpassword"]').val();
                var confpass = $('input[name="confirmpassword"]').val();

                if (!email || !contactno || !newpass || !confpass) {
                    e.preventDefault();
                    Swal.fire({
                        icon: 'warning',
                        title: 'Required Fields',
                        text: 'Please fill in all required fields',
                        customClass: {
                            popup: 'custom-swal',
                            title: 'swal2-title',
                            htmlContainer: 'swal2-html-container',
                            confirmButton: 'swal2-confirm'
                        }
                    });
                    return false;
                }
            });
        });
        </script>
    </body>

</html>