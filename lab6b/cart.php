<?php
session_start();
require 'products.php'; // Ensure this file contains the $products array

// Initialize total price
$totalPrice = 0;

// Get cart items from session
$cartItems = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

// Initialize product details
$productDetails = [];
foreach ($products as $product) {
    $productDetails[$product['id']] = $product;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Shopping Cart</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Shopping Cart</h1>

    <?php if (empty($cartItems)): ?>
        <p>Your cart is empty.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Price (PHP)</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cartItems as $item): ?>
                    <?php
                    // Get product details
                    $product = $productDetails[$item['id']];
                    $itemTotalPrice = $product['price'];
                    $totalPrice += $itemTotalPrice;
                    ?>
                    <tr>
                        <td><?php echo htmlspecialchars($product['name']); ?></td>
                        <td><?php echo htmlspecialchars(number_format($itemTotalPrice, 2)); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td style="text-align: right;">Total Price:</td>
                    <td><?php echo htmlspecialchars(number_format($totalPrice, 2)); ?> PHP</td>
                </tr>
            </tfoot>
        </table>

        <form method="post" action="place_order.php">
            <button type="submit">Place Order</button>
        </form>
    <?php endif; ?>

    <a href="index.php">Back to Products</a>
</body>
</html>
