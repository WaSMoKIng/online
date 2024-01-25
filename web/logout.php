<?php 

    session_start();
    require_once 'config/register.php';
    unset($_SESSION['user_login']);
    unset($_SESSION['admin_login']);
    $_SESSION['status'] = 0;
    header('location: index.php');

?>