<?php
    session_start();
    $message   = isset($_SESSION['message']) ? $_SESSION['message'] : "";
    $alertType = isset($_SESSION['alert_type']) ? $_SESSION['alert_type'] : "";
    session_unset(); // Clear session messages after use
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Success | Cake Bakery</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        :root {
            --primary-color: #FF8E9E;
            --secondary-color: #6C63FF;
        }
        
        /* Custom SweetAlert styling */
        .swal2-confirm {
            background-color: var(--primary-color) !important;
            border-color: var(--primary-color) !important;
        }
        .swal2-confirm:focus {
            box-shadow: 0 0 0 3px rgba(255, 142, 158, 0.5) !important;
        }
        .swal2-title {
            color: #2D3047 !important;
            font-family: 'Montserrat', sans-serif !important;
        }
        .swal2-popup {
            border-radius: 15px !important;
        }
    </style>
</head>
<body>

<script>
    let message = "<?php echo $message; ?>";
    let alertType = "<?php echo $alertType; ?>";

    if (message !== "") {
        Swal.fire({
            title: message,
            icon: alertType,
            confirmButtonColor: '#FF8E9E',
            customClass: {
                confirmButton: 'swal2-confirm',
                popup: 'swal2-popup',
                title: 'swal2-title'
            },
            buttonsStyling: true,
            padding: '2em',
            showCloseButton: true,
            timer: 5000,
            timerProgressBar: true
        }).then(function() {
            window.location.href = 'login.php';
        });
    }
</script>

</body>
</html>
