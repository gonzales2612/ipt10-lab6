<?php
session_start();
require 'products.php'; // Ensure this file contains the $products array

// Function to generate a random order code
function generateRandomString($length = 8) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

// Check if the cart is empty
if (empty($_SESSION['cart'])) {
    die('Your cart is empty. Please add items to the cart before placing an order.');
}

// Generate a random order code
$orderCode = generateRandomString(10);

// Get cart items
$cartItems = $_SESSION['cart'];
$totalPrice = 0;

// Prepare order details
$orderDetails = "Order Code: $orderCode\n";
$orderDetails .= "Date and Time Ordered: " . date('Y-m-d H:i:s') . "\n\n";
$orderDetails .= "Order Items:\n";

// Initialize product details
$productDetails = [];
foreach ($products as $product) {
    $productDetails[$product['id']] = $product;
}

// Collect order items
foreach ($cartItems as $item) {
    $product = $productDetails[$item['id']];
    $itemTotalPrice = $product['price'];
    $totalPrice += $itemTotalPrice;
    $orderDetails .= "Product ID: {$item['id']}\n";
    $orderDetails .= "Product Name: {$product['name']}\n";
    $orderDetails .= "Price: {$product['price']}\n";
    $orderDetails .= "Total Price: " . number_format($itemTotalPrice, 2) . "\n\n";
}

// Add total price to the order details
$orderDetails .= "Total Order Price: " . number_format($totalPrice, 2) . " PHP\n";

// Ensure the orders directory exists
$ordersDirectory = 'orders';
if (!is_dir($ordersDirectory)) {
    mkdir($ordersDirectory, 0755, true);
}

// Save order details to a text file in the orders directory
$fileName = "$ordersDirectory/orders-$orderCode.txt";
file_put_contents($fileName, $orderDetails);

// Clear the cart after placing the order
$_SESSION['cart'] = [];

// Display confirmation message
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Confirmation</title>
</head>
<body>
    <h1>Order Confirmation</h1>
    <p>Thank you for your order!</p>
    <p>Your order has been placed successfully. Here are the details:</p>
    <pre><?php echo htmlspecialchars($orderDetails); ?></pre>
    <p><a href="index.php">Back to Products</a></p>
</body>
</html>
