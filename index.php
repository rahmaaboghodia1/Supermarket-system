
<?php
session_start();

if (isset($_SESSION["admin_username"])) {
    echo '<h2>Welcome, ' . $_SESSION["admin_username"] . '</h2>';
}

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
   
  <h3>Products:</h3>
    <div class="products">
        <?php
        $host = 'localhost';
        $username = 'root';
        $password = '';
        $database = 'db1';

        $conn = new mysqli($host, $username, $password, $database);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM products";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="product">';
                echo '<img src="' . $row['photo'] . '" alt="' . $row['name'] . '">';
                echo '<h4>' . $row['name'] . '</h4>';
                echo '<p>' . $row['description'] . '</p>';
                echo '<p>Price: $' . $row['price'] . '</p>';
                echo '</div>';
            }
        } else {
            echo 'No products available.';
        }

        $conn->close();
        ?>
    </div>
</body>
</html>
