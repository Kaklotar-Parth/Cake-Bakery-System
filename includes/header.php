<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cake Bakery </title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        :root {
            --primary-color: #FF6B6B;
            --secondary-color: #4ECDC4;
            --dark-color: #2C3E50;
            --light-color: #F7F9FC;
            --accent-color: #FFD93D;
            --text-color: #333333;
            --border-color: #e0e0e0;
            --shadow-color: rgba(0, 0, 0, 0.1);
        }

        body {
            font-family: 'Poppins', sans-serif;
            color: var(--text-color);
        }

        /* Top Bar Styles */
        .top-bar {
            background-color: var(--dark-color);
            padding: 8px 0;
            font-size: 0.9rem;
        }

        .top-bar a {
            color: var(--light-color);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .top-bar a:hover {
            color: var(--accent-color);
        }

        /* Main Header Styles */
        .main-header {
            background-color: white;
            box-shadow: 0 2px 15px var(--shadow-color);
            padding: 15px 0;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .navbar-brand img {
            max-height: 150px;
            width: 230px;
            transition: transform 0.3s ease;
        }

        .navbar-brand img:hover {
            transform: scale(1.05);
        }

        /* Navbar Styles */
        .navbar {
            padding: 0;
        }

        .navbar-nav {
            margin: 0 auto;
        }

        .nav-item {
            position: relative;
            margin: 0 5px;
        }

        .nav-link {
            color: var(--text-color) !important;
            font-weight: 500;
            padding: 10px 15px !important;
            transition: all 0.3s ease;
            position: relative;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 2px;
            background-color: var(--primary-color);
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }

        .nav-link:hover::after,
        .nav-item.active .nav-link::after {
            width: 70%;
        }

        .nav-link:hover {
            color: var(--primary-color) !important;
        }

        .nav-item.active .nav-link {
            color: var(--primary-color) !important;
        }

        /* Dropdown Styles */
        .dropdown-menu {
            border: none;
            box-shadow: 0 5px 15px var(--shadow-color);
            border-radius: 8px;
            padding: 10px 0;
            margin-top: 10px;
            min-width: 200px;
        }

        .dropdown-item {
            padding: 8px 20px;
            transition: all 0.3s ease;
            font-weight: 500;
            color: var(--text-color);
        }

        .dropdown-item:hover {
            background-color: var(--light-color);
            color: var(--primary-color);
            padding-left: 25px;
        }

        .dropdown-divider {
            margin: 5px 0;
            border-top: 1px solid var(--border-color);
        }

        /* Cart and Search Icons */
        .header-icons {
            display: flex;
            align-items: center;
        }

        .icon-link {
            position: relative;
            color: var(--text-color);
            font-size: 1.2rem;
            margin-left: 20px;
            transition: all 0.3s ease;
        }

        .icon-link:hover {
            color: var(--primary-color);
            transform: translateY(-2px);
        }

        .cart-count {
            position: absolute;
            top: -8px;
            right: -8px;
            background-color: var(--primary-color);
            color: white;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.7rem;
            font-weight: 600;
        }

        /* Button Styles */
        .btn-custom {
            padding: 8px 20px;
            border-radius: 25px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-outline-primary {
            color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-outline-primary:hover {
            background-color: var(--primary-color);
            color: white;
            transform: translateY(-2px);
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-primary:hover {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
            transform: translateY(-2px);
        }

        /* Mobile Menu Button */
        .navbar-toggler {
            border: none;
            padding: 0;
            width: 30px;
            height: 20px;
            position: relative;
            transform: rotate(0deg);
            transition: .5s ease-in-out;
            cursor: pointer;
        }

        .navbar-toggler:focus {
            box-shadow: none;
        }

        .navbar-toggler span {
            display: block;
            position: absolute;
            height: 3px;
            width: 100%;
            background: var(--primary-color);
            border-radius: 3px;
            opacity: 1;
            left: 0;
            transform: rotate(0deg);
            transition: .25s ease-in-out;
        }

        .navbar-toggler span:nth-child(1) {
            top: 0px;
        }

        .navbar-toggler span:nth-child(2) {
            top: 8px;
        }

        .navbar-toggler span:nth-child(3) {
            top: 16px;
        }

        .navbar-toggler.open span:nth-child(1) {
            top: 8px;
            transform: rotate(135deg);
        }

        .navbar-toggler.open span:nth-child(2) {
            opacity: 0;
            left: -60px;
        }

        .navbar-toggler.open span:nth-child(3) {
            top: 8px;
            transform: rotate(-135deg);
        }

        /* Responsive Styles */
        @media (max-width: 991.98px) {
            .navbar-collapse {
                background-color: white;
                padding: 20px;
                border-radius: 8px;
                box-shadow: 0 5px 15px var(--shadow-color);
                margin-top: 15px;
            }

            .nav-item {
                margin: 5px 0;
            }

            .nav-link::after {
                display: none;
            }

            .header-icons {
                margin-top: 15px;
                justify-content: center;
            }

            .icon-link {
                margin: 0 10px;
            }
        }
    </style>
</head>
<body>

<header>
    <!-- Top Bar -->
    <div class="top-bar">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <?php
                        $ret = mysqli_query($con, "select * from tblpage where PageType='contactus'");
                        while ($row = mysqli_fetch_array($ret)) {
                        ?>
                    <a href="tel:+<?php echo $row['MobileNumber']; ?>" class="me-3">
                        <i class="fas fa-phone-alt me-1"></i> +<?php echo $row['MobileNumber']; ?>
                    </a>
                    <a href="mailto:<?php echo $row['Email']; ?>">
                        <i class="fas fa-envelope me-1"></i>                                                             <?php echo $row['Email']; ?>
                    </a>
                    <?php }?>
                </div>
                <div class="col-md-6 text-end">
                    <a href="admin/index.php" class="me-3">Admin Panel</a>
                    <a href="delivery-boy-login.php">Delivery Login</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Header -->
    <div class="main-header">
        <div class="container">
            <nav class="navbar navbar-expand-lg">
                <a class="navbar-brand" href="index.php">
                    <img src="img/logo-cake-removebg-preview.png" alt="cake bakery Logo">
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarMain">
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item ">
                            <a class="nav-link" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="cake.php">Our cakes</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link " href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Categories
                            </a>
                            <ul class="dropdown-menu">
                                <?php
                                    $ret = mysqli_query($con, "select * from tblcategory");
                                    while ($row = mysqli_fetch_array($ret)) {
                                    ?>
                                <li><a class="dropdown-item" href="category-details.php?catname=<?php echo $row['CategoryName']; ?>"><?php echo $row['CategoryName']; ?></a></li>
                                <?php }?>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="about-us.php">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contact.php">Contact</a>
                        </li>
                    </ul>

                    <div class="header-icons">
                        <?php
                            $userid = $_SESSION['fosuid'];
                            $ret1   = mysqli_query($con, "select * from tblorders where IsOrderPlaced is null && UserId='$userid'");
                            $num    = mysqli_num_rows($ret1);
                        ?>
                        <a style="text-decoration: none;"  href="cart.php" class="icon-link">
                            <i class="fas fa-shopping-cart"></i>
                            <?php if ($num > 0) {?>
                            <span class="cart-count"><?php echo $num; ?></span>
                            <?php }?>
                        </a>
                        <a style="text-decoration: none;" href="search-cake.php" class="icon-link">
                            <i  class="fas fa-search"></i>
                        </a>

                        <?php if (strlen($_SESSION['fosuid']) == 0) {?>
                            <a href="login.php" class="btn btn-outline-primary btn-custom ms-3">Sign In</a>
                            <a href="registration.php" class="btn btn-primary btn-custom ms-2">Sign Up</a>
                        <?php } else {?>
                            <div class="dropdown ms-3">
                                <button class="btn btn-outline-primary btn-custom dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    My Account
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="profile.php"><i class="fas fa-user me-2"></i>Profile</a></li>
                                    <li><a class="dropdown-item" href="my-order.php"><i class="fas fa-box me-2"></i>My Orders</a></li>
                                    <li><a class="dropdown-item" href="change-password.php"><i class="fas fa-key me-2"></i>Change Password</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="logout.php"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
                                </ul>
                            </div>
                        <?php }?>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</header>

<!-- Remove the Bootstrap JS and Popper.js scripts from here since they'll be loaded in index.php -->

<script>
    // Add active class to current nav item
    document.addEventListener('DOMContentLoaded', function() {
        const currentLocation = location.pathname;
        const navLinks = document.querySelectorAll('.nav-link');

        navLinks.forEach(link => {
            if (link.getAttribute('href') === currentLocation.split('/').pop()) {
                link.parentElement.classList.add('active');
            }
        });

        // Toggle class for mobile menu button
        const navbarToggler = document.querySelector('.navbar-toggler');
        navbarToggler.addEventListener('click', function() {
            this.classList.toggle('open');
        });
    });
</script>

</body>
</html>
