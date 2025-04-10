<?php
session_start();
include('includes/dbconnection.php');

if(isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']);   
    
    $query = mysqli_query($con, "SELECT * FROM tbldeliveryboys WHERE Email='$email' AND Password='$password'");
    if(mysqli_num_rows($query) > 0) {
        $row = mysqli_fetch_array($query);
        if($row['Status'] == 'Approved') {
            $_SESSION['delivery_boy_id'] = $row['ID'];
            $_SESSION['delivery_boy_name'] = $row['Name'];
            header('location: delivery-boy/dashboard.php');
        } else {
            echo "<script>alert('Your account is not approved yet or has been rejected.');</script>";
        }
    } else {
        echo "<script>alert('Invalid credentials');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delivery Boy Login</title>
    <link href="admin/css/bootstrap.min.css" rel="stylesheet">
    <link href="admin/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="admin/css/animate.css" rel="stylesheet">
    <link href="admin/css/style.css" rel="stylesheet">
</head>
<body class="gray-bg">
    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>
                <h1 class="logo-name">CB</h1>
            </div>
            <h3>Delivery Boy Login</h3>
            
            <form class="m-t" role="form" method="post">
                <div class="form-group">
                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                </div>
                <button style="background-color: #0B5ED7; color:white;" type="submit" name="login" class="btn btn-primary block full-width m-b">Login</button>

                <p class="text-muted text-center">
                    <a href="delivery-boy-register.php">Register as Delivery Boy</a>
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