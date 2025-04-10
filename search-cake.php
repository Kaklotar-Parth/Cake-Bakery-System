<?php
    session_start();
    error_reporting(0);
    include 'includes/dbconnection.php';
    if (isset($_POST['submit'])) {
        $foodid = $_POST['foodid'];
        $userid = $_SESSION['fosuid'];
        $query  = mysqli_query($con, "insert into tblorders(UserId,FoodId) values('$userid','$foodid') ");
        if ($query) {
            echo "<script>alert('Cake has been added in to the cart');</script>";
        } else {
            echo "<script>alert('Something went wrong.');</script>";
        }
    }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cake bakery  - Search Cakes</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">

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

        .search-section {
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

        .search-form {
            max-width: 600px;
            margin: 0 auto 40px;
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 15px var(--shadow-color);
        }

        .search-input {
            border: 2px solid #eee;
            border-radius: 50px;
            padding: 15px 25px;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            margin-bottom: 20px;
        }

        .search-input:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(255, 142, 158, 0.25);
        }

        .search-btn {
             background-color: #FF6B6B;
            color: white;
            border: none;
            padding: 15px 30px;
            border-radius: 50px;
            font-weight: 500;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            width: 100%;
        }

        .search-btn:hover {
            background: linear-gradient(135deg, var(--secondary-color), var(--primary-color));
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(108, 99, 255, 0.3);
        }

        .search-results {
            margin-top: 40px;
        }

        .search-results h3 {
            text-align: center;
            color: var(--dark-color);
            margin-bottom: 30px;
            font-size: 1.8rem;
        }

        .product-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px var(--shadow-color);
            transition: all 0.3s ease;
            margin-bottom: 30px;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px var(--shadow-color);
        }

        .product-image {
            width: 100%;
            height: 250px;
            object-fit: cover;
        }

        .product-info {
            padding: 20px;
        }

        .product-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 10px;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .product-title:hover {
            color: var(--primary-color);
        }

        .product-price {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 15px;
        }

        .add-to-cart-btn {
             background-color: #FF6B6B;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 50px;
            font-weight: 500;
            transition: all 0.3s ease;
            width: 100%;
        }

        .add-to-cart-btn:hover {
            background: linear-gradient(135deg, var(--secondary-color), var(--primary-color));
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(108, 99, 255, 0.3);
        }

        .no-results {
            text-align: center;
            padding: 40px;
            font-size: 1.5rem;
            color: #dc3545;
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 15px var(--shadow-color);
        }

        @media (max-width: 768px) {
            .search-section {
                padding: 60px 0;
            }

            .section-title h2 {
                font-size: 2rem;
            }

            .search-form {
                padding: 20px;
            }

            .product-image {
                height: 200px;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <?php include_once 'includes/header.php'; ?>

    <!-- Search Section -->
    <section class="search-section">
        <div class="container">
            <div class="section-title">
                <h2>Search cake</h2>
            </div>

            <div class="search-form">
                <form method="post">
                    <div class="form-group">
                        <input type="text" class="form-control search-input" id="searchkey" name="searchkey"
                               placeholder="Search cakes by name..." required="true">
                    </div>
                    <div class="form-group">
                        <button type="submit" value="Search" name="search" class="search-btn">
                            <i class="fas fa-search me-2"></i>Search
                        </button>
                    </div>
                </form>
            </div>

            <?php if (isset($_POST['search'])) {
                    $searchkey = $_POST['searchkey'];
                ?>
            <div class="search-results">
                <h3>Search Results for "<?php echo htmlspecialchars($searchkey); ?>"</h3>
                <div class="row">
                    <?php
                        $ret = mysqli_query($con, "select * from tblfood where ItemName like '%$searchkey%'");
                            $num = mysqli_num_rows($ret);
                            if ($num > 0) {
                                while ($row = mysqli_fetch_array($ret)) {
                                ?>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="product-card">
                            <img src="admin/itemimages/<?php echo $row['Image']; ?>"
                                 class="product-image"
                                 alt="<?php echo $row['ItemName']; ?>">
                            <div class="product-info">
                                <div class="product-price">Rs.<?php echo number_format($row['ItemPrice'], 2); ?></div>
                                <a href="cake-detail.php?fid=<?php echo $row['ID']; ?>" class="product-title">
                                    <?php echo $row['ItemName']; ?>
                                </a>
                                <?php if ($_SESSION['fosuid'] == "") {?>
                                    <!-- <a href="login.php" class="add-to-cart-btn">
                                        <i class="fas fa-shopping-cart me-2"></i>Add to Cart
                                    </a> -->
                                <?php } else {?>
                                    <form method="post">
                                        <input type="hidden" name="foodid" value="<?php echo $row['ID']; ?>">
                                        <!-- <button type="submit" name="submit" class="add-to-cart-btn">
                                            <i class="fas fa-shopping-cart me-2"></i>Add to Cart
                                        </button> -->
                                    </form>
                                <?php }?>
                            </div>
                        </div>
                    </div>
                    <?php
                        }
                            } else {
                            ?>
                    <div class="col-12">
                        <div class="no-results">
                            <i class="fas fa-search me-2"></i>No Results Found
                        </div>
                    </div>
                    <?php }?>
                </div>
            </div>
            <?php }?>
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
    </script>
</body>
</html>