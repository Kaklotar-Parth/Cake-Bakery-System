<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

</head>
<body>

</body>
</html>
<nav  class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul style="  background: #343A40 !important"; class="nav metismenu" id="side-menu">
            <li style="  background: #343A40 !important"; class="nav-header">
                <div class="dropdown profile-element">
                    <!-- Admin Logo Fixed -->
                    <img alt="Admin Logo" class="img-fluid"
                        src="/new cake/cake/images.jpeg"
                        onerror="this.onerror=null; this.src='/new cake/cake/images.jpeg';"
                        style="width: 50px; height: 50px; margin-bottom: 10px;margin-left: 45px;" />


                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <?php
                            if (session_status() == PHP_SESSION_NONE) {
                                session_start();
                            } // Ensure session is started
                            $admid = $_SESSION['fosaid'];
                            $ret   = mysqli_query($con, "SELECT AdminName FROM tbladmin WHERE ID='$admid'");
                            $row   = mysqli_fetch_array($ret);
                            $name  = $row['AdminName'];
                        ?>
                        <span class="text-muted text-xs block"  style="margin-left: 18px;">
                            Welcome,                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     <?php echo htmlspecialchars($name); ?> <b class="caret"></b>
                        </span>
                    </a>

                    <ul id="adminmenu" class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a class="dropdown-item" href="adminprofile.php">Profile</a></li>
                        <li><a class="dropdown-item" href="changepassword.php">Change Password</a></li>
                        <li class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                    </ul>
                </div>

                <div class="logo-element">
                    <!-- Mini Logo Fixed -->
                    <img src="img/image.png" alt="Mini Logo"
                        onerror="this.onerror=null; this.src='img/default-mini-logo.png';"
                        style="width: 40px; height: auto;" />
                </div>
            </li>

            <!-- Sidebar Menu -->
            <li>
                <a href="dashboard.php"><i class="fa fa-home"></i> <span class="nav-label">Dashboard</span></a>
            </li>
            <li>
                <a href="user-detail.php"><i class="fa fa-users"></i> <span class="nav-label">Reg Users</span></a>
            </li>
            <li style="  background: #343A40 !important";>
                <a href="#"><i class="fa fa-folder-open"></i> <span  class="nav-label">Cake Category</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                <li  ><a href="add-cakecategory.php"><i class="fa fa-plus-circle"></i> Add Category</a></li>
                <li><a href="manage-cakecategory.php"><i class="fa fa-list"></i> Manage Categories</a></li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-birthday-cake"></i> <span class="nav-label">Cake Menu</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                <li><a href="add-cake.php"><i class="fa fa-plus"></i> Add Cake</a></li>
                <li><a href="manage-cake.php"><i class="fa fa-tasks"></i> Manage Cakes</a></li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-list-alt"></i> <span class="nav-label">Orders</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                <li><a href="notconfirmedyet.php"><i class="fa fa-clock-o"></i> Pending Orders</a></li>
                    <li><a href="confirmed-order.php"><i class="fa fa-check"></i> Confirmed</a></li>
                    <li><a href="cakebeingprepared.php"><i class="fa fa-cog fa-spin"></i> In Preparation</a></li>
                    <li><a href="cake-pickup.php"><i class="fa fa-truck"></i> Ready for Pickup</a></li>
                    <li><a href="cake-delivered.php"><i class="fa fa-check-circle"></i> Delivered</a></li>
                    <li><a href="canclled-order.php"><i class="fa fa-times-circle"></i> Cancelled</a></li>
                    <li><a href="all-order.php"><i class="fa fa-list-alt"></i> All Orders</a></li>
                </ul>
            </li>
            <li>
            <li><a href="subcriber.php"><i class="fa fa-envelope"></i> Subscribers</a></li>
            </li>
            <li>
                <a href="#"><i class="fa fa-file-text"></i> <span class="nav-label">Pages</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                <li><a href="aboutus.php"><i class="fa fa-info-circle"></i> About Us</a></li>
                <li><a href="contactus.php"><i class="fa fa-phone"></i> Contact Us</a></li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-envelope"></i> <span class="nav-label">Enquiry</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                <li><a href="unreadenq.php"><i class="fa fa-envelope"></i> New Enquiries</a></li>
                <li><a href="readenq.php"><i class="fa fa-envelope-open"></i> Processed Enquiries</a></li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-bar-chart"></i> <span class="nav-label">Reports</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                <li><a href="bwdates-report-ds.php"><i class="fa fa-calendar"></i> Date Range Reports</a></li>
                    <li><a href="requestcount-report-ds.php"><i class="fa fa-calculator"></i> Order Statistics</a></li>
                    <li><a href="sales-reports.php"><i class="fa fa-line-chart"></i> Sales Analytics</a></li>
                </ul>
            </li>
            <li>
                <a href="search.php"><i class="fa fa-search"></i> <span class="nav-label">Search</span></a>
            </li>

            <!-- New Delivery Boy Management Section -->
            <li>
                <a href="#"><i class="fa fa-motorcycle"></i> <span class="nav-label">Delivery Boys</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                <li><a href="pending-delivery-boys.php"><i class="fa fa-user-plus"></i> New Applications</a></li>
                <li><a href="manage-delivery-boys.php"><i class="fa fa-users"></i> Manage Delivery Boys</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
<style>
    .nav > li.active {
    border-left: 4px solid #0B5ED7 !important;
    background: #293846 !important;
}
.nav {
    background: #343A40 !important;
}
.navbar-static-side{
    background: #343A40 !important;
}
.nav :hover {
    background: #343A40 !important;
}
.nav :active {
    background: #343A40 !important;
}
.dropdown-menu li:hover{
    background:none; }

    #adminmenu {
        background:white !important;
    }
    #adminmenu li {
        background:white !important;
    }
    #adminmenu li a{
        background:white !important;
    }


    #adminmenu li a:hover{
        background:white !important;
    }

</style>


