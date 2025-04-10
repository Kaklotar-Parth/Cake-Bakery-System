<?php
    session_start();
    error_reporting(0);
    include 'includes/dbconnection.php';
    if (strlen($_SESSION['fosaid'] == 0)) {
        header('location:logout.php');
    } else {

    //Code for deletion
        if (isset($_GET['del'])) {
            $catid = intval($_GET['del']);
            $query = mysqli_query($con, "delete from tblcategory where ID='$catid'");
            if ($query) {
                echo "<script>alert('Category deleted');</script>";
                echo "<script>window.location.href='manage-cakecategory.php'</script>";
            } else {
                echo "<script>alert('Something Went Wrong. Please try again.');</script>";
                echo "<script>window.location.href='manage-cakecategory.php'</script>";
            }
        }
    ?>
<!DOCTYPE html>
<html>
<head>
    <title>Cake Bakery  | Manage Categories</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
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
        }

        .breadcrumb-container {
            background: var(--bg-color);
            padding: 12px 15px;
            border-radius: 4px;
            margin-bottom: 20px;
            border: 1px solid var(--border-color);
            box-shadow: 0 1px 2px rgba(0,0,0,0.05);
        }

        .breadcrumb {
            margin: 0;
            padding: 0;
            background: transparent;
        }

        .breadcrumb-item {
            font-size: 14px;
        }

        .breadcrumb-item a {
            color: var(--primary-color);
            text-decoration: none;
        }

        .breadcrumb-item.active {
            color: var(--text-color);
        }

        .page-title {
            font-size: 22px;
            color: var(--text-color);
            margin-bottom: 20px;
            padding-bottom: 12px;
            border-bottom: 1px solid var(--border-color);
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
            box-shadow: 0 1px 3px rgba(0,0,0,0.08);
        }

        .card-body {
            padding: 20px;
        }

        .table {
            margin-bottom: 0;
        }

        .table thead th {
            background: var(--bg-color);
            border-bottom: 2px solid var(--border-color);
            color: var(--text-color);
            font-weight: 600;
            font-size: 14px;
            padding: 12px 15px;
        }

        .table tbody td {
            padding: 12px 15px;
            vertical-align: middle;
            border-bottom: 1px solid var(--border-color);
            font-size: 14px;
        }

        .table tbody tr:hover {
            background-color: var(--bg-color);
        }

        .btn {
            padding: 5px 12px;
            font-size: 13px;
            border-radius: 4px;
            margin: 0 3px;
            display: inline-flex;
            align-items: center;
        }

        .btn i {
            margin-right: 5px;
            font-size: 12px;
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

        .action-btns {
            white-space: nowrap;
        }

        .pagination {
            margin: 20px 0 0;
            display: flex;
            justify-content: center;
        }

        .pagination li {
            margin: 0 2px;
        }

        .pagination li a {
            padding: 8px 12px;
            border: 1px solid var(--border-color);
            border-radius: 4px;
            color: var(--text-color);
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .pagination li.active a {
            background: var(--primary-color);
            color: #fff;
            border-color: var(--primary-color);
        }

        .pagination li:not(.active):not(.disabled) a:hover {
            background: var(--bg-color);
            color: var(--primary-color);
        }

        .pagination li.disabled a {
            color: var(--icon-color);
            cursor: not-allowed;
        }

        .add-category-btn {
            margin-bottom: 20px;
        }

        .empty-state {
            text-align: center;
            padding: 30px;
            color: var(--icon-color);
        }

        .empty-state i {
            font-size: 48px;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>
    <div id="wrapper">
        <?php include_once 'includes/leftbar.php'; ?>
        <div id="page-wrapper" class="gray-bg">
            <?php include_once 'includes/header.php'; ?>
            
            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="breadcrumb-container">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="dashboard.php"><i class="fa fa-home"></i> Dashboard</a>
                                </li>
                               
                                <li class="breadcrumb-item active">
                                    <i class="fa fa-list"></i> Manage Categories
                                </li>
                            </ol>
                        </div>

                        <h2 class="page-title">
                            <i class="fa fa-list"></i> Manage Categories
                        </h2>

                        <div class="add-category-btn">
                            <a style="background-color: #0B5ED7; " href="add-cakecategory.php" class="btn btn-primary">
                                <i " class="fa fa-plus"></i> Add New Category
                            </a>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th width="5%">S.NO</th>
                                                <th>Category Name</th>
                                                <th>Creation Date</th>
                                                <th width="15%" class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                if (isset($_GET['page_no']) && $_GET['page_no'] != "") {
                                                    $page_no = $_GET['page_no'];
                                                } else {
                                                    $page_no = 1;
                                                }

                                                $total_records_per_page = 10;
                                                $offset = ($page_no - 1) * $total_records_per_page;
                                                $previous_page = $page_no - 1;
                                                $next_page = $page_no + 1;
                                                $adjacents = "2";

                                                $result_count = mysqli_query($con, "SELECT COUNT(*) As total_records FROM tblcategory");
                                                $total_records = mysqli_fetch_array($result_count);
                                                $total_records = $total_records['total_records'];
                                                $total_no_of_pages = ceil($total_records / $total_records_per_page);
                                                $second_last = $total_no_of_pages - 1;
                                                $ret = mysqli_query($con, "select * from tblcategory LIMIT $offset, $total_records_per_page");
                                                $cnt = 1;
                                                
                                                if(mysqli_num_rows($ret) > 0) {
                                                    while ($row = mysqli_fetch_array($ret)) {
                                            ?>
                                            <tr>
                                                <td><?php echo $cnt; ?></td>
                                                <td><?php echo $row['CategoryName']; ?></td>
                                                <td><?php echo $row['CreationDate']; ?></td>
                                                <td class="text-center action-btns">
                                                    <a href="editcategory.php?editid=<?php echo $row['ID']; ?>" class="btn btn-edit">
                                                        <i class="fa fa-pencil"></i> Edit
                                                    </a>
                                                    <a href="manage-cakecategory.php?del=<?php echo $row['ID']; ?>" class="btn btn-delete" 
                                                       onclick="return confirm('Do you really want to delete this category?');">
                                                        <i class="fa fa-trash"></i> Delete
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php 
                                                        $cnt = $cnt + 1;
                                                    }
                                                } else {
                                            ?>
                                            <tr>
                                                <td colspan="4" class="empty-state">
                                                    <i class="fa fa-list"></i>
                                                    <p>No categories found. Add your first category to get started.</p>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>

                                <?php if($total_no_of_pages > 1) { ?>
                                <ul class="pagination">
                                    <li <?php if ($page_no <= 1) { echo "class='disabled'"; } ?>>
                                        <a <?php if ($page_no > 1) { echo "href='?page_no=$previous_page'"; } ?>>
                                            <i class="fa fa-angle-left"></i> Previous
                                        </a>
                                    </li>

                                    <?php
                                        if ($total_no_of_pages <= 10) {
                                            for ($counter = 1; $counter <= $total_no_of_pages; $counter++) {
                                                if ($counter == $page_no) {
                                                    echo "<li class='active'><a>$counter</a></li>";
                                                } else {
                                                    echo "<li><a href='?page_no=$counter'>$counter</a></li>";
                                                }
                                            }
                                        } elseif ($total_no_of_pages > 10) {
                                            if ($page_no <= 4) {
                                                for ($counter = 1; $counter < 8; $counter++) {
                                                    if ($counter == $page_no) {
                                                        echo "<li class='active'><a>$counter</a></li>";
                                                    } else {
                                                        echo "<li><a href='?page_no=$counter'>$counter</a></li>";
                                                    }
                                                }
                                                echo "<li><a>...</a></li>";
                                                echo "<li><a href='?page_no=$second_last'>$second_last</a></li>";
                                                echo "<li><a href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
                                            } elseif ($page_no > 4 && $page_no < $total_no_of_pages - 4) {
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
                                            } else {
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

                                    <li <?php if ($page_no >= $total_no_of_pages) { echo "class='disabled'"; } ?>>
                                        <a <?php if ($page_no < $total_no_of_pages) { echo "href='?page_no=$next_page'"; } ?>>
                                            Next <i class="fa fa-angle-right"></i>
                                        </a>
                                    </li>
                                    <?php if ($page_no < $total_no_of_pages) {
                                        echo "<li><a href='?page_no=$total_no_of_pages'>Last <i class='fa fa-angle-double-right'></i></a></li>";
                                    } ?>
                                </ul>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center mt-4 mb-3">
                    <a style="background-color: #0B5ED7;" href="dashboard.php" class="btn btn-secondary">
                        <i class="fa fa-arrow-left"></i> Back to Dashboard
                    </a>
                </div>
            </div>
            <?php include_once 'includes/footer.php'; ?>
        </div>
    </div>

    <!-- Scripts -->
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="js/inspinia.js"></script>
    <script src="js/plugins/pace/pace.min.js"></script>
</body>
</html>
<?php } ?>
