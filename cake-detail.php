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
            $_SESSION['sweet_alert'] = [
                'title'    => 'Login Required',
                'text'     => 'Please log in to add items to the cart.',
                'icon'     => 'warning',
                'redirect' => 'login.php',
            ];
            exit();
        }

        // Fetch the base price
        $result    = mysqli_query($con, "SELECT ItemPrice FROM tblfood WHERE ID='$foodid'");
        $row       = mysqli_fetch_assoc($result);
        $basePrice = $row['ItemPrice'];

        // Calculate price based on weight
        switch ($weight) {
            case '250g':
                $price = $basePrice * 0.25;
                break;
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

        $price = $price;

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
                $_SESSION['sweet_alert'] = [
                    'title' => 'Cart Updated',
                    'text'  => 'cake quantity updated in the cart.',
                    'icon'  => 'success',
                ];
            } else {
                $_SESSION['sweet_alert'] = [
                    'title' => 'Error',
                    'text'  => 'Failed to update the cart. Please try again.',
                    'icon'  => 'error',
                ];
            }
        } else {
            // Insert new entry with price multiplied by quantity
            $totalPrice = $price * $quantity;
            $query      = mysqli_query($con, "INSERT INTO tblorders (UserId, FoodId, Weight, Quantity, Price) VALUES ('$userid', '$foodid', '$weight', '$quantity', '$totalPrice')");

            if ($query) {
                $_SESSION['sweet_alert'] = [
                    'title' => 'Added to Cart!',
                    'text'  => 'cake has been added to your cart successfully!',
                    'icon'  => 'success',
                ];
            } else {
                $_SESSION['sweet_alert'] = [
                    'title' => 'Error',
                    'text'  => 'Something went wrong. Please try again.',
                    'icon'  => 'error',
                ];
            }
        }
    }

    // Delete item from cart
    if (isset($_GET['delid'])) {
        $delid       = $_GET['delid'];
        $deleteQuery = mysqli_query($con, "DELETE FROM tblorders WHERE ID='$delid'");

        if ($deleteQuery) {
            $_SESSION['sweet_alert'] = [
                'title'    => 'Item Removed',
                'text'     => 'Item has been removed from your cart.',
                'icon'     => 'success',
                'redirect' => 'cart.php',
            ];
        } else {
            $_SESSION['sweet_alert'] = [
                'title' => 'Error',
                'text'  => 'Failed to remove item.',
                'icon'  => 'error',
            ];
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cake bakery  - Cake Details</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- jQuery first -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Then SweetAlert2 -->
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
            --border-color: rgba(0, 0, 0, 0.1);
            --shadow-color: rgba(0, 0, 0, 0.05);
        }

        body {
            font-family: 'Montserrat', sans-serif;
            color: var(--text-color);
            background-color: #f8f9fa;
        }

        .cake-detail-section {
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

        .cake-image {
            border-radius: 15px;
            box-shadow: 0 5px 15px var(--shadow-color);
            overflow: hidden;
            margin-bottom: 20px;
        }

        .cake-image img {
            width: 100%;
            height: auto;
            transition: transform 0.3s ease;
        }

        .cake-image:hover img {
            transform: scale(1.05);
        }

        .cake-details {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 15px var(--shadow-color);
        }

        .cake-details h4 {
            color: var(--dark-color);
            font-size: 1.8rem;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .cake-details p {
            margin-bottom: 15px;
            line-height: 1.6;
        }

        .cake-details strong {
            color: var(--dark-color);
            font-weight: 600;
        }

        .form-control {
            border: 2px solid #eee;
            border-radius: 50px;
            padding: 12px 20px;
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(255, 142, 158, 0.25);
        }

        .add-to-cart-btn {
             background-color: #FF6B6B;
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: 500;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            width: 100%;
            margin-top: 20px;
        }

        .add-to-cart-btn:hover {
            background: linear-gradient(135deg, var(--secondary-color), var(--primary-color));
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(108, 99, 255, 0.3);
        }

        select.form-control {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='%23333' viewBox='0 0 16 16'%3E%3Cpath d='M8 12L1 5h14z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 20px center;
            padding-right: 40px;
        }

        @media (max-width: 768px) {
            .cake-detail-section {
                padding: 40px 0;
            }

            .section-title h2 {
                font-size: 2rem;
            }

            .cake-details {
                padding: 20px;
                margin-top: 20px;
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
    <?php include_once 'includes/header.php'; ?>
<?php include_once 'includes/loader.php'; ?>

    <section class="cake-detail-section">
        <div class="container">
            <div class="section-title">
                <h2>Cake Details</h2>
            </div>

            <div class="row">
                <?php
                    $cid = $_GET['fid'];
                    $ret = mysqli_query($con, "SELECT * FROM tblfood WHERE ID='$cid'");
                    while ($row = mysqli_fetch_array($ret)) {
                    ?>
                <div class="col-lg-5">
                    <div class="cake-image">
                        <img src="admin/itemimages/<?php echo $row['Image']; ?>" alt="<?php echo $row['ItemName']; ?>" class="img-fluid">
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="cake-details">
                        <h4><?php echo $row['ItemName']; ?></h4>
                        <p><strong>Category:</strong>                                                      <?php echo $row['CategoryName']; ?></p>
                        <p><strong>Base Price (per kg):</strong> ₹<?php echo number_format($row['ItemPrice'], 2); ?></p>
                        <p><strong>Description:</strong>                                                         <?php echo $row['ItemDes']; ?></p>

                        <?php if ($_SESSION['fosuid'] == "") {?>
                            <a href="login.php" class="add-to-cart-btn">
                                <i class="fas fa-sign-in-alt me-2"></i>Login to Add to Cart
                            </a>
                        <?php } else {?>
                            <form method="post">
                                <input type="hidden" name="foodid" value="<?php echo $row['ID']; ?>">
                                <div class="form-group">
                                    <label for="weight" class="mb-2"><i class="fas fa-weight me-2"></i>Select Weight:</label>
                                    <select name="weight" class="form-control" required>
                                        <option value="250g">250g</option>
                                        <option value="500g">500g</option>
                                        <option value="1kg">1kg</option>
                                        <option value="1.5kg">1.5kg</option>
                                        <option value="2kg">2kg</option>
                                        <option value="2.5kg">2.5kg</option>
                                        <option value="3kg">3kg</option>
                                        <option value="3.5kg">3.5kg</option>
                                        <option value="4kg">4kg</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="quantity" class="mb-2"><i class="fas fa-shopping-basket me-2"></i>Select Quantity:</label>
                                    <input type="number" name="quantity" class="form-control" min="1" value="1" required>
                                </div>
                                <button type="submit" name="submit" class="add-to-cart-btn">
                                    <i class="fas fa-cart-plus me-2"></i>Add to Cart
                                </button>
                            </form>
                        <?php }?>
                    </div>
                </div>
                <?php }?>
            </div>

        </div>
    </section>



    <?php include_once 'includes/footer.php'; ?>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            // Show SweetAlert2 if there's a message
            <?php if (isset($_SESSION['sweet_alert'])): ?>
                Swal.fire({
                    title: '<?php echo $_SESSION['sweet_alert']['title']; ?>',
                    text: '<?php echo $_SESSION['sweet_alert']['text']; ?>',
                    icon: '<?php echo $_SESSION['sweet_alert']['icon']; ?>',
                    confirmButtonText: 'OK',
                    customClass: {
                        popup: 'swal2-popup',
                        title: 'swal2-title',
                        confirmButton: 'swal2-confirm'
                    }
                })<?php if (isset($_SESSION['sweet_alert']['redirect'])): ?>.then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '<?php echo $_SESSION['sweet_alert']['redirect']; ?>';
                    }
                })<?php endif; ?>;

                <?php
                    // Clear the alert after showing it
                    unset($_SESSION['sweet_alert']);
                ?>
<?php endif; ?>

            // Initialize tooltips
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });

            // Price calculation preview
            $('select[name="weight"], input[name="quantity"]').on('change', function() {
                // Add price calculation preview logic here if needed
            });
        });
    </script>
</body>
</html>