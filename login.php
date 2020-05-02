<?php

//if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
if(session_id() == '' || !isset($_SESSION)){session_start();}

if(isset($_SESSION["username"])){

        header("location:index.php");
}

?>

<!DOCTYPE HTML>
<html>
  <head>
    <title>Register</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <link rel="stylesheet" href="css/main.css" />
  </head>
  <body class="is-preload">

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
                      echo '<li class="active"><a href="login.php">Log In</a></li>';
                      echo '<li><a href="register.php">Register</a></li>';
                    }
                  ?>
        </ul>
      </nav>

    
    <br>
    <form method="POST" id="login" action="verify.php">
      <div class="form-group">
        <label for="email" class="right inline">Email</label>
        <input type="email" id="email" type="form-control" placeholder="krupal@gmail.com" name="username" required>
      </div>

      <div class="form-group">
        <label for="password" class="right inline">Password</label>
        <input type="password" id="password" type="form-control" placeholder="Enter Password" name="pwd" required>
      </div>

      <br>
      <input type="submit" value="Register"/>
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
        #login {
            margin-left:100px;
            margin-right:100px;
        }
         #login label{
            margin-right:5px;
        }
         #login input {
            padding:5px 5px;
            border:1px solid #d5d9da;
            box-shadow: 0 0 5px #e8e9eb inset;
            
            font-size:1em;
            outline:0;
        }
        }
      </style>

  </body>
</html>
