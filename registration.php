<?php
    session_start();
    error_reporting(0);
    include 'includes/dbconnection.php';
    if (isset($_POST['submit'])) {
        $fname    = $_POST['firstname'];
        $lname    = $_POST['lastname'];
        $contno   = $_POST['mobilenumber'];
        $email    = $_POST['email'];
        $password = md5($_POST['password']);

        $ret    = mysqli_query($con, "select Email from tbluser where Email='$email' || MobileNumber='$contno'");
        $result = mysqli_fetch_array($ret);
        if ($result > 0) {
            ?>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Registration Failed',
                        text: 'This email or Contact Number already associated with another account',
                        confirmButtonColor: '#FF8E9E'
                    });
                });
            </script>
            <?php
            $msg = "This email or Contact Number already associated with another account";
        } else {
            $query = mysqli_query($con, "insert into tbluser(FirstName, LastName, MobileNumber, Email, Password) value('$fname', '$lname','$contno', '$email', '$password' )");
            if ($query) {
                ?>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            icon: 'success',
                            title: 'Registration Successful',
                            text: 'Your account has been created successfully!',
                            confirmButtonColor: '#FF8E9E'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = "registrationemail.php?email=<?php echo $email; ?>";
                            }
                        });
                    });
                </script>
                <?php
            } else {
                ?>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Registration Failed',
                            text: 'Something Went Wrong. Please try again',
                            confirmButtonColor: '#FF8E9E'
                        });
                    });
                </script>
                <?php
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cake bakery - Sign Up</title>
    
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

        .registration-section {
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
             background-color: #FF6B6B;
            border-radius: 3px;
        }

        .section-title h5 {
            color: var(--text-color);
            font-size: 1.1rem;
            font-weight: 500;
        }

        .registration-form {
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

        .submit-btn {
             background-color: #FF6B6B;
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

        .submit-btn:hover {
            background: linear-gradient(135deg, var(--secondary-color), var(--primary-color));
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(108, 99, 255, 0.3);
        }

        .login-btn {
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
        }

        .login-btn:hover {
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

        .error-message {
            color: #dc3545;
            text-align: center;
            margin-bottom: 20px;
            font-size: 1rem;
        }

        @media (max-width: 768px) {
            .registration-section {
                padding: 60px 0;
            }

            .section-title h2 {
                font-size: 2rem;
            }

            .registration-form, .contact-details {
                padding: 30px;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <?php include_once('includes/header.php');?>

    <!-- Registration Section -->
    <section class="registration-section">
        <div class="container">
            <div class="section-title">
                <h2>Create Account</h2>
                <h5>Join our cake community today!</h5>
            </div>

            <div class="row">
                <div class="col-lg-7">
                    <div class="registration-form">
                        <?php if (isset($msg)) { ?>
                            <div class="error-message"><?php echo $msg; ?></div>
                        <?php } ?>
                        <form name="signup" method="post" onsubmit="return checkpass();">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="firstname" name="firstname" 
                                               placeholder="First Name" required pattern="[A-Za-z]+" 
                                               title="Please enter letters only" maxlength="15">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="lastname" name="lastname" 
                                               placeholder="Last Name" required pattern="[A-Za-z]+" 
                                               title="Please enter letters only" maxlength="15">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="mobilenumber" name="mobilenumber" 
                                               placeholder="Mobile Number" required pattern="[0-9]{10}" 
                                               maxlength="10">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="email" class="form-control" id="email" name="email" 
                                               placeholder="Email Address" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="password" class="form-control" id="password" name="password" 
                                               placeholder="Password" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="password" class="form-control" id="repeatpassword" 
                                               name="repeatpassword" placeholder="Repeat Password" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" name="submit" class="submit-btn">
                                    <i class="fas fa-user-plus me-2"></i>Create Account
                                </button>
                            </div>
                            <div class="form-group">
                                <a href="login.php" class="login-btn">
                                    <i class="fas fa-sign-in-alt me-2"></i>Already Have an Account?
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-5">
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
        </div>
    </section>

    <!-- Footer -->
    <?php include_once('includes/footer.php');?>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        function checkpass() {
            if(document.signup.password.value != document.signup.repeatpassword.value) {
                Swal.fire({
                    icon: 'error',
                    title: 'Password Mismatch',
                    text: 'Password and Repeat Password fields do not match',
                    confirmButtonColor: '#FF8E9E'
                });
                document.signup.repeatpassword.focus();
                return false;
            }
            return true;
        }

        // Allow only letters in name fields
        document.getElementById('firstname').addEventListener('input', function(e) {
            this.value = this.value.replace(/[^A-Za-z]/g, '');
        });

        document.getElementById('lastname').addEventListener('input', function(e) {
            this.value = this.value.replace(/[^A-Za-z]/g, '');
        });

        // Initialize all dropdowns
        $(document).ready(function(){
            var dropdownElementList = [].slice.call(document.querySelectorAll('[data-bs-toggle="dropdown"]'));
            var dropdownList = dropdownElementList.map(function (dropdownToggleEl) {
                return new bootstrap.Dropdown(dropdownToggleEl);
            });
        });
    </script>
</body>
</html>