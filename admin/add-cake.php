<?php
    session_start();
    error_reporting(0);
    include 'includes/dbconnection.php';

    if (strlen($_SESSION['fosaid']) == 0) {
        header('location:logout.php');
        exit();
    } else {

        if (isset($_POST['submit'])) {
            $faid        = $_SESSION['fosaid'];
            $fcat        = $_POST['foodcategory'];
            $itemname    = $_POST['itemname'];
            $description = $_POST['description'];
            $quantity    = $_POST['quantity'];
            $price       = $_POST['price'];
            $weight      = $_POST['weight'];
            $itempic     = $_FILES["itemimages"]["name"];

            // Validate quantity and price
            if (! ctype_digit($quantity) || (int) $quantity < 1) {
                echo "<script>alert('Quantity must be a positive integer greater than zero.'); window.location.href='add-cake.php';</script>";
                exit();
            }

            if (! ctype_digit($price) || (int) $price < 1) {
                echo "<script>alert('Price must be a positive integer greater than zero.'); window.location.href='add-cake.php';</script>";
                exit();
            }

            $extension = strtolower(substr($itempic, strrpos($itempic, '.')));
            // Allowed extensions
            $allowed_extensions = [".jpg", ".jpeg", ".png", ".gif"];

            if (! in_array($extension, $allowed_extensions)) {
                echo "<script>alert('Invalid format. Only jpg / jpeg / png / gif formats allowed.'); window.location.href='add-cake.php';</script>";
                exit();
            }

            // Check if item already exists
            $check_query = mysqli_query($con, "SELECT * FROM tblfood WHERE ItemName='$itemname'");
            if (mysqli_num_rows($check_query) > 0) {
                echo "<script>alert('This item already exists.'); window.location.href='add-cake.php';</script>";
                exit();
            }

            // Rename and move the uploaded image
            $itempic_new_name = md5(time() . $itempic) . $extension;
            move_uploaded_file($_FILES["itemimages"]["tmp_name"], "itemimages/" . $itempic_new_name);

            // Insert query
            $query = mysqli_query($con, "INSERT INTO tblfood(CategoryName, ItemName, ItemPrice, ItemDes, ItemQty, Weight, Image)
            VALUES('$fcat', '$itemname', '$price', '$description', '$quantity', '$weight', '$itempic_new_name')");

            if ($query) {
                echo "<script>alert('Cake has been added successfully.'); window.location.href='add-cake.php';</script>";
            } else {
                echo "<script>alert('An error occurred while adding the Cake.'); window.location.href='add-cake.php';</script>";
            }
        }
    }
?>

<!DOCTYPE html>
<html>

<head>
    <title>Cake Bakery  | Add Cake</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="css/plugins/steps/jquery.steps.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
<script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
<script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>
<script>
    document.getElementsByName('quantity')[0].addEventListener('input', function (e) {
    this.value = this.value.replace(/[^0-9]/g, ''); // Removes any non-numeric characters
    if (this.value < 1) this.value = ''; // Ensures no zero or negative values
});

document.getElementsByName('price')[0].addEventListener('input', function (e) {
    this.value = this.value.replace(/[^0-9]/g, ''); // Removes any non-numeric characters
    if (this.value < 1) this.value = ''; // Ensures no zero or negative values
});
</script>
</head>

<body>

    <div id="wrapper">

    <?php include_once 'includes/leftbar.php'; ?>

        <div id="page-wrapper" class="gray-bg">
             <?php include_once 'includes/header.php'; ?>
        <div class="row border-bottom">

        </div>
            <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2>Cake Item</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="dashboard.php">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="manage-cake.php" >Manage cake</a>
                    </li>
                    <li class="breadcrumb-item active">
                        <strong>Add</strong>
                    </li>
                </ol>
            </div>
        </div>

        <div class="wrapper wrapper-content animated fadeInRight">

            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox">

                        <div class="ibox-content">


                            <form id="submit" action="#" class="wizard-big" method="post" name="submit" enctype="multipart/form-data">
                                    <fieldset>
                                          <div class="form-group row"><label class="col-sm-2 col-form-label"><i class="fa fa-list"></i> Cake Category:</label>
                                                <div class="col-sm-10"><select name='foodcategory' id="foodcategory" class="form-control white_bg" required="true">

      <?php

          $query = mysqli_query($con, "select * from  tblcategory");
          while ($row = mysqli_fetch_array($query)) {
          ?>
              <option value="<?php echo $row['CategoryName']; ?>"><?php echo $row['CategoryName']; ?></option>
                  <?php }?>
   </select></div>
                                            </div>
                                            <div class="form-group row"><label class="col-sm-2 col-form-label"><i class="fa fa-birthday-cake"></i> Item Name:</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" maxlength="25" name="itemname" required="true" 
                                                           onkeypress="return validateItemName(event)">
                                                    <small class="text-muted">Only letters, spaces, and hyphens are allowed</small>
                                                </div>
                                            </div>

                                            <div class="form-group row"><label class="col-sm-2 col-form-label"><i class="fa fa-file-text"></i> Description:</label>
                                                <div class="col-sm-10">
                                                 <textarea type="text" class="form-control" name="description" row="8" cols="12" required="true">
                                                 	</textarea>
                                                </div>
                                            </div>
                                            <div class="form-group row"><label class="col-sm-2 col-form-label"><i class="fa fa-image"></i> Image</label>
                                                <div class="col-sm-10"><input type="file" name="itemimages" required="true"></div>
                                            </div>
                                            <div class="form-group row"><label class="col-sm-2 col-form-label"><i class="fa fa-shopping-cart"></i> Quantity:</label>
                                                <div class="col-sm-10">
                                                    <input type="text" type="hidden" maxlength="1" pattern="\d{1}" class="form-control" name="quantity" 
                                                           required title="Quantity is fixed at 1" value="1" readonly>
                                                    <small class="text-muted">Quantity is fixed at 1</small>
                                                </div>
                                            </div>
                                            <div class="form-group row"><label class="col-sm-2 col-form-label"><i class="fa fa-balance-scale"></i> Cake Weight:</label>
                                                <div class="col-sm-10"><select class="form-control white_bg" required="true" name="weight">
                                                    <option value="">Choose Weight</option>
                                                    <!-- <option value="500 gm">500 gm</option> -->
                                                    <option value="1 kg">1 kg</option>
                                                    <!-- <option value="1.5 kg">1.5 kg</option> -->
                                                    <!-- <option value="2 kg">2 kg</option>
                                                    <option value="2.5 kg">2.5 kg</option>
                                                    <option value="3 kg">3 kg</option>
                                                    <option value="3.5 kg">3.5 kg</option>
                                                    <option value="4 kg">4 kg</option> -->
                                                </select> </div>
                                            </div>
                                            <div class="form-group row"><label class="col-sm-2 col-form-label"><i class="fa fa-money"></i> Price:</label>
                                                <div class="col-sm-10"><input type="text" maxlength="4"  pattern="\d{1,4}" class="form-control" name="price" required title="Please enter a number between 1 and 999"></div>
                                            </div>

                                        </fieldset>

                                </fieldset>




          <p style="text-align: center;"><button style="background-color: #0B5ED7; color: white;" type="submit" name="submit" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Add Cake</button></p>



                            </form>
                        </div>
                    </div>
                    </div>

                </div>
                <div class="text-center mt-4 mb-3">
                <a  style="background-color: #0B5ED7; color:white;"  href="dashboard.php" class="btn btn-secondary">
                    <i class="fa fa-arrow-left"></i> Back to Dashboard
                </a>
            </div>
            </div>
        <?php include_once 'includes/footer.php'; ?>

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
        // Set quantity to 1 when page loads and keep it fixed
        window.addEventListener('load', function() {
            const quantityInput = document.getElementsByName('quantity')[0];
            quantityInput.value = '1';
            quantityInput.readOnly = true;
        });

        function validateItemName(event) {
            // Allow only letters, spaces, and hyphens
            const char = String.fromCharCode(event.which);
            if (!/^[a-zA-Z\s\-]$/.test(char)) {
                event.preventDefault();
                return false;
            }
            return true;
        }

        // Additional validation to prevent pasting non-string content
        document.getElementsByName('itemname')[0].addEventListener('paste', function(e) {
            e.preventDefault();
            const pastedText = (e.clipboardData || window.clipboardData).getData('text');
            if (/^[a-zA-Z\s\-]+$/.test(pastedText)) {
                this.value += pastedText;
            }
        });

        // Remove quantity validation since it's now readonly
        document.getElementsByName('price')[0].addEventListener('input', function (e) {
            this.value = this.value.replace(/[^0-9]/g, ''); // Removes any non-numeric characters
            if (this.value < 1) this.value = ''; // Ensures no zero or negative values
        });
    </script>

</body>

</html>
