<?php
session_start();

// Clear the cart by unsetting the cart session variable
if (isset($_SESSION['cart'])) {
    unset($_SESSION['cart']);
}

// Redirect to the product list page or another appropriate page
header('Location: index.php');
exit();
