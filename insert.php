<?php

include 'config.php';

$fname = $_POST["fname"];
$lname = $_POST["lname"];
$address = $_POST["address"];
$city = $_POST["city"];
$pin = $_POST["pin"];
$email = $_POST["email"];
$pwd = $_POST["pwd"];
$hashed_pwd = password_hash($pwd, PASSWORD_DEFAULT);

if($mysqli->query("INSERT INTO users (fname, lname, address, city, pin, email, password, type) VALUES('$fname', '$lname', '$address', '$city', '$pin', '$email', '$hashed_pwd','user')")){
	//header ("location:login.php");
	echo 'Success';
	
}
else
{
	echo 'Error while registering';
}


?>
