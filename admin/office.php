<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cake Bakery Admin Panel</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        .sidebar {
            height: 100vh;
            width: 250px;
            background-color: #343a40;
            position: fixed;
            padding-top: 20px;
        }
        .sidebar a {
            padding: 15px 20px;
            text-decoration: none;
            color: #fff;
            display: block;
        }
        .sidebar a:hover {
            background-color: #007bff;
           
        }
        .content {
            margin-left: 250px;
            padding: 20px;
        }
        .card {
            margin-bottom: 20px;
        }
        .card i {
            font-size: 30px;
        }
        .view-all {
            text-decoration: none;
            color: #007bff;
        }
    </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <h4 class="text-white text-center">Cake Bakery</h4>
    <a href="dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
    <a href="user-detail.php"><i class="fas fa-users"></i> Registered Users</a>
    <a href="#"><i class="fas fa-cake"></i> Cake Category</a>
    <a href="add-cake.php"><i class="fas fa-plus-circle"></i> Add Cake</a>
    <a href="manage-cake.php"><i class="fas fa-edit"></i> Manage Cakes</a>
    <a href="#"><i class="fas fa-list"></i> Orders</a>
    <a href="notconfirmedyet.php"><i class="fas fa-hourglass-start"></i> Not Confirmed</a>
    <a href="confirmed-order.php"><i class="fas fa-check-circle"></i> Confirmed Orders</a>
    <a href="cakebeingprepared.php"><i class="fas fa-birthday-cake"></i> Cake Being Prepared</a>
    <a href="cake-pickup.php"><i class="fas fa-truck"></i> Cake Pickup</a>
    <a href="cake-delivered.php"><i class="fas fa-gift"></i> Cake Delivered</a>
    <a href="canclled-order.php"><i class="fas fa-ban"></i> Cancelled Orders</a>
    <a href="all-order.php"><i class="fas fa-list-alt"></i> All Orders</a>
    <a href="subcriber.php"><i class="fas fa-users"></i> Subscribers</a>
    <a href="aboutus.php"><i class="fas fa-info-circle"></i> About Us</a>
    <a href="contactus.php"><i class="fas fa-envelope"></i> Contact Us</a>
    <a href="readenq.php"><i class="fas fa-eye"></i> Read Enquiries</a>
    <a href="unreadenq.php"><i class="fas fa-envelope-open"></i> Unread Enquiries</a>
    <a href="bwdates-report-ds.php"><i class="fas fa-chart-bar"></i> Reports</a>
    <a href="search.php"><i class="fas fa-search"></i> Search</a>
    <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
</div>

<!-- Content -->
<div class="content">
    <div class="text-right mb-3">

    </div>
</div>


<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>



<li>
    <a href="dashboard.php"><i class="fa fa-home"></i> <span class="nav-label">Dashboard</span></a>
</li>
<li>
    <a href="user-detail.php"><i class="fa fa-users"></i> <span class="nav-label">Reg Users</span></a>
</li>
<li>
    <a href="#"><i class="fa fa-folder-open"></i> <span class="nav-label">Cake Category</span><span class="fa arrow"></span></a>
    <ul class="nav nav-second-level collapse">
        <li><a href="add-cakecategory.php">Add Cake Category</a></li>
        <li><a href="manage-cakecategory.php">Manage Cake Category</a></li>
    </ul>
</li>
<li>
    <a href="#"><i class="fa fa-birthday-cake"></i> <span class="nav-label">Cake Menu</span><span class="fa arrow"></span></a>
    <ul class="nav nav-second-level collapse">
        <li><a href="add-cake.php">Add Cake</a></li>
        <li><a href="manage-cake.php">Manage Cake</a></li>
    </ul>
</li>
<li>
    <a href="#"><i class="fa fa-list-alt"></i> <span class="nav-label">Orders</span><span class="fa arrow"></span></a>
    <ul class="nav nav-second-level collapse">
        <li><a href="notconfirmedyet.php">Not Confirmed Yet</a></li>
        <li><a href="confirmed-order.php">Order Confirmed</a></li>
        <li><a href="cakebeingprepared.php">Cake Being Prepared</a></li>
        <li><a href="cake-pickup.php">Cake Pickup</a></li>
        <li><a href="cake-delivered.php">Cake Delivered</a></li>
        <li><a href="canclled-order.php">Cancelled</a></li>
        <li><a href="all-order.php">All Orders</a></li>
    </ul>
</li>
<li>
    <a href="subcriber.php"><i class="fa fa-users"></i> <span class="nav-label">Subscriber</span></a>
</li>
<li>
    <a href="#"><i class="fa fa-file-text"></i> <span class="nav-label">Pages</span><span class="fa arrow"></span></a>
    <ul class="nav nav-second-level collapse">
        <li><a href="aboutus.php">About Us</a></li>
        <li><a href="contactus.php">Contact Us</a></li>
    </ul>
</li>
<li>
    <a href="#"><i class="fa fa-envelope"></i> <span class="nav-label">Enquiry</span><span class="fa arrow"></span></a>
    <ul class="nav nav-second-level collapse">
        <li><a href="readenq.php">Read Enquiry</a></li>
        <li><a href="unreadenq.php">Unread Enquiry</a></li>
    </ul>
</li>
<li>
    <a href="#"><i class="fa fa-bar-chart"></i> <span class="nav-label">Reports</span><span class="fa arrow"></span></a>
    <ul class="nav nav-second-level collapse">
        <li><a href="bwdates-report-ds.php">B/w Dates</a></li>
        <li><a href="requestcount-report-ds.php">Order Count</a></li>
        <li><a href="sales-reports.php">Sales Reports</a></li>
    </ul>
</li>
<li>
    <a href="search.php"><i class="fa fa-search"></i> <span class="nav-label">Search</span></a>
</li>
