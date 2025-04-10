<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['fosaid']==0)) {
  header('location:logout.php');
  } else{

if(isset($_POST['submit']))
  {
    $category=$_POST['categoryname'];
    $ret=mysqli_query($con, "select * from tblcategory where CategoryName='$category' ");
    $result=mysqli_fetch_array($ret);
    if($result>0){
$msg="This Cake category is already exist";
    }

    else{
     
    $query=mysqli_query($con, "insert into tblcategory(CategoryName) value('$category')");
    }
    if ($query) {
    echo '<script>alert("Category Has been created")</script>';
    echo "<script>window.location.href ='add-cakecategory.php'</script>";
  }
  else
    {
     echo '<script>alert("This Cake category is already exist")</script>';
    }
}

  ?>
<!DOCTYPE html>
<html>
<head>
    <title>Cake Bakery  | Add Category</title>
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

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            font-weight: 600;
            color: var(--text-color);
            margin-bottom: 8px;
            display: block;
        }

        .form-control {
            border: 1px solid var(--border-color);
            border-radius: 4px;
            padding: 8px 12px;
            height: auto;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(11, 94, 215, 0.25);
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            padding: 8px 20px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: var(--hover-color);
            border-color: var(--hover-color);
            transform: translateY(-1px);
        }

        .btn-secondary {
            background-color: var(--bg-color);
            border-color: var(--border-color);
            color: var(--text-color);
            padding: 8px 20px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            background-color: var(--border-color);
            color: var(--text-color);
            transform: translateY(-1px);
        }

        .alert {
            border-radius: 4px;
            padding: 12px 15px;
            margin-bottom: 20px;
            border: 1px solid transparent;
        }

        .alert-danger {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
        }

        .category-icon {
            font-size: 120px;
            color: var(--bg-color);
            margin-bottom: 20px;
        }

        .text-center {
            text-align: center;
        }

        .mt-4 {
            margin-top: 1.5rem;
        }

        .mb-3 {
            margin-bottom: 1rem;
        }
    </style>
</head>

<body>
    <div id="wrapper">
        <?php include_once('includes/leftbar.php');?>
        <div id="page-wrapper" class="gray-bg">
            <?php include_once('includes/header.php');?>
            
            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="breadcrumb-container">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="dashboard.php"><i class="fa fa-home"></i> Dashboard</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="manage-cakecategory.php"><i class="fa fa-list"></i> Categories</a>
                                </li>
                                <li class="breadcrumb-item active">
                                    <i class="fa fa-plus"></i> Add Category
                                </li>
                            </ol>
                        </div>

                        <h2 class="page-title">
                            <i class="fa fa-plus-circle"></i> Add New Category
                        </h2>

                        <div class="card">
                            <div class="card-body">
                                <?php if($msg){ ?>
                                    <div class="alert alert-danger">
                                        <i class="fa fa-exclamation-circle"></i> <?php echo $msg; ?>
                                    </div>
                                <?php } ?>

                                <form method="post" name="submit">
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <div class="form-group">
                                                <label for="categoryname">
                                                    <i class="fa fa-tag"></i> Category Name
                                                </label>
                                                <input type="text" class="form-control" id="categoryname" name="categoryname" 
                                                       maxlength="25" required placeholder="Enter category name" 
                                                       onkeypress="return validateInput(event)">
                                                <small class="text-muted">Only letters, spaces, and hyphens are allowed</small>
                                            </div>
                                            <div class="form-group text-center">
                                                <button type="submit" name="submit" class="btn btn-primary">
                                                    <i class="fa fa-plus"></i> Add Category
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="text-center">
                                                <i class="fa fa-cube category-icon"></i>
                                                <p class="text-muted">Add a new category for your products</p>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="text-center mt-4 mb-3">
                <a  style="background-color: #0B5ED7; color:white;"  href="dashboard.php" class="btn btn-secondary">
                    <i class="fa fa-arrow-left"></i> Back to Dashboard
                </a>
            </div>
                        
                    </div>
                   
                </div>
            </div>
            <?php include_once('includes/footer.php');?>
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
    <script>
        function validateInput(event) {
            // Allow only letters, spaces, and hyphens
            const char = String.fromCharCode(event.which);
            if (!/^[a-zA-Z\s\-]$/.test(char)) {
                event.preventDefault();
                return false;
            }
            return true;
        }

        // Additional validation to prevent pasting non-string content
        document.getElementById('categoryname').addEventListener('paste', function(e) {
            e.preventDefault();
            const pastedText = (e.clipboardData || window.clipboardData).getData('text');
            if (/^[a-zA-Z\s\-]+$/.test(pastedText)) {
                this.value += pastedText;
            }
        });
    </script>
</body>
</html>
<?php }  ?>