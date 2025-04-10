<?php
function check_login() {
    if (!isset($_SESSION['fosaid']) || empty($_SESSION['fosaid'])) {
        header('Location: index.php');
        exit();
    }
}
?>