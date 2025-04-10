 <div id="page-wrapper" class="gray-bg">
            <?php include_once 'includes/header.php'; ?>
            <div class="wrapper wrapper-content">
                <div class="row">

                    <!-- Total Products -->
                    <div class="col-lg-4">
                        <div class="ibox ">
                            <div class="ibox-title">
                                <h5><i class="fa fa-shopping-cart ibox-icon"></i>Total Products</h5>
                            </div>
                            <div class="ibox-content">
                                <?php $query = mysqli_query($con, "SELECT * FROM tblproducts");
                                $totalproducts                               = mysqli_num_rows($query); ?>
                                <h1 class="no-margins"><?php echo $totalproducts; ?></h1>
                                <small>Total Products</small>
                                <a href="all-products.php">View All</a>
                            </div>
                        </div>
                    </div>

                    <!-- Orders Pending -->
                    <div class="col-lg-4">
                        <div class="ibox ">
                            <div class="ibox-title">
                                <h5><i class="fa fa-dollar ibox-icon"></i>Orders Pending</h5>
                            </div>
                            <div class="ibox-content">
                                <?php $query1 = mysqli_query($con, "SELECT * FROM tblorderaddresses WHERE OrderFinalStatus IS NULL");
                                $pendingorders                                = mysqli_num_rows($query1); ?>
                                <h1 class="no-margins"><?php echo $pendingorders; ?></h1>
                                <small>Orders Pending</small>
                                <a href="pending-orders.php">View All</a>
                            </div>
                        </div>
                    </div>

                    <!-- Orders Processing -->
                    <div class="col-lg-4">
                        <div class="ibox ">
                            <div class="ibox-title">
                                <h5><i class="fa fa-truck ibox-icon"></i>Orders Processing</h5>
                            </div>
                            <div class="ibox-content">
                                <?php $query2 = mysqli_query($con, "SELECT * FROM tblorderaddresses WHERE OrderFinalStatus='Processing'");
                                $processingorders                             = mysqli_num_rows($query2); ?>
                                <h1 class="no-margins"><?php echo $processingorders; ?></h1>
                                <small>Orders Processing</small>
                                <a href="processing-orders.php">View All</a>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row">

                    <!-- Orders Completed -->
                    <div class="col-lg-4">
                        <div class="ibox ">
                            <div class="ibox-title">
                                <h5><i class="fa fa-check ibox-icon"></i>Orders Completed</h5>
                            </div>
                            <div class="ibox-content">
                                <?php $query3 = mysqli_query($con, "SELECT * FROM tblorderaddresses WHERE OrderFinalStatus='Completed'");
                                $completedorders                              = mysqli_num_rows($query3); ?>
                                <h1 class="no-margins"><?php echo $completedorders; ?></h1>
                                <small>Orders Completed</small>
                                <a href="completed-orders.php">View All</a>
                            </div>
                        </div>
                    </div>

                    <!-- Pending Withdraws -->
                    <div class="col-lg-4">
                        <div class="ibox ">
                            <div class="ibox-title">
                                <h5><i class="fa fa-bank ibox-icon"></i>Pending Withdraws</h5>
                            </div>
                            <div class="ibox-content">
                                <?php $query4 = mysqli_query($con, "SELECT * FROM tblwithdraw WHERE Status='Pending'");
                                $pendingwithdraws                             = mysqli_num_rows($query4); ?>
                                <h1 class="no-margins"><?php echo $pendingwithdraws; ?></h1>
                                <small>Pending Withdraws</small>
                                <a href="pending-withdraws.php">View All</a>
                            </div>
                        </div>
                    </div>

                    <!-- Total Customers -->
                    <div class="col-lg-4">
                        <div class="ibox ">
                            <div class="ibox-title">
                                <h5><i class="fa fa-user ibox-icon"></i>Total Customers</h5>
                            </div>
                            <div class="ibox-content">
                                <?php $query5 = mysqli_query($con, "SELECT * FROM tbluser");
                                $totalcustomers                               = mysqli_num_rows($query5); ?>
                                <h1 class="no-margins"><?php echo $totalcustomers; ?></h1>
                                <small>Total Customers</small>
                                <a href="customer-list.php">View All</a>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row">

                    <!-- Vendors Pending -->
                    <div class="col-lg-4">
                        <div class="ibox ">
                            <div class="ibox-title">
                                <h5><i class="fa fa-bell ibox-icon"></i>Vendors Pending</h5>
                            </div>
                            <div class="ibox-content">
                                <?php $query6 = mysqli_query($con, "SELECT * FROM tblvendor WHERE Status='Pending'");
                                $vendorspending                               = mysqli_num_rows($query6); ?>
                                <h1 class="no-margins"><?php echo $vendorspending; ?></h1>
                                <small>Vendors Pending</small>
                                <a href="pending-vendors.php">View All</a>
                            </div>
                        </div>
                    </div>

                    <!-- Total Vendors -->
                    <div class="col-lg-4">
                        <div class="ibox ">
                            <div class="ibox-title">
                                <h5><i class="fa fa-users ibox-icon"></i>Total Vendors</h5>
                            </div>
                            <div class="ibox-content">
                                <?php $query7 = mysqli_query($con, "SELECT * FROM tblvendor");
                                $totalvendors                                 = mysqli_num_rows($query7); ?>
                                <h1 class="no-margins"><?php echo $totalvendors; ?></h1>
                                <small>Total Vendors</small>
                                <a href="vendor-list.php">View All</a>
                            </div>
                        </div>
                    </div>

                    <!-- Total Subscribers -->
                    <div class="col-lg-4">
                        <div class="ibox ">
                            <div class="ibox-title">
                                <h5><i class="fa fa-at ibox-icon"></i>Total Subscribers</h5>
                            </div>
                            <div class="ibox-content">
                                <?php $query8 = mysqli_query($con, "SELECT * FROM tblsubscribers");
                                $totalsubscribers                             = mysqli_num_rows($query8); ?>
                                <h1 class="no-margins"><?php echo $totalsubscribers; ?></h1>
                                <small>Total Subscribers</small>
                                <a href="subscriber-list.php">View All</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <?php include_once 'includes/footer.php'; ?>
        </div>