<?php
session_start();


$host = 'localhost';
$username = 'root';
$password = '';
$database = 'db1';

$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!isset($_SESSION['admin'])) {
    header("Location: admin.php");
    exit();
}


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
    
    if (move_uploaded_file($_FILES["productPhoto"]["tmp_name"], $targetFile)) {
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        
        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        
        h2 {
            margin-top: 0;
        }
        
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }
        
        input[type="text"],
        input[type="number"],
        textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        
        textarea {
            height: 100px;
        }
        
        input[type="file"] {
            margin-top: 6px;
        }
        
        button {
            display: inline-block;
            padding: 10px 15px;
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        
        button:hover {
            background-color: #555;
        }
        
        p {
            margin-top: 10px;
            color: green;
        }
        
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Add Product</h2>
        <?php if (isset($success_message)): ?>
            <p style="color: green;"><?php echo $success_message; ?></p>
        <?php endif; ?>
        <?php if (isset($error_message)): ?>
            <p style="color: red;"><?php echo $error_message; ?></p>
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
