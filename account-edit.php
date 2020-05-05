<?php

//if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
if(session_id() == '' || !isset($_SESSION))
{
  session_start();
}

include 'config.php';

$id= $_POST["user_id"];
$fname = $_POST["user_fname"];
$lname = $_POST["user_lname"];

$addr = $_POST["user_addr"];
$city = $_POST["user_city"];
$pin= $_POST["user_pin"];


$result = $mysqli->query('UPDATE users SET fname="'.$fname.'", lname="'.$lname.'", address="'.$addr.'", city="'.$city.'", pin="'.$pin.'" WHERE id="'.$id.'" ');

if($result)
{
  header("location:account.php");
}
else
{
  echo "<p>Error!</p>";
}

//header("location:success.php");
?>
