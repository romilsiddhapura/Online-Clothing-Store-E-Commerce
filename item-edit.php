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
$image = $_POST["prod_image"];
$desc = $_POST["prod_desc"];
$category = $_POST["prod_category"];
$qty = $_POST["prod_qty"];
$price = $_POST["prod_price"];

//echo "<p>".$id."</p>";

$result = $mysqli->query('UPDATE products SET product_code="'.$code.'", product_name="'.$name.'", product_desc="'.$desc.'", product_img_name="'.$image.'", category="'.$category.'", qty="'.$qty.'", price="'.$price.'" WHERE id="'.$id.'" ');


header("location:success.php");
?>
