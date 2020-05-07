<?php

//if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
if(session_id() == '' || !isset($_SESSION)){session_start();}
include 'config.php';
//echo "<p>".$_SESSION["type"]."</p>";
if($_SESSION["type"] === "admin"){
  header("location:newadmin.php");
}
?>

<!doctype html>
<html lang="en" style="font-size: 100%;">
  <head>
    <title>Products</title>
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
        <!-- <li><a href="elements.html">Elements</a></li> -->
        <!-- <li><a href="about.php">About</a></li> -->
        <li class='active'><a href="products.php">Products</a></li>
        <li><a href="cart.php">View Cart</a></li>
        <li><a href="orders.php">My Orders</a></li>
        <!-- <li><a href="contact.php">Contact</a></li> -->
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
    <!-- </nav>
    <nav class="top-bar" data-topbar role="navigation">
      <ul class="title-area">
        <li class="name">
          <h1><a href="index.php">BOLT Sports Shop</a></h1>
        </li>
        <li class="toggle-topbar menu-icon"><a href="#"><span></span></a></li>
      </ul>

      <section class="top-bar-section">
      
        <ul class="right">
          <li><a href="about.php">About</a></li>
          <li class='active'><a href="products.php">Products</a></li>
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
      </section>-->
    </nav> 
    <?php
      if (isset($_GET['pageno'])) {
            $pageno = $_GET['pageno'];
      } else {
          $pageno = 1;
      }
      $no_of_records_per_page = 6;
      $offset = ($pageno-1) * $no_of_records_per_page;

      // $query="";
      //$conn = mysqli_connect("localhost", "root", "root", "hw3");
      // if(!$conn){
      //   echo "Database connection failed!";
      // }
      // else{
        if($_SERVER["REQUEST_METHOD"]=="POST"  ){
          $category = $_POST["Category"];
          $sport = $_POST["Sport"];
          $term = $_POST['term'];
          if($_POST["Category"]=="all" &&$_POST["Sport"]=="all" && empty($_POST['term'])){
            $query="SELECT * FROM products where soft_delete = '0'";  
          } else if(empty($term) &&  $category == "all"){
              $query="SELECT * FROM products WHERE sport='$sport' and soft_delete = '0'";
          } else if(empty($term) && $sport == "all"){
            $query="SELECT * FROM products WHERE category='$category' and soft_delete = '0'";
          } else if($sport == "all" && $category == "all"){
            $query = "SELECT * FROM products WHERE product_name LIKE '%".$_POST['term']."%' ";
          }else if(empty($_POST['term'])){
            $query="SELECT * FROM products WHERE category='$category' and sport='$sport' and soft_delete = '0'";
          } else if($_POST["Category"] == "all"){
            $query = "SELECT * FROM products WHERE sport='$sport' and product_name LIKE '%".$_POST['term']."%' ";
          } else if($_POST["Sport"] == "all"){
            $query = "SELECT * FROM products WHERE category='$category' and product_name LIKE '%".$_POST['term']."%' ";
          }else {
            $query = "SELECT * FROM products WHERE category = '$category' and sport = '$sport' and product_name LIKE '%".$_POST['term']."%' ";
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
      // if($_SERVER["REQUEST_METHOD"] == 'POST'){
      //   if($_POST["Category"]=="all" && empty($_POST['term'])){
      //     $new_query="SELECT * FROM products where soft_delete = '0' limit $offset, $no_of_records_per_page";  
      //   } else if(empty($_POST['term'])){
      //     $category = $_POST["Category"];
      //     $new_query="SELECT * FROM products WHERE category='$category' and soft_delete = '0' limit $offset, $no_of_records_per_page ";
      //   } else if($_POST["Category"] == "all"){
      //     $new_query = "SELECT * FROM products WHERE product_name LIKE '%".$_POST['term']."%' limit $offset, $no_of_records_per_page";
      //   } else {
      //     $category = $_POST["Category"];
      //     $new_query = "SELECT * FROM products WHERE category = '$category' and product_name LIKE '%".$_POST['term']."%' limit $offset, $no_of_records_per_page ";
      //   }
      // } else {
      //   $new_query = "SELECT * FROM products where soft_delete='0' limit $offset, $no_of_records_per_page";
      // }

      if($_SERVER["REQUEST_METHOD"]=="POST"  ){
          $category = $_POST["Category"];
          $sport = $_POST["Sport"];
          $term = $_POST['term'];
          if($_POST["Category"]=="all" &&$_POST["Sport"]=="all" && empty($_POST['term'])){
            $new_query="SELECT * FROM products where soft_delete = '0' limit $offset, $no_of_records_per_page";  
          } else if(empty($term) &&  $category == "all"){
              echo "<p>sdlksdjffs</p>";
              $new_query="SELECT * FROM products WHERE sport='$sport' and soft_delete = '0' limit $offset, $no_of_records_per_page";
          } else if(empty($term) && $sport == "all"){
            $new_query="SELECT * FROM products WHERE category='$category' and soft_delete = '0' limit $offset, $no_of_records_per_page";
          } else if($sport == "all" && $category == "all"){
            $new_query = "SELECT * FROM products WHERE product_name LIKE '%".$_POST['term']."%' limit $offset, $no_of_records_per_page ";
          }else if(empty($_POST['term'])){
            $new_query="SELECT * FROM products WHERE category='$category' and sport='$sport' and soft_delete = '0' limit $offset, $no_of_records_per_page";
          } else if($_POST["Category"] == "all"){
            $new_query = "SELECT * FROM products WHERE sport='$sport' and product_name LIKE '%".$_POST['term']."%' limit $offset, $no_of_records_per_page";
          } else if($_POST["Sport"] == "all"){
            $new_query = "SELECT * FROM products WHERE category='$category' and product_name LIKE '%".$_POST['term']."%' limit $offset, $no_of_records_per_page ";
          }else {
            $new_query = "SELECT * FROM products WHERE category = '$category' and sport = '$sport' and product_name LIKE '%".$_POST['term']."%' limit $offset, $no_of_records_per_page ";
          }
      } else{
        $new_query = "SELECT * FROM products where soft_delete='0' limit $offset, $no_of_records_per_page";
      }

      $new_result = $mysqli->query($new_query);


    ?>

  <div class="container">
    <div  style="margin-top:10px;">
      <br>
      <h2 align="center"> Filtering your product </h2>
      <br>
      <br>
    </div>
    <div class = "row">
      <div class="col-md-3">
      <!-- <div class="small-12"> -->
          <a href="index.php"><img src="images/logo.png" height="200px" width="200px" style="opacity: 80%"></a>
          <br>
          <br>
          <form action="products.php" method="POST">
            <label for="Category">Choose Category:</label>
            <select class="form-control" name="Category" style = "width:200px;">
              <option value="all" <?if($_POST['Category'] == 'all'){echo " selected";}?>>All Categories</option>
              <option value="Cap" <?if($_POST['Category'] == 'Cap'){echo " selected";}?>>Caps</option>
              <option value="Jersey" <?if($_POST['Category'] == 'Jersey'){echo " selected";}?>>Jerseys</option>
              <option value="Hoodie" <?if($_POST['Category'] == 'Hoodie'){echo " selected";}?>>Hoodies</option>
              <option value="Short" <?if($_POST['Category'] == 'Short'){echo " selected";}?>>Shorts</option>
            </select><br>
            <label for="Sports">Choose Sports:</label>
            <select class="form-control" name="Sport" style = "width:200px;">
              <option value="all" <?if($_POST['Sport'] == 'all'){echo " selected";}?>>All Categories</option>
              <option value="Cricket" <?if($_POST['Sport'] == 'Cricket'){echo " selected";}?>>Cricket</option>
              <option value="Soccer" <?if($_POST['Sport'] == 'Soccer'){echo " selected";}?>>Soccer</option>
              <option value="NBA" <?if($_POST['Sport'] == 'NBA'){echo " selected";}?>>NBA</option>
              <option value="NFL" <?if($_POST['Sport'] == 'NFL'){echo " selected";}?>>NFL</option>
            </select><br>
            <label for="term">Search:</label>
            <input type="text" name="term" style = "width:200px;"><br>  
            <input type="submit" value="Submit" >
          </form>
      </div>
    <div class="col-md-9">
        <?php
          $i=0;
          $product_id = array();
          $product_quantity = array();

          if($new_result){
            while($obj = $new_result->fetch_object())
            {

                //echo '<p>'.$obj->category.'</p>';
                echo '<div class="col-sm-4 col-lg-4 col-md-4">';
                echo '<div style="border:1px solid #ccc; border-radius:5px; padding:16px; margin-bottom:16px; height:400px;">';
                echo '<p align="center"><strong>'.$obj->product_name.'</strong></p>';

                //echo '<img src="images/'.$obj->category.'/'.$obj->product_img_name.'"/>';
                echo '<img src="data:image/jpeg;base64,'.base64_encode( $obj->product_image ).'" class="img-responsive" style="width:225px;height:225px;" />';
                //echo '<p><strong>Product Code</strong>: '.$obj->product_code.'</p>';
                //echo '<p><strong>Description</strong>: '.$obj->product_desc.'</p>';
                
                echo '<h4 style="text-align:center;"><strong>$'. $obj->price . '</strong></h4>';
                echo '<p align="center"><strong>Category</strong>: '.$obj->category.'</p>';
                //echo '<strong>Units Available</strong>: '.$obj->qty.'</br>';
                if($obj->qty > 0){
                  // echo '<p><a href="update-cart.php?action=add&id='.$obj->id.'" ><input type="submit" value="Add To Cart" style=" text-align:center; clear:both; background: #ffc299; border: none; color:red; font-size: 1em; " /></a></p>';

                  echo '<p style="text-align:center;"><a href="update-cart.php?action=add&id='.$obj->id.'" class = "btn btn-info"><span class="glyphicon glyphicon-shopping-cart"></span>Add to Cart</a></p>';

                  // // <div class="text-center container-card-button">
                  //   <button 
                  //      type="button"
                  //      class="btn btn-default"
                  //      onclick="cart.add('43');">
                  //       Add to Cart
                  //   </button>
                  //   <i class="fa fa-shopping-cart icon-card"></i>
                  // </div>
                }
                else {
                  echo '<p align="center">Out Of Stock!</p>';
                }
                echo '</div>';

        //         <div style="border:1px solid #ccc; border-radius:5px; padding:16px; margin-bottom:16px; height:450px;">
        //   <img src="image/'. $row['product_image'] .'" alt="" class="img-responsive" >
        //   <p align="center"><strong><a href="#">'. $row['product_name'] .'</a></strong></p>
        //   <h4 style="text-align:center;" class="text-danger" >'. $row['product_price'] .'</h4>
        //   <p>Camera : '. $row['product_camera'].' MP<br />
        //   Brand : '. $row['product_brand'] .' <br />
        //   RAM : '. $row['product_ram'] .' GB<br />
        //   Storage : '. $row['product_storage'] .' GB </p>
        // </div>
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
          ?>
        </div>
    </div>
  <div class = style = "text-align: center;">
      <div style="width: 250px; margin: 0 auto; ">
        <ul class="pagination">
            <li><a href="?pageno=1" style="color:black;">First</a></li>
            <li class="<?php if($pageno<=2 || $pageno <= $total_pages-1){ echo 'hidden'; } ?>">
                <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno - 2); } ?>" style="color:black;"><?php echo "".($pageno-2)."";?></a>
            </li>
            <li class="<?php if($pageno <= 1){ echo 'hidden'; } ?>">
                <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno-1); } ?>" style="color:black;" ><?php echo "".($pageno-1)."";?></a>
            </li>
            <li>
                <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".$pageno; } ?>" style="color:black;"><?php echo "<b> ".$pageno."</b>";?></a>
            </li>
            <li class="<?php if($pageno >= $total_pages ){ echo 'hidden'; } ?>">
                <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>" style="color:black;"><?php echo "".($pageno+1)."";?></a>
            </li>
            <li class="<?php if(($pageno+2 >= $total_pages) || $pageno>1){ echo 'hidden'; } ?>">
                <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 2); } ?>" style="color:black;"><?php echo "".($pageno+2)."";?></a>
            </li>
            <li><a href="?pageno=<?php echo $total_pages; ?>" style="color:black;">Last</a></li>
        </ul>
      </div>
    </div>

</div>



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



      <script src="js/jquery.min.js"></script>
      <script src="js/browser.min.js"></script>
      <script src="js/breakpoints.min.js"></script>
      <script src="js/util.js"></script>
      <script src="js/main.js"></script>
  </body>
</html>
