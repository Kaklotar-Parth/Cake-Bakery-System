<?php
session_start();
session_unset();
session_destroy();
header('location:../delivery-boy-login.php');
?>