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
$sport= $_POST["prod_sport"];
$qty = $_POST["prod_qty"];
$price = $_POST["prod_price"];


$image = addslashes(file_get_contents($_FILES["prod_image"]['tmp_name']));
//echo "<p>".$id."</p>";

$result = $mysqli->query('UPDATE products SET product_code="'.$code.'", product_name="'.$name.'", product_desc="'.$desc.'", product_image="'.$image.'", category="'.$category.'", sport="'.$sport.'", qty="'.$qty.'", price="'.$price.'" WHERE id="'.$id.'" ');

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
