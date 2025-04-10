<div class="row border-bottom">
    <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0; background: #343A40 !important;">
        <div  class="navbar-header">
            <a id="sidebar-toggle" style="background:#0B5ED7 !important;" class="navbar-minimalize minimalize-styl-2  btn-primary" href="#"><i class="fa fa-bars"></i></a>
        </div>
        <div class="d-flex align-items-center">
            <!-- <img alt="Logo" class="img-fluid" src="/mithai/images.jpeg" 
                onerror="this.onerror=null; this.src='/mithai/images.jpeg';" 
                style="width: 40px; height: 40px; margin-right: 10px;" /> -->
            <p style="font-size: 20px; padding-top: 1%; color: #fff; margin: 0;"><strong>Cake Bakery  | Admin</strong></p>
        </div>

        <ul class="nav navbar-top-links navbar-right">
            <?php
            $ret1 = mysqli_query($con, "SELECT tbluser.FirstName, tblorderaddresses.ID, tblorderaddresses.Ordernumber 
                                      FROM tblorderaddresses 
                                      JOIN tbluser ON tbluser.ID = tblorderaddresses.UserId 
                                      WHERE tblorderaddresses.OrderFinalStatus IS NULL");
            $num = mysqli_num_rows($ret1);
            ?>

            <li  class="dropdown">
                <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                    <i style="color:#0B5ED7 !important;" class="fa fa-bell"></i> <span 
                    style="background:#343A40 !important;" class="label label-primary"><?php echo $num; ?></span>
                </a>

                <ul id="neworder-ul" class="dropdown-menu dropdown-alerts">
                    <li id="neworder">
                        <div>
                            <?php if ($num > 0) {
                                while ($result = mysqli_fetch_array($ret1)) {
                            ?>
                                <a  class="dropdown-item" href="viewcakeorder.php?orderid=<?php echo $result['Ordernumber']; ?>">
                                    <i class="fa fa-envelope fa-fw"></i> Order #<?php echo $result['Ordernumber']; ?> from <?php echo $result['FirstName']; ?>
                                </a>
                            <?php }
                            } else { ?>
                                <a class="dropdown-item" href="view-allorderfood.php">No New Orders</a>
                            <?php } ?>
                        </div>
                    </li>
                </ul>
            </li>

            <li>
                <a href="logout.php">
                    <i class="fa fa-sign-out"></i> Log out
                </a>
            </li>
        </ul>
    </nav>
</div>
<style>
    #neworder-ul{
        background:white !important;
    }
    #neworder:hover{
        background:white !important;
    }
    #neworder div:hover{
        background:white !important;
    }
    #neworder:hover a{
        background:white !important;
    }
   
</style>
