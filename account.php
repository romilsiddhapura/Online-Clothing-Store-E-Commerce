<?php

//if (session_status() !== PHP_SESSION_ACTIVE) {session_start();} for php 5.4 and above

if(session_id() == '' || !isset($_SESSION)){session_start();}

if(!isset($_SESSION["username"])) {
  echo '<h1>Invalid Login! Redirecting...</h1>';
  header("Refresh: 3; url=index.php");
}

// if($_SESSION["type"]==="admin") {
//   header("location:admin.php");
// }

include 'config.php';

?>

<!DOCTYPE HTML>
<html>
  <head>
    <title>Update Item</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <link rel="stylesheet" href="css/main.css" />
  </head>
  <body >

    <!-- Header -->
      <header id="header">
        <a class="logo" href="index.php">Clothing Store</a>
        <nav>
          <a href="#menu">Menu</a>
        </nav>
      </header>

    <!-- Nav -->
      <nav id="menu">
        <ul class="links">
          <li><a href="index.php">Home</a></li>
                    <!-- <li><a href="about.php">About</a></li> -->
                    <li><a href="products.php">Products</a></li>
                    <li><a href="cart.php">View Cart</a></li>
                    <li><a href="orders.php">My Orders</a></li>
                    <!-- <li><a href="contact.php">Contact</a></li> -->

                  <?php
                    if(isset($_SESSION['username'])){
                      echo '<li><a href="account.php">My Account</a></li>';
                      echo '<li><a href="logout.php">Log Out</a></li>';
                    }
                    else{
                      echo '<li><a href="login.php">Log In</a></li>';
                      echo '<li><a href="register.php">Register</a></li>';
                    }
                  ?>
        </ul>
      </nav>

<?php
$user_id = $_SESSION['id'];

$result = $mysqli->query("SELECT * FROM users WHERE id = ".$user_id);
if($result){

  $obj = $result->fetch_object();

}
?>
      <br>

      <form method="POST" action="account-edit.php" id="update" enctype="multipart/form-data">
        <p><?php echo '<h3>Hi ' .$_SESSION['fname'] .'</h3>'; ?></p>

        <p><h4>Edit Account Details</h4></p>

        <div class="form-group">
          <label for="user_id">User ID</label>
          <input type="text" id="user_id" name="user_id" type="form-control" value=<?php echo $user_id ?> readonly>
        </div>

        <div class="form-group">
          <label for="user_fname">First Name</label>
          <input type="text" id="user_fname" name="user_fname" type="form-control" value=<?php echo '"'.$obj->fname.'"'?>>
        </div>

        <div class="form-group">
          <label for="user_lname">Last Name</label>
          <input type="text" id="user_lname" name="user_lname" type="form-control" value=<?php echo '"'.$obj->lname.'"'?>>
        </div>

        <div class="form-group">
          <label for="user_addr">Address</label>
          <input type="text" id="user_addr" name="user_addr" type="form-control" value=<?php echo '"'.$obj->address.'"' ?>>
        </div>

        <div class="form-group">
          <label for="user_city">City</label>
          <input type="text" id="user_city" name="user_city" type="form-control" value=<?php echo '"'.$obj->city.'"' ?>>
        </div>

        <div class="form-group">
          <label for="user_pin">Zip</label>
          <input type="number" id="user_pin" name="user_pin" type="form-control" value=<?php echo '"'.$obj->pin.'"' ?>>
        </div>

        <br>
        <input type="submit" id="submit" value="Update Details"/>
        <input type="reset" value="Reset" />

      </form>

    <!-- Footer -->
      <footer id="footer">
        <div class="inner">
          <div class="content">
            
            <section>
              <h4>Follow us:</h4>
              <ul class="plain">
                <li style="display:inline"><a href="#"><i class="icon fa-twitter">&nbsp;</i>Twitter</a></li>
                <li style="display:inline"><a href="#"><i class="icon fa-facebook">&nbsp;</i>Facebook</a></li>
                <li style="display:inline"><a href="#"><i class="icon fa-instagram">&nbsp;</i>Instagram</a></li>
                <li style="display:inline"><a href="#"><i class="icon fa-github">&nbsp;</i>Github</a></li>
              </ul>
            </section>
          </div>
          <div class="copyright">
            &copy; <a href="https://personal.utdallas.edu/~kxp190010">Krupal Patel</a>, And <a href="https://personal.utdallas.edu/~rgs180004">Romil Siddhapura</a>.
          </div>
        </div>
      </footer>

    <!-- Scripts -->
      <script src="js/jquery.min.js"></script>
      <script src="js/browser.min.js"></script>
      <script src="js/breakpoints.min.js"></script>
      <script src="js/util.js"></script>
      <script src="js/main.js"></script>



<style>
  #update {
    margin-left:400px;
    margin-right:400px;
}
 #update label{
    margin-right:5px;
}
 #update input {
    padding:5px 5px;
    border:1px solid #d5d9da;
    box-shadow: 0 0 5px #e8e9eb inset;
    
    font-size:1em;
    outline:0;
}
</style>

  </body>
</html>
