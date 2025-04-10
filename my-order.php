<!-- myorder.php -->

<?php
    session_start();
    error_reporting(0);
    include_once 'includes/dbconnection.php';
    if (strlen($_SESSION['fosuid'] == 0)) {
        header('location:logout.php');
    } else {

    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cake bakery  - My Orders</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.min.css">

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

        .orders-section {
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

        .orders-table {
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
            font-weight: 500;
            border: none;
            padding: 15px 20px;
            font-size: 1rem;
        } */

        .table tbody td {
            padding: 15px 20px;
            vertical-align: middle;
            border-bottom: 1px solid var(--border-color);
           
        }

        .table tbody tr:last-child td {
            border-bottom: none;
        }

        .order-status {
            padding: 6px 12px;
            border-radius: 50px;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .status-pending {
            background-color: #FFF3CD;
            color: #856404;
        }

        .status-confirmed {
            background-color: #D4EDDA;
            color: #155724;
        }

        .status-delivered {
            background-color: #CCE5FF;
            color: #004085;
        }

        .action-btn {
            padding: 8px 16px;
            border-radius: 50px;
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .track-btn {
            background-color: var(--primary-color);
            color: white;
            border: none;
        }

        .track-btn:hover {
            background-color: var(--secondary-color);
            transform: translateY(-2px);
        }

        .view-btn {
            background-color: var(--secondary-color);
            color: white;
            border: none;
        }

        .view-btn:hover {
            background-color: var(--primary-color);
            transform: translateY(-2px);
        }

        .order-date {
            color: #666;
            font-size: 0.9rem;
        }

        @media (max-width: 991.98px) {
            .orders-section {
                padding: 60px 0;
            }

            .table-responsive {
                border-radius: 15px;
                box-shadow: 0 5px 15px var(--shadow-color);
            }
        }

        @media (max-width: 767.98px) {
            .section-title h2 {
                font-size: 2rem;
            }

            .table thead th, .table tbody td {
                padding: 12px 15px;
            }

            .action-btn {
                padding: 6px 12px;
                font-size: 0.8rem;
            }
        }
    </style>
</head>
<body>
    <?php include_once 'includes/header.php'; ?>

    <section class="orders-section">
        <div class="container">
            <div class="section-title">
                <h2>My Orders</h2>
            </div>

            <div class="table-responsive">
                <div class="orders-table">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Order ID</th>
                                <th>Order Date</th>
                                <th>Status</th>
                                <th>Chceck order</th>
                                <th>View Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $userid = $_SESSION['fosuid'];
                            $query = mysqli_query($con, "select * from tblorderaddresses where UserId='$userid'");
                            $cnt = 1;
                            while ($row = mysqli_fetch_array($query)) {
                                $status = $row['OrderFinalStatus'];
                                $statusClass = '';
                                if ($status == '') {
                                    $status = "Waiting for confirmation";
                                    $statusClass = 'status-pending';
                                } elseif (strpos($status, 'Confirmed') !== false) {
                                    $statusClass = 'status-confirmed';
                                } elseif (strpos($status, 'Delivered') !== false) {
                                    $statusClass = 'status-delivered';
                                }
                            ?>
                            <tr>
                                <td><?php echo $cnt; ?></td>
                                <td><?php echo $row['Ordernumber']; ?></td>
                                <td class="order-date"><?php echo $row['OrderTime']; ?></td>
                                <td><span class="order-status <?php echo $statusClass; ?>"><?php echo $status; ?></span></td>
                                <td>
                                    <a style="  text-decoration: none; " href="javascript:void(0);" 
                                       onClick="popUpWindow('trackorder.php?oid=<?php echo htmlentities($row['Ordernumber']); ?>');" 
                                       class="action-btn track-btn">
                                        <i class="fas fa-motorcycle"></i> Chceck order
                                    </a>
                                </td>
                                <td>
                                    <a style="  text-decoration: none; " href="order-detail.php?orderid=<?php echo $row['Ordernumber']; ?>" 
                                       class="action-btn view-btn">
                                        <i class="fas fa-eye"></i> View
                                    </a>
                                </td>
                            </tr>
                            <?php $cnt = $cnt + 1; } ?>
                        </tbody>
                    </table>
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
        var popUpWin = 0;
        function popUpWindow(URLStr, left, top, width, height) {
            if (popUpWin) {
                if (!popUpWin.closed) popUpWin.close();
            }
            popUpWin = open(URLStr, 'popUpWin', 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,copyhistory=yes,width=' + 600 + ',height=' + 600 + ',left=' + left + ', top=' + top + ',screenX=' + left + ',screenY=' + top + '');
        }
    </script>
</body>
</html><?php }?>