
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width , initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
        <link rel="stylesheet" type="text/css" href="style.css">

        <script>
    function validate()
    {
        return true;
        return false;
        let pass1=document.getElementById('pass1').value;
        let cpass2=document.getElementById('cpass2').value;
        if(pass1==cpass2)
        {
            return true;
        }
        
            else{
         document.getElementById('result').inneerHtml='Password confirmation incorrect';
            return false;
          }

    }
    </script>

    </head>
<body>
    <div id="form">
    <h1>SignUp Form</h1>
<form action="" method="post" onsubmit= 'return validate()'>
    
<i class="fa-solid fa-user"></i>
  <input type="text" id="user" placeholder =" Enter username " required ><br> <br>
  <i class="fa-solid fa-envelope"></i>
  <input type="email" id="email" name="email" placeholder ="Enter Email" required ><br><br>
  <i class="fa-solid fa-lock"></i>
  <input type="password" id="pass1" name="pass1" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" placeholder ="Create password" required ><br><br>
  <i class="fa-solid fa-lock"></i>
  <input type="password" id="cpass2" name="cpass2" placeholder ="Retype password" required ><span id='result'></span> <br><br>
  <input type="submit" value="Submit" id='submit' name="Submit">
  <input type="reset">

</form>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "database1";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);


if(isset($_POST['Submit'])){ //check if form was submitted
	$Fname=$_POST["FName"];
	$Lname=$_POST["LName"];
	$Email=$_POST["Email"];
	$Password=$_POST["Password"];
	$sql="insert into user(FirstName,LastName,Email,Password) 
	values('$Fname','$Lname','$Email','$Password')";
	$result=mysqli_query($conn,$sql);
	if($result)	{
		header("Location:index.php");
	}
}
?>
</body>