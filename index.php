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
?>
</div>
</body>
</html>
            


