<?php
    include 'includes/dbconnection.php';
    session_start();
    error_reporting(0);

    if (isset($_POST['sub'])) {
        $email = $_POST['email'];
        $ret = mysqli_query($con, "select * from tblsubscriber where Email='$email' ");
        $result = mysqli_fetch_array($ret);
        if ($result > 0) {
            $msg = "This email already exist";
        } else {
            $query = mysqli_query($con, "insert into tblsubscriber(Email) value('$email')");
        }
        if ($query) {
            echo "<script>alert('Your subscribe successfully!.');</script>";
            echo "<script>window.location.href ='index.php'</script>";
        } else {
            echo '<script>alert("This email already exist")</script>';
        }
    }
?>

<!-- Newsletter Section -->
<section class="newsletter-section py-5">
    <div class="container">
        <div class="newsletter-wrapper">
            <div class="row justify-content-between align-items-center g-4">
                <div class="col-lg-6">
                    <div class="newsletter-content">
                        <h4 class="newsletter-title">Stay Updated with Our Latest Offers</h4>
                        <p class="newsletter-subtitle">Subscribe to our newsletter for exclusive deals and updates</p>
                    </div>
                </div>
                <div class="col-lg-5">
                    <form method="post" class="newsletter-form">
                        <div class="input-group">
                            <input type="email" class="form-control" placeholder="Enter your email address" name="email" required>
                            <button class="btn btn-subscribe" type="submit" name="sub">
                                Subscribe <i class="fas fa-paper-plane ms-2"></i>
                            </button>
                        </div>
                        <?php if($msg){ ?>
                        <div class="alert alert-warning mt-3" role="alert">
                            <?php echo $msg; ?>
                        </div>
                        <?php } ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Footer Section -->
