<?php
    session_start();
    error_reporting(0);

    include 'includes/dbconnection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cake bakery  - About Us</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
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

        /* About Section */
        .about-section {
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

        .about-content {
            margin-bottom: 50px;
        }

        .about-content h2 {
            color: var(--dark-color);
            font-size: 2rem;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .about-content p {
            color: #777;
            font-size: 1.1rem;
            line-height: 1.8;
            margin-bottom: 20px;
        }

        /* Image Gallery */
        .image-gallery {
            margin-top: 50px;
        }

        .gallery-item {
            margin-bottom: 30px;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px var(--shadow-color);
            transition: all 0.3s ease;
        }

        .gallery-item:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        .gallery-item img {
            width: 100%;
            height: 300px;
            object-fit: cover;
            transition: all 0.5s ease;
        }

        .gallery-item:hover img {
            transform: scale(1.1);
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .about-section {
                padding: 60px 0;
            }

            .section-title h2 {
                font-size: 2rem;
            }

            .about-content h2 {
                font-size: 1.8rem;
            }

            .gallery-item img {
                height: 250px;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <?php include_once 'includes/header.php'; ?>
    <?php include_once 'includes/loader.php'; ?>

    <!-- About Section -->
    <section class="about-section">
        <div class="container">
            <div class="section-title">
                <h2>About Us</h2>
                <p>Discover our story and commitment to bringing you the finest cakes</p>
            </div>

            <?php
            $ret = mysqli_query($con, "select * from tblpage where PageType='aboutus' ");
            $cnt = 1;
            while ($row = mysqli_fetch_array($ret)) {
            ?>
            <div class="about-content">
                <h2><?php echo $row['PageTitle']; ?></h2>
                <p><?php echo $row['PageDescription']; ?></p>
            </div>
            <?php } ?>

            <div class="image-gallery">
                <div class="row">
                    <div class="col-md-4">
                        <div class="gallery-item">
                            <img src="img/our-bakery/1.jpg" alt="Our Bakery Interior">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="gallery-item">
                            <img src="img/our-bakery/2.jpg" alt="Our cake Collection">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="gallery-item">
                            <img src="img/our-bakery/3.jpg" alt="Our Baking Process">
                        </div>
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
    </script>
</body>
</html>