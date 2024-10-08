<?php
session_start();
require 'products.php'; // Ensure this file contains the $products array

// Initialize cart if it doesn't exist
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Handle form submission to add product to cart
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
    $productId = intval($_POST['product_id']); // Get the product ID from POST request

    // Find the product by ID
    $product = null;
    foreach ($products as $prod) {
        if ($prod['id'] === $productId) {
            $product = $prod;
            break;
        }
    }

    if ($product) {
        // Check if the product is already in the cart
        if (isset($_SESSION['cart'][$productId])) {
            // If it is, increment the quantity
            $_SESSION['cart'][$productId]['quantity'] += 1;
        } else {
            // If not, add the product with quantity 1
            $_SESSION['cart'][$productId] = [
                'id' => $productId,
                'name' => $product['name'],
                'price' => $product['price'],
                'quantity' => 1
            ];
        }
        // Redirect back to the same page to avoid form resubmission on refresh
        header('Location: index.php');
        exit();
    } else {
        // Handle case where product is not found
        $error_message = 'Product not found.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Product List</title>
</head>
<body>
    <h1>Products</h1>
    
    <?php if (isset($error_message)): ?>
        <p style="color: red;"><?php echo htmlspecialchars($error_message); ?></p>
    <?php endif; ?>
    
    <ul>
        <?php foreach ($products as $product): ?>
            <li>
                <?php echo htmlspecialchars($product['name']); ?> - <?php echo htmlspecialchars($product['price']); ?> PHP
                <form method="post" action="add-to-cart.php">
                    <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product['id']); ?>">
                    <button type="submit">Add to Cart</button>
                </form>
            </li>
        <?php endforeach; ?>
    </ul>
    
    <a href="cart.php">View Cart</a>
    
    <form method="post" action="reset-cart.php" style="margin-top: 20px;">
        <button type="submit">Reset Cart</button>
    </form>
</body>
</html>
