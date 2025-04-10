<?php
    session_start();
    error_reporting(0);
    include 'includes/dbconnection.php';

    if (isset($_POST['submit'])) {
        $foodid   = $_POST['foodid'];
        $weight   = $_POST['weight'];
        $userid   = $_SESSION['fosuid'];
        $quantity = isset($_POST['quantity']) ? (int) $_POST['quantity'] : 1;

        if (! $userid) {
            echo "<script>
                Swal.fire({
                    title: 'Login Required',
                    text: 'Please log in to add items to the cart.',
                    icon: 'warning',
                    confirmButtonText: 'Login Now',
                    customClass: {
                        popup: 'swal2-popup',
                        title: 'swal2-title',
                        confirmButton: 'swal2-confirm'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'login.php';
                    }
                });
            </script>";
            exit();
        }

        // Fetch the base price
        $result    = mysqli_query($con, "SELECT ItemPrice FROM tblfood WHERE ID='$foodid'");
        $row       = mysqli_fetch_assoc($result);
        $basePrice = $row['ItemPrice'];

        switch ($weight) {
            case '500g':
                $price = $basePrice * 0.5;
                break;
            case '1kg':
                $price = $basePrice * 1;
                break;
            case '1.5kg':
                $price = $basePrice * 1.5;
                break;
            case '2kg':
                $price = $basePrice * 2;
                break;
            default:
                $price = $basePrice;
        }

        $price = $price * 1.05; // Add 5% increment

        // Check if the item already exists
        $checkQuery = mysqli_query($con, "SELECT ID, Quantity FROM tblorders WHERE UserId='$userid' AND FoodId='$foodid' AND Weight='$weight' AND IsOrderPlaced IS NULL");

        if (mysqli_num_rows($checkQuery) > 0) {
            $existingRow      = mysqli_fetch_assoc($checkQuery);
            $existingId       = $existingRow['ID'];
            $existingQuantity = $existingRow['Quantity'];

            // Update quantity and price
            $newQuantity = $existingQuantity + $quantity;
            $newPrice    = $price * $newQuantity;

            $updateQuery = mysqli_query($con, "UPDATE tblorders SET Quantity='$newQuantity', Price='$newPrice' WHERE ID='$existingId'");

            if ($updateQuery) {
                echo "<script>
                    Swal.fire({
                        title: 'Cart Updated',
                        text: 'cake quantity updated in the cart. Total price: ₹" . number_format($newPrice, 2) . "',
                        icon: 'success',
                        confirmButtonText: 'Continue Shopping',
                        customClass: {
                            popup: 'swal2-popup',
                            title: 'swal2-title',
                            confirmButton: 'swal2-confirm'
                        }
                    });
                </script>";
            } else {
                echo "<script>
                    Swal.fire({
                        title: 'Update Failed',
                        text: 'Failed to update the cart. Please try again.',
                        icon: 'error',
                        confirmButtonText: 'OK',
                        customClass: {
                            popup: 'swal2-popup',
                            title: 'swal2-title',
                            confirmButton: 'swal2-confirm'
                        }
                    });
                </script>";
            }
        } else {
            // Insert new entry
            $query = mysqli_query($con, "INSERT INTO tblorders (UserId, FoodId, Weight, Quantity, Price) VALUES ('$userid', '$foodid', '$weight', '$quantity', '$price')");

            if ($query) {
                echo "<script>
                    Swal.fire({
                        title: 'Added to Cart',
                        text: 'cake has been added to the cart with the selected weight and price: ₹" . number_format($price, 2) . "',
                        icon: 'success',
                        confirmButtonText: 'Continue Shopping',
                        customClass: {
                            popup: 'swal2-popup',
                            title: 'swal2-title',
                            confirmButton: 'swal2-confirm'
                        }
                    });
                </script>";
            } else {
                echo "<script>
                    Swal.fire({
                        title: 'Error',
                        text: 'Something went wrong. Please try again.',
                        icon: 'error',
                        confirmButtonText: 'OK',
                        customClass: {
                            popup: 'swal2-popup',
                            title: 'swal2-title',
                            confirmButton: 'swal2-confirm'
                        }
                    });
                </script>";
            }
        }
    }

    // Delete item from cart
    if (isset($_GET['delid'])) {
        $delid       = $_GET['delid'];
        $deleteQuery = mysqli_query($con, "DELETE FROM tblorders WHERE ID='$delid'");

        if ($deleteQuery) {
            echo "<script>
                Swal.fire({
                    title: 'Item Removed',
                    text: 'Item has been removed from your cart.',
                    icon: 'success',
                    confirmButtonText: 'OK',
                    customClass: {
                        popup: 'swal2-popup',
                        title: 'swal2-title',
                        confirmButton: 'swal2-confirm'
                    }
                }).then((result) => {
                    window.location.href = 'cart.php';
                });
            </script>";
        } else {
            echo "<script>
                Swal.fire({
                    title: 'Error',
                    text: 'Failed to remove item.',
                    icon: 'error',
                    confirmButtonText: 'OK',
                    customClass: {
                        popup: 'swal2-popup',
                        title: 'swal2-title',
                        confirmButton: 'swal2-confirm'
                    }
                });
            </script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cake bakery  - Shopping Cart</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- SweetAlert2 -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.10/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.10/dist/sweetalert2.all.min.js"></script>
    
    <style>
        :root {
            --primary-color: #FF8E9E;
            --secondary-color: #6C63FF;
            --dark-color: #2D3047;
            --light-color: #F9F9F9;
            --accent-color: #FFD93D;
            --text-color: #333333;
            --border-color: rgba(255, 255, 255, 0.1);
            --shadow-color: rgba(0, 0, 0, 0.05);
        }

        body {
            font-family: 'Montserrat', sans-serif;
            color: var(--text-color);
            background-color: #f8f9fa;
        }

        .cart-section {
            padding: 100px 0;
            background-color: white;
        }

        .section-title {
            text-align: center;
            margin-bottom: 60px;
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

        .cart-table {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 15px var(--shadow-color);
            overflow: hidden;
        }

        .table {
            margin-bottom: 0;
        }

        /* .table thead th {
             background-color: #FF6B6B;
            color: white;
            border: none;
            padding: 15px;
            font-weight: 500;
        } */

        .table tbody td {
            padding: 20px 15px;
            vertical-align: middle;
            border-bottom: 1px solid #eee;
        }

        .product-image {
            width: 100px;
            height: 80px;
            object-fit: cover;
            border-radius: 8px;
            box-shadow: 0 2px 5px var(--shadow-color);
        }

        .delete-btn {
            color: #dc3545;
            transition: all 0.3s ease;
        }

        .delete-btn:hover {
            color: #c82333;
            transform: scale(1.1);
        }

        .cart-summary {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 15px var(--shadow-color);
            margin-top: 30px;
        }

        .cart-total {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 20px;
        }

        .checkout-btn {
             background-color: #FF6B6B;
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: 500;
            font-size: 1rem;
            transition: all 0.3s ease;
            width: 100%;
        }

        .checkout-btn:hover {
            background: linear-gradient(135deg, var(--secondary-color), var(--primary-color));
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(108, 99, 255, 0.3);
        }

        @media (max-width: 768px) {
            .cart-section {
                padding: 60px 0;
            }

            .section-title h2 {
                font-size: 2rem;
            }

            .table-responsive {
                margin-bottom: 20px;
            }

            .cart-summary {
                padding: 20px;
            }
        }

        /* SweetAlert2 Custom Styles */
        .swal2-popup {
            font-family: 'Montserrat', sans-serif !important;
            border-radius: 15px !important;
            padding: 2em !important;
        }

        .swal2-title {
            color: var(--dark-color) !important;
            font-weight: 600 !important;
            font-size: 1.5rem !important;
        }

        .swal2-html-container {
            color: var(--text-color) !important;
            font-family: 'Montserrat', sans-serif !important;
        }

        .swal2-confirm {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color)) !important;
            border: none !important;
            border-radius: 50px !important;
            padding: 12px 30px !important;
            font-weight: 500 !important;
            transition: all 0.3s ease !important;
        }

        .swal2-confirm:hover {
            background: linear-gradient(135deg, var(--secondary-color), var(--primary-color)) !important;
            transform: translateY(-2px) !important;
            box-shadow: 0 5px 15px rgba(255, 142, 158, 0.3) !important;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <?php include_once 'includes/header.php'; ?>

    <!-- Cart Section -->
    <section class="cart-section">
        <div class="container">
            <div class="section-title">
                <h2>Shopping Cart</h2>
            </div>

            <div class="cart-table">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Preview</th>
                                <th>Product</th>
                                <th>Category</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Weight</th>
                                <th>Quantity</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $userid = $_SESSION['fosuid'];
                            $query  = mysqli_query($con, "SELECT tblfood.Image, tblfood.ItemName, tblfood.CategoryName, tblfood.ItemDes, tblfood.ItemPrice, tblorders.Weight, tblorders.Quantity, tblorders.Price, tblorders.ID FROM tblorders JOIN tblfood ON tblfood.ID=tblorders.FoodId WHERE tblorders.UserId='$userid' AND tblorders.IsOrderPlaced IS NULL");

                            $grandtotal = 0;
                            while ($row = mysqli_fetch_array($query)) {
                            ?>
                            <tr>
                                <td>
                                    <img src="admin/itemimages/<?php echo $row['Image']; ?>" 
                                         class="product-image" 
                                         alt="<?php echo $row['ItemName']; ?>">
                                </td>
                                <td><?php echo $row['ItemName']; ?></td>
                                <td><?php echo $row['CategoryName']; ?></td>
                                <td><?php echo $row['ItemDes']; ?></td>
                                <td>Rs.<?php echo number_format($row['Price'], 2); ?></td>
                                <td><?php echo $row['Weight']; ?></td>
                                <td><?php echo $row['Quantity']; ?></td>
                                <td>
                                    <a href="javascript:void(0);" 
                                       onclick="confirmDelete(<?php echo $row['ID']; ?>)"
                                       class="delete-btn">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php
                                $grandtotal += $row['Price'];
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="cart-summary">
                <div class="row align-items-center justify-content-end">
                    <div class="col-md-3">
                        <div class="cart-total text-end">
                            Total: Rs.<?php echo number_format($grandtotal, 2); ?>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <a style="text-decoration: none;" href="checkout.php" class="checkout-btn">
                            Proceed to Checkout
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php include_once 'includes/footer.php'; ?>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        $(document).ready(function(){
            // Initialize all dropdowns
            var dropdownElementList = [].slice.call(document.querySelectorAll('[data-bs-toggle="dropdown"]'));
            var dropdownList = dropdownElementList.map(function (dropdownToggleEl) {
                return new bootstrap.Dropdown(dropdownToggleEl);
            });
        });

        function confirmDelete(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, remove it!',
                cancelButtonText: 'No, cancel!',
                customClass: {
                    popup: 'swal2-popup',
                    title: 'swal2-title',
                    confirmButton: 'swal2-confirm'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'cart.php?delid=' + id;
                }
            });
        }
    </script>
</body>
</html>