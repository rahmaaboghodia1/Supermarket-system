<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lab01";
session_start();

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
?>
<h1>Edit Profile</h1>

<form action='' method='post'>
	First Name:<br>
	<input type='text' value="<?=$_SESSION['FName']?>" name='FName'><br>
	Last Name:<br>
	<input type='text' value="<?=$_SESSION['LName']?>" name='LName'><br>
	Email:<br>
	<input type='text' value="<?=$_SESSION['Email']?>" name='Email'><br>
	Password:<br>
	<input type='text' value="<?=$_SESSION['Password']?>" name='Password'><br>
	Hobby:<br>
	<input type='text' value="<?=$_SESSION['Hobby']?>" name='Hobby'><br>
	<input type='submit' value='Submit' name='Submit'>
</form>


<?php
if(isset($_POST['Submit'])){ //check if form was submitted
	$Fname=$_POST["FName"];
	$Lname=$_POST["LName"];
	$Email=$_POST["Email"];
	$Password=$_POST["Password"];
	$Hobby=$_POST["Hobby"];
	$sql=	"update  user set FirstName='$Fname', LastName='$Lname', Email='$Email', Password='$Password',Hobby='$Hobby' 
	where ID =".$_SESSION['ID'];
	$result=mysqli_query($conn,$sql);
	if($result)	{
		$_SESSION["FName"]=$Fname;
		$_SESSION["LName"]=$Lname;
		$_SESSION["Email"]=$Email;
		$_SESSION["Password"]=$Password;
		$_SESSION["Hobby"]=$Hobby;
		header("Location:index.php");
	}
	else {
		echo $sql;
	}
}
?>


