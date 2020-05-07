<?php
  if(session_id() == '' || !isset($_SESSION))
  {
    session_start();
  }

  if(isset($_SESSION["username"])) 
  {
    header ("location:index.php");
  }
?>

<!DOCTYPE HTML>
<html lang="en" style="font-size: 100%;">
  <head>
    <title>Admin</title>
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
                    <li><a href="orders.php">My Orders</a></li>
                    <!-- <li><a href="contact.php">Contact</a></li> -->

                  <?php
                    if(isset($_SESSION['username'])){
                      echo '<li><a href="account.php">My Account</a></li>';
                      echo '<li><a href="logout.php">Log Out</a></li>';
                    }
                    else{
                      echo '<li><a href="login.php">Log In</a></li>';
                      echo '<li class="active"><a href="register.php">Register</a></li>';
                    }
                  ?>
        </ul>
      </nav>

    
    <br>

    <div class="row">
      <div class="col-md-3">
      </div>
      <div class="col-md-6">
    <form method="POST" id="register" action="#">
      <div class="form-group">
        <label for="fname">First Name</label>
        <input type="text" id="fname" type="form-control" placeholder="First name" name="fname" required>
      </div>

      <div class="form-group">
        <label for="lname">Last Name</label>
        <input type="text" id="lname" type="form-control" placeholder="Last name" name="lname" required>
      </div>

      <div class="form-group">
        <label for="address">Address</label>
        <input type="text" id="address" type="form-control" placeholder="1234, Alma Road" name="address" required>
      </div>

      <div class="form-group">
        <label for="city">City</label>
        <input type="text" id="city" type="form-control" placeholder="City" name="city" required>
      </div>

      <div class="form-group">
        <label for="pin" class="right inline">ZIP Code</label><br>
        <input type="number" id="pin" type="form-control" placeholder="999999" name="pin" minlength="5" maxlength="6" required>
      </div>

      <div class="form-group">
        <label for="email" class="right inline">Email</label>
        <input type="email" id="email" type="form-control" placeholder="Enter email" name="email" onkeyup="checkMail(this.value)" required>
        <span id="checkemail"></span>
      </div>

      <div class="form-group">
        <label for="password" class="right inline">Password</label>
        <input type="password" id="password" type="form-control" placeholder="Enter Password" name="pwd" minlength="8" onkeyup="checkStrength(this.value)" required>
        <span id="result"></span>
      </div>

<!--       <div class="small-8 columns">
        <button type="submit" id="submit" class="btn btn-primary">Register</button>
        <button type="reset" id="reset">Reset</button>
      </div> -->
      <br>
      <!-- <input type="submit" id="submit" value="Register"/>
      <input type="reset" value="Reset" /> -->
      <input type="submit" id = "submit" style="width: 100px;" value="Register"/>
      <input type="reset" style="width: 100px;" value="Reset" />
      
    </form>
    </div>
    <div class="col-md-3">
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
























<style>

 #register input {
    padding:5px 5px;
    border:1px solid #d5d9da;
    box-shadow: 0 0 5px #e8e9eb inset;
    border-left: 3px solid;
    font-size:1em;
    outline:0;
    border-radius: 5px;
    transition: border-color .5s ease-out;
}
 #result{
    margin-left:5px;
}
 #result .short{
    color:#FF0000;
}
 #register .weak{
    color:#E66C2C;
}
 #register .good{
    color:#2D98F3;
}
 #register .strong{
    color:#006400;
}

#register input:optional {
  border-left-color: #999;
}
#register input:required:valid {
  border-left-color: green;
}

#register input:invalid {
  border-left-color: salmon;
}
#register input:required:focus:valid {
  background-image: url("../images/check.svg") no-repeat 95% 50%
  background-size: 25px;
}
#register input:focus:invalid {
  background: url("../images/check.svg") no-repeat 95% 50%
  background-size: 25px;
}

</style>



