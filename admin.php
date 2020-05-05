<?php

//if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
if(session_id() == '' || !isset($_SESSION)){session_start();}

if(!isset($_SESSION["username"])) {
  header("location:index.php");
}

if($_SESSION["type"]!="admin") {
  header("location:index.php");
}

include 'config.php';
?>

<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin || BOLT Sports Shop</title>
    <link rel="stylesheet" href="css/foundation.css" />
    <script src="js/vendor/modernizr.js"></script>
    <script src="js/jquery-1.10.2.min.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href = "css/jquery-ui.css" rel = "stylesheet">
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="css/main.css" />
  </head>
  <body>
      <header id="header">
      <a class="logo" href="index.php">Industrious</a>
      <nav>
        <a href="#menu">Menu</a>
      </nav>
    </header>

  <!-- Nav -->
    <nav id="menu">
      <ul class="links">
        <li><a href="index.php">Home</a></li>
        <!-- <li><a href="elements.html">Elements</a></li> -->
        <li><a href="about.php">About</a></li>
        <li class='active'><a href="products.php">Products</a></li>
        <li><a href="cart.php">View Cart</a></li>
        <li><a href="orders.php">My Orders</a></li>
        <li><a href="contact.php">Contact</a></li>
        <!-- <li><a href="generic.html">Generic</a></li> -->
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

    <!-- <nav class="top-bar" data-topbar role="navigation">
      <ul class="title-area">
        <li class="name">
          <h1><a href="index.php">BOLT Sports Shop</a></h1>
        </li>
        <li class="toggle-topbar menu-icon"><a href="#"><span></span></a></li>
      </ul>

      <section class="top-bar-section">
       Right Nav Section -->
        <!-- <ul class="right"> 
          <li><a href="about.php">About</a></li>
          <li><a href="products.php">Products</a></li>
          <li><a href="cart.php">View Cart</a></li>
          <li><a href="orders.php">My Orders</a></li>
          <li><a href="contact.php">Contact</a></li>
          <?php

          // if(isset($_SESSION['username'])){
          //   echo '<li><a href="account.php">My Account</a></li>';
          //   echo '<li><a href="logout.php">Log Out</a></li>';
          // }
          // else{
          //   echo '<li><a href="login.php">Log In</a></li>';
          //   echo '<li><a href="register.php">Register</a></li>';
          // }
          ?>
        </ul>
      </section>
    </nav> -->


    <div class="row" style="margin-top:10px;">
      <div class="large-12">
        <div class="container">
        <h3>Hey Admin!</h3>
        <a href="add-item.php">
          <button id="add_button">Add New Product</button>
        </a>
      </div>
        <?php
          $result = $mysqli->query("SELECT * from products where soft_delete = '0' order by id asc");
          if($result) {
            while($obj = $result->fetch_object()) {
              echo '<div class="large-4 columns">';
              echo '<p><h3>'.$obj->product_name.'</h3></p>';
              echo '<img src="data:image/jpeg;base64,'.base64_encode($obj->product_image).'" style="height:400px;width:300px;" />';
              echo '<p></p>';
              //echo '<p><strong>Product Code</strong>: '.$obj->product_code.'</p>';
              //echo '<p><strong>Description</strong>: '.$obj->product_desc.'</p>';
              //echo '<p><strong>Units Available</strong>: '.$obj->qty.'</p>';
              echo '<a href="update-item.php?id='.$obj->id.'"><input type="submit" value="Edit" style="clear:both; background: #0078A0; border: none; color: #fff; font-size: 1em; padding: 10px;" /></a> ';
              echo '<a href="delete-item.php?id='.$obj->id.'"><input type="submit" value="Delete" style="clear:both; background: #0078A0; border: none; color: #fff; font-size: 1em; padding: 10px;" /></a>';
              //echo '<div class="large-6 columns" style="padding-left:0;">';
              //echo '<form method="post" name="update-quantity" action="admin-update.php">';
              //echo '<p><strong>New Qty</strong>:</p>';
              //echo '</div>';
              //echo '<div class="large-6 columns">';
              //echo '<input type="number" name="quantity[]"/>';


              echo '</div>';
            }
          }
        ?>



      </div>
    </div>


    <div class="row" style="margin-top:10px;">
      <div class="small-12">
        
        
        <footer style="margin-top:10px;">
           <p style="text-align:center; font-size:0.8em;">&copy; BOLT Sports Shop. All Rights Reserved.</p>
        </footer>

      </div>
    </div>





    <script src="js/vendor/jquery.js"></script>
    <script src="js/foundation.min.js"></script>
    <script src="js/jquery.min.js"></script>
      <script src="js/browser.min.js"></script>
      <script src="js/breakpoints.min.js"></script>
      <script src="js/util.js"></script>
      <script src="js/main.js"></script>
    <script>
      $(document).foundation();
    </script>
  </body>
</html>
