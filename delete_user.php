<?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'database';
$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["id"])) {
    $id = $_GET["id"];
    $sql = "DELETE FROM normal_users WHERE id = '$id'";
    $conn->query($sql);
}

header("Location: admin_panel.php");
