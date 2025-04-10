<?php
    session_start();
    error_reporting(0);
    include 'includes/dbconnection.php';
    if (strlen($_SESSION['fosaid'] == 0)) {
        header('location:logout.php');
    }
?>

<!DOCTYPE html>
<html>

<head>
    <title>Cake Bakery  | Admin Dashboard</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <style>
        .ibox {
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            margin-bottom: 25px;
            overflow: hidden;
            border: none;
        }
        .ibox:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 25px rgba(0, 0, 0, 0.2);
        }
        .ibox-title {
            border-radius: 15px 15px 0 0;
            padding: 15px;
            color: #fff;
            font-weight: bold;
        }
        .ibox-content {
            padding: 20px;
            background: #fff;
            border-radius: 0 0 15px 15px;
        }
        .ibox-icon {
            font-size: 24px;
            margin-right: 10px;
        }
        .stat-card {
            text-align: center;
            padding: 20px;
        }
        .stat-icon {
            font-size: 50px;
            margin-bottom: 15px;
            color: #fff;
        }
        .stat-value {
            font-size: 36px;
            font-weight: 700;
            color: #fff;
            margin-bottom: 5px;
        }
        .stat-label {
            font-size: 16px;
            color: rgba(255, 255, 255, 0.9);
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .wrapper-content {
            padding: 20px;
        }
        .page-wrapper {
            background: #f8f9fa;
        }
        .dashboard-header {
            background: linear-gradient(135deg, #FF6B6B, #FF8E53);
            color: #fff;
            padding: 25px;
            margin-bottom: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        .dashboard-title {
            font-size: 28px;
            font-weight: 700;
            margin: 0;
        }
        .dashboard-subtitle {
            font-size: 16px;
            opacity: 0.9;
            margin-top: 5px;
        }
        /* Colorful card backgrounds */
        .card-total {
            background: linear-gradient(135deg, #4e54c8, #8f94fb);
        }
        .card-new {
            background: linear-gradient(135deg, #FF6B6B, #FF8E53);
        }
        .card-confirmed {
            background: linear-gradient(135deg, #11998e, #38ef7d);
        }
        .card-preparing {
            background: linear-gradient(135deg, #f46b45, #eea849);
        }
        .card-pickup {
            background: linear-gradient(135deg, #2193b0, #6dd5ed);
        }
        .card-delivered {
            background: linear-gradient(135deg, #11998e, #38ef7d);
        }
        .card-cancelled {
            background: linear-gradient(135deg, #eb3349, #f45c43);
        }
        .card-users {
            background: linear-gradient(135deg, #834d9b, #d04ed6);
        }
        .card-icon {
            position: absolute;
            right: 20px;
            top: 20px;
            font-size: 60px;
            opacity: 0.2;
        }
        .card-content {
            position: relative;
            z-index: 1;
        }
    </style>
</head>

<body>
 <div id="wrapper">
    <?php include_once 'includes/leftbar.php'; ?>

    <div id="page-wrapper" class="gray-bg">
        <?php include_once 'includes/header.php'; ?>
        <!-- <div class="wrapper wrapper-content">
            <div class="dashboard-header">
                <h1 class="dashboard-title">Admin Dashboard</h1>
                <p class="dashboard-subtitle">Welcome to Cake Bakery  Admin Panel</p>
            </div> -->
            <br> 
            <div class="row"> 
                <!-- Total Orders -->
                <div class="col-lg-4">
                    <div class="ibox">
                        <div class="ibox-title card-total">
                            <?php
                                $query      = mysqli_query($con, "SELECT * FROM tblorderaddresses");
                                $totalorder = mysqli_num_rows($query);
                            ?>
                            <a href="all-order.php" style="font-size: 15px; text-decoration: none; color: inherit;">
                                <i class="fa fa-shopping-cart ibox-icon"></i>
                                <strong>Total Cake Orders</strong>
                            </a>
                        </div>
                        <div class="ibox-content card-total">
                            <div class="stat-card card-content">
                                <i class="fa fa-shopping-cart card-icon"></i>
                                <div class="stat-value"><?php echo $totalorder; ?></div>
                                <div class="stat-label">Total Orders</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- New Orders -->
                <div class="col-lg-4">
                    <div class="ibox">
                        <div class="ibox-title card-new">
                            <?php
                                $query1            = mysqli_query($con, "SELECT * FROM tblorderaddresses WHERE OrderFinalStatus IS NULL");
                                $notconfirmedorder = mysqli_num_rows($query1);
                            ?>
                            <a href="all-order.php" style="font-size: 15px; text-decoration: none; color: inherit;">
                                <i class="fa fa-bell ibox-icon"></i>
                                <strong>New Orders</strong>
                            </a>
                        </div>
                        <div class="ibox-content card-new">
                            <div class="stat-card card-content">
                                <i class="fa fa-bell card-icon"></i>
                                <div class="stat-value"><?php echo $notconfirmedorder; ?></div>
                                <div class="stat-label">New Orders</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Confirmed Orders -->
                <div class="col-lg-4">
                    <div class="ibox">
                        <div class="ibox-title card-confirmed">
                            <?php
                                $query2    = mysqli_query($con, "SELECT * FROM tblorderaddresses WHERE OrderFinalStatus = 'Order Confirmed'");
                                $conforder = mysqli_num_rows($query2);
                            ?>
                            <a href="all-order.php" style="font-size: 15px; text-decoration: none; color: inherit;">
                                <i class="fa fa-check-circle ibox-icon"></i>
                                <strong>Confirmed Orders</strong>
                            </a>
                        </div>
                        <div class="ibox-content card-confirmed">
                            <div class="stat-card card-content">
                                <i class="fa fa-check-circle card-icon"></i>
                                <div class="stat-value"><?php echo $conforder; ?></div>
                                <div class="stat-label">Confirmed Orders</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <!--   Being Prepared -->
                <div class="col-lg-4">
                    <div class="ibox">
                        <div class="ibox-title card-preparing">
                            <?php
                                $query3   = mysqli_query($con, "SELECT * FROM tblorderaddresses WHERE OrderFinalStatus = 'Cake being Prepared'");
                                $beingpre = mysqli_num_rows($query3);
                            ?>
                            <a href="all-order.php" style="font-size: 15px; text-decoration: none; color: inherit;">
                                <i class="fa fa-cog ibox-icon"></i>
                                <strong>  Being Prepared</strong>
                            </a>
                        </div>
                        <div class="ibox-content card-preparing">
                            <div class="stat-card card-content">
                                <i class="fa fa-cog card-icon"></i>
                                <div class="stat-value"><?php echo $beingpre; ?></div>
                                <div class="stat-label">  Being Prepared</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--   Pickup -->
                <div class="col-lg-4">
                    <div class="ibox">
                        <div class="ibox-title card-pickup">
                            <?php
                                $query4     = mysqli_query($con, "SELECT * FROM tblorderaddresses WHERE OrderFinalStatus = 'Cake Pickup'");
                                $cakepickup = mysqli_num_rows($query4);
                            ?>
                            <a href="all-order.php" style="font-size: 15px; text-decoration: none; color: inherit;">
                                <i class="fa fa-truck ibox-icon"></i>
                                <strong>  Pickup</strong>
                            </a>
                        </div>
                        <div class="ibox-content card-pickup">
                            <div class="stat-card card-content">
                                <i class="fa fa-truck card-icon"></i>
                                <div class="stat-value"><?php echo $cakepickup; ?></div>
                                <div class="stat-label">  Pickup</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--   Delivered -->
                <div class="col-lg-4">
                    <div class="ibox">
                        <div class="ibox-title card-delivered">
                            <?php
                                $query5        = mysqli_query($con, "SELECT * FROM tblorderaddresses WHERE OrderFinalStatus = 'Cake Delivered'");
                                $cakedelivered = mysqli_num_rows($query5);
                            ?>
                            <a href="all-order.php" style="font-size: 15px; text-decoration: none; color: inherit;">
                                <i class="fa fa-check ibox-icon"></i>
                                <strong>Total   Delivered</strong>
                            </a>
                        </div>
                        <div class="ibox-content card-delivered">
                            <div class="stat-card card-content">
                                <i class="fa fa-check card-icon"></i>
                                <div class="stat-value"><?php echo $cakedelivered; ?></div>
                                <div class="stat-label">Total   Delivered</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Cancelled Orders -->
                <div class="col-lg-4">
                    <div class="ibox">
                        <div class="ibox-title card-cancelled">
                            <?php
                                $query6         = mysqli_query($con, "SELECT * FROM tblorderaddresses WHERE OrderFinalStatus = 'Order Cancelled'");
                                $cancelledorder = mysqli_num_rows($query6);
                            ?>
                            <a href="all-order.php" style="font-size: 15px; text-decoration: none; color: inherit;">
                                <i class="fa fa-times-circle ibox-icon"></i>
                                <strong>Cancelled Orders</strong>
                            </a>
                        </div>
                        <div class="ibox-content card-cancelled">
                            <div class="stat-card card-content">
                                <i class="fa fa-times-circle card-icon"></i>
                                <div class="stat-value"><?php echo $cancelledorder; ?></div>
                                <div class="stat-label">Cancelled Orders</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Registered Users -->
                <div class="col-lg-4">
                    <div class="ibox">
                        <div class="ibox-title card-users">
                            <?php
                                $query7    = mysqli_query($con, "SELECT * FROM tbluser");
                                $usercount = mysqli_num_rows($query7);
                            ?>
                            <a href="all-order.php" style="font-size: 15px; text-decoration: none; color: inherit;">
                                <i class="fa fa-users ibox-icon"></i>
                                <strong>Total Registered Users</strong>
                            </a>
                        </div>
                        <div class="ibox-content card-users">
                            <div class="stat-card card-content">
                                <i class="fa fa-users card-icon"></i>
                                <div class="stat-value"><?php echo $usercount; ?></div>
                                <div class="stat-label">Total Registered Users</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
   
</div>


    <!-- Mainly scripts -->
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Flot -->
    <script src="js/plugins/flot/jquery.flot.js"></script>
    <script src="js/plugins/flot/jquery.flot.tooltip.min.js"></script>
    <script src="js/plugins/flot/jquery.flot.spline.js"></script>
    <script src="js/plugins/flot/jquery.flot.resize.js"></script>
    <script src="js/plugins/flot/jquery.flot.pie.js"></script>
    <script src="js/plugins/flot/jquery.flot.symbol.js"></script>
    <script src="js/plugins/flot/jquery.flot.time.js"></script>

    <!-- Peity -->
    <script src="js/plugins/peity/jquery.peity.min.js"></script>
    <script src="js/demo/peity-demo.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="js/inspinia.js"></script>
    <script src="js/plugins/pace/pace.min.js"></script>

    <!-- jQuery UI -->
    <script src="js/plugins/jquery-ui/jquery-ui.min.js"></script>

    <!-- Jvectormap -->
    <script src="js/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>

    <!-- EayPIE -->
    <script src="js/plugins/easypiechart/jquery.easypiechart.js"></script>

    <!-- Sparkline -->
    <script src="js/plugins/sparkline/jquery.sparkline.min.js"></script>

    <!-- Sparkline demo data  -->
    <script src="js/demo/sparkline-demo.js"></script>

</body>
</html>