<footer class="footer-section">
    <div class="footer-top">
        <div class="container">
            <div class="row g-4">
                <!-- About Widget -->
                <div class="col-lg-3 col-md-6">
                    <div class="footer-widget about-widget">
                        <img src="img/logo-cake-photoaidcom-cropped.jpg" alt="Footer Logo" class="footer-logo">
                        <?php
                        $ret = mysqli_query($con, "select * from tblpage where PageType='aboutus1' ");
                        while ($row = mysqli_fetch_array($ret)) {
                        ?>
                        <p class="about-text"><?php echo $row['PageDescription']; ?></p>
                        <?php }?>
                        <div class="social-links">
                            <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                            <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="social-link"><i class="fab fa-youtube"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="col-lg-3 col-md-6">
                    <div class="footer-widget">
                        <h5 class="widget-title">Quick Links</h5>
                        <ul class="footer-links">
                            <li><a href="index.php">Home</a></li>
                            <li><a href="cake.php">Our Cakes</a></li>
                            <li><a href="about-us.php">About Us</a></li>
                            <li><a href="contact.php">Contact Us</a></li>
                            <?php if (strlen($_SESSION['fosuid']) > 0) { ?>
                                <li><a href="cart.php">Cart Page</a></li>
                                <li><a href="my-order.php">My Orders</a></li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>

                <!-- Working Hours -->
                <div class="col-lg-3 col-md-6">
                    <div class="footer-widget">
                        <h5 class="widget-title">Working Hours</h5>
                        <ul class="working-hours">
                            <li>
                                <span class="day">Monday - Friday</span> &nbsp;&nbsp;&nbsp;&nbsp;
                                <span class="time">8:00 AM - 8:00 PM</span>
                            </li>
                            <li>
                                <span class="day">Saturday</span>&nbsp;&nbsp;&nbsp;&nbsp;
                                <span class="time">9:00 AM - 4:00 PM</span>
                            </li>
                            <li>
                                <span class="day">Sunday</span>&nbsp;&nbsp;&nbsp;&nbsp;
                                <span class="time">Closed</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Contact Info -->
                <div class="col-lg-3 col-md-6">
                    <div class="footer-widget">
                        <h5 class="widget-title">Contact Info</h5>
                        <?php
                        $ret = mysqli_query($con, "select * from tblpage where PageType='contactus' ");
                        while ($row = mysqli_fetch_array($ret)) {
                        ?>
                        <ul class="contact-info">
                            <li>
                                <i class="fas fa-phone-alt"></i>
                                <div class="contact-text">
                                    <span>Call Us</span>
                                    <a href="tel:+<?php echo $row['MobileNumber']; ?>">+<?php echo $row['MobileNumber']; ?></a>
                                </div>
                            </li>
                            <li>
                                <i class="fas fa-envelope"></i>
                                <div class="contact-text">
                                    <span>Email Us</span>
                                    <a href="mailto:<?php echo $row['Email']; ?>"><?php echo $row['Email']; ?></a>
                                </div>
                            </li>
                        </ul>
                        <?php }?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Copyright Section -->
    <div class="footer-bottom">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="copyright-text">
                        &copy; <?php echo date('Y'); ?> <a href="index.php">Cake Bakery</a>. All rights reserved.
                    </p>
                </div>
                <div class="col-md-6">
                    <div class="footer-bottom-links">
                        <a href="index.php">Home</a>
                        <a href="#">Privacy Policy</a>
                        <a href="#">Terms & Conditions</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<style>
    :root {
        --footer-bg: #1a1a1a;
        --footer-text: #ffffff;
        --footer-link: #cccccc;
        --accent-color: #FF6B6B;
        --secondary-accent: #4ECDC4;
        --dark-overlay: rgba(0, 0, 0, 0.2);
    }

    /* Newsletter Section */
    .newsletter-section {
        background: linear-gradient(135deg, var(--accent-color), var(--secondary-accent));
        position: relative;
        overflow: hidden;
        margin-bottom: 0;
    }

    .newsletter-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><circle cx="2" cy="2" r="2" fill="rgba(255,255,255,0.1)"/></svg>') repeat;
        opacity: 0.1;
    }

    .newsletter-wrapper {
        position: relative;
        z-index: 1;
        padding: 20px 0;
    }

    .newsletter-content {
        padding-right: 30px;
    }

    .newsletter-title {
        color: var(--footer-text);
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 15px;
        line-height: 1.2;
    }

    .newsletter-subtitle {
        color: rgba(255, 255, 255, 0.9);
        font-size: 1.1rem;
        margin-bottom: 0;
    }

    .newsletter-form {
        width: 100%;
    }

    .newsletter-form .input-group {
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        border-radius: 50px;
        overflow: hidden;
        background: white;
    }

    .newsletter-form .form-control {
        height: 50px;
        border: none;
        padding: 0 25px;
        font-size: 1rem;
        background: transparent;
    }

    .newsletter-form .form-control:focus {
        box-shadow: none;
    }

    .btn-subscribe {
        background: var(--footer-bg);
        color: var(--footer-text);
        border: none;
        padding: 12px 30px;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
        white-space: nowrap;
    }

    .btn-subscribe:hover {
        background: var(--accent-color);
        color: white;
        transform: translateX(3px);
    }

    @media (max-width: 991.98px) {
        .newsletter-content {
            padding-right: 0;
            text-align: center;
            margin-bottom: 20px;
        }

        .newsletter-title {
            font-size: 1.75rem;
        }

        .newsletter-subtitle {
            font-size: 1rem;
        }
    }

    @media (max-width: 575.98px) {
        .newsletter-section {
            padding: 40px 0;
        }

        .btn-subscribe {
            padding: 12px 20px;
            font-size: 0.9rem;
        }

        .newsletter-form .form-control {
            font-size: 0.9rem;
        }
    }

    /* Footer Section */
    .footer-section {
        background-color: var(--footer-bg);
        color: var(--footer-text);
    }

    .footer-top {
        padding: 80px 0 40px;
    }

    .footer-widget {
        margin-bottom: 30px;
    }

    .footer-logo {
        max-width: 180px;
        margin-bottom: 20px;
    }

    .about-text {
        color: var(--footer-link);
        line-height: 1.8;
        margin-bottom: 25px;
    }

    .widget-title {
        color: var(--footer-text);
        font-size: 1.25rem;
        font-weight: 600;
        margin-bottom: 25px;
        position: relative;
        padding-bottom: 15px;
    }

    .widget-title::after {
        content: '';
        position: absolute;
        left: 0;
        bottom: 0;
        width: 40px;
        height: 3px;
        background: var(--accent-color);
        border-radius: 2px;
    }

    .footer-links {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .footer-links li {
        margin-bottom: 12px;
    }

    .footer-links a {
        color: var(--footer-link);
        text-decoration: none;
        transition: all 0.3s ease;
        display: inline-block;
    }

    .footer-links a:hover {
        color: var(--accent-color);
        transform: translateX(5px);
    }

    .working-hours li {
        display: flex;
      /* justify-content:flex-start; */
        margin-bottom: 12px;
        margin-left: -70px;
        color: var(--footer-link);
    }

    .working-hours .day {
        
        font-weight: 500;
    }

    .contact-info {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .contact-info li {
        display: flex;
        align-items: flex-start;
        margin-bottom: 20px;
    }

    .contact-info i {
        color: var(--accent-color);
        font-size: 1.2rem;
        margin-right: 15px;
        margin-top: 5px;
    }

    .contact-text {
        display: flex;
        flex-direction: column;
    }

    .contact-text span {
        color: var(--footer-link);
        font-size: 0.9rem;
    }

    .contact-text a {
        color: var(--footer-text);
        text-decoration: none;
        font-weight: 500;
        transition: color 0.3s ease;
    }

    .contact-text a:hover {
        color: var(--accent-color);
    }

    .social-links {
        display: flex;
        gap: 15px;
    }

    .social-link {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--dark-overlay);
        color: var(--footer-text);
        border-radius: 50%;
        transition: all 0.3s ease;
    }

    .social-link:hover {
        background: var(--accent-color);
        transform: translateY(-3px);
    }

    /* Footer Bottom */
    .footer-bottom {
        background: var(--dark-overlay);
        padding: 20px 0;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
    }

    .copyright-text {
        color: var(--footer-link);
        margin: 0;
    }

    .copyright-text a {
        color: var(--footer-text);
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .copyright-text a:hover {
        color: var(--accent-color);
    }

    .footer-bottom-links {
        display: flex;
        justify-content: flex-end;
        gap: 20px;
    }

    .footer-bottom-links a {
        color: var(--footer-link);
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .footer-bottom-links a:hover {
        color: var(--accent-color);
    }

    @media (max-width: 768px) {
        .footer-bottom-links {
            justify-content: center;
            margin-top: 15px;
        }
        
        .copyright-text {
            text-align: center;
        }
    }
</style>
