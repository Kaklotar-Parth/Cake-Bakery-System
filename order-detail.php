<?php
    session_start();
    error_reporting(0);
    include_once 'includes/dbconnection.php';
    if (strlen($_SESSION['fosuid'] == 0)) {
        header('location:logout.php');
    } else {

    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cake bakery  - Order Details</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.min.css">

    <style>
        :root {
            --primary-color: #FF8E9E;
            --secondary-color: #6C63FF;
            --dark-color: #2D3047;
            --light-color: #F9F9F9;
            --accent-color: #FFD93D;
            --text-color: #333333;
            --border-color: rgba(0, 0, 0, 0.1);
            --shadow-color: rgba(0, 0, 0, 0.05);
        }

        body {
            font-family: 'Montserrat', sans-serif;
            color: var(--text-color);
            background-color: #f8f9fa;
        }

        .order-detail-section {
            padding: 80px 0;
            background-color: white;
        }

        .section-title {
            text-align: center;
            margin-bottom: 50px;
        }

        .section-title h2 {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--dark-color);
            margin-bottom: 15px;
            position: relative;
            display: inline-block;
        }

        .section-title h2::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
             background-color: #FF6B6B;
            border-radius: 3px;
        }

        .order-info-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 15px var(--shadow-color);
            padding: 30px;
            margin-bottom: 30px;
        }

        .order-info-card h3 {
            color: var(--dark-color);
            font-size: 1.8rem;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #eee;
        }

        .order-info-item {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            padding: 10px;
            background: #f8f9fa;
            border-radius: 10px;
        }

        .order-info-item i {
            width: 30px;
            color: var(--primary-color);
            margin-right: 15px;
        }

        .order-info-item span {
            font-weight: 500;
        }

        .order-status {
            padding: 6px 12px;
            border-radius: 50px;
            font-size: 0.9rem;
            font-weight: 500;
            display: inline-block;
        }

        .status-pending {
            background-color: #FFF3CD;
            color: #856404;
        }

        .status-confirmed {
            background-color: #D4EDDA;
            color: #155724;
        }

        .status-delivered {
            background-color: #CCE5FF;
            color: #004085;
        }

        .order-items-table {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 15px var(--shadow-color);
            overflow: hidden;
        }

        .table {
            margin-bottom: 0;
        }

        .table thead th {
            /*  background-color: #FF6B6B; */
            /* color: white; */
            font-weight: 500;
            border: none;
            padding: 15px 20px;
            font-size: 1rem;
        }

        .table tbody td {
            padding: 15px 20px;
            vertical-align: middle;
            border-bottom: 1px solid var(--border-color);
        }

        .table tbody tr:last-child td {
            border-bottom: none;
        }

        .product-image {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 10px;
        }

        .action-btn {
            padding: 8px 16px;
            border-radius: 50px;
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            text-decoration: none;
        }

        .track-btn {
            background-color: var(--primary-color);
            color: white;
            border: none;
        }

        .track-btn:hover {
            background-color: var(--secondary-color);
            transform: translateY(-2px);
        }

        .invoice-btn {
            background-color: var(--secondary-color);
            color: white;
            border: none;
        }

        .invoice-btn:hover {
            background-color: var(--primary-color);
            transform: translateY(-2px);
        }

        .cancel-btn {
            background-color: #dc3545;
            color: white;
            border: none;
        }

        .cancel-btn:hover {
            background-color: #c82333;
            transform: translateY(-2px);
        }

        .delivery-info {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 10px;
            margin-top: 10px;
        }

        .delivery-info h6 {
            color: var(--dark-color);
            margin-bottom: 5px;
        }

        @media (max-width: 991.98px) {
            .order-detail-section {
                padding: 60px 0;
            }
        }

        @media (max-width: 767.98px) {
            .section-title h2 {
                font-size: 2rem;
            }

            .order-info-card {
                padding: 20px;
            }

            .product-image {
                width: 60px;
                height: 60px;
            }
        }
    </style>
