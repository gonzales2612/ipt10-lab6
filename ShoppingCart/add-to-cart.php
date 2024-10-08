<?php
session_start();
require 'products.php'; // Ensure this file contains the $products array

// Function to add a product to the cart
function addToCart($productId) {
    global $products;

    // Check if the product ID exists in the products array
    $product = null;
    foreach ($products as $prod) {
        if ($prod['id'] === $productId) {
            $product = $prod;
            break;
        }
    }

    if ($product) {
        // Initialize cart if it doesn't exist
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        // Add or update product in the cart
        if (isset($_SESSION['cart'][$productId])) {
            // If product is already in cart, you could update quantity here
            $_SESSION['cart'][$productId]['quantity'] += 1;
        } else {
            $_SESSION['cart'][$productId] = [
                'id' => $product['id'],
                'name' => $product['name'],
                'price' => $product['price']
            ];
        }
    } else {
        // Product not found
        echo 'Product not found.';
    }
}

// Check if the product_id is set in the POST request
if (isset($_POST['product_id'])) {
    $productId = intval($_POST['product_id']);
    addToCart($productId);
    // Redirect to the product list page
    header('Location: index.php');
    exit();
} else {
    // No product_id provided
    echo 'No product ID provided.';
}
