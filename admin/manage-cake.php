<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['fosaid']==0)) {
  header('location:logout.php');
  } else{


//Code for deletion
if (isset($_GET['delfood'])) {
$catid=intval($_GET['delfood']);    
$query=mysqli_query($con,"delete from tblfood where ID='$catid'");
    if ($query) {
     echo "<script>alert('cake item deleted from menu');</script>";
     echo "<script>window.location.href='manage-cake.php'</script>";
  } else {
    echo "<script>alert('Something Went Wrong. Please try again.');</script>";
    echo "<script>window.location.href='manage-cake.php'</script>";
    }
}

  ?>
<!DOCTYPE html>
<html>

<head>
    <title>Cake Bakery  | Manage cakes</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="css/plugins/steps/jquery.steps.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #0B5ED7;
            --text-color: #333;
            --border-color: #ddd;
            --bg-color: #f5f5f5;
            --icon-color: #666;
            --hover-color: #0a58ca;
            --danger-color: #dc3545;
            --success-color: #28a745;
        }

        .breadcrumb-container {
            background: var(--bg-color);
            padding: 12px 15px;
            border-radius: 4px;
            margin-bottom: 20px;
            border: 1px solid var(--border-color);
            box-shadow: 0 1px 2px rgba(0,0,0,0.05);
        }

        .breadcrumb-item i {
            color: var(--primary-color);
            margin-right: 5px;
        }

        .page-title {
            font-size: 22px;
            color: var(--text-color);
            margin-bottom: 20px;
            padding-bottom: 12px;
            border-bottom: 2px solid var(--border-color);
            display: flex;
            align-items: center;
        }

        .page-title i {
            color: var(--primary-color);
            margin-right: 10px;
            font-size: 24px;
        }

        .card {
            background: #fff;
            border: 1px solid var(--border-color);
            border-radius: 4px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }

        .card-header {
            padding: 15px 20px;
            background: #fff;
            border-bottom: 2px solid var(--border-color);
        }

        .card-header h3 {
            font-size: 18px;
            margin: 0;
            color: var(--text-color);
            display: flex;
            align-items: center;
        }

        .card-header h3 i {
            color: var(--primary-color);
            margin-right: 8px;
        }

        .table-container {
            overflow-x: auto;
        }

        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: var(--text-color);
            border-collapse: collapse;
        }

        .table th,
        .table td {
            padding: 0.75rem;
            vertical-align: middle;
            border-top: 1px solid var(--border-color);
        }

        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid var(--border-color);
            background-color: var(--bg-color);
            font-weight: 600;
        }

        .table tbody tr:hover {
            background-color: rgba(0, 0, 0, 0.075);
        }

        .btn-container {
            margin-top: 20px;
            display: flex;
            justify-content: flex-end;
        }

        .btn {
            margin: 0 5px;
            padding: 6px 12px;
            font-size: 14px;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            border-radius: 4px;
        }

        .btn i {
            margin-right: 5px;
            font-size: 14px;
        }

        .btn-primary {
            background: var(--primary-color);
            border: none;
            color: white;
        }

        .btn-primary:hover {
            background: var(--hover-color);
            transform: translateY(-1px);
        }

        .btn-danger {
            background: var(--danger-color);
            border: none;
            color: white;
        }

        .btn-danger:hover {
            background: #c82333;
            transform: translateY(-1px);
        }

        .btn-success {
            background: var(--success-color);
            border: none;
            color: white;
        }

        .btn-success:hover {
            background: #218838;
            transform: translateY(-1px);
        }

        .btn-edit {
            color: var(--primary-color);
            background: rgba(11, 94, 215, 0.1);
            border: none;
            text-decoration: none;
        }

        .btn-edit:hover {
            background: rgba(11, 94, 215, 0.2);
            color: var(--primary-color);
            text-decoration: none;
        }

        .btn-delete {
            color: #dc3545;
            background: rgba(220, 53, 69, 0.1);
            border: none;
            text-decoration: none;
        }

        .btn-delete:hover {
            background: rgba(220, 53, 69, 0.2);
            color: #dc3545;
            text-decoration: none;
        }

        .pagination {
            display: flex;
            padding-left: 0;
            list-style: none;
            border-radius: 0.25rem;
            margin-top: 20px;
            justify-content: center;
        }

        .pagination li {
            margin: 0 2px;
        }

        .pagination li a {
            position: relative;
            display: block;
            padding: 0.5rem 0.75rem;
            margin-left: -1px;
            line-height: 1.25;
            color: var(--primary-color);
            background-color: #fff;
            border: 1px solid var(--border-color);
            text-decoration: none;
        }

        .pagination li.active a {
            z-index: 3;
            color: #fff;
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .pagination li.disabled a {
            color: #6c757d;
            pointer-events: none;
            cursor: auto;
            background-color: #fff;
            border-color: var(--border-color);
        }

        .action-buttons {
            display: flex;
            gap: 5px;
        }

        @media (max-width: 768px) {
            .btn {
                margin: 2px;
                padding: 4px 8px;
                font-size: 12px;
            }
            
            .table th,
            .table td {
                padding: 0.5rem;
            }
        }
    </style>
</head>

<body>

    <div id="wrapper">

    <?php include_once('includes/leftbar.php');?>

        <div id="page-wrapper" class="gray-bg">
             <?php include_once('includes/header.php');?>
        
        <div class="row border-bottom">
        
        </div>
            
        <div class="wrapper wrapper-content animated fadeInRight">
            
            <div class="row">
                 
                <div class="col-lg-12">
                    <div class="breadcrumb-container">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="dashboard.php"><i class="fa fa-home"></i> Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#"><i class="fa fa-candy-cane"></i> cakes</a>
                            </li>
                            <li class="breadcrumb-item active">
                                <i class="fa fa-list"></i> Manage
                            </li>
                        </ol>
                    </div>

                    <h2 class="page-title">
                        <i class="fa fa-list"></i> Manage cakes
                    </h2>
                    
                    <div class="card">
                       
                        <div class="card-body">
                           
                            
                            <div class="table-container">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th width="5%">#</th>
                                            <th width="25%">Category Name</th>
                                            <th width="40%">Item Name</th>
                                            <th width="30%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (isset($_GET['page_no']) && $_GET['page_no']!="") {
                                            $page_no = $_GET['page_no'];
                                        } else {
                                            $page_no = 1;
                                        }

                                        $total_records_per_page = 12;
                                        $offset = ($page_no-1) * $total_records_per_page;
                                        $previous_page = $page_no - 1;
                                        $next_page = $page_no + 1;
                                        $adjacents = "2"; 

                                        $result_count = mysqli_query($con,"SELECT COUNT(*) As total_records FROM tblfood");
                                        $total_records = mysqli_fetch_array($result_count);
                                        $total_records = $total_records['total_records'];
                                        $total_no_of_pages = ceil($total_records / $total_records_per_page);
                                        $second_last = $total_no_of_pages - 1; // total page minus 1
                                        $ret=mysqli_query($con,"select * from tblfood LIMIT $offset, $total_records_per_page");
                                        $cnt=1;
                                        while ($row=mysqli_fetch_array($ret)) {
                                        ?>
                                        <tr>
                                            <td><?php echo $cnt;?></td>
                                            <td><?php echo $row['CategoryName'];?></td>
                                            <td><?php echo $row['ItemName'];?></td>
                                            <td class="action-buttons">
                                                <a href="edit-cake.php?editid=<?php echo $row['ID'];?>" class="btn btn-edit">
                                                    <i class="fa fa-pencil"></i> Edit
                                                </a>
                                                <a href="manage-cake.php?delfood=<?php echo $row['ID'];?>" class="btn btn-delete" 
                                                   onclick="return confirm('Do you really want to delete this cake item?');">
                                                    <i class="fa fa-trash"></i> Delete
                                                </a>
                                            </td>
                                        </tr>
                                        <?php 
                                        $cnt=$cnt+1;
                                        }?>
                                    </tbody>
                                </table>
                            </div>
                            
                            <ul class="pagination">
                                <li <?php if($page_no <= 1){ echo "class='disabled'"; } ?>>
                                    <a <?php if($page_no > 1){ echo "href='?page_no=$previous_page'"; } ?>>
                                        <i class="fa fa-chevron-left"></i> Previous
                                    </a>
                                </li>
                                
                                <?php 
                                if ($total_no_of_pages <= 10){       
                                    for ($counter = 1; $counter <= $total_no_of_pages; $counter++){
                                        if ($counter == $page_no) {
                                            echo "<li class='active'><a>$counter</a></li>";  
                                        } else {
                                            echo "<li><a href='?page_no=$counter'>$counter</a></li>";
                                        }
                                    }
                                }
                                elseif($total_no_of_pages > 10){
                                    
                                    if($page_no <= 4) {         
                                        for ($counter = 1; $counter < 8; $counter++){       
                                            if ($counter == $page_no) {
                                                echo "<li class='active'><a>$counter</a></li>";  
                                            } else {
                                                echo "<li><a href='?page_no=$counter'>$counter</a></li>";
                                            }
                                        }
                                        echo "<li><a>...</a></li>";
                                        echo "<li><a href='?page_no=$second_last'>$second_last</a></li>";
                                        echo "<li><a href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
                                    }

                                    elseif($page_no > 4 && $page_no < $total_no_of_pages - 4) {         
                                        echo "<li><a href='?page_no=1'>1</a></li>";
                                        echo "<li><a href='?page_no=2'>2</a></li>";
                                        echo "<li><a>...</a></li>";
                                        for ($counter = $page_no - $adjacents; $counter <= $page_no + $adjacents; $counter++) {         
                                            if ($counter == $page_no) {
                                                echo "<li class='active'><a>$counter</a></li>";  
                                            } else {
                                                echo "<li><a href='?page_no=$counter'>$counter</a></li>";
                                            }                  
                                        }
                                        echo "<li><a>...</a></li>";
                                        echo "<li><a href='?page_no=$second_last'>$second_last</a></li>";
                                        echo "<li><a href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";      
                                    }
                                    
                                    else {
                                        echo "<li><a href='?page_no=1'>1</a></li>";
                                        echo "<li><a href='?page_no=2'>2</a></li>";
                                        echo "<li><a>...</a></li>";

                                        for ($counter = $total_no_of_pages - 6; $counter <= $total_no_of_pages; $counter++) {
                                            if ($counter == $page_no) {
                                                echo "<li class='active'><a>$counter</a></li>";  
                                            } else {
                                                echo "<li><a href='?page_no=$counter'>$counter</a></li>";
                                            }                   
                                        }
                                    }
                                }
                                ?>
                                
                                <li <?php if($page_no >= $total_no_of_pages){ echo "class='disabled'"; } ?>>
                                    <a <?php if($page_no < $total_no_of_pages) { echo "href='?page_no=$next_page'"; } ?>>
                                        Next <i class="fa fa-chevron-right"></i>
                                    </a>
                                </li>
                                <?php if($page_no < $total_no_of_pages){
                                    echo "<li><a href='?page_no=$total_no_of_pages'>Last <i class='fa fa-angle-double-right'></i></a></li>";
                                } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-4 mb-3">
                <a style="background-color: #0B5ED7;" href="dashboard.php" class="btn btn-secondary">
                    <i class="fa fa-arrow-left"></i> Back to Dashboard
                </a>
            </div>
        <?php include_once('includes/footer.php');?>

        </div>
        </div>



    <!-- Mainly scripts -->
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="js/inspinia.js"></script>
    <script src="js/plugins/pace/pace.min.js"></script>

    <!-- Steps -->
    <script src="js/plugins/steps/jquery.steps.min.js"></script>

    <!-- Jquery Validate -->
    <script src="js/plugins/validate/jquery.validate.min.js"></script>

</body>

</html>
<?php } ?>
