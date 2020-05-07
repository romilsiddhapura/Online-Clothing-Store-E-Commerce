<?php

//if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
if(session_id() == '' || !isset($_SESSION)){session_start();}

if(!isset($_SESSION["username"])){
  header("location:login.php");
}
include 'config.php';
?>

<!DOCTYPE HTML>
<html lang="en" style="font-size: 100%;">
  <head>
    <title>My Orders</title>
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
                    <!-- <li><a href="about.php">About</a></li> -->
                    <li><a href="products.php">Products</a></li>
                    <li><a href="cart.php">View Cart</a></li>
                    <li class="active"><a href="orders.php">My Orders</a></li>
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


    <div class="container">
      <div class="row" style="margin-top:10px;">
        <div class="col-lg-12">
          <br>
          <h3>My Orders</h3>
          <hr>

          <!-- Orders table -->
          <div class="table-responsive">
            <table class="table" style="align-self: center; margin-bottom: 200px;">
              <thead>
                <tr>
                  <th scope="col" class="border-0 bg-light">
                    <div class="p-2 px-3 text-uppercase">Order ID</div>
                  </th>
                  <th scope="col" class="border-0 bg-light">
                    <div class="p-2 px-3 text-uppercase">Order Date</div>
                  </th>
                  <th scope="col" class="border-0 bg-light">
                    <div class="p-2 px-3 text-uppercase">Code</div>
                  </th>
                  <th scope="col" class="border-0 bg-light">
                    <div class="p-2 px-3 text-uppercase">Product</div>
                  </th>
                  <th scope="col" class="border-0 bg-light">
                    <div class="py-2 text-uppercase">Price</div>
                  </th>
                  <th scope="col" class="border-0 bg-light">
                    <div class="py-2 text-uppercase">Quantity</div>
                  </th>
                  <th scope="col" class="border-0 bg-light">
                    <div class="py-2 text-uppercase">Total</div>
                  </th>
                </tr>
              </thead>


              <?php

                $user = $_SESSION["username"];
                $result = $mysqli->query("SELECT * from orders where email='".$user."'");
                if($result) {
                  echo '<tbody>';
                  while($obj = $result->fetch_object()) {
                    //echo '<div class="large-6">';
                    echo '<tr>';
                    echo '<td class="border-0 align-middle">'.$obj->id.'</td>';
                    echo '<td class="border-0 align-middle">'.$obj->date.'</td>';
                    echo '<td class="border-0 align-middle">'.$obj->product_code.'</td>';
                    echo '<td class="border-0 align-middle">'.$obj->product_name.'</td>';
                    echo '<td class="border-0 align-middle">'.$currency.$obj->price.'</td>';
                    echo '<td class="border-0 align-middle">'.$obj->units.'</td>';
                    echo '<td class="border-0 align-middle">'.$currency.$obj->total.'</td>';
                    echo '</tr>';
                    //echo '</div>';
                    //echo '<div class="large-6">';
                    //echo '<img src="images/products/sports_band.jpg">';
                    //echo '</div>';
                    //echo '<p><hr></p>';

                  }
                  echo '</tbody>';
                }
              ?>
            </table>
          </div>
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

    <!-- Scripts -->
      <script src="js/jquery.min.js"></script>
      <script src="js/browser.min.js"></script>
      <script src="js/breakpoints.min.js"></script>
      <script src="js/util.js"></script>
      <script src="js/main.js"></script>

  </body>
</html>