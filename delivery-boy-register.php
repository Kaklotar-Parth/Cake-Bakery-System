<?php
session_start();
include('includes/dbconnection.php');

if(isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = md5($_POST['password']);
    $address = $_POST['address'];
    
    $check_email = mysqli_query($con, "SELECT * FROM tbldeliveryboys WHERE Email='$email'");
    if(mysqli_num_rows($check_email) > 0) {
        echo "<script>alert('Email already exists!');</script>";
    } else {
        $query = mysqli_query($con, "INSERT INTO tbldeliveryboys(Name, Email, Phone, Password, Address, Status) 
                                   VALUES ('$name', '$email', '$phone', '$password', '$address', 'Pending')");
        if($query) {
            echo "<script>alert('Registration successful. Please wait for admin approval.');
            window.location.href='delivery-boy-login.php';</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delivery Boy Registration</title>
    <link href="admin/css/bootstrap.min.css" rel="stylesheet">
    <link href="admin/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="admin/css/animate.css" rel="stylesheet">
    <link href="admin/css/style.css" rel="stylesheet">
</head>
<body class="gray-bg">
    <div class="middle-box loginscreen animated fadeInDown" style="max-width: 500px;">
        <div>
            <div>
                <h1 class="logo-name">CB</h1>
            </div>
            <h3>Register as Delivery Boy</h3>
            
            <form class="m-t" role="form" method="post">
                <div class="form-group">
                    <input type="text" name="name" class="form-control" placeholder="Full Name" pattern="[A-Za-z\s]+" title="Please enter only alphabetic characters" required>
                </div>
                <div class="form-group">
                    <input type="email" name="email" class="form-control" placeholder="Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+" title="Please enter a valid email address" required>
                </div>
                <div class="form-group">
                    <input type="tel" name="phone" class="form-control" placeholder="Phone Number" pattern="[0-9]{10}" title="Please enter a valid 10-digit mobile number" maxlength="10" required>
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                </div>
                <div class="form-group">
                    <textarea name="address" class="form-control" placeholder="Address" rows="3" required></textarea>
                </div>
                <button style="background-color: #0B5ED7; color:white;" type="submit" name="submit" class="btn btn-primary block full-width m-b">Register</button>

                <p class="text-muted text-center">
                    Already have an account? <a href="delivery-boy-login.php">Login</a>
                </p>
                <p class="text-muted text-center">
                    <a href="index.php">Back to Home</a>
                </p>
            </form>
        </div>
    </div>

    <script src="admin/js/jquery-3.1.1.min.js"></script>
    <script src="admin/js/bootstrap.min.js"></script>
</body>
</html>