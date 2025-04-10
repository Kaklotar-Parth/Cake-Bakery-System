<?php
    include 'includes/dbconnection.php';
    session_start();
    error_reporting(0);

    if (isset($_POST['submit'])) {
        $name    = $_POST['name'];
        $email   = $_POST['email'];
        $message = $_POST['message'];

        $query = mysqli_query($con, "insert into tblcontact(Name,Email,Message) value('$name','$email','$message')");
        if ($query) {
            echo "<script>alert('Your message was sent successfully!.');</script>";
            echo "<script>window.location.href ='contact.php'</script>";
        } else {
            echo '<script>alert("Something Went Wrong. Please try again")</script>';
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cake bakery  - Contact Us</title>
    
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

        .contact-section {
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

        .contact-form {
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 5px 15px var(--shadow-color);
        }

        .form-control {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 12px 15px;
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(255, 142, 158, 0.25);
        }

        textarea.form-control {
            min-height: 150px;
            resize: vertical;
        }

        .submit-btn {
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

        .submit-btn:hover {
            background: linear-gradient(135deg, var(--secondary-color), var(--primary-color));
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(108, 99, 255, 0.3);
        }

        .contact-details {
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 5px 15px var(--shadow-color);
            height: 100%;
        }

        .contact-item {
            margin-bottom: 30px;
        }

        .contact-item h3 {
            color: var(--dark-color);
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 15px;
        }

        .contact-item p, .contact-item h5 {
            color: #777;
            font-size: 1.1rem;
            line-height: 1.6;
            margin-bottom: 10px;
        }

        .message-icon {
            position: fixed;
            bottom: 30px;
            right: 30px;
             background-color: #FF6B6B;
            color: white;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            cursor: pointer;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
            z-index: 1000;
        }

        .message-icon:hover {
            transform: scale(1.1);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
        }

        .modal-content {
            border-radius: 15px;
            border: none;
        }

        .modal-header {
             background-color: #FF6B6B;
            color: white;
            border-radius: 15px 15px 0 0;
            padding: 20px;
        }

        .modal-title {
            font-weight: 600;
            margin: 0;
        }

        @media (max-width: 768px) {
            .contact-section {
                padding: 60px 0;
            }

            .section-title h2 {
                font-size: 2rem;
            }

            .contact-form, .contact-details {
                padding: 30px;
            }

            .message-icon {
                width: 50px;
                height: 50px;
                font-size: 20px;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <?php include_once 'includes/header.php'; ?>

    <!-- Contact Section -->
    <section class="contact-section">
        <div class="container">
            <div class="section-title">
                <h2>Get In Touch</h2>
                <p>Do you have anything in your mind to let us know? Kindly don't delay to connect to us by means of our contact form.</p>
            </div>

            <div class="row">
                <div class="col-lg-7">
                    <div class="contact-form">
                        <form class="row" action="" method="post">
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" maxlength="10" id="name" name="name" 
                                       placeholder="Your name" pattern="[A-Za-z]+" 
                                       title="Please enter letters only" required="true">
                            </div>
                            <div class="form-group col-md-6">
                                <input type="email" class="form-control" id="email" name="email" 
                                       placeholder="Email address" required="true">
                            </div>
                            <div class="form-group col-md-12">
                                <textarea class="form-control" name="message" id="message" 
                                          placeholder="Write your message" required="true"></textarea>
                            </div>
                            <div class="form-group col-md-12">
                                <button type="submit" value="submit" name="submit" class="submit-btn">
                                    Send Message
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="contact-details">
                        <?php
                        $ret = mysqli_query($con, "select * from tblpage where PageType='contactus' ");
                        $cnt = 1;
                        while ($row = mysqli_fetch_array($ret)) {
                        ?>
                        <div class="contact-item">
                            <h3>Address</h3>
                            <p><?php echo $row['PageDescription']; ?></p>
                        </div>
                        <div class="contact-item">
                            <h3>Contact Info</h3>
                            <h5><i class="fas fa-phone me-2"></i><?php echo $row['MobileNumber']; ?></h5>
                            <h5><i class="fas fa-envelope me-2"></i><?php echo $row['Email']; ?></h5>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Message Icon -->
    <div class="message-icon" data-bs-toggle="modal" data-bs-target="#messageModal">
        <i class="fas fa-message"></i>
    </div>

    <!-- Message Modal -->
    <div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="messageModalLabel">Enquiry Details</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Reply</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($_SESSION['fosuid'])) {
                                    $userid = $_SESSION['fosuid'];
                                    $userquery = mysqli_query($con, "SELECT Email FROM tbluser WHERE ID='$userid'");
                                    $userrow = mysqli_fetch_array($userquery);
                                    $useremail = $userrow['Email'];
                                    $ret = mysqli_query($con, "SELECT * FROM tblcontact WHERE Email='$useremail'");
                                    $cnt = 1;
                                    while ($row = mysqli_fetch_array($ret)) {
                                        echo "<tr>
                                            <td>{$cnt}</td>
                                            <td>{$row['Name']}</td>
                                            <td>{$row['reply']}</td>
                                        </tr>";
                                        $cnt++;
                                    }
                                } else {
                                    echo "<tr><td colspan='3' class='text-center'>Please login to view your messages</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

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




