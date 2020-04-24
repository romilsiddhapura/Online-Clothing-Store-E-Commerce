<?php
include 'config.php';
$email = $_GET['email'];

//$con = mysqli_connect('localhost','root','root','clothing');
//if (!$con) {
//    die('Could not connect: ' . mysqli_error($con));
//}
//echo ($uname);
//mysqli_select_db($con,"ajax_demo");
$sql="SELECT * FROM users WHERE email ='$email'";
$result = mysqli_query($mysqli,$sql);
if($result)
{ 
 if(mysqli_num_rows($result)>0)
 {
  echo "Email ID Already Exists";
 }
 else
 {
  echo "OK";
 }
}
mysqli_close($con);
exit();

?>