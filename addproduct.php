<?php
session_start();

if (!isset($_SESSION["admin_username"])) {
    header("Location: admin.php");
    exit;
}

$host = 'localhost';
$username = 'root';
$password = '';
$database = 'db1';

$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$productName = $productDescription = $productPrice = $productPhoto = "";
$error_message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["addProduct"])) {
    $productName = $_POST["productName"];
    $productDescription = $_POST["productDescription"];
    $productPrice = $_POST["productPrice"];
    
 
    $targetDir = "";
    $targetFile = $targetDir . basename($_FILES["productPhoto"]["name"]);
    $uploadOk = 1;

    $check = getimagesize($_FILES["productPhoto"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        $uploadOk = 0;
    }

   
    if ($uploadOk == 1 && move_uploaded_file($_FILES["productPhoto"]["tmp_name"], $targetFile)) {
        $sql = "INSERT INTO products (name, description, price, photo) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssds", $productName, $productDescription, $productPrice, $targetFile);

        if ($stmt->execute()) {
            $success_message = "Product added successfully.";
        } else {
            $error_message = "Error adding product: " . $stmt->error;
        }

        $stmt->close();
    } else {
        $error_message = "Error uploading file.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Add Product</title>
</head>
<body>
    <div class="container">
        <h2>Add Product</h2>
        <?php if (isset($success_message)): ?>
            <p><?php echo $success_message; ?></p>
        <?php endif; ?>
        <?php if (isset($error_message)): ?>
            <p class="error"><?php echo $error_message; ?></p>
        <?php endif; ?>
        <form method="post" action="" enctype="multipart/form-data">
            <label for="productName">Product Name:</label>
            <input type="text" id="productName" name="productName" required><br>
            
            <label for="productDescription">Product Description:</label>
            <textarea id="productDescription" name="productDescription" required></textarea><br>
            
            <label for="productPrice">Product Price:</label>
            <input type="number" id="productPrice" name="productPrice" step="0.01" required><br>
            
            <label for="productPhoto">Product Photo:</label>
            <input type="file" id="productPhoto" name="productPhoto" accept="image/*" required><br>
            
            <button type="submit" name="addProduct">Add Product</button>
        </form>
    </div>
</body>
</html>
