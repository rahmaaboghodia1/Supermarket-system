<?php
session_start();
echo "<h1>Your Profile</h1>";
echo "First Name: " .   $_SESSION["FName"]."<br>";
echo "Last Name: "  .	$_SESSION["LName"]."<br>";
echo "Email :"      .	$_SESSION["Email"]."<br>";
echo "Hobby: "      .	$_SESSION["Hobby"]."<br><br>";

echo"<a href='index.php'>Back</a>";

?>