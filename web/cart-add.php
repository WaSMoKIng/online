<?php 
    session_start();
    include 'config/shopping.php';

    if(empty($_get['id'])) {
        if(empty($_SESSION['cart'][$_GET['id']])) {
            $_SESSION['cart'][$_GET['id']] = 1;
        } else {
            $_SESSION['cart'][$_GET['id']] += 1;

        }

    }
    header('location: index.php');
?>