<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['fosaid']==0)) {
  header('location:logout.php');
  } else{

if(isset($_POST['submit']))
  {
    $faid=$_SESSION['fosaid'];
     $cid=$_GET['editid'];
    $fcat=$_POST['foodcategory'];
    $itemname=$_POST['itemname'];
    $description=$_POST['description'];
    $quantity=$_POST['quantity'];
    $price=$_POST['price'];
    
   $itempic=$_FILES["itemimages"]["name"];
    $query=mysqli_query($con, "update tblfood set CategoryName='$fcat',ItemName='$itemname',ItemPrice='$price',ItemDes='$description',ItemQty='$quantity' where ID='$cid'" );
    if ($query) {
   

    
    echo '<script>alert("Cake detail has been updated")</script>';
  }
  else
    {
      echo '<script>alert("Something Went Wrong. Please try again.")</script>';
    }

  

}
  ?>
<!DOCTYPE html>
<html>

<head>

    <title>Cake Bakery  | Edit Cake</title>

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

        .form-label {
            font-size: 14px;
            color: var(--text-color);
            font-weight: 500;
            display: flex;
            align-items: center;
        }

        .icon-label {
            color: var(--primary-color);
            width: 20px;
            margin-right: 8px;
            text-align: center;
            font-size: 16px;
            transition: color 0.3s ease;
        }

        .form-group:hover .icon-label {
            color: var(--primary-color);
        }

        .btn-container {
            text-align: center;
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid var(--border-color);
        }

        .btn {
            margin: 0 8px;
            padding: 8px 20px;
            font-size: 14px;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .btn i {
            margin-right: 8px;
            font-size: 14px;
        }

        .btn-primary {
            background: var(--primary-color);
            border: none;
        }

        .btn-primary:hover {
            background: var(--hover-color);
            transform: translateY(-1px);
        }

        .btn-secondary {
            background: #6c757d;
            border: none;
            color: white;
        }

        .btn-secondary:hover {
            background: #5a6268;
            transform: translateY(-1px);
        }

        .readonly-field {
            background-color: var(--bg-color);
            cursor: not-allowed;
        }

        @media (max-width: 768px) {
            .btn {
                margin: 5px;
            }
        }
    </style>
<script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
<script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>
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
                                    <a href="#"><i class="fa fa-birthday-cake"></i> Cake</a>
                                </li>
                                <li class="breadcrumb-item active">
                                    <i class="fa fa-edit"></i> Update
                                </li>
                            </ol>
                        </div>

                        <h2 class="page-title">
                            <i class="fa fa-edit"></i> Edit Cake Details
                        </h2>
                        
                        <div class="card">
                            <div class="card-header">
                                <h3><i class="fa fa-edit"></i> Update Cake Information</h3>
                            </div>
                            <div class="card-body">
                           <?php
 $cid=$_GET['editid'];
$ret=mysqli_query($con,"select * from tblfood where ID='$cid'");
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {

?>

                            <form id="submit" action="#" class="wizard-big" method="post" name="submit">
                                <p style="font-size:16px; color:red;"> <?php if($msg){
    echo $msg;
  }  ?> </p>
                                    <fieldset>
                                         
                                            <div class="form-group row">
                                                <label class="col-sm-3 form-label">
                                                    <i class="fa fa-candy-cane icon-label"></i><strong>Item Name</strong>
                                                </label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="itemname" value="<?php  echo $row['ItemName'];?>">
                                                </div>
                                            </div>
                                            
                                            <div class="form-group row">
                                                <label class="col-sm-3 form-label">
                                                    <i class="fa fa-file-text icon-label"></i><strong>Description</strong>
                                                </label>
                                                <div class="col-sm-9">
                                                 <textarea type="text" class="form-control" name="description" row="8" cols="12" required="true">
                                                    <?php  echo $row['ItemDes'];?></textarea>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group row">
                                                <label class="col-sm-3 form-label">
                                                    <i class="fa fa-image icon-label"></i><strong>Image</strong>
                                                </label>
                                                <div class="col-sm-9">
                                                    <img src="itemimages/<?php echo $row['Image'];?>" width="200" height="150" value="<?php  echo $row['Image'];?>">
                                                    <a href="changeimage.php?editid=<?php echo $row['ID'];?>" class="btn btn-sm btn-primary mt-2">
                                                        <i class="fa fa-edit"></i> Edit Image
                                                    </a>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-3 form-label">
                                                    <i class="fa fa-shopping-cart icon-label"></i><strong>Quantity</strong>
                                                </label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="quantity" value="<?php  echo $row['ItemQty'];?>">
                                                </div>
                                            </div>
                                            
                                            <div class="form-group row">
                                                <label class="col-sm-3 form-label">
                                                    <i class="fa fa-money icon-label"></i><strong>Price</strong>
                                                </label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="price" value="<?php  echo $row['ItemPrice'];?>">
                                                </div>
                                            </div>
                                            
                                            <div class="form-group row">
                                                <label class="col-sm-3 form-label">
                                                    <i class="fa fa-balance-scale icon-label"></i><strong>Weight</strong>
                                                </label>
                                                <div class="col-sm-9">
                                                    <select name="weight" class="form-control">
                                                        <option value=""><?php  echo $row['Weight'];?></option>
                                                        <option value="1 kg">1 kg</option>
                                                        <!-- <option value="500 gm">500 gm</option>
                                                        <option value="1.5 kg">1.5 kg</option>
                                                        <option value="2 kg">2 kg</option>
                                                        <option value="2.5 kg">2.5 kg</option>
                                                        <option value="3 kg">3 kg</option>
                                                        <option value="3.5 kg">3.5 kg</option>
                                                        <option value="4 kg">4 kg</option> -->
                                                    </select>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group row">
                                                <label class="col-sm-3 form-label">
                                                    <i class="fa fa-list icon-label"></i><strong>Cake Category</strong>
                                                </label>
                                                <div class="col-sm-9">
                                                    <select class="form-control" name='foodcategory'>
                                                        <option value="<?php  echo $row['CategoryName'];?>"><?php  echo $row['CategoryName'];?></option>
                                                        <?php
                                                        $query=mysqli_query($con,"select * from  tblcategory");
                                                        while($row=mysqli_fetch_array($query))
                                                        {
                                                        ?>
                                                        <option value="<?php  echo $row['CategoryName'];?>"><?php  echo $row['CategoryName'];?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </fieldset>

                                </fieldset>
                                
                             
                              <?php 
$cnt=$cnt+1;
}?> 
  
                                <div class="btn-container">
                                    <a href="dashboard.php" class="btn btn-secondary">
                                        <i class="fa fa-arrow-circle-left"></i> Back to Dashboard
                                    </a>
                                    <button type="submit" name="submit" class="btn btn-primary">
                                        <i class="fa fa-save"></i> Update Cake
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    </div>

                </div>
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

    <script>
        function validateQuantity() {
            let quantityField = document.querySelector("input[name='quantity']");
            quantityField.value = quantityField.value.replace(/[^0-9]/g, "");
            if (quantityField.value.length > 4) {
                quantityField.value = quantityField.value.slice(0, 4);
            }
        }

        function validatePrice() {
            let priceField = document.querySelector("input[name='price']");
            priceField.value = priceField.value.replace(/[^0-9]/g, "");
            if (priceField.value.length > 4) {
                priceField.value = priceField.value.slice(0, 4);
            }
        }

        function validateForm(event) {
            let quantityField = document.querySelector("input[name='quantity']");
            let priceField = document.querySelector("input[name='price']");
            
            if (!/^\d{1,4}$/.test(quantityField.value)) {
                alert("Invalid Quantity! Please enter a number between 1 and 9999.");
                event.preventDefault();
                return false;
            }
            
            if (!/^\d{1,4}$/.test(priceField.value)) {
                alert("Invalid Price! Please enter a number between 1 and 9999.");
                event.preventDefault();
                return false;
            }
            
            return true;
        }
        
        document.addEventListener('DOMContentLoaded', function() {
            let quantityField = document.querySelector("input[name='quantity']");
            let priceField = document.querySelector("input[name='price']");
            
            if (quantityField) {
                quantityField.addEventListener('input', validateQuantity);
            }
            
            if (priceField) {
                priceField.addEventListener('input', validatePrice);
            }
            
            let form = document.getElementById('submit');
            if (form) {
                form.addEventListener('submit', validateForm);
            }
        });
    </script>

</body>

</html>
   <?php } ?>