

<?php
$uname = $_GET['uname'];

$con = mysqli_connect('localhost','root','root','clothing');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}
//echo ($uname);
//mysqli_select_db($con,"ajax_demo");
$sql="SELECT * FROM users WHERE fname ='$uname'";
$result = mysqli_query($con,$sql);
if($result)
{ 
 if(mysqli_num_rows($result)>0)
 {
  echo "User Name Already Exists";
 }
 else
 {
  echo "OK";
 }
}
mysqli_close($con);
exit();




/*

<?php

$host = 'localhost';
$user = 'root';
$pass = 'root';

mysql_connect($host, $user, $pass);
mysql_select_db('clothing');

console.log("here");
if(isset($_POST['user_name']))
{
 $name=$_POST['user_name'];
 console.log($name);
 $checkdata=" SELECT fname FROM users WHERE fname='$name' ";

 $query=mysql_query($checkdata);

 if(mysql_num_rows($query)>0)
 {
  echo "User Name Already Exist";
 }
 else
 {
  echo "OK";
 }
 exit();
}

if(isset($_POST['user_email']))
{
 $emailId=$_POST['user_email'];

 $checkdata=" SELECT email FROM users WHERE email='$emailId' ";

 $query=mysql_query($checkdata);

 if(mysql_num_rows($query)>0)
 {
  echo "Email Already Exist";
 }
 else
 {
  echo "OK";
 }
 exit();
}*/


?>