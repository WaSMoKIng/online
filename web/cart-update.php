<?php 
    session_start();
    include 'config/shopping.php';

foreach($_SESSION['cart'] as $productId => $productQty) {
    $_SESSION['cart'][$productId] = $_POST['product'][$productId]['quantity'];
}
    header('location: cart.php');
?>