</head>
<body>
    <?php include_once 'includes/header.php'; ?>

    <section class="order-detail-section">
        <div class="container">
            <div class="section-title">
                <h2>Order Details</h2>
            </div>

            <?php
            $oid = $_GET['orderid'];
            $userid = $_SESSION['fosuid'];
            $ret = mysqli_query($con, "SELECT oa.OrderTime, oa.OrderFinalStatus, o.DeliveryBoyId 
                FROM tblorderaddresses oa 
                LEFT JOIN tblorders o ON oa.Ordernumber = o.OrderNumber 
                WHERE oa.UserId='$userid' AND oa.Ordernumber='$oid'");
            
            $orderTime = '';
            $status = '';
            $statusClass = '';
            $deliveryBoyId = '';
            
            while ($result = mysqli_fetch_array($ret)) {
                $orderTime = $result['OrderTime'];
                $status = $result['OrderFinalStatus'];
                $deliveryBoyId = $result['DeliveryBoyId'];
                
                if ($status == '') {
                    $status = "Not Accept Yet";
                    $statusClass = 'status-pending';
                } elseif (strpos($status, 'Confirmed') !== false) {
                    $statusClass = 'status-confirmed';
                } elseif (strpos($status, 'Delivered') !== false) {
                    $statusClass = 'status-delivered';
                }
                break; // Only need the first row
            }
            ?>
            <div class="order-info-card">
                <h3>Order #<?php echo $oid; ?></h3>
                <div class="order-info-item">
                    <i class="fas fa-calendar-alt"></i>
                    <span>Order Date: <?php echo $orderTime; ?></span>
                </div>
                <div class="order-info-item">
                    <i class="fas fa-info-circle"></i>
                    <span>Status: <span class="order-status <?php echo $statusClass; ?>"><?php echo $status; ?></span></span>
                </div>
                <?php if ($status == "Order Confirmed" || 
                          $status == "Cake being Prepared" || 
                          $status == "Cake Pickup" ||
                          $status == "Cake Delivered") {
                    $order_query = mysqli_query($con, "SELECT d.Name, d.Phone FROM tblorders o 
                                  JOIN tbldeliveryboys d ON d.ID = o.DeliveryBoyId 
                                  WHERE o.OrderNumber='$oid'");
                    $delivery_details = mysqli_fetch_array($order_query);
                    if($delivery_details) {
                ?>
                <div class="delivery-info">
                    <h6><i class="fas fa-motorcycle me-2"></i>Delivery Information</h6>
                    <p class="mb-0">Delivery Boy: <?php echo $delivery_details['Name']; ?></p>
                    <p class="mb-0">Phone: <?php echo $delivery_details['Phone']; ?></p>
                </div>
                <?php } } ?>
            </div>

            <div class="table-responsive">
                <div class="order-items-table">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th>Item Name</th>
                                <th>Weight</th>
                                <th>Quantity</th>
                                <th>Delivery Type</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = mysqli_query($con, "select tblfood.Image,tblfood.ItemName,tblorders.Weight,tblorders.Price,tblorders.FoodId,tblorders.OrderNumber,tblorders.CashonDelivery,tblorders.Quantity from tblorders join tblfood on tblfood.ID=tblorders.FoodId where tblorders.UserId='$userid' and tblorders.OrderNumber=$oid");
                            $num = mysqli_num_rows($query);
                            if ($num > 0) {
                                $cnt = 1;
                                $grandtotal = 0;
                                while ($row = mysqli_fetch_array($query)) {
                                    $grandtotal += $row['Price'];
                            ?>
                            <tr>
                                <td><?php echo $cnt; ?></td>
                                <td>
                                    <img class="product-image" src="admin/itemimages/<?php echo $row['Image']; ?>" alt="<?php echo $row['ItemName']; ?>">
                                </td>
                                <td><?php echo $row['ItemName']; ?></td>
                                <td><?php echo $row['Weight']; ?></td>
                                <td><?php echo $row['Quantity']; ?></td>
                                <td><?php echo $row['CashonDelivery']; ?></td>
                                <td>₹<?php echo $row['Price']; ?></td>
                            </tr>
                            <?php $cnt = $cnt + 1; } ?>
                            <tr>
                                <td colspan="5" class="text-end"><strong>Grand Total:</strong></td>
                                <td><strong>₹<?php echo $grandtotal; ?></strong></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-4 text-center">
                <a href="javascript:void(0);" 
                   onClick="popUpWindow('trackorder.php?oid=<?php echo $oid; ?>');" 
                   class="action-btn track-btn me-2">
                    <i class="fas fa-motorcycle"></i> Check Order Status
                </a>
                <a href="javascript:void(0);" 
                   onClick="popUpWindow('invoice.php?oid=<?php echo $oid; ?>&&odate=<?php echo $orderTime; ?>');" 
                   class="action-btn invoice-btn me-2">
                    <i class="fas fa-file-invoice"></i> View Invoice
                </a>
                <a href="javascript:void(0);" 
                   onClick="popUpWindow('cancelorder.php?oid=<?php echo $oid; ?>');" 
                   class="action-btn cancel-btn">
                    <i class="fas fa-times-circle"></i> Cancel Order
                </a>
            </div>
        </div>
    </section>

    <?php include_once 'includes/footer.php'; ?>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.all.min.js"></script>

    <script>
        var popUpWin = 0;
        function popUpWindow(URLStr, left, top, width, height) {
            if (popUpWin) {
                if (!popUpWin.closed) popUpWin.close();
            }
            popUpWin = open(URLStr, 'popUpWin', 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,copyhistory=yes,width=' + 600 + ',height=' + 600 + ',left=' + left + ', top=' + top + ',screenX=' + left + ',screenY=' + top + '');
        }
    </script>
</body>
</html><?php }?>