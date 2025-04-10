<?php
// Database connection
include 'includes/dbconnection.php';

if (isset($_GET['userid'])) {
    $userid = intval($_GET['userid']); // Get user id from the URL

    // Fetch user email before deletion
    $stmt = $con->prepare("SELECT email FROM tbluser WHERE ID = ?");
    $stmt->bind_param('i', $userid);
    $stmt->execute();
    $stmt->bind_result($email);
    $stmt->fetch();
    $stmt->close();

    if (! empty($email)) {
        // Soft delete the user
        $stmt = $con->prepare("UPDATE tbluser SET status = 'deleted' WHERE ID = ?");
        $stmt->bind_param('i', $userid);

        if ($stmt->execute()) {
            $stmt->close();
            $con->close();

            // Redirect to send.php with user ID and email
            header("Location: send.php?userid=$userid&email=" . urlencode($email));
            exit();
        } else {
            echo "<script>alert('Failed to delete the user');</script>";
        }
    } else {
        echo "<script>alert('User not found');</script>";
    }

    $stmt->close();
    $con->close();
}
