<?php
require "config/config.php";
require "includes/form_handlers/registor_handler.php";
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registor</title>
</head>
<body>
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
    else if(in_array("Emails don't match",$error_array))echo "Emails don't match<br>";
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
    <?php
    if (in_array("<span style='color:#14c800;'>Registered successfully! Go head and login!</span><br>",$error_array))echo "<span style='color:#14c800;'>Registered successfully! Go head and login!</span><br>";
    ?>
  </form>  
</body>
</html>