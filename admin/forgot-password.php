<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if(isset($_POST['submit']))
  {
    $contactno=$_POST['contactno'];
    $email=$_POST['email'];

        $query=mysqli_query($con,"select ID from tbladmin where  Email='$email' and MobileNumber='$contactno' ");
    $ret=mysqli_fetch_array($query);
    if($ret>0){
      $_SESSION['contactno']=$contactno;
      $_SESSION['email']=$email;
     
     echo "<script type='text/javascript'> document.location ='resetpassword.php'; </script>";
    }
    else{
      echo "<script>alert('Invalid Details. Please try again.');</script>";
    }
  }
  ?>
<!DOCTYPE html>
<html>

<head>
    <title>Cake Bakery System| Admin Forgot Password</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            padding: 40px;
            width: 100%;
            max-width: 450px;
            margin: 20px;
        }
        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .login-header h2 {
            color: #2c3e50;
            font-size: 28px;
            margin-bottom: 10px;
        }
        .login-header i {
            font-size: 48px;
            color: #3498db;
            margin-bottom: 15px;
        }
        .form-group {
            margin-bottom: 20px;
            position: relative;
        }
        .form-group i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #95a5a6;
        }
        .form-control {
            height: 50px;
            border-radius: 8px;
            border: 1px solid #e1e1e1;
            padding: 10px 15px 10px 45px;
            font-size: 16px;
            transition: all 0.3s ease;
        }
        .form-control:focus {
            border-color: #3498db;
            box-shadow: 0 0 0 0.2rem rgba(52,152,219,0.25);
        }
        .form-control:focus + i {
            color: #3498db;
        }
        .btn-primary {
            height: 50px;
            border-radius: 8px;
            background: #3498db;
            border: none;
            font-size: 16px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            background: #2980b9;
            transform: translateY(-2px);
        }
        .btn-primary i {
            margin-right: 8px;
        }
        .back-to-login {
            text-align: center;
            margin-top: 20px;
        }
        .back-to-login a {
            color: #2c3e50;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .back-to-login i {
            font-size: 20px;
        }
        .error-message {
            color: #e74c3c;
            text-align: center;
            margin-bottom: 20px;
            font-size: 14px;
        }
    </style>

</head>

<body class="gray-bg">

    <div class="login-container animated fadeInDown">
        <div class="login-header">
            <!-- <i class="fa fa-key"></i> -->
            <h2>Reset Password</h2>
            <p class="text-muted">Enter your email and mobile number to reset your password</p>
        </div>
        
        <?php if(isset($msg)){ ?>
            <div class="error-message">
                <i class="fa fa-exclamation-circle"></i> <?php echo $msg; ?>
            </div>
        <?php } ?>

        <form role="form" action="" method="post" name="submit">
            <div class="form-group">
                <input type="email" class="form-control" placeholder="Email Address" name="email" required="">
                <i class="fa fa-envelope"></i>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Mobile Number" name="contactno" maxlength="10" pattern="[0-9]{10}" required="">
                <i class="fa fa-phone"></i>
            </div>
            <button type="submit" class="btn btn-primary btn-block" name="submit">
                <i class="fa fa-refresh"></i>
                 Reset Password
            </button>
        </form>

        <div class="back-to-login">
            <a href="index.php">
                <i class="fa fa-arrow-left"></i>
                Back to Login
            </a>
        </div>
    </div>

<?php include_once('includes/footer.php');?>
</body>

</html>
