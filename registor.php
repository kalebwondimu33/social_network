<?php
require "config/config.php";
require "includes/form_handlers/registor_handler.php";
require "includes/form_handlers/login_handler.php";

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registor</title>
    <link rel="stylesheet" href="assets/css/register_style.css">
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <script src="assets/js/register.js"></script>
</head>
<body>
   <?php
   if (isset($_POST['reg_button'])){
      echo '
      <script>
      $(document).ready(function(event){
           $("#first").hide();
           $("#second").show();
      });
      </script>
      ';
   }

   ?>
   <div class="wrapper">
      <div class="login_box">
         <div class="login_header">
            <h1>Friend Link!</h1>
            Login or sign up below!
         </div>
         <div id="first">
            <form action="registor.php" method="POST">
                  <input type="email" name="log_email" placeholder="Email Address" value="<?php
                  if(isset($_SESSION['log_email'])){
                  echo $_SESSION['log_email'];
                  };?>" required>
                  <br>
                  <input type="password" name="log_password" placeholder="password">
                  <br>
                  <input type="submit" name="log_button" value="Login" required>
                  <br>
                  <a href="" id="signup" class="signup">Create new Account</a>
               <?php if(in_array("Email or passowrd was incorrect<br>",$error_array))echo "Email or passowrd was incorrect<br>";?>
               </form>
         </div>
         <div id="second">
         <form action="registor.php" method="post">
            <input type="text" name="reg_fname" placeholder="First Name" value="<?php
               if(isset($_SESSION['reg_fname'])){
               echo $_SESSION['reg_fname'];
               };?>" required>
            <br>
            <?php 
            if (in_array("your first name must be between 2 and 25<br>",$error_array))echo "your first name must be between 2 and 25<br>";
            ?>
            <input type="text" name="reg_lname" placeholder="Last Name" value="<?php
               if(isset($_SESSION['reg_lname'])){
               echo $_SESSION['reg_lname'];
               };?>" required>
            <br>
            <?php
            if (in_array("your last name must be between 2 and 25<br>",$error_array))echo "your last name must be between 2 and 25<br>";
            ?>
            <input type="email" name="reg_email" placeholder="email" value="<?php
               if(isset($_SESSION['reg_email'])){
               echo $_SESSION['reg_email'];
               };?>" required>
            <br>
            
            <input type="email" name="reg_email2" placeholder="confirm email" value="<?php
               if(isset($_SESSION['reg_email2'])){
               echo $_SESSION['reg_email2'];
               };?>" required>
            <br>
            <?php
            if (in_array("Email already in use <br>",$error_array))echo "Email already in use <br>";
            else if(in_array("Invalid format <br>",$error_array))echo "Invalid format <br>";
            else if(in_array("Emails don't match<br>",$error_array))echo "Emails don't match<br>";
            ?>
            
            <input type="password" name="reg_password" placeholder="Enter password" required>
            <br>
            <input type="password" name="reg_password2" placeholder="confirm password" required>
            <br>
            <?php 
            if (in_array("your password do not match<br>",$error_array))echo "your password do not match<br>";
            else if(in_array("your password only can contain engilsh character or numbers<br>",$error_array))echo "your password only can contain engilsh character or numbers<br>";
            else if(in_array("your password must be betwee 5 and 30<br>",$error_array)) echo "your password must be betwee 5 and 30<br>";
            ?>
            <input type="submit" name="reg_button" value="Register" required>
            <br>
            <a href="" id="signin" class="signin">Already have an account? Sign in here!</a>
            <?php
            if (in_array("<span style='color:#14c800;'>Registered successfully! Go head and login!</span><br>",$error_array))echo "<span style='color:#14c800;'>Registered successfully! Go head and login!</span><br>";
            ?>
         </form> 
         </div>
         
      </div>
  </div> 
</body>
</html>