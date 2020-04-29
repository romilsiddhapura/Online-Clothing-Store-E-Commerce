<?php

//if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
if(session_id() == '' || !isset($_SESSION))
{
  session_start();
}

include 'config.php';

?>

<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Clothing Shop</title>
    <link rel="stylesheet" href="css/foundation.css" />
    <script src="js/vendor/modernizr.js"></script>
  </head>
  <body>

    <nav class="top-bar" data-topbar role="navigation">
      <ul class="title-area">
        <li class="name">
          <h1><a href="index.php">Clothing Shop</a></h1>
        </li>
        <li class="toggle-topbar menu-icon"><a href="#"><span></span></a></li>
      </ul>

      <section class="top-bar-section">
      <!-- Right Nav Section -->
        <ul class="right">
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
      </section>
    </nav>
    
    <form method="POST" action="item-add.php" enctype="multipart/form-data" style="margin-top:30px;">
      <div class="row">
        <div class="small-8">
          <h3>Add New Product</h3>
          
          <div class="row">
            <div class="small-4 columns">
              <label for="prod_code">Product Code</label>
            </div>
            <div class="small-8 columns">
              <input type="text" id="prod_code" name="prod_code">
            </div>
          </div>

          <div class="row">
            <div class="small-4 columns">
              <label for="prod_name">Name</label>
            </div>
            <div class="small-8 columns">
              <input type="text" id="prod_name" name="prod_name">
            </div>
          </div>

          <div class="row">
            <div class="small-4 columns">
              <label for="prod_image">Image</label>
            </div>
            <div class="small-8 columns">
              <input type="file" id="prod_image" name="prod_image">
            </div>
          </div>

          <div class="row">
            <div class="small-4 columns">
              <label for="prod_category">Category</label>
            </div>
            <div class="small-8 columns">
              <input type="text" id="prod_category" name="prod_category">
            </div>
          </div>

          <div class="row">
            <div class="small-4 columns">
              <label for="prod_desc">Description</label>
            </div>
            <div class="small-8 columns">
              <textarea id="prod_desc" name="prod_desc" rows="7"></textarea>
            </div>
          </div>

          <div class="row">
            <div class="small-4 columns">
              <label for="prod_qty">Quantity</label>
            </div>
            <div class="small-8 columns">
              <input type="number" id="prod_qty" name="prod_qty">
            </div>
          </div>

          <div class="row">
            <div class="small-4 columns">
              <label for="prod_price">Price</label>
            </div>
            <div class="small-8 columns">
              <input type="number" id="prod_price" name="prod_price" step="0.01">
            </div>
          </div>

          <div class="row">
            <div class="small-4 columns">

            </div>
            <div class="small-8 columns">
              <input type="submit" id="submit" value="Add" style="background: #0078A0; border: none; color: #fff; font-family: 'Helvetica Neue', sans-serif; font-size: 1em; padding: 10px;">
              <input type="reset" id="reset" value="Reset" style="background: #0078A0; border: none; color: #fff; font-family: 'Helvetica Neue', sans-serif; font-size: 1em; padding: 10px;">
            </div>
          </div>
        </div>
      </div>
    </form>




    <div class="row" style="margin-top:10px;">
      <div class="small-12">

        <footer style="margin-top:10px;">
           <p style="text-align:center; font-size:0.8em;">&copy; BOLT Sports Shop. All Rights Reserved.</p>
        </footer>

      </div>
    </div>





    <script src="js/vendor/jquery.js"></script>
    <script src="js/foundation.min.js"></script>
    <script>
      $(document).foundation();
    </script>
  </body>
</html>