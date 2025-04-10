<?php
    session_start();
    error_reporting(0);
    include_once 'includes/dbconnection.php';

    if (strlen($_SESSION['fosuid']) == 0) {
        header('location:logout.php');
    } else {
        // Fetch user order details with quantity
        $userid = $_SESSION['fosuid'];
        $query  = mysqli_query($con, "SELECT tblfood.ItemName, tblorders.Price, tblorders.Quantity
        FROM tblorders
        JOIN tblfood ON tblfood.ID = tblorders.FoodId
        WHERE tblorders.UserId = '$userid' AND tblorders.IsOrderPlaced IS NULL");

        $grandtotal = 0; // Initialize grand total

        while ($row = mysqli_fetch_array($query)) {
            $grandtotal += $row['Price']; // Remove quantity multiplication since price already includes it
        }
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cake bakery - Checkout</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.min.css">
    <!-- Razorpay -->
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>

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

        .checkout-section {
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

        .billing-form {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 15px var(--shadow-color);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            font-weight: 500;
            color: var(--dark-color);
            margin-bottom: 8px;
        }

        .form-control {
            border: 2px solid #eee;
            border-radius: 50px;
            padding: 12px 20px;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(255, 142, 158, 0.25);
        }

        .order-summary {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 15px var(--shadow-color);
            position: sticky;
            top: 20px;
        }

        .order-summary h2 {
            font-size: 1.8rem;
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid #eee;
        }

        .price-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            color: #666;
        }

        .price-row.total {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--dark-color);
            border-top: 2px solid #eee;
            margin-top: 15px;
            padding-top: 15px;
        }

        .razorpay-btn {
             background-color: #FF6B6B;
            color: white;
            border: none;
            padding: 15px 30px;
            border-radius: 50px;
            font-weight: 500;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            width: 100%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin-top: 20px;
        }

        .razorpay-btn:hover {
            background: linear-gradient(135deg, var(--secondary-color), var(--primary-color));
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(108, 99, 255, 0.3);
        }

        @media (max-width: 991.98px) {
            .checkout-section {
                padding: 60px 0;
            }

            .order-summary {
                margin-top: 30px;
                position: static;
            }
        }

        @media (max-width: 767.98px) {
            .section-title h2 {
                font-size: 2rem;
            }

            .billing-form, .order-summary {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <?php include_once 'includes/header.php'; ?>

    <section class="checkout-section">
        <div class="container">
            <div class="section-title">
                <h2>Checkout</h2>
            </div>

            <div class="row">
                <div class="col-lg-7">
                    <div class="billing-form">
                        <h2 class="mb-4">Billing Details</h2>
                        <form id="checkoutForm" method="post" novalidate>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="flatbldgnumber">
                                            <i class="fas fa-building me-2"></i>Flat/Building Number
                                        </label>
                                        <input type="text" class="form-control" id="flatbldgnumber" name="flatbldgnumber"
                                               pattern="[A-Za-z0-9\s\-\.]+"
                                               title="Only letters, numbers, spaces, hyphens, and dots are allowed"
                                               required>
                                        <div class="invalid-feedback">
                                            Please enter a valid flat/building number
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="streename">
                                            <i class="fas fa-road me-2"></i>Street Name
                                        </label>
                                        <input type="text" class="form-control" id="streename" name="streename"
                                               pattern="[A-Za-z\s\-\.]+"
                                               title="Only letters, spaces, hyphens, and dots are allowed"
                                               required>
                                        <div class="invalid-feedback">
                                            Please enter a valid street name
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="area">
                                    <i class="fas fa-map-marker-alt me-2"></i>Area
                                </label>
                                <input type="text" class="form-control" id="area" name="area"
                                       pattern="[A-Za-z\s\-\.]+"
                                       title="Only letters, spaces, hyphens, and dots are allowed"
                                       required>
                                <div class="invalid-feedback">
                                    Please enter a valid area name
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="landmark">
                                    <i class="fas fa-landmark me-2"></i>Landmark
                                </label>
                                <input type="text" class="form-control" id="landmark" name="landmark"
                                       pattern="[A-Za-z0-9\s\-\.]+"
                                       title="Only letters, numbers, spaces, hyphens, and dots are allowed">
                                <div class="invalid-feedback">
                                    Please enter a valid landmark
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="city">
                                    <i class="fas fa-city me-2"></i>City
                                </label>
                                <input type="text" class="form-control" id="city" name="city"
                                       pattern="[A-Za-z\s\-\.]+"
                                       title="Only letters, spaces, hyphens, and dots are allowed"
                                       value="Surat" readonly>
                                       <input type="hidden" name="city" value="Surat">
                                <div class="invalid-feedback">
                                    Please enter a valid city name
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="order-summary">
                        <h2>Order Summary</h2>
                        <div class="price-row">
                            <span>Subtotal</span>
                            <span>₹<?php echo number_format($grandtotal, 2); ?></span>
                        </div>
                        <div class="price-row">
                            <span>Shipping</span>
                            <span>Free</span>
                        </div>
                        <div class="price-row total">
                            <span>Total</span>
                            <span>₹<?php echo number_format($grandtotal, 2); ?></span>
                        </div>
                        <button id="rzp-button1" class="razorpay-btn">
                            <i class="fas fa-lock"></i>Pay Securely with Razorpay
                        </button>
                    </div>
                </div>
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
        document.addEventListener('DOMContentLoaded', function() {
            // Form validation
            const form = document.getElementById('checkoutForm');
            const inputs = form.querySelectorAll('input[required]');
            const submitButton = document.getElementById('rzp-button1');

            // Real-time validation
            inputs.forEach(input => {
                input.addEventListener('input', function() {
                    validateField(this);
                });

                input.addEventListener('blur', function() {
                    validateField(this);
                });
            });

            function validateField(field) {
                const isValid = field.checkValidity();
                const feedback = field.nextElementSibling;

                if (isValid) {
                    field.classList.remove('is-invalid');
                    field.classList.add('is-valid');
                    feedback.style.display = 'none';
                } else {
                    field.classList.remove('is-valid');
                    field.classList.add('is-invalid');
                    feedback.style.display = 'block';
                }

                return isValid;
            }

            // Form submission validation
            submitButton.addEventListener('click', function(e) {
                e.preventDefault();

                let isValid = true;
                inputs.forEach(input => {
                    if (!validateField(input)) {
                        isValid = false;
                    }
                });

                if (!isValid) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Validation Error',
                        text: 'Please fill all required fields correctly.',
                        confirmButtonColor: '#FF8E9E'
                    });
                    return;
                }

                // If form is valid, proceed with Razorpay
                var options = {
                    "key": "Razorpay key your",
                    "amount":                              <?php echo $grandtotal * 100; ?>,
                    "currency": "INR",
                    "name": "Cake bakery",
                    "description": "Order Payment",
                    "image": "img/logo-cake-removebg-preview.png",
                    "handler": function (response) {
                        var paymentId = response.razorpay_payment_id;
                        var formData = new FormData(document.getElementById("checkoutForm"));
                        formData.append("payment_id", paymentId);

                        // Show loading state
                        Swal.fire({
                            title: 'Processing Payment',
                            text: 'Please wait while we confirm your payment...',
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            showConfirmButton: false,
                            willOpen: () => {
                                Swal.showLoading();
                            }
                        });

                        fetch("payment_success.php", {
                            method: "POST",
                            body: formData
                        })
                        .then(response => response.text())
                        .then(data => {
                            if (data.trim() === "success") {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Payment Successful!',
                                    text: 'Your order has been placed successfully.',
                                    confirmButtonText: 'View Orders',
                                    showCancelButton: true,
                                    cancelButtonText: 'Close',
                                    confirmButtonColor: '#FF8E9E',
                                    cancelButtonColor: '#6C63FF'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.href = "my-order.php";
                                    } else {
                                        window.location.href = "index.php";
                                    }
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Payment Failed',
                                    text: 'Something went wrong. Please try again.',
                                    confirmButtonColor: '#FF8E9E'
                                });
                            }
                        })
                        .catch(error => {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'An error occurred. Please try again.',
                                confirmButtonColor: '#FF8E9E'
                            });
                        });
                    },
                    "prefill": {
                        "name": "<?php echo $_SESSION['username']; ?>",
                        "email": "<?php echo $_SESSION['email']; ?>",
                        "contact": "<?php echo $_SESSION['phone']; ?>"
                    },
                    "theme": {
                        "color": "#FF8E9E"
                    }
                };

                var rzp1 = new Razorpay(options);
                rzp1.open();
            });
        });
    </script>
</body>
</html>
<?php }?>
