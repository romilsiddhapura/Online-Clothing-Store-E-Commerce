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

<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register</title>
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
            echo '<li class="active"><a href="register.php">Register</a></li>';
          }
          ?>
        </ul>
      </section>
    </nav>





    <form method="POST" id="register" action="#" style="margin-top:30px;">
      <div class="row">
        <div class="small-8">
          <div class="row">
            <div class="small-4 columns">
              <label for="fname" class="right inline">First Name</label>
            </div>
            <div class="small-8 columns">
              <input type="text" id="fname" placeholder="First name" name="fname" required>
            </div>
          </div>
          <div class="row">
            <div class="small-4 columns">
              <label for="lname" class="right inline">Last Name</label>
            </div>
            <div class="small-8 columns">
              <input type="text" id="lname" placeholder="Last name" name="lname" required>
            </div>
          </div>
          <div class="row">
            <div class="small-4 columns">
              <label for="address" class="right inline">Address</label>
            </div>
            <div class="small-8 columns">
              <input type="text" id="address" placeholder="Address" name="address" required>
            </div>
          </div>
          <div class="row">
            <div class="small-4 columns">
              <label for="city" class="right inline">City</label>
            </div>
            <div class="small-8 columns">
              <input type="text" id="city" placeholder="City" name="city" required>
            </div>
          </div>
          <div class="row">
            <div class="small-4 columns">
              <label for="pin" class="right inline">Zip Code</label>
            </div>
            <div class="small-8 columns">
              <input type="number" id="pin" placeholder="Zip code" name="pin" required>
            </div>
          </div>
          <div class="row">
            <div class="small-4 columns">
              <label for="email" class="right inline">E-Mail</label>
            </div>
            <div class="small-8 columns">
              <input type="email" id="email" placeholder="Email" name="email" onkeyup="checkMail(this.value)" required><span id="checkemail"></span>
            </div>
          </div>
          <div class="row">
            <div class="small-4 columns">
              <label for="password" class="right inline">Password</label>
            </div>
            <div class="small-8 columns">
              <input type="password" id="password" name="pwd" onkeyup="checkStrength(this.value)" required><span id="result"></span>
            </div>
          </div>
          <div class="row">
            <div class="small-4 columns">

            </div>
            <div class="small-8 columns">
              <input type="submit" id="submit" value="Register" style="background: #0078A0; border: none; color: #fff; font-family: 'Helvetica Neue', sans-serif; font-size: 1em; padding: 10px;">
              <input type="reset" id="reset" value="Reset" style="background: #0078A0; border: none; color: #fff; font-family: 'Helvetica Neue', sans-serif; font-size: 1em; padding: 10px;">
            </div>
          </div>
        </div>
      </div>
    </form>


    <div class="row" style="margin-top:10px;">
      <div class="small-12">

        <footer>
           <p style="text-align:center; font-size:0.8em;">&copy; BOLT Sports Shop. All Rights Reserved.</p>
        </footer>

      </div>
    </div>
<style>
  #register {
    margin-left:100px;
}
 #register label{
    margin-right:5px;
}
 #register input {
    padding:5px 7px;
    border:1px solid #d5d9da;
    box-shadow: 0 0 5px #e8e9eb inset;
    width:250px;
    font-size:1em;
    outline:0;
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
</style>



    <script src="js/vendor/jquery.js"></script>
    <script src="js/foundation.min.js"></script>

    <script>
      $(document).foundation();
      var error=false;
      function checkMail(str) {
        if (str.length == 0) {
            document.getElementById("checkemail").innerHTML = "";
            return;
        } else {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    //console.log("here");
                    //console.log(this.responseText);
                    if(this.responseText == "OK"){
                      error = false;
                    } else {
                      error = true;
                    }
                    document.getElementById("checkemail").innerHTML = this.responseText;
                }
            }
            xmlhttp.open("GET", "checkmail.php?email="+str, true);
            xmlhttp.send();
        }
      }


      function checkPassword(str) {
        var number = /([0-9])/;
        var alphabets = /([a-zA-Z])/;
        var special_characters = /([~,!,@,#,$,%,^,&,*,-,_,+,=,?,>,<])/;
        if(str.length<6) {
          //$('#password-strength-status').removeClass();
          //$('#checkpassword').addClass('weak-password');
          $('#checkpassword').html("Weak (should be atleast 6 characters.)");
        } else {    
            if($(str.match(number)) && $(str.match(alphabets)) && $(str.match(special_characters))) {            
          //$('#password-strength-status').removeClass();
          //$('#password-strength-status').addClass('strong-password');
            $('#checkpassword').html("Strong");
          } else {
          //$('#password-strength-status').removeClass();
          //$('#password-strength-status').addClass('medium-password');
            $('#checkpassword').html("Medium (should include alphabets, numbers and special characters.)");
          }
        }
      }



    function checkStrength(password){
      var strength = 0
      //console.log(strength+" "+password);
      if(password.length==0)
      {
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
          $('#result').removeClass()
          $('#result').addClass('weak')
          $('#result').html('Weak')
      } else if (strength == 2 ) {
          $('#result').removeClass()
          $('#result').addClass('good')
          $('#result').html('Good')
      } else {
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
