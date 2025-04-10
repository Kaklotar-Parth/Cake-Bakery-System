<?php
    session_start();
    error_reporting(0);
    include 'includes/dbconnection.php';

    // Add this at the top of your PHP file to store messages
    $alertType = '';
    $alertTitle = '';
    $alertText = '';

    if (isset($_POST['login'])) {
        $emailcon = mysqli_real_escape_string($con, $_POST['emailcont']);
        $password = md5($_POST['password']);

        // Check if user exists and is active using prepared statements
        $stmt = $con->prepare("SELECT ID, status FROM tbluser WHERE (Email=? OR MobileNumber=?) AND Password=?");
        $stmt->bind_param("sss", $emailcon, $emailcon, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        $ret    = $result->fetch_assoc();

        if ($ret) {
            if ($ret['status'] === 'active') {
                $_SESSION['fosuid'] = $ret['ID'];
                $alertType = 'success';
                $alertTitle = 'Success!';
                $alertText = 'Login successful! Welcome back.';
            } else {
                $alertType = 'error';
                $alertTitle = 'Account Inactive';
                $alertText = 'Your account has been deleted by admin.';
            }
        } else {
            $alertType = 'error';
            $alertTitle = 'Invalid Details';
            $alertText = 'Invalid email or password.';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cake Bakery - Sign In</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- SweetAlert2 -->
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-minimal@5/minimal.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
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

        .login-section {
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

        .login-form {
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

        .login-btn {
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

        .login-btn:hover {
            background: linear-gradient(135deg, var(--secondary-color), var(--primary-color));
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(108, 99, 255, 0.3);
        }

        .register-btn {
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

        .register-btn:hover {
            background: var(--primary-color);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 142, 158, 0.3);
        }

        .forgot-password {
            color: var(--primary-color);
            text-decoration: none;
            font-size: 0.9rem;
            margin-bottom: 20px;
            display: block;
            text-align: right;
            transition: color 0.3s ease;
        }

        .forgot-password:hover {
            color: var(--secondary-color);
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
            .login-section {
                padding: 60px 0;
            }

            .section-title h2 {
                font-size: 2rem;
            }

            .login-form, .contact-details {
                padding: 30px;
            }
        }

        /* SweetAlert2 */
        .swal2-popup {
            font-family: 'Montserrat', sans-serif !important;
            border-radius: 15px !important;
            padding: 2em !important;
        }

        .swal2-title {
            color: #2D3047 !important;
            font-weight: 600 !important;
            font-size: 1.5rem !important;
        }

        .swal2-html-container {
            font-family: 'Montserrat', sans-serif !important;
            color: #333333 !important;
        }

        .swal2-success-ring {
            border: 0.25em solid rgba(255, 142, 158, 0.3) !important;
        }

        .swal2-success-line-tip,
        .swal2-success-line-long {
            background-color: #FF8E9E !important;
        }

        .swal2-success-circular-line-right,
        .swal2-success-circular-line-left,
        .swal2-success-fix {
            background-color: transparent !important;
        }

        .swal2-loader {
            border-color: #FF8E9E transparent #FF8E9E transparent !important;
        }

        @keyframes swal2-rotate-loading {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }

        /* SweetAlert2 Custom Styling */
        .custom-swal {
            font-family: 'Montserrat', sans-serif !important;
        }

        .custom-swal .swal2-title {
            color: #2D3047;
            font-size: 24px;
            font-weight: 600;
        }

        .custom-swal .swal2-html-container {
            color: #333333;
            font-size: 16px;
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

        .custom-swal .swal2-timer-progress-bar {
            background: #FF8E9E !important;
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

        .custom-swal .swal2-error-x {
            background-color: #FF8E9E !important;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <?php include_once('includes/header.php');?>

    <!-- Login Section -->
    <section class="login-section">
        <div class="container">
            <div class="section-title">
                <h2>Sign In</h2>
                <h5>Welcome back! Please login to your account.</h5>
            </div>

            <div class="row">
                <div class="col-lg-7">
                    <div class="login-form">
                        <form method="post">
                            <div class="form-group">
                                <input type="text" class="form-control" name="emailcont" 
                                       placeholder="Registered Email or Contact Number" required>
                            </div>
                            <a href="forgot-password.php" class="forgot-password">Forgot Password?</a>
                            <div class="form-group">
                                <input type="password" class="form-control" name="password" 
                                       placeholder="Password" required>
                            </div>
                            <div class="form-group">
                                <button type="submit" name="login" class="login-btn">
                                    <i class="fas fa-sign-in-alt me-2"></i>Login
                                </button>
                            </div>
                            <div class="form-group">
                                <a href="registration.php" class="register-btn">
                                    <i class="fas fa-user-plus me-2"></i>Register
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
        $(document).ready(function(){
            // Initialize all dropdowns
            var dropdownElementList = [].slice.call(document.querySelectorAll('[data-bs-toggle="dropdown"]'));
            var dropdownList = dropdownElementList.map(function (dropdownToggleEl) {
                return new bootstrap.Dropdown(dropdownToggleEl);
            });
        });
    </script>

    <script>
    $(document).ready(function() {
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
                showConfirmButton: <?php echo $alertType === 'error' ? 'true' : 'false'; ?>,
                confirmButtonText: <?php echo $alertType === 'error' ? "'Try Again'" : 'null'; ?>,
                timer: <?php echo $alertType === 'success' ? '2000' : 'null'; ?>,
                timerProgressBar: <?php echo $alertType === 'success' ? 'true' : 'false'; ?>,
                allowOutsideClick: false,
                didOpen: () => {
                    <?php if ($alertType === 'success'): ?>
                        setTimeout(() => {
                            window.location.href = 'index.php';
                        }, 2000);
                    <?php endif; ?>
                }
            });
        <?php endif; ?>

        // Add this for form validation
        $('form').on('submit', function(e) {
            var emailcont = $('input[name="emailcont"]').val();
            var password = $('input[name="password"]').val();

            if (!emailcont || !password) {
                e.preventDefault();
                Swal.fire({
                    icon: 'warning',
                    title: 'Required Fields',
                    text: 'Please fill in all required fields.',
                    customClass: {
                        popup: 'custom-swal',
                        title: 'swal2-title',
                        htmlContainer: 'swal2-html-container',
                        confirmButton: 'swal2-confirm'
                    }
                });
            }
        });
    });
    </script>
</body>
</html>