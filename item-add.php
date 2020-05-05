<?php

//if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
if(session_id() == '' || !isset($_SESSION))
{
  session_start();
}

include 'config.php';

$id= $_POST["prod_id"];
$code = $_POST["prod_code"];
$name = $_POST["prod_name"];
//$image = $_POST["prod_image"];
$desc = $_POST["prod_desc"];
$category = $_POST["prod_category"];
$sport = $_POST["prod_sport"];
$qty = $_POST["prod_qty"];
$price = $_POST["prod_price"];

$image = addslashes(file_get_contents($_FILES["prod_image"]['tmp_name']));
//echo "<p>".$id."</p>";

$result = $mysqli->query('INSERT INTO products (product_code, product_name, product_desc, product_image, category, sport, qty, price) VALUES ("'.$code.'","'.$name.'","'.$desc.'","'.$image.'","'.$category.'","'.$sport.'","'.$qty.'","'.$price.'")');

if($result)
{
  header("location:newadmin.php");
}
else
{
  echo "<p>Error!</p>";
}

//header("location:success.php");
?>
