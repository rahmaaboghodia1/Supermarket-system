<?php
session_start();

echo '<h2>Your cart:</h2>';

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo 'Your cart is empty.';
} else {
   
    foreach ($_SESSION['cart'] as $product_id) {
        echo '<p>Product ID: ' . $product_id . '</p>';
    }
}

echo '<a href="checkout_confirmation.php">Proceed to Checkout</a>';
?>
