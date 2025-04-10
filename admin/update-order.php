<!DOCTYPE html>
<html>
<head>
    <title>Update Order</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
    <div id="wrapper">
        <?php include('includes/leftbar.php');?>
        <div id="page-wrapper" class="gray-bg">
            <?php include('includes/header.php');?>
            
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Update Order #<?php echo $order_id; ?></h2>
                </div>
            </div>

            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox">
                            <div class="ibox-content">
                                <form method="post">
                                    <div class="form-row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="font-bold">Order Details</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" name="order_date" 
                                                           value="<?php echo $order_date; ?>" readonly>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label>Order Status</label>
                                                <select class="form-control" name="status">
                                                    <option value="Preparing" <?php echo $status == 'Preparing' ? 'selected' : ''; ?>>Preparing</option>
                                                    <option value="Out for Delivery" <?php echo $status == 'Out for Delivery' ? 'selected' : ''; ?>>Out for Delivery</option>
                                                    <option value="Delivered" <?php echo $status == 'Delivered' ? 'selected' : ''; ?>>Delivered</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="font-bold">Customer Details</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fa fa-user"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" 
                                                           value="<?php echo $customer_name; ?>" readonly>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label>Delivery Address</label>
                                                <textarea class="form-control" rows="3" readonly><?php echo $delivery_address; ?></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group mt-4">
                                        <label class="font-bold">Products</label>
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered">
                                                <thead class="thead-dark">
                                                    <tr>
                                                        <th>Product Name</th>
                                                        <th>Quantity</th>
                                                        <th>Price</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach($products as $product): ?>
                                                    <tr>
                                                        <td><?php echo $product['name']; ?></td>
                                                        <td><?php echo $product['quantity']; ?></td>
                                                        <td>₹<?php echo $product['price']; ?></td>
                                                    </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="form-group text-right mt-4">
                                        <button type="submit" class="btn btn-primary btn-lg">
                                            <i class="fa fa-save"></i> Update Order
                                        </button>
                                        <a href="viewcakeorder.php?orderid=<?php echo $order_id; ?>" 
                                           class="btn btn-secondary btn-lg">
                                            <i class="fa fa-times"></i> Cancel
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Scripts -->
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>