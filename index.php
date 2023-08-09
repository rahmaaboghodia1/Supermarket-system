<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width , initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div id="form">
        <h1>Login Form</h1>
        <form name="form" method="POST">
            <label> Username :</label>
            <input type = "text" id="user" name="user"> </br> </br>
             <label> Password : </label>
            <input type = "password" id="pass" name="pass"> </br> </br>
            <input type="submit" id="btn" value="Login" name="submit"/>
</form>
</form>
<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "database1";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname , 3306);
if(isset($_POST['Submit'])){ //check if form was submitted
    $username=$_POST["name"];
	$Password=$_POST["pass"];
	$sql="Select * from Login where username ='$username' and Password='$password'";
	$result = mysqli_query($conn,$sql);		
	if($row=mysqli_fetch_array($result))	{
		$_SESSION["username"]=$row["name"];
		$_SESSION["Password"]=$row["Password"];
		header("Location:index.php");
	}
	else	{
		echo "Inalid username or Password";
	}
}
 if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<div class="product">';
            echo '<img src="' . $row['photo'] . '" alt="' . $row['name'] . '">';
            echo '<h4>' . $row['name'] . '</h4>';
            echo '<p>' . $row['description'] . '</p>';
            echo '<p>Price: $' . $row['price'] . '</p>';

            echo '<form method="POST" action="add_to_cart.php">';
            echo '<input type="hidden" name="product_id" value="' . $row['id'] . '">';
            echo '<input type="submit" value="Add to cart">';
            echo '</form>';

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
            


