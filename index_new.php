<?php
    session_start();
    error_reporting(0);
    include 'includes/dbconnection.php';
    if (isset($_POST['submit'])) {
        $foodid = $_POST['foodid'];
        $userid = $_SESSION['fosuid'];
        $query  = mysqli_query($con, "insert into tblorders(UserId,FoodId) values('$userid','$foodid') ");
        if ($query) {
            echo "<script>alert('cake has been added to your cart');</script>";
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
    <title>Cake bakery </title>
    
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

        /* Hero Section */
        .hero-section {
            background: linear-gradient(135deg, rgba(255, 142, 158, 0.8), rgba(108, 99, 255, 0.8)), url('img/hero-bg.jpg');
            background-size: cover;
            background-position: center;
            padding: 120px 0;
            color: white;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('img/pattern.png');
            opacity: 0.1;
        }

        .hero-content {
            position: relative;
            z-index: 1;
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 20px;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }

        .hero-subtitle {
            font-size: 1.5rem;
            margin-bottom: 30px;
            opacity: 0.9;
        }

        .hero-btn {
            background: white;
            color: var(--primary-color);
            border: none;
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            text-decoration: none;
            display: inline-block;
        }

        .hero-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            background: var(--accent-color);
            color: var(--dark-color);
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

        /* Owl Carousel Custom */
        .owl-nav {
            position: absolute;
            top: 50%;
            width: 100%;
            transform: translateY(-50%);
            display: flex;
            justify-content: space-between;
            padding: 0 20px;
            pointer-events: none;
        }

        .owl-prev, .owl-next {
            width: 40px;
            height: 40px;
            background: white !important;
            border-radius: 50% !important;
            display: flex !important;
            align-items: center;
            justify-content: center;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
            pointer-events: auto;
            transition: all 0.3s ease;
        }

        .owl-prev:hover, .owl-next:hover {
            background: var(--primary-color) !important;
            color: white !important;
        }

        .owl-dots {
            text-align: center;
            margin-top: 20px;
        }

        .owl-dot {
            width: 10px;
            height: 10px;
            margin: 0 5px;
            border-radius: 50%;
            background: #ddd !important;
            transition: all 0.3s ease;
        }

        .owl-dot.active {
            background: var(--primary-color) !important;
            transform: scale(1.2);
        }

        /* About Section */
        .about-section {
            padding: 100px 0;
            background: linear-gradient(135deg, rgba(255, 142, 158, 0.05), rgba(108, 99, 255, 0.05));
        }

        .about-content {
            padding: 30px;
        }

        .about-title {
            font-size: 2.2rem;
            font-weight: 700;
            color: var(--dark-color);
            margin-bottom: 20px;
        }

        .about-text {
            color: #777;
            line-height: 1.8;
            margin-bottom: 30px;
        }

        .about-img {
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .about-img img {
            width: 100%;
            height: auto;
            transition: all 0.5s ease;
        }

        .about-img:hover img {
            transform: scale(1.05);
        }

        /* Features Section */
        .features-section {
            padding: 80px 0;
            background-color: white;
        }

        .feature-item {
            text-align: center;
            padding: 30px 20px;
            border-radius: 15px;
            transition: all 0.3s ease;
            height: 100%;
        }

        .feature-item:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        }

        .feature-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, rgba(255, 142, 158, 0.1), rgba(108, 99, 255, 0.1));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 2rem;
            color: var(--primary-color);
            transition: all 0.3s ease;
        }

        .feature-item:hover .feature-icon {
             background-color: #FF6B6B;
            color: white;
        }

        .feature-title {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 15px;
            color: var(--dark-color);
        }

        .feature-desc {
            color: #777;
            font-size: 0.9rem;
            line-height: 1.6;
        }

        /* Responsive */
        @media (max-width: 991.98px) {
            .hero-title {
                font-size: 2.5rem;
            }
            
            .hero-subtitle {
                font-size: 1.2rem;
            }
            
            .section-title h2 {
                font-size: 2rem;
            }
            
            .about-content {
                margin-bottom: 30px;
            }
        }
        
        @media (max-width: 767.98px) {
            .hero-section {
                padding: 80px 0;
            }
            
            .hero-title {
                font-size: 2rem;
            }
            
            .featured-section, .about-section, .features-section {
                padding: 60px 0;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <?php include_once 'includes/header.php'; ?>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="hero-content">
                <h1 class="hero-title">Cake Bakery</h1>
                <p class="hero-subtitle">Discover the finest Cakes and confectionery for every occasion</p>
                <a href="#featured" class="hero-btn">Explore Our Collection</a>
            </div>
        </div>
    </section>

    <!-- Featured Section -->
    <section id="featured" class="featured-section">
        <div class="container">
            <div class="section-title">
                <h2>Our Featured Cakes</h2>
                <p>Explore our handcrafted collection of delicious Cakes made with the finest ingredients</p>
            </div>
            
            <div class="owl-carousel featured-carousel">
                <?php
                $ret = mysqli_query($con, "select * from tblfood");
                while ($row = mysqli_fetch_array($ret)) {
                ?>
                <div class="item">
                    <div class="product-card">
                        <div class="product-img">
                            <img src="admin/itemimages/<?php echo $row['Image']; ?>" alt="<?php echo $row['ItemName']; ?>">
                            <div class="product-price">₹<?php echo $row['ItemPrice']; ?></div>
                        </div>
                        <div class="product-content">
                            <h3 class="product-title"><a href="cake-detail.php?fid=<?php echo $row['ID']; ?>"><?php echo $row['ItemName']; ?></a></h3>
                            <p class="product-desc">Delicious Cake made with premium ingredients and crafted with love.</p>
                            
                            <?php if ($_SESSION['fosuid'] == "") { ?>
                                <a href="login.php" class="product-btn">Add to Cart</a>
                            <?php } else { ?>
                                <form method="post">
                                    <input type="hidden" name="foodid" value="<?php echo $row['ID']; ?>">
                                    <button type="submit" name="submit" class="product-btn">Add to Cart</button>
                                </form>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="about-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="about-content">
                        <?php
                        $ret = mysqli_query($con, "select * from tblpage where PageType='aboutus' ");
                        while ($row = mysqli_fetch_array($ret)) {
                        ?>
                        <h2 class="about-title"><?php echo $row['PageTitle']; ?></h2>
                        <p class="about-text"><?php echo $row['PageDescription']; ?></p>
                        <a href="about-us.php" class="product-btn">Learn More</a>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-img">
                        <img src="img/cake-feature/welcome-right.jpg" alt="About Cake Delights">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section">
        <div class="container">
            <div class="section-title">
                <h2>Why Choose Us</h2>
                <p>We are committed to providing the best quality Cakes and service to our customers</p>
            </div>
            
            <div class="row">
                <div class="col-md-4">
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="fas fa-award"></i>
                        </div>
                        <h3 class="feature-title">Premium Quality</h3>
                        <p class="feature-desc">We use only the finest ingredients to ensure the highest quality in every Cake we make.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="fas fa-truck"></i>
                        </div>
                        <h3 class="feature-title">Fast Delivery</h3>
                        <p class="feature-desc">Our delivery service ensures your Cakes reach you fresh and on time, every time.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="fas fa-heart"></i>
                        </div>
                        <h3 class="feature-title">Made with Love</h3>
                        <p class="feature-desc">Each Cake is crafted with care and attention to detail, ensuring a delightful experience.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php include_once 'includes/footer.php'; ?>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Owl Carousel -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    
    <script>
        $(document).ready(function(){
            // Initialize Owl Carousel
            $('.featured-carousel').owlCarousel({
                loop: true,
                margin: 30,
                nav: true,
                dots: true,
                autoplay: true,
                autoplayTimeout: 5000,
                autoplayHoverPause: true,
                responsive: {
                    0: {
                        items: 1
                    },
                    576: {
                        items: 2
                    },
                    992: {
                        items: 3
                    }
                }
            });
            
            // Smooth scroll for anchor links
            $('a[href*="#"]').not('[href="#"]').not('[href="#0"]').click(function(event) {
                if (
                    location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') 
                    && 
                    location.hostname == this.hostname
                ) {
                    var target = $(this.hash);
                    target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                    if (target.length) {
                        event.preventDefault();
                        $('html, body').animate({
                            scrollTop: target.offset().top - 100
                        }, 1000);
                    }
                }
            });
        });
    </script>
</body>
</html> 