<?php
if(session_id() == '' || !isset($_SESSION))
{
  session_start();
}

include 'config.php';

$id= $_GET["id"];

$result = $mysqli->query("UPDATE products SET soft_delete='1' WHERE id='".$id."' ");

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
