<?php

//if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
if(session_id() == '' || !isset($_SESSION)){session_start();}
include 'config.php';
?>

<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Products || BOLT Sports Shop</title>
    <link rel="stylesheet" href="css/foundation.css" />
    <script src="js/vendor/modernizr.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </head>
  <body>

    <nav class="top-bar" data-topbar role="navigation">
      <ul class="title-area">
        <li class="name">
          <h1><a href="index.php">BOLT Sports Shop</a></h1>
        </li>
        <li class="toggle-topbar menu-icon"><a href="#"><span></span></a></li>
      </ul>

      <section class="top-bar-section">
      <!-- Right Nav Section -->
        <ul class="right">
          <li><a href="about.php">About</a></li>
          <li class='active'><a href="products.php">Products</a></li>
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
      if (isset($_GET['pageno'])) {
            $pageno = $_GET['pageno'];
      } else {
          $pageno = 1;
      }
      $no_of_records_per_page = 3;
      $offset = ($pageno-1) * $no_of_records_per_page;

      // $query="";
      //$conn = mysqli_connect("localhost", "root", "root", "hw3");
      // if(!$conn){
      //   echo "Database connection failed!";
      // }
      // else{
        if($_SERVER["REQUEST_METHOD"]=="POST"){
          if($_POST["Category"]=="all" && empty($_POST['term'])){
            $query="SELECT * FROM products where soft_delete = '0'";  
          } else if(empty($_POST['term'])){
            $category = $_POST["Category"];
            $query="SELECT * FROM products WHERE category='$category' and soft_delete = '0'";
          } else if($_POST["Category"] == "all"){
            $query = "SELECT * FROM products WHERE product_name LIKE '%".$_POST['term']."%' ";
          } else {
            $category = $_POST["Category"];
            $query = "SELECT * FROM products WHERE category = '$category' and product_name LIKE '%".$_POST['term']."%' ";
          }
          // else if($_POST["Category"]!="Jeans"){
          //   $category=$_POST["Category"];
          //   $query="SELECT * FROM products WHERE category='$category'"; 
          // }
          // else if($_POST["Category"]!="Tees"){
          //   $category=$_POST["Category"];
          //   $query="SELECT * FROM products WHERE category='$category'"; 
          // }
          // else if($_POST["Category"]!="Jacket"){
          //   $category=$_POST["Category"];
          //   $query="SELECT * FROM products WHERE category='$category'"; 
          // }
          // else{
          //   $Year=$_POST["Year"];
          //   $Gender=$_POST["Gender"];
          //   $query="SELECT * FROM babynames WHERE Year='$Year' AND Gender='$Gender' ORDER BY Year,Gender,RANKING ASC";  
          // } 
        }
         else{
           $query="SELECT * FROM products where soft_delete='0'";
        }
      // }
      //$result = mysqli_query($mysqli,$query);
      $result = $mysqli->query($query);
      $total_rows = $result->num_rows;
      //echo "<p>".$total_rows."</p>";
      $total_pages = ceil($total_rows / $no_of_records_per_page);
      $new_query="";
      if($_SERVER["REQUEST_METHOD"] == 'POST'){
        if($_POST["Category"]=="all" && empty($_POST['term'])){
          $new_query="SELECT * FROM products where soft_delete = '0' limit $offset, $no_of_records_per_page";  
        } else if(empty($_POST['term'])){
          $category = $_POST["Category"];
          $new_query="SELECT * FROM products WHERE category='$category' and soft_delete = '0' limit $offset, $no_of_records_per_page ";
        } else if($_POST["Category"] == "all"){
          $new_query = "SELECT * FROM products WHERE product_name LIKE '%".$_POST['term']."%' limit $offset, $no_of_records_per_page";
        } else {
          $category = $_POST["Category"];
          $new_query = "SELECT * FROM products WHERE category = '$category' and product_name LIKE '%".$_POST['term']."%' limit $offset, $no_of_records_per_page ";
        }
      } else {
        $new_query = "SELECT * FROM products where soft_delete='0' limit $offset, $no_of_records_per_page";
      }
      

      $new_result = $mysqli->query($new_query);


    ?>



    <div class="row" style="margin-top:10px;">
      <div class="small-12">
        <div class="container">
          <form action="products.php" method="POST">
            <label for="Category">Choose Category:</label>
            <select name="Category">
              <option value="all" <?if($_POST['Category'] == 'all'){echo " selected";}?>>All Categories</option>
              <option value="Jeans" <?if($_POST['Category'] == 'Jeans'){echo " selected";}?>>Jeans</option>
              <option value="Tees" <?if($_POST['Category'] == 'Tees'){echo " selected";}?>>Tees</option>
              <option value="Jacket" <?if($_POST['Category'] == 'Jacket'){echo " selected";}?>>Jacket</option>
            </select>
            Search: <input type="text" name="term"/><br/>  
            <input type="submit" value="Submit" >
          </form>
      </div>
        <?php
          $i=0;
          $product_id = array();
          $product_quantity = array();

          if($new_result){
            while($obj = $new_result->fetch_object())
            {
                //echo '<p>'.$obj->category.'</p>';
                echo '<div class="large-4 columns">';
                echo '<p><h3>'.$obj->product_name.'</h3></p>';

                //echo '<img src="images/'.$obj->category.'/'.$obj->product_img_name.'"/>';
                echo '<img src="data:image/jpeg;base64,'.base64_encode( $obj->product_image ).'"style="width:200px;height:300px;"/>';
                //echo '<p><strong>Product Code</strong>: '.$obj->product_code.'</p>';
                //echo '<p><strong>Description</strong>: '.$obj->product_desc.'</p>';
                //echo '<p><strong>Units Available</strong>: '.$obj->qty.'</p>';

                echo '<p><strong>Category</strong>: '.$obj->category.'</p>';
                echo '<p><strong>Price (Per Unit)</strong>: '.$currency.$obj->price.'</p>';
                if($obj->qty > 0){
                  echo '<p><a href="update-cart.php?action=add&id='.$obj->id.'"><input type="submit" value="Add To Cart" style="clear:both; background: #0078A0; border: none; color: #fff; font-size: 1em; padding: 10px;" /></a></p>';
                }
                else {
                  echo 'Out Of Stock!';
                }
                echo '</div>';
                $_SESSION['product_id'] = $product_id;
            }
          }

           // while($obj = $result->fetch_object()) {

           //    echo '<div class="large-4 columns">';
           //    echo '<p><h3>'.$obj->product_name.'</h3></p>';
           //    echo '<img src="images/'.$obj->category.'/'.$obj->product_img_name.'"/>';
           //    echo '<p><strong>Product Code</strong>: '.$obj->product_code.'</p>';
           //    echo '<p><strong>Description</strong>: '.$obj->product_desc.'</p>';
           //    echo '<p><strong>Units Available</strong>: '.$obj->qty.'</p>';
           //    echo '<p><strong>Category</strong>: '.$obj->category.'</p>';
           //    echo '<p><strong>Price (Per Unit)</strong>: '.$currency.$obj->price.'</p>';



           //    if($obj->qty > 0){
           //      echo '<p><a href="update-cart.php?action=add&id='.$obj->id.'"><input type="submit" value="Add To Cart" style="clear:both; background: #0078A0; border: none; color: #fff; font-size: 1em; padding: 10px;" /></a></p>';
           //    }
           //    else {
           //      echo 'Out Of Stock!';
           //    }
           //    echo '</div>';

           //    $i++;
           //  }

          

         // $_SESSION['product_id'] = $product_id;


          echo '</div>';
          echo '</div>';
          ?>
        <ul class="pagination">
              <li><a href="?pageno=1">First</a></li>
              <li class="<?php if($pageno <= 1){ echo 'hidden'; } ?>">
                  <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno-1); } ?>"><?php echo "".($pageno-1)."";?></a>
              </li>
              <li>
                  <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".$pageno; } ?>"><?php echo "<b> ".$pageno."</b>";?></a>
              </li>
              <li class="<?php if($pageno >= $total_pages){ echo 'hidden'; } ?>">
                  <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>"><?php echo "".($pageno+1)."";?></a>
              </li>
              <li><a href="?pageno=<?php echo $total_pages; ?>">Last</a></li>
          </ul>
        <div class="row" style="margin-top:10px;">
          <div class="small-12">




        <footer style="margin-top:10px;">
           <p style="text-align:center; font-size:0.8em;clear:both;">&copy; BOLT Sports Shop. All Rights Reserved.</p>
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