<!--     <script src="js/vendor/jquery.js"></script>
    <script src="js/foundation.min.js"></script>
 -->
    <script>
      //$(document).foundation();
      var error=false;
      function checkMail(str) {
        if (str.length == 0) {
            document.getElementById("checkemail").innerHTML = "";
            document.getElementById("email").style="border-left-color:salmon;";
            return;
        } else {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    //console.log("here");
                    //console.log(this.responseText);
                    if(this.responseText == "OK"){
                      error = false;
                      document.getElementById("email").style="border-left-color:green;";
                      document.getElementById("checkemail").innerHTML = "";
                    } else {
                      error = true;
                      document.getElementById("email").style="border-left-color:red;";
                      document.getElementById("checkemail").innerHTML = this.responseText;
                    }
                    //document.getElementById("checkemail").innerHTML = this.responseText;
                    //document.getElementById("email").style="border-left-color:red;";
                }
            }
            xmlhttp.open("GET", "checkmail.php?email="+str, true);
            xmlhttp.send();
        }
      }

    function checkStrength(password){
      var strength = 0
      //console.log(strength+" "+password);
      if(password.length==0)
      {
        document.getElementById("password").style="border-left-color:salmon;";
        $('#result').html('')
      }
      if (password.length < 6) {
          $('#result').removeClass()
          $('#result').addClass('short')
          $('#result').html('Too short')
      }
      //console.log(strength+" "+password);
      if (password.length > 7) strength += 1

      if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/))  strength += 1

      if (password.match(/([a-zA-Z])/) && password.match(/([0-9])/))  strength += 1 

      if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/))  strength += 1

      if (password.match(/(.*[!,%,&,@,#,$,^,*,?,_,~].*[!,",%,&,@,#,$,^,*,?,_,~])/)) strength += 1
      //console.log(strength);
      if (strength < 2 ) {
          document.getElementById("password").style="border-left-color:orange;";
          $('#result').removeClass()
          $('#result').addClass('weak')
          $('#result').html('Weak')
      } else if (strength == 2 ) {
          document.getElementById("password").style="border-left-color:palegreen;";
          $('#result').removeClass()
          $('#result').addClass('good')
          $('#result').html('Good')
      } else {
          document.getElementById("password").style="border-left-color:green;";
          $('#result').removeClass()
          $('#result').addClass('strong')
          $('#result').html('Strong')
      }
    }

    //function validateForm(){
    $('#submit').click(function(e) {
    e.preventDefault();
    var first_name = $('#fname').val();
    var last_name = $('#lname').val();
    var address=$('#address').val();
    var city=$('#city').val();
    var pin=$('#pin').val();
    var email = $('#email').val();
    var password = $('#password').val();
    
    $(".error").remove();

    if (first_name.length < 1) {
      $('#first_name').after('<span class="error">This field is required</span>');
      error=true;
    }
    if (last_name.length < 1) {
      $('#last_name').after('<span class="error">This field is required</span>');
      error=true;
    }
    if (email.length < 1) {
      $('#email').after('<span class="error">This field is required</span>');
      error=true;
    } else {
      var regEx = /^[A-Za-z0-9][A-Za-z0-9._%+-]{0,63}@(?:[A-Za-z0-9-]{1,63}\.){1,125}[A-Za-z]{2,63}$/;
      var validEmail = regEx.test(email);
      if (!validEmail) {
        $('#email').after('<span class="error">Enter a valid email</span>');
        error=true;
      }
    }
    if (password.length < 8) {
      $('#password').after('<span class="error">Password must be at least 8 characters long</span>');
      error=true;
    }
    console.log(error);
    if(error==false)
    {
      $.post("insert.php", {
        fname:first_name,
        lname:last_name,
        address:address,
        city:city,
        pin:pin,
        email:email,
        pwd: password
        }, function(data) {
          if (data == 'Success') {
            //$("form")[0].reset();
              console.log(data);
              window.location = "login.php";
             // <///header ("location:login.php");?>
          }
        console.log(data);
      });
    }
  });


    </script>
  </body>
</html>
