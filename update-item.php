<?php

//if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
if(session_id() == '' || !isset($_SESSION))
{
  session_start();
}

include 'config.php';

?>

<!DOCTYPE HTML>
<html lang="en" style="font-size: 100%;">
  <head>
    <title>Update Item</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <link rel="icon" href="images/logo/favicon.ico" />
    <link rel="stylesheet" href="css/main.css" />
    <script src="js/jquery-1.10.2.min.js"></script>
      <script src="js/jquery-ui.js"></script>
    <script src="js/bootstrap.min.js"></script>
      <link rel="stylesheet" href="css/bootstrap.min.css">
      <link href = "css/jquery-ui.css" rel = "stylesheet">
  </head>
  <style>
    html {
  scroll-behavior: smooth;
}
  </style>
  <body class="is-preload">

    <!-- Header -->
      <header id="header">
        <!-- <img src="images/logo1.jpg"> -->
        <div><a class="logo" href="index.php"><img src="images/logo.png" height="44px" width="60px" class="img-fluid"></a></div>
        <nav>
          <a href="#menu">Menu</a>
        </nav>
      </header>

    <!-- Nav -->
      <nav id="menu">
        <ul class="links">
          <li><a href="index.php">Home</a></li>
                    <li><a href="about.php">About</a></li>
                    <li><a href="products.php">Products</a></li>
                    <li><a href="cart.php">View Cart</a></li>
                    <li><a href="orders.php">My Orders</a></li>
                    <li><a href="contact.php">Contact</a></li>

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
$product_id = $_GET['id'];

$result = $mysqli->query("SELECT * FROM products WHERE id = ".$product_id);
if($result){

  $obj = $result->fetch_object();

}
?>
      <br>

      <form method="POST" action="item-edit.php" id="update" enctype="multipart/form-data">
        <div class="form-group">
          <label for="prod_id">Product ID</label>
          <input type="text" id="prod_id" name="prod_id" type="form-control" value=<?php echo $product_id ?> readonly>
        </div>

        <div class="form-group">
          <label for="prod_code">Product Code</label>
          <input type="text" id="prod_code" name="prod_code" type="form-control" value=<?php echo '"'.$obj->product_code.'"'?>>
        </div>

        <div class="form-group">
          <label for="prod_name">Name</label>
          <input type="text" id="prod_name" name="prod_name" type="form-control" value=<?php echo '"'.$obj->product_name.'"' ?>>
        </div>

        <div class="form-group">
          <label for="prod_image">Image</label>
          <?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $obj->product_image ).'"style="width:80px;height:100px;"/>';?>
          <input type="file" id="prod_image" name="prod_image" type="form-control">
        </div>

        <div class="form-group">
          <label for="prod_category">Category</label>
          <input type="text" id="prod_category" name="prod_category" type="form-control" value=<?php echo '"'.$obj->category.'"' ?>>
        </div>

        <div class="form-group">
          <label for="prod_sport">Sport</label>
          <input type="text" id="prod_sport" name="prod_sport" type="form-control" value=<?php echo '"'.$obj->sport.'"' ?>>
        </div>

        <div class="form-group">
          <label for="prod_desc">Description</label>
          <textarea id="prod_desc" name="prod_desc" rows="7" type="form-control"><?php echo $obj->product_desc ?></textarea>
        </div>

        <div class="form-group">
          <label for="prod_qty">Quantity</label>
          <input type="number" id="prod_qty" name="prod_qty" type="form-control" value=<?php echo '"'.$obj->qty.'"' ?>>
        </div>

        <div class="form-group">
          <label for="prod_price">Price</label>
          <input type="number" id="prod_price" name="prod_price" step="0.01" type="form-control" value=<?php echo '"'.$obj->price.'"' ?>>
        </div>

        <br>
        <input type="submit" id="submit" value="Update Item"/>
        <input type="reset" value="Reset" />

      </form>


  <!-- Footer -->
  <footer id="footer">
        <div class="inner">
          <!-- <div class="content"> -->
            
            <section>
            <div class="row">
              <div class="col-md-3">
              </div>
              <div class="col-md-6">
              <h4>Follow us:</h4>
              
              <ul class="plain">
                <li style="display:inline"><a href="#"><i class="icon fa-twitter"></i>Twitter&nbsp;&nbsp;</a></li>
                <li style="display:inline"><a href="#"><i class="icon fa-facebook"></i>Facebook&nbsp;&nbsp;</a></li>
                <li style="display:inline"><a href="#"><i class="icon fa-instagram"></i>Instagram&nbsp;&nbsp;</a></li>
                <li style="display:inline"><a href="#"><i class="icon fa-github"></i>Github&nbsp;</a></li>
              </ul>
          </div>
          <div class="col-md-3">
            <a href="index.php"><img src="images/logo.png" height="200px" width="200px"></a>
          <!-- </div> -->
          </div>
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
    margin-left:500px;
    margin-right:500px;
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