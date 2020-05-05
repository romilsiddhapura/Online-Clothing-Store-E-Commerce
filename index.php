<?php
if(session_id() == '' || !isset($_SESSION))
	{
		session_start();
	}
	include 'config.php';
?>

<!DOCTYPE HTML>
<!--
	Industrious by TEMPLATED
	templated.co @templatedco
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html lang="en" style="font-size: 100%;">
	<head>
		<title>Clothing Shop</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<link rel="stylesheet" href="css/main.css" />
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
                  	<li><a href="#contact">Contact</a></li>

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

		<!-- Banner -->
			<section id="banner" style="background-image:url('images/indexbg.jpg')">
				<div class="inner">
					<h1>Welcome to our Clothing Store!</h1>
				</div>
				<!-- <img src="images/indexbg.jpg"></img> -->
				<!-- <video autoplay loop muted playsinline src="images/banner.mp4"></video> -->
			</section>
			<section id = "notdecided">
				<div class = "inner">
					<div class="wrapper">
			            <h1>Featured Collection</h1>  
			    </div>

			    <div class = "row">
			    	<div class = "col-md-12">
			    		<?php
			    			$query = "SELECT * FROM products where soft_delete='0' limit 0,8";
			    			$result = $mysqli->query($query);
			    			 if($result){
					            while($obj = $result->fetch_object())
					            {

					                //echo '<p>'.$obj->category.'</p>';
					                echo '<div class="col-sm-3 col-lg-3 col-md-3">';
					                echo '<div style="border:1px solid #ccc; border-radius:5px; padding:16px; margin-bottom:16px; height:375px;">';
					                echo '<p align="center"><strong>'.$obj->product_name.'</strong></p>';

					                //echo '<img src="images/'.$obj->category.'/'.$obj->product_img_name.'"/>';
					                echo '<img src="data:image/jpeg;base64,'.base64_encode( $obj->product_image ).'" class="img-responsive" style="width:230px;height:225px; align:center;padding:10px;" />';
					                //echo '<p><strong>Product Code</strong>: '.$obj->product_code.'</p>';
					                //echo '<p><strong>Description</strong>: '.$obj->product_desc.'</p>';
					                
					                //echo '<h4 style="text-align:center; color:red;" class="text_danger">$'. $obj->price . '</h4>';
					                echo '<p align = "center"><strong>Category</strong>: '.$obj->category.'</p>';
					                //echo '<strong>Units Available</strong>: '.$obj->qty.'</br>';
					                if($obj->qty > 0){
					                  // echo '<p><a href="update-cart.php?action=add&id='.$obj->id.'" ><input type="submit" value="Add To Cart" style=" text-align:center; clear:both; background: #ffc299; border: none; color:red; font-size: 1em; " /></a></p>';

					                  echo '<br><p style="text-align:center;"><a href="update-cart.php?action=add&id='.$obj->id.'" class = "btn btn-info"><span class="glyphicon glyphicon-shopping-cart"></span>Add to Cart</a></p>';
					              }
					                  echo '</div>';
					                  echo '</div>';
					          }
					      }

						?>

			    	</div>
			    </div>
			</div>
			<br>
			<br>
		</section>
<hr>
		<section id="contact">
			<div class = "inner" style="background-color: #f0f0f0;padding-bottom: 20px;">
				<div class = "wrapper">
					<h1>Contact Us</h1>
				</div>
				<form method="POST" id="login" action="#">
			      <div class="form-group">
			        <label for="email" class="right inline">Email</label>
			        <input type="email" id="email" type="form-control" placeholder="krupal@gmail.com" name="username" required>
			      </div>

			      <div class="form-group">
			        <label for="Subject" class="right inline">Subject</label>
			        <textarea  id="Subject" name="Subject"></textarea>
			      </div>

			      <br>
			      <input type="submit" style="width: 100px;" value="Send"/>
			      <input type="reset" style="width: 100px;" value="Reset" />
			    </form>
			</div>
		</section>


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
		            margin-left:200px;
		            margin-right:200px;
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