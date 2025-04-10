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
    <title>cake bakery  - Category Details</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Owl Carousel -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">

    <!-- Custom CSS -->
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
            --glass-bg: rgba(255, 255, 255, 0.95);
        }

        body {
            font-family: 'Montserrat', sans-serif;
            color: var(--text-color);
            background-color: #f8f9fa;
        }

        /* Featured Section */
        .featured-section {
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

        .section-title p {
            color: #777;
            font-size: 1.1rem;
            max-width: 600px;
            margin: 0 auto;
        }

        /* Product Card */
        .product-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px var(--shadow-color);
            transition: all 0.3s ease;
            margin-bottom: 30px;
            position: relative;
        }

        .product-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        .product-img {
            position: relative;
            overflow: hidden;
            height: 250px;
        }

        .product-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: all 0.5s ease;
        }

        .product-card:hover .product-img img {
            transform: scale(1.1);
        }

        .product-price {
            position: absolute;
            top: 15px;
            right: 15px;
             background-color: #FF6B6B;
            color: white;
            padding: 8px 15px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.9rem;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
        }

        .product-content {
            padding: 20px;
        }

        .product-title {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 10px;
            color: var(--dark-color);
        }

        .product-title a {
            color: var(--dark-color);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .product-title a:hover {
            color: var(--primary-color);
        }

        .product-desc {
            color: #777;
            font-size: 0.9rem;
            margin-bottom: 15px;
            line-height: 1.5;
        }

        .product-btn {
             background-color: #FF6B6B;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 50px;
            font-weight: 500;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            display: inline-block;
            text-decoration: none;
            text-align: center;
            width: 100%;
        }

        .product-btn:hover {
            background: linear-gradient(135deg, var(--secondary-color), var(--primary-color));
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(108, 99, 255, 0.3);
        }

        /* Pagination */
        .pagination {
            margin-top: 40px;
            justify-content: center;
        }

        .pagination li {
            margin: 0 5px;
        }

        .pagination li a {
            color: var(--text-color);
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .pagination li.active a {
            background: var(--primary-color);
            color: white;
        }

        .pagination li a:hover {
            background: var(--light-color);
            color: var(--primary-color);
        }

        .pagination li.disabled a {
            color: #999;
            pointer-events: none;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <?php include_once 'includes/header.php'; ?>

    <!-- Featured Section -->
    <section class="featured-section">
        <div class="container">
            <div class="section-title">
                <h2>Our Category-wise cakes</h2>
                <p>Explore our delightful collection of cakes organized by categories, each crafted with traditional recipes and finest ingredients</p>
            </div>

            <div class="row">
                <?php
                    $cname = $_GET['catname'];
                    if (isset($_GET['page_no']) && $_GET['page_no'] != "") {
                        $page_no = $_GET['page_no'];
                    } else {
                        $page_no = 1;
                    }

                    $total_records_per_page = 12;
                    $offset                 = ($page_no - 1) * $total_records_per_page;
                    $previous_page          = $page_no - 1;
                    $next_page              = $page_no + 1;
                    $adjacents              = "2";

                    $result_count      = mysqli_query($con, "SELECT COUNT(*) As total_records FROM tblfood where CategoryName='$cname'");
                    $total_records     = mysqli_fetch_array($result_count);
                    $total_records     = $total_records['total_records'];
                    $total_no_of_pages = ceil($total_records / $total_records_per_page);
                    $second_last       = $total_no_of_pages - 1;
                    $ret               = mysqli_query($con, "select * from tblfood where CategoryName='$cname' LIMIT $offset, $total_records_per_page");
                    $cnt               = 1;
                    while ($row = mysqli_fetch_array($ret)) {
                    ?>
                <div class="col-lg-4 col-md-6">
                    <div class="product-card">
                        <div class="product-img">
                            <img src="admin/itemimages/<?php echo $row['Image']; ?>" alt="<?php echo $row['ItemName']; ?>">
                            <div class="product-price">₹<?php echo $row['ItemPrice']; ?></div>
                        </div>
                        <div class="product-content">
                            <h3 class="product-title"><a href="cake-detail.php?fid=<?php echo $row['ID']; ?>"><?php echo $row['ItemName']; ?></a></h3>
                            <p class="product-desc">Delicious cake made with premium ingredients and crafted with love.</p>

                            <?php if ($_SESSION['fosuid'] == "") {?>
                                <!-- <a href="login.php" class="product-btn">Add to Cart</a> -->
                            <?php } else {?>
                                <form method="post">
                                    <input type="hidden" name="foodid" value="<?php echo $row['ID']; ?>">
                                    <!-- <button type="submit" name="submit" class="product-btn">Add to Cart</button> -->
                                </form>
                            <?php }?>
                        </div>
                    </div>
                </div>
                <?php }?>
            </div>

            <!-- Pagination -->
            <ul class="pagination">
                <li                    <?php if ($page_no <= 1) {echo "class='disabled'";}?>>
                    <a                       <?php if ($page_no > 1) {echo "href='?page_no=$previous_page'";}?>>Previous</a>
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

                <li                    <?php if ($page_no >= $total_no_of_pages) {echo "class='disabled'";}?>>
                    <a                       <?php if ($page_no < $total_no_of_pages) {echo "href='?page_no=$next_page'";}?>>Next</a>
                </li>
                <?php if ($page_no < $total_no_of_pages) {
                        echo "<li><a href='?page_no=$total_no_of_pages'>Last &rsaquo;&rsaquo;</a></li>";
                }?>
            </ul>
        </div>
    </section>

    <!-- Footer -->
    <?php include_once 'includes/footer.php'; ?>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Owl Carousel -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

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