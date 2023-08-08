<?php
session_start();


if (isset($_SESSION['username'])) {
    $welcomeMessage = "Welcome, " . $_SESSION['username'];
} else {
    $welcomeMessage = "Welcome to Our Online Supermarket!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supermarket</title>
    <style>
        
        body, h1, h2, p, ul, li {
            margin: 0;
            padding: 0;
        }

       
        nav {
            background-color: #333;
            color: white;
            padding: 10px;
        }

        nav ul {
            list-style: none;
            display: flex;
        }

        nav ul li {
            margin-right: 20px;
        }

        nav ul li a {
            text-decoration: none;
            color: white;
        }

     
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        .product-card {
            border: 1px solid #ccc;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
            background-color: #f9f9f9;
        }

        .product-card img {
            max-width: 50%;
            height: auto;
        }

        .product-card h2 {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="products.php">Products</a></li>
            <?php if (isset($_SESSION['username'])): ?>
                <li><?php echo $welcomeMessage; ?></li>
            <?php else: ?>
                <li><a href="login.php">Login/Signup</a></li>
            <?php endif; ?>
            <li><a href="admin.php">Admin</a></li>
        </ul>
    </nav>

  >
    <div class="container">
        <h1>Welcome to Our Online Supermarket!</h1>
        
        <div class="product-card">
            <img src="product1.jpg" alt="Product 1">
            <h2>Red Bull Energy Drink</h2>
            <p>250ml(4Pack).</p>
            <p>Price: 110 L.E</p>
            <a href="cart.php">Add to Cart</a>
        </div>
        
        <div class="product-card">
            <img src="product2.jpg" alt="Product 2">
            <h2>Nutella Ferrero Hazelnut Spread</h2>
            <p>With Cocoa- 350gm</p>
            <p>Price: 140 L.E</p>
            <a href="cart.php">Add to Cart</a>
        </div>
        
    </div>
</body>
</html>
