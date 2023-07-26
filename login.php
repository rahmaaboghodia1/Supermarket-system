<?php
// Replace these with your actual database credentials
$host = 'your_database_host';
$username = 'your_database_username';
$password = 'your_database_password';
$database = 'your_database_name';

$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM admin_users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows === 1) {
  
        session_start();
        $_SESSION["admin_username"] = $username;
        header("Location: admin_panel.php");
    } else {
       
        header("Location: admin_login.php");
    }
}
