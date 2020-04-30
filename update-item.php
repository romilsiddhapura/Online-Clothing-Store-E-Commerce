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

<?php
$product_id = $_GET['id'];

$result = $mysqli->query("SELECT * FROM products WHERE id = ".$product_id);
if($result){

  $obj = $result->fetch_object();

}
?>
    
    <form method="POST" action="item-edit.php" enctype="multipart/form-data" style="margin-top:30px;">
      <div class="row">
        <div class="small-8">
          <h3>Edit product details</h3>
          
          <div class="row">
            <div class="small-4 columns">
              <label for="prod_id">Product ID</label>
            </div>
            <div class="small-8 columns">
              <input type="text" id="prod_id" name="prod_id" value=<?php echo $product_id ?> readonly>
            </div>
          </div>

          <div class="row">
            <div class="small-4 columns">
              <label for="prod_code">Product Code</label>
            </div>
            <div class="small-8 columns">
              <input type="text" id="prod_code" name="prod_code" value=<?php echo '"'.$obj->product_code.'"'?>>
            </div>
          </div>

          <div class="row">
            <div class="small-4 columns">
              <label for="prod_name">Name</label>
            </div>
            <div class="small-8 columns">
              <input type="text" id="prod_name" name="prod_name" value=<?php echo '"'.$obj->product_name.'"' ?>>
            </div>
          </div>

          <div class="row">
            <div class="small-4 columns">
              <label for="prod_image">Image</label>
            </div>
            <div class="small-8 columns">
              <?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $obj->product_image ).'"style="width:80px;height:100px;"/>';?>
              <input type="file" id="prod_image" name="prod_image" value=<?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $obj->product_image ).'"style="width:80px;height:100px;"/>';?>>
            </div>
          </div>

          <div class="row">
            <div class="small-4 columns">
              <label for="prod_category">Category</label>
            </div>
            <div class="small-8 columns">
              <input type="text" id="prod_category" name="prod_category" value=<?php echo '"'.$obj->category.'"' ?>>
            </div>
          </div>

          <div class="row">
            <div class="small-4 columns">
              <label for="prod_sport">Sport</label>
            </div>
            <div class="small-8 columns">
              <input type="text" id="prod_sport" name="prod_sport" value=<?php echo '"'.$obj->sport.'"' ?>>
            </div>
          </div>

          <div class="row">
            <div class="small-4 columns">
              <label for="prod_desc">Description</label>
            </div>
            <div class="small-8 columns">
              <textarea id="prod_desc" name="prod_desc" rows="7"><?php echo $obj->product_desc ?></textarea>
            </div>
          </div>

          <div class="row">
            <div class="small-4 columns">
              <label for="prod_qty">Quantity</label>
            </div>
            <div class="small-8 columns">
              <input type="number" id="prod_qty" name="prod_qty" value=<?php echo '"'.$obj->qty.'"' ?>>
            </div>
          </div>

          <div class="row">
            <div class="small-4 columns">
              <label for="prod_price">Price</label>
            </div>
            <div class="small-8 columns">
              <input type="number" id="prod_price" name="prod_price" value=<?php echo '"'.$obj->price.'"' ?>>
            </div>
          </div>

          <div class="row">
            <div class="small-4 columns">

            </div>
            <div class="small-8 columns">
              <input type="submit" id="submit" value="Update" style="background: #0078A0; border: none; color: #fff; font-family: 'Helvetica Neue', sans-serif; font-size: 1em; padding: 10px;">
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